<?php
// list-news-process.php
require_once 'database.php';
$articles = [];
$errorMessage = '';
try {
$sql = "
SELECT
bv.MaBV,
bv.TieuDe,
bv.NoiDung,
bv.DM,
dm.TenDM,
dm.TrangThai
FROM BaiViet AS bv
INNER JOIN DanhMuc AS dm
ON bv.DM = dm.MaDM
ORDER BY bv.MaBV DESC
";
$stmt = $pdo->query($sql);
$articles = $stmt->fetchAll();
} catch (PDOException $e) {
error_log($e->getMessage());
$errorMessage =
'Không thể tải danh sách bài viết.';
}