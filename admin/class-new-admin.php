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
	 * Habilitar los metodos de consulta de wordpress
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $db variable global base de datos.
	 */
    private $db;

    /**
	 * Obtener la clase NEW_CRUD_JSON
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $crud_json instancia del objeto NEW_CRUD_JSON.
	 */
    private $crud_json;
    
    /**
     * @param string $plugin_name nombre o identificador único de éste plugin.
     * @param string $version La versión actual del plugin.
     */
    public function __construct( $plugin_name, $version ) {
        
        global $wpdb;
        $this->db = $wpdb;
        $this->crud_json = new NEW_CRUD_JSON;
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
         * Gesto multimedia de wordpress
         */
        
        wp_enqueue_media();

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
        wp_enqueue_script( 'new_sweetalert', NEW_PLUGIN_DIR_URL . 'helpers/sweetalert2/sweetalert.min.js', ['jquery'], $this->version, true );
                                                                        
        /**
         *  Framework Materialize.
         *  https://materializecss.com/getting-started.html
		 */
        wp_enqueue_script( 'new_materiaize_js', NEW_PLUGIN_DIR_URL . 'helpers/materialize/js/materialize.min.js', ['jquery'], $this->version, true );
        
        /**
         * Crea una nueva tabla.
         * Parametros
         * 1. Nombre del archivo
         * 2. Nombre del objeto o varible
         * 3. Array de datos
		 */
        wp_localize_script(
            $this->plugin_name,
            'newdata',
            [
                'url'           => admin_url('admin-ajax.php'),
                'seguridad'     => wp_create_nonce('newdata_seg')
            ]
        );

        /**
         * Eliminar una tabla
         * Parametros
         * 1. Nombre del archivo
         * 2. Nombre del objeto o varible
         * 3. Array de datos
		 */
        wp_localize_script(
            $this->plugin_name,
            'newtabdelete',
            [
                'url'           => admin_url('admin-ajax.php'),
                'seguridad'     => wp_create_nonce('newtabdelete_seg')
            ]
        );

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

    /**
	 * Metodo para crear una tabla a travez de ajax
	 * Este metodo esta definido en el ajax del archivo admin/js/new-admin.js
	 * @since    1.0.0
     * @access   public
	 */
    public function ajax_crud_table() {

        check_ajax_referer('newdata_seg', 'nonce');

        if( current_user_can('manage_options') ){

            extract( $_POST, EXTR_OVERWRITE );

            if( $tipo == 'add' ){

                $columns = [
                    'nombre' => $nombre,
                    'data'   => ''
                ];

                $result = $this->db->insert( NEW_TABLE, $columns );

                $json = json_encode( [
                    'result'    => $result,
                    'nombre'    => $nombre,
                    'insert_id' => $this->db->insert_id
                ] );
            }

            echo $json;
            wp_die();

        }
    }

    /**
	 * Metodo eliminar una tabla a travez de ajax
	 * Este metodo esta definido en el ajax del archivo admin/js/new-admin.js
	 * @since    1.0.0
     * @access   public
	 */
    public function ajax_delete_table() {

        check_ajax_referer('newtabdelete_seg', 'nonce');

        if( current_user_can('manage_options') ){

            extract( $_POST, EXTR_OVERWRITE );

            if( $tipo == 'delete' ){

                $result = $this->db->delete( NEW_TABLE, [ 'id' => $id ], '%d' );

                $json = json_encode( [
                    'result'    => $result,
                    'id'        => $id,
                    'nombre'    => $nombre,
                ] );
            }

            echo $json;
            wp_die();

        }
    }
    

    /**
	 * Metodo añadir un nuevo formulario de usuario
	 * Este metodo esta definido en el ajax del archivo admin/js/new-admin.js
	 * @since    1.0.0
     * @access   public
	 */
    public function ajax_add_user() {

        check_ajax_referer('newtabdelete_seg', 'nonce');

        if( current_user_can('manage_options') ){

            extract( $_POST, EXTR_OVERWRITE );

            $sql = $this->db->prepare(
                "SELECT data FROM " . NEW_TABLE . " WHERE id=%d",
                $idTable
            );

            $resultado = $this->db->get_var( $sql );

            if( $tipo == 'add' ){

                $data           = $this->crud_json->add_user( $resultado, $nombres, $apellidos, $email, $imgUrl );
                $columns        = ['data' => json_encode( $data )];
                $where          = ['id' => $idTable];
                $format         = ['%s'];
                $where_fomart   = ['%d'];

                $result_update = $this->db->update( NEW_TABLE, $columns, $where, $format, $where_fomart );
                $last_user = end( $data['users'] );
                $insert_id = $last_user['id'];

                $json = json_encode([
                    'result'    => $result_update,
                    'json'      => $data,
                    'insert_id' => $insert_id
                ]);
            }

            echo $json;
            wp_die();

        }
    }
}







