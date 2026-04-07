(function () {
  function animateSkillbar(skillbar) {
    if (skillbar.dataset.animated === "1") return;

    const fill = skillbar.querySelector(".count-bar");
    if (!fill) return;

    // Read percent from either data-pct or data-percent
    const pctFromBar = fill.getAttribute("data-pct");
    const pctFromSkillbar = (skillbar.getAttribute("data-percent") || "0%").replace("%", "");
    const pct = Math.max(0, Math.min(100, parseInt(pctFromBar || pctFromSkillbar || "0", 10)));

    // Hard reset to 0
    fill.style.transition = "none";
    fill.style.width = "0%";

    // Force browser reflow so 0% is applied
    void fill.offsetWidth;

    // Animate to target
    fill.style.transition = "width 1.2s ease-in-out";
    fill.style.width = pct + "%";

    skillbar.dataset.animated = "1";
  }

  function init() {
    const bars = document.querySelectorAll(".skillbar");
    if (!bars.length) return;

    // Always start at 0 (even before scroll)
    bars.forEach((b) => {
      const fill = b.querySelector(".count-bar");
      if (fill) fill.style.width = "0%";
      b.dataset.animated = "0";
    });

    if ("IntersectionObserver" in window) {
      const io = new IntersectionObserver(
        (entries) => {
          entries.forEach((e) => {
            if (e.isIntersecting) animateSkillbar(e.target);
          });
        },
        { threshold: 0.25 }
      );

      bars.forEach((b) => io.observe(b));
      return;
    }

    // Fallback for older browsers
    const onScroll = () => {
      bars.forEach((b) => {
        const rect = b.getBoundingClientRect();
        if (rect.top < window.innerHeight * 0.8) animateSkillbar(b);
      });
    };
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
  }

  document.addEventListener("DOMContentLoaded", init);
})();
