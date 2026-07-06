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
mysqli_stmt_close($stmt);

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
    <link rel="stylesheet" href="../../assets/css/add_menu.css">
    
</head>
<body>

<div class="container">

    <a href="index.php" class="back-link">← Kembali ke Daftar Menu</a>

    <h1 class="page-title">Edit Menu</h1>

    <div class="card">

        <form action="sv_edit.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?php echo $rid; ?>">

            <label for="name">Nama Menu</label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?php echo htmlspecialchars($rname); ?>"
                required
            >

            <label for="category">Kategori</label>
            <select id="category" name="category" required>
                <option value="makanan" <?php echo $rcat === 'makanan' ? 'selected' : ''; ?>>
                    Makanan
                </option>

                <option value="minuman" <?php echo $rcat === 'minuman' ? 'selected' : ''; ?>>
                    Minuman
                </option>
            </select>

            <label>Gambar Sekarang</label>

            <img
                class="preview-image"
                src="../../<?php echo htmlspecialchars($rimg); ?>"
                alt="<?php echo htmlspecialchars($rname); ?>"
            >

            <label for="image">Ganti Gambar (Opsional)</label>

            <input
                type="file"
                id="image"
                name="image"
                accept="image/*"
            >

            <small class="helper-text">
                Biarkan kosong jika tidak ingin mengganti gambar.
            </small>

            <label for="link">Link</label>

            <input
                type="text"
                id="link"
                name="link"
                value="<?php echo htmlspecialchars($rlink); ?>"
            >

            <button type="submit" name="update">
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

</body>
</html>
