<?php
add_action('admin_init', function () {
	global $pagenow;

	if ($pagenow !== 'post.php' && $pagenow !== 'post-new.php') {
		return;
	}

	$post_id = $_GET['post'] ?? ($_POST['post_ID'] ?? null);

	if (!$post_id) {
		return;
	}

	$template = get_page_template_slug($post_id);

	if ($template === 'template-homepage.php') {
		remove_post_type_support('page', 'editor');
	}
});
