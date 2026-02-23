<?php
//Remove Woocommerce CSS
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


function custom_single_add_to_cart_text( $text, $product ) {
    $text = __( 'Adicionar ao carrinho', 'ph7-textdomain' );
    return $text;
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_single_add_to_cart_text', 10, 2 );


add_filter('woocommerce_breadcrumb_defaults', function ($defaults) {

    $defaults['wrap_last'] = '<span>%s</span>';

    return $defaults;
});



add_filter( 'woocommerce_account_menu_items', 'remover_menu_downloads_minha_conta', 999 );
function remover_menu_downloads_minha_conta( $items ) {
    unset( $items['downloads'] );
    return $items;
}