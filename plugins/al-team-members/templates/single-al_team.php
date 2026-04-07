<?php
if (!defined('ABSPATH')) exit;

get_header();

$role      = get_post_meta(get_the_ID(), '_al_role', true);
$location  = get_post_meta(get_the_ID(), '_al_location', true);
$phone     = get_post_meta(get_the_ID(), '_al_phone', true);
$email     = get_post_meta(get_the_ID(), '_al_email', true);

$pin   = get_post_meta(get_the_ID(), '_al_social_linkedin', true);
$tw    = get_post_meta(get_the_ID(), '_al_social_twitter', true);
$fb    = get_post_meta(get_the_ID(), '_al_social_facebook', true);
$ig    = get_post_meta(get_the_ID(), '_al_social_instagram', true);

$bio2  = get_post_meta(get_the_ID(), '_al_bio_2', true);
$skills = get_post_meta(get_the_ID(), '_al_skills', true);
if (!is_array($skills)) $skills = [];

?>
<!-- HERO BANNER -->
<section
  class="al-hero"
  style="
    --hero-bg: url('https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/About-scaled.jpeg');
    --hero-h: 30rem;
  "
  aria-label="About banner"
>
  <div class="al-hero__inner">
    <h1 class="al-hero__title">About Us</h1>
    <div class="al-hero__divider"></div>
    <h2 class="al-hero__subtitle">Built for Growth. Delivered with Precision.</h2>
    <p class="al-hero__text">
      From strategy to execution, every service is designed to move your business
      forward with clarity, confidence, and measurable impact.
    </p>
  </div>
</section>

<div class="page-team-single">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <div class="team-single-box">

          <!-- Team About Box -->
          <div class="team-about-box">

            <div class="team-single-image">
              <figure class="image-anime reveal">
                <?php if (has_post_thumbnail()): ?>
                  <?php the_post_thumbnail('large'); ?>
                <?php else: ?>
                  <div class="al-team-thumb-placeholder"><i class="fa-solid fa-user"></i></div>
                <?php endif; ?>
              </figure>
            </div>

            <div class="team-about-content">

              <div class="section-title">
                <h2 class="text-anime-style-3" data-cursor="-opaque"><?php the_title(); ?></h2>
                <?php if ($role): ?><p class="wow fadeInUp"><?php echo esc_html($role); ?></p><?php endif; ?>
              </div>

              <!-- Social -->
              <div class="member-social-list wow fadeInUp" data-wow-delay="0.4s">
                <ul>
                  <?php if ($pin): ?><li><a href="<?php echo esc_url($pin); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a></li><?php endif; ?>
                  <?php if ($tw): ?><li><a href="<?php echo esc_url($tw); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter"></i></a></li><?php endif; ?>
                  <?php if ($fb): ?><li><a href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a></li><?php endif; ?>
                  <?php if ($ig): ?><li><a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a></li><?php endif; ?>
                </ul>
              </div>

              <div class="section-title">
                <?php
                  $content = apply_filters('the_content', get_the_content());
                  echo $content;
                ?>
                <?php if ($bio2): ?>
                  <p><?php echo wp_kses_post($bio2); ?></p>
                <?php endif; ?>
              </div>

              <!-- Contact list -->
              <div class="team-contact-list wow fadeInUp" data-wow-delay="0.2s">

                <?php if ($location): ?>
                <div class="team-contact-item">
                  <div class="icon-box"><i class="fa-solid fa-location-dot"></i></div>
                  <div class="team-contact-content">
                    <p>Location</p>
                    <h3><?php echo esc_html($location); ?></h3>
                  </div>
                </div>
                <?php endif; ?>

                <?php if ($phone): ?>
                <div class="team-contact-item">
                  <div class="icon-box"><i class="fa-solid fa-phone"></i></div>
                  <div class="team-contact-content">
                    <p>Phone No</p>
                    <h3><?php echo esc_html($phone); ?></h3>
                  </div>
                </div>
                <?php endif; ?>

                <?php if ($email): ?>
                <div class="team-contact-item">
                  <div class="icon-box"><i class="fa-solid fa-envelope"></i></div>
                  <div class="team-contact-content">
                    <p>Email Address</p>
                    <h3><?php echo esc_html($email); ?></h3>
                  </div>
                </div>
                <?php endif; ?>

              </div>
            </div>
          </div>

          <!-- Skills Box -->
          <?php if (!empty($skills)): ?>
          <div class="team-member-skill-box">
            <div class="team-skill-content">
              <div class="section-title">
                <h2 class="text-anime-style-3" data-cursor="-opaque">My expertise &amp; skill</h2>
                <p class="wow fadeInUp">Core strengths and capabilities developed through hands-on project work.</p>
              </div>
            </div>

            <div class="team-skill-list">
              <?php foreach ($skills as $s): 
                $name = $s['name'] ?? '';
                $pct  = intval($s['pct'] ?? 0);
              ?>
                <div class="skills-progress-bar">
                  <div class="skillbar" data-percent="<?php echo esc_attr($pct); ?>%">
                    <div class="skill-data">
                      <div class="skill-title"><?php echo esc_html($name); ?></div>
                      <div class="skill-no"><?php echo esc_html($pct); ?>%</div>
                    </div>
                    <div class="skill-progress">
                      <div class="count-bar" data-pct="<?php echo esc_attr($pct); ?>"></div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>

        </div>

      </div>
    </div>
  </div>
</div>
  <?php get_template_part('cta-consultation'); ?>


<?php get_footer(); ?>
