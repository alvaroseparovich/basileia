<?php

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
add_action( "woocommerce_single_product_summary", "start_p1_block", 11);
add_filter( 'woocommerce_single_product_summary', 'filter_price', 14);
add_action( "woocommerce_single_product_summary", "end_block", 16);
add_action( "woocommerce_single_product_summary", "end_block", 35);
add_action( "woocommerce_single_product_summary", "end_block", 55);//start an oder block
add_action( "woocommerce_single_product_summary", "start_p2_block", 29);
add_action( "woocommerce_single_product_summary", "end_block", 35);
add_action( "woocommerce_single_product_summary", "summary_seo_info", 39);


//Add or reduce number of products to be bought.
function add_cart_button_less(){  global $product;

    if(number_format( $product->get_stock_quantity(),0,'','' ) > 1 or $product->get_manage_stock()==false) {
  
        echo'<button class="btElLess" type="button" onclick="removeItem(); return false;">-</button></div>';
  
    }    
}

function add_cart_button_plus(){  global $product;

    if(number_format( $product->get_stock_quantity(),0,'','' ) > 1 or $product->get_manage_stock()==false) {

        echo'<div class="counter"><button class="btElPlus" type="button" onclick="addItem(); return false;">+</button>';

    }    
}
  
function add_buttons_js_snippet(){
  
    echo'<script>
        function removeItem(){	e = document.querySelector("form.cart .quantity > input.input-text");	n = e.value;newN = parseInt(n)-1;  if (!(newN < e.min)){ e.value = newN; }}
        function addItem(){	e = document.querySelector("form.cart .quantity > input.input-text");	n = e.value;newN = parseInt(n)+1;  if (e.max==""){e.value = newN;}    if (!(newN > e.max)){ e.value = newN; }} 
        </script>';
}

add_filter('woocommerce_after_add_to_cart_quantity','add_cart_button_less', 0);
add_filter('woocommerce_before_add_to_cart_quantity','add_cart_button_plus', 0);
add_action('wp_head', 'add_buttons_js_snippet');


//call Info to Improve Product-page Seo
function summary_seo_info(){
  //Informations about the Title, Author and Brand
  
  global $post; 
  $post_id = get_post()->ID;

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
  
    echo '<div class="editora line"> Editora: ';
  
    foreach ($retrieve as $key => $value) {
  
        echo '<h2><a href="'. get_term_link( $value->slug , 'pa_editora' ) . '">'.$value->name . '</a></h2>';
  
    }
  
    echo'</h2></div>';
  
}
  echo '</div></div>';
}

function filter_price(){
    global $product;
    if ( ! $product->is_on_sale() ) return;
    if ( $product->is_type( 'simple' ) ) {
        $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
    } elseif ( $product->is_type( 'variable' ) ) {
        $max_percentage = 0;
        foreach ( $product->get_children() as $child_id ) {
            $variation = wc_get_product( $child_id );
            $price = $variation->get_regular_price();
            $sale = $variation->get_sale_price();
            if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
            if ( $percentage > $max_percentage ) {
                $max_percentage = $percentage;
            }
        }
    }
    if ( $max_percentage > 0 ) echo "<div class='sale-perc'>-" . round($max_percentage) . "%</div>"; 
}

/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
    global $product;
      
    $args['posts_per_page'] = 4;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
function jk_related_products_args( $args ) {
    $args['posts_per_page'] = 4; // 4 related products
    $args['columns'] = 2; // arranged in 2 columns
    return $args;
}