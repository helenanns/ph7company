<?php
defined('ABSPATH') || exit();

global $product;

if (empty($product) || !$product->is_visible()) {
	return;
}

$is_carousel = $args['is_carousel'] ?? null;
$_product = wc_get_product(get_the_ID());

if ($_product->is_type('variable')) {
	$variations = $_product->get_available_variations();
	if (!empty($variations)) {
		$variation = new WC_Product_Variation($variations[0]['variation_id']);
		$regular_price = (float) $variation->get_regular_price();
		$sale_price = (float) $variation->get_sale_price();
		$stock_status = $variation->get_stock_status();
	}
} else {
	$regular_price = (float) $_product->get_regular_price();
	$sale_price = (float) $_product->get_sale_price();
	$stock_status = $_product->get_stock_status();
}

$is_outofstock = ($stock_status ?? '') === 'outofstock';
$has_price = $regular_price > 0 || $sale_price > 0;
$on_sale = $regular_price > 0 && $sale_price > 0 && $regular_price > $sale_price;

$discount_percentage = $on_sale
	? round((($regular_price - $sale_price) / $regular_price) * 100, 2)
	: null;

$thumbnail = null;
$thumbnail_alt = null;

if (has_post_thumbnail()) {
	$thumb_id = get_post_thumbnail_id();
	$thumbnail = wp_get_attachment_image_src($thumb_id, 'medium_large');

	$gallery_ids = $product->get_gallery_image_ids();
	$thumbnail_alt = !empty($gallery_ids[1])
		? wp_get_attachment_image_src($gallery_ids[1], 'medium_large')
		: (!empty($gallery_ids[0])
			? wp_get_attachment_image_src($gallery_ids[0], 'medium_large')
			: null);
}
?>

<article class="m-card-product<?= $is_outofstock ? ' outofstock' : '' ?>">

    <a href="<?= get_the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		
		<?php if ($discount_percentage): ?>
			<span class="m-card-product-sale">
				<?= $discount_percentage ?>% OFF
			</span>
		<?php endif; ?>

        <?php if ($thumbnail): ?>
            <figure class="m-card__img">
                <img
                    src="<?= esc_url($thumbnail[0]) ?>"
                    alt="<?php the_title_attribute(); ?>"
                    loading="lazy"
                >

                <?php if ($thumbnail_alt): ?>
                    <img
                        class="m-card__img-hover"
                       src="<?= esc_url($thumbnail_alt[0]) ?>"
                        alt="<?php the_title_attribute(); ?>"
                    >
                <?php endif; ?>

                <?php if ($is_carousel): ?>
                    <div class="swiper-lazy-preloader"></div>
                <?php endif; ?>

            </figure>
        <?php endif; ?>

        <div class="m-card__content">

            <h3 class="m-card-product-title">
                <?= get_the_title() ?>
            </h3>

            <?php if ($is_outofstock): ?>
                <span class="m-card-outofstock">Esgotado</span>
            <?php else: ?>

                <?php if ($has_price): ?>
                    <div class="m-card__price">

                        <?php if ($on_sale): ?>
                            <span class="m-card__price-original">
                                <?= wc_price($regular_price) ?>
                            </span>
                        <?php endif; ?>

                        <span class="m-card__price-value">
                            <?= wc_price($sale_price ?: $regular_price) ?>
                        </span>

                    </div>
                <?php endif; ?>

            <?php endif; ?>

        </div>
    </a>
</article>