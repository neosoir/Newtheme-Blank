<?php
/**
 * Proporcionar un manejo de datos CRUD
 *
 * Este archivo se utiliza para marcar los aspectos de administración del plugin.
 *
 * @link http://misitioweb.com
 * @since desde 1.0.0
 *
 * @package newtheme-blank
 * @subpackage newtheme-blank/admin/parcials
 *
 * Este archivo permite crear la estructura de un CRUD en
 * formato json para ser guardado en una BBDD
 */

class NEW_CRUD_JSON {

    /**
     * Permite crear la estructura base para guardar los datos
     * de los items con el formato json
     *
     * @since desde 1.0.0
     * @access public
     *
     * @param string $data        El valor obtenido del campo data con el formato json
     * @param string $nombres     Nombres del usuario
     * @param string $apellidos   Apellidos del usuario
     * @param string $email       Email del usuario
     * @param string $imgUrl      enlace url de la imagen del usuario
     *
     * @return array
     */
    public function add_user( $data, $nombres, $apellidos, $email, $imgUrl ){

        if ( $data == '' ) {
            $data = [
                'users' => [
                    [
                        'id'            => 1,
                        'nombres'       => $nombres,
                        'apellidos'     => $apellidos,
                        'email'         => $email,
                        'imgUrl'        => $imgUrl
                    ]
                ]
            ];
        }
        else {
            $user_decode = json_decode( $data, true );
            $last_user = end( $users_decode['users'] );
            $last_user_id = $last_user['id'];
            $insert_user_id = ++$last_user_id;

            $user_decode['users'][] = [
                'id'        => $insert_user_id,
                'nombres'   => $nombres,
                'apellidos' => $apellidos,
                'email'     => $email,
                'imgUrl'    => $imgUrl
            ];

            $data = $user_decode;
        }

        return $data;
    }

    /**
     * Permite convertir los datos de los usuarios con el formato json a un array
     * para luego ser iterado con un foreach
     *
     * @since desde 1.0.0
     * @access public
     *
     * @param string $data        El valor obtenido del campo data con el formato json
     *
     * @return array
     */
    public function read_user( $data ){
        
    }

    /**
     * Permite actualizar los datos del usuario
     * 
     * @since desde 1.0.0
     * @access public
     *
     * @param string $ar_user     El valor obtenido del campo data con el formato json
     * @param string $idUser      id del usuario que se va a actualizar
     * @param string $nombres     Nombres del usuario
     * @param string $apellidos   Apellidos del usuario
     * @param string $email       Email del usuario
     * @param string $imgUrl      enlace url de la imagen del usuario
     *
     * @return array
     */
    public function update_user( $ar_user, $idUser, $nombres, $apellidos, $email, $imgUrl ){
        
    }

    /**
     * Permite eliminar un usuario
     * 
     * @since desde 1.0.0
     * @access public
     *
     * @param string $ar_user     El valor obtenido del campo data con el formato json
     * @param string $id_delete   id del usuario que se va a eliminar
     *
     * @return array
     */
    public function delete_user( $ar_user, $id_delete ){
        
    }
}