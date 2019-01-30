<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style-sheet.css' );

    wp_enqueue_script( 'default-basileia-js', get_stylesheet_directory_uri().'/inc/js/default-basileia.js' );
    
  }
//get theme dir path
function basileia_dir(){
  return get_stylesheet_directory();
}

require_once basileia_dir() . '/inc/widgets.php';


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

//=============================
//---------product Page--------
//=============================
/** some hel with the default hooks order
 * woocommerce_single_product_summary hook
 *
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_rating - 10
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 */
remove_action( "woocommerce_single_product_summary", "woocommerce_template_single_rating");
add_action( "woocommerce_single_product_summary", "woocommerce_template_single_rating", 1);
remove_action( "woocommerce_single_product_summary", "woocommerce_template_single_price");
add_action( "woocommerce_single_product_summary", "woocommerce_template_single_price", 15);

function start_price_block(){  echo"<div class='group-sumary'>";  return;};
function start_p1_block(){  echo"<div class='group group-sumary-pt1'>";  return;};
function start_p2_block(){  echo"<div class='group group-sumary-pt2'>";  return;};
function end_block(){  echo"</div>";  return;};

add_action( "woocommerce_single_product_summary", "start_price_block", 11);
add_action( "woocommerce_single_product_summary", "end_block", 35);
add_action( "woocommerce_single_product_summary", "end_block", 55);//start an oder block
add_action( "woocommerce_single_product_summary", "start_p2_block", 29);
add_action( "woocommerce_single_product_summary", "end_block", 35);
add_action( "woocommerce_single_product_summary", "summary_seo_info", 39);


//Add or reduce number of products to be bought.
function add_cart_button_less(){  global $product;
  if(number_format( $product->get_stock_quantity(),0,'','' ) > 1 or $product->get_manage_stock()=="no") {
      echo'<button class="btElLess" type="button" onclick="removeItem(); return false;">-</button></div>';
      }    }
function add_cart_button_plus(){  global $product;
  if(number_format( $product->get_stock_quantity(),0,'','' ) > 1 or $product->get_manage_stock()=="no") {
      echo'<div class="counter"><button class="btElPlus" type="button" onclick="addItem(); return false;">+</button>';
      }    }
  
function add_buttons_js_snippet(){echo'<script>
  function removeItem(){	e = document.querySelector("form.cart .quantity > input.input-text");	n = e.value;newN = parseInt(n)-1;  if (!(newN < e.min)){ e.value = newN; }}
  function addItem(){	e = document.querySelector("form.cart .quantity > input.input-text");	n = e.value;newN = parseInt(n)+1;  if (e.max==""){e.value = newN;}    if (!(newN > e.max)){ e.value = newN; }} 
</script>';}
add_filter('woocommerce_after_add_to_cart_quantity','add_cart_button_less', 0);
add_filter('woocommerce_before_add_to_cart_quantity','add_cart_button_plus', 0);
add_action('wp_head', 'add_buttons_js_snippet');

//call Info to Improve Product-page Seo
function summary_seo_info(){
  //Informations about the Title, Author and Brand
  global $post; $post_id = get_post()->ID;
  echo '<div class="woocommerce-product-book-details-seo"><div  class="short-detail">';
  the_title( '<div class="title line"> Nome: <h2><i>', retrieve_var1_replacement().'</i></h2></div>' );
  $retrieve = wp_get_post_terms( $post_id , 'pa_autor');
  if($retrieve and !is_wp_error($retrieve) ){
    echo '<div class="autor line"> Autor:';
    foreach ($retrieve as $key => $value) {
      echo ' <h2><a href="'.get_term_link( $value->slug, 'pa_autor' ) . '">'.$value->name . '</a></h2> ';
    }
    echo'</h2></div>';
  }
  $retrieve = wp_get_post_terms( $post_id , 'pa_editora');
  if($retrieve and !is_wp_error($retrieve) ){
    echo '<div class="editora line"> Editora:';
    foreach ($retrieve as $key => $value) {
      echo '<h2><a href="'. get_term_link( $value->slug , 'pa_editora' ) . '">'.$value->name . '</a></h2>';
    }
    echo'</h2></div>';
  }
  echo '</div></div>';
}

//=============================
//---------Loop Page--------
//=============================

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
  /**
  * Show the product H3 title in the product loop.
  */
  function woocommerce_template_loop_product_title() {
  echo '<h3 class=”woocommerce-loop-product__title”>' . get_the_title() . '</h3>';
  if (wp_get_post_terms(get_post()->ID, "pa_autor") and ! is_wp_error( wp_get_post_terms(get_post()->ID, "pa_autor") ) ){
    echo '<h5>'. wp_get_post_terms(get_post()->ID, "pa_autor")[0]->name .'</h5>';  
  }else{
    echo "<h5>-</h5>";
  }
  //var_dump(wp_get_post_terms(get_post()->ID, "pa_autor"));
  }
}
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {

  /**
   * Get the product thumbnail for the loop.
   */
  function woocommerce_template_loop_product_thumbnail() {
      echo "<div class='loop-img'>";
      echo woocommerce_get_product_thumbnail(); // WPCS: XSS ok.
      echo "</div>";
  }
}