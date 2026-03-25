<?php
function register_menus()
{
	register_nav_menus([
		'header-menu' => 'Header Menu',
		'footer-nav' => 'Footer Navegacão',
	]);
}
add_action('init', 'register_menus');
