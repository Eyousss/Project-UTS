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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $title = trim($_POST['title'] ?? '');

    if ($title === '') {
        $error = 'Judul foto wajib diisi.';
        header('Location: index.php?error=' . urlencode($error));
        exit;
    }

    $image_path = '';
    $full_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../Aset/upload_image/';

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($file_ext, $allowed_ext)) {
            $error = 'Format file tidak didukung.';
            header('Location: index.php?error=' . urlencode($error));
            exit;
        }

        if ($file_size > 5 * 1024 * 1024) {
            $error = 'Ukuran file terlalu besar. Maksimal 5MB.';
            header('Location: index.php?error=' . urlencode($error));
            exit;
        }

        $new_filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($title)) . '.' . $file_ext;
        $image_path = 'Aset/upload_image/' . $new_filename;
        $full_path = $upload_dir . $new_filename;

        if (!move_uploaded_file($file_tmp, $full_path)) {
            $error = 'Gagal mengunggah file.';
            header('Location: index.php?error=' . urlencode($error));
            exit;
        }
    } else {
        $error = 'Foto wajib diunggah.';
        header('Location: index.php?error=' . urlencode($error));
        exit;
    }

    $stmt = mysqli_prepare($conn, 'INSERT INTO gallery_items (title, image) VALUES (?, ?)');
    mysqli_stmt_bind_param($stmt, 'ss', $title, $image_path);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php?success=1');
        exit;
    }

    if ($full_path !== '' && file_exists($full_path)) {
        unlink($full_path);
    }

    $error = 'Gagal menyimpan galeri: ' . mysqli_error($conn);
    header('Location: index.php?error=' . urlencode($error));
    exit;
}

header('Location: index.php');
exit;
