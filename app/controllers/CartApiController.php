<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');

class CartApiController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    // Xem giỏ hàng
    public function apiGetCart()
    {
        header('Content-Type: application/json');
        session_start();
        $cart = $_SESSION['cart'] ?? [];
        echo json_encode([
            'status' => 'success',
            'data' => $cart
        ]);
    }

    // Thêm vào giỏ hàng
    public function apiAdd($product_id)
    {
        header('Content-Type: application/json');
        session_start();
        $product = $this->productModel->getProductById($product_id);
        if (!$product) {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Product not found']);
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }
        echo json_encode([
            'status' => 'success',
            'message' => 'Product added to cart'
        ]);
    }

    // Xóa khỏi giỏ hàng
    public function apiRemove($product_id)
    {
        header('Content-Type: application/json');
        session_start();
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
            if (empty($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
            echo json_encode([
                'status' => 'success',
                'message' => 'Product removed from cart'
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Product not in cart']);
        }
    }
}
?>