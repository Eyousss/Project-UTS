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
    <link rel="stylesheet" href="../../css/dashboard.css">
    <style>
        .form-container {
            max-width: 500px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 30px 0;
        }

        .form-container h1 {
            color: #333;
            margin-bottom: 25px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: 'Quicksand', sans-serif;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group select {
            cursor: pointer;
        }

        .form-buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-cancel {
            background: #e8eef7;
            color: #667eea;
            text-decoration: none;
        }

        .btn-cancel:hover {
            background: #d0dce8;
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

        .password-note {
            background: #e8f4f8;
            border-left: 4px solid #0099cc;
            padding: 10px 12px;
            border-radius: 4px;
            font-size: 13px;
            color: #0099cc;
            margin-top: 5px;
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

    <div class="form-container">
        <h1>Tambah Admin Baru</h1>
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
                    💡 Pastikan password yang Anda buat aman dan mudah diingat
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
