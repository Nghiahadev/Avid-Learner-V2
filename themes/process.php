<?php
/**
 * Template Part: Process Section
 * Author: Nghia Ha
 */

if (!defined('ABSPATH')) exit;

// enable toggle (optional)
$enabled = get_theme_mod('al_process_enabled', true);
if (!$enabled) return;

// section text
$title  = get_theme_mod('al_process_title', 'How We Work Together');
$desc   = get_theme_mod(
  'al_process_desc',
  'A structured yet flexible process designed to meet you where you are and guide you where you want to be.'
);

// button
$button_text = get_theme_mod('al_process_button_text', 'Get Started');
$button_link_raw = trim((string) get_theme_mod('al_process_button_link', '/contact'));
if ($button_link_raw === '') $button_link_raw = '/contact';
$button_link = preg_match('#^https?://#i', $button_link_raw)
  ? esc_url($button_link_raw)
  : esc_url(home_url($button_link_raw[0] === '/' ? $button_link_raw : "/$button_link_raw"));

// steps (4)
$steps = [];
for ($i = 1; $i <= 4; $i++) {
  $steps[] = [
    'number'      => get_theme_mod("al_process_{$i}_number", str_pad($i, 2, '0', STR_PAD_LEFT)),
    'title'       => get_theme_mod("al_process_{$i}_title", "Step {$i} Title"),
    'description' => get_theme_mod("al_process_{$i}_desc", "Step {$i} description goes here."),
  ];
}
?>

<section class="al-process" aria-label="How We Work Together">
  <div class="al-container">

    <div class="al-process-head al-reveal" data-reveal="up">
      <h2 class="al-process-title"><?php echo esc_html($title); ?></h2>
      <p class="al-process-desc"><?php echo esc_html($desc); ?></p>
    </div>

    <div class="al-process-wrap">
      <div class="al-process-line" aria-hidden="true"></div>

      <div class="al-process-grid">
        <?php foreach ($steps as $i => $step): ?>
          <article class="al-process-card al-reveal" data-reveal="up" style="--delay: <?php echo esc_attr($i * 0.15); ?>s">
            <div class="al-process-badge" aria-hidden="true">
              <span><?php echo esc_html($step['number']); ?></span>
            </div>

            <div class="al-process-card-inner">
              <h3><?php echo esc_html($step['title']); ?></h3>
              <p><?php echo esc_html($step['description']); ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <div class="al-process-button-wrap al-reveal" data-reveal="up" style="--delay: 0.5s;">
        <a href="<?php echo $button_link; ?>" class="al-process-button">
          <?php echo esc_html($button_text); ?>
          <span aria-hidden="true">→</span>
        </a>
      </div>

    </div>
  </div>
</section>