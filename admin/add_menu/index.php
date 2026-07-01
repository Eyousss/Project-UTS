<?php
include '../security.php';
include '../../koneksi.php';

$deleted = isset($_GET['deleted']) && $_GET['deleted'] === '1';
$updated = isset($_GET['updated']) && $_GET['updated'] === '1';
$success = isset($_GET['success']) && $_GET['success'] === '1';
$error = isset($_GET['error']) ? $_GET['error'] : '';
$page_css = '../../css/add_menu.css';

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manajemen Menu</title>
    <link rel="stylesheet" href="<?php echo $page_css; ?>">
</head>
<body>
    <div class="container">
        <h1 class="page-title">Manajemen Menu</h1>
        <p><a class="back-link" href="../dashboard.php">Kembali ke Dashboard</a></p>

        <?php if ($success): ?><p class="alert alert-success">Menu berhasil disimpan ke database.</p><?php endif; ?>
        <?php if ($error): ?><p class="alert alert-error"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
        <?php if ($deleted): ?><p class="alert alert-success">Menu berhasil dihapus.</p><?php endif; ?>
        <?php if ($updated): ?><p class="alert alert-success">Menu berhasil diupdate.</p><?php endif; ?>

        <section id="add-form" class="card">
            <h2>Tambah Menu Baru</h2>
            <form action="../../sv_menu.php" method="post" enctype="multipart/form-data">
                <label for="name">Nama Menu</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama menu" required>

                <label for="category">Kategori</label>
                <select id="category" name="category" required>
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                </select>

                <label for="image">Gambar</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <label for="link">Link Pesanan / Detail</label>
                <input type="text" id="link" name="link" value="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS" readonly>
                <p class="helper-text">Link ini otomatis dipakai untuk semua menu.</p>

                <button type="submit" name="save">Simpan Menu</button>
            </form>
        </section>

        <?php
        $query = "SELECT id, name, category, image, link FROM menu_items ORDER BY id DESC";
        $res = mysqli_query($conn, $query);

        if ($res && mysqli_num_rows($res) > 0):
        ?>
            <div class="card">
                <table>
                    <thead>
                        <tr><th>No</th><th>Nama</th><th>Kategori</th><th>Gambar</th><th>Link</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['category']); ?></td>
                            <?php $imageSrc = htmlspecialchars($row['image']); ?>
                            <?php if ($imageSrc && strpos($imageSrc, 'http') !== 0 && $imageSrc[0] !== '/'): ?>
                                <?php $imageSrc = '../../' . $imageSrc; ?>
                            <?php endif; ?>
                            <td><img src="<?php echo $imageSrc; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>"></td>
                            <td><?php echo htmlspecialchars($row['link']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Hapus menu ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="empty-state">Tidak ada menu.</p>
        <?php endif; ?>
    </div>
</body>
</html>
