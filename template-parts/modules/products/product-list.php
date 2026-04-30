<?php
$block = $args['fields'] ?? null;

if (!$block) {
	return;
}

$is_carousel = ($block['layout'] ?? '') === 'carousel';
$theme = $block['tema'] ?? 'light';
$title = $block['title'] ?? '';
$type = $block['products'] ?? '';
$link = $block['link'] ?? null;

// 🔥 resolve os produtos dinamicamente
$products = [];

if ($type === 'select') {
	$products = $block['products-select'] ?? [];
}

if ($type === 'category') {
	$categories = $block['category'] ?? [];

	if ($categories) {
		$products = get_posts([
			'post_type' => 'product',
			'posts_per_page' => -1,
			'tax_query' => [
				[
					'taxonomy' => 'product_cat',
					'field' => 'term_id',
					'terms' => $categories,
				],
			],
		]);
	}
}
?>

<section class="m-products --<?= esc_attr($theme) ?> JS__products-slider">

    <?php if ($title): ?>
        <div class="m-products-header">
            <div class="container">
                <h2><?= esc_html($title) ?></h2>

                <?php if ($link): ?>
                    <a href="<?= esc_url($link['url']) ?>"
                       class="m-button m-products-link">
                        <?= esc_html($link['title']) ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="container">
        <ul class="<?= $is_carousel ? 'swiper' : 'm-products-list' ?>">

            <?php if ($is_carousel): ?>
                <div class="swiper-wrapper">
            <?php endif; ?>

            <?php foreach ($products as $post):
            	setup_postdata($post); ?>
                <li <?= $is_carousel ? 'class="swiper-slide"' : '' ?>>
                    <?php get_template_part(
                    	'/template-parts/modules/products/product-card',
                    	'product',
                    	['is_carousel' => $is_carousel],
                    ); ?>
                </li>
            <?php
            endforeach; ?>

            <?php if ($is_carousel): ?>
                </div>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </ul>

        <?php if ($is_carousel): ?>
            <button class="swiper-button-prev"></button>
            <button class="swiper-button-next"></button>
        <?php endif; ?>
    </div>
</section>