document.addEventListener("DOMContentLoaded", function () {
  if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") return;

  gsap.registerPlugin(ScrollTrigger);

  const items = gsap.utils.toArray(".js-service-item");

  if (!items.length) return;

  items.forEach((item) => {
    const number = item.querySelector(".al-service-number");
    const content = item.querySelector(".al-service-content");
    const image = item.querySelector(".al-service-image img");

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: item,
        start: "top 82%",
        end: "top 35%",
        scrub: 1
      }
    });

    tl.to(item, {
      opacity: 1,
      y: 0,
      ease: "power2.out"
    }, 0);

    if (number) {
      tl.fromTo(number,
        { x: -40, opacity: 0.2 },
        { x: 0, opacity: 1, ease: "power2.out" },
        0
      );
    }

    if (content) {
      tl.fromTo(content,
        { y: 30, opacity: 0.15 },
        { y: 0, opacity: 1, ease: "power2.out" },
        0.05
      );
    }

    if (image) {
      tl.fromTo(image,
        { scale: 1.15, opacity: 0.4 },
        { scale: 1, opacity: 1, ease: "power2.out" },
        0.08
      );
    }
  });
});