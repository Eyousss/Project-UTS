<?php 
    $page_title = 'Galeri - Noma Coffee & Taichan';
    $page_css = './css/gallery.css';
    include 'header.php';
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
            <img src="./Aset/DIT08383.jpg" class="slide active">
            <img src="./Aset/DIT08283.jpg" class="slide">
        </div>
    </section>

    <section class="image reverse">
        <div class="img-left">
            <img src="./Aset/DIT08293.jpg" class="slide2 active2">
            <img src="./Aset/DIT08305.jpg" class="slide2">
            <img src="./Aset/DIT08316.jpg" class="slide2">
            <img src="./Aset/DIT08319.jpg" class="slide2">
            <img src="./Aset/DIT08339.jpg" class="slide2">
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
            <img src="./Aset/DIT08004.jpg" class="slide3 active3">
            <img src="./Aset/DIT01161.jpg" class="slide3">
        </div>
    </section>
    
    <?php include 'footer.php'; ?> 
    <script src="./js/Galery.js"></script>
</body>
</html>