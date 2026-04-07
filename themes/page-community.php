<?php
/**
 * Template Name: Community Page
 * Author: Nghia Ha
 */

get_header();
?>

<!-- HERO BANNER -->
<section
  class="al-hero"
  style="
    --hero-bg: url('https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/Community-scaled.jpeg');
    --hero-h: 30rem;
  "
  aria-label="Community banner"
>
  <div class="al-hero__inner">
    <h1 class="al-hero__title">Community</h1>
    <div class="al-hero__divider"></div>
    <h2 class="al-hero__subtitle">Where Leaders Continue to Grow.</h2>
    <p class="al-hero__text">
Extend your development beyond programs through ongoing conversations, shared insights, and real-world leadership experiences. 
    </p>
  </div>
</section>

<main class="site-main community-page">

  <!-- COMMUNITY SERVICES SECTION -->
  <section class="community-services">
    <div class="container">
      <h2 class="al-scrollfill-title">
What You Gain from the Community
      </h2>

      <div class="community-services__grid">

        <div class="community-service-card">
          <div class="community-service-card__text">
            <h3>CONNECTION</h3>
            <p>
Build meaningful relationships with leaders across industries who are navigating similar challenges and opportunities. 
            </p>
          </div>

          <div class="community-service-card__image shape-top-left">
            <img
              src="https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/CMCoaching-scaled.jpeg"
              alt="Executive Coaching"
            >
          </div>
        </div>

        <div class="community-service-card">
          <div class="community-service-card__image shape-top-right">
            <img
              src="https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/CMLeadership-scaled.jpeg"
              alt="Leadership Development"
            >
          </div>

          <div class="community-service-card__text">
            <h3>LEARNING </h3>
            <p>
Access practical insights, tools, and conversations that help you grow as a leader in real time. 
            </p>
          </div>
        </div>

        <div class="community-service-card">
          <div class="community-service-card__text">
            <h3>SUPPORT </h3>
            <p>
Engage in discussion, ask questions, and learn from shared experiences within a trusted community. 
            </p>
          </div>

          <div class="community-service-card__image shape-bottom-left">
            <img
              src="https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/CMOrganizational-scaled.jpeg"
              alt="Team and Organizational Development"
            >
          </div>
        </div>

        <div class="community-service-card">
          <div class="community-service-card__image shape-bottom-right">
            <img
              src="https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/CMConsulting-scaled.jpeg"
              alt="Consulting and Advisory"
            >
          </div>

          <div class="community-service-card__text">
            <h3>APPLICATION </h3>
            <p>
Turn ideas into action through ongoing exposure to strategies, perspectives, and real-world leadership scenarios.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>



  <section class="al-circle-section">
  <div class="al-circle-container">
    <div class="al-circle-content">
      <span class="al-circle-eyebrow">Community</span>
      <h2 class="al-circle-title">Where Leaders Continue to Grow </h2>
      <p class="al-circle-text">
Extend your development beyond programs through ongoing conversations, shared insights, and real-world leadership experiences.
      </p>

      <div class="al-circle-actions">
        <a 
          href="https://avid-learner.circle.so/join?invitation_token=f7ad6b6bb1f96a9c5a6532a0ef2db46fc62fb5b4-b6b2d07e-702f-474f-957b-6249f65a5231" 
          class="al-circle-btn"
          target="_blank"
          rel="noopener noreferrer"
        >
          Join the Community
        </a>
      </div>
    </div>
  </div>
</section>


  <!-- ELEMENTOR / PAGE CONTENT -->
  <section class="community-elementor">
    <?php
    while ( have_posts() ) :
      the_post();
      the_content();
    endwhile;
    ?>
  </section>

  <?php get_template_part('cta-consultation'); ?>
</main>

<?php get_footer(); ?>