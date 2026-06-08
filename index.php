<?php
    include 'header.php';
?>

    <section id="opening">
        <div class="slide active"><img src="./Aset/IMG-Opening/IMG-Opening1.jpeg" class="opening"></div>
        <div class="slide"><img src="./Aset/IMG-Opening/IMG-Opening2.jpeg" class="opening"></div>
        <div class="slide"><img src="./Aset/IMG-Opening/IMG-Opening3.jpeg" class="opening"></div>
        <div class="slide"><img src="./Aset/IMG-Opening/IMG-Opening4.jpeg" class="opening"></div>
        <div class="slide"><img src="./Aset/IMG-Opening/IMG-Opening5.jpeg" class="opening"></div>

        <div class="opening-overlay"></div>

        <div class="opening-content">
            <img src="./Aset/Logo.png" class="opening-logo" alt="Noma Coffee & Taichan">
            <p class="opening-tagline">Coffee &amp; Taichan</p>
            <p class="opening-tagline">Nongkrong-Makan baru lanjut</p>
            <div class="opening-divider"></div>
            <a href="./Menu/Menu.html" class="opening-cta">Lihat Menu</a>
        </div>
    </section>

    <section id="updates">
        <div class="container">
            <h2>Our Updates</h2>

            <div class="news-grid">
                <article class="card card-featured">
                    <img src="./Aset/IMG-Opening/IMG-Opening3.jpeg" alt="">
                    <div class="card-body">
                        <h3>TROPICAL BREEZE!</h3> 
                        <p>Refresh mood kamu dengan Tropical Mix Series.</p> 
                        <button class="btn" onclick="location.href='./Menu/Menu.html'">View More</button>
                    </div>  
                </article>
                <article class="card card-featured">
                    <img src="./Aset/DIT07999.jpg" alt="">
                    <div class="card-body">
                        <h3>Dont miss it!</h3> 
                        <p>Dapatkan update terbaru melalui instagram NOMA!</p>
                        <button class="btn" onclick="window.open('https://www.instagram.com/noma_idn/', '_blank')">View More</button>
                    </div>  
                </article>
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

    <footer>
        <label>&copy; 2024 Noma Coffee & Taichan. All rights reserved.</label><br>
        <div class="sosmed-grup">
        <a class="sosmed" href="https://www.instagram.com/noma_idn/" target="_blank"> 
            <i class="fa fa-instagram" style="font-size:24px"></i>@noma_idn</a>
        <a class="sosmed" href="https://web.whatsapp.com/send/?phone=%2B6285138263206&text&type=phone_number&app_absent=0" target="_blank"> 
            <i class="fa fa-whatsapp" style="font-size:24px"></i>+62 851-3826-3206</a>
        </div>    
    </footer>
    <script src="/javascript/Homepage.js"></script>
</body>
</html>