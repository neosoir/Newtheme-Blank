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
 * Consulta sql.
 */

    $sql = "SELECT id, nombre from " . NEW_TABLE;

    $result = $this->db->get_results( $sql );

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
        <form action="" method="post">
            
            <div class="col s6">
                <input id="nombres" type="text" class="validate">
                <label for="nombres">Nombre</label>
            </div>
        
            <div class="col s6">
                <input id="apellidos" type="text" class="validate">
                <label for="apellidos">Apellidos</label>
            </div>
        
            <div class="col s6">
                <input id="email" type="text" class="validate">
                <label for="email">Email</label>
            </div>
            
            <!-- Boton para subir archivos -->
            <div class="row">
                <div class="file-field input-field col s10">
                    <div class="btn">
                        <span>File</span>
                        <input type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s6">
                    <button id="agregar" class="btn waves-effect waves-light" type="button" name="action">
                        Agregar <i class="material-icons right">add</i>
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
                        <th>Nombre</th>
                        <th>Shortcode</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($result as $key => $value) : ?>
                        <tr id="dataTable<?= $value->id ?>" data-table="<?= $value->id ?>">
                            <td data-new-name="<?= $value->nombre ?>"><?= $value->nombre ?></td>
                            <td>[newdatos id="<?= $value->id ?>"]</td>
                            <td>
                                <span class='btn btn-floating waves-effect weves-light' data-new-id-edit="<?= $value->id ?>">
                                    <i class='tiny material-icons'>mode_edit</i>
                                </span>
                            </td>
                            <td>
                                <span class='btn btn-floating waves-effect weves-light red darken-1' data-new-id-remove="<?= $value->id ?>">
                                    <i class='tiny material-icons'>close</i>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



