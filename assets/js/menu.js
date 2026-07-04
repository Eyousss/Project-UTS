function filterMenu(category, event) {
    // update tombol aktif
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    if (event && event.target) {
        event.target.classList.add('active');
    } else {
        // Jika dipanggil tanpa event, set active berdasarkan category
        document.querySelectorAll('.tab-btn').forEach(btn => {
            if (btn.textContent.toLowerCase() === category || (category === 'semua' && btn.textContent === 'Semua')) {
                btn.classList.add('active');
            }
        });
    }

    // filter card
    document.querySelectorAll('.menu-card').forEach(card => {
        if (category === 'semua' || card.dataset.category === category) {
            card.classList.remove('hidden');
        } else {
            card.classList.add('hidden');
        }
    });
}

// Handle hash on page load
window.addEventListener('load', function() {
    const hash = window.location.hash.substring(1); // remove #
    if (hash === 'makanan' || hash === 'minuman' || hash === 'semua') {
        filterMenu(hash);
    }
});