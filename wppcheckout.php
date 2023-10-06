<?php

/**
 * 
 * Plugin name: Carrinho WhatsApp BETA
 * Description: Versão BETA em desenvolvimento do wppcheckout desenvolvido para o Mercado Orgânico.
 * Version: 0.0.8
 * Author: Pedro Daia
 * Author URI: https://github.com/pxpc2
 * Text Domain: options-plugin
 * 
 */
 if(!defined('ABSPATH')) {
   die('Você não pode acessar aqui.');
 }


 if (!class_exists('WppCheckout')) {
   class WppCheckout {

      public function __construct() {

         define('MY_PATH', plugin_dir_path(__FILE__));
         define('MY_PLUGIN_URL', plugin_dir_url(__FILE__));

         require_once(MY_PATH . '/vendor/autoload.php');
      }

      public function output_post_script() {
         $post_title = get_the_title();
         $post_price = get_post_meta(get_the_ID(), 'preco', true);
         $post_stock =  get_post_meta(get_the_ID(), 'disponivel', true);

         $options_data = array(
            'isActive' => carbon_get_theme_option('contact_plugin_active'),
            'minimumPrice' => carbon_get_theme_option('valor_min_para_frete_gratis'),
        );
        
        $options_data['minimumPrice'] = floatval(preg_replace('/[^0-9.]/', '', $options_data['minimumPrice']));

         echo '<script>
         var postData = {
             post_title: "' . esc_js($post_title) . '",
             post_price: "' . esc_js($post_price) . '",
             post_stock: ' . json_encode($post_stock) .'
         };
         var optionsData = {
            isActive: ' . json_encode($options_data['isActive']) . ',
            minimumPrice: ' . json_encode($options_data['minimumPrice']) . '
        };
         </script>';
     }
      
      public function initialize() {
         include_once MY_PATH . '/includes/utils.php';
         include_once MY_PATH . '/includes/options-page.php';
         include_once MY_PATH . '/includes/contact-form.php';
         include_once MY_PATH . '/includes/cart-button.php';
         include_once MY_PATH . '/includes/checkout.php';

         add_action('wp_footer', array($this, 'output_post_script'));
      }
   }

   $wppCheckout = new WppCheckout;
   $wppCheckout->initialize();
    
 }