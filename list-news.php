<?php
// list-news.php
require_once 'list-news-process.php';
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
<title>Danh sách bài viết</title>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<style>
body {
background-color: #f5f6f8;
}
.news-card {
border: 1px solid #e5e7eb;
border-radius: 10px;
transition: box-shadow .2s ease;
}
.news-card:hover {
box-shadow: 0 5px 18px rgba(0, 0, 0, .08);
}
.news-content {
white-space: pre-line;
overflow-wrap: anywhere;
}
</style>
</head>
<body>
<div class="container py-5">
<div class="d-flex flex-wrap
justify-content-between
align-items-center
gap-3 mb-4">
<div>
<h2 class="fw-bold mb-1">
Danh sách bài viết
</h2>
<p class="text-secondary mb-0">
Hệ thống quản lý tin tức
</p>
</div>
<a href="create-category.php"
class="btn btn-primary">
+ Thêm danh mục
</a>
</div>
<?php if ($errorMessage !== ''): ?>
<div class="alert alert-danger" role="alert">
<?= e($errorMessage) ?>
</div>
<?php else: ?>
<div class="mb-3 text-secondary">
Tổng số bài viết:
<strong><?= count($articles) ?></strong>
</div>
<?php if (empty($articles)): ?>
<div class="alert alert-info" role="status">
Chưa có bài viết nào.
</div>
<?php else: ?>
<?php foreach ($articles as $article): ?>
<div class="card news-card mb-3">
<div class="card-body p-4">
<div class="d-flex
justify-content-between
align-items-start
flex-wrap gap-2 mb-3"><h5 class="card-title fw-bold mb-0">
<?= e($article['TieuDe']) ?>
</h5>

<span class="badge bg-primary">
<?= e($article['TenDM']) ?>
</span>
</div>

<p class="card-text text-secondary

news-content">
<?= e($article['NoiDung']) ?>
</p>
<hr>

<div class="d-flex

justify-content-between
align-items-center
flex-wrap gap-2">
<small class="text-muted">
Mã bài viết:

#<?= (int) $article['MaBV'] ?>

</small>

<?php if ((int) $article['TrangThai'] === 1): ?>

<span class="text-success small">
Đang hoạt động
</span>
<?php else: ?>
<span class="text-secondary small">
Ngừng hoạt động
</span>
<?php endif; ?>
</div>
</div>
</div>
<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>
</div>
</body>
</html>