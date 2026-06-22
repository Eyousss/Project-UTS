<?php
include '../security.php';
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update'])) {
    header('Location: index.php');
    exit;
}

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$name = trim($_POST['name'] ?? '');
$category = trim($_POST['category'] ?? 'makanan');
$image = trim($_POST['image'] ?? '');
$link = trim($_POST['link'] ?? '');

if ($id <= 0 || $name === '' || $image === '' || !in_array($category, ['makanan','minuman'], true)) {
    header('Location: edit.php?id=' . $id);
    exit;
}

$query = 'UPDATE menu_items SET name = ?, category = ?, image = ?, link = ? WHERE id = ?';
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ssssi', $name, $category, $image, $link, $id);
if (mysqli_stmt_execute($stmt)) {
    header('Location: index.php?updated=1');
    exit;
}

header('Location: edit.php?id=' . $id);
exit;
