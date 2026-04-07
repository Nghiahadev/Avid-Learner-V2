document.addEventListener("DOMContentLoaded", function () {
  if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") return;

  gsap.registerPlugin(ScrollTrigger);

  const target = document.querySelector(".js-fill > span");

  if (target && !window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    gsap.to(target, {
      backgroundSize: "200% 200%",
      ease: "none",
      scrollTrigger: {
        trigger: ".js-fill",
        start: "top 80%",
        end: "bottom 35%",
        scrub: true
      }
    });
  }
});