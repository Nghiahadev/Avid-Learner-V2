<?php
/**
 * FAQ – Avid Learner
 * - Author: Nghia Ha
 */

// Title + subtitle from Customizer
$title    = get_theme_mod('al_faq_title', 'Frequently Asked Questions');
$subtitle = get_theme_mod(
  'al_faq_subtitle',
  'Quick answers about Avid Learner—what it is, who it’s for, and how to stay updated.'
);

// FAQs from Customizer (up to 4)
$faqs = [];
for ($i = 1; $i <= 4; $i++) {
  $q = trim((string) get_theme_mod("al_faq_q_{$i}", ''));
  $a = trim((string) get_theme_mod("al_faq_a_{$i}", ''));

  if ($q !== '' && $a !== '') {
    $faqs[] = ['q' => $q, 'a' => $a];
  }
}

// Fallback default FAQs if none set in Customizer
if (empty($faqs)) {
  $faqs = [
    [
      'q' => 'What is Avid Learner?',
      'a' => 'Avid Learner is a leadership development and coaching firm that helps individuals, teams, and organizations grow stronger leaders and build more effective, aligned cultures.',
    ],
    [
      'q' => 'Who do you work with?',
      'a' => 'We work with executives, emerging leaders, teams, and organizations across industries who are committed to improving performance, leadership capability, and long-term growth.',
    ],
    [
      'q' => 'What types of services do you offer?',
      'a' => 'We offer executive coaching, leadership development programs, team and organizational development, and advisory support—designed to create practical, measurable impact.',
    ],
    [
      'q' => 'How is this different from traditional training?',
      'a' => 'Our approach goes beyond one-time training. We combine coaching, real-world application, and ongoing support to create lasting behavior change and meaningful results.',
    ],
    [
      'q' => 'Do you offer customized programs?',
      'a' => 'Yes. Every engagement is tailored to your goals, challenges, and organizational context to ensure relevance and impact.',
    ],
    [
      'q' => 'How do I get started?',
      'a' => 'The best first step is to book a conversation. We’ll learn about your goals and recommend the right approach for you or your organization.',
    ],
  ];
}

// Images from Customizer (attachment IDs -> URLs)
$imgs = [];
for ($i = 1; $i <= 4; $i++) {
  $img_id = (int) get_theme_mod("al_faq_img_{$i}", 0);
  if ($img_id) {
    $url = wp_get_attachment_image_url($img_id, 'full');
    if ($url) $imgs[] = $url;
  }
}

// Fallback images if none set
if (empty($imgs)) {
  $imgs = [
    "https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=80",
    "https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1600&q=80",
    "https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1600&q=80",
    "https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1600&q=80",
    "https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/A-Clear-Development-Process-scaled.jpeg",
    "https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/Insight-scaled.jpeg",
  ];
}
?>

<section class="al-faq" aria-label="Frequently Asked Questions">
  <div class="al-faq__container">

    <header class="al-faq__header">
      <h2 class="al-faq__title"><?php echo esc_html($title); ?></h2>
      <p class="al-faq__subtitle"><?php echo esc_html($subtitle); ?></p>
    </header>

    <div class="faq">
      <div class="faq__details">
        <?php foreach ($faqs as $i => $item) : ?>
          <details class="faq__item" <?php echo $i === 0 ? 'open' : ''; ?>>
            <summary><?php echo esc_html($item['q']); ?></summary>
            <p><?php echo esc_html($item['a']); ?></p>
          </details>
        <?php endforeach; ?>
      </div>

      <div class="faq__images">
        <div
          class="faq__image"
          style="background-image:url('<?php echo esc_url($imgs[0]); ?>');"
          data-faq-imgs="<?php echo esc_attr(wp_json_encode(array_values($imgs))); ?>"
          aria-label="FAQ image"
        ></div>
      </div>
    </div>

  </div>
</section>
