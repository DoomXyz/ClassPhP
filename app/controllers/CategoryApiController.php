<?php
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryApiController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // Lấy tất cả danh mục
    public function apiGetAll()
    {
        header('Content-Type: application/json');
        $categories = $this->categoryModel->getCategories();
        echo json_encode([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    // Lấy danh mục theo ID
    public function apiGetById($id)
    {
        header('Content-Type: application/json');
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            echo json_encode([
                'status' => 'success',
                'data' => $category
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Category not found'
            ]);
        }
    }

    // Tạo danh mục mới
    public function apiCreate()
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            $result = $this->categoryModel->addCategory($name, $description);
            if ($result === true) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Category created successfully'
                ]);
            } else {
                http_response_code(400);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to create category',
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

    // Cập nhật danh mục
    public function apiUpdate($id)
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents("php://input"), $putData);

            $category = $this->categoryModel->getCategoryById($id);
            if (!$category) {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Category not found'
                ]);
                return;
            }

            $name = $putData['name'] ?? $category->name;
            $description = $putData['description'] ?? $category->description;

            $result = $this->categoryModel->updateCategory($id, $name, $description);
            if ($result === true) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Category updated successfully'
                ]);
            } else {
                http_response_code(400);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to update category',
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

    // Xóa danh mục
    public function apiDelete($id)
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $category = $this->categoryModel->getCategoryById($id);
            if (!$category) {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Category not found'
                ]);
                return;
            }

            if ($this->categoryModel->deleteCategory($id)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Category deleted successfully'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete category'
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
}
?>