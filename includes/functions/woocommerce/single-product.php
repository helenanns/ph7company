<?php

require_once __DIR__ . '/product-image.php';
require_once __DIR__ . '/related.php';

add_action('wp', 'ph7_setup_single_product_layout');

function ph7_setup_single_product_layout()
{
	if (!is_product()) {
		return;
	}

	remove_action('woocommerce_before_single_product_summary', 'ph7_wrap_product_main_open', 5);
	remove_action('woocommerce_after_single_product_summary', 'ph7_wrap_product_main_close', 5);
	remove_action('woocommerce_single_product_summary', 'ph7_output_custom_summary', 1);

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

	add_action('woocommerce_before_single_product_summary', 'ph7_wrap_product_main_open', 5);
	add_action('woocommerce_after_single_product_summary', 'ph7_wrap_product_main_close', 5);

	add_action('ph7_single_product_summary', 'woocommerce_breadcrumb', 1);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_title', 5);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_rating', 10);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_price', 15);
	add_action('ph7_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
	// add_action('ph7_single_product_summary', 'woocommerce_template_single_excerpt', 35);
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
	do_action('ph7_single_product_summary');
}

add_action('wp', 'ph7_replace_product_tabs');

function ph7_replace_product_tabs()
{
	if (!is_product()) {
		return;
	}

	// Remove as abas padrão
	remove_action(
		'woocommerce_after_single_product_summary',
		'woocommerce_output_product_data_tabs',
		10,
	);

	// Adiciona descrição + avaliações
	add_action(
		'woocommerce_after_single_product_summary',
		'ph7_output_product_description_and_reviews',
		10,
	);
}

function ph7_output_product_description_and_reviews()
{
	global $product;

	// Descrição
	if (!empty($product->get_description())): ?>
		<section class="product-description">
			<h2>Descrição</h2>
			<div class="product-description__content">
				<?php echo apply_filters('the_content', $product->get_description()); ?>
			</div>
		</section>
	<?php endif;

	// Avaliações
	if (comments_open()): ?>
		<section class="product-reviews">
			<h2>Avaliações</h2>

			<?php comments_template(); ?>
		</section>
	<?php endif;
}
