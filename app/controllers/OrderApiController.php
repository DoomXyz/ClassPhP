<?php
require_once('app/config/database.php');

class OrderApiController
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    // Lấy tất cả đơn hàng
    public function apiGetAll()
    {
        header('Content-Type: application/json');
        $query = "SELECT o.*, GROUP_CONCAT(p.name) as products 
                  FROM orders o 
                  LEFT JOIN order_details od ON o.id = od.order_id 
                  LEFT JOIN product p ON od.product_id = p.id 
                  GROUP BY o.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode([
            'status' => 'success',
            'data' => $orders
        ]);
    }

    // Lấy đơn hàng theo ID
    public function apiGetById($id)
    {
        header('Content-Type: application/json');
        $query = "SELECT o.*, od.product_id, od.quantity, od.price, p.name as product_name 
                  FROM orders o 
                  LEFT JOIN order_details od ON o.id = od.order_id 
                  LEFT JOIN product p ON od.product_id = p.id 
                  WHERE o.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $order = $stmt->fetchAll(PDO::FETCH_OBJ);
        if ($order) {
            echo json_encode([
                'status' => 'success',
                'data' => $order
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Order not found']);
        }
    }

    // Cập nhật trạng thái đơn hàng
    public function apiUpdateStatus($id)
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents("php://input"), $putData);
            $status = $putData['status'] ?? '';

            $query = "UPDATE orders SET status = :status WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Order status updated successfully'
                ]);
            } else {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Failed to update order']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        }
    }
    public function apiGetUserOrders()
    {
        header('Content-Type: application/json');
        session_start();
        $user_id = $_SESSION['user_id'] ?? null;
        if (!$user_id) {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            return;
        }

        $query = "SELECT o.*, GROUP_CONCAT(p.name) as products 
                  FROM orders o 
                  LEFT JOIN order_details od ON o.id = od.order_id 
                  LEFT JOIN product p ON od.product_id = p.id 
                  WHERE o.user_id = :user_id 
                  GROUP BY o.id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode([
            'status' => 'success',
            'data' => $orders
        ]);
    }

    // Client: Đặt hàng
    public function apiCreate()
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $user_id = $_SESSION['user_id'] ?? null;
            if (!$user_id) {
                http_response_code(401);
                echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
                return;
            }

            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $payment_method = $_POST['payment_method'] ?? 'cod'; // cod hoặc online

            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Cart is empty']);
                return;
            }

            $cart = $_SESSION['cart'];
            $totalPrice = 0;
            foreach ($cart as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }

            $this->db->beginTransaction();
            try {
                $query = "INSERT INTO orders (user_id, name, phone, address, total_price, payment_method) 
                          VALUES (:user_id, :name, :phone, :address, :total_price, :payment_method)";
                $stmt = $this->db->prepare($query);
                $stmt->execute([
                    'user_id' => $user_id,
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address,
                    'total_price' => $totalPrice,
                    'payment_method' => $payment_method
                ]);
                $order_id = $this->db->lastInsertId();

                foreach ($cart as $product_id => $item) {
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                              VALUES (:order_id, :product_id, :quantity, :price)";
                    $stmt = $this->db->prepare($query);
                    $stmt->execute([
                        'order_id' => $order_id,
                        'product_id' => $product_id,
                        'quantity' => $item['quantity'],
                        'price' => $item['price']
                    ]);
                }

                unset($_SESSION['cart']);
                $this->db->commit();
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Order placed successfully',
                    'order_id' => $order_id
                ]);
            } catch (Exception $e) {
                $this->db->rollBack();
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'Failed to place order: ' . $e->getMessage()]);
            }
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        }
    }
}
?>