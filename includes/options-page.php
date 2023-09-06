<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action('after_setup_theme', 'load_carbon_fields');
add_action('carbon_fields_register_fields', 'create_options_page');

function load_carbon_fields() {
    \Carbon_Fields\Carbon_Fields::boot();
}

function create_options_page() {
    // ja que é ctt form....
    Container::make( 'theme_options', __( 'Opções de Frete' ) )
    ->set_icon('dashicons-cart')
    ->add_fields( array(

        Field::make('checkbox', 'contact_plugin_active', __('Ativado')),

        Field::make( 'Text', 'valor_min_para_frete_gratis', __( 'Valor mínimo de compra para frete grátis' ) )
        ->set_attribute('placeholder', 'Digite somente o número, sem R$, por exemplo: 300')
        ->set_help_text('Entre com o valor mínimo de compra para o cliente ter frete grátis automático'),
    ) );
}