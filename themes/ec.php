<?php
/**
 * Template Part: Executive Coaching Section
 * - Author: Nghia Ha
 */

if (!defined('ABSPATH')) exit;

$bg = 'https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/team-working-around-computers-men-scaled.jpg';
$kicker = get_theme_mod('al_ec_kicker', 'Executive Coaching');
$title  = get_theme_mod('al_ec_title', 'Elevate Your Leadership with Executive Coaching');
$desc   = get_theme_mod('al_ec_desc', 'Work one-on-one with an experienced coach to sharpen your decision-making, strengthen leadership skills, and accelerate your professional growth.');
$btn_t  = get_theme_mod('al_ec_btn_text', 'BOOK A SESSION');
$btn_u  = get_theme_mod('al_ec_btn_url', 'https://scheduler.zoom.us/kim-kerley-2shal7/fit-and-focus-call');

// If user typed "/executive-coaching" keep it. If they typed full URL, keep it.
$btn_url = $btn_u ? esc_url($btn_u) : home_url('/executive-coaching');

// Background style
$bg_style = '';
if (!empty($bg)) {
  $bg_style = "style=\"background-image:url('" . esc_url($bg) . "');\"";
}
?>

<section class="al-ec" <?php echo $bg_style; ?> aria-label="Executive Coaching">
  <div class="al-ec-overlay" aria-hidden="true"></div>

  <div class="al-container al-ec-inner">
    <div class="al-ec-content">
      <?php if (!empty($kicker)) : ?>
        <h6 class="al-ec-kicker"><?php echo esc_html($kicker); ?></h6>
      <?php endif; ?>

      <?php if (!empty($title)) : ?>
        <h3 class="al-ec-title"><?php echo esc_html($title); ?></h3>
      <?php endif; ?>

      <?php if (!empty($desc)) : ?>
        <p class="al-ec-desc"><?php echo esc_html($desc); ?></p>
      <?php endif; ?>

      <?php if (!empty($btn_t)) : ?>
        <div class="al-ec-btn-wrap">
          <a class="al-ec-btn"href="<?php echo esc_url($btn_url); ?>" target="_blank" rel="noopener noreferrer">
            <span class="al-ec-btn-text"><?php echo esc_html($btn_t); ?></span>
            <span class="al-ec-btn-dot" aria-hidden="true"></span>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>