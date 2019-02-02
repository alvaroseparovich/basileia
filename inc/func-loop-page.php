<?php


if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
  /**
  * Show the product H3 title in the product loop.
  */
  function woocommerce_template_loop_product_title() {
  echo '<h3 class="woocommerce-loop-product__title">' . get_the_title() . '</h3>';
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