<?php

function vite_is_dev() {
	return defined('WP_DEBUG') && WP_DEBUG;
}

function vite_manifest() {
	$path = get_template_directory() . '/dist/manifest.json';
	return file_exists($path)
		? json_decode(file_get_contents($path), true)
		: null;
}

function vite_asset($entry) {
	// DEV SERVER
	if (vite_is_dev()) {
		return "http://localhost:5173/$entry";
	}

	$manifest = vite_manifest();

	if (!$manifest || !isset($manifest[$entry])) return null;

	return get_template_directory_uri() . '/dist/' . $manifest[$entry]['file'];
}

function vite_enqueue($handle, $entry) {

	$manifest = vite_manifest();

	// JS
	wp_enqueue_script($handle, vite_asset($entry), [], null, true);

	// CSS automático (produção)
	if (!vite_is_dev() && $manifest && isset($manifest[$entry]['css'])) {
		foreach ($manifest[$entry]['css'] as $css) {
			wp_enqueue_style($handle . '-css', get_template_directory_uri() . '/dist/' . $css, [], null);
		}
	}
}

/**
 * ENQUEUE GLOBAL
 */
add_action('wp_enqueue_scripts', function () {

	if (is_admin()) return;

	// MAIN
	vite_enqueue('theme-main', 'src/js/main.js');

	// FONTS
	wp_enqueue_style('oxygen', 'https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap');
	wp_enqueue_style('font', 'https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap');

	// HOME
	if (is_page_template('template-homepage.php')) {
		vite_enqueue('theme-home', 'src/js/home.js');
	}

	// WOOCOMMERCE
	if (is_singular('product')) {
		vite_enqueue('theme-product', 'src/js/single-product.js');
	}

	// SINGLE
	if (is_single() || is_page_template('template-about.php')) {
		vite_enqueue('theme-single', 'src/js/single.js');
	}

	// PAGE
	if (is_page()) {
		vite_enqueue('theme-page', 'src/js/page.js');
	}

	// BLOG
	if (is_home()) {
		vite_enqueue('theme-blog', 'src/js/blog.js');
	}

	// ACCOUNT
	if (function_exists('is_account_page') && is_account_page()) {
		vite_enqueue('theme-account', 'src/js/account.js');
	}

	// CART
	if (function_exists('is_cart') && is_cart()) {
		vite_enqueue('theme-cart', 'src/js/cart.js');
	}
});