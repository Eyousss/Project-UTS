<?php
include "../security.php";
include "../../koneksi.php";

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
        <style>
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
        <div class="alert-container">
            <div class="alert-box">
                <h2>⚠️ Akses Ditolak</h2>
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

// Ambil data semua admin
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
    <link rel="stylesheet" href="../../css/dashboard.css">
    <style>
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .content-header h1 {
            color: #333;
            font-size: 28px;
        }

        .btn-add {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .table-container {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Quicksand', sans-serif;
        }

        table thead {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        table th {
            padding: 15px;
            text-align: left;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
            color: #666;
        }

        table tbody tr:hover {
            background: #f8f9fa;
        }

        .role-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .role-owner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .role-admin {
            background: #e8f4f8;
            color: #0099cc;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-edit {
            background: #3498db;
            color: white;
        }

        .btn-edit:hover {
            background: #2980b9;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background: #c0392b;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .empty-state p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
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
                                    <a href="hapus.php?id=<?php echo $admin['id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus admin ini?')">Hapus</a>
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
