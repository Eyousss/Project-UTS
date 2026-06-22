<?php
include '../security.php';
include '../../koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];
$stmt = mysqli_prepare($conn, 'SELECT id, name, category, image, link FROM menu_items WHERE id = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $rid, $rname, $rcat, $rimg, $rlink);
mysqli_stmt_fetch($stmt);

if (!$rid) {
    header('Location: index.php');
    exit;
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Menu</title>
    <style>label{display:block;margin-top:8px}input[type=text],input[type=file],select{width:100%;padding:6px}img{max-width:150px;max-height:150px;margin-top:10px}</style>
</head>
<body>
    <h1>Edit Menu</h1>
    <form action="sv_edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $rid; ?>">
        <label>Nama Menu
            <input type="text" name="name" value="<?php echo htmlspecialchars($rname); ?>" required>
        </label>
        <label>Kategori
            <select name="category" required>
                <option value="makanan" <?php echo $rcat === 'makanan' ? 'selected' : ''; ?>>Makanan</option>
                <option value="minuman" <?php echo $rcat === 'minuman' ? 'selected' : ''; ?>>Minuman</option>
            </select>
        </label>
        <label>Gambar Sekarang
            <br><img src="../../<?php echo htmlspecialchars($rimg); ?>" alt="<?php echo htmlspecialchars($rname); ?>">
        </label>
        <label>Ganti Gambar (Opsional)
            <input type="file" name="image" accept="image/*">
            <small>Biarkan kosong jika tidak ingin mengganti gambar</small>
        </label>
        <label>Link
            <input type="text" name="link" value="<?php echo htmlspecialchars($rlink); ?>">
        </label>
        <button type="submit" name="update">Simpan Perubahan</button>
    </form>
    <p><a href="index.php">Kembali</a></p>
</body>
</html>
