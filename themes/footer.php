<?php
/**
 * Footer template for Avid Learner
 * Author: Nghia Ha
 */
if (!defined('ABSPATH')) exit;

$footer_title = get_theme_mod('al_footer_title', 'Join the Leadership Community');
$footer_desc  = get_theme_mod(
  'al_footer_desc',
  'A place where thoughtful leaders connect, share insights, and continue growing beyond traditional leadership programs.'
);

$footer_cta_text = get_theme_mod('al_footer_cta_text', 'Join the Community');
$circle_link = 'https://avid-learner.circle.so/join?invitation_token=f7ad6b6bb1f96a9c5a6532a0ef2db46fc62fb5b4-b6b2d07e-702f-474f-957b-6249f65a5231';

$footer_cta_link = get_theme_mod(
  'al_footer_cta_link',
  $circle_link
);

$newsletter_heading = get_theme_mod('al_footer_newsletter_heading', 'Join Our Newsletter');
$footer_note        = get_theme_mod('al_footer_note', 'Subscribe for leadership tips, updates, and more.');
$footer_note_small  = get_theme_mod('al_footer_note_small', 'Get updates delivered straight to your inbox.');

$year = date('Y');
?>

<footer class="al-footer" role="contentinfo">
  <div class="al-footer-inner">

    <div class="al-footer-top">
      <!-- Left Content -->
      <div class="al-footer-hero">
        <h2 class="al-footer-title"><?php echo esc_html($footer_title); ?></h2>

        <p class="al-footer-desc">
          <?php echo esc_html($footer_desc); ?>
        </p>

        <a class="al-footer-cta-btn" 
            href="<?php echo esc_url($footer_cta_link); ?>"
            target="_blank"
            rel="noopener noreferrer">
          <?php echo esc_html($footer_cta_text); ?>
        </a>

        <p class="al-footer-cta-subtext">
          Free and premium membership options available.
        </p>
      </div>

      <!-- Center Quick Links -->
      <div class="al-footer-links-center">
        <h3 class="al-footer-links-title">Quick Links</h3>
        <ul class="al-footer-menu">
          <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
          <li><a href="<?php echo esc_url(home_url('/services')); ?>">Services</a></li>
          <li><a href="<?php echo esc_url(home_url('/about')); ?>">About</a></li>
          <li><a href="<?php echo esc_url(home_url('/community')); ?>">Community</a></li>
          <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Us</a></li>
        </ul>
      </div>

      <!-- Right Newsletter -->
      <div class="al-footer-newsletter-card">
        <h3 class="al-footer-newsletter-title">
          <?php echo esc_html($newsletter_heading); ?>
        </h3>

        <p class="al-footer-newsletter-text">
          <?php echo esc_html($footer_note); ?>
        </p>

<div class="al-footer-newsletter">

  <form 
    class="beehiiv-form"
    action="https://magic.beehiiv.com/v1/50846767-fdd1-4acf-bbae-0ce078a4c5b2"
    method="GET"
    target="_blank"
  >

    <input 
      type="email" 
      name="email"
      placeholder="your@email.com"
      required
    >

    <button type="submit">
      Subscribe
    </button>

  </form>

</div>

        <p class="al-footer-newsletter-small">
          <?php echo esc_html($footer_note_small); ?>
        </p>
      </div>
    </div>

    <div class="al-footer-divider"></div>

    <div class="al-footer-bottom">
      <p>Copyright © <?php echo esc_html($year); ?> All Rights Reserved.</p>
    </div>

  </div>
</footer>

<nav class="bottom-nav">
  <a href="<?php echo esc_url(home_url('/')); ?>"
     class="nav-item <?php echo (is_front_page() || is_home()) ? 'active' : ''; ?>">
    <i class="fa-solid fa-house"></i>
    <span>Home</span>
  </a>

  <a href="<?php echo esc_url(home_url('/services')); ?>"
     class="nav-item <?php echo is_page('services') ? 'active' : ''; ?>">
    <i class="fa-solid fa-briefcase"></i>
    <span>Services</span>
  </a>

  <a href="<?php echo esc_url(home_url('/about')); ?>"
     class="nav-item <?php echo is_page('about') ? 'active' : ''; ?>">
    <i class="fa-solid fa-user"></i>
    <span>About</span>
  </a>

  <a href="<?php echo esc_url(home_url('/community')); ?>"
     class="nav-item <?php echo is_page('community') ? 'active' : ''; ?>">
    <i class="fa-solid fa-users"></i>
    <span>Community</span>
  </a>

  <a href="<?php echo esc_url(home_url('/contact')); ?>"
     class="nav-item <?php echo is_page('contact') ? 'active' : ''; ?>">
    <i class="fa-solid fa-envelope"></i>
    <span>Contact</span>
  </a>
</nav>

<?php wp_footer(); ?>
</body>
</html>