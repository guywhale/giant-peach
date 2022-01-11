<?php

/**
 * Light Theme ⚡
 */

use Light\{Wordpress, Plugin};

require_once 'main/attributes.php';
require_once 'main/autoload.php';
require_once 'main/paths.php';
require_once 'main/render.php';
require_once 'main/image.php';
require_once 'main/svg.php';
require_once 'main/version.php';

//* Config file
require_once 'config.php';

//* Init all classes
Wordpress\Admin::init();
Wordpress\Assets::init();
Wordpress\Cleanup::init();
new Wordpress\Components();
Wordpress\Escaping::init();
Wordpress\Gutenberg::init();
Wordpress\Images::init();
Wordpress\Lazyload::init();
Wordpress\Menus::init();
Wordpress\ServiceWorker::init();
Wordpress\Settings::init();
Wordpress\Sidebars::init();
Wordpress\Updates::init();
Wordpress\UploadMimes::init();
Wordpress\EditHomepage::init();
Wordpress\Emails::init();
Wordpress\Plugins::init();
Wordpress\AJAX::init();
Plugin\ACF::init();
Plugin\YoastSEO::init();
