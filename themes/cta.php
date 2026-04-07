<?php
/**
 * Template Part: CTA Section
 * Author: Nghia Ha
 */

if (!defined('ABSPATH')) exit;

$image = get_theme_mod(
  'al_cta_image',
  'https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/team-working-around-computers-men-scaled.jpg'
);

$title = get_theme_mod('al_cta_title', 'The Leadership Gap');

$desc_1 = get_theme_mod(
  'al_cta_desc_1',
  'Most organizations promote talented people into leadership roles without preparing them to lead.'
);

$desc_2 = get_theme_mod(
  'al_cta_desc_2',
  'Technical expertise doesn’t automatically make a great leader.'
);

$link_t = get_theme_mod('al_cta_link_text', 'We help you close the gap.');
$link_u = get_theme_mod('al_cta_link_url', '/contact');

$link_url = !empty($link_u) ? esc_url($link_u) : esc_url(home_url('/contact'));
?>

<section class="al-cta-split" aria-label="Leadership call to action">
  <div class="al-cta-split__inner">

    <div class="al-cta-split__content">

      <?php if (!empty($title)) : ?>
        <h2 class="al-cta-split__title"><?php echo esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($desc_1)) : ?>
        <p class="al-cta-split__text"><?php echo esc_html($desc_1); ?></p>
      <?php endif; ?>

      <?php if (!empty($desc_2)) : ?>
        <p class="al-cta-split__text"><?php echo esc_html($desc_2); ?></p>
      <?php endif; ?>

      <?php if (!empty($link_t)) : ?>
        <a
          class="al-cta-split__link"
          href="<?php echo $link_url; ?>"
          target="_blank"
          rel="noopener noreferrer"
        >
          <?php echo esc_html($link_t); ?>
        </a>
      <?php endif; ?>

    </div>

    <div class="al-cta-split__media">
      <img
        src="<?php echo esc_url($image); ?>"
        alt="<?php echo esc_attr($title ?: 'Leadership team meeting'); ?>"
        class="al-cta-split__img"
        loading="lazy"
      >
      <div class="al-cta-split__fade" aria-hidden="true"></div>
    </div>

  </div>
</section>