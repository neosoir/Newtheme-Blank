<?php

class NEW_Settings {
    
    public function init() {
        $args = [
            'sanitize_callback' => 'new_filtrando',
            'default' => 'Este nombre de opción no fue encontrado en la tabla de opciones'
        ];

        // registrando una nueva configuración en la página "general"
        register_setting( 'new_pruebas', 'new_miprimera_configuracion', $args );

        // Registrando una nueva sección en la página "general"
        add_settings_section(
            'new_config_seccion',
            'Configuración',
            [ $this, 'config_seccion_cb' ],
            'new_pruebas'
        );

        add_settings_field(
            'new_config_campo1',
            'Configuración 1',
            [ $this, 'config_campo1_cb' ],
            'new_pruebas',
            'new_config_seccion',
            [
                'label_for' => 'new_campo_1',
                'class' => 'clase_campo',
                'new_dato_personalizado' => 'valor personalizado 1'
            ]
        );

        add_settings_field(
            'new_config_campo2',
            'Configuración 2',
            [ $this, 'config_campo2_cb' ],
            'new_pruebas',
            'new_config_seccion',
            [
                'label_for' => 'new_campo_2',
                'class' => 'clase_campo',
                'new_dato_personalizado' => 'valor personalizado 2'
            ]
        );
    }
    
    private function config_seccion_cb() {
        echo "<p>Sección configuración</p>";        
    }
    
    private function config_campo1_cb($args) {

        $new_config = get_option('new_miprimera_configuracion');

        if( $new_config !== false ) {
            $valor = isset($new_config[$args['label_for']]) ? esc_attr($new_config[$args['label_for']]) : '';        
        } else {
            $valor = $new_config;
        }   

        $output = "<input class='{$args['class']}' data-custom='{$args['new_dato_personalizado']}' type='text' name='new_miprimera_configuracion[{$args['label_for']}]' value='$valor'>";

        echo $output;

    }

    function config_campo2_cb($args) {

        $new_config = get_option('new_miprimera_configuracion');

        if( $new_config != false ) {
            $valor = isset($new_config[$args['label_for']]) ? esc_attr($new_config[$args['label_for']]) : '';
        } else {
            $valor = $new_config;
        }

        $html = "<input class='{$args['class']}' data-custom='{$args['new_dato_personalizado']}' type='text' name='new_miprimera_configuracion[{$args['label_for']}]' value='$valor'>";

        echo $html;

    }
    
    public function filtrando( $valor ) {
    
        $valor['new_campo_1'] = $valor['new_campo_1'];
        $valor['new_campo_2'] = $valor['new_campo_2'];

        return $valor;

    }
    
}


