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
