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


<div class="had-container">

    <div class="row">
        <div class="col s12">
            <h5><?= esc_html( get_admin_page_title() ) ?></h5>
        </div>
    </div>

    <div class="row">
        <div class="col s4">
            <a class="btn-floating pulse">
                <i class="material-icons">add</i>
            </a>
            <span>Crear nueva tabla de datos</span>
        </div>
    </div>
</div>



