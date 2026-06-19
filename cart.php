<?php
/**
 * Template Name: Custom Cart
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php // Exibe o conteúdo da página do carrinho
        if (class_exists('WooCommerce')) {
        	wc_get_template_part('cart/cart');
        } else {
        	echo '<p>' . __('WooCommerce não está ativado.', 'textdomain') . '</p>';
        } ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
