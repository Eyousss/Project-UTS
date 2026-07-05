document.addEventListener('DOMContentLoaded', function() {

    // Rating service and menu
    setupRatingRow('service-rating', 'service_rating_input');
    setupRatingRow('menu-rating', 'menu_rating_input');

    function setupRatingRow(rowId, inputId) {
        var row = document.getElementById(rowId);
        if (!row) return;

        row.addEventListener('click', function(e) {
            var target = e.target.closest('.skor-kepuasan');
            if (!target) return;

            var rating = target.textContent.trim();
            document.querySelectorAll('#' + rowId + ' .skor-kepuasan').forEach(function(item) {
                item.classList.remove('active');
            });
            target.classList.add('active');
            document.getElementById(inputId).value = rating;
        });
    }

    document.getElementById('feedback-form').addEventListener('submit', function(e) {
        var serviceRating = document.getElementById('service_rating_input').value;
        var menuRating = document.getElementById('menu_rating_input').value;

        if (!serviceRating || !menuRating) {
            e.preventDefault();
            alert('Silakan pilih skor untuk pelayanan dan menu sebelum mengirim.');
        }
    });
});

function resetFeedbackForm() {
    document.querySelectorAll('.skor-kepuasan').forEach(function(s) {
        s.classList.remove('active');
    });
    document.getElementById('feedback-form').reset();
}
