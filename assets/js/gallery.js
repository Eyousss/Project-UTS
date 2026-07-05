document.addEventListener("DOMContentLoaded", function () {
  const galleryContainers = document.querySelectorAll(".gallery-images");

  galleryContainers.forEach(function (container) {
    const slides = container.querySelectorAll("img");
    if (slides.length <= 1) return;

    let index = 0;
    setInterval(function () {
      slides[index].classList.remove("active");
      index = (index + 1) % slides.length;
      slides[index].classList.add("active");
    }, 3000);
  });
});

