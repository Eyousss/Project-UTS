<?php
include '../security.php';
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$title = mysqli_real_escape_string($conn, trim($_POST['title'] ?? ''));
description = mysqli_real_escape_string($conn, trim($_POST['description'] ?? ''));
$image = mysqli_real_escape_string($conn, trim($_POST['image'] ?? ''));
$button_text = mysqli_real_escape_string($conn, trim($_POST['button_text'] ?? 'View More'));
$button_url = mysqli_real_escape_string($conn, trim($_POST['button_url'] ?? '#'));

if (!$title || !$description) {
    header('Location: index.php?error=' . urlencode('Judul dan deskripsi wajib diisi.'));
    exit;
}

$sql = "INSERT INTO news (title, description, image, button_text, button_url) VALUES ('$title', '$description', '$image', '$button_text', '$button_url')";
if (mysqli_query($conn, $sql)) {
    header('Location: index.php?created=1');
    exit;
}

header('Location: index.php?error=' . urlencode('Gagal menyimpan news.'));
exit;
