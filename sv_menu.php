<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? 'makanan');
    $image = trim($_POST['image'] ?? '');
    $link = trim($_POST['link'] ?? '');

    if ($name === '' || $image === '' || !in_array($category, ['makanan', 'minuman'], true)) {
        $error = 'Nama menu, kategori, dan path gambar wajib diisi.';
        header('Location: admin/add_menu/index.php?error=' . urlencode($error));
        exit;
    }

    $query = "INSERT INTO menu_items (name, category, image, link) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssss', $name, $category, $image, $link);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: admin/add_menu/index.php?success=1');
        exit;
    }

    $error = 'Gagal menyimpan menu: ' . mysqli_error($conn);
    header('Location: admin/add_menu/index.php?error=' . urlencode($error));
    exit;
}

header('Location: admin/add_menu/index.php');
exit;
