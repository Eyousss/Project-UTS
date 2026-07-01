<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: ../../login.php');
    exit;
}

$koneksi_path = __DIR__ . '/../../koneksi.php';
if (file_exists($koneksi_path)) {
    include $koneksi_path;
}

if (!isset($conn) || !($conn instanceof mysqli)) {
    $conn = mysqli_connect('localhost', 'root', '', 'backend_noma');
    mysqli_set_charset($conn, 'utf8');
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php?error=' . urlencode('ID galeri tidak valid.'));
    exit;
}

$result = mysqli_query($conn, "SELECT image FROM gallery_items WHERE id = $id LIMIT 1");
$imagePath = null;
if ($result && $row = mysqli_fetch_assoc($result)) {
    $imagePath = $row['image'];
}

if ($imagePath) {
    $fullPath = __DIR__ . '/../../' . $imagePath;
    if (file_exists($fullPath)) {
        @unlink($fullPath);
    }
}

mysqli_query($conn, "DELETE FROM gallery_items WHERE id = $id");
header('Location: index.php?success=1');
exit;
