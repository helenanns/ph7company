<?php
defined('ABSPATH') || exit();

global $product;

if (empty($product) || !$product->is_visible()) {
	return;
}

$_product = wc_get_product(get_the_ID());
$discount_percentage = null;

if ($_product->is_type('variable')) {
	$available_variations = $_product->get_available_variations();
	if (!empty($available_variations)) {
		$variation_id = $available_variations[0]['variation_id'];
		$variation = new WC_Product_Variation($variation_id);
		$regular_price = $variation->get_regular_price();
		$sale_price = $variation->get_sale_price();
		$status = $variation->get_stock_status();
	}
} else {
	$regular_price = $_product->get_regular_price();
	$sale_price = $_product->get_sale_price();
	$status = $_product->get_stock_status();
}

if ($regular_price > 0 && $sale_price > 0 && $regular_price > $sale_price) {
	$discount_percentage = (($regular_price - $sale_price) / $regular_price) * 100;
}

if (has_post_thumbnail()) {
	$thumbnail = get_post_thumbnail_id();
	$thumbnail = wp_get_attachment_image_src($thumbnail, 'medium_large');

	$thumbnail2 = $product->get_gallery_image_ids();
	if ($thumbnail2):
		$thumbnail2 = $thumbnail2[1]
			? wp_get_attachment_image_src($thumbnail2[1], 'medium_large')
			: null;
	endif;
}
?>
<article class="m-card-product<?php if ($status == 'outofstock') {
	echo ' outofstock';
} ?>">

    <a href="<?= get_the_permalink() ?>" title="<?php the_title_attribute(); ?>">

        <figure class="m-card__img" style="background-image: url('<?= esc_url($thumbnail[0]) ?>');">
            <?php if ($discount_percentage):
            	echo '<span class="m-card-product-sale">' .
            		round($discount_percentage, 2) .
            		'% OFF </span>';
            endif; ?>
            <?php if (has_post_thumbnail()): ?>
                
                <img src="<?= esc_url(
                	$thumbnail[0],
                ) ?>" alt="<?php the_title(); ?>" loading="lazy" height="280" width="286">

                <?php if ($thumbnail2): ?>
                    <img src="<?= esc_url(
                    	$thumbnail2[0],
                    ) ?>" alt="<?php the_title(); ?>" loading="lazy" height="280" width="286">
                <?php endif; ?>

            <?php endif; ?>
        </figure>

        <div class="m-card__content">

            <h3 class="m-card-product-title"><?= get_the_title() ?></h3>

            <?php if ($status == 'outofstock'): ?>
                <span class="m-card-outofstock">Esgotado</span>
            <?php else: ?>
                <?php if ($regular_price > 0 || $sale_price > 0): ?>
                    <div class="m-card__price">
                        <?php if ($regular_price < $sale_price): ?>
                            <div class="m-card__price__wrapper">
                                <span class="m-card__price-original">
                                    <?= 'R$ ' . number_format($regular_price, 2, ',', '.') ?>
                                </span>
                            </div>
                        <?php endif; ?>


                        <div class="m-card__price__wrapper">
                            <div class="m-card__price-value">

                                <?php if ($sale_price):
                                	$regular_price = number_format($regular_price, 2, ',', '.'); ?>
                                    <span class="old-price">
                                        <?php echo ' ' .
                                        	explode(',', $regular_price)[0] .
                                        	'<span>,' .
                                        	explode(',', $regular_price)[1] .
                                        	'</span>'; ?>
                                    </span>
                                <?php
                                $sale_price = number_format($sale_price, 2, ',', '.');
                                echo 'R$ ' .
                                	explode(',', $sale_price)[0] .
                                	'<span>,' .
                                	explode(',', $sale_price)[1] .
                                	'</span>';

                                elseif ($regular_price):
                                	$regular_price = number_format($regular_price, 2, ',', '.');
                                	echo 'R$ ' .
                                		explode(',', $regular_price)[0] .
                                		'<span>,' .
                                		explode(',', $regular_price)[1] .
                                		'</span>';
                                endif; ?>

                            </div>

                        </div>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

        </div>
    </a>
</article>