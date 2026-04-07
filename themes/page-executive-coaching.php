<?php
/**
 * Template Name: Executive Coaching
 * Author: Nghia Ha
 */

get_header();
?>

<!-- HERO BANNER -->
<section
  class="al-hero"
  style="
    --hero-bg: url('https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/Executive-Coaching-scaled.jpeg');
    --hero-h: 30rem;
  "
  aria-label="Executive Coaching banner"
>
  <div class="al-hero__inner">
    <h1 class="al-hero__title">Executive Coaching</h1>
    <div class="al-hero__divider"></div>
    <h2 class="al-hero__subtitle">Confident Leaders. Meaningful Results.</h2>
    <p class="al-hero__text">
      We help leaders strengthen decision-making, improve communication, and lead
      with greater clarity, confidence, and purpose.
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
          Coaching grounded in real leadership and business experience
          <br><br>
          Practical support for real executive challenges
          <br><br>
          Focused on self-awareness, influence, and strategic leadership
          <br><br>
          Designed to create growth that is measurable and lasting
        </span>
      </p>
    </div>
  </section>

  <section class="al-leadership-services">
    <div class="al-container">

      <div class="al-services-header">
        <div class="al-services-title-wrap">
          <h3 class="al-services-title">Coaching Designed for Real Leadership Challenges</h3>
          <p class="al-services-title-text">
Our executive coaching is tailored to the realities leaders face today — navigating complexity, making critical decisions, and leading people through change.
<br>We don’t offer generic frameworks. We partner with leaders to build clarity, confidence, and measurable impact.
<br>
          </p>
        </div>
      </div>

      <div class="al-intro-heading-wrap">
        <h4 class="al-intro-heading">ELEVATE YOUR LEADERSHIP </h4>
      </div>

      <div class="al-intro-cards">
        <article class="al-intro-card">
          <h5>Executive Presence & Influence</h5>
          <p>
            Strengthen how you show up as a leader — from communication and confidence to presence in high-impact moments.
          </p>
        </article>

        <article class="al-intro-card">
          <h5>Decision-Making & Strategic Thinking</h5>
          <p>
            Improve your ability to assess complexity, make sound decisions, and think more strategically under pressure.
          </p>
        </article>

        <article class="al-intro-card">
          <h5>Leading Through Change</h5>
          <p>
            Navigate uncertainty, lead transformation, and guide teams through evolving business environments.
          </p>
        </article>

                <article class="al-intro-card">
          <h5>Self-Awareness & Growth</h5>
          <p>
            Develop deeper self-awareness, emotional intelligence, and leadership habits that sustain long-term success.          </p>
        </article>

      </div>

    </div>
  </section>

  <?php get_template_part('cta-consultation'); ?>
</main>

<?php get_footer(); ?>