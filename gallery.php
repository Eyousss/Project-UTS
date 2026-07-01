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

    $sections = [];
    foreach ($gallery_items as $item) {
        $section_id = max(1, (int)($item['section'] ?? 1));
        $sections[$section_id][] = $item;
    }

    $defaultSections = [
        1 => [
            ['title' => 'Daily Activity at Noma', 'image' => './Aset/DIT08383.jpg'],
            ['title' => 'Daily Activity at Noma', 'image' => './Aset/DIT08283.jpg'],
        ],
        2 => [
            ['title' => 'Human Touch Brand', 'image' => './Aset/DIT08293.jpg'],
            ['title' => 'Human Touch Brand', 'image' => './Aset/DIT08305.jpg'],
            ['title' => 'Human Touch Brand', 'image' => './Aset/DIT08316.jpg'],
            ['title' => 'Human Touch Brand', 'image' => './Aset/DIT08319.jpg'],
            ['title' => 'Human Touch Brand', 'image' => './Aset/DIT08339.jpg'],
        ],
        3 => [
            ['title' => 'Take A Break With Noma', 'image' => './Aset/DIT08004.jpg'],
            ['title' => 'Take A Break With Noma', 'image' => './Aset/DIT01161.jpg'],
        ],
    ];

    for ($section_id = 1; $section_id <= 3; $section_id++) {
        if (!isset($sections[$section_id])) {
            $sections[$section_id] = [];
        }
    }

    $sectionTitles = [
        1 => ['title' => 'Daily Activity at Noma', 'description' => 'Tempat terbaik untuk bersantai, bekerja, dan menikmati momen bersama orang-orang tersayang.'],
        2 => ['title' => 'Human Touch Brand', 'description' => 'Dibuat oleh manusia, untuk manusia. Dengan penuh perhatian di setiap langkahnya.'],
        3 => ['title' => 'Take A Break With Noma', 'description' => 'Slow down, you deserve a break.'],
    ];

    function ensureDefaultItems(array $items, int $sectionId): array {
        global $defaultSections;
        $requiredCount = $sectionId === 2 ? 5 : 2;
        if (count($items) >= $requiredCount) {
            return $items;
        }

        $defaultItems = $defaultSections[$sectionId] ?? [];
        return array_merge($items, array_slice($defaultItems, 0, $requiredCount - count($items)));
    }

    foreach ($sections as $section_id => $items) {
        if ($section_id <= 3) {
            $sections[$section_id] = ensureDefaultItems($items, $section_id);
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
            1 => 'left',
            2 => 'right',
            3 => 'left',
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
    <script src="./js/gallery.js"></script>
</body>
</html>