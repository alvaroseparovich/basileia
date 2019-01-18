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
//add_action( "woocommerce_single_product_summary", "start_p1_block", 11);
//add_action( "woocommerce_single_product_summary", "end_block", 25);
add_action( "woocommerce_single_product_summary", "start_p2_block", 29);
add_action( "woocommerce_single_product_summary", "end_block", 35);

//Add or reduce number of products to be bought.
function add_cart_button_less(){  global $product;
  if(number_format( $product->stock,0,'','' ) > 1 or $product->manage_stock=="no") {
      echo'<button class="btElLess" type="button" onclick="removeItem(); return false;">-</button></div>';
      }    }
function add_cart_button_plus(){   global $product;
  if(number_format( $product->stock,0,'','' ) > 1 or $product->manage_stock=="no") {
      echo'<div class="counter"><button class="btElPlus" type="button" onclick="addItem(); return false;">+</button>';
      }    }
  
function add_buttons_js_snippet(){echo'<script>
  function removeItem(){	e = document.querySelector("form.cart .quantity > input.input-text");	n = e.value;newN = parseInt(n)-1;  if (!(newN < e.min)){ e.value = newN; }}
  function addItem(){	e = document.querySelector("form.cart .quantity > input.input-text");	n = e.value;newN = parseInt(n)+1;  if (e.max==""){e.value = newN;}    if (!(newN > e.max)){ e.value = newN; }} 
</script>';}
add_filter('woocommerce_after_add_to_cart_quantity','add_cart_button_less', 0);
add_filter('woocommerce_before_add_to_cart_quantity','add_cart_button_plus', 0);
add_action('wp_head', 'add_buttons_js_snippet');
