<?php
include '../security.php';
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$title = mysqli_real_escape_string($conn, trim($_POST['title'] ?? ''));
$description = mysqli_real_escape_string($conn, trim($_POST['description'] ?? ''));
$button_text = mysqli_real_escape_string($conn, trim($_POST['button_text'] ?? 'View More'));
$button_url = mysqli_real_escape_string($conn, trim($_POST['button_url'] ?? '#'));

if (!$title || !$description) {
    header('Location: index.php?error=' . urlencode('Judul dan deskripsi wajib diisi.'));
    exit;
}

$uploadDir = dirname(__DIR__, 2) . '/Aset/upload_news_image';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$imagePath = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    if (!in_array($fileExt, $allowedExt, true)) {
        header('Location: index.php?error=' . urlencode('Format gambar tidak didukung.'));
        exit;
    }

    $fileName = uniqid('news_', true) . '.' . $fileExt;
    $targetFile = $uploadDir . '/' . $fileName;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        header('Location: index.php?error=' . urlencode('Gagal mengunggah gambar.'));
        exit;
    }

    $imagePath = 'Aset/upload_news_image/' . $fileName;
} else {
    header('Location: index.php?error=' . urlencode('Gambar wajib diunggah.'));
    exit;
}

$sql = "INSERT INTO news (title, description, image, button_text, button_url) VALUES ('$title', '$description', '$imagePath', '$button_text', '$button_url')";
if (mysqli_query($conn, $sql)) {
    header('Location: index.php?created=1');
    exit;
}

header('Location: index.php?error=' . urlencode('Gagal menyimpan news.'));
exit;
