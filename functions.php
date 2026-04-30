<?php
global $theme_uri;
$theme_uri = get_template_directory_uri();

include 'includes/functions/acf.php';

include 'includes/functions/set-head-content.php';

include 'includes/functions/post-types.php';

include 'includes/functions/image-size.php';

include 'includes/functions/scripts.php';

include 'includes/functions/query.php';

include 'includes/functions/utils.php';

include 'includes/functions/menu.php';

include 'includes/functions/woocommerce.php';

include 'includes/functions/admin.php';
