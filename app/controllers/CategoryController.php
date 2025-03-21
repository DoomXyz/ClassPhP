<?php
// Require necessary files
require_once('app/config/database.php');

require_once('app/models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;
    private $db;


    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // List all category
    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/index.php';

    }

    // Show add form
    public function add()
    {
        include_once 'app/views/category/add.php';
    }

    // Save new category
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            $result = $this->categoryModel->addCategory($name, $description);

            if (is_array($result)) {
                $errors = $result;
                include 'app/views/category/add.php';
            } else {
                header('Location: /webbanhang/Category');
            }
        }
    }

    // Show edit form
    public function edit($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            include 'app/views/category/edit.php';
        } else {
            echo "Không thấy thể loại.";
        }
    }

    // Update category
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];

            $result = $this->categoryModel->updateCategory($id, $name, $description);

            if (is_array($result)) {
                $errors = $result;
                $category = (object) ['id' => $id, 'name' => $name, 'description' => $description];
                include 'app/views/category/edit.php';
            } else {
                header('Location: /webbanhang/Category');
            }
        }
    }

    // Delete category
    public function delete($id)
    {
        if ($this->categoryModel->deleteCategory($id)) {
            header('Location: /webbanhang/Category');
        } else {
            echo "Đã xảy ra lỗi khi xóa thể loại.";
        }
    }
}
?>