<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style-sheet.css' );
  }

//=============================
//---------Helpers-------------
//=============================
function retrieve_var1_replacement( $especial_attribute=0, $all=0 ) {
    //only run on products
    if( !is_product() ){return;}
    if (is_object($all) or is_array($all)) {
      $all = 0;
    }
    //run this if $var1 recived a term
    if($especial_attribute && $especial_attribute != 'produtoSeo'){
      print_r($especial_attribute);
      $post_term = wp_get_post_terms(get_post()->ID , $especial_attribute);
      if( $post_term && is_array($post_term) ){
        if ($all) {
          return get_all_array_term($post_term);
        }else{
          return ' | '.$post_term[0]->name;
        }
      }
      print_r($post_term);
    return;
    }
    //run this if $var1 is left empty
    $terms = array( 'pa_extencao','pa_autor','pa_editora' );
    $pr_id = get_post()->ID;
    foreach ($terms as $key => $value) {
      $post_term = wp_get_post_terms($pr_id , $value);
      if(is_array($post_term) && $post_term != array() ){
        if ($all) {
          return get_all_array_term($post_term);
        }
        return ' | '.$post_term[0]->name;
      }
    }
  }

//-------
//-------

//remove_action( "woocommerce_single_product_summary", woocommerce_template_single_price(), 10)