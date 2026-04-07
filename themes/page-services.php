<?php
/**
 * Services Page (Hard-coded Hero Image)
 * Author: Nghia Ha
 */

get_header();
?>

<!-- HERO BANNER -->
<section
  class="al-hero"
  style="
    --hero-bg: url('https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/Services-scaled.jpeg');
    --hero-h: 30rem;
  "
  aria-label="Services banner"
>
  <div class="al-hero__inner">
    <h1 class="al-hero__title">Our Services</h1>
    <div class="al-hero__divider"></div>
    <h2 class="al-hero__subtitle">Leadership Development for Individuals, Teams, and Organizations</h2>
    <p class="al-hero__text">
      We partner with leaders and organizations through executive coaching, leadership development programs, and team-based experiences that support meaningful and lasting growth.
    </p>
  </div>
</section>

<main class="site-main services-page">

  <section class="services-content">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </section>

  <?php get_template_part('services-highlight'); ?>

  <!-- <?php get_template_part('services-grid'); ?> -->

  <?php get_template_part('stack-cards'); ?>

  <?php get_template_part('industries'); ?>

  <?php get_template_part('cta-consultation'); ?>

</main>

<?php get_footer(); ?>