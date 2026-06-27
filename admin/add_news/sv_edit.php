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
$image = mysqli_real_escape_string($conn, trim($_POST['image'] ?? ''));
$button_text = mysqli_real_escape_string($conn, trim($_POST['button_text'] ?? 'View More'));
$button_url = mysqli_real_escape_string($conn, trim($_POST['button_url'] ?? '#'));

if (!$id || !$title || !$description) {
    header('Location: edit.php?id=' . $id . '&error=' . urlencode('Judul dan deskripsi wajib diisi.'));
    exit;
}

$sql = "UPDATE news SET title='$title', description='$description', image='$image', button_text='$button_text', button_url='$button_url' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    header('Location: index.php?updated=1');
    exit;
}

header('Location: edit.php?id=' . $id . '&error=' . urlencode('Gagal memperbarui news.'));
exit;
