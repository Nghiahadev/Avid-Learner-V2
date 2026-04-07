<?php
/**
 * Template Part: Services Highlight
 * Author: Nghia Ha
 */
if (!defined('ABSPATH')) exit;

// Individual service page links
$executive_link  = esc_url(home_url('/services/executive-coaching'));
$leadership_link = esc_url(home_url('/services/leadership-development'));
$team_link       = esc_url(home_url('/services/team-organizational-development'));
?>

<section class="al-services-pricing">
  <div class="al-services-main al-flow">
    <h2 class="al-services-heading">How We Support Leaders & Organizations
</h2>

    <div class="al-services-cards">
      <div class="al-services-cards__inner">

        <article class="al-service-card">
          <h3 class="al-service-card__heading">Executive Coaching</h3>
          <p class="al-service-card__price">Personalized Growth</p>
            <div class="al-service-card__desc">
              <p>
                One-on-one coaching designed to help leaders step back, gain perspective,
                and move forward with clarity.
              </p>
            </div>
          <ul role="list" class="al-service-card__bullets al-flow">
            <li>Strengthen decision making and communication.</li>
            <li>Build executive presence and confidence.</li>
            <li>Navigate complex leadership challenges.</li>
            <li>Create alignment between values and actions.</li>
          </ul>

          <a href="<?php echo $executive_link; ?>" class="al-service-card__cta">
            Learn More
          </a>
        </article>

        <article class="al-service-card">
          <h3 class="al-service-card__heading">Leadership Development</h3>
          <p class="al-service-card__price">Stronger Leaders</p>
            <div class="al-service-card__desc">
              <p>
                Workshops and learning experiences that build the capabilities leaders need to guide teams and organizations effectively.
              </p>
            </div>
          <ul role="list" class="al-service-card__bullets al-flow">
            <li>Develop leadership skills at all levels.</li>
            <li>Strengthen emotional intelligence.</li>
            <li>Build practical leadership strategies.</li>
            <li>Support long-term leadership growth.</li>
          </ul>

          <a href="<?php echo $leadership_link; ?>" class="al-service-card__cta">
            Learn More
          </a>
        </article>

        <article class="al-service-card">
          <h3 class="al-service-card__heading">Team &amp; Organizational Development</h3>
          <p class="al-service-card__price">Aligned Performance</p>
            <div class="al-service-card__desc">
              <p>
                Facilitated sessions and collaborative experiences that help teams improve communication, trust, and alignment.
              </p>
            </div>
          <ul role="list" class="al-service-card__bullets al-flow">
            <li>Improve collaboration and team dynamics.</li>
            <li>Strengthen communication and trust.</li>
            <li>Align teams around shared goals.</li>
            <li>Support change and organizational growth.</li>
          </ul>

          <a href="<?php echo $team_link; ?>" class="al-service-card__cta">
            Learn More
          </a>
        </article>

      </div>

      <div class="al-services-overlay al-services-cards__inner" aria-hidden="true"></div>
    </div>
  </div>
</section>