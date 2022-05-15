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

?>


<!-- Modal Structure -->
<div id="add_new_table" class="modal">
    <div class="modal-content">
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
</div>



