<?php
    $page_title = 'Menu — Noma Coffee & Taichan';
    $page_css   = './assets/css/Menu.css';
    include 'header.php';
    include 'koneksi.php';

    $menu_items = [];
    $query = "SELECT * FROM menu_items ORDER BY category, name";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $menu_items[] = $row;
        }
    }
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.menu li a').forEach(function(link) {
            link.classList.remove('active-page');
        });
        var menuLink = document.getElementById('menu');
        if (menuLink) menuLink.classList.add('active-page');
    });
</script>

    <section id="menu-section">
        <div class="menu-container">
            <h2 class="menu-title">Menu Kami</h2>

            <div class="menu-tabs">
                <button class="tab-btn active" onclick="filterMenu('semua')">Semua</button>
                <button class="tab-btn" onclick="filterMenu('makanan')">Makanan</button>
                <button class="tab-btn" onclick="filterMenu('minuman')">Minuman</button>
            </div>

            <div class="menu-grid">
                <?php foreach ($menu_items as $item): ?>
                    <a class="menu-card"
                        data-category="<?php echo htmlspecialchars($item['category']); ?>"
                        target="_blank"
                        href="<?php echo htmlspecialchars($item['link']); ?>">

                        <img src="<?php echo htmlspecialchars($item['image']); ?>"
                            alt="<?php echo htmlspecialchars($item['name']); ?>">

                        <p><?php echo htmlspecialchars($item['name']); ?></p>

                    </a>
                <?php endforeach; ?>
                        
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="./assets/js/Menu.js"></script>
</body>
</html>