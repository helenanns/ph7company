<?php
defined('ABSPATH') || exit();

function mytheme_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

require_once __DIR__ . '/woocommerce/product-single.php';
require_once __DIR__ . '/woocommerce/related.php';
require_once __DIR__ . '/woocommerce/account.php';

add_filter('woocommerce_enqueue_styles', '__return_empty_array');

add_filter('woocommerce_breadcrumb_defaults', 'ph7_filter_woocommerce_breadcrumb_defaults');
function ph7_filter_woocommerce_breadcrumb_defaults($defaults)
{
	$defaults['wrap_last'] = '<span>%s</span>';
	return $defaults;
}

add_filter('woocommerce_product_loop_start', 'product_list_custom_class');
function product_list_custom_class($html)
{
	$html = '<ul class="m-products-list">';
	return $html;
}

add_filter('woocommerce_breadcrumb_defaults', function ($defaults) {
	$defaults['delimiter'] = '<span>&gt;</span>';
	return $defaults;
});
