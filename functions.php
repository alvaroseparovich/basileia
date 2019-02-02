<?php

//Functions to remove or add css and scripts 
require_once basileia_dir() . '/inc/func-wp-enqueue.php';

//Functions to custom product page
require_once basileia_dir() . '/inc/func-product-page.php';

//Functions to costumize loop pages
require_once basileia_dir() . '/inc/func-loop-page.php';

//Helpers
require_once basileia_dir() . '/inc/func-helper.php';


require_once basileia_dir() . '/inc/widgets.php';
include( basileia_dir() . '/short-codes.php' );


//==============================
//----------Pre set-up----------
//==============================
//function basileia_setup() {
  // Cropping the images to different sizes to be used in the theme
  //add_image_size( 'basileia-medium-image', 240, 240);
  //add_image_size( 'basileia-small', 110, 120);
  // Cropping the images to different sizes to be used in the theme **************REMOVE*****************
//}
//add_action( 'after_setup_theme', 'basileia_setup', 11 );
