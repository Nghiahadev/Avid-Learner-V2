<?php
/**
 * Theme functions for Avid Learner
 * Author: Nghia Ha
 */

if (!defined('ABSPATH')) {
  exit;
}

/* ======================================================
   HELPERS
====================================================== */
function al_asset_version($path) {
  return file_exists($path) ? filemtime($path) : wp_get_theme()->get('Version');
}

/**
 * Convert "/contact" to full URL, keep full URLs as-is
 */
function al_to_url($maybe_path) {
  $maybe_path = trim((string)$maybe_path);
  if ($maybe_path === '') return '';

  if (preg_match('#^https?://#i', $maybe_path)) {
    return esc_url($maybe_path);
  }

  if ($maybe_path[0] !== '/') {
    $maybe_path = '/' . $maybe_path;
  }

  return esc_url(home_url($maybe_path));
}

/* ======================================================
   THEME SETUP
====================================================== */
function avid_learner_setup() {

  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');

  // make sure pages support featured images
  add_post_type_support('page', 'thumbnail');

  add_theme_support('custom-logo', [
    'height'      => 80,
    'width'       => 280,
    'flex-height' => true,
    'flex-width'  => true,
  ]);

  register_nav_menus([
    'primary' => __('Primary Menu', 'avid-learner'),
  ]);
}
add_action('after_setup_theme', 'avid_learner_setup');

/* ======================================================
   ENQUEUE STYLES & SCRIPTS
====================================================== */
function avid_learner_enqueue_assets() {

  // Main stylesheet
  $style_path = get_stylesheet_directory() . '/style.css';
  wp_enqueue_style(
    'avid-learner-style',
    get_stylesheet_uri(),
    [],
    al_asset_version($style_path)
  );

  // Font Awesome
  wp_enqueue_style(
    'avid-learner-fontawesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
    [],
    '6.5.0'
  );

  // Slider JS
  $slider_path = get_template_directory() . '/assets/js/slider.js';
  if (file_exists($slider_path)) {
    wp_enqueue_script(
      'avid-learner-slider',
      get_template_directory_uri() . '/assets/js/slider.js',
      [],
      al_asset_version($slider_path),
      true
    );
  }

  // Tabs JS
  $tabs_path = get_template_directory() . '/assets/js/tabs.js';
  if (file_exists($tabs_path)) {
    wp_enqueue_script(
      'avid-learner-tabs',
      get_template_directory_uri() . '/assets/js/tabs.js',
      [],
      al_asset_version($tabs_path),
      true
    );
  }

  // Why Choose Us JS
  $why_path = get_template_directory() . '/assets/js/why-choose-us.js';
  if (file_exists($why_path)) {
    wp_enqueue_script(
      'avid-learner-why-choose-us',
      get_template_directory_uri() . '/assets/js/why-choose-us.js',
      [],
      al_asset_version($why_path),
      true
    );
  }

  // What We Do JS
  $wedo_path = get_template_directory() . '/assets/js/what-we-do.js';
  if (file_exists($wedo_path)) {
    wp_enqueue_script(
      'avid-learner-what-we-do',
      get_template_directory_uri() . '/assets/js/what-we-do.js',
      [],
      al_asset_version($wedo_path),
      true
    );
  }

  // Reveal JS
  $reveal_path = get_template_directory() . '/assets/js/reveal.js';
  if (file_exists($reveal_path)) {
    wp_enqueue_script(
      'avid-learner-reveal',
      get_template_directory_uri() . '/assets/js/reveal.js',
      [],
      al_asset_version($reveal_path),
      true
    );
  }

  // FAQ JS
  $faq_path = get_template_directory() . '/assets/js/faq.js';
  if (file_exists($faq_path)) {
    wp_enqueue_script(
      'al-faq',
      get_template_directory_uri() . '/assets/js/faq.js',
      [],
      al_asset_version($faq_path),
      true
    );
  }

  // Services Highlight JS
  if (is_page('services')) {
    $services_highlight_js = get_template_directory() . '/assets/js/services-highlight.js';
    if (file_exists($services_highlight_js)) {
      wp_enqueue_script(
        'al-services-highlight',
        get_template_directory_uri() . '/assets/js/services-highlight.js',
        [],
        al_asset_version($services_highlight_js),
        true
      );
    }
  }

  // GSAP pages
  if (is_page(array('leadership-development', 'team-organizational-development'))) {
    wp_enqueue_script(
      'gsap',
      'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
      [],
      '3.12.5',
      true
    );

    wp_enqueue_script(
      'gsap-scrolltrigger',
      'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
      ['gsap'],
      '3.12.5',
      true
    );
  }

  // Leadership page scripts
  if (is_page('leadership-development')) {
    $scrollfill_js = get_template_directory() . '/assets/js/leadership-scrollfill.js';
    if (file_exists($scrollfill_js)) {
      wp_enqueue_script(
        'al-leadership-scrollfill',
        get_template_directory_uri() . '/assets/js/leadership-scrollfill.js',
        ['gsap', 'gsap-scrolltrigger'],
        al_asset_version($scrollfill_js),
        true
      );
    }

    $reveal_js = get_template_directory() . '/assets/js/leadership-services-reveal.js';
    if (file_exists($reveal_js)) {
      wp_enqueue_script(
        'al-leadership-services-reveal',
        get_template_directory_uri() . '/assets/js/leadership-services-reveal.js',
        ['gsap', 'gsap-scrolltrigger'],
        al_asset_version($reveal_js),
        true
      );
    }
  }

  // Team & Organizational Development page script
  
}
add_action('wp_enqueue_scripts', 'avid_learner_enqueue_assets');

function avidlearner_enqueue_community_scripts() {
	wp_enqueue_script(
		'avid-community-process',
		get_template_directory_uri() . '/assets/js/community-process.js',
		array(),
		null,
		true
	);
}
add_action('wp_enqueue_scripts', 'avidlearner_enqueue_community_scripts');

/**
 * Enqueue GSAP only on specific pages
 */
function al_enqueue_gsap_page_scripts() {
  if (is_admin()) return;

  // Load GSAP + ScrollTrigger on both pages
  if (is_page(array('leadership-development', 'team-organizational-development', 'executive-coaching'))) {
    wp_enqueue_script(
      'gsap',
      'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
      array(),
      '3.12.5',
      true
    );

    wp_enqueue_script(
      'gsap-scrolltrigger',
      'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
      array('gsap'),
      '3.12.5',
      true
    );
  }

  // Leadership Development page scripts
  if (is_page('leadership-development')) {
    $scrollfill_js = get_template_directory() . '/assets/js/leadership-scrollfill.js';
    if (file_exists($scrollfill_js)) {
      wp_enqueue_script(
        'al-leadership-scrollfill',
        get_template_directory_uri() . '/assets/js/leadership-scrollfill.js',
        array('gsap', 'gsap-scrolltrigger'),
        filemtime($scrollfill_js),
        true
      );
    }

    $reveal_js = get_template_directory() . '/assets/js/leadership-services-reveal.js';
    if (file_exists($reveal_js)) {
      wp_enqueue_script(
        'al-leadership-services-reveal',
        get_template_directory_uri() . '/assets/js/leadership-services-reveal.js',
        array('gsap', 'gsap-scrolltrigger'),
        filemtime($reveal_js),
        true
      );
    }
  }

  // Team & Organizational Development page script
  if (is_page('team-organizational-development')) {
    $team_js = get_template_directory() . '/assets/js/team-organizational-development.js';
    if (file_exists($team_js)) {
      wp_enqueue_script(
        'al-team-organizational-development',
        get_template_directory_uri() . '/assets/js/team-organizational-development.js',
        array('gsap', 'gsap-scrolltrigger'),
        filemtime($team_js),
        true
      );
    }
  }
  if (is_page('executive-coaching')) {

    $executive_scroll = get_template_directory() . '/assets/js/executive-coaching.js';

    if (file_exists($executive_scroll)) {
      wp_enqueue_script(
        'al-executive-coaching',
        get_template_directory_uri() . '/assets/js/executive-coaching.js',
        array('gsap', 'gsap-scrolltrigger'),
        filemtime($executive_scroll),
        true
      );
    }

  }
  
}
add_action('wp_enqueue_scripts', 'al_enqueue_gsap_page_scripts');


/* ======================================================
   CUSTOMIZER UX (PANELS + ORGANIZATION)
====================================================== */
function al_customize_register_panels_and_core_sections($wp_customize) {

  // Panels (Advanced UX trick: emojis + clear grouping)
  $wp_customize->add_panel('al_panel_global', [
    'title'       => __('Global Settings', 'avid-learner'),
    'priority'    => 5,
    'description' => __('Site-wide settings like notice bar, footer, and menus.', 'avid-learner'),
  ]);

  $wp_customize->add_panel('al_panel_home', [
    'title'       => __('Homepage', 'avid-learner'),
    'priority'    => 10,
    'description' => __('Sections that appear on the homepage.', 'avid-learner'),
  ]);

  $wp_customize->add_panel('al_panel_about', [
    'title'       => __('About Page', 'avid-learner'),
    'priority'    => 20,
    'description' => __('Sections that appear on the About page.', 'avid-learner'),
  ]);

  $wp_customize->add_panel('al_panel_services', [
    'title'       => __('Services Page', 'avid-learner'),
    'priority'    => 30,
    'description' => __('Services page content and service blocks.', 'avid-learner'),
  ]);

  $wp_customize->add_panel('al_panel_contact', [
    'title'       => __('Contact Page', 'avid-learner'),
    'priority'    => 40,
    'description' => __('Contact hero, form shortcode, and contact info.', 'avid-learner'),
  ]);

  $wp_customize->add_panel('al_panel_advanced', [
    'title'       => __('Advanced', 'avid-learner'),
    'priority'    => 90,
    'description' => __('Optional settings like Homepage Settings and Additional CSS.', 'avid-learner'),
  ]);

  // Move core WP sections into panels (if they exist)
  $core_to_global = ['title_tagline', 'header_image', 'background_image', 'nav_menus', 'widgets'];
  foreach ($core_to_global as $sec_id) {
    $sec = $wp_customize->get_section($sec_id);
    if ($sec) {
      $sec->panel = 'al_panel_global';
      $sec->priority = 1;
    }
  }

  // Homepage Settings (Static Front Page)
  $static = $wp_customize->get_section('static_front_page');
  if ($static) {
    $static->panel = 'al_panel_advanced';
    $static->priority = 1;
  }

  // Additional CSS
  $custom_css = $wp_customize->get_section('custom_css');
  if ($custom_css) {
    $custom_css->panel = 'al_panel_advanced';
    $custom_css->priority = 10;
  }
}
add_action('customize_register', 'al_customize_register_panels_and_core_sections', 5);


/* ======================================================
   CUSTOMIZER: NOTICE BAR (Ticker)  [GLOBAL]
====================================================== */
function al_customize_notice_bar($wp_customize) {

  $wp_customize->add_section('al_notice_bar', [
    'title'       => __('Notice Bar', 'avid-learner'),
    'priority'    => 10,
    'panel'       => 'al_panel_global',
    'description' => __('Edit the scrolling notice/ticker items. Enter one item per line.', 'avid-learner'),
  ]);

  // Toggle on/off
  $wp_customize->add_setting('al_notice_enabled', [
    'default'           => true,
    'sanitize_callback' => function ($val) {
      return (bool) $val;
    },
  ]);
  $wp_customize->add_control('al_notice_enabled', [
    'label'   => __('Enable Notice Bar', 'avid-learner'),
    'section' => 'al_notice_bar',
    'type'    => 'checkbox',
  ]);

  // Items (one per line)
  $wp_customize->add_setting('al_notice_items', [
    'default'           => "Latest Updates\nNew Announcements\nWorkshop Alerts\nLive Notices\nEvent Countdown\nCommunity News",
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_notice_items', [
    'label'       => __('Notice Items', 'avid-learner'),
    'description' => __('Enter one item per line.', 'avid-learner'),
    'section'     => 'al_notice_bar',
    'type'        => 'textarea',
  ]);
}
add_action('customize_register', 'al_customize_notice_bar');


/* ======================================================
   CUSTOMIZER: FOOTER  [GLOBAL]
====================================================== */
function al_customize_footer($wp_customize) {

  $wp_customize->add_section('al_footer', [
    'title'    => __('Footer', 'avid-learner'),
    'priority' => 30,
    'panel'    => 'al_panel_global',
  ]);

  $fields = [
    'al_footer_title'   => ['Newsletter Title', 'Join our newsletter for event important announcement', 'text'],
    'al_footer_note'    => ['Newsletter Note', 'Stay informed with instant updates delivered straight to your inbox.', 'text'],
    'al_footer_brand'   => ['Brand Name (fallback)', 'Avid Learner', 'text'],
    'al_footer_about'   => ['About Text', 'Experience a world-class conference designed to inspire innovation, empower professionals, and connect leaders from around the globe.', 'textarea'],
    'al_footer_phone'   => ['Phone', '+00 123 456 789', 'text'],
    'al_footer_email'   => ['Email', 'support@domainname.com', 'text'],
    'al_footer_address' => ['Address', '45/2 Central Business Innovation Near International Trade Tower', 'textarea'],

    'al_social_facebook'  => ['Facebook URL', '#', 'text'],
    'al_social_instagram' => ['Instagram URL', '#', 'text'],
    'al_social_linkedin'  => ['LinkedIn URL', 'https://www.linkedin.com/company/avid-learner-inc./posts/', 'text'],
  ];

  foreach ($fields as $key => $data) {
    [$label, $default, $type] = $data;

    $wp_customize->add_setting($key, [
      'default'           => $default,
      'sanitize_callback' => ($type === 'textarea') ? 'sanitize_textarea_field' : 'sanitize_text_field',
    ]);

    $wp_customize->add_control($key, [
      'label'   => __($label, 'avid-learner'),
      'section' => 'al_footer',
      'type'    => $type,
    ]);
  }
}
add_action('customize_register', 'al_customize_footer');
/* ======================================================
   CUSTOMIZER: HOMEPAGE - HERO SLIDER  [HOME]
====================================================== */
add_action('customize_register', function($wp_customize){

  $wp_customize->add_section('al_home_hero_slider', [
    'title'       => __('Hero Slider', 'avid-learner'),
    'priority'    => 5,
    'panel'       => 'al_panel_home', // keep if using panels
    'description' => __('Customize the homepage hero slider (3 slides).', 'avid-learner'),
  ]);

  // Enable toggle
  $wp_customize->add_setting('al_hero_enabled', [
    'default'           => true,
    'sanitize_callback' => function($v){ return (bool)$v; },
  ]);
  $wp_customize->add_control('al_hero_enabled', [
    'type'    => 'checkbox',
    'section' => 'al_home_hero_slider',
    'label'   => __('Enable Hero Slider', 'avid-learner'),
  ]);

  // Defaults (match your current HTML)
  $defaults = [
    1 => [
      'bg' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=80',
      'eyebrow' => 'LEADERSHIP COACHING AND DEVELOPMENT',
      'title' => 'Develop Stronger Leaders',
      'desc' => 'Executive coaching and leadership development programs designed to help professionals lead with clarity and confidence.',
      'btn1_text' => 'Book a Conversation',
      'btn1_url' => '/contact',
      'btn2_text' => 'Explore Services',
      'btn2_url' => '/services',
    ],
    2 => [
      'bg' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1600&q=80',
      'eyebrow' => 'EXECUTIVE COACHING',
      'title' => 'Clarity First. Then Action.',
      'desc' => 'We help leaders step back, gain perspective, and move forward with a clear plan they can actually implement.',
      'btn1_text' => 'Book a Conversation',
      'btn1_url' => '/contact',
      'btn2_text' => 'Explore Services',
      'btn2_url' => '/contact',
    ],
    3 => [
      'bg' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80',
      'eyebrow' => 'LEADERSHIP DEVELOPMENT',
      'title' => 'Leadership That Grows With You.',
      'desc' => 'Coaching, learning programs, and expert guidance to help individuals and organizations grow stronger leaders.',
      'btn1_text' => 'Book a Conversation',
      'btn1_url' => '/contact',
      'btn2_text' => 'Explore Services',
      'btn2_url' => '/contact',
    ],
  ];

  for ($i = 1; $i <= 3; $i++) {

    // Background image URL
    $wp_customize->add_setting("al_hero_{$i}_bg", [
      'default'           => $defaults[$i]['bg'],
      'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control("al_hero_{$i}_bg", [
      'label'       => sprintf(__('Slide %d Background Image URL', 'avid-learner'), $i),
      'section'     => 'al_home_hero_slider',
      'type'        => 'text',
      'description' => __('Paste an image URL (1600px wide recommended).', 'avid-learner'),
    ]);

    // Title
    $wp_customize->add_setting("al_hero_{$i}_title", [
      'default'           => $defaults[$i]['title'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_hero_{$i}_title", [
      'label'   => sprintf(__('Slide %d Title', 'avid-learner'), $i),
      'section' => 'al_home_hero_slider',
      'type'    => 'text',
    ]);

    // Description
    $wp_customize->add_setting("al_hero_{$i}_desc", [
      'default'           => $defaults[$i]['desc'],
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_hero_{$i}_desc", [
      'label'   => sprintf(__('Slide %d Description', 'avid-learner'), $i),
      'section' => 'al_home_hero_slider',
      'type'    => 'textarea',
    ]);

    // Button 1
    $wp_customize->add_setting("al_hero_{$i}_btn1_text", [
      'default'           => $defaults[$i]['btn1_text'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_hero_{$i}_btn1_text", [
      'label'   => sprintf(__('Slide %d Button 1 Text', 'avid-learner'), $i),
      'section' => 'al_home_hero_slider',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_hero_{$i}_btn1_url", [
      'default'           => $defaults[$i]['btn1_url'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_hero_{$i}_btn1_url", [
      'label'       => sprintf(__('Slide %d Button 1 URL', 'avid-learner'), $i),
      'section'     => 'al_home_hero_slider',
      'type'        => 'text',
      'description' => __('Example: /contact or https://... or #section-id', 'avid-learner'),
    ]);

    // Button 2
    $wp_customize->add_setting("al_hero_{$i}_btn2_text", [
      'default'           => $defaults[$i]['btn2_text'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_hero_{$i}_btn2_text", [
      'label'   => sprintf(__('Slide %d Button 2 Text', 'avid-learner'), $i),
      'section' => 'al_home_hero_slider',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_hero_{$i}_btn2_url", [
      'default'           => $defaults[$i]['btn2_url'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_hero_{$i}_btn2_url", [
      'label'       => sprintf(__('Slide %d Button 2 URL', 'avid-learner'), $i),
      'section'     => 'al_home_hero_slider',
      'type'        => 'text',
      'description' => __('Example: /services or #how-we-work', 'avid-learner'),
    ]);
  }

});

/* ======================================================
   CUSTOMIZER: HOMEPAGE - HOW WE WORK  [HOME]
====================================================== */
add_action('customize_register', function($wp_customize){

  $wp_customize->add_section('al_how_we_work_section', [
    'title'       => __('How We Work (Tabs)', 'avid-learner'),
    'priority'    => 25,
    'panel'       => 'al_panel_home',
    'description' => __('Customize the How We Work tab section on the homepage.', 'avid-learner'),
  ]);

  // Enable
  $wp_customize->add_setting('al_hww_enabled', [
    'default'           => true,
    'sanitize_callback' => function($v){ return (bool)$v; },
  ]);
  $wp_customize->add_control('al_hww_enabled', [
    'type'    => 'checkbox',
    'section' => 'al_how_we_work_section',
    'label'   => __('Enable section', 'avid-learner'),
  ]);

  // Title + subtitle
  $wp_customize->add_setting('al_hww_title', [
    'default'           => 'How We Work',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_hww_title', [
    'label'   => __('Title', 'avid-learner'),
    'section' => 'al_how_we_work_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_hww_subtitle', [
    'default'           => 'A thoughtful, hands-on consulting process designed to create real impact.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_hww_subtitle', [
    'label'   => __('Subtitle', 'avid-learner'),
    'section' => 'al_how_we_work_section',
    'type'    => 'textarea',
  ]);

  // Tabs (labels)
  $wp_customize->add_setting('al_hww_tab1_label', [
    'default'           => 'Strategy',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_hww_tab1_label', [
    'label'   => __('Tab 1 Label', 'avid-learner'),
    'section' => 'al_how_we_work_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_hww_tab2_label', [
    'default'           => 'Execution',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_hww_tab2_label', [
    'label'   => __('Tab 2 Label', 'avid-learner'),
    'section' => 'al_how_we_work_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_hww_tab3_label', [
    'default'           => 'Partnership',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_hww_tab3_label', [
    'label'   => __('Tab 3 Label', 'avid-learner'),
    'section' => 'al_how_we_work_section',
    'type'    => 'text',
  ]);

  // Tabs (content)
  $wp_customize->add_setting('al_hww_tab1_desc', [
    'default'           => 'We analyze, simplify, and define a clear path forward—aligned with your goals.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_hww_tab1_desc', [
    'label'   => __('Tab 1 Content', 'avid-learner'),
    'section' => 'al_how_we_work_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('al_hww_tab2_desc', [
    'default'           => 'We turn ideas into action, supporting implementation every step of the way.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_hww_tab2_desc', [
    'label'   => __('Tab 2 Content', 'avid-learner'),
    'section' => 'al_how_we_work_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('al_hww_tab3_desc', [
    'default'           => 'We stay involved to adapt, refine, and grow with your business.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_hww_tab3_desc', [
    'label'   => __('Tab 3 Content', 'avid-learner'),
    'section' => 'al_how_we_work_section',
    'type'    => 'textarea',
  ]);

  // Button
  $wp_customize->add_setting('al_hww_btn_text', [
    'default'           => 'Book a Consultation',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_hww_btn_text', [
    'label'   => __('Button Text', 'avid-learner'),
    'section' => 'al_how_we_work_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_hww_btn_url', [
    'default'           => '/contact',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_hww_btn_url', [
    'label'       => __('Button URL', 'avid-learner'),
    'section'     => 'al_how_we_work_section',
    'type'        => 'text',
    'description' => __('Example: /contact or full URL', 'avid-learner'),
  ]);

  // Image URL (blob image)
  $wp_customize->add_setting('al_hww_image_url', [
    'default'           => 'https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/01/working-group-huddled-around-and-pointing-at-shared-laptop-scaled.jpg',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_hww_image_url', [
    'label'       => __('Blob Image URL', 'avid-learner'),
    'section'     => 'al_how_we_work_section',
    'type'        => 'text',
    'description' => __('Paste an image URL (or upload and paste URL).', 'avid-learner'),
  ]);

  // Ring text
  $wp_customize->add_setting('al_hww_ring_text', [
    'default'           => '✨ Crafted with Care',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_hww_ring_text', [
    'label'       => __('Rotating Ring Text (single phrase)', 'avid-learner'),
    'section'     => 'al_how_we_work_section',
    'type'        => 'text',
    'description' => __('Example: Crafted with Care', 'avid-learner'),
  ]);

});

/* ======================================================
   CUSTOMIZER: HOMEPAGE - WHY CHOOSE US  [HOME]
====================================================== */
function al_customize_why_choose_us($wp_customize) {

  $wp_customize->add_section('al_why_choose_us', [
    'title'    => __('Why Choose Us', 'avid-learner'),
    'priority' => 10,
    'panel'    => 'al_panel_home',
  ]);

  $wp_customize->add_setting('al_why_badge', [
    'default'           => 'Why Choose Us',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_why_badge', [
    'label'   => __('Badge Text', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_why_heading', [
    'default'           => "We Don't Just Consult — We Transform",
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_why_heading', [
    'label'   => __('Heading', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_why_highlight', [
    'default'           => 'We Transform',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_why_highlight', [
    'label'   => __('Highlighted Text (Gradient)', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_why_desc', [
    'default'           => "Our approach combines strategic thinking with hands-on execution. We work alongside your team to implement solutions that deliver measurable, lasting results.",
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_why_desc', [
    'label'   => __('Description', 'avid-learner'),
    'section' => 'al_why_choose_us',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('al_why_benefits', [
    'default'           => "Data-driven decision making\nProven ROI within 90 days\nDedicated expert teams\nContinuous optimization\nTransparent communication\nIndustry-leading methodologies",
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_why_benefits', [
    'label'       => __('Benefits (one per line)', 'avid-learner'),
    'description' => __('Enter one benefit per line.', 'avid-learner'),
    'section'     => 'al_why_choose_us',
    'type'        => 'textarea',
  ]);

  for ($i = 1; $i <= 4; $i++) {
    $default_number = ($i === 1 ? '500' : ($i === 2 ? '98' : ($i === 3 ? '150' : '12')));
    $default_prefix = ($i === 3 ? '$' : '');
    $default_suffix = ($i === 1 ? '+' : ($i === 2 ? '%' : ($i === 3 ? 'M' : '+')));
    $default_label  = ($i === 1 ? 'Projects Delivered' : ($i === 2 ? 'Client Satisfaction' : ($i === 3 ? 'Revenue Generated' : 'Years Experience')));

    $wp_customize->add_setting("al_stat_{$i}_number", [
      'default'           => $default_number,
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stat_{$i}_number", [
      'label'   => sprintf(__('Stat %d Number', 'avid-learner'), $i),
      'section' => 'al_why_choose_us',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_stat_{$i}_prefix", [
      'default'           => $default_prefix,
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stat_{$i}_prefix", [
      'label'   => sprintf(__('Stat %d Prefix', 'avid-learner'), $i),
      'section' => 'al_why_choose_us',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_stat_{$i}_suffix", [
      'default'           => $default_suffix,
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stat_{$i}_suffix", [
      'label'   => sprintf(__('Stat %d Suffix', 'avid-learner'), $i),
      'section' => 'al_why_choose_us',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_stat_{$i}_label", [
      'default'           => $default_label,
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stat_{$i}_label", [
      'label'   => sprintf(__('Stat %d Label', 'avid-learner'), $i),
      'section' => 'al_why_choose_us',
      'type'    => 'text',
    ]);
  }
}
add_action('customize_register', 'al_customize_why_choose_us');


/* ======================================================
   CUSTOMIZER: HOMEPAGE - WHAT WE DO  [HOME]
====================================================== */
function al_customize_what_we_do($wp_customize) {

  $wp_customize->add_section('al_what_we_do', [
    'title'    => __('What We Do', 'avid-learner'),
    'priority' => 20,
    'panel'    => 'al_panel_home',
  ]);

  $wp_customize->add_setting('al_wedo_badge', [
    'default'           => 'What We Do',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_wedo_badge', [
    'label'   => __('Badge Text', 'avid-learner'),
    'section' => 'al_what_we_do',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_wedo_heading', [
    'default'           => 'Expertise That Drives Results',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_wedo_heading', [
    'label'   => __('Heading', 'avid-learner'),
    'section' => 'al_what_we_do',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_wedo_highlight', [
    'default'           => 'Drives Results',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_wedo_highlight', [
    'label'   => __('Highlight Text (Gradient)', 'avid-learner'),
    'section' => 'al_what_we_do',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_wedo_desc', [
    'default'           => 'We combine deep industry knowledge with innovative methodologies to help businesses overcome challenges and achieve transformational growth.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_wedo_desc', [
    'label'   => __('Description', 'avid-learner'),
    'section' => 'al_what_we_do',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('al_wedo_link', [
    'default'           => '/services',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_wedo_link', [
    'label'       => __('Learn More Link (URL)', 'avid-learner'),
    'description' => __('Example: /services', 'avid-learner'),
    'section'     => 'al_what_we_do',
    'type'        => 'text',
  ]);

  $defaults = [
    ['Executive Coaching', 'One-on-one coaching for leaders navigating growth, complexity, and high-stakes decisions.'],
    ['Leadership Development', 'Build leaders who think strategically, communicate clearly, and lead teams effectively.'],
    ['Team & Organizational Development', 'Transform groups of individuals into aligned, high-trust teams.'],
  ];

  for ($i = 1; $i <= 4; $i++) {
    $wp_customize->add_setting("al_wedo_{$i}_title", [
      'default'           => $defaults[$i - 1][0],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_wedo_{$i}_title", [
      'label'   => sprintf(__('Card %d Title', 'avid-learner'), $i),
      'section' => 'al_what_we_do',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_wedo_{$i}_desc", [
      'default'           => $defaults[$i - 1][1],
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_wedo_{$i}_desc", [
      'label'   => sprintf(__('Card %d Description', 'avid-learner'), $i),
      'section' => 'al_what_we_do',
      'type'    => 'textarea',
    ]);
  }
}
add_action('customize_register', 'al_customize_what_we_do');


/* ======================================================
   CUSTOMIZER: HOME - PROCESS  [HOME]
====================================================== */
add_action('customize_register', function ($wp_customize) {

  // ✅ Section under Homepage panel
  $wp_customize->add_section('al_process_section', [
    'title'       => __('Process (The Journey)', 'avid-learner'),
    'priority'    => 35,
    'panel'       => 'al_panel_home',
    'description' => __('Customize the Process / Journey section on the homepage.', 'avid-learner'),
  ]);

  // Enable toggle
  $wp_customize->add_setting('al_process_enabled', [
    'default'           => true,
    'sanitize_callback' => function($v){ return (bool)$v; },
  ]);
  $wp_customize->add_control('al_process_enabled', [
    'type'    => 'checkbox',
    'section' => 'al_process_section',
    'label'   => __('Enable Process section', 'avid-learner'),
  ]);

  // Heading controls
  $wp_customize->add_setting('al_process_kicker', [
    'default'           => 'The Journey',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_process_kicker', [
    'label'   => __('Kicker (small text)', 'avid-learner'),
    'section' => 'al_process_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_process_title', [
    'default'           => 'How We Work Together',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_process_title', [
    'label'   => __('Title', 'avid-learner'),
    'section' => 'al_process_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_process_desc', [
    'default'           => 'A structured yet flexible process designed to meet you where you are and guide you where you want to be.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_process_desc', [
    'label'   => __('Description', 'avid-learner'),
    'section' => 'al_process_section',
    'type'    => 'textarea',
  ]);

  // Step defaults
  $defaults = [
    1 => ['01', 'Leadership Foundations', 'Designed for emerging leaders beginning their leadership journey. Participants build essential skills in communication, decision-making, accountability, and leading with confidence.'],
    2 => ['02', 'Transition to Leadership', 'Supports professionals stepping into management roles for the first time. Focus areas include managing former peers, setting expectations, and developing effective leadership habits.'],
    3 => ['03', 'Leading High-Performance Teams', 'For experienced managers looking to elevate team performance. Leaders learn how to build trust, improve accountability, strengthen collaboration, and drive results.'],
    4 => ['04', 'Executive Leadership Intensive', 'Advanced development for senior leaders responsible for strategy, culture, and organizational impact. Focuses on executive presence, decision making, and leading through complexity.'],
  ];

  // Steps 1–4
  for ($i = 1; $i <= 4; $i++) {

    $wp_customize->add_setting("al_process_{$i}_number", [
      'default'           => $defaults[$i][0],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_process_{$i}_number", [
      'label'   => sprintf(__('Step %d Number', 'avid-learner'), $i),
      'section' => 'al_process_section',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_process_{$i}_title", [
      'default'           => $defaults[$i][1],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_process_{$i}_title", [
      'label'   => sprintf(__('Step %d Title', 'avid-learner'), $i),
      'section' => 'al_process_section',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_process_{$i}_desc", [
      'default'           => $defaults[$i][2],
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_process_{$i}_desc", [
      'label'   => sprintf(__('Step %d Description', 'avid-learner'), $i),
      'section' => 'al_process_section',
      'type'    => 'textarea',
    ]);
  }

});


/* ======================================================
   CUSTOMIZER: HOMEPAGE - CTA SECTION  [HOME]
====================================================== */
function al_customize_cta_section($wp_customize) {

  $wp_customize->add_section('al_cta_section', [
    'title'    => __('CTA Section', 'avid-learner'),
    'priority' => 50,
    'panel'    => 'al_panel_home',
  ]);

  $wp_customize->add_setting('al_cta_bg', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);

  if (class_exists('WP_Customize_Image_Control')) {
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'al_cta_bg', [
      'label'   => __('CTA Background Image', 'avid-learner'),
      'section' => 'al_cta_section',
    ]));
  }

  $wp_customize->add_setting('al_cta_kicker', [
    'default'           => 'Invest in Yourself',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_cta_kicker', [
    'label'   => __('Small Heading', 'avid-learner'),
    'section' => 'al_cta_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_cta_title', [
    'default'           => 'Create the Life You Want, Get Personalized Coaching Today!',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_cta_title', [
    'label'   => __('Main Heading', 'avid-learner'),
    'section' => 'al_cta_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_cta_desc', [
    'default'           => 'Elevate your life with personalized coaching tailored to your unique needs. Start your journey to self-discovery and growth today by booking a session with our experienced life coach.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_cta_desc', [
    'label'   => __('Description', 'avid-learner'),
    'section' => 'al_cta_section',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('al_cta_btn_text', [
    'default'           => 'CONTACT US',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_cta_btn_text', [
    'label'   => __('Button Text', 'avid-learner'),
    'section' => 'al_cta_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_cta_btn_url', [
    'default'           => '/contact',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_cta_btn_url', [
    'label'       => __('Button Link (URL)', 'avid-learner'),
    'description' => __('Example: /contact or https://yoursite.com/contact', 'avid-learner'),
    'section'     => 'al_cta_section',
    'type'        => 'text',
  ]);
}
add_action('customize_register', 'al_customize_cta_section');

/* ======================================================
   CUSTOMIZER: HOMEPAGE - LOGO MARQUEE  [HOME]
====================================================== */
function al_customize_logo_marquee($wp_customize) {

  $wp_customize->add_section('al_logo_marquee', [
    'title'    => __('Our Clients', 'avid-learner'),
    'priority' => 45,
    'panel'    => 'al_panel_home',
  ]);

  $wp_customize->add_setting('al_logo_marquee_enabled', [
    'default'           => true,
    'sanitize_callback' => function($v){ return (bool)$v; },
  ]);

  $wp_customize->add_control('al_logo_marquee_enabled', [
    'type'    => 'checkbox',
    'section' => 'al_logo_marquee',
    'label'   => __('Enable logo marquee', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_logo_marquee_logos', [
    'default'           => "",
    'sanitize_callback' => 'wp_kses_post',
  ]);

  $wp_customize->add_control('al_logo_marquee_logos', [
    'type'        => 'textarea',
    'section'     => 'al_logo_marquee',
    'label'       => __('Logos (one per line)', 'avid-learner'),
    'description' => __("Paste one logo image URL per line.\nOptional link format: image_url|https://example.com", 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_logo_marquee_speed', [
    'default'           => 28,
    'sanitize_callback' => function($v){
      $v = intval($v);
      if ($v < 10) $v = 10;
      if ($v > 120) $v = 120;
      return $v;
    },
  ]);

  $wp_customize->add_control('al_logo_marquee_speed', [
    'type'        => 'number',
    'section'     => 'al_logo_marquee',
    'label'       => __('Animation speed (seconds)', 'avid-learner'),
    'input_attrs' => ['min' => 10, 'max' => 120, 'step' => 1],
  ]);
}
add_action('customize_register', 'al_customize_logo_marquee');


/* ======================================================
   CUSTOMIZER: SERVICES - FAQ SECTION  [SERVICES]
====================================================== */
function al_customize_faq_section($wp_customize) {

  $wp_customize->add_section('al_faq_section', [
    'title'       => __('FAQ Section', 'avid-learner'),
    'priority'    => 60,
    'panel'       => 'al_panel_services',
    'description' => __('Edit the FAQ content and images used in the FAQ block.', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_faq_title', [
    'default'           => 'Frequently Asked Questions',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_faq_title', [
    'section' => 'al_faq_section',
    'label'   => __('FAQ Title', 'avid-learner'),
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_faq_subtitle', [
    'default'           => 'Quick answers about Avid Learner—what it is, who it’s for, and how to stay updated.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_faq_subtitle', [
    'section' => 'al_faq_section',
    'label'   => __('FAQ Subtitle', 'avid-learner'),
    'type'    => 'textarea',
  ]);

  for ($i = 1; $i <= 4; $i++) {

    $wp_customize->add_setting("al_faq_q_{$i}", [
      'default'           => '',
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_faq_q_{$i}", [
      'section' => 'al_faq_section',
      'label'   => sprintf(__('Question %d', 'avid-learner'), $i),
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_faq_a_{$i}", [
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_faq_a_{$i}", [
      'section' => 'al_faq_section',
      'label'   => sprintf(__('Answer %d', 'avid-learner'), $i),
      'type'    => 'textarea',
    ]);
  }

  for ($i = 1; $i <= 4; $i++) {
    $wp_customize->add_setting("al_faq_img_{$i}", [
      'default'           => '',
      'sanitize_callback' => 'absint',
    ]);

    if (class_exists('WP_Customize_Media_Control')) {
      $wp_customize->add_control(new WP_Customize_Media_Control(
        $wp_customize,
        "al_faq_img_{$i}",
        [
          'section'   => 'al_faq_section',
          'label'     => sprintf(__('FAQ Image %d', 'avid-learner'), $i),
          'mime_type' => 'image',
        ]
      ));
    }
  }
}
add_action('customize_register', 'al_customize_faq_section');


/* ======================================================
   CUSTOMIZER: SERVICES - STACKING CARDS  [SERVICES]
====================================================== */
function al_customize_stacking_cards($wp_customize) {

  $wp_customize->add_section('al_stack_cards', [
    'title'       => __('Stacking Cards', 'avid-learner'),
    'priority'    => 40,
    'panel'       => 'al_panel_services',
    'description' => __('Edit the sticky stacking cards section (5 cards).', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_stack_eyebrow', [
    'default'           => 'Services',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_stack_eyebrow', [
    'label'   => __('Eyebrow (small title)', 'avid-learner'),
    'section' => 'al_stack_cards',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_stack_title', [
    'default'           => 'Development programs built for leaders and teams',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_stack_title', [
    'label'   => __('Main Title', 'avid-learner'),
    'section' => 'al_stack_cards',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_stack_subtitle', [
    'default'           => 'Scroll to explore five ways we help strengthen leadership, alignment, and performance—without adding complexity.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_stack_subtitle', [
    'label'   => __('Subtitle', 'avid-learner'),
    'section' => 'al_stack_cards',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('al_stack_btn1_text', [
    'default'           => 'Book a consult',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_stack_btn1_text', [
    'label'   => __('Primary Button Text', 'avid-learner'),
    'section' => 'al_stack_cards',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_stack_btn1_url', [
    'default'           => '/contact',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_stack_btn1_url', [
    'label'       => __('Primary Button URL (relative or full URL)', 'avid-learner'),
    'section'     => 'al_stack_cards',
    'type'        => 'text',
    'description' => __('Example: /contact', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_stack_btn2_text', [
    'default'           => 'View services',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_stack_btn2_text', [
    'label'   => __('Secondary Button Text', 'avid-learner'),
    'section' => 'al_stack_cards',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_stack_btn2_url', [
    'default'           => '/services',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_stack_btn2_url', [
    'label'       => __('Secondary Button URL (relative or full URL)', 'avid-learner'),
    'section'     => 'al_stack_cards',
    'type'        => 'text',
    'description' => __('Example: /services', 'avid-learner'),
  ]);

  $defaults = [
    1 => [
      'label' => '01. SERVICE',
      'title' => 'Talent Development',
      'text'  => 'Build essential capabilities with practical learning paths, real-world application, and measurable skill growth.',
    ],
    2 => [
      'label' => '02. SERVICE',
      'title' => 'Team Coaching & Development',
      'text'  => 'Improve trust, alignment, and collaboration through facilitated coaching sessions that strengthen team performance.',
    ],
    3 => [
      'label' => '03. SERVICE',
      'title' => 'Executive Coaching & Development',
      'text'  => 'One-on-one coaching for leaders to sharpen decision-making, communication, presence, and strategic execution.',
    ],
    4 => [
      'label' => '04. SERVICE',
      'title' => 'Leadership Development & Facilitation',
      'text'  => 'Workshops and facilitation that elevate leadership habits, clarity, and accountability across the organization.',
    ],
    5 => [
      'label' => '05. SERVICE',
      'title' => 'Culture & Change Management',
      'text'  => 'Guide change with structure and empathy—aligning people, processes, and communication so adoption actually sticks.',
    ],
  ];

  for ($i = 1; $i <= 5; $i++) {

    $wp_customize->add_setting("al_stack_card{$i}_label", [
      'default'           => $defaults[$i]['label'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stack_card{$i}_label", [
      'label'   => sprintf(__('Card %d - Label (e.g. 01. SERVICE)', 'avid-learner'), $i),
      'section' => 'al_stack_cards',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_stack_card{$i}_title", [
      'default'           => $defaults[$i]['title'],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_stack_card{$i}_title", [
      'label'   => sprintf(__('Card %d - Heading', 'avid-learner'), $i),
      'section' => 'al_stack_cards',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_stack_card{$i}_text", [
      'default'           => $defaults[$i]['text'],
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_stack_card{$i}_text", [
      'label'   => sprintf(__('Card %d - Description', 'avid-learner'), $i),
      'section' => 'al_stack_cards',
      'type'    => 'textarea',
    ]);

    $wp_customize->add_setting("al_stack_card{$i}_image", [
      'default'           => '',
      'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control(
      $wp_customize,
      "al_stack_card{$i}_image",
      [
        'label'   => sprintf(__('Card %d - Image', 'avid-learner'), $i),
        'section' => 'al_stack_cards',
      ]
    ));
  }
}
add_action('customize_register', 'al_customize_stacking_cards');


/* ======================================================
   CUSTOMIZER: ABOUT PAGE - ABOUT US SECTION  [ABOUT]
====================================================== */
function al_customize_about_us($wp_customize) {

  $wp_customize->add_section('al_about_us', [
    'title'    => __('About Us Section', 'avid-learner'),
    'priority' => 10,
    'panel'    => 'al_panel_about',
  ]);

  $wp_customize->add_setting('al_about_enabled', [
    'default'           => true,
    'sanitize_callback' => function($v){ return (bool)$v; },
  ]);
  $wp_customize->add_control('al_about_enabled', [
    'type'    => 'checkbox',
    'section' => 'al_about_us',
    'label'   => __('Enable About Us section', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_img_1', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'al_about_img_1', [
    'label'   => __('About Image 1', 'avid-learner'),
    'section' => 'al_about_us',
  ]));

  $wp_customize->add_setting('al_about_img_2', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'al_about_img_2', [
    'label'   => __('About Image 2', 'avid-learner'),
    'section' => 'al_about_us',
  ]));

  $wp_customize->add_setting('al_about_circle_img', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'al_about_circle_img', [
    'label'       => __('Circle Image (SVG)', 'avid-learner'),
    'description' => __('Rotating circle image shown between photos.', 'avid-learner'),
    'section'     => 'al_about_us',
  ]));

  $wp_customize->add_setting('al_about_kicker', [
    'default'           => 'ABOUT US',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_kicker', [
    'type'    => 'text',
    'section' => 'al_about_us',
    'label'   => __('Small heading (kicker)', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_title', [
    'default'           => 'Trusted guidance for <span>business growth</span>',
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('al_about_title', [
    'type'        => 'textarea',
    'section'     => 'al_about_us',
    'label'       => __('Main heading (HTML allowed: <span>)', 'avid-learner'),
    'description' => __('Example: Trusted guidance for <span>business growth</span>', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_desc', [
    'default'           => 'We partner with teams to clarify strategy, strengthen execution, and deliver measurable results. Our approach blends structured analysis, practical insight, and hands-on support tailored to your goals.',
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('al_about_desc', [
    'type'    => 'textarea',
    'section' => 'al_about_us',
    'label'   => __('Description', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_service_title', [
    'default'           => 'Strategic Advisory',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_service_title', [
    'type'    => 'text',
    'section' => 'al_about_us',
    'label'   => __('Service box title', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_service_desc', [
    'default'           => 'Clear, data-informed guidance to improve decision-making, optimize operations, and support long-term growth.',
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('al_about_service_desc', [
    'type'    => 'textarea',
    'section' => 'al_about_us',
    'label'   => __('Service box description', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_service_fa', [
    'default'           => 'fa-solid fa-briefcase',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_service_fa', [
    'type'        => 'text',
    'section'     => 'al_about_us',
    'label'       => __('Service icon (Font Awesome classes)', 'avid-learner'),
    'description' => __('Example: fa-solid fa-briefcase  |  fa-solid fa-chart-line  |  fa-solid fa-layer-group', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_author_photo', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'al_about_author_photo', [
    'label'   => __('Author photo', 'avid-learner'),
    'section' => 'al_about_us',
  ]));

  $wp_customize->add_setting('al_about_author_name', [
    'default'           => 'Kimberly',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_author_name', [
    'type'    => 'text',
    'section' => 'al_about_us',
    'label'   => __('Author name', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_author_title', [
    'default'           => 'Co. Founder',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_author_title', [
    'type'    => 'text',
    'section' => 'al_about_us',
    'label'   => __('Author title', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_checks', [
    'default'           => "Strategy & Roadmaps\nClear Communication\nOngoing Support",
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('al_about_checks', [
    'type'    => 'textarea',
    'section' => 'al_about_us',
    'label'   => __('Checklist items (one per line)', 'avid-learner'),
  ]);
}
add_action('customize_register', 'al_customize_about_us');

/* ======================================================
   CUSTOMIZER: ABOUT PAGE - ABOUT US VALUES  [ABOUT]
====================================================== */
add_action('customize_register', function($wp_customize){

  $wp_customize->add_section('al_about_values_section', [
    'title'       => __('Values', 'avid-learner'),
    'priority'    => 30,
    'panel'       => 'al_panel_about',
    'description' => __('Customize the Values + Approach + Metrics block on the About page.', 'avid-learner'),
  ]);

  // Enable toggle
  $wp_customize->add_setting('al_about_values_enabled', [
    'default'           => true,
    'sanitize_callback' => function($v){ return (bool)$v; },
  ]);
  $wp_customize->add_control('al_about_values_enabled', [
    'type'    => 'checkbox',
    'section' => 'al_about_values_section',
    'label'   => __('Enable Values section', 'avid-learner'),
  ]);

  // Left area
  $wp_customize->add_setting('al_about_values_pill', [
    'default'           => 'Our Values',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_values_pill', [
    'label'   => __('Pill Text', 'avid-learner'),
    'section' => 'al_about_values_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_about_values_title', [
    'default'           => 'The Principles That',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_values_title', [
    'label'   => __('Title (first part)', 'avid-learner'),
    'section' => 'al_about_values_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_about_values_highlight', [
    'default'           => 'Guide Us',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_values_highlight', [
    'label'   => __('Title (highlight word)', 'avid-learner'),
    'section' => 'al_about_values_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_about_values_subtitle', [
    'default'           => "Our values shape every decision we make and every interaction we have. They're the foundation of our culture and the key to our success.",
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_about_values_subtitle', [
    'label'   => __('Subtitle', 'avid-learner'),
    'section' => 'al_about_values_section',
    'type'    => 'textarea',
  ]);

  // Values defaults
  $defaults = [
    1 => ['fa-solid fa-bullseye', 'Results-Driven', 'We measure our success by the tangible outcomes we deliver for our clients.'],
    2 => ['fa-solid fa-heart', 'Client-Centric', 'Your success is our priority. We become true partners in your journey.'],
    3 => ['fa-solid fa-bolt', 'Innovation First', 'We constantly push boundaries and embrace new ideas and methodologies.'],
    4 => ['fa-solid fa-people-group', 'Collaborative', 'We work alongside your team, building capabilities that last beyond our engagement.'],
  ];

  // 4 values: icon + title + desc
  for ($i = 1; $i <= 4; $i++) {

    $wp_customize->add_setting("al_about_value_{$i}_icon", [
      'default'           => $defaults[$i][0],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_about_value_{$i}_icon", [
      'label'       => sprintf(__('Value %d Icon (Font Awesome classes)', 'avid-learner'), $i),
      'section'     => 'al_about_values_section',
      'type'        => 'text',
      'description' => __('Example: fa-solid fa-heart', 'avid-learner'),
    ]);

    $wp_customize->add_setting("al_about_value_{$i}_title", [
      'default'           => $defaults[$i][1],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_about_value_{$i}_title", [
      'label'   => sprintf(__('Value %d Title', 'avid-learner'), $i),
      'section' => 'al_about_values_section',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_about_value_{$i}_desc", [
      'default'           => $defaults[$i][2],
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_about_value_{$i}_desc", [
      'label'   => sprintf(__('Value %d Description', 'avid-learner'), $i),
      'section' => 'al_about_values_section',
      'type'    => 'textarea',
    ]);
  }

  // Right card
  $wp_customize->add_setting('al_about_values_card_title', [
    'default'           => 'Our Approach',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_values_card_title', [
    'label'   => __('Right Card Title', 'avid-learner'),
    'section' => 'al_about_values_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_about_values_card_desc', [
    'default'           => "We believe in a collaborative, data-driven approach that combines strategic thinking with practical execution. We don't just advise — we partner with you to implement solutions that deliver lasting impact.",
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_about_values_card_desc', [
    'label'   => __('Right Card Description', 'avid-learner'),
    'section' => 'al_about_values_section',
    'type'    => 'textarea',
  ]);

  // Metrics (3)
  $metric_defaults = [
    1 => ['500', '+', 'Projects'],
    2 => ['50',  '+', 'Experts'],
    3 => ['12',  '',  'Countries'],
  ];

  for ($i = 1; $i <= 3; $i++) {
    $wp_customize->add_setting("al_about_metric_{$i}_end", [
      'default'           => $metric_defaults[$i][0],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_about_metric_{$i}_end", [
      'label'   => sprintf(__('Metric %d Number', 'avid-learner'), $i),
      'section' => 'al_about_values_section',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_about_metric_{$i}_suffix", [
      'default'           => $metric_defaults[$i][1],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_about_metric_{$i}_suffix", [
      'label'       => sprintf(__('Metric %d Suffix', 'avid-learner'), $i),
      'section'     => 'al_about_values_section',
      'type'        => 'text',
      'description' => __('Example: + or % or leave blank', 'avid-learner'),
    ]);

    $wp_customize->add_setting("al_about_metric_{$i}_label", [
      'default'           => $metric_defaults[$i][2],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_about_metric_{$i}_label", [
      'label'   => sprintf(__('Metric %d Label', 'avid-learner'), $i),
      'section' => 'al_about_values_section',
      'type'    => 'text',
    ]);
  }

});

/* ======================================================
   CUSTOMIZER: ABOUT PAGE - ABOUT CAROUSEL  [ABOUT]
====================================================== */
function al_customize_about_carousel($wp_customize){

  $wp_customize->add_section('al_about_carousel', [
    'title'       => __('About Carousel', 'avid-learner'),
    'priority'    => 20,
    'panel'       => 'al_panel_about',
    'description' => __('Upload images and set titles for the About page drag carousel.', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_about_carousel_kicker', [
    'default'           => 'Our Story Gallery',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_carousel_kicker', [
    'label'   => __('Kicker (pill text)', 'avid-learner'),
    'section' => 'al_about_carousel',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_about_carousel_title', [
    'default'           => 'Moments that shaped our journey',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_carousel_title', [
    'label'   => __('Section Title', 'avid-learner'),
    'section' => 'al_about_carousel',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_about_carousel_subtitle', [
    'default'           => 'Drag, scroll, or swipe to explore highlights from our work, culture, and milestones.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_about_carousel_subtitle', [
    'label'   => __('Section Subtitle', 'avid-learner'),
    'section' => 'al_about_carousel',
    'type'    => 'textarea',
  ]);

  $slide_count = 7;

  for ($i = 1; $i <= $slide_count; $i++) {

    $wp_customize->add_setting("al_about_carousel_{$i}_title", [
      'default'           => "Slide {$i}",
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_about_carousel_{$i}_title", [
      'label'   => sprintf(__('Slide %d Title', 'avid-learner'), $i),
      'section' => 'al_about_carousel',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_about_carousel_{$i}_image", [
      'default'           => 0,
      'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(
      new WP_Customize_Media_Control(
        $wp_customize,
        "al_about_carousel_{$i}_image",
        [
          'label'     => sprintf(__('Slide %d Image', 'avid-learner'), $i),
          'section'   => 'al_about_carousel',
          'mime_type' => 'image',
        ]
      )
    );
  }
}
add_action('customize_register', 'al_customize_about_carousel');

/* ======================================================
   CUSTOMIZER: ABOUT PAGE - ABOUT CTA CREDENTIALS  [ABOUT]
====================================================== */
add_action('customize_register', function($wp_customize){

  $wp_customize->add_section('al_about_cta_section', [
    'title'       => __('CTA & Credentials', 'avid-learner'),
    'priority'    => 40,
    'panel'       => 'al_panel_about', 
    'description' => __('Customize the About page CTA and credential badges.', 'avid-learner'),
  ]);

  // Enable toggle
  $wp_customize->add_setting('al_about_cta_enabled', [
    'default'           => true,
    'sanitize_callback' => function($v){ return (bool)$v; },
  ]);
  $wp_customize->add_control('al_about_cta_enabled', [
    'type'    => 'checkbox',
    'section' => 'al_about_cta_section',
    'label'   => __('Enable CTA section', 'avid-learner'),
  ]);

  // CTA Title
  $wp_customize->add_setting('al_about_cta_title', [
    'default'           => 'Ready to Write Your Success Story?',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_cta_title', [
    'label'   => __('CTA Title', 'avid-learner'),
    'section' => 'al_about_cta_section',
    'type'    => 'text',
  ]);

  // CTA Description
  $wp_customize->add_setting('al_about_cta_desc', [
    'default'           => 'Join the hundreds of companies that have transformed their businesses with ApexConsult.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_about_cta_desc', [
    'label'   => __('CTA Description', 'avid-learner'),
    'section' => 'al_about_cta_section',
    'type'    => 'textarea',
  ]);

  // Button Text
  $wp_customize->add_setting('al_about_cta_btn_text', [
    'default'           => 'Start Your Journey',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_cta_btn_text', [
    'label'   => __('Button Text', 'avid-learner'),
    'section' => 'al_about_cta_section',
    'type'    => 'text',
  ]);

  // Button URL
  $wp_customize->add_setting('al_about_cta_btn_url', [
    'default'           => '/contact',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_cta_btn_url', [
    'label'       => __('Button URL', 'avid-learner'),
    'section'     => 'al_about_cta_section',
    'type'        => 'text',
    'description' => __('Example: /contact or full URL', 'avid-learner'),
  ]);

  // Credentials defaults
  $defaults = [
    1 => ['fa-solid fa-award', 'Top 10 Consulting Firm'],
    2 => ['fa-solid fa-globe', 'Global Presence'],
    3 => ['fa-solid fa-briefcase', 'Fortune 500 Clients'],
  ];

  for ($i = 1; $i <= 3; $i++) {

    $wp_customize->add_setting("al_about_cred_{$i}_icon", [
      'default'           => $defaults[$i][0],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_about_cred_{$i}_icon", [
      'label'       => sprintf(__('Credential %d Icon (Font Awesome)', 'avid-learner'), $i),
      'section'     => 'al_about_cta_section',
      'type'        => 'text',
      'description' => __('Example: fa-solid fa-award', 'avid-learner'),
    ]);

    $wp_customize->add_setting("al_about_cred_{$i}_label", [
      'default'           => $defaults[$i][1],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_about_cred_{$i}_label", [
      'label'   => sprintf(__('Credential %d Label', 'avid-learner'), $i),
      'section' => 'al_about_cta_section',
      'type'    => 'text',
    ]);
  }

});

/* ======================================================
   CUSTOMIZER: ABOUT PAGE - ABOUT TIMELINES  [ABOUT]
====================================================== */
add_action('customize_register', function($wp_customize){

  $wp_customize->add_section('al_about_timeline_section', [
    'title'       => __('Timeline', 'avid-learner'),
    'priority'    => 50,
    'panel'       => 'al_panel_about',
    'description' => __('Customize the timeline section on the About page.', 'avid-learner'),
  ]);

  // Enable toggle
  $wp_customize->add_setting('al_about_timeline_enabled', [
    'default'           => true,
    'sanitize_callback' => function($v){ return (bool)$v; },
  ]);
  $wp_customize->add_control('al_about_timeline_enabled', [
    'type'    => 'checkbox',
    'section' => 'al_about_timeline_section',
    'label'   => __('Enable Timeline section', 'avid-learner'),
  ]);

  // Header fields
  $wp_customize->add_setting('al_about_timeline_pill', [
    'default'           => 'Our Journey',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_timeline_pill', [
    'label'   => __('Pill Text', 'avid-learner'),
    'section' => 'al_about_timeline_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_about_timeline_title_1', [
    'default'           => 'The',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_timeline_title_1', [
    'label'   => __('Title (first word)', 'avid-learner'),
    'section' => 'al_about_timeline_section',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_about_timeline_highlight', [
    'default'           => 'ApexConsult',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_about_timeline_highlight', [
    'label'   => __('Title Highlight (company name)', 'avid-learner'),
    'section' => 'al_about_timeline_section',
    'type'    => 'text',
  ]);

  // Defaults for 5 timeline items
  $defaults = [
    1 => ['2012', 'Founded', 'Started with a vision to transform how businesses approach growth and strategy.'],
    2 => ['2015', 'National Expansion', 'Opened offices in New York, San Francisco, and Chicago.'],
    3 => ['2018', 'Digital Innovation Lab', 'Launched our innovation practice to help clients navigate digital disruption.'],
    4 => ['2021', 'Global Reach', 'Expanded internationally with offices in London and Singapore.'],
    5 => ['2024', '500+ Projects', 'Celebrated delivering over 500 successful client engagements.'],
  ];

  // Items 1–5
  for ($i = 1; $i <= 5; $i++) {

    $wp_customize->add_setting("al_timeline_{$i}_year", [
      'default'           => $defaults[$i][0],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_timeline_{$i}_year", [
      'label'   => sprintf(__('Item %d Year', 'avid-learner'), $i),
      'section' => 'al_about_timeline_section',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_timeline_{$i}_title", [
      'default'           => $defaults[$i][1],
      'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control("al_timeline_{$i}_title", [
      'label'   => sprintf(__('Item %d Title', 'avid-learner'), $i),
      'section' => 'al_about_timeline_section',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_timeline_{$i}_desc", [
      'default'           => $defaults[$i][2],
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control("al_timeline_{$i}_desc", [
      'label'   => sprintf(__('Item %d Description', 'avid-learner'), $i),
      'section' => 'al_about_timeline_section',
      'type'    => 'textarea',
    ]);
  }

});

/* ======================================================
   CUSTOMIZER: SERVICES PAGE - SERVICES GRID  [SERVICES]
====================================================== */
// function al_customize_services_grid($wp_customize) {

//   $wp_customize->add_section('al_services_grid', [
//     'title'       => __('Services Grid', 'avid-learner'),
//     'priority'    => 10,
//     'panel'       => 'al_panel_services',
//     'description' => __('Edit the Services Grid section content and Font Awesome icons.', 'avid-learner'),
//   ]);

//   $wp_customize->add_setting('al_svc_kicker', [
//     'default'           => 'Our Services',
//     'sanitize_callback' => 'sanitize_text_field',
//   ]);
//   $wp_customize->add_control('al_svc_kicker', [
//     'label'   => __('Kicker (pill text)', 'avid-learner'),
//     'section' => 'al_services_grid',
//     'type'    => 'text',
//   ]);

//   $wp_customize->add_setting('al_svc_title', [
//     'default'           => 'Strategic Solutions for Every Challenge',
//     'sanitize_callback' => 'sanitize_text_field',
//   ]);
//   $wp_customize->add_control('al_svc_title', [
//     'label'   => __('Title', 'avid-learner'),
//     'section' => 'al_services_grid',
//     'type'    => 'text',
//   ]);

//   $wp_customize->add_setting('al_svc_title_highlight', [
//     'default'           => 'Every Challenge',
//     'sanitize_callback' => 'sanitize_text_field',
//   ]);
//   $wp_customize->add_control('al_svc_title_highlight', [
//     'label'       => __('Title Highlight (gradient words)', 'avid-learner'),
//     'section'     => 'al_services_grid',
//     'type'        => 'text',
//     'description' => __('This will be highlighted in gradient in the title.', 'avid-learner'),
//   ]);

//   $wp_customize->add_setting('al_svc_subtitle', [
//     'default'           => 'From strategy to execution, we provide comprehensive consulting services that drive measurable business outcomes.',
//     'sanitize_callback' => 'sanitize_textarea_field',
//   ]);
//   $wp_customize->add_control('al_svc_subtitle', [
//     'label'   => __('Subtitle', 'avid-learner'),
//     'section' => 'al_services_grid',
//     'type'    => 'textarea',
//   ]);

//   $defaults = [
//     1 => [
//       'icon' => 'fa-regular fa-lightbulb',
//       'title' => 'Strategy Consulting',
//       'desc'  => 'Develop comprehensive business strategies that align with your vision and drive sustainable growth.',
//       'url'   => '/services/strategy-consulting',
//       'features' => ['Market Analysis','Competitive Strategy','Business Planning','M&A Advisory'],
//     ],
//     2 => [
//       'icon' => 'fa-solid fa-arrow-trend-up',
//       'title' => 'Growth Marketing',
//       'desc'  => 'Accelerate customer acquisition and revenue growth with data-driven marketing strategies.',
//       'url'   => '/services/growth-marketing',
//       'features' => ['Go-to-Market Strategy','Brand Positioning','Digital Marketing','Performance Analytics'],
//     ],
//     3 => [
//       'icon' => 'fa-solid fa-chart-column',
//       'title' => 'Digital Transformation',
//       'desc'  => 'Modernize your operations with cutting-edge technology and process optimization.',
//       'url'   => '/services/digital-transformation',
//       'features' => ['Technology Roadmap','Process Automation','Cloud Migration','Data Analytics'],
//     ],
//     4 => [
//       'icon' => 'fa-solid fa-people-group',
//       'title' => 'Organizational Development',
//       'desc'  => 'Build high-performing teams and cultures that drive innovation and excellence.',
//       'url'   => '/services/organizational-development',
//       'features' => ['Leadership Development','Change Management','Team Building','Culture Design'],
//     ],
//     5 => [
//       'icon' => 'fa-solid fa-rocket',
//       'title' => 'Innovation Advisory',
//       'desc'  => 'Stay ahead of the curve with innovation strategies and emerging technology insights.',
//       'url'   => '/services/innovation-advisory',
//       'features' => ['Innovation Labs','R&D Strategy','Product Development','Startup Partnerships'],
//     ],
//     6 => [
//       'icon' => 'fa-solid fa-shield-halved',
//       'title' => 'Risk & Compliance',
//       'desc'  => 'Navigate complex regulatory landscapes and build resilient business operations.',
//       'url'   => '/services/risk-compliance',
//       'features' => ['Risk Assessment','Compliance Frameworks','Crisis Management','Business Continuity'],
//     ],
//   ];

//   for ($i = 1; $i <= 6; $i++) {

//     $wp_customize->add_setting("al_svc_{$i}_icon", [
//       'default'           => $defaults[$i]['icon'],
//       'sanitize_callback' => 'sanitize_text_field',
//     ]);
//     $wp_customize->add_control("al_svc_{$i}_icon", [
//       'label'       => sprintf(__('Service %d - Font Awesome icon class', 'avid-learner'), $i),
//       'section'     => 'al_services_grid',
//       'type'        => 'text',
//       'description' => __('Example: fa-solid fa-rocket', 'avid-learner'),
//     ]);

//     $wp_customize->add_setting("al_svc_{$i}_title", [
//       'default'           => $defaults[$i]['title'],
//       'sanitize_callback' => 'sanitize_text_field',
//     ]);
//     $wp_customize->add_control("al_svc_{$i}_title", [
//       'label'   => sprintf(__('Service %d - Title', 'avid-learner'), $i),
//       'section' => 'al_services_grid',
//       'type'    => 'text',
//     ]);

//     $wp_customize->add_setting("al_svc_{$i}_desc", [
//       'default'           => $defaults[$i]['desc'],
//       'sanitize_callback' => 'sanitize_textarea_field',
//     ]);
//     $wp_customize->add_control("al_svc_{$i}_desc", [
//       'label'   => sprintf(__('Service %d - Description', 'avid-learner'), $i),
//       'section' => 'al_services_grid',
//       'type'    => 'textarea',
//     ]);

//     $wp_customize->add_setting("al_svc_{$i}_url", [
//       'default'           => $defaults[$i]['url'],
//       'sanitize_callback' => 'sanitize_text_field',
//     ]);
//     $wp_customize->add_control("al_svc_{$i}_url", [
//       'label'       => sprintf(__('Service %d - Learn More URL', 'avid-learner'), $i),
//       'section'     => 'al_services_grid',
//       'type'        => 'text',
//       'description' => __('Example: /services/strategy-consulting', 'avid-learner'),
//     ]);

//     for ($f = 1; $f <= 4; $f++) {
//       $wp_customize->add_setting("al_svc_{$i}_feature_{$f}", [
//         'default'           => $defaults[$i]['features'][$f-1] ?? '',
//         'sanitize_callback' => 'sanitize_text_field',
//       ]);
//       $wp_customize->add_control("al_svc_{$i}_feature_{$f}", [
//         'label'   => sprintf(__('Service %d - Feature %d', 'avid-learner'), $i, $f),
//         'section' => 'al_services_grid',
//         'type'    => 'text',
//       ]);
//     }
//   }
// }
// add_action('customize_register', 'al_customize_services_grid');


/* ======================================================
   CUSTOMIZER: CONTACT PAGE  [CONTACT]
====================================================== */
function al_customize_contact_page($wp_customize) {

  $wp_customize->add_section('al_contact_page', [
    'title'       => __('Contact Page', 'avid-learner'),
    'priority'    => 10,
    'panel'       => 'al_panel_contact',
    'description' => __('Customize the Contact page content and Contact Form 7 shortcode.', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_contact_badge', [
    'default'           => 'Get in Touch',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_badge', [
    'label'   => __('Hero Badge', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_contact_title', [
    'default'           => "Let's Start a Conversation",
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_title', [
    'label'   => __('Hero Title', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_contact_subtitle', [
    'default'           => "Ready to transform your business? We'd love to hear from you. Fill out the form below or book a consultation directly.",
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_contact_subtitle', [
    'label'   => __('Hero Subtitle', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('al_contact_form_title', [
    'default'           => 'Send us a message',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_form_title', [
    'label'   => __('Form Title', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_contact_cf7_shortcode', [
    'default'           => '[contact-form-7 id="123" title="Contact Form"]',
    'sanitize_callback' => 'wp_kses_post',
  ]);
  $wp_customize->add_control('al_contact_cf7_shortcode', [
    'label'       => __('Contact Form 7 Shortcode', 'avid-learner'),
    'section'     => 'al_contact_page',
    'type'        => 'text',
    'description' => __('Paste CF7 shortcode. Example: [contact-form-7 id="123" title="Contact Form"]', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_contact_call_title', [
    'default'           => 'Prefer to talk directly?',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_call_title', [
    'label'   => __('Call Card Title', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_contact_call_text', [
    'default'           => 'Book a free 30-minute consultation with one of our experts.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);
  $wp_customize->add_control('al_contact_call_text', [
    'label'   => __('Call Card Text', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'textarea',
  ]);

  $wp_customize->add_setting('al_contact_call_btn', [
    'default'           => 'Schedule a Call',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_call_btn', [
    'label'   => __('Call Button Text', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_contact_call_url', [
    'default'           => '/book',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_contact_call_url', [
    'label'       => __('Call Button URL (relative or full)', 'avid-learner'),
    'section'     => 'al_contact_page',
    'type'        => 'text',
    'description' => __('Example: /book or https://calendly.com/yourname/30min', 'avid-learner'),
  ]);

  $wp_customize->add_setting('al_contact_email', [
    'default'           => 'kim.kerley@avidlearner.com',
    'sanitize_callback' => 'sanitize_email',
  ]);
  $wp_customize->add_control('al_contact_email', [
    'label'   => __('Contact Email', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_contact_phone', [
    'default'           => '+1 (234) 567-890',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_phone', [
    'label'   => __('Contact Phone', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_contact_address1', [
    'default'           => '123 Business Ave, Suite 500',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_address1', [
    'label'   => __('Address Line 1', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_contact_address2', [
    'default'           => 'Philadelphia, PA',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('al_contact_address2', [
    'label'   => __('Address Line 2', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_contact_social_linkedin', [
    'default'           => 'https://www.linkedin.com/company/avid-learner-inc./posts/',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_contact_social_linkedin', [
    'label'   => __('LinkedIn URL', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_contact_social_Instagram', [
    'default'           => '#',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_contact_social_Instagram', [
    'label'   => __('Instagram URL', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);

  $wp_customize->add_setting('al_contact_social_facebook', [
    'default'           => '#',
    'sanitize_callback' => 'esc_url_raw',
  ]);
  $wp_customize->add_control('al_contact_social_facebook', [
    'label'   => __('Facebook URL', 'avid-learner'),
    'section' => 'al_contact_page',
    'type'    => 'text',
  ]);
}
add_action('customize_register', 'al_customize_contact_page');


/* ======================================================
   INLINE JS: Stacking cards effect
====================================================== */
add_action('wp_enqueue_scripts', function () {

  wp_enqueue_style('al-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version'));

  $js = <<<JS
(() => {
  const cards = document.querySelectorAll('.al-stack-card');
  if (!cards.length) return;

  const onScroll = () => {
    const viewportHeight = window.innerHeight;
    const isMobile = window.innerWidth <= 768;
    const stickyTopOffset = isMobile ? viewportHeight * 0.10 : viewportHeight * 0.15;

    cards.forEach((card, index) => {
      const nextCard = cards[index + 1];
      if (!nextCard) return;

      const nextRect = nextCard.getBoundingClientRect();
      const distance = nextRect.top - stickyTopOffset;

      if (distance < viewportHeight && distance > 0) {
        const maxShrink = isMobile ? 0.965 : 0.92;
        const factor = (1 - maxShrink) / viewportHeight;

        const scale = 1 - ((viewportHeight - distance) * factor);
        const finalScale = Math.max(maxShrink, Math.min(1, scale));

        const brightness = Math.max(0.86, Math.min(1, scale));

        card.style.transform = `scale(\${finalScale})`;
        card.style.filter = `brightness(\${brightness})`;
      } else if (distance <= 0) {
        const maxShrink = isMobile ? 0.965 : 0.92;
        card.style.transform = `scale(\${maxShrink})`;
        card.style.filter = 'brightness(0.86)';
      } else {
        card.style.transform = 'scale(1)';
        card.style.filter = 'brightness(1)';
      }
    });
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);
  onScroll();
})();
JS;

  wp_register_script('al-stack-inline', '', [], null, true);
  wp_enqueue_script('al-stack-inline');
  wp_add_inline_script('al-stack-inline', $js);
});


/* ======================================================
   About counters JS (kept)
====================================================== */
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'font-awesome-6',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
    [],
    '6.5.1'
  );

  $js = <<<JS
(() => {
  const els = document.querySelectorAll('[data-counter]');
  if (!els.length) return;

  const animate = (el) => {
    const end = parseInt(el.getAttribute('data-end') || '0', 10);
    const suffix = el.getAttribute('data-suffix') || '';
    const dur = parseInt(el.getAttribute('data-duration') || '1200', 10);
    const start = 0;
    const t0 = performance.now();

    const tick = (t) => {
      const p = Math.min(1, (t - t0) / dur);
      const val = Math.floor(start + (end - start) * (p * (2 - p)));
      el.textContent = val.toLocaleString() + suffix;
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  };

  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting && !e.target.dataset.did) {
        e.target.dataset.did = '1';
        animate(e.target);
      }
    });
  }, { threshold: 0.35 });

  els.forEach(el => io.observe(el));
})();
JS;

  wp_register_script('al-counters', '', [], null, true);
  wp_enqueue_script('al-counters');
  wp_add_inline_script('al-counters', $js);
});


/* ======================================================
   Enqueue About Carousel + Timeline scripts (kept)
====================================================== */
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'al-about-carousel',
    get_template_directory_uri() . '/assets/js/about-carousel.js',
    [],
    '1.0.0',
    true
  );
});

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'al-timeline-reveal',
    get_template_directory_uri() . '/assets/js/timeline-reveal.js',
    [],
    '1.0.0',
    true
  );
});


/* ======================================================
   Blog Carousel JS (kept)
====================================================== */
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'al-blog-carousel',
    get_template_directory_uri() . '/assets/js/blog-carousel.js',
    [],
    '1.0.0',
    true
  );
});

/* =========================================================
   PROVIDERS CUSTOMIZER
========================================================= */
function al_customize_register_providers($wp_customize) {

  $wp_customize->add_section('al_providers_section', [
    'title'    => __('Providers', 'avid-learner'),
    'priority' => 40,
  ]);

  // Section heading
  $wp_customize->add_setting('al_providers_heading', [
    'default'           => 'Meet Our Providers',
    'sanitize_callback' => 'sanitize_text_field',
  ]);

  $wp_customize->add_control('al_providers_heading', [
    'label'   => __('Providers Heading', 'avid-learner'),
    'section' => 'al_providers_section',
    'type'    => 'text',
  ]);

  // Section description
  $wp_customize->add_setting('al_providers_desc', [
    'default'           => 'Our team combines leadership, organizational, and coaching expertise to support growth at every level.',
    'sanitize_callback' => 'sanitize_textarea_field',
  ]);

  $wp_customize->add_control('al_providers_desc', [
    'label'   => __('Providers Description', 'avid-learner'),
    'section' => 'al_providers_section',
    'type'    => 'textarea',
  ]);

  // 6 provider slots
  for ($i = 1; $i <= 24; $i++) {

    $wp_customize->add_setting("al_provider_{$i}_name", [
      'default'           => '',
      'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control("al_provider_{$i}_name", [
      'label'   => __("Provider {$i} Name", 'avid-learner'),
      'section' => 'al_providers_section',
      'type'    => 'text',
    ]);

    $wp_customize->add_setting("al_provider_{$i}_bio", [
      'default'           => '',
      'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control("al_provider_{$i}_bio", [
      'label'   => __("Provider {$i} Bio", 'avid-learner'),
      'section' => 'al_providers_section',
      'type'    => 'textarea',
    ]);

    $wp_customize->add_setting("al_provider_{$i}_image", [
      'default'           => '',
      'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(
      new WP_Customize_Image_Control(
        $wp_customize,
        "al_provider_{$i}_image",
        [
          'label'   => __("Provider {$i} Image", 'avid-learner'),
          'section' => 'al_providers_section',
        ]
      )
    );
  }
}
add_action('customize_register', 'al_customize_register_providers');