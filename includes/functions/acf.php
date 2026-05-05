<?php

add_action('acf/init', function () {
	if (function_exists('acf_add_options_page')) {
		$contact = require __DIR__ . '/acf/contact.php';
		if (!empty($contact['options_page'])) {
			acf_add_options_page($contact['options_page']);
		}
	}

	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	$groupFiles = [__DIR__ . '/acf/hero.php'];

	foreach ($groupFiles as $file) {
		if (!file_exists($file)) {
			continue;
		}

		$group = require $file;
		if (is_array($group)) {
			acf_add_local_field_group($group);
		}
	}

	$contact = $contact ?? (require __DIR__ . '/acf/contact.php');
	if (!empty($contact['field_group']) && is_array($contact['field_group'])) {
		acf_add_local_field_group($contact['field_group']);
	}
});
