<?php 
    $page_title = 'Galeri - Noma Coffee & Taichan';
    $page_css = './assets/css/gallery.css';
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
            ['title' => 'Daily Activity at Noma', 'image' => './assets/images/DIT08383.jpg'],
            ['title' => 'Daily Activity at Noma', 'image' => './assets/images/DIT08283.jpg'],
        ],
        2 => [
            ['title' => 'Human Touch Brand', 'image' => './assets/images/DIT08293.jpg'],
            ['title' => 'Human Touch Brand', 'image' => './assets/images/DIT08305.jpg'],
            ['title' => 'Human Touch Brand', 'image' => './assets/images/DIT08316.jpg'],
            ['title' => 'Human Touch Brand', 'image' => './assets/images/DIT08319.jpg'],
            ['title' => 'Human Touch Brand', 'image' => './assets/images/DIT08339.jpg'],
        ],
        3 => [
            ['title' => 'Take A Break With Noma', 'image' => './assets/images/DIT08004.jpg'],
            ['title' => 'Take A Break With Noma', 'image' => './assets/images/DIT01161.jpg'],
        ],
    ];

    $sectionTitles = [
        1 => ['title' => 'Daily Activity at Noma', 'description' => 'Tempat terbaik untuk bersantai, bekerja, dan menikmati momen bersama orang-orang tersayang.'],
        2 => ['title' => 'Human Touch Brand', 'description' => 'Dibuat oleh manusia, untuk manusia. Dengan penuh perhatian di setiap langkahnya.'],
        3 => ['title' => 'Take A Break With Noma', 'description' => 'Slow down, you deserve a break.'],
    ];

    $sectionItemCounts = [
        1 => 2,
        2 => 5,
        3 => 2,
    ];

    $sections = [];
    $availableItems = array_values(array_filter($gallery_items, static function ($item) {
        return !empty($item['image']);
    }));

    for ($section_id = 1; $section_id <= 3; $section_id++) {
        $sectionItems = array_values(array_filter($availableItems, static function ($item) use ($section_id) {
            return ((int)($item['section'] ?? 1)) === $section_id;
        }));

        if (empty($sectionItems) && !empty($availableItems)) {
            $sectionItems = $availableItems;
        }

        if (!empty($sectionItems)) {
            shuffle($sectionItems);
            $sections[$section_id] = array_slice($sectionItems, 0, min($sectionItemCounts[$section_id] ?? 2, count($sectionItems)));
        } else {
            $sections[$section_id] = $defaultSections[$section_id] ?? [];
        }
    }

    ksort($sections);
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.menu li a').forEach(function(link) {
            link.classList.remove('active-page');
        });
        var galeryLink = document.getElementById('galery');
        if (galeryLink) galeryLink.classList.add('active-page');
    });
</script>

    <?php foreach ($sections as $section_id => $sectionItems):
        $sectionPositionMap = [
            1 => 'right',
            2 => 'left',
            3 => 'right',
        ];
        $sectionPosition = $sectionPositionMap[$section_id] ?? 'right';
        $isReverse = $sectionPosition === 'left';
        $sectionClass = $isReverse ? 'image reverse gallery-section' : 'image gallery-section';
        $imageContainerClass = $isReverse ? 'img-left' : 'right';
        $textClass = $isReverse ? 'text-right' : 'text-left';
        $sectionTitle = $sectionTitles[$section_id]['title'] ?? 'Gallery Section ' . $section_id;
        $sectionDesc = $sectionTitles[$section_id]['description'] ?? 'Koleksi foto section ' . $section_id . ' untuk galeri Noma.';
    ?>
    <section class="<?php echo $sectionClass; ?>">
        <?php if (!$isReverse): ?>
            <div class="<?php echo $textClass; ?>">
                <h2><?php echo htmlspecialchars($sectionTitle); ?></h2>
                <p><?php echo htmlspecialchars($sectionDesc); ?></p>
            </div>
            <div class="<?php echo $imageContainerClass; ?> gallery-images">
                <?php foreach ($sectionItems as $index => $item): ?>
                    <img src="<?php echo htmlspecialchars($item['image']); ?>" class="gallery-slide<?php echo $index === 0 ? ' active' : ''; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="<?php echo $imageContainerClass; ?> gallery-images">
                <?php foreach ($sectionItems as $index => $item): ?>
                    <img src="<?php echo htmlspecialchars($item['image']); ?>" class="gallery-slide<?php echo $index === 0 ? ' active' : ''; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                <?php endforeach; ?>
            </div>
            <div class="<?php echo $textClass; ?>">
                <div class="text">
                    <h2><?php echo htmlspecialchars($sectionTitle); ?></h2>
                    <p><?php echo htmlspecialchars($sectionDesc); ?></p>
                </div>
            </div>
        <?php endif; ?>
    </section>
    <?php endforeach; ?>

    <?php include 'footer.php'; ?> 
    <script src="./assets/js/gallery.js"></script>
</body>
</html>