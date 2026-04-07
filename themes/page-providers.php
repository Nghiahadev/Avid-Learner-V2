<?php
/**
 * Providers Page (Hard-coded Hero Image)
 * Author: Nghia Ha
 */

get_header();

/* Providers section content from Customizer */
$providers_heading = get_theme_mod('al_providers_heading', 'Meet Our Providers');
$providers_desc    = get_theme_mod(
  'al_providers_desc',
  'Our team combines leadership, organizational, and coaching expertise to support growth at every level.'
);

$providers = [];
for ($i = 1; $i <= 24; $i++) {
  $name  = get_theme_mod("al_provider_{$i}_name", '');
  $bio   = get_theme_mod("al_provider_{$i}_bio", '');
  $image = get_theme_mod("al_provider_{$i}_image", '');

  if ($name || $bio || $image) {
    $providers[] = [
      'name'  => $name,
      'bio'   => $bio,
      'image' => $image,
    ];
  }
}
?>

<!-- HERO BANNER -->
<section
  class="al-hero"
  style="
    --hero-bg: url('https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/03/Provider-scaled.jpeg');
    --hero-h: 30rem;
  "
  aria-label="About banner"
>
  <div class="al-hero__inner">
    <h1 class="al-hero__title">Providers</h1>
    <div class="al-hero__divider"></div>
    <h2 class="al-hero__subtitle">Built for Growth. Delivered with Precision.</h2>
    <p class="al-hero__text">
      From strategy to execution, every service is designed to move your business
      forward with clarity, confidence, and measurable impact.
    </p>
  </div>
</section>

<main class="site-main services-page">

  <!-- Elementor / Gutenberg editable area -->
  <section class="home-elementor">
    <?php
    while (have_posts()) :
      the_post();
      the_content();
    endwhile;
    ?>
  </section>

  <!-- Providers Section -->
  <section class="al-providers-section">
    <div class="al-providers-container">
      <div class="al-providers-head">
        <h2 class="al-providers-title"><?php echo esc_html($providers_heading); ?></h2>
        <p class="al-providers-desc"><?php echo esc_html($providers_desc); ?></p>
      </div>

      <?php if (!empty($providers)) : ?>
        <div class="al-providers-grid">
          <?php foreach ($providers as $provider) : ?>
            <article class="al-provider-card">
              <?php if (!empty($provider['image'])) : ?>
                <div class="al-provider-image-wrap">
                  <img
                    src="<?php echo esc_url($provider['image']); ?>"
                    alt="<?php echo esc_attr($provider['name']); ?>"
                    class="al-provider-image"
                  />
                </div>
              <?php endif; ?>

              <div class="al-provider-content">
                <?php if (!empty($provider['name'])) : ?>
                  <h3 class="al-provider-name"><?php echo esc_html($provider['name']); ?></h3>
                <?php endif; ?>

                <?php if (!empty($provider['bio'])) : ?>
                  <p class="al-provider-bio"><?php echo esc_html($provider['bio']); ?></p>
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      <?php else : ?>
        <p class="al-providers-empty">Please add providers in the Customizer.</p>
      <?php endif; ?>
    </div>
  </section>

  <?php get_template_part('cta-consultation'); ?>
</main>

<?php get_footer(); ?>