<?php
include '../security.php';
$koneksi_path = '../../koneksi.php';
if (file_exists($koneksi_path)) {
    include $koneksi_path;
}

if (!isset($conn) || !($conn instanceof mysqli)) {
    $conn = mysqli_connect('localhost', 'root', '', 'backend_noma');
    mysqli_set_charset($conn, 'utf8');
}

$created = isset($_GET['created']) && $_GET['created'] === '1';
$updated = isset($_GET['updated']) && $_GET['updated'] === '1';
$deleted = isset($_GET['deleted']) && $_GET['deleted'] === '1';
$error = isset($_GET['error']) ? $_GET['error'] : '';

$query = "SELECT id, title, description, image, button_text, button_url, created_at FROM news ORDER BY created_at DESC";
$res = mysqli_query($conn, $query);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/navbar_admin.css">
    <link rel="stylesheet" href="../../assets/css/admin_management.css">
    <link rel="stylesheet" href="../../assets/css/add_news.css">
    <title>Manajemen News</title>
</head>
<body>
    <nav class="navbar">
        <a href="../../admin/dashboard.php" class="logo-text">noma</a>
        <span class="admin-label">News Panel</span>
    </nav>
    <div class="wrapper">
        <a href="../dashboard.php" class="back-link">← Kembali ke Dashboard</a>

        <div class="content-header">
            <div>
                <h1>Manajemen News</h1>
            </div>
        </div>
        
        <div class="table-container">
            <?php if ($created): ?><div class="alert success">News berhasil ditambahkan.</div><?php endif; ?>
            <?php if ($updated): ?><div class="alert success">News berhasil diperbarui.</div><?php endif; ?>
            <?php if ($deleted): ?><div class="alert success">News berhasil dihapus.</div><?php endif; ?>
            <?php if ($error): ?><div class="alert error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

            <fieldset>
                <legend>Tambah News Baru</legend>
                <form action="sv_news.php" method="post" enctype="multipart/form-data">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" required>

                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" required></textarea>

                    <label for="image">Gambar</label>
                    <input type="file" id="image" name="image" accept="image/*" required>

                    <label for="button_text">Teks Tombol</label>
                    <input type="text" id="button_text" name="button_text" value="View More">

                    <label for="button_url">URL Tombol</label>
                    <input type="text" id="button_url" name="button_url" placeholder="https://...">

                    <button type="submit" name="action" value="create">Simpan News</button>
                </form>
            </fieldset>

            <h2>Daftar News</h2>
            <?php if ($res && mysqli_num_rows($res) > 0): ?>
                <table>
                    <thead>
                        <tr><th>No</th><th>Judul</th><th>Deskripsi</th><th>Gambar</th><th>Tombol</th><th>Dibuat</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($res)): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($row['description'])); ?></td>
                                <td>
                                    <img 
                                        src="../../<?php echo str_replace('\\', '/', htmlspecialchars($row['image'])); ?>" 
                                        alt="<?php echo htmlspecialchars($row['title']); ?>"
                                        class="table-img">
                                </td>
                                <td><?php echo htmlspecialchars($row['button_text']); ?><br><?php echo htmlspecialchars($row['button_url']); ?></td>
                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                                        <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Hapus news ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    <p>Belum ada news.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
