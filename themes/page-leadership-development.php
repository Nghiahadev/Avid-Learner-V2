<?php
/**
 * Leadership and Development Page (Hard-coded Hero Image)
 * Author: Nghia Ha
 */

get_header();
?>

<!-- HERO BANNER -->
<section
  class="al-hero"
  style="
    --hero-bg: url('https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/Leadership-and-Development-scaled.jpeg');
    --hero-h: 30rem;
  "
  aria-label="About banner"
>
  <div class="al-hero__inner">
    <h1 class="al-hero__title">Leadership Development</h1>
    <div class="al-hero__divider"></div>
    <h2 class="al-hero__subtitle">Stronger Leaders. Stronger Organizations.</h2>
    <p class="al-hero__text">
      We help leaders and teams build the skills, alignment, and confidence to perform at a higher level.
    </p>
  </div>
</section>

<main class="site-main services-page">

  <!-- Elementor / Gutenberg editable area -->
  <section class="home-elementor">
    <?php
    while (have_posts()) :
      the_post();
      the_content();
    endwhile;
    ?>
  </section>

  <!-- Scroll Fill Section -->
<section class="al-scrollfill-page">
  <div class="al-scrollfill-hero">
    <h2 class="al-scrollfill-title">Why Avid Learner</h2>

    <p class="al-scrollfill-text js-fill">
      <span>
Facilitators with real leadership and business experience
        <br><br>
Practical, actionable strategies — not theory
        <br><br>
Designed for real organizational challenges
        <br><br>
Focused on measurable growth and lasting impact
      </span>
    </p>
  </div>
</section>

<section class="al-leadership-services">
  <div class="al-container">

    <div class="al-services-header">
      <div class="al-services-title-wrap">
        <h3 class="al-services-title">Build Strong, Impactful Leaders</h3>
        <p class="al-services-title-text">
          Leadership development designed to strengthen decision-making, elevate teams,
          and drive measurable results.
        </p>
      </div>
    </div>

    <div class="al-intro-heading-wrap">
      <h4 class="al-intro-heading">Leadership Development That Moves Beyond Theory</h4>
    </div>

    <div class="al-intro-cards">
      <article class="al-intro-card">
        <h5>Partnering at Every Level</h5>
        <p>
          At Avid Learner, we partner with organizations to develop leaders at every
          level—from emerging managers to senior executives.
        </p>
      </article>

      <article class="al-intro-card">
        <h5>Practical Leadership Development</h5>
        <p>
          Our approach combines coaching, leadership training, and practical
          application to ensure development translates into real-world performance.
        </p>
      </article>

      <article class="al-intro-card">
        <h5>Built for Real Results</h5>
        <p>
          We focus on building the capabilities leaders need to navigate complexity,
          lead teams effectively, and drive results—through experiences that are
          tailored, relevant, and immediately applicable.
        </p>
      </article>
    </div>

    <div class="al-services-list">

      <article class="al-service-item js-service-item">
        <div class="al-service-number">01</div>

        <div class="al-service-content">
          <h4>Executive Leadership Growth</h4>
          <p>
            Strengthen how leaders think, decide, and show up. We focus on strategic clarity, executive presence, and the confidence needed to lead effectively at higher levels.
          </p>
        </div>

        <div class="al-service-image">
          <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1200&q=80" alt="Executive leadership growth">
        </div>
      </article>

      <article class="al-service-item js-service-item">
        <div class="al-service-number">02</div>

        <div class="al-service-content">
          <h4>Emotional Intelligence</h4>
          <p>
            Develop the self-awareness and communication skills that drive real influence. Leaders learn how to navigate conversations, build trust, and lead people—not just processes.
          </p>
        </div>

        <div class="al-service-image">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1200&q=80" alt="Emotional intelligence">
        </div>
      </article>

      <article class="al-service-item js-service-item">
        <div class="al-service-number">03</div>

        <div class="al-service-content">
          <h4>Team Leadership &amp; Culture</h4>
          <p>
          Build high-performing teams rooted in trust, accountability, and clarity. We help leaders shape cultures where people are aligned, engaged, and consistently delivering results.
          </p>
        </div>

        <div class="al-service-image">
          <img src="https://images.unsplash.com/photo-1515169067868-5387ec356754?auto=format&fit=crop&w=1200&q=80" alt="Team leadership and culture">
        </div>
      </article>

      <article class="al-service-item js-service-item">
        <div class="al-service-number">04</div>

        <div class="al-service-content">
          <h4>Change &amp; Growth Strategy</h4>
          <p>
            Lead through change with clarity and direction. We equip leaders to align teams, make confident decisions, and execute strategies that support sustainable growth.
          </p>
        </div>

        <div class="al-service-image">
          <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1200&q=80" alt="Change and growth strategy">
        </div>
      </article>

    </div>
  </div>
</section>
  <?php get_template_part('cta-consultation'); ?>
</main>

<?php get_footer(); ?>