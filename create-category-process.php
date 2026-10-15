<?php
// create-category-process.php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
header('Location: create-category.php');
exit;
}
// 1. Lấy dữ liệu từ form
$tenDM = $_POST['tenDM'] ?? '';
$trangThai = $_POST['trangThai'] ?? '';
$tenDM = is_string($tenDM) ? trim($tenDM) : '';
$trangThai = is_string($trangThai) ? $trangThai : '';
$errors = [];
// 2. Kiểm tra tên danh mục
$length = mb_strlen($tenDM, 'UTF-8');
if ($tenDM === '') {
$errors['tenDM'] = 'Vui lòng nhập tên danh mục.';
} elseif ($length < 2 || $length > 100) {
$errors['tenDM'] =
'Tên danh mục phải có từ 2 đến 100 ký tự.';
}
// 3. Kiểm tra trạng thái
if (!in_array($trangThai, ['0', '1'], true)) {
$errors['trangThai'] =
'Trạng thái không hợp lệ.';
}
// 4. Lưu dữ liệu cũ để hiển thị lại nếu có lỗi
$_SESSION['old_input'] = [
'tenDM' => $tenDM,
'trangThai' => $trangThai
];
// 5. Nếu dữ liệu không hợp lệ
if (!empty($errors)) {
$_SESSION['form_errors'] = $errors;
header('Location: create-category.php');
exit;
}
// 6. Thêm dữ liệu vào MySQL
require_once 'database.php';
try {
$sql = "INSERT INTO DanhMuc (TenDM, TrangThai)
VALUES (:tenDM, :trangThai)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':tenDM', $tenDM, PDO::PARAM_STR);
$stmt->bindValue(
':trangThai',
(int) $trangThai,
PDO::PARAM_INT
);
$stmt->execute();
// 7. Ghi nhận thành công
unset($_SESSION['old_input']);
$_SESSION['success'] =
'Thêm danh mục thành công!';
} catch (PDOException $e) {
error_log($e->getMessage());
$_SESSION['form_errors'] = [
'general' => 'Không thể lưu danh mục. Vui lòng thử lại.'
];
}
// 8. Trở lại biểu mẫu
header('Location: create-category.php');
exit;