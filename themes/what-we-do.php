<?php
/**
 * What We Do section
 * Author: Nghia Ha
 */
if (!defined('ABSPATH')) exit;

$heading   = get_theme_mod('al_wedo_heading', 'Expertise That Drives Results');
$highlight = get_theme_mod('al_wedo_highlight', 'Drives Results');
$desc      = get_theme_mod('al_wedo_desc', 'We combine deep industry knowledge with innovative methodologies to help businesses overcome challenges and achieve transformational growth.');

/* Safe highlighted heading */
$heading_plain   = wp_strip_all_tags((string) $heading);
$highlight_plain = wp_strip_all_tags((string) $highlight);
$heading_html    = esc_html($heading_plain);

if (!empty($highlight_plain) && strpos($heading_plain, $highlight_plain) !== false) {
  $pos    = strpos($heading_plain, $highlight_plain);
  $before = substr($heading_plain, 0, $pos);
  $after  = substr($heading_plain, $pos + strlen($highlight_plain));

  $heading_html =
    esc_html($before) .
    ' <span class="al-wedo-gradient">' . esc_html($highlight_plain) . '</span>' .
    esc_html($after);
}

/* Default cards with their own links */
$defaults = [
  [
    'title' => 'Executive Coaching',
    'desc'  => 'One-on-one coaching for leaders navigating growth, complexity, and high-stakes decisions.',
    'link'  => '/executive-coaching',
  ],
  [
    'title' => 'Leadership Development',
    'desc'  => 'Build leaders who think strategically, communicate clearly, and lead teams effectively.',
    'link'  => '/leadership-development',
  ],
  [
    'title' => 'Team & Organizational Development',
    'desc'  => 'Transform groups of individuals into aligned, high-trust teams.',
    'link'  => '/team-organizational-development',
  ],
];

$cards = [];
for ($i = 1; $i <= 3; $i++) {
  $link_raw = trim((string) get_theme_mod("al_wedo_{$i}_link", $defaults[$i - 1]['link']));
  if ($link_raw === '') {
    $link_raw = $defaults[$i - 1]['link'];
  }

  $card_link = preg_match('#^https?://#i', $link_raw)
    ? esc_url($link_raw)
    : esc_url(home_url($link_raw[0] === '/' ? $link_raw : "/$link_raw"));

  $cards[] = [
    'title' => get_theme_mod("al_wedo_{$i}_title", $defaults[$i - 1]['title']),
    'desc'  => get_theme_mod("al_wedo_{$i}_desc",  $defaults[$i - 1]['desc']),
    'link'  => $card_link,
  ];
}
?>

<section class="al-wedo2" aria-label="What We Do">
  <div class="al-wedo2-dots" aria-hidden="true"></div>

  <div class="al-wedo2-container">
    <div class="al-wedo2-head">
      <h2 class="al-wedo2-title">
        <?php echo wp_kses($heading_html, ['span' => ['class' => []]]); ?>
      </h2>

      <p class="al-wedo2-desc"><?php echo esc_html($desc); ?></p>
    </div>

    <div class="al-wedo2-grid">
      <?php foreach ($cards as $card): ?>
        <article class="al-wedo2-card">
          <div class="al-wedo2-glow"></div>

          <div class="al-wedo2-card-inner">
            <h3 class="al-wedo2-card-title"><?php echo esc_html($card['title']); ?></h3>
            <p class="al-wedo2-card-desc"><?php echo esc_html($card['desc']); ?></p>

            <a class="al-wedo2-link" href="<?php echo $card['link']; ?>">
              Learn more <span aria-hidden="true">→</span>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>