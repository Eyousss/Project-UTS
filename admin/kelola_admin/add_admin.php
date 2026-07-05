<?php
include "../security.php";
include "../../koneksi.php";

$error = isset($_GET['error']) ? $_GET['error'] : '';

// Cek apakah user adalah owner
if ($role !== 'owner') {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Akses Ditolak</title>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="alert-container">
            <div class="alert-box">
                <h2>⚠️ Akses Ditolak</h2>
                <p>Maaf, Anda tidak bisa mengakses halaman ini. Hanya owner yang dapat menambah admin.</p>
                <a href="../dashboard.php">Kembali ke Dashboard</a>
            </div>
        </div>
        <script>
            alert('Maaf tidak bisa mengakses');
        </script>
    </body>
    </html>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin - Noma Coffee & Taichan</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/admin_management.css">
    <link rel="stylesheet" href="../../assets/css/navbar_admin.css">
</head>
<body>

<nav class="navbar">
    <a href="#" class="logo-text">noma</a>
    <span class="admin-label">Admin Panel</span>
</nav>

<div class="wrapper">
    <a href="index.php" class="back-link">← Kembali ke Kelola Admin</a>

    <div class="form-container">
        <h1>Tambah Admin Baru</h1>
        <?php if ($error): ?>
            <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="sv_admin.php" method="POST">
            <input type="hidden" name="action" value="add">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required placeholder="Masukkan username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan password">
                <div class="password-note">
                    Pastikan password yang Anda buat aman dan mudah diingat
                </div>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="owner">Owner</option>
                </select>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-submit">Simpan</button>
                <a href="index.php" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>

</div>

</body>
</html>
