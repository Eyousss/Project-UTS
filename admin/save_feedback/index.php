<?php
include '../security.php';
require_once __DIR__ . '/../../koneksi.php';

$deleted = isset($_GET['deleted']) && $_GET['deleted'] === '1';
$success = isset($_GET['success']) && $_GET['success'] === '1';
$error = isset($_GET['error']) ? $_GET['error'] : '';

$query = "SELECT id, service_rating, menu_rating, email, message, created_at FROM feedback ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
$feedbacks = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Feedback</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/navbar_admin.css">
    <link rel="stylesheet" href="../../assets/css/admin_management.css">
</head>
<body>
    <nav class="navbar">
        <a href="../../admin/dashboard.php" class="logo-text">noma</a>
        <span class="admin-label">Feedback Panel</span>
    </nav>
    <div class="wrapper">
        <a href="../dashboard.php" class="back-link">← Kembali ke Dashboard</a>

        <div class="content-header">
            <div>
                <h1>Feedback Pengunjung</h1>
            </div>
        </div>

        <?php if ($success): ?><div class="alert success">Feedback berhasil dihapus.</div><?php endif; ?>
        <?php if ($error): ?><div class="alert error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

        <div class="table-container">
            <?php if (count($feedbacks) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pelayanan</th>
                            <th>Menu</th>
                            <th>Email</th>
                            <th>Pesan</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($feedbacks as $feedback): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo (int)$feedback['service_rating']; ?></td>
                                <td><?php echo (int)$feedback['menu_rating']; ?></td>
                                <td><?php echo htmlspecialchars($feedback['email']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($feedback['message'])); ?></td>
                                <td><?php echo htmlspecialchars($feedback['created_at']); ?></td>
                                <td>
                                    <a href="hapus.php?id=<?php echo (int)$feedback['id']; ?>" class="btn-delete" onclick="return confirm('Hapus feedback ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    <p>Tidak ada feedback.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
