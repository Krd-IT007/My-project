<?php
// database.php
$host = 'localhost';
$dbname = 'QuanLyTinTuc';
$username = 'root';
$password = ''; // Chỉ dùng nếu XAMPP local chưa đặt mật khẩu
try {
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$pdo = new PDO($dsn, $username, $password, [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_EMULATE_PREPARES => false
]);
} catch (PDOException $e) {
error_log($e->getMessage());
http_response_code(500);
exit('Không thể kết nối cơ sở dữ liệu.');
}