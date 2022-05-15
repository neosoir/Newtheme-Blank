<?php

/**
 * Se activa en la desactivación del plugin
 *
 * @link       http://misitioweb.com
 * @since      1.0.0
 *
 * @package    newtheme-blank
 * @subpackage newtheme-blank/includes
 */

/**
 * Ésta clase define todo lo necesario durante la desactivación del plugin
 *
 * @since      1.0.0
 * @package    newtheme-blank
 * @subpackage newtheme-blank/includes
 * @author     Jhon J.R <email@example.com>
 */

class NEW_Deactivator {

	/**
	 * Método estático
	 *
	 * Método que se ejecuta al desactivar el plugin
	 *
	 * @since 1.0.0
     * @access public static
	 */
	public static function deactivate() {
        
        flush_rewrite_rules();
        
	}

}