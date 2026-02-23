<?php
global $theme_uri;
$theme_uri = get_template_directory_uri();

// Set Head Content
include('includes/functions/set-head-content.php');

// Post Types
include 'includes/functions/post-types.php';

// Ajax
include 'includes/functions/ajax.php';

// ACF Fields
include('includes/functions/acf.php');

// image size
include 'includes/functions/image-size.php';

// scripts
include 'includes/functions/scripts.php';

// Querys
include 'includes/functions/query.php';

// Utils
include 'includes/functions/utils.php';

// Blocks
include 'includes/functions/blocks.php';

// Menu
include 'includes/functions/menu.php';

include 'includes/functions/woocommerce.php';


function theme_scripts() {
  if (defined('WP_ENV') && WP_ENV === 'development') {
    wp_enqueue_script('vite-client', 'http://localhost:5173/@vite/client', [], null, true);
    wp_enqueue_script('theme-main', 'http://localhost:5173/src/js/main.js', [], null, true);
  } else {
    wp_enqueue_script('theme-main', vite_asset('src/js/main.js'), [], null, true);
    wp_enqueue_style('theme-style', vite_asset('src/scss/main.scss'), [], null);
  }
}
add_action('wp_enqueue_scripts', 'theme_scripts');