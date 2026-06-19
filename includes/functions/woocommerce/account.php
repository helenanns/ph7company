<?php
add_filter('woocommerce_account_menu_items', function ($items) {
	if (isset($items['dashboard'])) {
		$items['dashboard'] = 'Conta';
		$items['edit-account'] = 'Dados';
	}
	unset($items['downloads']);
	return $items;
});

function custom_translate_current_password_label($translated, $untranslated, $domain)
{
	if ('woocommerce' === $domain) {
		switch ($translated) {
			case 'Current password (leave blank to leave unchanged)':
				$translated = __('Sua nova frase aqui', 'woocommerce');
				break;
		}
	}
	return $translated;
}
add_filter('gettext', 'custom_translate_current_password_label', 10, 3);
