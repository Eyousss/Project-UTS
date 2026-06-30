<?php
include '../security.php';
include '../../koneksi.php';

$id = intval($_GET['id'] ?? 0);
if (!$id) {
    header('Location: index.php');
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM news WHERE id=$id LIMIT 1");
$news = $query ? mysqli_fetch_assoc($query) : null;
if (!$news) {
    header('Location: index.php?error=' . urlencode('News tidak ditemukan.'));
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit News</title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif;margin:20px}
        label{display:block;margin-top:10px;font-weight:600}
        input, textarea{width:100%;padding:8px;margin-top:4px;border:1px solid #ccc;border-radius:4px}
        textarea{min-height:120px;resize:vertical}
        button, a.button{display:inline-block;padding:8px 12px;background:#2d89ef;color:#fff;text-decoration:none;border:none;border-radius:4px;cursor:pointer}
        button:hover, a.button:hover{background:#1a5fb4}
    </style>
</head>
<body>
    <h1>Edit News</h1>
    <p><a href="index.php" class="button">Kembali</a></p>
    <form action="sv_edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $news['id']; ?>">
        <label for="title">Judul</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($news['title']); ?>" required>
        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($news['description']); ?></textarea>
        <label for="image">Gambar Baru</label>
        <input type="file" id="image" name="image" accept="image/*">
        <?php if (!empty($news['image'])): ?>
            <p>Gambar saat ini: <strong><?php echo htmlspecialchars($news['image']); ?></strong></p>
        <?php endif; ?>
        <label for="button_text">Teks Tombol</label>
        <input type="text" id="button_text" name="button_text" value="<?php echo htmlspecialchars($news['button_text']); ?>">
        <label for="button_url">URL Tombol</label>
        <input type="text" id="button_url" name="button_url" value="<?php echo htmlspecialchars($news['button_url']); ?>">
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
