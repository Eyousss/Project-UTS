<?php
include '../security.php';
include '../../koneksi.php';

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
    <title>Kelola News</title>
</head>
<body>
    <h1>Kelola News</h1>
    <p><a href="../dashboard.php" class="button">Kembali ke Dashboard</a></p>

    <?php if ($created): ?><div class="message success">News berhasil ditambahkan.</div><?php endif; ?>
    <?php if ($updated): ?><div class="message success">News berhasil diperbarui.</div><?php endif; ?>
    <?php if ($deleted): ?><div class="message success">News berhasil dihapus.</div><?php endif; ?>
    <?php if ($error): ?><div class="message error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

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
                        <td><?php echo htmlspecialchars($row['image']); ?></td>
                        <td><?php echo htmlspecialchars($row['button_text']); ?><br><?php echo htmlspecialchars($row['button_url']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td>
                            <a class="button" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a class="button danger" href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Hapus news ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada news.</p>
    <?php endif; ?>
</body>
</html>
