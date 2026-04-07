<?php
if (!defined('ABSPATH')) exit;

/**
 * - Author: Nghia Ha
 */
 

// Enable toggle
$enabled = get_theme_mod('al_about_timeline_enabled', true);
if (!$enabled) return;

// Header
$pill      = get_theme_mod('al_about_timeline_pill', 'Our Journey');
$title_1   = get_theme_mod('al_about_timeline_title_1', 'The');
$highlight = get_theme_mod('al_about_timeline_highlight', 'ApexConsult');

// Timeline items (5)
$timeline = [];
for ($i = 1; $i <= 5; $i++) {
  $timeline[] = [
    'year'  => get_theme_mod("al_timeline_{$i}_year", ''),
    'title' => get_theme_mod("al_timeline_{$i}_title", ''),
    'desc'  => get_theme_mod("al_timeline_{$i}_desc", ''),
  ];
}

// Remove empty rows (if user deletes text)
$timeline = array_values(array_filter($timeline, function($t){
  return trim($t['year']) !== '' || trim($t['title']) !== '' || trim($t['desc']) !== '';
}));

if (empty($timeline)) return;
?>

<section class="al-about-timeline" aria-label="Our journey">
  <div class="al-wrap">
    <header class="al-section-head center">
      <span class="al-pill"><?php echo esc_html($pill); ?></span>
      <h2 class="al-h2">
        <?php echo esc_html($title_1); ?> <span><?php echo esc_html($highlight); ?></span> Story
      </h2>
    </header>

    <div class="al-timeline">
      <div class="al-timeline-line" aria-hidden="true">
        <span class="al-timeline-line-fill" aria-hidden="true"></span>
      </div>

      <?php foreach ($timeline as $i => $t):
        $side = ($i % 2 === 0) ? 'left' : 'right';
      ?>
        <article class="al-timeline-item <?php echo esc_attr($side); ?>" data-animate="timeline">
          <div class="al-timeline-content">
            <div class="al-year"><?php echo esc_html($t['year']); ?></div>
            <h3><?php echo esc_html($t['title']); ?></h3>
            <p><?php echo esc_html($t['desc']); ?></p>
          </div>
          <div class="al-dot" aria-hidden="true"></div>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>
