const slides = document.querySelectorAll('#opening .slide');
let current = 0;

function changeImage() {
    slides[current].classList.remove('active');
    current = (current + 1) % slides.length;
    slides[current].classList.add('active');
}

setInterval(changeImage, 3000);