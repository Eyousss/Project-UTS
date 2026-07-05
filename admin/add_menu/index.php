<?php
include '../security.php';
include '../../koneksi.php';

$deleted = isset($_GET['deleted']) && $_GET['deleted'] === '1';
$updated = isset($_GET['updated']) && $_GET['updated'] === '1';
$success = isset($_GET['success']) && $_GET['success'] === '1';
$error = isset($_GET['error']) ? $_GET['error'] : '';
$page_css = '../../assets/css/add_menu.css';

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manajemen Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/navbar_admin.css">
    <link rel="stylesheet" href="../../assets/css/admin_management.css">
    <link rel="stylesheet" href="../../assets/css/add_menu.css">
</head>
<body>

    <nav class="navbar">
        <a href="../../admin/dashboard.php" class="logo-text">noma</a>
        <span class="admin-label">Menu Panel</span>
    </nav>
    <div class="wrapper">
        <a href="../dashboard.php" class="back-link">← Kembali ke Dashboard</a>

        <div class="content-header">
            <div>
                <h1>Manajemen Menu</h1>
            </div>
        </div>
        
        <div class="table-container">

        <?php if ($success): ?><div class="alert success">Menu berhasil disimpan ke database.</div><?php endif; ?>
        <?php if ($error): ?><div class="alert error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
        <?php if ($deleted): ?><div class="alert success">Menu berhasil dihapus.</div><?php endif; ?>
        <?php if ($updated): ?><div class="alert success">Menu berhasil diupdate.</div><?php endif; ?>

        <fieldset>
            <legend>Tambah Menu Baru</legend>
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

                <button type="submit" name="save">Simpan Menu</button>
            </form>
        </fieldset>

        <h2>Daftar Menu</h2>
        <?php
        $query = "SELECT id, name, category, image, link FROM menu_items ORDER BY id DESC";
        $res = mysqli_query($conn, $query);

        if ($res && mysqli_num_rows($res) > 0):
        ?>
            <table>
                <thead>
                    <tr><th>No</th><th>Nama</th><th>Kategori</th><th>Gambar</th><th>Aksi</th></tr>
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
                        <td>
                            <div class="action-buttons">
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Hapus menu ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <p>Tidak ada menu.</p>
            </div>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>