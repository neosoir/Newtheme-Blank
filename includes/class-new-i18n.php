<?php

/**
 * Define la funcionalidad de internacionalización
 *
 * Carga y define los archivos de internacionalización de este plugin para que esté listo para su traducción.
 *
 * @link       https://neoslab.online
 * @since      1.0.0
 *
 * @package    newtheme-blank
 * @subpackage newtheme-blank/includes
 */

/**
 * Ésta clase define todo lo necesario durante la activación del plugin
 *
 * @since      1.0.0
 * @package    newtheme-blank
 * @subpackage newtheme-blank/includes
 * @author     Neos Lab <contact@neoslab.online>
 */
class NEW_i18n {
    
    /**
	 * Carga el dominio de texto (textdomain) del plugin para la traducción.
	 *
     * @since    1.0.0
     * @access public static
	 */    
    public function load_plugin_textdomain() {
        
        load_plugin_textdomain(
            'newtheme-textdomain',
            false,
            NEW_PLUGIN_DIR_PATH . 'languages'
        );
        
    }
    
}