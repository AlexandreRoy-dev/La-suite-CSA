<?php
/**
 * Theme bootstrap.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LA_SUITE_CSA_VERSION', '4.5.0' );
define( 'LA_SUITE_CSA_DIR', get_template_directory() );
define( 'LA_SUITE_CSA_URI', get_template_directory_uri() );

require_once LA_SUITE_CSA_DIR . '/inc/setup.php';
require_once LA_SUITE_CSA_DIR . '/inc/enqueue.php';
require_once LA_SUITE_CSA_DIR . '/inc/template-tags.php';
require_once LA_SUITE_CSA_DIR . '/inc/copy-defaults.php';
require_once LA_SUITE_CSA_DIR . '/inc/media.php';
require_once LA_SUITE_CSA_DIR . '/inc/ressources.php';
require_once LA_SUITE_CSA_DIR . '/inc/outils.php';
require_once LA_SUITE_CSA_DIR . '/inc/services.php';
require_once LA_SUITE_CSA_DIR . '/inc/acf.php';
require_once LA_SUITE_CSA_DIR . '/inc/contact.php';
