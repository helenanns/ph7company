<?php
/**
 * Vite integration (DEV + PROD) for WordPress theme
 * - DEV: loads @vite/client + entry from dev server (HMR + React Refresh)
 * - PROD: loads files from dist/.vite/manifest.json and enqueues CSS automatically
 */

function vite_is_dev()
{
	$fp = @fsockopen('127.0.0.1', 5173, $errno, $errstr, 0.2);
	if ($fp) {
		fclose($fp);
		return true;
	}
	return false;
}

function vite_dev_server()
{
	return 'http://127.0.0.1:5173';
}

function vite_manifest()
{
	$path = get_template_directory() . '/dist/.vite/manifest.json';

	return file_exists($path) ? json_decode(file_get_contents($path), true) : null;
}

function vite_enqueue_entry($handle, $entry, $in_footer = true)
{
	// DEV MODE (Vite server)
	if (vite_is_dev()) {
		if (!wp_script_is('vite-client', 'enqueued')) {
			wp_enqueue_script('vite-client', vite_dev_server() . '/@vite/client', [], null, false);
		}

		wp_enqueue_script($handle, vite_dev_server() . '/' . ltrim($entry, '/'), [], null, $in_footer);

		return;
	}

	// PROD MODE (manifest)
	$manifest = vite_manifest();
	if (!$manifest || !isset($manifest[$entry])) {
		return;
	}

	$asset = $manifest[$entry];

	if (!empty($asset['file'])) {
		wp_enqueue_script(
			$handle,
			get_template_directory_uri() . '/dist/' . $asset['file'],
			[],
			null,
			$in_footer,
		);
	}

	if (!empty($asset['css']) && is_array($asset['css'])) {
		foreach ($asset['css'] as $i => $css) {
			wp_enqueue_style(
				$handle . '-css-' . $i,
				get_template_directory_uri() . '/dist/' . $css,
				[],
				null,
			);
		}
	}
}

add_action('wp_enqueue_scripts', function () {
	if (is_admin()) {
		return;
	}

	vite_enqueue_entry('theme-main', 'src/js/main.js');

	wp_enqueue_style(
		'theme-fonts-local',
		get_template_directory_uri() . '/assets/fonts/style.css',
		[],
		null,
	);

	if (is_page_template('template-homepage.php')) {
		vite_enqueue_entry('theme-home', 'src/js/home.js');
	}

	if (is_singular('product')) {
		vite_enqueue_entry('theme-product', 'src/js/single-product.js');
	}

	if (is_archive('product')) {
		vite_enqueue_entry('theme-archive-product', 'src/js/archive-product.js');
	}

	if (is_single()) {
		vite_enqueue_entry('theme-single', 'src/js/single.js');
	}

	if (is_page_template('template-about.php')) {
		vite_enqueue_entry('theme-about', 'src/js/about.js');
	}

	if (is_page()) {
		vite_enqueue_entry('theme-page', 'src/js/page.js');
	}

	if (is_home()) {
		vite_enqueue_entry('theme-blog', 'src/js/blog.js');
	}

	if (function_exists('is_account_page') && is_account_page()) {
		vite_enqueue_entry('theme-account', 'src/js/account.js');
	}

	if (function_exists('is_cart') && is_cart()) {
		vite_enqueue_entry('theme-cart', 'src/js/cart.js');
	}
});

/**
 * GUTENBERG / BLOCK EDITOR ASSETS
 * (React blocks bundle)
 */
add_action('enqueue_block_editor_assets', function () {
	vite_enqueue_entry('theme-blocks', 'src/blocks/index.jsx', true);
});

add_filter(
	'script_loader_tag',
	function ($tag, $handle, $src) {
		$module_handles = [
			'vite-client',
			'theme-main',
			'theme-home',
			'theme-product',
			'theme-archive-product',
			'theme-about',
			'theme-single',
			'theme-page',
			'theme-blog',
			'theme-account',
			'theme-cart',
			'theme-blocks',
		];

		if (in_array($handle, $module_handles, true)) {
			return '<script type="module" src="' . esc_url($src) . '"></script>';
		}
		return $tag;
	},
	10,
	3,
);
