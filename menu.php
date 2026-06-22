<?php
    $page_title = 'Menu — Noma Coffee & Taichan';
    $page_css   = './css/Menu.css';
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
                        <a class="menu-card" data-category="makanan" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/makanan/mie-nyemek.png" alt="Chicken Salted Egg">
                            <p>Mie Nyemek</p>
                        </a>
                        <a class="menu-card" data-category="makanan" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/makanan/nasgor-seafood.png" alt="Nasi Goreng Seafood">
                            <p>Nasi Goreng Seafood</p>
                        </a>    
                        <a class="menu-card" data-category="makanan" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/makanan/nasgor-embah.png" alt="Nasi Goreng Telur">
                            <p>Nasi Goreng Embah</p>
                        </a>
                        <a class="menu-card" data-category="makanan" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/makanan/nasgor.png" alt="Nasi Goreng">
                            <p>Nasi Goreng</p>
                        </a>
                        <a class="menu-card" data-category="makanan" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/makanan/nasi-bakar.png" alt="Nasi Bakar">
                            <p>Nasi Bakar</p>
                        </a>
                        <a class="menu-card" data-category="makanan" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/makanan/sambal-matah.png" alt="Nasi Ayam Sambal Matah">
                            <p>Nasi Ayam Sambal Matah</p>
                        </a>
                        <a class="menu-card" data-category="makanan" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/makanan/Kwetiau.jpeg" alt="Kwetiau">
                            <p>Kwetiau Goreng Seafood</p>
                        </a>
                        <a class="menu-card" data-category="makanan" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/makanan/taican.png" alt="Sate Taican">
                            <p>Sate Taican</p>
                        </a>
                        <a class="menu-card" data-category="makanan" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/makanan/pisang-goreng.png" alt="Pisang Goreng">
                            <p>Pisang Goreng Wijen</p>
                        </a>

                        <a class="menu-card" data-category="minuman" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/minuman/kopi-noma.png" alt="Kopi Susu Light">
                            <p>Kopi Noma</p>
                        </a>
                        <a class="menu-card" data-category="minuman" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/minuman/kopi-susu.png" alt="Kopi Susu Light">
                            <p>Latte</p>
                        </a>
                        <a class="menu-card" data-category="minuman" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/minuman/kopi-susu-strong.png" alt="Kopi Susu Strong">
                            <p>Kopi Aren</p>
                        </a>
                        <a class="menu-card" data-category="minuman" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/minuman/americano.png" alt="Kopi Americano">
                            <p>Kopi Americano</p>
                        </a>
                        <a class="menu-card" data-category="minuman" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/minuman/coklat.png" alt="Susu Coklat">
                            <p>Susu Coklat</p>
                        </a>
                        <a class="menu-card" data-category="minuman" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/minuman/matcha.png" alt="Matcha Latte">
                            <p>Matcha</p>
                        </a>
                        <a class="menu-card" data-category="minuman" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/minuman/biru-samudra.jpeg" alt="Biru Samudra">
                            <p>Biru Samudra</p>
                        </a>
                        <a class="menu-card" data-category="minuman" target="_blank" href="https://food.grab.com/id/en/restaurant/noma-coffee-taichan-akcaya-delivery/6-C7VJE6BKJGNTMA?sourceID=20251226_130710_5364ccee9a0145128cb3ddc96a24bcd3_MEXMPS">
                            <img src="./Aset/minuman/mango-rush.jpeg" alt="Mango Rush">
                            <p>Mango Rush</p>
                    </a>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="./js/Menu.js"></script>
</body>
</html>