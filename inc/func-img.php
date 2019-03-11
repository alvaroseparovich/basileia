<?php


if ( ! function_exists( 'basileia_img_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function basileia_img_setup() {
      // Cropping the images to different sizes to be used in the theme
      add_image_size( 'basileia-main-featured', 530, 530);
      add_image_size( 'basileia-beside-featured', 280, 280);
    }
  endif; // estore_setup
  add_action( 'after_setup_theme', 'basileia_img_setup', 11 );