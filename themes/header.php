<?php
/**
 * Header template
 * Author: Nghia Ha
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- TOP BAR -->
<div class="top-bar">
  <div class="top-left">
    <span>
      <i class="fa-solid fa-envelope"></i>
      <a href="mailto:info@avidlearner.com">info@avidlearner.com</a>
    </span>

    <span>
      <i class="fa-solid fa-location-dot"></i>
      Philadelphia, PA, US
    </span>
  </div>

<div class="top-right">
  <a href="https://www.facebook.com/profile.php?id=61586184092797"
     aria-label="Facebook"
     target="_blank"
     rel="noopener noreferrer">
    <i class="fab fa-facebook-f"></i>
  </a>

  <a href="https://www.linkedin.com/company/avid-learner-inc./posts/"
     aria-label="LinkedIn"
     target="_blank"
     rel="noopener noreferrer">
    <i class="fab fa-linkedin-in"></i>
  </a>

  <a href="https://www.instagram.com/tryavidlearner/"
     aria-label="Instagram"
     target="_blank"
     rel="noopener noreferrer">
    <i class="fab fa-instagram"></i>
  </a>
</div>

</div>

<!-- NAVBAR -->
<nav class="navbar" aria-label="Primary Navigation">

  <!-- LEFT: Logo -->
  <div class="nav-left">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo logo-wrap" aria-label="Avid Learner Home">
      <img
        class="logo-img"
        src="https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/04/AvidLearner.png"
        alt="Avid Learner Logo"
      />
      <img
        class="logo-img-2"
        src="https://steelblue-narwhal-734439.hostingersite.com/wp-content/uploads/2026/04/5.png"
        alt="Avid Learner Logo"
      />
      <!-- <span class="logo-text">Avid Learner</span> -->
    </a>
  </div>

  <!-- MOBILE TOGGLE (shows on mobile only via CSS) -->
  <button class="nav-toggle" type="button"
    aria-label="Open menu"
    aria-expanded="false"
    aria-controls="primaryMenu">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <!-- CENTER: Menu (WordPress) -->
  <div class="nav-center" id="primaryMenu">
    <?php
      wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'menu',
        'fallback_cb'    => function () {
          echo '<ul class="menu">';
          echo '<li><a href="' . esc_url(home_url('/')) . '"><span class="hover-span"></span>Home</a></li>';
            echo '<li class="menu-item-has-children">';
              echo '<a href="' . esc_url(home_url('/services')) . '"><span class="hover-span"></span>Services</a>';
              echo '<ul class="sub-menu">';
                echo '<li><a href="' . esc_url(home_url('/executive-coaching')) . '"><span class="hover-span"></span>Executive Coaching</a></li>';
                echo '<li><a href="' . esc_url(home_url('/leadership-development')) . '"><span class="hover-span"></span>Leadership Development</a></li>';
                echo '<li><a href="' . esc_url(home_url('/team-organizational-development')) . '"><span class="hover-span"></span>Team &amp; Organizational Development</a></li>';
              echo '</ul>';
            echo '</li>';
          echo '<li><a href="' . esc_url(home_url('/providers')) . '"><span class="hover-span"></span>Providers</a></li>';
          echo '<li><a href="' . esc_url(home_url('/community')) . '"><span class="hover-span"></span>Community</a></li>';
          echo '<li><a href="' . esc_url(home_url('/about')) . '"><span class="hover-span"></span>About</a></li>';
          echo '<li><a href="' . esc_url(home_url('/insights')) . '"><span class="hover-span"></span>Insights</a></li>';
          echo '<li><a href="' . esc_url(home_url('/contact')) . '"><span class="hover-span"></span>Contact</a></li>';
          echo '</ul>';
        },
        // Inserts the animated sweep span inside each <a>
        'link_before'    => '<span class="hover-span"></span>',
      ]);
    ?>
  </div>

  <!-- RIGHT: Button -->
  <div class="nav-right">
    <a class="btn3"
   href="<?php echo esc_url('https://scheduler.zoom.us/kim-kerley-2shal7/fit-and-focus-call'); ?>"
   target="_blank"
   rel="noopener noreferrer">
      <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
      </svg>

      <span class="text">Book a Conversation</span>
      <span class="circle" aria-hidden="true"></span>

      <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
      </svg>
    </a>
  </div>

</nav>

<!-- Mobile menu toggle script -->
<script>
  (function () {
    const btn = document.querySelector(".nav-toggle");
    const menu = document.getElementById("primaryMenu");
    if (!btn || !menu) return;

    btn.addEventListener("click", () => {
      const open = document.body.classList.toggle("nav-open");
      btn.setAttribute("aria-expanded", open ? "true" : "false");
    });

    // Close menu when clicking a link
    menu.addEventListener("click", (e) => {
      const a = e.target.closest("a");
      if (!a) return;
      document.body.classList.remove("nav-open");
      btn.setAttribute("aria-expanded", "false");
    });

    // Close menu if user resizes back to desktop
    window.addEventListener("resize", () => {
      if (window.innerWidth > 900) {
        document.body.classList.remove("nav-open");
        btn.setAttribute("aria-expanded", "false");
      }
    });
  })();
</script>
