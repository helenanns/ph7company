<?php
//Remove Woocommerce CSS
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Account
add_filter('woocommerce_account_menu_items', 'remover_menu_downloads_minha_conta', 999);
function remover_menu_downloads_minha_conta($items)
{
	unset($items['downloads']);
	return $items;
}

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

add_filter('woocommerce_product_single_add_to_cart_text', function () {
	return __('Comprar', 'ph7-textdomain');
});

add_action('init', function () {
	remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
	add_action('woocommerce_before_single_product_summary', 'ph7_wrap_product_main_open', 5);
	add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 10);

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

	add_action('woocommerce_after_single_product_summary', 'ph7_wrap_product_main_close', 5);
});

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
	do_action('ph7_single_product_summary'); //
	echo '</div>';
}
