<?php
if (!defined('ABSPATH')) exit;

/**
 * ABOUT CTA + CREDENTIALS
 * Author: Nghia Ha
 */

$enabled = get_theme_mod('al_about_cta_enabled', true);
if (!$enabled) return;

$title = get_theme_mod(
  'al_about_cta_title',
  'Built for Leaders Ready to Grow'
);

$desc = get_theme_mod(
  'al_about_cta_desc',
  'We partner with individuals, teams, and organizations committed to developing stronger leadership, building healthier cultures, and driving meaningful results.'
);

$btn_text = get_theme_mod('al_about_cta_btn_text', 'Explore How We Work');
$btn_url  = get_theme_mod('al_about_cta_btn_url', '/contact');

$creds = [];
for ($i = 1; $i <= 3; $i++) {
  $creds[] = [
    'icon'  => get_theme_mod("al_about_cred_{$i}_icon", 'fa-solid fa-star'),
    'label' => get_theme_mod("al_about_cred_{$i}_label", "Credential {$i}"),
  ];
}
?>

<section class="al-about-cta" aria-label="About CTA">
  <div class="al-wrap">
    <div class="al-cta-grid">

      <div class="al-cta-left">
        <h2><?php echo esc_html($title); ?></h2>
        <p><?php echo esc_html($desc); ?></p>

        <a class="al-cta-btn" href="<?php echo esc_url(home_url($btn_url)); ?>">
          <span><?php echo esc_html($btn_text); ?></span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>

      <div class="al-cta-right">
        <div class="al-creds-grid">
          <?php foreach ($creds as $c): ?>
            <div class="al-cred">
              <div class="al-cred-ic" aria-hidden="true">
                <i class="<?php echo esc_attr($c['icon']); ?>"></i>
              </div>
              <p><?php echo esc_html($c['label']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</section>