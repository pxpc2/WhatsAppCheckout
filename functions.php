<?php

// Function to get item price by name using JetEngine API
function get_item_price_by_name($item_name) {
   // Use JetEngine API to fetch the custom field value 'preco' for the Mercadoria post type
   $post_args = array(
      'post_type' => 'mercadoria',
      'meta_key' => 'preco',
      'meta_value' => $item_name,
      'posts_per_page' => 1,
   );

   $query = new WP_Query($post_args);

   if ($query->have_posts()) {
      while ($query->have_posts()) {
         $query->the_post();
         $price = get_post_meta(get_the_ID(), 'preco', true);
         return $price;
      }
      wp_reset_postdata();
   }

   return 0; // Return 0 if item not found or price not available
}