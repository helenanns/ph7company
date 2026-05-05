<?php
function register_menus()
{
	register_nav_menus([
		'header-menu' => 'Header Menu',
		'footer-nav' => 'Footer Navegacão',
		'footer-account' => 'Footer Minha Conta',
		'footer-support' => 'Footer Atendimento',
	]);
}
add_action('init', 'register_menus');
