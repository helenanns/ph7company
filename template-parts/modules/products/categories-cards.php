<?php
// Lista as categorias de produtos em cards
if (!function_exists('ph7company_product_categories_cards')) {
	function ph7company_product_categories_cards($args = [])
	{
		$defaults = [
			'taxonomy' => 'product_cat',
			'hide_empty' => true,
			'number' => 8,
		];
		$args = wp_parse_args($args, $defaults);
		$terms = get_terms($args);
		if (empty($terms) || is_wp_error($terms)) {
			echo '<p>Nenhuma categoria encontrada.</p>';
			return;
		}
		echo '<section class="ph7-categories-cards"><div class="container">';
		foreach ($terms as $term) {

			// Pega a imagem da categoria (WooCommerce)
			$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
			$image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';
			$category_link = get_term_link($term);
			?>
            <a href="<?php echo esc_url(
            	$category_link,
            ); ?>" class="ph7-category-card" style="<?php if ($image_url) {
	echo 'background-image:url(' . esc_url($image_url) . ');';
} ?>">
                <span class="ph7-category-card__name"><?php echo esc_html($term->name); ?></span>
                <span class="ph7-category-card__arrow" aria-hidden="true">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="16" cy="16" r="16" fill="rgba(0,0,0,0.5)"/>
                        <path d="M13 20L19 16L13 12" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
            <?php
		}
		echo '</div></section>';
	}
}
ph7company_product_categories_cards();
