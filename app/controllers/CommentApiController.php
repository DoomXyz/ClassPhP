<?php
require_once('app/config/database.php');

class CommentApiController
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    // Lấy bình luận theo sản phẩm
    public function apiGetByProduct($product_id)
    {
        header('Content-Type: application/json');
        $query = "SELECT c.*, u.username 
                  FROM comments c 
                  LEFT JOIN users u ON c.user_id = u.id 
                  WHERE c.product_id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode([
            'status' => 'success',
            'data' => $comments
        ]);
    }

    // Thêm bình luận/đánh giá
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

            $product_id = $_POST['product_id'] ?? '';
            $content = $_POST['content'] ?? '';
            $rating = $_POST['rating'] ?? 0; // 1-5 sao

            $query = "INSERT INTO comments (user_id, product_id, content, rating) 
                      VALUES (:user_id, :product_id, :content, :rating)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':rating', $rating);

            if ($stmt->execute()) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Comment created successfully'
                ]);
            } else {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Failed to create comment']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        }
    }
}
?>