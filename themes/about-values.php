<?php
if (!defined('ABSPATH')) exit;

/**
 * ABOUT VALUES - pulls from Customizer
 * Author: Nghia Ha
 */

// Enable toggle
$enabled = get_theme_mod('al_about_values_enabled', true);
if (!$enabled) return;

// Left content
$pill      = get_theme_mod('al_about_values_pill', 'HOW WE WORK');
$title     = get_theme_mod('al_about_values_title', 'The Way We Partner for Meaningful Impact ');
$highlight = get_theme_mod('al_about_values_highlight', 'Guide Us');
$subtitle  = get_theme_mod(
  'al_about_values_subtitle',
  "Our work is designed to be practical, thoughtful, and grounded in the realities leaders and organizations face every day."
);

// Values (4)
$values = [];
for ($i = 1; $i <= 4; $i++) {
  $values[] = [
    'icon'  => get_theme_mod("al_about_value_{$i}_icon", 'fa-solid fa-star'),
    'title' => get_theme_mod("al_about_value_{$i}_title", "Value {$i}"),
    'desc'  => get_theme_mod("al_about_value_{$i}_desc", "Value {$i} description."),
  ];
}

// Right card
$card_title = get_theme_mod('al_about_values_card_title', 'Our Approach');
$card_desc  = get_theme_mod(
  'al_about_values_card_desc',
  "We believe in a collaborative, data-driven approach that combines strategic thinking with practical execution. We don't just advise — we partner with you to implement solutions that deliver lasting impact."
);

// Metrics (3)
$metrics = [];
for ($i = 1; $i <= 3; $i++) {
  $metrics[] = [
    'end'    => get_theme_mod("al_about_metric_{$i}_end", ($i === 1 ? '500' : ($i === 2 ? '50' : '12'))),
    'suffix' => get_theme_mod("al_about_metric_{$i}_suffix", ($i === 1 ? '+' : ($i === 2 ? '+' : ''))),
    'label'  => get_theme_mod("al_about_metric_{$i}_label", ($i === 1 ? 'Projects' : ($i === 2 ? 'Experts' : 'Countries'))),
  ];
}
?>

<section class="al-about-values" aria-label="Our values">
  <div class="al-wrap">
    <div class="al-values-grid">

      <div class="al-values-left">
        <span class="al-pill"><?php echo esc_html($pill); ?></span>

        <h2 class="al-h2">
          <?php echo esc_html($title); ?> <span><?php echo esc_html($highlight); ?></span>
        </h2>

        <p class="al-sub"><?php echo esc_html($subtitle); ?></p>

        <div class="al-values-cards">
          <?php foreach ($values as $v): ?>
            <div class="al-value-item">
              <div class="al-value-ic" aria-hidden="true">
                <i class="<?php echo esc_attr($v['icon']); ?>"></i>
              </div>
              <div>
                <h3><?php echo esc_html($v['title']); ?></h3>
                <p><?php echo esc_html($v['desc']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="al-values-right">
        <div class="al-approach-card">
          <h3><?php echo esc_html($card_title); ?></h3>
          <p><?php echo esc_html($card_desc); ?></p>

          <div class="al-metrics">
            <?php foreach ($metrics as $m): ?>
              <div class="al-metric">
                <div class="al-metric-num">
                  <?php echo esc_html($m['end'] . $m['suffix']); ?>
                </div>
                <div class="al-metric-label">
                  <?php echo esc_html($m['label']); ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="al-blob b1"></div>
        <div class="al-blob b2"></div>
      </div>

    </div>
  </div>
</section>