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

$success = isset($_GET['success']) && $_GET['success'] === '1';
$updated = isset($_GET['updated']) && $_GET['updated'] === '1';
$error = isset($_GET['error']) ? $_GET['error'] : '';
$page_css = '../../assets/css/add_gallery.css';

$gallery_items = [];
$gallery_query = mysqli_query($conn, "SELECT id, title, image, section, section_name, position, created_at FROM gallery_items ORDER BY section ASC, id DESC");
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
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/navbar_admin.css">
    <link rel="stylesheet" href="../../assets/css/admin_management.css">
</head>
<body>
    <nav class="navbar">
        <a href="#" class="logo-text">noma</a>
        <span class="admin-label">Gallery Panel</span>
    </nav>
    <div class="wrapper">
        <a href="../dashboard.php" class="back-link">← Kembali ke Dashboard</a>

        <div class="content-header">
            <div>
                <h1>Manajemen Galeri</h1>
            </div>
        </div>
        
        <div class="table-container">

        <?php if ($success): ?>
            <div class="alert success">Foto galeri berhasil disimpan.</div>
        <?php endif; ?>

        <?php if ($updated): ?>
            <div class="alert success">Foto galeri berhasil diperbarui.</div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <fieldset>
            <legend>Tambah Galeri Baru</legend>

            <form action="add_gallery.php" method="post" enctype="multipart/form-data">
                <label for="title">Judul Foto</label>
                <input type="text" id="title" name="title" placeholder="Contoh: Daily Activity" required>

                <label for="section">Pilih Section</label>
                <select id="section" name="section" required>
                    <option value="1">Daily Activity at Noma</option>
                    <option value="2">Human Touch Brand</option>
                    <option value="3">Take A Break With Noma</option>\
                </select>


                <label for="image">Foto Galeri</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <button type="submit" name="save">Simpan Galeri</button>
            </form>
        </fieldset>

        <h2>Daftar Galeri</h2>

        <?php if (!empty($gallery_items)): ?>
            <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Section</th>
                            <th>Foto</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $defaultSectionLabels = [
                            1 => 'Daily Activity at Noma',
                            2 => 'Human Touch Brand',
                            3 => 'Take A Break With Noma'
                        ];

                        foreach ($gallery_items as $item):
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($item['title']); ?></td>
                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        !empty($item['section_name'])
                                            ? $item['section_name']
                                            : (isset($defaultSectionLabels[$item['section']])
                                                ? $defaultSectionLabels[$item['section']]
                                                : 'Section ' . $item['section'])
                                    );
                                    ?>
                                </td>
                                <td>
                                    <img src="../../<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                                </td>
                                <td><?php echo htmlspecialchars($item['created_at']); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="edit.php?id=<?php echo (int)$item['id']; ?>" class="btn-edit">Edit</a>
                                        <a href="hapus.php?id=<?php echo (int)$item['id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus foto ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        <?php else: ?>
            <div class="empty-state">
                <p>Belum ada galeri.</p>
            </div>
        <?php endif; ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sectionSelect = document.getElementById('section');
            var newSectionLabel = document.getElementById('new-section-label');
            var newSectionInput = document.getElementById('new_section_name');

            function toggleNewSection() {
                if (sectionSelect.value === 'new') {
                    newSectionLabel.classList.remove('hidden');
                    newSectionInput.classList.remove('hidden');
                    newSectionInput.required = true;
                } else {
                    newSectionLabel.classList.add('hidden');
                    newSectionInput.classList.add('hidden');
                    newSectionInput.required = false;
                    newSectionInput.value = '';
                }
            }

            sectionSelect.addEventListener('change', toggleNewSection);
            toggleNewSection();
        });
    </script>
</body>
</html>