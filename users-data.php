<?php
/**
 *
 * @link                https://neoslab.online
 * @since               1.0.0
 * @package             users_data
 *
 * @wordpress-plugin
 * Plugin Name:         Users data
 * Plugin URI:          https://neoslab.online
 * Description:         Create user data tables in admin and display user info by shortcodes in fronted.
 * Version:             1.0.0
 * Author:              Neos Lab
 * Author URI:          https://neoslab.online
 * License:             GPL2
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         newtheme-textdomain
 * Domain Path:         /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
global $wpdb;
define( 'NEW_REALPATH_BASENAME_PLUGIN', dirname( plugin_basename( __FILE__ ) ) . '/' );
define( 'NEW_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'NEW_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'NEW_TABLE', "{$wpdb->prefix}newtheme_data" );

/**
 * Código que se ejecuta en la activación del plugin
 */
function activate_users_data() {
    require_once NEW_PLUGIN_DIR_PATH . 'includes/class-new-activator.php';
	NEW_Activator::activate();
}

/**
 * Código que se ejecuta en la desactivación del plugin
 */
function deactivate_users_data() {
    require_once NEW_PLUGIN_DIR_PATH . 'includes/class-new-deactivator.php';
	NEW_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_users_data' );
register_deactivation_hook( __FILE__, 'deactivate_users_data' );

require_once NEW_PLUGIN_DIR_PATH . 'includes/class-new-master.php';

function run_new_master() {
    $new_master = new NEW_Master;
    $new_master->run();
}

run_new_master();
























