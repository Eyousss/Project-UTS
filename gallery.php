<?php 
    $page_title = 'Galeri - Noma Coffee & Taichan';
    $page_css = './css/gallery.css';
    include 'header.php';

    $gallery_items = [];
    $gallery_query = mysqli_query($conn, "SELECT title, image, section, section_name FROM gallery_items ORDER BY section ASC, id ASC");
    if ($gallery_query) {
        while ($row = mysqli_fetch_assoc($gallery_query)) {
            $gallery_items[] = $row;
        }
    }

    $defaultSections = [
        1 => [
            'title' => 'Daily Activity at Noma',
            'description' => 'Tempat terbaik untuk bersantai, bekerja, dan menikmati momen bersama orang-orang tersayang.',
            'images' => ['./Aset/DIT08383.jpg', './Aset/DIT08283.jpg'],
        ],
        2 => [
            'title' => 'Human Touch Brand',
            'description' => 'Dibuat oleh manusia, untuk manusia. Dengan penuh perhatian di setiap langkahnya.',
            'images' => ['./Aset/DIT08293.jpg', './Aset/DIT08305.jpg', './Aset/DIT08316.jpg', './Aset/DIT08319.jpg', './Aset/DIT08339.jpg'],
        ],
        3 => [
            'title' => 'Take A Break With Noma',
            'description' => 'Slow down, you deserve a break.',
            'images' => ['./Aset/DIT08004.jpg', './Aset/DIT01161.jpg'],
        ],
    ];

    $sections = [];
    $sectionTitles = [];
    foreach ($gallery_items as $item) {
        $section_id = max(1, (int)($item['section'] ?? 1));
        $sections[$section_id][] = $item;

        if (!empty($item['section_name'])) {
            $sectionTitles[$section_id] = [
                'title' => $item['section_name'],
                'description' => 'Koleksi foto pada section ' . $item['section_name'],
            ];
        }
    }

    for ($section_id = 1; $section_id <= 3; $section_id++) {
        if (empty($sections[$section_id])) {
            foreach ($defaultSections[$section_id]['images'] as $image) {
                $sections[$section_id][] = [
                    'title' => $defaultSections[$section_id]['title'],
                    'image' => $image,
                ];
            }
        }

        if (empty($sectionTitles[$section_id])) {
            $sectionTitles[$section_id] = [
                'title' => $defaultSections[$section_id]['title'],
                'description' => $defaultSections[$section_id]['description'],
            ];
        }
    }

    ksort($sections);
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.menu li a').forEach(function(link) {
            link.classList.remove('active-page');
        });
        var galleryLink = document.getElementById('gallery');
        if (galleryLink) galleryLink.classList.add('active-page');
    });
</script>

    <?php foreach ($sections as $section_id => $sectionItems):
        $isReverse = $section_id % 2 === 0;
        $sectionClass = $isReverse ? 'image reverse' : 'image';
        $textClass = $isReverse ? 'text-right' : 'text-left';
        $sectionTitle = $sectionTitles[$section_id]['title'];
        $sectionDesc = $sectionTitles[$section_id]['description'];
    ?>
    <section class="<?php echo $sectionClass; ?>">
        <div class="<?php echo $textClass; ?>">
            <div class="text">
                <h2><?php echo htmlspecialchars($sectionTitle); ?></h2>
                <p><?php echo htmlspecialchars($sectionDesc); ?></p>
            </div>
        </div>
        <div class="gallery-images">
            <?php foreach ($sectionItems as $index => $item): ?>
                <img src="<?php echo htmlspecialchars($item['image']); ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
            <?php endforeach; ?>
        </div>
    </section>
    <?php endforeach; ?>

    <?php include 'footer.php'; ?> 
    <script src="js/gallery.js"></script>
</body>
</html>