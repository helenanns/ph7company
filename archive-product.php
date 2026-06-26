<?php
defined('ABSPATH') || exit();

get_header('shop');
?>

<main class="l-archive-product">
<div class="container loja">


    <?php if (woocommerce_product_loop()): ?>

        <div class="m-products">

            <?php
            woocommerce_product_loop_start();

            if (wc_get_loop_prop('total')) {
            	while (have_posts()) {

            		the_post();

            		$_product = wc_get_product(get_the_ID());

            		if ($_product && $_product->is_type('variable')) {
            			$variations = $_product->get_available_variations();
            			$grouped_variations = [];

            			if (!empty($variations)) {
            				foreach ($variations as $variation_data) {
            					$group_key = $variation_data['attributes']['attribute_pa_cor'] ?? '';

            					if (empty($group_key)) {
            						$group_key =
            							reset($variation_data['attributes']) ?:
            							'variation_' . $variation_data['variation_id'];
            					}

            					if (!isset($grouped_variations[$group_key])) {
            						$grouped_variations[$group_key] = $variation_data;
            					}
            				}
            			}

            			if (!empty($grouped_variations)) {
            				foreach ($grouped_variations as $variation_data) {
            					$variation = new WC_Product_Variation($variation_data['variation_id']); ?>

                                <li>
                                    <?php get_template_part(
                                    	'/template-parts/modules/products/product-card',
                                    	'product',
                                    	[
                                    		'product' => $_product,
                                    		'product_id' => get_the_ID(),
                                    		'variation' => $variation,
                                    		'variation_data' => $variation_data,
                                    	],
                                    ); ?>
                                </li>

                                <?php
            				}

            				continue;
            			}
            		}

            		global $product;
            		?>

                    <li>
                        <?php get_template_part(
                        	'/template-parts/modules/products/product-card',
                        	'product',
                        	[
                        		'product' => $product,
                        		'product_id' => get_the_ID(),
                        	],
                        ); ?>
                    </li>
            <?php
            	}
            }

            woocommerce_product_loop_end();
            ?>

        </div>

        <?php do_action('woocommerce_after_shop_loop');endif; ?>


    <?php do_action('woocommerce_after_main_content'); ?>
</div>

<?php get_footer('shop');
