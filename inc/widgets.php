<?php
/**
 * Contains all the functions related to sidebar and widget.
 */

add_action( 'widgets_init', 'basileia_widgets_init' );
function basileia_widgets_init() {
	register_widget( "attribute_feature_right" );
}

function hw_arq($param=""){
    return basileia_dir().'/inc/widgets/'.$param;
}
require hw_arq('attribute_feature_right.php');