<?php

/**
 * La funcionalidad específica de administración del plugin.
 *
 * @link       https://neoslab.online
 * @since      1.0.0
 *
 * @package    newtheme-blank
 * @subpackage newtheme-blank/admin
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
class NEW_Admin {
    
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
	 * Crear un nuevo menú en la administracion.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $build_menupage crea un nuevo menu.
	 */
    private $build_menupage;
    
    /**
     * @param string $plugin_name nombre o identificador único de éste plugin.
     * @param string $version La versión actual del plugin.
     */
    public function __construct( $plugin_name, $version ) {
        
        $this->plugin_name      = $plugin_name;
        $this->version          = $version;  
        $this->build_menupage   = new NEW_Build_Menupage;   
        
    }
    
    /**
	 * Registra los archivos de hojas de estilos del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function enqueue_styles( $hook ) {

        if ( $hook != 'toplevel_page_new_data' ) 
            return;
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en NEW_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El NEW_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
		wp_enqueue_style( $this->plugin_name, NEW_PLUGIN_DIR_URL . 'admin/css/new-admin.css', array(), $this->version, 'all' );

        /**
         *  Framework Materialize.
         *  https://materializecss.com/getting-started.html
		 */
		wp_enqueue_style( 'new_materiaize_icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), $this->version, 'all' );

        /**
         *  Framework Materialize.
         *  https://materializecss.com/icons.html
		 */
		wp_enqueue_style( 'new_materiaize_css', NEW_PLUGIN_DIR_URL . 'helpers/materialize/css/materialize.min.css', array(), $this->version, 'all' );
        
    }
    
    /**
	 * Registra los archivos Javascript del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function enqueue_scripts( $hook ) {

        if ( $hook != 'toplevel_page_new_data' ) 
            return;
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en NEW_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El NEW_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
        wp_enqueue_script( $this->plugin_name, NEW_PLUGIN_DIR_URL . 'admin/js/new-admin.js', ['jquery'], $this->version, true );

        /**
         * Libreria sweetalert2
         * https://sweetalert.js.org/guides/
		 */
        wp_enqueue_script( 'new_sweetalert', NEW_PLUGIN_DIR_URL . 'helpers/sweetalert2/sweetalert2.min.js', ['jquery'], $this->version, true );

        /**
         *  Framework Materialize.
         *  https://materializecss.com/getting-started.html
		 */
        wp_enqueue_script( 'new_materiaize_js', NEW_PLUGIN_DIR_URL . 'helpers/materialize/js/materialize.min.js', ['jquery'], $this->version, true );
        
    }

    /**
	 * Registra los menús del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function add_menus() {

        $this->build_menupage->add_menu_page(
            __('Newtheme Datos', 'newtheme-textdomain'),
            __('Newtheme Datos', 'newtheme-textdomain'),
            'manage_options',
            'new_data',
            [ $this, 'controlador_display_menu' ],
            'dashicons-id-alt',
            22
        );

        $this->build_menupage->run();

    }

    /**
	 * Creamos rutas hacia otros archivos
	 * Crearemos dos archivos en la carpeta partials
	 * @since    1.0.0
     * @access   public
	 */
    public function controlador_display_menu() {

        if ( 
            ( $_GET['page'] == 'new_data' ) &&
            ( $_GET['accion'] == 'edit' ) &&
            ( isset( $_GET['id'] ) )
        ) 
            require_once NEW_PLUGIN_DIR_PATH . 'admin/partials/new-admin-display-edit.php';
        
        else 
            require_once NEW_PLUGIN_DIR_PATH . 'admin/partials/new-admin-display.php';
        

        

    }
    
}







