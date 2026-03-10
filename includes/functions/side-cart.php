<?php
// Side Cart Functions
// This file handles the HTML structure and AJAX functions of the Side Cart.

/**
 * Render Side Cart Offcanvas HTML
 */
function ph7_side_cart_html() {
	if ( is_cart() || is_checkout() ) {
		return; // Não mostrar no carrinho ou checkout
	}
	?>
	<div id="ph7-side-cart" class="ph7-side-cart">
		<div class="ph7-side-cart-overlay"></div>
		<div class="ph7-side-cart-panel">
			<div class="ph7-side-cart-header">
				<h3 class="ph7-side-cart-title"><?php esc_html_e( 'Seu Carrinho', 'ph7company' ); ?></h3>
				<button type="button" class="ph7-side-cart-close" aria-label="<?php esc_attr_e( 'Fechar', 'ph7company' ); ?>">
					&times;
				</button>
			</div>
			
			<div class="ph7-side-cart-content">
				<!-- WooCommerce Fragments will inject content here -->
                <div class="widget_shopping_cart_content">
				    <?php woocommerce_mini_cart(); ?>
                </div>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'wp_footer', 'ph7_side_cart_html' );


/**
 * Enqueue localized parameters for Side Cart
 */
function ph7_side_cart_scripts() {
	if ( is_cart() || is_checkout() ) {
		return;
	}
    // Note: The main JS file is enqueued through Vite. 
    // We just inject the variables needed for AJAX inline.
	wp_enqueue_script( 'jquery' ); // WooCommerce relies heavily on jQuery for cart fragments
	
	wp_add_inline_script( 'jquery', '
		var ph7_ajax = ' . wp_json_encode( array(
			'store_api_nonce' => wp_create_nonce( 'wc_store_api' ),
			'store_api_url'   => esc_url_raw( rest_url( 'wc/store/v1/cart' ) ),
			'refresh_url'     => esc_url_raw( add_query_arg( 'wc-ajax', 'get_refreshed_fragments', home_url( '/' ) ) ),
			'is_cart'         => is_cart(),
            'is_checkout'     => is_checkout()
		) ) . ';
	', 'before' );
}
add_action( 'wp_enqueue_scripts', 'ph7_side_cart_scripts', 100 );

/**
 * Atualizar quantidade no ícone do carrinho no cabeçalho
 */
function ph7_add_to_cart_fragment_count( $fragments ) {
	ob_start();
	?>
	<span class="m-cart-badge"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	<?php
	$fragments['span.m-cart-badge'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ph7_add_to_cart_fragment_count' );
