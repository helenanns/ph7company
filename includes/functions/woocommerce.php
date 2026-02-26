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
