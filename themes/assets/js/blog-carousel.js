document.addEventListener("DOMContentLoaded", () => {
  const section = document.querySelector("[data-latest-blog]");
  if (!section) return;

  const carousel = section.querySelector("[data-blog-carousel]");
  const track = section.querySelector(".al-blog-track");
  const slides = track ? Array.from(track.children) : [];

  const prevBtn = section.querySelector(".al-blog-prev");
  const nextBtn = section.querySelector(".al-blog-next");

  if (!carousel || !track || slides.length === 0) return;

  let index = 0;
  let timer = null;
  const INTERVAL_MS = 2000; //  2 second

  const perView = () => {
    const w = window.innerWidth;
    if (w <= 640) return 1;
    if (w <= 1024) return 2;
    return 3;
  };

  const step = () => {
    const first = slides[0];
    if (!first) return 0;
    const slideW = first.getBoundingClientRect().width;
    const gap = parseFloat(getComputedStyle(track).gap) || 0;
    return slideW + gap;
  };

  const maxIndex = () => Math.max(0, slides.length - perView());

  const update = () => {
    const s = step();
    const max = maxIndex();
    if (index > max) index = 0;
    if (index < 0) index = max;

    track.style.transform = `translateX(-${index * s}px)`;

    // still allow clicking even if few posts
    if (prevBtn) prevBtn.disabled = slides.length <= perView();
    if (nextBtn) nextBtn.disabled = slides.length <= perView();
  };

  const next = () => {
    const max = maxIndex();
    index = (index >= max) ? 0 : index + 1;  // ✅ 1-by-1
    update();
  };

  const prev = () => {
    const max = maxIndex();
    index = (index <= 0) ? max : index - 1;  // ✅ 1-by-1
    update();
  };

  const start = () => {
    if (timer) return;
    timer = setInterval(next, INTERVAL_MS);
  };

  const stop = () => {
    if (!timer) return;
    clearInterval(timer);
    timer = null;
  };

  // Buttons
  prevBtn?.addEventListener("click", () => { stop(); prev(); start(); });
  nextBtn?.addEventListener("click", () => { stop(); next(); start(); });

  // Pause on hover
  section.addEventListener("mouseenter", stop);
  section.addEventListener("mouseleave", start);
  section.addEventListener("focusin", stop);
  section.addEventListener("focusout", start);

  // Fix: recalc after images load
  const imgs = section.querySelectorAll("img");
  let pending = 0;
  imgs.forEach(img => {
    if (!img.complete) {
      pending++;
      img.addEventListener("load", () => {
        pending--;
        if (pending <= 0) update();
      }, { once: true });
    }
  });

  window.addEventListener("resize", update);
  window.addEventListener("load", update);

  update();
  start();
});
