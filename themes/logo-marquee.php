<?php
/**
 * Template Part: Client Logos
 * Author: Nghia Ha
 */

if (!defined('ABSPATH')) exit;
if (!get_theme_mod('al_logo_marquee_enabled', true)) return;

$raw   = (string) get_theme_mod('al_logo_marquee_logos', '');
$lines = array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", $raw)));

$items = [];
foreach ($lines as $line) {
  // format: image_url|https://link.com
  $parts = array_map('trim', explode('|', $line, 2));
  $img   = $parts[0] ?? '';
  $url   = $parts[1] ?? '';

  if ($img) {
    $items[] = [
      'img' => esc_url($img),
      'url' => $url ? esc_url($url) : '',
    ];
  }
}

if (count($items) === 0) return;
?>

<section class="al-client-logos" aria-label="Client logos">
  <div class="al-wrap">
    <div class="al-client-logos__head">
      <h2 class="al-client-logos__title">
        Trusted by leaders and organizations including
      </h2>
    </div>

    <div class="al-client-logos__marquee">
      <div class="al-client-logos__track">
        <?php for ($loop = 0; $loop < 2; $loop++) : ?>
          <?php foreach ($items as $it) : ?>
            <div class="al-client-logos__item">
              <?php if (!empty($it['url'])) : ?>
                <a href="<?php echo esc_url($it['url']); ?>" target="_blank" rel="noopener noreferrer" class="al-client-logos__link">
                  <img src="<?php echo esc_url($it['img']); ?>" alt="" class="al-client-logos__img" loading="lazy">
                </a>
              <?php else : ?>
                <img src="<?php echo esc_url($it['img']); ?>" alt="" class="al-client-logos__img" loading="lazy">
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</section>