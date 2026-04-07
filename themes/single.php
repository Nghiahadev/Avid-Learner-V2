<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php
  $hero = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<?php if ($hero) : ?>
<section class="al-post-hero" style="--post-hero-bg: url('<?php echo esc_url($hero); ?>');" aria-label="Post hero">
  <div class="al-post-hero__overlay"></div>
  <div class="al-post-hero__inner al-wrap">
    <div class="al-post-hero__meta">
      <span class="al-post-hero__date">📅 <?php echo esc_html(get_the_date('d M, Y')); ?></span>
      <span class="al-post-hero__dot">•</span>
      <span class="al-post-hero__author">By <?php the_author(); ?></span>
    </div>
    <h1 class="al-post-hero__title"><?php the_title(); ?></h1>
  </div>
</section>
<?php endif; ?>

<main class="al-post-main al-wrap">
  <article class="al-post-content">
    <?php the_content(); ?>
  </article>

  <?php
    // =========================
    // RELATED POSTS (category-based)
    // =========================
    $cats = wp_get_post_terms(get_the_ID(), 'category', ['fields' => 'ids']);
    $related_args = [
      'post_type'           => 'post',
      'post_status'         => 'publish',
      'posts_per_page'      => 3,
      'post__not_in'        => [get_the_ID()],
      'ignore_sticky_posts' => true,
    ];

    if (!empty($cats)) {
      $related_args['category__in'] = $cats;
    }

    $related = new WP_Query($related_args);
  ?>

  <?php if ( $related->have_posts() ) : ?>
    <section class="al-related" aria-label="Related posts">
      <div class="al-related__head">
        <h2 class="al-related__title">Suggested Reading</h2>
        <a class="al-related__all" href="<?php echo esc_url( home_url('/blog') ); ?>">View all posts →</a>
      </div>

      <div class="al-related__grid">
        <?php while ( $related->have_posts() ) : $related->the_post(); ?>
          <article class="al-related-card">
            <a class="al-related-card__media" href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large'); ?>
              <?php else: ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/blog-fallback.jpg'); ?>" alt="Blog image">
              <?php endif; ?>
            </a>

            <div class="al-related-card__content">
              <div class="al-related-card__date">
                📅 <?php echo esc_html(get_the_date('d M, Y')); ?>
              </div>

              <h3 class="al-related-card__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h3>

              <a class="al-related-card__readmore" href="<?php the_permalink(); ?>">
                Read More <span class="arrow">↗</span>
              </a>
            </div>
          </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </section>
  <?php endif; ?>



  
</main>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
