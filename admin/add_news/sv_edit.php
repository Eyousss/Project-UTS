<?php
include '../security.php';
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = intval($_POST['id'] ?? 0);
$title = mysqli_real_escape_string($conn, trim($_POST['title'] ?? ''));
$description = mysqli_real_escape_string($conn, trim($_POST['description'] ?? ''));
$button_text = mysqli_real_escape_string($conn, trim($_POST['button_text'] ?? 'View More'));
$button_url = mysqli_real_escape_string($conn, trim($_POST['button_url'] ?? '#'));

if (!$id || !$title || !$description) {
    header('Location: edit.php?id=' . $id . '&error=' . urlencode('Judul dan deskripsi wajib diisi.'));
    exit;
}

$imagePath = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    if (!in_array($fileExt, $allowedExt, true)) {
        header('Location: edit.php?id=' . $id . '&error=' . urlencode('Format gambar tidak didukung.'));
        exit;
    }

    $uploadDir = dirname(__DIR__, 2) . '/assets/images/upload_news_image';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = uniqid('news_', true) . '.' . $fileExt;
    $targetFile = $uploadDir . '/' . $fileName;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        header('Location: edit.php?id=' . $id . '&error=' . urlencode('Gagal mengunggah gambar.'));
        exit;
    }

    $imagePath = 'assets/images/upload_news_image/' . $fileName;
} else {
    $existing = mysqli_query($conn, "SELECT image FROM news WHERE id=$id LIMIT 1");
    if ($existing && $row = mysqli_fetch_assoc($existing)) {
        $imagePath = $row['image'];
    }
}

$sql = "UPDATE news SET title='$title', description='$description', image='$imagePath', button_text='$button_text', button_url='$button_url' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    header('Location: index.php?updated=1');
    exit;
}

header('Location: edit.php?id=' . $id . '&error=' . urlencode('Gagal memperbarui news.'));
exit;
