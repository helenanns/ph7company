<?php

add_action('init', 'ph7_setup_single_product_gallery_hooks');

function ph7_setup_single_product_gallery_hooks()
{
	remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
	remove_action(
		'woocommerce_before_single_product_summary',
		'ph7_output_custom_product_gallery',
		20,
	);
	add_action('woocommerce_before_single_product_summary', 'ph7_output_custom_product_gallery', 20);
}

function ph7_output_custom_product_gallery()
{
	if (!is_product()) {
		return;
	}

	if (!function_exists('wc_get_gallery_image_html')) {
		return;
	}

	global $product;

	if (!$product || !is_a($product, 'WC_Product')) {
		return;
	}

	$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
	$post_thumbnail_id = $product->get_image_id();
	$attachment_ids = $product->get_gallery_image_ids();

	$image_ids = [];

	if ($post_thumbnail_id) {
		$image_ids[] = $post_thumbnail_id;
	}

	if (!empty($attachment_ids)) {
		$image_ids = array_merge($image_ids, $attachment_ids);
	}

	$image_ids = array_values(array_unique(array_filter($image_ids)));

	$wrapper_classes = apply_filters('woocommerce_single_product_image_gallery_classes', [
		'l-product-gallery',
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
		'woocommerce-product-gallery--columns-' . absint($columns),
		'images',
	]);
	?>

	<section class="<?php echo esc_attr(
 	implode(' ', array_map('sanitize_html_class', $wrapper_classes)),
 ); ?>" data-columns="<?php echo esc_attr($columns); ?>">
		<?php if (!empty($image_ids)): ?>

			<?php
  	/* echo do_shortcode('[yith_wcwl_add_to_wishlist]'); */
  	?>
			<div class="swiper l-product-gallery__images JS__product-images">
				<div class="swiper-wrapper">
					<?php foreach ($image_ids as $attachment_id): ?>
						<div class="swiper-slide">
							<?php echo wp_get_attachment_image($attachment_id, 'woocommerce_single', false, [
       	'class' => 'l-product-gallery__image',
       ]); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="l-product-gallery__thumbs">
                <button class="swiper-button-prev JS__product-thumbs-prev" type="button" aria-label="Anterior"></button>

                <div class="swiper JS__product-thumbs">
                    <div class="swiper-wrapper">
                        <?php foreach ($image_ids as $attachment_id): ?>
                            <div class="swiper-slide">
                                <?php echo wp_get_attachment_image(
                                	$attachment_id,
                                	'woocommerce_gallery_thumbnail',
                                ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button class="swiper-button-next JS__product-thumbs-next" type="button" aria-label="Próximo"></button>
            </div>

		<?php else: ?>

			<div class="woocommerce-product-gallery__image--placeholder">
				<?php echo wc_placeholder_img('woocommerce_single'); ?>
			</div>

		<?php endif; ?>
	</section>

	<?php
}

add_action('after_setup_theme', 'ph7_add_woocommerce_theme_support');
function ph7_add_woocommerce_theme_support()
{
	add_theme_support('woocommerce');

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
