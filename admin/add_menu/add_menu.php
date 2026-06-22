<?php
    include '../security.php';
    // Simple add-menu fragment. Header, title and css removed — include directly from index if needed.
    $success = isset($_GET['success']) && $_GET['success'] === '1';
    $error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<section id="menu-section">
    <div class="menu-container">
        <h2 class="menu-title">Tambah Menu Baru</h2>

        <?php if ($success): ?>
            <p class="success-message">Menu berhasil disimpan ke database.</p>
        <?php endif; ?>

        <?php if ($error): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="sv_menu.php" method="post" class="admin-form">
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
    </div>
</section>

<?php include 'footer.php'; ?>
