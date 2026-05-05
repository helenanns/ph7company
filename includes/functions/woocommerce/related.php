<?php
/**
 * Remove o related products padrão do WooCommerce
 */
remove_action(
	'woocommerce_after_single_product_summary',
	'woocommerce_output_related_products',
	20,
);

/**
 * Adiciona um related products customizado sem sobrescrever template
 */
add_action('woocommerce_after_single_product_summary', 'ph7_custom_output_related_products', 20);

function ph7_custom_output_related_products()
{
	if (!is_product()) {
		return;
	}

	global $product;

	if (!$product || !is_a($product, 'WC_Product')) {
		return;
	}

	$args = [
		'posts_per_page' => 4,
		'columns' => 4,
		'orderby' => 'rand',
	];

	$args = apply_filters('woocommerce_output_related_products_args', $args);

	$related_ids = wc_get_related_products(
		$product->get_id(),
		$args['posts_per_page'],
		$product->get_upsell_ids(),
	);

	if (empty($related_ids)) {
		return;
	}

	$related_products = wc_get_products([
		'include' => $related_ids,
		'status' => 'publish',
		'limit' => -1,
		'orderby' => 'post__in',
	]);

	if (empty($related_products)) {
		return;
	}

	$heading = apply_filters(
		'woocommerce_product_related_products_heading',
		__('Related products', 'woocommerce'),
	);

	echo '<section class="related m-products">';

	if ($heading) {
		echo '<div class="m-products-header">';
		echo '<h2>' . esc_html($heading) . '</h2>';
		echo '</div>';
	}

	echo '<ul class="m-products-list products columns-' . absint($args['columns']) . '">';

	foreach ($related_products as $related_product) {
		$post_object = get_post($related_product->get_id());

		setup_postdata($GLOBALS['post'] = $post_object);

		wc_get_template_part('content', 'product');
	}

	echo '</ul>';
	echo '</section>';

	wp_reset_postdata();
}
