<?php

require_once __DIR__ . '/product-image.php';
require_once __DIR__ . '/related.php';

remove_action(
	'woocommerce_after_single_product_summary',
	'woocommerce_output_product_data_tabs',
	10,
);

add_action('wp', 'ph7_setup_single_product_layout');
function ph7_setup_single_product_layout()
{
	if (!is_product()) {
		return;
	}

	remove_action('woocommerce_before_single_product_summary', 'ph7_wrap_product_main_open', 5);
	remove_action('woocommerce_after_single_product_summary', 'ph7_wrap_product_main_close', 5);
	remove_action('woocommerce_single_product_summary', 'ph7_output_custom_summary', 1);

	remove_action('ph7_single_product_summary', 'woocommerce_template_single_title', 5);
	remove_action('ph7_single_product_summary', 'woocommerce_template_single_rating', 10);
	remove_action('ph7_single_product_summary', 'woocommerce_template_single_price', 10);
	remove_action('ph7_single_product_summary', 'woocommerce_template_single_excerpt', 20);
	remove_action('ph7_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
	remove_action('ph7_single_product_summary', 'woocommerce_template_single_meta', 40);
	remove_action('ph7_single_product_summary', 'woocommerce_template_single_sharing', 50);

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
	add_action('ph7_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_meta', 40);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_sharing', 50);
	add_action('ph7_single_product_summary', 'ph7_product_tabs_accordion', 35);

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
	do_action('ph7_single_product_summary');
}

function ph7_product_tabs_accordion()
{
	$tabs = apply_filters('woocommerce_product_tabs', []);

	if (empty($tabs)) {
		return;
	}

	echo '<div class="ph7-accordion">';

	foreach ($tabs as $key => $tab) {
		$title = isset($tab['title']) ? $tab['title'] : '';
		$callback = isset($tab['callback']) ? $tab['callback'] : '';
		$panel_id = 'ph7-tab-' . esc_attr($key);

		echo '<div class="ph7-accordion__item">';
		echo '<button class="ph7-accordion__trigger" aria-expanded="false" aria-controls="' .
			$panel_id .
			'">';
		echo esc_html($title);
		echo '<span class="ph7-accordion__icon" aria-hidden="true"></span>';
		echo '</button>';
		echo '<div class="ph7-accordion__panel" id="' . $panel_id . '" hidden>';
		echo '<div class="ph7-accordion__panel-inner">';

		if (is_callable($callback)) {
			call_user_func($callback, $key, $tab);
		}

		echo '</div>';
		echo '</div>';
		echo '</div>';
	}

	echo '</div>';
}
