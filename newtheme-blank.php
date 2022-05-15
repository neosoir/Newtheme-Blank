<?php
/**
 * Archivo del plugin 
 * Este archivo es leído por WordPress para generar la información del plugin
 * en el área de administración del complemento. Este archivo también incluye 
 * todas las dependencias utilizadas por el complemento, registra las funciones 
 * de activación y desactivación y define una función que inicia el complemento.
 *
 * @link                https://neoslab.online
 * @since               1.0.0
 * @package             newtheme blank
 *
 * @wordpress-plugin
 * Plugin Name:         newtheme blank
 * Plugin URI:          http://miprimerplugin.com
 * Description:         Descripción corta de nuestro plugin
 * Version:             1.0.0
 * Author:              Neos Lab
 * Author URI:          http://miurlpersonal.com
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
function activate_newtheme_blank() {
    require_once NEW_PLUGIN_DIR_PATH . 'includes/class-new-activator.php';
	NEW_Activator::activate();
}

/**
 * Código que se ejecuta en la desactivación del plugin
 */
function deactivate_newtheme_blank() {
    require_once NEW_PLUGIN_DIR_PATH . 'includes/class-new-deactivator.php';
	NEW_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_newtheme_blank' );
register_deactivation_hook( __FILE__, 'deactivate_newtheme_blank' );

require_once NEW_PLUGIN_DIR_PATH . 'includes/class-new-master.php';

function run_new_master() {
    $new_master = new NEW_Master;
    $new_master->run();
}

run_new_master();
























