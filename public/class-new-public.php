<?php

/**
 * La funcionalidad específica de administración del plugin.
 *
 * @link       https://neoslab.online
 * @since      1.0.0
 *
 * @package    plugin_name
 * @subpackage plugin_name/admin
 */

/**
 * Define el nombre del plugin, la versión y dos métodos para
 * Encolar la hoja de estilos específica de administración y JavaScript.
 * 
 * @since      1.0.0
 * @package    newtheme-blank
 * @subpackage newtheme-blank/admin
 * @author     Neos Lab <contact@neoslab.online>
 * 
 * @property string $plugin_name
 * @property string $version
 */
class NEW_Public {
    
    /**
	 * El identificador único de éste plugin
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name  El nombre o identificador único de éste plugin
	 */
    private $plugin_name;
    
    /**
	 * Versión actual del plugin
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version  La versión actual del plugin
	 */
    private $version;
    
    /**
     * @param string $plugin_name nombre o identificador único de éste plugin.
     * @param string $version La versión actual del plugin.
     */
    public function __construct( $plugin_name, $version ) {
        
        $this->plugin_name  = $plugin_name;
        $this->version      = $version;     
        
    }
    
    /**
	 * Registra los archivos de hojas de estilos del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function enqueue_styles() {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en NEW_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El NEW_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
		wp_enqueue_style( $this->plugin_name, NEW_PLUGIN_DIR_URL . 'public/css/new-public.css', array(), $this->version, 'all' );
        
    }
    
    /**
	 * Registra los archivos Javascript del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function enqueue_scripts() {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en NEW_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El NEW_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
        wp_enqueue_script( $this->plugin_name, NEW_PLUGIN_DIR_URL . 'public/js/new-public.js', array( 'jquery' ), $this->version, true );
        
    }
    
}







