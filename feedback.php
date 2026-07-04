<?php
    $page_title = 'Feedback — Noma Coffee & Taichan';
    $page_css   = './css/feedback.css';
    include 'header.php';
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
            <p class="subtitle">Bantu kami meningkatkan pengalaman website Noma Coffee & Taichan.</p>
            </div>
        </div>

        <!--- Pertanyaan 1 --->
        <section class="feedback-card">
            <p class="questions">1. Seberapa puas kamu dengan tampilan website kami?</p>
            <div class="kepuasan-row" id="kepuasan">
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
        </section>
        
        <!--- Pertanyaan 2 --->
        <section class="feedback-card">
            <p class="questions">2. Seberapa mudah kamu menemukan informasi yang kamu butuhkan?</p>
            <div class="kesulitan-row" id="kesulitan">
                <div class="skor-kesulitan">1</div>
                <div class="skor-kesulitan">2</div>
                <div class="skor-kesulitan">3</div>
                <div class="skor-kesulitan">4</div>
                <div class="skor-kesulitan">5</div> 
            </div>
            <div class="label-kesulitan">
                <p>Sangat Mudah</p>
                <p>Sangat Sulit</p>
            </div>
        </section>

        <!--- Pertanyaan 3 --->
        <section class="feedback-card">
            <p class="questions">3. Apakah kamu memiliki kritik dan saran untuk website kami kedepannya?</p>
            <textarea class="saran-input" placeholder="Tulis saranmu di sini..."></textarea>
        </section>

        <section class="submit-btn">
            <button class="btn-submit" onclick="submitForm()">Kirim feedback</button>
        </section>

        <div id="notif-sukses">
            <p id="pesan-sukses" style="display:none; text-align:right; color:green; margin-top:8px;">
                Terima kasih! Feedback kamu sudah terkirim.
            </p>
        </div>

    </section>
    <?php include 'footer.php'; ?> 
    <script src="./assets/js/feedback.js"></script>
</body>
</html>