<?php
include "../security.php";
include "../../koneksi.php";

$success = isset($_GET['success']) ? $_GET['success'] : '';
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
        <link rel="stylesheet" href="../../css/dashboard.css">
    </head>
    <body>
        <div class="alert-container">
            <div class="alert-box">
                <h2>Akses Ditolak!!!</h2>
                <p>Maaf, Anda tidak bisa mengakses halaman ini. Hanya owner yang dapat mengelola admin.</p>
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

$query = "SELECT id, username, role FROM users ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$admins = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Admin - Noma Coffee & Taichan</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/navbar_admin.css">
    <link rel="stylesheet" href="../../assets/css/admin_management.css">
</head>
<body>

<nav class="navbar">
    <a href="#" class="logo-text">noma</a>
    <span class="admin-label">Admin Panel</span>
</nav>

<div class="wrapper">
    <a href="../dashboard.php" class="back-link">← Kembali ke Dashboard</a>

    <div class="content-header">
        <div>
            <h1>Kelola Admin</h1>
        </div>
        <a href="add_admin.php" class="btn-add">+ Tambah Admin</a>
    </div>

    <div class="table-container">
        <?php if ($success === 'added'): ?>
            <div class="alert success">Admin baru berhasil ditambahkan.</div>
        <?php elseif ($success === 'updated'): ?>
            <div class="alert success">Admin berhasil diperbarui.</div>
        <?php elseif ($success === 'deleted'): ?>
            <div class="alert success">Admin berhasil dihapus.</div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (count($admins) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($admin['username']); ?></td>
                            <td>
                                <span class="role-badge role-<?php echo $admin['role']; ?>">
                                    <?php echo ucfirst($admin['role']); ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="edit.php?id=<?php echo $admin['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="hapus.php?id=<?php echo $admin['id']; ?>" class="btn-delete">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <p>Tidak ada data admin</p>
                <a href="add_admin.php" class="btn-add">+ Tambah Admin</a>
            </div>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
