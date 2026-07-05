<?php
include '../security.php';
require_once __DIR__ . '/../../koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id < 1) {
    header('Location: index.php?error=' . urlencode('ID feedback tidak valid.'));
    exit;
}

$query = 'DELETE FROM feedback WHERE id = ? LIMIT 1';
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
if (mysqli_stmt_execute($stmt)) {
    header('Location: index.php?success=1');
    exit;
}

header('Location: index.php?error=' . urlencode('Gagal menghapus feedback.'));
exit;
