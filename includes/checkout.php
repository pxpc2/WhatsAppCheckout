<?php
add_shortcode('paginaDeCheckout', 'show_checkout');

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function enqueue_custom_scripts() {
    wp_enqueue_style('checkout-style', MY_PLUGIN_URL . 'assets/css/checkout-style.css');
}

function show_checkout() {
    include MY_PATH . '/includes/templates/checkout-list.php';
}