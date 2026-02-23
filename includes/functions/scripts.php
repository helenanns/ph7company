<?php

function custom_js()
{
	global $theme_uri;
	$post_type = get_post_type();
	$json_versions = file_get_contents("{$theme_uri}/assets/assets.json");
	$versions = json_decode($json_versions, true);

	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		// $mainJS = "{$theme_uri}/assets/js/{$versions['main.js']}";
		$mainJS = "{$theme_uri}/assets/js/main.js";
		wp_register_script('main', $mainJS, [], array());
		wp_enqueue_script('main');

		$vendorJS = "{$theme_uri}/assets/js/{$versions['vendor.js']}";
		wp_register_script('vendor', $vendorJS, [], array());
		wp_enqueue_script('vendor');
	}

	if (is_page_template('template-homepage.php')) {
        $homeJS = '/assets/js/home.js';
        wp_register_script('home', $theme_uri . $homeJS, array());
        wp_enqueue_script('home');
    }

	if (is_singular('product')) {
        $productJS = '/assets/js/single-product.js';
        wp_register_script('single-product', $theme_uri . $productJS, array());
        wp_enqueue_script('single-product');
    }
}
add_action('wp_footer', 'custom_js');


function custom_css()
{
	global $theme_uri;
	$post_type = get_post_type();
	$json_versions = file_get_contents("{$theme_uri}/assets/assets.json");
	$versions = json_decode($json_versions, true);

	if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		$vendorCSS = '/assets/css/vendor.css';
        wp_register_style('vendor-css', $theme_uri . $vendorCSS, [], $versions);
        wp_enqueue_style('vendor-css');

		$mainCSS = "{$theme_uri}/assets/css/main.css";
		wp_register_style('main-css', $mainCSS, [], $versions);
		wp_enqueue_style('main-css');
		
		$gotham = "{$theme_uri}/assets/fonts/gotham/gotham.css";
		wp_register_style('gotham', $gotham, [], null);
		wp_enqueue_style('gotham');

		$oxygen = "https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap";
		wp_register_style('oxygen', $oxygen, [], null);
		wp_enqueue_style('oxygen');

	$font = "https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap	";
		wp_register_style('font', $font, [], null);
		wp_enqueue_style('font');
	}

	if (is_page_template('template-homepage.php')) {
        $home = '/assets/css/home.css';
        wp_register_style('home-css', $theme_uri . $home, [], $versions);
        wp_enqueue_style('home-css');
    }

	if (is_singular('product')) {
        $product = '/assets/css/single-product.css';
        wp_register_style('single-product-css', $theme_uri . $product, [], null);
        wp_enqueue_style('single-product-css');
    }

	if (is_single() || is_page_template('template-about.php')) {
        $page = '/assets/css/single.css';
        wp_register_style('page-css', $theme_uri . $page, [], $versions);
        wp_enqueue_style('page-css');
    }

	if (is_page() ) {
        $page = '/assets/css/page.css';
        wp_register_style('page-css', $theme_uri . $page, [], null);
        wp_enqueue_style('page-css');
    }

	if (is_home() ) {
        $page = '/assets/css/blog.css';
        wp_register_style('blog-css', $theme_uri . $page, [], '1.0.0');
        wp_enqueue_style('blog-css');
    }

	if ( is_account_page() ) {
    $page = '/assets/css/account.css';
    wp_register_style(
        'account-css',
        $theme_uri . $page,
        [],
        '1.0.0'
    );
    wp_enqueue_style('account-css');
	}

	if (function_exists('is_cart') && is_cart()) {
		$page = '/assets/css/cart.css';
		wp_register_style('cart-css', $theme_uri . $page, [], '1.0.0');
		wp_enqueue_style('cart-css');
	}
}
add_action('wp_enqueue_scripts', 'custom_css');

