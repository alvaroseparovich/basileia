<?php

function my_theme_enqueue_styles() {
 
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style-sheet.css' );
  
  //wp_enqueue_script( 'default-basileia-js', get_stylesheet_directory_uri().'/inc/js/default-basileia.js' );
  
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
  
function wpdocs_dequeue_script() {
  
  $classes = get_body_class();
  if (in_array('no-sidebar',$classes)) {

    wp_dequeue_script( 'jquery-ui-core' );
    wp_dequeue_script( 'slick' );
    wp_dequeue_script( 'slicknav' );

  }
}
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );