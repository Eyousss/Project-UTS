<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: ../../login.php');
    exit;
}

$koneksi_path = __DIR__ . '/../../koneksi.php';
if (file_exists($koneksi_path)) {
    include $koneksi_path;
}

if (!isset($conn) || !($conn instanceof mysqli)) {
    $conn = mysqli_connect('localhost', 'root', '', 'backend_noma');
    mysqli_set_charset($conn, 'utf8');
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php?error=' . urlencode('ID galeri tidak valid.'));
    exit;
}

$id = (int) $_GET['id'];
$rid = 0;
$rtitle = '';
$rimage = '';
$rsection = 1;
$rsection_name = '';
$rposition = 'right';

$stmt = mysqli_prepare($conn, 'SELECT id, title, image, section, section_name, position FROM gallery_items WHERE id = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $rid, $rtitle, $rimage, $rsection, $rsection_name, $rposition);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if (!$rid) {
    header('Location: index.php?error=' . urlencode('Data galeri tidak ditemukan.'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $title = trim($_POST['title'] ?? '');
    $section = max(1, (int)($_POST['section'] ?? 1));
    $section_name = null;
    $position = in_array($_POST['position'] ?? '', ['left', 'right'], true) ? $_POST['position'] : 'right';

    if ($title === '') {
        header('Location: edit.php?id=' . $id . '&error=' . urlencode('Judul foto wajib diisi.'));
        exit;
    }

    $image_path = $rimage;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../assets/images/upload_image/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($file_ext, $allowed_ext)) {
            header('Location: edit.php?id=' . $id . '&error=' . urlencode('Format file tidak didukung.'));
            exit;
        }

        if ($file_size > 5 * 1024 * 1024) {
            header('Location: edit.php?id=' . $id . '&error=' . urlencode('Ukuran file terlalu besar. Maksimal 5MB.'));
            exit;
        }

        $new_filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($title)) . '.' . $file_ext;
        $image_path = 'assets/images/upload_image/' . $new_filename;
        $full_path = $upload_dir . $new_filename;

        if (!move_uploaded_file($file_tmp, $full_path)) {
            header('Location: edit.php?id=' . $id . '&error=' . urlencode('Gagal mengunggah file.'));
            exit;
        }

        if ($rimage && file_exists(__DIR__ . '/../../' . $rimage)) {
            @unlink(__DIR__ . '/../../' . $rimage);
        }
    }

    $stmt = mysqli_prepare($conn, 'UPDATE gallery_items SET title = ?, image = ?, section = ?, section_name = ?, position = ? WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'ssissi', $title, $image_path, $section, $section_name, $position, $id);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php?updated=1');
        exit;
    }

    header('Location: edit.php?id=' . $id . '&error=' . urlencode('Gagal memperbarui galeri: ' . mysqli_error($conn)));
    exit;
}

$defaultSectionLabels = [
    1 => 'Daily Activity at Noma',
    2 => 'Human Touch Brand',
    3 => 'Take A Break With Noma'
];

$currentSectionValue = $rsection_name !== null && $rsection_name !== '' ? 'new' : (string) $rsection;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Galeri</title>
    <link rel="stylesheet" href="../../assets/css/add_gallery.css">
</head>
<body>
    <div class="container">
        <h1 class="page-title">Edit Galeri</h1>
        <p><a class="back-link" href="index.php">Kembali ke Daftar Galeri</a></p>

        <div class="card">
            <h2>Perbarui Data Galeri</h2>
            <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <label for="title">Judul Foto</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars((string) $rtitle); ?>" required>

                <label for="section">Pilih Section</label>
                <select id="section" name="section" required>
                    <option value="1" <?php echo $rsection == 1 ? 'selected' : ''; ?>>Daily Activity at Noma</option>
                    <option value="2" <?php echo $rsection == 2 ? 'selected' : ''; ?>>Human Touch Brand</option>
                    <option value="3" <?php echo $rsection == 3 ? 'selected' : ''; ?>>Take A Break With Noma</option>
                </select>

                <label>Foto Saat Ini</label>
                <img id="current-image-preview" class="preview-image" src="../../<?php echo htmlspecialchars((string) $rimage); ?>" alt="<?php echo htmlspecialchars((string) $rtitle); ?>">

                <label for="image">Ganti Foto (Opsional)</label>
                <input type="file" id="image" name="image" accept="image/*">

                <button type="submit" name="update">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sectionSelect = document.getElementById('section');
            var newSectionLabel = document.getElementById('new-section-label');
            var newSectionInput = document.getElementById('new_section_name');
            var imageInput = document.getElementById('image');
            var currentPreview = document.getElementById('current-image-preview');

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

            function previewImage(file) {
                if (!file || !currentPreview) {
                    return;
                }
                var reader = new FileReader();
                reader.onload = function (e) {
                    currentPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }

            if (imageInput) {
                imageInput.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        previewImage(this.files[0]);
                    }
                });
            }

            sectionSelect.addEventListener('change', toggleNewSection);
            toggleNewSection();
        });
    </script>
</body>
</html>
