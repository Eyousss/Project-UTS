<?php
include "../security.php";
include "../../koneksi.php";

if ($role !== 'owner') {
    header("Location: index.php?error=" . urlencode('Akses ditolak. Hanya owner yang dapat menghapus admin.'));
    exit;
}

$id = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
} else {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
}

if ($id <= 0) {
    header("Location: index.php?error=" . urlencode('ID admin tidak valid.'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = mysqli_prepare($conn, 'DELETE FROM users WHERE id = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($success) {
        header("Location: index.php?success=deleted");
        exit;
    }

    header("Location: index.php?error=" . urlencode('Gagal menghapus admin.'));
    exit;
}

$stmt = mysqli_prepare($conn, 'SELECT username, role FROM users WHERE id = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $username, $user_role);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if (!$username) {
    header("Location: index.php?error=" . urlencode('Admin tidak ditemukan.'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Admin - Noma Coffee & Taichan</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/navbar_admin.css">>
    <style>
        .confirmation-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,.12);
            padding: 30px;
            max-width: 520px;
            margin: 40px auto;
        }
        .confirmation-card h1 {
            margin-top: 0;
        }
        .confirmation-card .info-row {
            display: flex;
            justify-content: space-between;
            margin: 12px 0;
            padding: 12px 14px;
            background: #f8f9fb;
            border-radius: 8px;
        }
        .confirmation-card .warning-box {
            margin: 24px 0;
            padding: 16px;
            border-radius: 10px;
            background: #fff4f4;
            color: #a12020;
            border: 1px solid #f5c6cb;
        }
        .form-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .btn-submit {
            background: #d62828;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
        }
        .btn-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            border: 1px solid #ccc;
            color: #333;
            background: white;
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

    <div class="confirmation-card">
        <h1>Konfirmasi Hapus Admin</h1>
        <p>Apakah Anda yakin ingin menghapus admin ini? Tindakan ini tidak dapat dibatalkan.</p>

        <div class="info-row">
            <strong>Username</strong>
            <span><?php echo htmlspecialchars($username); ?></span>
        </div>
        <div class="info-row">
            <strong>Role</strong>
            <span><?php echo ucfirst(htmlspecialchars($user_role)); ?></span>
        </div>

        <div class="warning-box">
            <strong>Perhatian:</strong> Jika Anda memilih "Ya", akun admin ini akan langsung dihapus dari sistem.
        </div>

        <form method="POST" action="hapus.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-buttons">
                <button type="submit" class="btn-submit">Ya, hapus akun ini</button>
                <a href="index.php" class="btn-cancel">Tidak, batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>