<?php
    include 'header.php';
?>
    <section id="opening">
        <div class="slide active"><img src="Aset/IMG-Opening/IMG-Opening1.jpeg" class="opening"></div>
        <div class="slide"><img src="Aset/IMG-Opening/IMG-Opening2.jpeg" class="opening"></div>
        <div class="slide"><img src="Aset/IMG-Opening/IMG-Opening3.jpeg" class="opening"></div>
        <div class="slide"><img src="Aset/IMG-Opening/IMG-Opening4.jpeg" class="opening"></div>
        <div class="slide"><img src="Aset/IMG-Opening/IMG-Opening5.jpeg" class="opening"></div>

        <div class="opening-overlay"></div>

        <div class="opening-content">
            <img src="./Aset/Logo.png" class="opening-logo" alt="Noma Coffee & Taichan">
            <p class="opening-tagline">Coffee &amp; Taichan</p>
            <p class="opening-tagline">Nongkrong-Makan baru lanjut</p>
            <div class="opening-divider"></div>
            <a href="./Menu/Menu.html" class="opening-cta">Lihat Menu</a>
        </div>
    </section>

<?php
include 'koneksi.php';
$newsResult = mysqli_query($conn, "SELECT title, description, image, button_text, button_url FROM news ORDER BY created_at DESC LIMIT 4");
$newsItems = [];
if ($newsResult) {
    while ($newsRow = mysqli_fetch_assoc($newsResult)) {
        $newsItems[] = $newsRow;
    }
}
?>
    <section id="updates">
        <div class="container">
            <h2>Our Updates</h2>
            <div class="news-grid">
                <?php if (count($newsItems) > 0): ?>
                    <?php foreach ($newsItems as $item): ?>
                        <article class="card card-featured">
                            <?php if (!empty($item['image'])): ?>
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                                <p><?php echo htmlspecialchars($item['description']); ?></p>
                                <?php if (!empty($item['button_url'])): ?>
                                    <button class="btn" onclick="window.open('<?php echo htmlspecialchars($item['button_url']); ?>', '_blank')"><?php echo htmlspecialchars($item['button_text'] ?: 'View More'); ?></button>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No news available at the moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="location">
        <div class="container">
            <h2>Our Location</h2><br>
            <div class="map-wrapper">
                <div class="map-info">
                    <h3>Noma Coffee & Taichan</h3>
                    <p>📍 Jl. Surya No.25, Akcaya</p>
                    <p>🕐 Setiap hari, 10.00 - 22.00</p>
                    <p>📞 +62 851-3826-3206</p>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.8169103978153!2d109.32855907521426!3d-0.04816839995134646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d5900439c887d%3A0xdb4344cf264f727d!2sNoma%20Coffee%20%26%20Taichan!5e0!3m2!1sen!2sid!4v1777442692092!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script src="js/Homepage.js"></script>
</body>
</html>