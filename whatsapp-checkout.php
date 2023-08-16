<?php

/**
 * 
 * Plugin name: WhatsApp Checkout
 * Description: Checkout com o WhatsApp
 * Version: 0.0.1
 * Author: Pedro Daia
 * Author URI: https://github.com/pxpc2
 * Text Domain: options-plugin
 * 
 */
 if(!defined('ABSPATH')) {
   die('Você não pode acessar aqui.');
 }

 if (!class_exists('WhatsappCheckout')) {
   class WhatsappCheckout {

      public function __construct() {

         define('MY_PATH', plugin_dir_path(__FILE__));

         require_once(MY_PATH . '/vendor/autoload.php');
      }
      
      public function initialize() {

      }
   }

   $whatsappCheckout = new WhatsappCheckout;
   $whatsappCheckout->initialize();
    
 }