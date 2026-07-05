<?php
    $page_title = 'Feedback — Noma Coffee & Taichan';
    $page_css   = './assets/css/feedback.css';
    include 'header.php';

    $success = isset($_GET['success']) && $_GET['success'] === '1';
    $error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<script>
    // Set active nav link untuk halaman feedback
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.menu li a').forEach(function(link) {
            link.classList.remove('active-page');
        });
        var feedbackLink = document.getElementById('feedback');
        if (feedbackLink) feedbackLink.classList.add('active-page');
    });
</script>

    <section id="feedback-section">
        <div class="feedback-container">
            <h2 class="feedback-title">Feedback & Survei UX</h2>
            <div class="feedback-subtitle">
                <p class="subtitle">Bantu kami meningkatkan pelayanan di Noma Coffee & Taichan.</p>
            </div>
        </div>

        <form action="sv_feedback.php" method="post" id="feedback-form">
            <!--- Pertanyaan 1 --->
            <section class="feedback-card">
                <p class="questions">1. Seberapa puas kamu dengan pelayanan kami?</p>
                <div class="kepuasan-row" id="service-rating">
                    <div class="skor-kepuasan">1</div>
                    <div class="skor-kepuasan">2</div>
                    <div class="skor-kepuasan">3</div>
                    <div class="skor-kepuasan">4</div>
                    <div class="skor-kepuasan">5</div>
                </div>
                <div class="label-kepuasan">
                    <p>Sangat Tidak Puas</p>
                    <p>Sangat Puas</p>
                </div>
                <input type="hidden" name="service_rating" id="service_rating_input">
            </section>

            <!--- Pertanyaan 2 --->
            <section class="feedback-card">
                <p class="questions">2. Pendapat skor tentang menu kami</p>
                <div class="kepuasan-row" id="menu-rating">
                    <div class="skor-kepuasan">1</div>
                    <div class="skor-kepuasan">2</div>
                    <div class="skor-kepuasan">3</div>
                    <div class="skor-kepuasan">4</div>
                    <div class="skor-kepuasan">5</div>
                </div>
                <div class="label-kepuasan">
                    <p>Kurang Puas</p>
                    <p>Sangat Puas</p>
                </div>
                <input type="hidden" name="menu_rating" id="menu_rating_input">
            </section>

            <!--- Pertanyaan 3 --->
            <section class="feedback-card">
                <p class="questions">3. Apakah kamu memiliki kritik dan saran untuk pelayanan dan menu kami kedepannya?</p>
                <textarea class="saran-input" name="message" placeholder="Tulis saranmu di sini..."></textarea>
            </section>

            <section class="feedback-card">
                <p class="questions">4. Email pengguna (opsional)</p>
                <textarea type="email" name="email" class="email-input" placeholder="Isi email jika anda bersedia menerima balasan dari kami."></textarea>
            </section>

            <section class="submit-btn">
                <button class="btn-submit" type="submit">Kirim feedback</button>
            </section>
        </form>

        <div id="notif-sukses">
            <?php if ($success): ?>
                <p id="pesan-sukses" style="display:block; text-align:right; color:green; margin-top:8px;">
                    Terima kasih! Feedback kamu sudah terkirim.
                </p>
            <?php endif; ?>
            <?php if ($error): ?>
                <p id="pesan-error" style="display:block; text-align:right; color:red; margin-top:8px;">
                    <?php echo htmlspecialchars($error); ?>
                </p>
            <?php endif; ?>
        </div>

    </section>
    <?php include 'footer.php'; ?> 
    <script src="./assets/js/feedback.js"></script>
</body>
</html>