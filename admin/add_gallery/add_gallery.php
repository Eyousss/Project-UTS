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
    $section = max(1, (int)($_POST['section'] ?? 1));
    $section_name = null;

    if (isset($_POST['section']) && $_POST['section'] === 'new') {
        $section_result = mysqli_query($conn, 'SELECT MAX(section) AS max_section FROM gallery_items');
        $section_row = $section_result ? mysqli_fetch_assoc($section_result) : null;
        $section = $section_row && isset($section_row['max_section']) ? ((int)$section_row['max_section'] + 1) : 4;
        $section_name = trim($_POST['new_section_name'] ?? '');
        if ($section_name === '') {
            $error = 'Nama section baru wajib diisi.';
            header('Location: index.php?error=' . urlencode($error));
            exit;
        }
    }

    if ($title === '') {
        $error = 'Judul foto wajib diisi.';
        header('Location: index.php?error=' . urlencode($error));
        exit;
    }

    $position = 'right';
    if (isset($_POST['position']) && in_array($_POST['position'], ['left', 'right'], true)) {
        $position = $_POST['position'];
    }

    $image_path = '';
    $full_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../assets/images/upload_image/';

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
        $image_path = 'assets/images/upload_image/' . $new_filename;
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

    $stmt = mysqli_prepare($conn, 'INSERT INTO gallery_items (title, image, section, section_name, position) VALUES (?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'ssiss', $title, $image_path, $section, $section_name, $position);

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