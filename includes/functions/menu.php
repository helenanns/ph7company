<?php
function register_menus()
{
	register_nav_menus([
		'header-menu' => 'Header Menu',
		'footer' => 'Footer',
		'footer-nav' => 'Footer Navegacão',
	]);
}
add_action('init', 'register_menus');
