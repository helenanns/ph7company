<?php
/**
 * ACF - Site Settings (Options Page + Fields)
 */

return [
	'options_page' => [
		'page_title' => 'Configurações do Site',
		'menu_title' => 'Configurações',
		'menu_slug' => 'site-settings',
		'capability' => 'edit_posts',
		'redirect' => false,
	],

	'field_group' => [
		'key' => 'group_site_settings',
		'title' => 'Informações do Site',
		'fields' => [
			[
				'key' => 'field_email',
				'label' => 'E-mail',
				'name' => 'email',
				'type' => 'email',
			],
			[
				'key' => 'field_endereco',
				'label' => 'Endereço',
				'name' => 'endereco',
				'type' => 'textarea',
				'rows' => 3,
			],
			[
				'key' => 'field_facebook',
				'label' => 'Facebook',
				'name' => 'facebook',
				'type' => 'url',
			],
			[
				'key' => 'field_instagram',
				'label' => 'Instagram',
				'name' => 'instagram',
				'type' => 'url',
			],
			[
				'key' => 'field_whatsapp',
				'label' => 'WhatsApp',
				'name' => 'whatsapp',
				'type' => 'text',
				'instructions' => 'Ex: +55 11 99999-9999',
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'site-settings',
				],
			],
		],
	],
];
