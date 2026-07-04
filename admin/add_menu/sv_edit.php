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
$link = trim($_POST['link'] ?? '');

if ($id <= 0 || $name === '' || !in_array($category, ['makanan','minuman'], true)) {
    header('Location: edit.php?id=' . $id);
    exit;
}

// Get current image
$stmt = mysqli_prepare($conn, 'SELECT image FROM menu_items WHERE id = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $current_image);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$image_path = $current_image;

// Handle file upload if provided
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = '../../assets/images/' . $category . '/';
    
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($file_ext, $allowed_ext)) {
        header('Location: edit.php?id=' . $id . '&error=' . urlencode('Format file tidak didukung'));
        exit;
    }

    if ($file_size > 5 * 1024 * 1024) {
        header('Location: edit.php?id=' . $id . '&error=' . urlencode('Ukuran file terlalu besar'));
        exit;
    }

    $new_filename = time() . '_' . sanitize_filename($name) . '.' . $file_ext;
    $image_path = 'Aset/' . $category . '/' . $new_filename;
    $full_path = $upload_dir . $new_filename;

    if (!move_uploaded_file($file_tmp, $full_path)) {
        header('Location: edit.php?id=' . $id . '&error=' . urlencode('Gagal mengunggah file'));
        exit;
    }

    // Delete old image if it exists and is different
    if ($current_image && $current_image !== $image_path && file_exists('../../' . $current_image)) {
        unlink('../../' . $current_image);
    }
}

$query = 'UPDATE menu_items SET name = ?, category = ?, image = ?, link = ? WHERE id = ?';
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ssssi', $name, $category, $image_path, $link, $id);

if (mysqli_stmt_execute($stmt)) {
    header('Location: index.php?updated=1');
    exit;
}

header('Location: edit.php?id=' . $id);
exit;

function sanitize_filename($filename) {
    $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
    return strtolower($filename);
}

