<?php
/**
 * Template Part: Home - Hero Slider
 * Author: Nghia Ha
 */
if (!defined('ABSPATH')) exit;

$enabled = get_theme_mod('al_hero_enabled', true);
if (!$enabled) return;

// Slides (3)
$slides = [];
for ($i = 1; $i <= 3; $i++) {

  $slides[] = [
    'bg'    => get_theme_mod("al_hero_{$i}_bg", ''),
    'eyebrow' => get_theme_mod("al_hero_{$i}_eyebrow", "Leadership Coaching and Development"),
    'h1'    => get_theme_mod("al_hero_{$i}_title", "Slide {$i} Title"),
    'p'     => get_theme_mod("al_hero_{$i}_desc", "Slide {$i} description."),
    'btn1_text' => get_theme_mod("al_hero_{$i}_btn1_text", 'Book a Conversation'),
    'btn1_url'  => get_theme_mod("al_hero_{$i}_btn1_url", '/contact'),
    'btn2_text' => get_theme_mod("al_hero_{$i}_btn2_text", 'View Services'),
    'btn2_url'  => get_theme_mod("al_hero_{$i}_btn2_url", '/services'),
  ];
}

// fallback backgrounds if empty
$fallbacks = [
  1 => 'https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/slide-1-scaled.jpeg',
  2 => 'https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/slide-2-scaled.jpeg',
  3 => 'https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/slide-3-1-scaled.jpeg',
];
foreach ($slides as $idx => $s) {
  $n = $idx + 1;
  if (trim($slides[$idx]['bg']) === '') $slides[$idx]['bg'] = $fallbacks[$n];
}
?>

<!-- =====================================================
     HERO SLIDER (Template Part + Customizer)
====================================================== -->
<section class="al-slider" aria-label="Homepage Slider">
  <div class="al-slider-track">

    <?php foreach ($slides as $i => $s): ?>
      <article
        class="al-slide <?php echo $i === 0 ? 'is-active' : ''; ?>"
        style="--bg:url('<?php echo esc_url($s['bg']); ?>');"
      >
        <div class="al-slide-overlay"></div>
        <div class="al-slide-content">
          <?php if (!empty($s['eyebrow'])): ?>
            <div class="al-slide-eyebrow"><?php echo esc_html($s['eyebrow']); ?></div>
          <?php endif; ?>
          <h1><?php echo esc_html($s['h1']); ?></h1>
          <p><?php echo esc_html($s['p']); ?></p>

<div class="al-slide-actions">
  
  <!-- Button 1 -->
  <a href="<?php echo esc_url('https://scheduler.zoom.us/kim-kerley-2shal7/fit-and-focus-call'); ?>" 
     class="btn3 btn3--hero"
     target="_blank"
     rel="noopener noreferrer">
     
    <span class="text">
      <?php echo esc_html($s['btn1_text']); ?>
    </span>

    <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true">
      <path d="M5 12h14M13 5l7 7-7 7"></path>
    </svg>

    <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true">
      <path d="M5 12h14M13 5l7 7-7 7"></path>
    </svg>

    <span class="circle" aria-hidden="true"></span>
  </a>


  <!-- Button 2 -->
  <a href="<?php echo esc_url(al_to_url($s['btn2_url'])); ?>" 
     class="btn3 btn3--hero btn3--ghost"
     target="_blank"
     rel="noopener noreferrer">
     
    <span class="text">
      <?php echo esc_html($s['btn2_text']); ?>
    </span>

    <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true">
      <path d="M5 12h14M13 5l7 7-7 7"></path>
    </svg>

    <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true">
      <path d="M5 12h14M13 5l7 7-7 7"></path>
    </svg>

    <span class="circle" aria-hidden="true"></span>
  </a>

</div>
        </div>
      </article>
    <?php endforeach; ?>

  </div>

  <!-- Controls -->
  <button class="al-slider-btn prev" type="button" aria-label="Previous slide">‹</button>
  <button class="al-slider-btn next" type="button" aria-label="Next slide">›</button>

  <!-- Dots -->
  <div class="al-slider-dots" role="tablist" aria-label="Slide navigation">
    <?php for ($d = 1; $d <= 3; $d++): ?>
      <button class="al-dot <?php echo $d === 1 ? 'is-active' : ''; ?>" type="button"
              aria-label="<?php echo esc_attr("Go to slide {$d}"); ?>"></button>
    <?php endfor; ?>
  </div>
</section>
