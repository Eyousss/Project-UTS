<?php
include '../security.php';
$koneksi_path = __DIR__ . '/../../koneksi.php';
if (file_exists($koneksi_path)) {
    include $koneksi_path;
}

if (!isset($conn) || !($conn instanceof mysqli)) {
    $conn = mysqli_connect('localhost', 'root', '', 'backend_noma');
    mysqli_set_charset($conn, 'utf8');
}

$success = isset($_GET['success']) && $_GET['success'] === '1';
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
    <link rel="stylesheet" href="<?php echo $page_css; ?>">
</head>
<body>
    <div class="container">
        <h1 class="page-title">Manajemen Galeri</h1>
        <a href="../dashboard.php" class="back-link">Kembali ke Dashboard</a>

        <?php if ($success): ?>
            <p class="alert alert-success">Foto galeri berhasil disimpan.</p>
        <?php endif; ?>

        <?php if ($error): ?>
            <p class="alert alert-error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <div class="card">
            <h2>Tambah Galeri Baru</h2>

            <form action="add_gallery.php" method="post" enctype="multipart/form-data">
                <label for="title">Judul Foto</label>
                <input type="text" id="title" name="title" placeholder="Contoh: Daily Activity" required>

                <label for="section">Pilih Section</label>
                <select id="section" name="section" required>
                    <option value="1">Daily Activity at Noma</option>
                    <option value="2">Human Touch Brand</option>
                    <option value="3">Take A Break With Noma</option>
                    <option value="new">Section Baru</option>
                </select>

                <label for="new_section_name" id="new-section-label" class="hidden">Nama Section Baru</label>
                <input type="text" id="new_section_name" name="new_section_name" placeholder="Masukkan nama section baru" class="hidden">

                <label for="position">Posisi Gambar</label>
                <select id="position" name="position" required>
                    <option value="right">Right</option>
                    <option value="left">Left</option>
                </select>

                <label for="image">Foto Galeri</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <button type="submit" name="save">Simpan Galeri</button>
            </form>
        </div>

        <div class="card">
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
                                    <a href="hapus.php?id=<?php echo $item['id']; ?>" class="button button-delete" onclick="return confirm('Yakin ingin menghapus foto galeri ini?');">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="empty-state">Belum ada galeri.</p>
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