<?php
include '../security.php';
include '../../koneksi.php';

$id = intval($_GET['id'] ?? 0);
if (!$id) {
    header('Location: index.php');
    exit;
}

$sql = "DELETE FROM news WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    header('Location: index.php?deleted=1');
    exit;
}

header('Location: index.php?error=' . urlencode('Gagal menghapus news.'));
exit;
