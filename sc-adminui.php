<?php
/**
 *  WNEO - SC ADMINUI 0.0.5
 *
 * Plugin Name: WNEO - SC ADMINUI 0.0.5
 * Description: SC ADMIN UI
 * Version: 0.0.5
 *
 * @wordpress-plugin
 * @package     WebsiteNEO\SCEC
 * @author      WebsiteNEO, Inc.
 *
 */
define('SCADMIN_VERSION', '0.0.5');
define('SCADMIN_DEBUG', 6);
define('SCADMIN_LOG', __DIR__ . '/scadmin_ajax_log.txt');
define('SCADMIN_ADMIN_LOG', __DIR__ . '/scadmin_admin_log.txt');
define('SCADMIN_DIR', __DIR__);

// define( 'SCADMIN_ASSETS_URL', plugins_url( 'assets/', __FILE__ ) );
// define( 'SCADMIN_LOGOS_URL', plugins_url( 'assets/img/logos/', __FILE__ ) );

require_once 'vendor/autoload.php';
require_once 'src/common/scadmin-utils.php';
require_once 'src/common/class-scadmin-ajax.php';
require_once 'src/admin/class-admin-settings.php';
// require_once 'src/common/intial_setup.php';

/**
 * acadmin_activation
 *
 * function used on activation of plugin
 *
 **/
function scadmin_activation()
{
}
register_activation_hook(__FILE__, __NAMESPACE__ . '\scadmin_activation');

/**
 * scadmin_deactivation
 *
 * function used on deactivation of plugin
 *
 **/
function scadmin_deactivation()
{
}
register_deactivation_hook(__FILE__, __NAMESPACE__ . '\scadmin_deactivation');










function lateLoader()
{
    //write_log('late loader, entered');

    if (is_admin()) {
        //write_log('late loader, admin entered');
        \WebsiteNEO\SelectConnect\SCADMIN\Settings\Admin_Settings::setup();
    } elseif (!is_admin()) {
        //write_log('late loader, non admin entered');
    } else {
    }
}
add_action('plugins_loaded', __NAMESPACE__ . '\lateLoader');