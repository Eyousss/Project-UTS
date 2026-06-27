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
    <link rel="stylesheet" href="../css/navbar_dashboard.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
 
<nav class="navbar">
    <a href="#" class="logo-text">noma</a>
    <span class="admin-label">Admin Panel</span>
</nav>
 
<div class="wrapper">
 
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
            <h3>Manajemen News</h3>
            <p>Tambah, edit, dan hapus berita di halaman pembaruan</p>
            <a href="add_news/index.php">Kelola News</a>
        </div>
    </div>
 
    <div class="logout-section">
        <a href="../logout.php" class="logout-btn">⎋ Logout</a>
    </div>
 
</div>
 
</body>
</html>