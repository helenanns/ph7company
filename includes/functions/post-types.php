<?php

function register_cpt()
{
	// Banner
	// ...existing code...

	// Book
	register_post_type('book', [
		'labels' => [
			'name' => 'Book',
			'singular_name' => 'Book',
			'add_new' => 'Adicionar novo book',
			'add_new_item' => 'Adicionar novo book',
			'edit' => 'Editar',
			'edit_item' => 'Editar book',
			'new_item' => 'Novo book',
			'view' => 'Ver',
			'view_item' => 'Ver book',
			'search_items' => 'Buscar book',
			'not_found' => 'Nenhum book encontrado',
			'not_found_in_trash' => 'Nenhum book encontrado na lixeira',
		],
		'public' => true,
		'hierarchical' => false,
		'has_archive' => true,
		'menu_icon' => 'dashicons-book',
		'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
		'can_export' => true,
	]);
}
add_action('init', 'register_cpt');
