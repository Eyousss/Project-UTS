document.addEventListener('DOMContentLoaded', function() {

    // Pertanyaan 1 - Kepuasan
    document.getElementById('kepuasan').addEventListener('click', function(e) {
        var t = e.target.closest('.skor-kepuasan');
        if (!t) return;
        document.querySelectorAll('.skor-kepuasan').forEach(function(s) {
            s.classList.remove('active');
        });
        t.classList.add('active');
    });

    // Pertanyaan 2 - Kesulitan
    document.getElementById('kesulitan').addEventListener('click', function(e) {
        var t = e.target.closest('.skor-kesulitan');
        if (!t) return;
        document.querySelectorAll('.skor-kesulitan').forEach(function(s) {
            s.classList.remove('active');
        });
        t.classList.add('active');
    });

});

function submitForm() {
    document.getElementById('pesan-sukses').style.display = 'block';
    document.querySelector('.btn-submit').disabled = true;
    document.querySelector('.btn-submit').style.opacity = '0.5';
}

function submitForm() {
    document.getElementById('pesan-sukses').style.display = 'block';
    document.querySelector('.btn-submit').disabled = true;
    document.querySelector('.btn-submit').style.opacity = '0.5';

    // Clear semua pilihan skor
    document.querySelectorAll('.skor-kepuasan, .skor-kesulitan').forEach(function(s) {
        s.classList.remove('active');
    });

    // Clear textarea
    document.querySelector('.saran-input').value = '';
}