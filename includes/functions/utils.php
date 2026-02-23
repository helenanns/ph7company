<?php

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}
add_filter('show_admin_bar', 'remove_admin_bar');


function custom_excerpt_length($excerpt) {
    $limit = 130; // Defina o limite de caracteres que você deseja
    if (strlen($excerpt) > $limit) {
        $excerpt = substr($excerpt, 0, $limit) . '(...)';
    }
    return $excerpt;
}

add_filter('the_excerpt', 'custom_excerpt_length');

