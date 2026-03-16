<?php

require_once __DIR__ . '/woocommerce/related.php';
require_once __DIR__ . '/woocommerce/product-image.php';

// Remove WooCommerce CSS
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Single Product
add_filter('woocommerce_breadcrumb_defaults', function ($defaults) {
	$defaults['wrap_last'] = '<span>%s</span>';
	return $defaults;
});

add_action(
	'woocommerce_before_quantity_input_field',
	function () {
		echo '<button type="button" class="qty-btn qty-btn--minus" aria-label="' .
			esc_attr__('Decrease quantity', 'woocommerce') .
			'">−</button>';
	},
	10,
);

add_action(
	'woocommerce_after_quantity_input_field',
	function () {
		echo '<button type="button" class="qty-btn qty-btn--plus" aria-label="' .
			esc_attr__('Increase quantity', 'woocommerce') .
			'">+</button>';
	},
	10,
);

add_action('init', 'ph7_setup_single_product_layout');

function ph7_setup_single_product_layout()
{
	remove_action('woocommerce_before_single_product_summary', 'ph7_wrap_product_main_open', 5);
	remove_action('woocommerce_after_single_product_summary', 'ph7_wrap_product_main_close', 5);
	remove_action('woocommerce_single_product_summary', 'ph7_output_custom_summary', 1);

	add_action('woocommerce_before_single_product_summary', 'ph7_wrap_product_main_open', 5);
	add_action('woocommerce_after_single_product_summary', 'ph7_wrap_product_main_close', 5);

	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
	remove_action(
		'woocommerce_single_product_summary',
		'woocommerce_template_single_add_to_cart',
		30,
	);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

	add_action('ph7_single_product_summary', 'woocommerce_template_single_title', 5);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_rating', 10);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_price', 10);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_excerpt', 20);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_meta', 40);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_sharing', 50);

	add_action('woocommerce_single_product_summary', 'ph7_output_custom_summary', 1);
}

function ph7_wrap_product_main_open()
{
	echo '<div class="l-product-wrapper">';
}

function ph7_wrap_product_main_close()
{
	echo '</div>';
}

function ph7_output_custom_summary()
{
	echo '<div class="summary entry-summary">';
	do_action('ph7_single_product_summary');
	echo '</div>';
}

add_action('wp', 'ph7_disable_native_wc_gallery_features', 100);

function ph7_disable_native_wc_gallery_features()
{
	if (!is_product()) {
		return;
	}

	remove_theme_support('wc-product-gallery-zoom');
	remove_theme_support('wc-product-gallery-lightbox');
	remove_theme_support('wc-product-gallery-slider');
}

add_action('wp_enqueue_scripts', 'ph7_dequeue_wc_gallery_assets', 100);

function ph7_dequeue_wc_gallery_assets()
{
	if (!is_product()) {
		return;
	}

	wp_dequeue_script('zoom');
	wp_dequeue_script('photoswipe');
	wp_dequeue_script('photoswipe-ui-default');
	wp_dequeue_script('wc-single-product');

	wp_dequeue_style('photoswipe');
	wp_dequeue_style('photoswipe-default-skin');
}
