<?php
/**
 * Theme bootstrap.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LA_SUITE_CSA_VERSION', '5.1.0' );
define( 'LA_SUITE_CSA_DIR', get_template_directory() );
define( 'LA_SUITE_CSA_URI', get_template_directory_uri() );

/**
 * Outils (calculateurs) is off in 5.1.0. The template, inc/outils.php and
 * assets/js/outils.js stay in the theme.
 * To restore: set this constant to true, publish the page Outils
 * (slug outils, template Outils) and keep its item in the menu.
 */
define( 'LA_SUITE_CSA_ENABLE_OUTILS', false );

/**
 * Whether the Outils page is part of the public site.
 *
 * @return bool
 */
function la_suite_csa_outils_enabled() {
	return defined( 'LA_SUITE_CSA_ENABLE_OUTILS' ) && LA_SUITE_CSA_ENABLE_OUTILS;
}

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
require_once LA_SUITE_CSA_DIR . '/inc/upgrade.php';
