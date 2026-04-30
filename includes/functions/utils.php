<?php

// Remove Admin bar
function remove_admin_bar()
{
	return false;
}
add_filter('show_admin_bar', 'remove_admin_bar');

function custom_excerpt_length($excerpt)
{
	$limit = 130;
	if (strlen($excerpt) > $limit) {
		$excerpt = substr($excerpt, 0, $limit) . '(...)';
	}
	return $excerpt;
}

add_filter('the_excerpt', 'custom_excerpt_length');

// ─── Helper: formata preço BR ─────────────────────────────────────────────────

/**
 * Retorna o preço formatado em HTML com os centavos em <span>.
 * Ex.: R$ 129<span>,90</span>
 *
 * @param float  $price
 * @param bool   $show_prefix Exibe "R$ " antes do valor.
 */
if (!function_exists('format_price_html')):
	function format_price_html(float $price, bool $show_prefix = true): string
	{
		$formatted = number_format($price, 2, ',', '.');
		[$integer, $cents] = explode(',', $formatted);

		$prefix = $show_prefix ? 'R$ ' : '';

		return $prefix . $integer . '<span>,' . $cents . '</span>';
	}
endif;
