<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

class ProductApiController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function apiGetAll()
    {
        header('Content-Type: application/json');
        $products = $this->productModel->getProducts();
        echo json_encode([
            'status' => 'success',
            'data' => $products
        ]);
    }

    public function apiGetById($id)
    {
        header('Content-Type: application/json');
        $product = $this->productModel->getProductById($id);
        if ($product) {
            echo json_encode([
                'status' => 'success',
                'data' => $product
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Product not found'
            ]);
        }
    }

    public function apiCreate()
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagePath = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->uploadImage($_FILES['image']);
            } else {
                $imagePath = $_POST['image'] ?? '';
            }

            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $imagePath);
            if ($result === true) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Product created successfully',
                    'image' => $imagePath
                ]);
            } else {
                http_response_code(400);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to create product',
                    'errors' => $result
                ]);
            }
        } else {
            http_response_code(405);
            echo json_encode([
                'status' => 'error',
                'message' => 'Method not allowed'
            ]);
        }
    }

    public function apiUpdate($id)
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents("php://input"), $putData);

            $product = $this->productModel->getProductById($id);
            if (!$product) {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Product not found'
                ]);
                return;
            }

            $imagePath = $product->image;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->uploadImage($_FILES['image']);
            } elseif (isset($putData['image'])) {
                $imagePath = $putData['image'];
            }

            $name = $putData['name'] ?? $product->name;
            $description = $putData['description'] ?? $product->description;
            $price = $putData['price'] ?? $product->price;
            $category_id = $putData['category_id'] ?? $product->category_id;

            $result = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $imagePath);
            if ($result) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Product updated successfully',
                    'image' => $imagePath
                ]);
            } else {
                http_response_code(400);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to update product'
                ]);
            }
        } else {
            http_response_code(405);
            echo json_encode([
                'status' => 'error',
                'message' => 'Method not allowed'
            ]);
        }
    }

    public function apiDelete($id)
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $product = $this->productModel->getProductById($id);
            if (!$product) {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Product not found'
                ]);
                return;
            }

            if ($this->productModel->deleteProduct($id)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Product deleted successfully'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete product'
                ]);
            }
        } else {
            http_response_code(405);
            echo json_encode([
                'status' => 'error',
                'message' => 'Method not allowed'
            ]);
        }
    }

    private function uploadImage($file)
    {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            throw new Exception("File không phải là hình ảnh.");
        }
        if ($file["size"] > 10 * 1024 * 1024) {
            throw new Exception("Hình ảnh có kích thước quá lớn.");
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF.");
        }
        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh.");
        }
        return $target_file;
    }
    public function apiFilter()
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $category_id = $_GET['category_id'] ?? null;
            $sort_by = $_GET['sort_by'] ?? 'name'; // name, price
            $order = $_GET['order'] ?? 'ASC'; // ASC, DESC

            $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name 
                      FROM product p 
                      LEFT JOIN category c ON p.category_id = c.id";
            $conditions = [];
            $params = [];

            if ($category_id) {
                $conditions[] = "p.category_id = :category_id";
                $params[':category_id'] = $category_id;
            }

            if (!empty($conditions)) {
                $query .= " WHERE " . implode(" AND ", $conditions);
            }

            $query .= " ORDER BY p.$sort_by $order";
            $stmt = $this->db->prepare($query);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode([
                'status' => 'success',
                'data' => $products
            ]);
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        }
    }
}
?>