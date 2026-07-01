document.addEventListener("DOMContentLoaded", function () {
  let slides = document.querySelectorAll(".slide");
  let index = 0;

  function showSlide() {
    if (!slides.length) return;
    slides.forEach(slide => slide.classList.remove("active"));
    slides[index].classList.add("active");

    index++;
    if (index >= slides.length) index = 0;
  }

  if (slides.length) {
    setInterval(showSlide, 3000);
  }

  let slides2 = document.querySelectorAll(".slide2");
  let index2 = 0;

  function showSlide2() {
    if (!slides2.length) return;
    slides2.forEach(slide => slide.classList.remove("active2"));
    slides2[index2].classList.add("active2");

    index2++;
    if (index2 >= slides2.length) index2 = 0;
  }

  if (slides2.length) {
    setInterval(showSlide2, 3000);
  }

  let slides3 = document.querySelectorAll(".slide3");
  let index3 = 0;

  function showSlide3() {
    if (!slides3.length) return;
    slides3.forEach(slide => slide.classList.remove("active3"));
    slides3[index3].classList.add("active3");

    index3++;
    if (index3 >= slides3.length) index3 = 0;
  }

  if (slides3.length) {
    setInterval(showSlide3, 3000);
  }
});
