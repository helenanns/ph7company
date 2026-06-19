<?php
global $woocommerce;
global $theme_uri;
?>

<a href="<?php echo wc_get_cart_url(); ?>" class="m-cart" title="<?php _e(
	'View your shopping cart',
	'woothemes',
); ?>" data-tooltip="Carrinho">
    <div class="icon"><?= file_get_contents($theme_uri . '/assets/img/icons/cart.svg') ?></div>
    <?php if ($woocommerce->cart->cart_contents_count > 0): ?>
        <span class="m-cart-badge"><?= $woocommerce->cart->cart_contents_count ?></span>
    <?php endif; ?>
</a>
