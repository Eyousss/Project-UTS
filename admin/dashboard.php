<?php
include "security.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Noma Coffee & Taichan</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar_admin.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>
 
<nav class="navbar">
    <a href="../index.php" class="logo-text">noma</a>
    <span class="admin-label">Admin Panel</span>
</nav>
 
<div class="wrapper">
 
    <?php
    $success = isset($_GET['success']) ? $_GET['success'] : '';
    if ($success === 'added') {
        echo '<div class="notification success">✓ Admin baru berhasil ditambahkan</div>';
    } elseif ($success === 'updated') {
        echo '<div class="notification success">✓ Admin berhasil diperbarui</div>';
    } elseif ($success === 'deleted') {
        echo '<div class="notification success">✓ Admin berhasil dihapus</div>';
    }
    ?>

    <div class="welcome-card">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang kembali, <strong><?php echo htmlspecialchars($username); ?></strong></p>
    </div>
    <div class="nav-menu">
        <div class="nav-card">
            <h3>Manajemen Menu</h3>
            <p>Tambah, edit, dan hapus item menu restoran</p>
            <a href="add_menu/index.php">Kelola Menu</a>
        </div>
        <div class="nav-card">
            <h3>Manajemen Galeri</h3>
            <p>Tambah, edit, dan hapus foto galeri restoran</p>
            <a href="add_gallery/index.php">Kelola Galeri</a>
        </div>
        <div class="nav-card">
            <h3>Manajemen News</h3>
            <p>Tambah, edit, dan hapus berita di halaman pembaruan</p>
            <a href="add_news/index.php">Kelola News</a>
        </div>
        <div class="nav-card">
            <h3>Kelola Admin</h3>
            <p>Kelola akun admin dan owner (hanya owner yang dapat mengakses)</p>
            <a href="kelola_admin/index.php">Kelola Admin</a>
        </div>
        <div class="nav-card">
            <h3>Feedback Pengunjung</h3>
            <p>Lihat dan kelola feedback dari pengunjung</p>
            <a href="save_feedback/index.php">Kelola Feedback</a>
    </div>
    
    <div class="logout-section">
        <a href="logout.php" class="logout-btn">⎋ Logout</a>
    </div>
 
</div>
 
</body>
</html>