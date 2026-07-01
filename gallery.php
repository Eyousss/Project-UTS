<?php 
    $page_title = 'Galeri - Noma Coffee & Taichan';
    $page_css = './css/gallery.css';
    include 'header.php';

    $gallery_items = [];
    $gallery_query = mysqli_query($conn, "SELECT title, image FROM gallery_items ORDER BY id ASC");
    if ($gallery_query) {
        while ($row = mysqli_fetch_assoc($gallery_query)) {
            $gallery_items[] = $row;
        }
    }

    $defaultSection1 = [
        ['title' => 'Daily Activity at Noma', 'image' => './Aset/DIT08383.jpg'],
        ['title' => 'Daily Activity at Noma', 'image' => './Aset/DIT08283.jpg'],
    ];
    $defaultSection2 = [
        ['title' => 'Human Touch Brand', 'image' => './Aset/DIT08293.jpg'],
        ['title' => 'Human Touch Brand', 'image' => './Aset/DIT08305.jpg'],
        ['title' => 'Human Touch Brand', 'image' => './Aset/DIT08316.jpg'],
        ['title' => 'Human Touch Brand', 'image' => './Aset/DIT08319.jpg'],
        ['title' => 'Human Touch Brand', 'image' => './Aset/DIT08339.jpg'],
    ];
    $defaultSection3 = [
        ['title' => 'Take A Break With Noma', 'image' => './Aset/DIT08004.jpg'],
        ['title' => 'Take A Break With Noma', 'image' => './Aset/DIT01161.jpg'],
    ];

    function getSectionImages($items, $start, $length, $default) {
        $section = array_slice($items, $start, $length);
        if (count($section) < $length) {
            $section = array_merge($section, array_slice($default, 0, $length - count($section)));
        }
        return $section;
    }

    $section1 = getSectionImages($gallery_items, 0, 2, $defaultSection1);
    $section2 = getSectionImages($gallery_items, 2, 5, $defaultSection2);
    $section3 = getSectionImages($gallery_items, 7, 2, $defaultSection3);
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

    <section class="image">
        <div class="text-left">
            <h2>Daily Activity at Noma</h2>
            <p>Tempat terbaik untuk bersantai, bekerja, dan menikmati momen bersama orang-orang tersayang.</p>
        </div>
        <div class="right">
            <?php foreach ($section1 as $index => $item): ?>
                <img src="<?php echo htmlspecialchars($item['image']); ?>" class="slide<?php echo $index === 0 ? ' active' : ''; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
            <?php endforeach; ?>
        </div>
    </section>

    <section class="image reverse">
        <div class="img-left">
            <?php foreach ($section2 as $index => $item): ?>
                <img src="<?php echo htmlspecialchars($item['image']); ?>" class="slide2<?php echo $index === 0 ? ' active2' : ''; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
            <?php endforeach; ?>
        </div>
        <div class="text-right">
            <div class="text">
                <h2>Human Touch Brand</h2>
                <p>Dibuat oleh manusia, untuk manusia. Dengan penuh perhatian di setiap langkahnya.</p>
            </div>
        </div>
    </section>

    <section class="image">
        <div class="text-left">
            <h2>Take A Break With Noma</h2>
            <p>Slow down, you deserve a break.</p>
        </div>
        <div class="right">
            <?php foreach ($section3 as $index => $item): ?>
                <img src="<?php echo htmlspecialchars($item['image']); ?>" class="slide3<?php echo $index === 0 ? ' active3' : ''; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
            <?php endforeach; ?>
        </div>
    </section>

    <?php include 'footer.php'; ?> 
    <script src="./js/Galery.js"></script>
</body>
</html>