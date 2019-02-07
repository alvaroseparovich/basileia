<?php

function basileia_enqueue_styles_scripts() {
 
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style-sheet.css' );
  

  //Registering scripts
  wp_register_script('default-basileia-js', get_stylesheet_directory_uri().'/inc/js/default-basileia.js');
  wp_register_script('color-thief', get_stylesheet_directory_uri().'/inc/js/color-thief.min.js');
  //To enqueue scripts
  wp_enqueue_script( 'color-thief','','','', true );
  wp_enqueue_script( 'default-basileia-js','','','', true );
  
}
add_action( 'wp_enqueue_scripts', 'basileia_enqueue_styles_scripts' );
  
function wpdocs_dequeue_script() {
  
  $classes = get_body_class();
  if (in_array('no-sidebar',$classes)) {

    wp_dequeue_script( 'jquery-ui-core' );
    wp_dequeue_script( 'slick' );
    wp_dequeue_script( 'slicknav' );

  }
}
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );