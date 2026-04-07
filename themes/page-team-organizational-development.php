<?php
/**
 * Template Name: Team & Organizational Development
 * Author: Nghia Ha
 */

get_header();
?>

<!-- HERO BANNER -->
<section
  class="al-hero"
  style="
    --hero-bg: url('https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/Team-Organizational-Development-scaled.jpeg');
    --hero-h: 30rem;
  "
  aria-label="Team and Organizational Development banner"
>
  <div class="al-hero__inner">
    <h1 class="al-hero__title">Team &amp; Organizational Development</h1>
    <div class="al-hero__divider"></div>
    <h2 class="al-hero__subtitle">Aligned Teams. Stronger Performance.</h2>
    <p class="al-hero__text">
      We help organizations strengthen collaboration, improve alignment, and build
      healthier team environments that support long-term success.
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
      <h2 class="al-scrollfill-title">Development That Moves Teams Forward</h2>

      <p class="al-scrollfill-text js-fill">
        <span>
  We work with teams and organizations to improve how people work together
          <br><br>
  Strengthening trust, communication, and alignment around shared goals.
          <br><br>
  Our approach focuses on practical strategies that drive engagement, performance, and long-term impact.

        </span>
      </p>
    </div>
  </section>

  <section class="al-leadership-services">
    <div class="al-container">

      <div class="al-services-header">
        <div class="al-services-title-wrap">
          <h3 class="al-services-title">BUILD HIGH-PERFORMING TEAMS</h3>
          <p class="al-services-title-text">
            Team and organizational development designed to improve collaboration,
            strengthen culture, and create better results across the business.
          </p>
        </div>
      </div>

      <div class="al-intro-heading-wrap">
        <h4 class="al-intro-heading">Development That Helps Teams Work Better Together</h4>
      </div>

      <div class="al-intro-cards">
        <article class="al-intro-card">
          <h5>Team Alignment & Effectiveness</h5>
          <p>
    Clarify roles, strengthen accountability, and align teams around shared priorities and outcomes.
          </p>
        </article>

        <article class="al-intro-card">
          <h5>Communication & Collaboration</h5>
          <p>
    Improve how teams communicate, resolve challenges, and work together more effectively.
          </p>
        </article>

        <article class="al-intro-card">
          <h5>Culture & Engagement</h5>
          <p>
    Shape a culture that supports trust, resilience, and high performance across the organization.
          </p>
        </article>

                <article class="al-intro-card">
          <h5>Change & Organizational Growth</h5>
          <p>
    Support teams through change initiatives and build the foundation for sustainable growth.          </p>
        </article>
      </div>
    </div>
  </section>

  <?php get_template_part('cta-consultation'); ?>
</main>

<?php get_footer(); ?>