<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class UserApiController
{
    private $accountModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    // Lấy tất cả user
    public function apiGetAll()
    {
        header('Content-Type: application/json');
        $query = "SELECT id, account, username, role FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode([
            'status' => 'success',
            'data' => $users
        ]);
    }

    // Lấy user theo ID
    public function apiGetById($id)
    {
        header('Content-Type: application/json');
        $user = $this->accountModel->getAccountById($id);
        if ($user) {
            echo json_encode([
                'status' => 'success',
                'data' => $user
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
    }

    // Phân quyền user
    public function apiUpdateRole($id)
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents("php://input"), $putData);
            $role = $putData['role'] ?? 'user'; // Mặc định là user

            $query = "UPDATE users SET role = :role WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'User role updated successfully'
                ]);
            } else {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Failed to update role']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        }
    }
}
?>