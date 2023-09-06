<?php
add_shortcode('cartButtonHeader', 'show_cart');


function show_cart() {
    include MY_PATH . '/includes/templates/view-cart-button.php';
}