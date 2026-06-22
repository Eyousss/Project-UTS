<?php
include '../security.php';
include '../../koneksi.php';

$deleted = isset($_GET['deleted']) && $_GET['deleted'] === '1';
$updated = isset($_GET['updated']) && $_GET['updated'] === '1';
$success = isset($_GET['success']) && $_GET['success'] === '1';
$error = isset($_GET['error']) ? $_GET['error'] : '';

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manajemen Menu</title>
    <style>table{border-collapse:collapse;width:100%}td,th{border:1px solid #ccc;padding:8px;text-align:left}a.button{display:inline-block;padding:6px 10px;background:#2d89ef;color:#fff;text-decoration:none;border-radius:4px}</style>
</head>
<body>
    <h1>Manajemen Menu</h1>
    <p><a class="button" href="#add-form">Tambah Menu Baru</a> <a href="../dashboard.php">Kembali ke Dashboard</a></p>

    <?php if ($success): ?><p style="color:green">Menu berhasil disimpan ke database.</p><?php endif; ?>
    <?php if ($error): ?><p style="color:red"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
    <?php if ($deleted): ?><p style="color:green">Menu berhasil dihapus.</p><?php endif; ?>
    <?php if ($updated): ?><p style="color:green">Menu berhasil diupdate.</p><?php endif; ?>

    <section id="add-form">
        <h2>Tambah Menu Baru</h2>
        <form action="../../sv_menu.php" method="post">
            <label for="name">Nama Menu</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama menu" required>

            <label for="category">Kategori</label>
            <select id="category" name="category" required>
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
            </select>

            <label for="image">Path Gambar</label>
            <input type="text" id="image" name="image" placeholder="Contoh: ./Aset/makanan/nasi-bakar.png" required>

            <label for="link">Link Pesanan / Detail</label>
            <input type="url" id="link" name="link" placeholder="https://..." value="" >

            <button type="submit" name="save">Simpan Menu</button>
        </form>
    </section>
    <br>
    <?php
    $query = "SELECT id, name, category, image, link FROM menu_items ORDER BY id DESC";
    $res = mysqli_query($conn, $query);

    if ($res && mysqli_num_rows($res) > 0):
    ?>
        <table>
            <thead>
                <tr><th>ID</th><th>Nama</th><th>Kategori</th><th>Gambar</th><th>Link</th><th>Aksi</th></tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo htmlspecialchars($row['image']); ?></td>
                    <td><?php echo htmlspecialchars($row['link']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Hapus menu ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada menu.</p>
    <?php endif; ?>
</body>
</html>
