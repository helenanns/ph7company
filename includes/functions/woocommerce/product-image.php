<?php

add_action('init', function () {
	remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
});

add_action('woocommerce_before_single_product_summary', 'ph7_output_custom_product_gallery', 20);

function ph7_output_custom_product_gallery()
{
	global $product;
	if (!$product) {
		return;
	}

	$image_ids = array_filter(
		array_merge([$product->get_image_id()], $product->get_gallery_image_ids()),
	);
	?>

	<section class="l-product-gallery">
		<?php if (!empty($image_ids)): ?>

			<div class="swiper l-product-gallery__images JS__product-images">
				<div class="swiper-wrapper">
					<?php foreach ($image_ids as $id):

     	$full = wp_get_attachment_image_url($id, 'full');
     	$thumb = wp_get_attachment_image_url($id, 'woocommerce_single');
     	?>
                    <div class="swiper-slide" data-large="<?php echo esc_url($full); ?>">
                        <img src="<?php echo esc_url($thumb); ?>" alt="" />
                    </div>
                	<?php
     endforeach; ?>
				</div>
			</div>

			<div class="l-product-gallery__thumbs">
                <button class="swiper-button-prev JS__product-thumbs-prev" type="button" aria-label="Anterior"></button>

                <div class="swiper JS__product-thumbs">
                    <div class="swiper-wrapper">
                        <?php foreach ($image_ids as $id): ?>
                            <div class="swiper-slide">
                                <?php echo wp_get_attachment_image(
                                	$id,
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

add_filter(
	'woocommerce_available_variation',
	function ($data, $product, $variation) {
		$gallery_urls = [];

		if (!empty($data['image']['url'])) {
			$gallery_urls[] = [
				'full' => $data['image']['full_src'] ?? $data['image']['url'],
				'thumb' => $data['image']['url'],
				'mini' => $data['image']['gallery_thumbnail_src'] ?? $data['image']['url'],
			];
		}

		$gallery_ids = $variation->get_gallery_image_ids();
		if (!empty($gallery_ids)) {
			foreach ($gallery_ids as $id) {
				$full = wp_get_attachment_image_url($id, 'full');
				if ($full) {
					$already_added = !empty($gallery_urls) && isset($gallery_urls[0]['full']) && $gallery_urls[0]['full'] === $full;
					if ($already_added) {
						continue;
					}

					$gallery_urls[] = [
						'full' => $full,
						'thumb' => wp_get_attachment_image_url($id, 'woocommerce_single') ?: $full,
						'mini' => wp_get_attachment_image_url($id, 'woocommerce_gallery_thumbnail') ?: $full,
					];
				}
			}
		}

		$data['custom_gallery'] = $gallery_urls;
		return $data;
	},
	10,
	3,
);
