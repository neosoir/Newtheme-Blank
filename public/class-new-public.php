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
	 * Conectamos con la base de datos de wordpress
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $db      Accedemos a los metodos de consulta de wordpress.
	 */
    private $db;
    
    /**
     * @param string $plugin_name nombre o identificador único de éste plugin.
     * @param string $version La versión actual del plugin.
     */
    public function __construct( $plugin_name, $version ) {
        
        $this->plugin_name  = $plugin_name;
        $this->version      = $version;   
        
        global $wpdb;
        $this->db           = $wpdb;  
        
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

    /**
	 * Shorcode que muestra los usuarios registrados en la base de datos.
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function new_data_shortcode_id( $atts, $content="" ) {
        
        $args = shortcode_atts(
            [
                'id' => '',

            ],
            $atts
        );
        
        extract( $args, EXTR_OVERWRITE );

        if( $id != '' ) {

            $sql =  $this->db->prepare(
                "SELECT nombre, data FROM " . NEW_TABLE .
                    " WHERE id=%d", $id
            );
            $resultado = $this->db->get_results( $sql );

            if ( ( $resultado[0]->data ) != '' ) {
                
                $data   = json_decode( $resultado[0]->data, true );
                $nombre = $resultado[0]->nombre;

                $output = "
                    <div id='new_users'>
                        <div class='new_container'>
                            <h5>$nombre</h5>
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>

                ";

                foreach( $data['users'] as $valor ){

                    $nombres = $valor['nombres'];
                    $apellidos = $valor['apellidos'];
                    $email = $valor['email'];
                    $imgUrl = $valor['imgUrl'];

                    $output .= "
                        <tr>
                            <td>
                                <img class='new-img-user' src='$imgUrl' alt='$nombres $apellidos'>
                            </td>
                            <td>$nombres</td>
                            <td>$apellidos</td>
                            <td>$email</td>
                        </tr>
                    ";

                }

                $output .= "
                                </tbody>
                            </table>
                        </div>
                    </div>
                ";

            }
            else {
                $output = '<h5>No hay informacion con el id ' . $id . '</h5>'; 
            }

            return $output;

        }

    }
    
}







