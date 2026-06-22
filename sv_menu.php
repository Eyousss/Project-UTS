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
    $link = trim($_POST['link'] ?? '');

    if ($name === '' || !in_array($category, ['makanan', 'minuman'], true)) {
        $error = 'Nama menu dan kategori wajib diisi.';
        header('Location: admin/add_menu/index.php?error=' . urlencode($error));
        exit;
    }

    // Handle file upload
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'Aset/' . $category . '/';
        
        // Pastikan folder upload ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validasi file
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($file_ext, $allowed_ext)) {
            $error = 'Format file tidak didukung. Gunakan: JPG, PNG, GIF, WebP';
            header('Location: admin/add_menu/index.php?error=' . urlencode($error));
            exit;
        }

        if ($file_size > 5 * 1024 * 1024) { // 5MB max
            $error = 'Ukuran file terlalu besar. Maksimal 5MB.';
            header('Location: admin/add_menu/index.php?error=' . urlencode($error));
            exit;
        }

        // Generate nama file unik
        $new_filename = time() . '_' . sanitize_filename($name) . '.' . $file_ext;
        $image_path = $upload_dir . $new_filename;

        if (!move_uploaded_file($file_tmp, $image_path)) {
            $error = 'Gagal mengunggah file.';
            header('Location: admin/add_menu/index.php?error=' . urlencode($error));
            exit;
        }
    } else {
        $error = 'Foto menu wajib diunggah.';
        header('Location: admin/add_menu/index.php?error=' . urlencode($error));
        exit;
    }

    $query = "INSERT INTO menu_items (name, category, image, link) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssss', $name, $category, $image_path, $link);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: admin/add_menu/index.php?success=1');
        exit;
    }

    // Hapus file jika insert gagal
    if (file_exists($image_path)) {
        unlink($image_path);
    }

    $error = 'Gagal menyimpan menu: ' . mysqli_error($conn);
    header('Location: admin/add_menu/index.php?error=' . urlencode($error));
    exit;
}

// Helper function untuk sanitasi nama file
function sanitize_filename($filename) {
    $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
    return strtolower($filename);
}

header('Location: admin/add_menu/index.php');
exit;
