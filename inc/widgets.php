<?php
/**
 * Contains all the functions related to sidebar and widget.
 */

add_action( 'widgets_init', 'basileia_widgets_init' );
function basileia_widgets_init() {
	register_widget( "attribute_feature_right" );
	register_widget( "banner_img" );
}

function hw_arq($param=""){
    return basileia_dir().'/inc/widgets/'.$param;
}
require hw_arq('wd_attribute_feature_right.php');
require hw_arq('wd_banner.php');