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
        <style>
            body {
                margin: 0;
                padding: 20px;
                font-family: 'Quicksand', sans-serif;
                background: #f5f5f5;
            }
            .alert-container {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .alert-box {
                background: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
                text-align: center;
                max-width: 400px;
            }
            .alert-box h2 {
                color: #e74c3c;
                margin-bottom: 20px;
                font-size: 24px;
            }
            .alert-box p {
                color: #666;
                margin-bottom: 30px;
                font-size: 16px;
            }
            .alert-box a {
                display: inline-block;
                background: #667eea;
                color: white;
                padding: 10px 30px;
                border-radius: 5px;
                text-decoration: none;
                transition: background 0.3s;
            }
            .alert-box a:hover {
                background: #764ba2;
            }
        </style>
    </head>
    <body>
        <script>
            alert('Maaf, Anda tidak bisa mengakses halaman ini.');
            window.location.href = "../dashboard.php";
        </script>
    </body>
    </html>
    <?php
    exit;
}

// Ambil data admin berdasarkan ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = "SELECT id, username, role FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

if (!$admin) {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Tidak Ditemukan</title>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="alert-container">
            <div class="alert-box">
                <h2>❌ Data Tidak Ditemukan</h2>
                <p>Admin yang Anda cari tidak ditemukan dalam database.</p>
                <a href="index.php">Kembali ke Daftar Admin</a>
            </div>
        </div>
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
    <title>Edit Admin - Noma Coffee & Taichan</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/admin_management.css">
    <link rel="stylesheet" href="../../assets/css/navbar_admin.css">
</head>
<body>

<nav class="navbar">
    <a href="../../admin/dashboard.php" class="logo-text">noma</a>
    <span class="admin-label">Admin Panel</span>
</nav>

<div class="wrapper">
    <a href="index.php" class="back-link">← Kembali ke Kelola Admin</a>

    <div class="form-container">
        <h1>Edit Admin</h1>
        <?php if ($error): ?>
            <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="sv_admin.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">

            <div class="form-group">
                <label for="username">Username</label> 
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required placeholder="Masukkan username">
                <div class="password-note" style="margin-top: 8px;">
                    Ubah bagian ini jika ingin mengganti nama admin
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password (kosongkan jika tidak ingin diubah)</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password baru (opsional)">
                <div class="password-note">
                    Biarkan kosong jika Anda tidak ingin mengubah password
                </div>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="admin" <?php echo $admin['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="owner" <?php echo $admin['role'] === 'owner' ? 'selected' : ''; ?>>Owner</option>
                </select>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-submit">Simpan Perubahan</button>
                <a href="index.php" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>

</div>

</body>
</html>
