<?php
global $woocommerce;
global $theme_uri;
?>

<a href="<?php echo wc_get_cart_url(); ?>" class="m-cart js-toggle-side-cart" title="<?php _e(
	'View your shopping cart',
	'woothemes',
); ?>">
    <?= file_get_contents($theme_uri . '/assets/img/icons/cart.svg') ?>
    <span class="m-cart-badge"><?= $woocommerce->cart->cart_contents_count ?></span>
</a>
