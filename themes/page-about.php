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
    --hero-bg: url('https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/About-scaled.jpeg');
    --hero-h: 30rem;
  "
  aria-label="About banner"
>
  <div class="al-hero__inner">
    <h1 class="al-hero__title">About Us</h1>
    <div class="al-hero__divider"></div>
    <h2 class="al-hero__subtitle">Developing Leaders Who Drive Meaningful Impact.</h2>
    <p class="al-hero__text">
      We partner with individuals, teams, and organizations to strengthen leadership, improve performance, and navigate complexity with clarity and confidence.
    </p>
  </div>
</section>

<main class="site-main services-page">
  <?php
  while (have_posts()) :
    the_post();
    the_content();
  endwhile;
  ?>

      <!-- =====================================================
       ELEMENTOR EDITABLE AREA
       (Add sections in Elementor Editor for the Home page)
  ====================================================== -->
  <section class="home-elementor">
    <?php
    while ( have_posts() ) : the_post();
      the_content();
    endwhile;
    ?>
  </section>
    <!-- =====================================================
       CTA Consultation 
  ====================================================== -->
  <?php get_template_part('about-us'); ?>
  <?php get_template_part('about-values'); ?>
  <!-- <?php get_template_part('about-carousel'); ?> -->
  <?php get_template_part('about-cta-credentials'); ?>
  <?php get_template_part('faq-learning'); ?>


  <!-- Team Preview Section -->
<!-- <section class="al-about-team" aria-label="Meet our team">
  <div class="al-wrap">
    <header class="al-about-team__head">
      <span class="al-pill">Our Team</span>
      <h2 class="al-about-team__title">Meet the people behind Avid Learner</h2>
      <p class="al-about-team__sub">
        A small preview of our leadership and expert facilitators.
      </p>
    </header>

    <div class="al-about-team__grid">
      <?php echo do_shortcode('[al_team_grid posts="4" columns="4" cta="no"]'); ?>
    </div>

    <div class="al-about-team__actions">
      <a href="/our-team" class="btn3 btn3--hero">
        <span class="text">View All Team Members</span>
        <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
        <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
        <span class="circle" aria-hidden="true"></span>
      </a>  

    </div>
    
  </div>
</section> -->

  <?php get_template_part('cta-consultation'); ?>
</main>

<?php get_footer(); ?>
