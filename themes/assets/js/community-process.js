document.addEventListener("DOMContentLoaded", function () {
  const processItems = document.querySelectorAll(".interactive-inner-process");
  const processImages = document.querySelectorAll(".interactive-process-image");

  if (!processItems.length || !processImages.length) return;

  processItems.forEach((item) => {
    item.addEventListener("mouseenter", function () {
      const index = this.getAttribute("data-index");

      processItems.forEach((el) => el.classList.remove("activate"));
      this.classList.add("activate");

      processImages.forEach((img) => img.classList.remove("show"));

      const activeImage = document.querySelector(".interactive-process-image.img-" + index);
      if (activeImage) {
        activeImage.classList.add("show");
      }
    });
  });
});