<?php
/**
 * Template Name: Blog Page
 * Author: Nghia Ha
 */
get_header();
?>

<!-- HERO BANNER -->
<section
  class="al-hero"
  style="
    --hero-bg: url('https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/Blog-scaled.jpeg');
    --hero-h: 30rem;
  "
  aria-label="Blog banner"
>
  <div class="al-hero__inner">
    <h1 class="al-hero__title">Blog</h1>
    <div class="al-hero__divider"></div>
    <h2 class="al-hero__subtitle">Insights, tutorials, and updates</h2>
    <p class="al-hero__text">
      Practical guides and real examples to help you learn faster and build better.
    </p>
  </div>
</section>

<main class="site-main al-blog-page">

  <!-- OPTIONAL: Elementor / Page content (only ONCE) -->
  <?php while ( have_posts() ) : the_post(); ?>
    <?php if ( trim(get_the_content()) !== '' ) : ?>
      <section class="al-blog-intro">
        <?php the_content(); ?>
      </section>
    <?php endif; ?>
  <?php endwhile; ?>

  <!-- BLOG CARDS GRID -->
  <section class="al-blog-grid-wrap">
    <div class="al-wrap">
      <div class="al-blog-grid">

        <?php
        $paged = max(1, get_query_var('paged'));
        $blog_q = new WP_Query([
          'post_type'      => 'post',
          'post_status'    => 'publish',
          'posts_per_page' => 9,
          'paged'          => $paged,
        ]);

        if ($blog_q->have_posts()) :
          while ($blog_q->have_posts()) : $blog_q->the_post();
            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $thumb = $thumb ? $thumb : get_template_directory_uri() . '/assets/images/blog-fallback.jpg';
        ?>
<article class="al-blog-card">

  <a class="al-blog-card__media" href="<?php the_permalink(); ?>">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('large'); ?>
    <?php endif; ?>
  </a>

  <div class="al-blog-card__content">

    <div class="al-blog-card__date">
      <span class="al-calendar-icon">📅</span>
      <?php echo get_the_date('d M, Y'); ?>
    </div>

    <h3 class="al-blog-card__title">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h3>

    <a class="al-blog-card__readmore" href="<?php the_permalink(); ?>">
      Read More <span class="arrow">↗</span>
    </a>

  </div>

</article>


        <?php
          endwhile;
          wp_reset_postdata();
        else :
        ?>
          <p class="al-empty">No posts yet. Write your first blog post and it will appear here.</p>
        <?php endif; ?>

      </div>

      <!-- PAGINATION -->
      <?php if ( $blog_q->max_num_pages > 1 ) : ?>
        <nav class="al-pagination" aria-label="Blog pagination">
          <?php
            echo paginate_links([
              'total'   => $blog_q->max_num_pages,
              'current' => $paged,
              'mid_size'=> 1,
              'prev_text' => '← Prev',
              'next_text' => 'Next →',
            ]);
          ?>
        </nav>
      <?php endif; ?>

    </div>
  </section>

  <!-- CTA -->
</main>
  <?php get_template_part('cta-consultation'); ?>

<?php get_footer(); ?>
