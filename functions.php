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
include( get_stylesheet_directory() . '/inc/func-price-percentage.php' );
include( get_stylesheet_directory() . '/inc/func-img.php' );


add_filter( 'woocommerce_bacs_account_fields', 'custom_bacs_account_field', 10, 2);
function custom_bacs_account_field( $account_fields, $order_id ) {
    $account_fields['cnpj' ] = array(
        'label' => 'CNPJ',
         'value' => '30.096.589/0001-34'
    );
    return $account_fields;
}
