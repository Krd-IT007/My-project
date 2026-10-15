<?php
// create-category.php
session_start();
$errors = $_SESSION['form_errors'] ?? [];
$old = $_SESSION['old_input'] ?? [];
$success = $_SESSION['success'] ?? '';
unset(
$_SESSION['form_errors'],
$_SESSION['old_input'],
$_SESSION['success']
);
$tenDM = $old['tenDM'] ?? '';
$trangThai = $old['trangThai'] ?? '1';
function e($value) {
return htmlspecialchars(
(string) $value,
ENT_QUOTES,
'UTF-8'
);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1">
<title>Thêm danh mục</title>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
<div class="row justify-content-center">
<div class="col-md-7 col-lg-6">
<div class="card shadow-sm">
<div class="card-header bg-primary text-white">
<h4 class="mb-0">Thêm danh mục</h4>
</div>
<div class="card-body">
<?php if ($success): ?>
<div class="alert alert-success" role="alert">
<?= e($success) ?>
</div>
<?php endif; ?>
<?php if (isset($errors['general'])): ?>
<div class="alert alert-danger" role="alert">
<?= e($errors['general']) ?>
</div>
<?php endif; ?>
<form id="categoryForm"
action="create-category-process.php"
method="POST"
novalidate>
<div class="mb-3">
<label for="tenDM" class="form-label">
Tên danh mục

<span class="text-danger">*</span>

</label>

<input type="text"
class="form-control
<?= isset($errors['tenDM']) ? 'is-invalid' : ''
?>"
id="tenDM"
name="tenDM"
value="<?= e($tenDM) ?>"
maxlength="100"
required>

<div class="invalid-feedback"
id="tenDMError">
<?= e($errors['tenDM'] ??
'Tên danh mục phải từ 2 đến 100 ký tự.') ?>
</div>

<div class="form-text">

Ví dụ: Công nghệ, Giáo dục, Khoa học.
</div>
</div>

<div class="mb-3">

<label for="trangThai" class="form-label">
Trạng thái
</label>

<select class="form-select

<?= isset($errors['trangThai']) ? 'is-invalid' : ''
?>"
id="trangThai"
name="trangThai"
required>
<option value="1"
<?= $trangThai === '1' ? 'selected' : '' ?>>
Đang hoạt động
</option>
<option value="0"
<?= $trangThai === '0' ? 'selected' : '' ?>>
Ngừng hoạt động
</option>
</select>
<div class="invalid-feedback">
<?= e($errors['trangThai'] ??
'Vui lòng chọn trạng thái hợp lệ.') ?>
</div>
</div>
<div class="d-flex gap-2">
<button type="submit"
class="btn btn-primary">
Thêm danh mục
</button>

<button type="reset"

class="btn btn-outline-secondary">
Làm lại
</button>
</div>
</form>
<hr>
<a href="list-news.php">
Xem danh sách bài viết
</a>
</div>
</div>
</div>
</div>
</div>
<script>
const form = document.getElementById('categoryForm');
const tenDM = document.getElementById('tenDM');
const tenDMError = document.getElementById('tenDMError');
const trangThai = document.getElementById('trangThai');
form.addEventListener('submit', function(event) {
const name = tenDM.value.trim();
const length = Array.from(name).length;
tenDM.classList.remove('is-invalid');
trangThai.classList.remove('is-invalid');
let valid = true;
if (name === '') {
tenDMError.textContent =
'Vui lòng nhập tên danh mục.';
tenDM.classList.add('is-invalid');
valid = false;
} else if (length < 2 || length > 100) {
tenDMError.textContent =
'Tên danh mục phải từ 2 đến 100 ký tự.';
tenDM.classList.add('is-invalid');
valid = false;
}
if (!['0', '1'].includes(trangThai.value)) {
trangThai.classList.add('is-invalid');
valid = false;
}
if (!valid) {
event.preventDefault();
}
});
tenDM.addEventListener('input', function() {
tenDM.classList.remove('is-invalid');
});
trangThai.addEventListener('change', function() {
trangThai.classList.remove('is-invalid');
});
form.addEventListener('reset', function() {
setTimeout(function() {
tenDM.classList.remove('is-invalid');
trangThai.classList.remove('is-invalid');
}, 0);
});
</script>
</body>
</html>