<?php

if (function_exists('add_theme_support')) {
	// Add Menu Support
	add_theme_support('menus');

	// Add Thumbnail Theme Support
	add_theme_support('post-thumbnails');

	// Image Sizes
	// add_image_size('post-cover', 1334, '', false); // Extra Large Thumbnail
	// add_image_size('800', 800, '', true); // Large Thumbnail
	// add_image_size('300', 300, '', true); // Medium Thumbnail
	// add_image_size('180', 180, '', true); // Small Thumbnail
}
