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
<div id="add_new_table" class="modal">
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
            <div class="row">
                <div class="col s6">
                    <input id="nombre-tabla" type="text" class="validate">
                    <label for="nombre">Nombre de la tabla</label>
                </div>
            </div>

            <div class="row">
                <div class="col s6">
                    <button id="crear-tabla" class="btn waves-effect waves-light" type="button" name="action">
                        crear <i class="material-icons right">add</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="had-container">

    <div class="row">
        <div class="col s12">
            <h5><?= esc_html( get_admin_page_title() ) ?></h5>
        </div>
    </div>

    <div class="row">
        <div class="col s4">
            <a class="add-new-table btn-floating pulse">
                <i class="material-icons">add</i>
            </a>
            <span>Crear nueva tabla de datos</span>
        </div>
    </div>
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
                        <tr data-table="<?= $value->id ?>">
                            <td><?= $value->nombre ?></td>
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



