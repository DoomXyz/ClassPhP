<?php
require_once('app/config/database.php');

class PromotionApiController
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function apiGetAll()
    {
        header('Content-Type: application/json');
        $query = "SELECT * FROM promotions WHERE expiry_date >= CURDATE() OR expiry_date IS NULL";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $promotions = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode([
            'status' => 'success',
            'data' => $promotions
        ]);
    }

    public function apiCreate()
    {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['code'] ?? '';
            $discount = $_POST['discount'] ?? 0;
            $expiry_date = $_POST['expiry_date'] ?? null;

            $query = "INSERT INTO promotions (code, discount, expiry_date) VALUES (:code, :discount, :expiry_date)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':discount', $discount);
            $stmt->bindParam(':expiry_date', $expiry_date);

            if ($stmt->execute()) {
                http_response_code(201);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Promotion created successfully'
                ]);
            } else {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Failed to create promotion']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        }
    }
}
?>