<?php
/**
 * Plugin Name: AL Team Members
 * Description: Team members CPT + detail template + skills + socials + shortcode.
 * Version: 1.1.0
 * Author: Nghia Ha
 * Text Domain: avid-learner
 */

if (!defined('ABSPATH')) exit;

class AL_Team_Members {
  const CPT = 'al_team';

  public function __construct() {
    add_action('init', [$this, 'register_cpt']);
    add_action('add_meta_boxes', [$this, 'add_metaboxes']);
    add_action('save_post', [$this, 'save_metaboxes']);
    add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    add_filter('single_template', [$this, 'single_template']);
    add_shortcode('al_team_grid', [$this, 'shortcode_team_grid']);
  }

  public function register_cpt() {
    $labels = [
      'name' => __('Team Members', 'avid-learner'),
      'singular_name' => __('Team Member', 'avid-learner'),
      'add_new_item' => __('Add New Team Member', 'avid-learner'),
      'edit_item' => __('Edit Team Member', 'avid-learner'),
      'view_item' => __('View Team Member', 'avid-learner'),
      'search_items' => __('Search Team Members', 'avid-learner'),
      'not_found' => __('No team members found', 'avid-learner'),
    ];

    register_post_type(self::CPT, [
      'labels' => $labels,
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-groups',
      'supports' => ['title', 'thumbnail', 'editor', 'excerpt'],
      'rewrite' => ['slug' => 'team'],
      'show_in_rest' => true,
    ]);
  }

  public function enqueue_assets() {
    // Font Awesome
    wp_enqueue_style(
      'al-fontawesome',
      'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
      [],
      '6.5.0'
    );

    // CSS
    wp_enqueue_style(
      'al-team-members',
      plugins_url('assets/team.css', __FILE__),
      [],
      '1.1.0'
    );

    // JS (scroll animation)
    wp_enqueue_script(
      'al-team-members',
      plugins_url('assets/team.js', __FILE__),
      [],
      '1.1.0',
      true
    );
  }

  public function add_metaboxes() {
    add_meta_box(
      'al_team_details',
      __('Team Details', 'avid-learner'),
      [$this, 'render_metabox_details'],
      self::CPT,
      'normal',
      'high'
    );

    add_meta_box(
      'al_team_skills',
      __('Skills (Progress Bars)', 'avid-learner'),
      [$this, 'render_metabox_skills'],
      self::CPT,
      'normal',
      'default'
    );
  }

  public function render_metabox_details($post) {
    wp_nonce_field('al_team_save', 'al_team_nonce');

    $role      = get_post_meta($post->ID, '_al_role', true);
    $location  = get_post_meta($post->ID, '_al_location', true);
    $phone     = get_post_meta($post->ID, '_al_phone', true);
    $email     = get_post_meta($post->ID, '_al_email', true);

    $pin   = get_post_meta($post->ID, '_al_social_linkedin', true);
    $tw    = get_post_meta($post->ID, '_al_social_twitter', true);
    $fb    = get_post_meta($post->ID, '_al_social_facebook', true);
    $ig    = get_post_meta($post->ID, '_al_social_instagram', true);

    $bio2  = get_post_meta($post->ID, '_al_bio_2', true);
    ?>
    <style>
      .al-admin-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
      .al-admin-grid .full{grid-column:1/-1}
      .al-admin-field label{font-weight:700;display:block;margin-bottom:6px}
      .al-admin-field input,.al-admin-field textarea{width:100%}
      .al-admin-hint{opacity:.75;font-size:12px;margin-top:4px}
    </style>

    <div class="al-admin-grid">
      <div class="al-admin-field">
        <label>Role / Title</label>
        <input type="text" name="al_role" value="<?php echo esc_attr($role); ?>" placeholder="e.g., Strategy Consultant">
      </div>

      <div class="al-admin-field">
        <label>Email</label>
        <input type="email" name="al_email" value="<?php echo esc_attr($email); ?>" placeholder="e.g., info@domain.com">
      </div>

      <div class="al-admin-field">
        <label>Phone</label>
        <input type="text" name="al_phone" value="<?php echo esc_attr($phone); ?>" placeholder="e.g., (+1) 123 456 7890">
      </div>

      <div class="al-admin-field">
        <label>Location</label>
        <input type="text" name="al_location" value="<?php echo esc_attr($location); ?>" placeholder="e.g., Los Angeles, CA">
      </div>

      <div class="al-admin-field full">
        <label>Bio Paragraph 2 (optional)</label>
        <textarea name="al_bio_2" rows="3" placeholder="Second paragraph..."><?php echo esc_textarea($bio2); ?></textarea>
        <div class="al-admin-hint">Main bio uses the editor. This is an extra paragraph.</div>
      </div>

      <div class="al-admin-field">
        <label>Linkedin URL</label>
        <input type="url" name="al_social_linkedin" value="<?php echo esc_attr($pin); ?>" placeholder="https://...">
      </div>
      <div class="al-admin-field">
        <label>X / Twitter URL</label>
        <input type="url" name="al_social_twitter" value="<?php echo esc_attr($tw); ?>" placeholder="https://...">
      </div>
      <div class="al-admin-field">
        <label>Facebook URL</label>
        <input type="url" name="al_social_facebook" value="<?php echo esc_attr($fb); ?>" placeholder="https://...">
      </div>
      <div class="al-admin-field">
        <label>Instagram URL</label>
        <input type="url" name="al_social_instagram" value="<?php echo esc_attr($ig); ?>" placeholder="https://...">
      </div>
    </div>
    <?php
  }

  public function render_metabox_skills($post) {
    $skills = get_post_meta($post->ID, '_al_skills', true);
    if (!is_array($skills)) $skills = [];
    ?>
    <style>
      .al-skill-row{display:grid;grid-template-columns:2fr 1fr auto;gap:10px;align-items:center;margin-bottom:10px}
      .al-skill-row input{width:100%}
      .al-btn{border:1px solid #ccd0d4;background:#fff;padding:6px 10px;border-radius:6px;cursor:pointer}
      .al-btn:hover{background:#f6f7f7}
      .al-skill-wrap{margin-top:10px}
      .al-admin-hint{opacity:.75;font-size:12px;margin-top:4px}
    </style>

    <div id="al-skill-wrap" class="al-skill-wrap">
      <?php foreach ($skills as $i => $s): ?>
        <div class="al-skill-row">
          <input type="text" name="al_skills[<?php echo (int)$i; ?>][name]" value="<?php echo esc_attr($s['name'] ?? ''); ?>" placeholder="Skill name (e.g., Strategy)">
          <input type="number" min="0" max="100" name="al_skills[<?php echo (int)$i; ?>][pct]" value="<?php echo esc_attr($s['pct'] ?? ''); ?>" placeholder="Percent">
          <button class="al-btn al-remove-skill" type="button">Remove</button>
        </div>
      <?php endforeach; ?>
    </div>

    <button class="al-btn" type="button" id="al-add-skill">+ Add Skill</button>
    <div class="al-admin-hint">Percent should be 0–100.</div>

    <script>
      (function(){
        const wrap = document.getElementById('al-skill-wrap');
        const addBtn = document.getElementById('al-add-skill');
        if(!wrap || !addBtn) return;

        addBtn.addEventListener('click', function(){
          const i = wrap.querySelectorAll('.al-skill-row').length;
          const row = document.createElement('div');
          row.className = 'al-skill-row';
          row.innerHTML = `
            <input type="text" name="al_skills[${i}][name]" placeholder="Skill name (e.g., Strategy)">
            <input type="number" min="0" max="100" name="al_skills[${i}][pct]" placeholder="Percent">
            <button class="al-btn al-remove-skill" type="button">Remove</button>
          `;
          wrap.appendChild(row);
        });

        wrap.addEventListener('click', function(e){
          if(e.target && e.target.classList.contains('al-remove-skill')){
            e.target.closest('.al-skill-row').remove();
          }
        });
      })();
    </script>
    <?php
  }

  public function save_metaboxes($post_id) {
    if (get_post_type($post_id) !== self::CPT) return;
    if (!isset($_POST['al_team_nonce']) || !wp_verify_nonce($_POST['al_team_nonce'], 'al_team_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $map = [
      'al_role' => '_al_role',
      'al_location' => '_al_location',
      'al_phone' => '_al_phone',
      'al_email' => '_al_email',
      'al_social_linkedin' => '_al_social_linkedin',
      'al_social_twitter' => '_al_social_twitter',
      'al_social_facebook' => '_al_social_facebook',
      'al_social_instagram' => '_al_social_instagram',
      'al_bio_2' => '_al_bio_2',
    ];

    foreach ($map as $in => $meta) {
      $val = $_POST[$in] ?? '';
      if (strpos($in, 'al_social_') === 0) $val = esc_url_raw($val);
      elseif ($in === 'al_email') $val = sanitize_email($val);
      elseif ($in === 'al_bio_2') $val = wp_kses_post($val);
      else $val = sanitize_text_field($val);

      update_post_meta($post_id, $meta, $val);
    }

    $skills_in = $_POST['al_skills'] ?? [];
    $skills_clean = [];

    if (is_array($skills_in)) {
      foreach ($skills_in as $s) {
        $name = sanitize_text_field($s['name'] ?? '');
        $pct  = intval($s['pct'] ?? 0);
        $pct  = max(0, min(100, $pct));
        if ($name !== '') $skills_clean[] = ['name' => $name, 'pct' => $pct];
      }
    }

    update_post_meta($post_id, '_al_skills', $skills_clean);
  }

  public function single_template($single_template) {
    global $post;
    if ($post && $post->post_type === self::CPT) {
      $tpl = plugin_dir_path(__FILE__) . 'templates/single-al_team.php';
      if (file_exists($tpl)) return $tpl;
    }
    return $single_template;
  }

public function shortcode_team_grid($atts) {
  $atts = shortcode_atts([
    'posts'   => -1,
    'columns' => 4,
    'cta'     => 'yes',
  ], $atts, 'al_team_grid');

  $cols = max(1, min(4, intval($atts['columns'])));

  $q = new WP_Query([
    'post_type'      => self::CPT,
    'posts_per_page' => intval($atts['posts']),
    'post_status'    => 'publish',
  ]);

  if (!$q->have_posts()) return '<p>No team members yet.</p>';

  ob_start(); ?>

  <div class="al-team-grid" style="--al-team-cols: <?php echo (int)$cols; ?>;">
    <?php while ($q->have_posts()): $q->the_post(); ?>
      <a class="al-team-card" href="<?php the_permalink(); ?>">
        <div class="al-team-thumb">
          <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('large'); ?>
          <?php else: ?>
            <div class="al-team-thumb-placeholder"><i class="fa-solid fa-user"></i></div>
          <?php endif; ?>
        </div>
        <div class="al-team-meta">
          <h3 class="al-team-name"><?php the_title(); ?></h3>
          <?php $role = get_post_meta(get_the_ID(), '_al_role', true); ?>
          <?php if (!empty($role)): ?>
            <p class="al-team-role"><?php echo esc_html($role); ?></p>
          <?php endif; ?>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>

  <?php
  // CTA UNDER GRID
  if ($atts['cta'] === 'yes') {
    get_template_part('cta-consultation');
  }

  return ob_get_clean();
}
}

new AL_Team_Members();

register_activation_hook(__FILE__, function(){
  (new AL_Team_Members())->register_cpt();
  flush_rewrite_rules();
});
register_deactivation_hook(__FILE__, function(){
  flush_rewrite_rules();
});
