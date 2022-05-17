<?php

/**
  * Proporcionar una vista de área de administración para el plugin
  *
  * Este archivo se utiliza para marcar los aspectos de administración del plugin.
  *
  * @link https://neoslab.online
  * @since desde 1.0.0
  *
  * @package newtheme-blank
  * @subpackage newtheme-blank/admin/parcials
  *
  * Este archivo debe consistir principalmente en HTML con un poco de PHP. 
*/

/**
 * Obtener el parametro de la url.
 */

$id = $_GET['id'];

/**
 * Consulta sql.
 */
$sql = $this->db->prepare("SELECT data FROM " . NEW_TABLE . 
                            " WHERE id=%d" , $id);

$resultado = $this->db->get_var( $sql );



/* $sql = $this->db->prepare( "SELECT data FROM " . NEW_TABLE . " WHERE id=%d", $id );
$resultado = $this->db->get_var( $sql );
 */
?>


<!-- Modal Structure -->
<div id="addUpdate" class="modal">
    <div class="modal-content">

        <!-- Preload of materialize-->
        <div class="preload">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="" method="post" class="formularioDataUser">
            <div class="row">
                <!-- Pasar el id de la tabla -->
                <input type="hidden" name="idTable" id="idTable" value="<?= $id ?>">

                <div class="input-field  col s6">
                    <input id="nombres" type="text" class="validate">
                    <label for="nombres">Nombre</label>
                </div>

                <div class="input-field  col s6">
                    <input id="apellidos" type="text" class="validate">
                    <label for="apellidos">Apellidos</label>
                </div>

                <div class="input-field  col s6">
                    <input id="email" type="text" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>
            <!-- Boton para subir archivos -->
            <div class="row">
                <div class="file-field input-field col s10">
                    <div class="btn" id="selectimg">
                        <span>
                            Seleccionar imagen
                            <i class="material-icons right">file_upload</i>
                        </span>
                        <input type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" id="selectimgval" type="text">
                    </div>
                </div>
                <!-- Mostrar imagen seleccionada -->
                <div class="col s2">
                    <div class="marcoImagen">
                        <img src="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s6">
                    <button id="agregar" class="btn waves-effect waves-light" type="button" name="action">
                        Agregar <i class="material-icons right">add</i>
                    </button>
                    <button id="actualizar" class="btn waves-effect waves-light" type="button" name="action">
                        Actualizar <i class="material-icons right">cached</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="had-container">

    <!--Titulo de la página-->
    <div class="row">
        <div class="col s12">
            <h5><?= esc_html( get_admin_page_title() ) ?></h5>
        </div>
    </div>

    <!-- Boton volver atras -->
    <div class="row">
        <div class="col s4">
            <a href="?page=new_data" class="btn-floating waves-effect waves-light orange darken-1">
                <i class="material-icons">arrow_back</i>
            </a>
        </div>
    </div>

    <!-- Boton Agregar usuarios -->
    <div class="row">
        <div class="col s4">
            <a class="addItem btn-floating pulse">
                <i class="material-icons">add</i>
            </a>
            <span>Agregar usuarios</span>
        </div>
    </div>
    
    <!-- Tabla -->
    <div class="row">
        <div class="col s4">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?= $this->crud_json->read_user( $resultado )  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



