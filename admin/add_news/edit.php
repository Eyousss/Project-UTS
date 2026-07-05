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
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/navbar_admin.css">
    <link rel="stylesheet" href="../../assets/css/admin_management.css">
    <link rel="stylesheet" href="../../assets/css/add_news.css">
    <title>Edit News</title>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="logo-text">noma</a>
        <span class="admin-label">News Panel</span>
    </nav>
    <div class="wrapper">
        <a href="index.php" class="back-link">← Kembali ke Daftar News</a>

        <div class="content-header">
            <div>
                <h1>Edit News</h1>
            </div>
        </div>

        <div class="table-container">
            <fieldset>
                <legend>Edit News</legend>
                <form action="sv_news.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?php echo $news['id']; ?>">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($news['title']); ?>" required>
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" required><?php echo htmlspecialchars($news['description']); ?></textarea>
                    <?php if (!empty($news['image'])): ?>
                        <p>Gambar saat ini:</p>

                        <img src="../../<?php echo str_replace('\\', '/', htmlspecialchars($news['image'])); ?>"alt="<?php echo htmlspecialchars($news['title']); ?>"class="current-image">
                    <?php endif; ?>
                    <label for="image">Gambar Baru</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <label for="button_text">Teks Tombol</label>
                    <input type="text" id="button_text" name="button_text" value="<?php echo htmlspecialchars($news['button_text']); ?>">
                    <label for="button_url">URL Tombol</label>
                    <input type="text" id="button_url" name="button_url" value="<?php echo htmlspecialchars($news['button_url']); ?>">
                    <button type="submit">Simpan Perubahan</button>
                </form>
            </fieldset>
        </div>
    </div>
</body>
</html>
