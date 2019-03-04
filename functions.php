<?php

//Functions to remove or add css and scripts 
require_once get_stylesheet_directory() . '/inc/func-wp-enqueue.php';

//Functions to custom product page
require_once get_stylesheet_directory() . '/inc/func-product-page.php';

//Functions to costumize loop pages
require_once get_stylesheet_directory() . '/inc/func-loop-page.php';

//Helpers
require_once get_stylesheet_directory() . '/inc/func-helper.php';


require_once get_stylesheet_directory() . '/inc/widgets.php';
include( get_stylesheet_directory() . '/short-codes.php' );
include( get_stylesheet_directory() . '/inc/widgets/basileia-search.php' );
include( get_stylesheet_directory() . '/inc/widgets/basileia-home-featured-sliders.php' );
include( get_stylesheet_directory() . '/inc/func-footer.php' );
include( get_stylesheet_directory() . '/inc/attributes-with-image.php' );
include( get_stylesheet_directory() . '/inc/add-sidebar.php' );


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
