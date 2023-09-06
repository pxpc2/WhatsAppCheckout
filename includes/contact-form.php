<?php
add_shortcode('butaoCarrinho', 'show_contact_form');

function show_contact_form() {
    include MY_PATH . '/includes/templates/form.php';
}