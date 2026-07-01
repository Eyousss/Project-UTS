document.addEventListener("DOMContentLoaded", function () {
  const groups = document.querySelectorAll(".gallery-images");

  groups.forEach(function (group) {
    const slides = group.querySelectorAll(".gallery-slide");
    if (!slides.length) return;

    let index = 0;

    function showSlide() {
      slides.forEach(function (slide) {
        slide.classList.remove("active");
      });

      slides[index].classList.add("active");
      index = (index + 1) % slides.length;
    }

    showSlide();
    setInterval(showSlide, 3000);
  });
});
