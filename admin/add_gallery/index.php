<?php
include '../security.php';
$koneksi_path = __DIR__ . '/../../koneksi.php';
if (file_exists($koneksi_path)) {
    include $koneksi_path;
}

if (!isset($conn) || !($conn instanceof mysqli)) {
    $conn = mysqli_connect('localhost', 'root', '', 'backend_noma');
    mysqli_set_charset($conn, 'utf8');
}

$success = isset($_GET['success']) && $_GET['success'] === '1';
$error = isset($_GET['error']) ? $_GET['error'] : '';

$gallery_items = [];
$gallery_query = mysqli_query($conn, "SELECT id, title, image, created_at FROM gallery_items ORDER BY id DESC");
if ($gallery_query) {
    while ($row = mysqli_fetch_assoc($gallery_query)) {
        $gallery_items[] = $row;
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manajemen Galeri</title>
    <style>
        body{font-family:Arial,sans-serif;padding:20px;line-height:1.5}
        form{max-width:500px;padding:16px;border:1px solid #ddd;border-radius:8px;background:#fafafa}
        input, button{display:block;width:100%;margin:10px 0;padding:8px}
        button{background:#2d89ef;color:#fff;border:none;border-radius:4px;cursor:pointer}
        table{border-collapse:collapse;width:100%;margin-top:20px}td,th{border:1px solid #ccc;padding:8px;text-align:left}
        img{max-width:120px;max-height:120px;object-fit:cover}
    </style>
</head>
<body>
    <h1>Manajemen Galeri</h1>
    <p><a href="../dashboard.php">Kembali ke Dashboard</a></p>

    <?php if ($success): ?><p style="color:green">Foto galeri berhasil disimpan.</p><?php endif; ?>
    <?php if ($error): ?><p style="color:red"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>

    <h2>Tambah Galeri Baru</h2>
    <form action="add_gallery.php" method="post" enctype="multipart/form-data">
        <label for="title">Judul Foto</label>
        <input type="text" id="title" name="title" placeholder="Contoh: Daily Activity" required>

        <label for="image">Foto Galeri</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit" name="save">Simpan Galeri</button>
    </form>

    <h2>Daftar Galeri</h2>
    <?php if (!empty($gallery_items)): ?>
        <table>
            <thead>
                <tr><th>No</th><th>Judul</th><th>Foto</th><th>Tanggal</th></tr>
            </thead>
            <tbody>
            <?php $no = 1; foreach ($gallery_items as $item): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><img src="../../<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>"></td>
                    <td><?php echo htmlspecialchars($item['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada galeri.</p>
    <?php endif; ?>
</body>
</html>
