<?php
class AccountModel
{
    private $conn;
    private $table_name = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAccountByAccount($account)
    {
        $query = "SELECT * FROM users WHERE account = :account";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':account', $account, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            error_log("Lỗi khi thực thi truy vấn getAccountByAccount: " . implode(", ", $stmt->errorInfo()));
            return false;
        }
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function getAccountById($id)
    {
        $query = "SELECT id, account, username FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            error_log("Lỗi khi thực thi truy vấn getAccountById: " . implode(", ", $stmt->errorInfo()));
            return false;
        }
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    function save($account, $username, $password)
    {
        $query = "INSERT INTO " . $this->table_name . "(account, username, password) VALUES (:account, :username, :password)";

        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $account = htmlspecialchars(strip_tags($account));
        $username = htmlspecialchars(strip_tags($username));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':account', $account);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Lỗi khi lưu tài khoản: " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    }
}