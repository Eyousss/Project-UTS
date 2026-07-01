function initGallery() {
  const groups = document.querySelectorAll(".gallery-images");

  groups.forEach(function (group) {
    const slides = group.querySelectorAll(".gallery-slide");
    if (!slides.length) return;

    // Mulai dari indeks 1, karena indeks 0 sudah di-set 'active' oleh PHP saat pertama kali load
    let index = 1;

    function showSlide() {
      slides.forEach(function (slide) {
        slide.classList.remove("active");
      });

      slides[index].classList.add("active");
      index = (index + 1) % slides.length;
    }

    // Hanya jalankan interval setiap 3 detik
    setInterval(showSlide, 3000);
  });
}

// Cek status dokumen: jika masih loading, pasang event listener. Jika sudah selesai, langsung eksekusi.
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initGallery);
} else {
  initGallery();
}