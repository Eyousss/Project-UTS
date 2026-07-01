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
        <div class="alert-container">
            <div class="alert-box">
                <h2>⚠️ Akses Ditolak</h2>
                <p>Maaf, Anda tidak bisa mengakses halaman ini. Hanya owner yang dapat menghapus admin.</p>
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

// Ambil data admin
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

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete_query = "DELETE FROM users WHERE id = $id";
    if (mysqli_query($conn, $delete_query)) {
        header("Location: index.php?success=deleted");
        exit;
    } else {
        $error = "Gagal menghapus admin";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Admin - Noma Coffee & Taichan</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <style>
        .confirmation-container {
            max-width: 500px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 30px 0;
            border-left: 5px solid #e74c3c;
        }

        .confirmation-container h1 {
            color: #e74c3c;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .confirmation-container p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .admin-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
            border-left: 4px solid #3498db;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #333;
        }

        .info-value {
            color: #666;
        }

        .role-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 15px;
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

        .warning-box {
            background: #fef5e7;
            border-left: 4px solid #f39c12;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
            color: #856404;
            font-size: 14px;
            line-height: 1.6;
        }

        .warning-box strong {
            display: block;
            margin-bottom: 8px;
        }

        .form-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-submit,
        .btn-cancel {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .btn-submit {
            background: #e74c3c;
            color: white;
        }

        .btn-submit:hover {
            background: #c0392b;
        }

        .btn-cancel {
            background: #ecf0f1;
            color: #333;
            text-decoration: none;
        }

        .btn-cancel:hover {
            background: #bdc3c7;
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

        .error-message {
            background: #fadbd8;
            border-left: 4px solid #e74c3c;
            padding: 15px;
            border-radius: 5px;
            color: #a93226;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="#" class="logo-text">noma</a>
    <span class="admin-label">Admin Panel</span>
</nav>

<div class="wrapper">
    <a href="index.php" class="back-link">← Kembali ke Kelola Admin</a>

    <?php if (isset($error)): ?>
        <div class="error-message">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="confirmation-container">
        <h1>⚠️ Hapus Admin</h1>
        <p>Anda akan menghapus data admin berikut. Tindakan ini tidak dapat dibatalkan.</p>

        <div class="admin-info">
            <div class="info-row">
                <span class="info-label">Username:</span>
                <span class="info-value"><?php echo htmlspecialchars($admin['username']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Role:</span>
                <span class="info-value">
                    <span class="role-badge role-<?php echo $admin['role']; ?>">
                        <?php echo ucfirst($admin['role']); ?>
                    </span>
                </span>
            </div>
        </div>

        <div class="warning-box">
            <strong>⚠️ Perhatian!</strong>
            Menghapus admin ini akan menghapus semua data terkait dan tidak dapat dikembalikan. Pastikan Anda yakin sebelum melanjutkan.
        </div>

        <form method="POST">
            <div class="form-buttons">
                <button type="submit" class="btn-submit" onclick="return confirm('Yakin ingin menghapus admin ini? Tindakan ini tidak dapat dibatalkan.')">Hapus Admin</button>
                <a href="index.php" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>

</div>

</body>
</html>
