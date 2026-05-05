<?php

add_action('wp_head', 'head_content');
function head_content()
{
	global $theme_uri; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php wp_title('-', true, 'right'); ?>
        PH7 Company
    </title>

    <!-- Assets preload -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Manrope:wght@200..800&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $theme_uri; ?>/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $theme_uri; ?>/assets/img/favicon/favicon-16x16.png">

    <?php if (is_single()) {
    	$description = get_the_excerpt();
    } else {
    	$description = get_bloginfo('description');
    } ?>
    <meta property="og:description" content="<?= $description ?>" />
    <meta name="description" content="<?= $description ?>" />

    <link rel='canonical' href='<?php echo 'http://' .
    	$_SERVER['HTTP_HOST'] .
    	$_SERVER['REQUEST_URI']; ?>' />

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#000">


<?php
}

?>
