<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.0.0
 */

defined('ABSPATH') || exit();

if (!function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();
$wrapper_classes = apply_filters('woocommerce_single_product_image_gallery_classes', [
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
	'woocommerce-product-gallery--columns-' . absint($columns),
	'images',
]);
?>

<section class="l-product-gallery <?php echo esc_attr(
	implode(' ', array_map('sanitize_html_class', $wrapper_classes)),
); ?>" data-columns="<?php echo esc_attr($columns); ?>">
	<div class="swiper l-product-gallery__images JS__product-images">
		<div class="swiper-wrapper">
			<?php
/* if ( $post_thumbnail_id ) : ?>
				<div class="swiper-slide">
					<?php echo wc_get_gallery_image_html( $post_thumbnail_id, true ); ?>
				</div>
			<?php endif; */
?>

			<?php if ($attachment_ids):
   	foreach ($attachment_ids as $attachment_id): ?>
					<div class="swiper-slide">
						<?php echo wc_get_gallery_image_html($attachment_id, false); ?>
					</div>
				<?php endforeach;
   endif; ?>
		</div>
	</div>

	<div class="l-product-gallery__thumbs JS__product-thumbs">
		<div class="swiper">
			<div class="swiper-wrapper">
				<?php if ($attachment_ids):
    	foreach ($attachment_ids as $attachment_id): ?>
						<div class="swiper-slide">
							<?php echo wc_get_gallery_image_html($attachment_id, false); ?>
						</div>
					<?php endforeach;
    endif; ?>
			</div>
		</div>
	</div>
</section>
