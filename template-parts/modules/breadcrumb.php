<?php
$post_id = @$args['post_id']; ?>

<ul class="m-breadcrumb">
    <?php
/* if (is_page()): ?>
    <li>
        <a href="<?= home_url() ?>">Homepage</a>
    </li>
    <?php endif; */
?>

    <li>
        <a href="<?= home_url() ?>">Home</a>
    </li>

    <li>
        <a href="<?= home_url() ?>">Notícias</a>
    </li>

    <li>
        <a href="<?= home_url() ?>"><?php the_title(); ?></a>
    </li>

</ul>