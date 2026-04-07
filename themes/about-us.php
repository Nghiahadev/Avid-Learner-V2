<?php
if ( ! get_theme_mod('al_about_enabled', true) ) return;
/**
 * About Section
 * Author: Nghia Ha
 */

$img1   = get_theme_mod('al_about_img_1', '');
$kicker = get_theme_mod('al_about_kicker', 'WHO WE ARE');
$title  = get_theme_mod('al_about_title', 'Built on Experience. <span>Focused on Impact.</span>');
$desc   = get_theme_mod(
  'al_about_desc',
  'Avid Learner brings together experienced leaders, coaches, and organizational development professionals who have worked inside the challenges our clients face. We understand leadership not as theory, but as something lived — shaped by real decisions, real teams, and real outcomes.'
);
?>

<section class="al-about" aria-label="About us">
  <div class="al-wrap">
    <div class="al-about-grid">

      <!-- LEFT IMAGE -->
      <div class="al-about-left">
        <div class="al-about-images">
          <div class="al-about-img al-img-1">
            <?php if ($img1): ?>
              <img src="<?php echo esc_url($img1); ?>" alt="About Avid Learner">
            <?php else: ?>
              <div class="al-placeholder">Set About Image 1 in Customizer</div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- RIGHT CONTENT -->
      <div class="al-about-right">
        <div class="al-about-head">
          <div class="al-about-kicker">
            <span><?php echo esc_html($kicker); ?></span>
          </div>

          <h2 class="al-about-title"><?php echo wp_kses_post($title); ?></h2>

          <?php if ($desc): ?>
            <p class="al-about-desc"><?php echo wp_kses_post($desc); ?></p>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>