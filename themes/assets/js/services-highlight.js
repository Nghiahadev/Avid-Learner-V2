"use strict";

document.addEventListener("DOMContentLoaded", function () {
  const section = document.querySelector(".al-services-pricing");
  if (!section) return;

  const cardsContainer = section.querySelector(".al-services-cards");
  const baseInner = section.querySelector(".al-services-cards__inner:not(.al-services-overlay)");
  const cards = Array.from(baseInner.querySelectorAll(".al-service-card"));
  const overlay = section.querySelector(".al-services-overlay");

  if (!cardsContainer || !cards.length || !overlay) return;

  const applyOverlayMask = (e) => {
    const rect = cardsContainer.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    overlay.style.setProperty("--opacity", "1");
    overlay.style.setProperty("--x", `${x}px`);
    overlay.style.setProperty("--y", `${y}px`);
  };

  const observer = new ResizeObserver((entries) => {
    entries.forEach((entry) => {
      const index = cards.indexOf(entry.target);
      if (index < 0 || !overlay.children[index]) return;

      const box = entry.borderBoxSize && entry.borderBoxSize[0]
        ? entry.borderBoxSize[0]
        : null;

      overlay.children[index].style.width =
        (box ? box.inlineSize : entry.target.offsetWidth) + "px";

      overlay.children[index].style.height =
        (box ? box.blockSize : entry.target.offsetHeight) + "px";
    });
  });

  cards.forEach((card) => {
    const overlayCard = card.cloneNode(true);
    overlayCard.setAttribute("aria-hidden", "true");
    overlay.appendChild(overlayCard);
    observer.observe(card);
  });

  cardsContainer.addEventListener("pointermove", applyOverlayMask);
  cardsContainer.addEventListener("pointerenter", () => {
    overlay.style.setProperty("--opacity", "1");
  });
  cardsContainer.addEventListener("pointerleave", () => {
    overlay.style.setProperty("--opacity", "0");
  });
});