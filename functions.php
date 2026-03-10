<?php
global $theme_uri;
$theme_uri = get_template_directory_uri();

// ACF Fields
include('includes/functions/acf.php');

// Set Head Content
include('includes/functions/set-head-content.php');

// Post Types
include 'includes/functions/post-types.php';

// Ajax
include 'includes/functions/ajax.php';

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
include 'includes/functions/side-cart.php';