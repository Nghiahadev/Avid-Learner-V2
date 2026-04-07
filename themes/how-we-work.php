<?php
/**
 * Template Part: Home - How We Work (Tabs + Blob)
 * Author: Nghia Ha
 */
if (!defined('ABSPATH')) exit;

// Toggle
$enabled = get_theme_mod('al_hww_enabled', true);
if (!$enabled) return;

// Left
$title    = get_theme_mod('al_hww_title', 'How We Work');
$subtitle = get_theme_mod('al_hww_subtitle', 'A thoughtful, hands-on consulting process designed to create real impact.');

// Tabs
$tabs = [
  'strategy'   => get_theme_mod('al_hww_tab1_label', 'Strategy'),
  'execution'  => get_theme_mod('al_hww_tab2_label', 'Execution'),
  'partnership'=> get_theme_mod('al_hww_tab3_label', 'Partnership'),
];

$tab_content = [
  'strategy'    => get_theme_mod('al_hww_tab1_desc', 'We analyze, simplify, and define a clear path forward—aligned with your goals.'),
  'execution'   => get_theme_mod('al_hww_tab2_desc', 'We turn ideas into action, supporting implementation every step of the way.'),
  'partnership' => get_theme_mod('al_hww_tab3_desc', 'We stay involved to adapt, refine, and grow with your business.'),
];

// Button
$btn_text = get_theme_mod('al_hww_btn_text', 'Book a Consultation');
$btn_url  = get_theme_mod('al_hww_btn_url', '/contact');

// Right image
$image_url = get_theme_mod(
  'al_hww_image_url',
  'https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/working-group-huddled-around-and-pointing-at-shared-laptop-scaled.jpg'
);

// Rotating text
$ring_text = get_theme_mod('al_hww_ring_text', '✨ Crafted with Care');
$ring_text = trim($ring_text);
if ($ring_text === '') $ring_text = '✨ Crafted with Care';

// repeat the phrase to fill the loop nicely
$ring_repeat = ($ring_text . ' ') . ($ring_text . ' ') . ($ring_text . ' ');
?>

<!-- =====================================================
       HOW WE WORK (Template Part + Customizer)
====================================================== -->
<section id="how-we-work" class="consulting-approach" data-tabs>
  <div class="approach-inner">

    <!-- LEFT -->
    <div class="approach-content">
      <h2><?php echo esc_html($title); ?></h2>
      <p class="subtitle"><?php echo esc_html($subtitle); ?></p>

      <div class="tabs">
        <button class="tab active" type="button" data-tab="strategy"><?php echo esc_html($tabs['strategy']); ?></button>
        <button class="tab" type="button" data-tab="execution"><?php echo esc_html($tabs['execution']); ?></button>
        <button class="tab" type="button" data-tab="partnership"><?php echo esc_html($tabs['partnership']); ?></button>
      </div>

      <div class="tab-content active" id="strategy">
        <p><?php echo esc_html($tab_content['strategy']); ?></p>
      </div>

      <div class="tab-content" id="execution">
        <p><?php echo esc_html($tab_content['execution']); ?></p>
      </div>

      <div class="tab-content" id="partnership">
        <p><?php echo esc_html($tab_content['partnership']); ?></p>
      </div>

      <a href="<?php echo esc_url(al_to_url($btn_url)); ?>" class="btn3 btn3--hero">
        <span class="text"><?php echo esc_html($btn_text); ?></span>
        <svg class="arr-1" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
        <svg class="arr-2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"></path></svg>
        <span class="circle" aria-hidden="true"></span>
      </a>
    </div>

    <!-- RIGHT -->
    <div class="approach-visual">
      <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" aria-label="Decorative blob image">
        <image
          href="<?php echo esc_url($image_url); ?>"
          width="200" height="200"
          preserveAspectRatio="xMidYMid slice"
          clip-path="url(#blobClip)"
        />
        <clipPath id="blobClip">
          <path d="M43.1,-68.5C56.2,-58.6,67.5,-47.3,72.3,-33.9C77.2,-20.5,75.5,-4.9,74.2,11.3C72.9,27.6,71.9,44.5,63.8,57.2C55.7,69.8,40.6,78.2,25.5,79.2C10.4,80.1,-4.7,73.6,-20.9,69.6C-37.1,65.5,-54.5,63.9,-66,54.8C-77.5,45.8,-83.2,29.3,-85.7,12.3C-88.3,-4.8,-87.7,-22.3,-79.6,-34.8C-71.5,-47.3,-55.8,-54.9,-41.3,-64.2C-26.7,-73.6,-13.4,-84.7,0.8,-86C15,-87.2,29.9,-78.5,43.1,-68.5Z"
                transform="translate(100 100)"/>
        </clipPath>

        <path
          id="textPathBlob"
          d="M43.1,-68.5C56.2,-58.6,67.5,-47.3,72.3,-33.9C77.2,-20.5,75.5,-4.9,74.2,11.3C72.9,27.6,71.9,44.5,63.8,57.2C55.7,69.8,40.6,78.2,25.5,79.2C10.4,80.1,-4.7,73.6,-20.9,69.6C-37.1,65.5,-54.5,63.9,-66,54.8C-77.5,45.8,-83.2,29.3,-85.7,12.3C-88.3,-4.8,-87.7,-22.3,-79.6,-34.8C-71.5,-47.3,-55.8,-54.9,-41.3,-64.2C-26.7,-73.6,-13.4,-84.7,0.8,-86C15,-87.2,29.9,-78.5,43.1,-68.5Z"
          transform="translate(100 100)"
          fill="none"
          stroke="none"
          pathLength="100"
        />

        <text class="text-content">
          <textPath href="#textPathBlob" startOffset="0%">
            <?php echo esc_html($ring_repeat); ?>
            <animate attributeName="startOffset" from="0%" to="100%" dur="15s" repeatCount="indefinite" />
          </textPath>
          <textPath href="#textPathBlob" startOffset="100%">
            <?php echo esc_html($ring_repeat); ?>
            <animate attributeName="startOffset" from="-100%" to="0%" dur="15s" repeatCount="indefinite" />
          </textPath>
        </text>
      </svg>
    </div>

  </div>
</section>
