<?php

function authors_shortcode( $atts ) {
    
    $ordered_terms = ['a'=>"as"];
    $ordered_terms = array(
        'A' => array(),        'B' => array(),        'C' => array(),        'D' => array(),
        'E' => array(),        'F' => array(),        'G' => array(),        'H' => array(),
        'I' => array(),        'J' => array(),        'K' => array(),        'L' => array(),
        'M' => array(),        'N' => array(),        'O' => array(),        'P' => array(),
        'Q' => array(),        'R' => array(),        'S' => array(),        'T' => array(),
        'U' => array(),        'V' => array(),        'W' => array(),        'X' => array(),
        'Y' => array(),        'Z' => array(),        '#' => array()
    );
    
    $terms = get_terms( array(
        'taxonomy'      => 'pa_autor',
        'hide_empty'    => false,
        'order'         => 'ASC',
    ) );

    foreach ($terms as $key => $term) {

        $letter = substr(strtoupper($term->slug),0,1);

        if (strpos("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", $letter)){
            array_push($ordered_terms[$letter],$term);
        }else{
            array_push($ordered_terms["#"],$term);

        }
    }

    $string = "";
    $string = $string . '<div class="letra-autor '.$key.'">';
    foreach($ordered_terms as $key => $array_authors){
        $string = $string .'<div class="Letter"><h4 class="letra">'.$key.'</h4>';
        $string = $string . '<ul class="lista-letra-autor">';
        foreach($array_authors as $k => $author){
            $at_link = esc_url( get_term_link( $author, $author->name ) ) ;
            $string = $string . '<a href="'.$at_link.'"><li class="nome-autor">'.$author->name.'</li></a>';

        }
        $string = $string . '</ul></div>';
    }
    $string = $string . '</div>';

	return $string;
}

add_shortcode( 'autores', 'authors_shortcode' );


function brands_shortcode( $atts ) {
    
    $ordered_terms = ['a'=>"as"];
    $ordered_terms = array(
        'A' => array(),        'B' => array(),        'C' => array(),        'D' => array(),
        'E' => array(),        'F' => array(),        'G' => array(),        'H' => array(),
        'I' => array(),        'J' => array(),        'K' => array(),        'L' => array(),
        'M' => array(),        'N' => array(),        'O' => array(),        'P' => array(),
        'Q' => array(),        'R' => array(),        'S' => array(),        'T' => array(),
        'U' => array(),        'V' => array(),        'W' => array(),        'X' => array(),
        'Y' => array(),        'Z' => array(),        '#' => array()
    );
    
    $terms = get_terms( array(
        'taxonomy'      => 'pa_editora',
        'hide_empty'    => false,
        'order'         => 'ASC',
    ) );

    foreach ($terms as $key => $term) {

        $letter = substr(strtoupper($term->slug),0,1);

        if (strpos("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", $letter)){
            array_push($ordered_terms[$letter],$term);
        }else{
            array_push($ordered_terms["#"],$term);

        }
    }

    $string = "";
    $string = $string . '<div class="letra-editora '.$key.'">';
    foreach($ordered_terms as $key => $array_brands){
        $string = $string .'<div class="Letter"><h4 class="letra">'.$key.'</h4>';
        $string = $string . '<ul class="lista-letra-editora">';
        foreach($array_brands as $k => $brand){
            $at_link = esc_url( get_term_link( $brand, $brand->name ) ) ;
            echo "<pre>";
            $dump = var_dump($brand);
            echo "</pre>";
            /* $string = $string . '<a href="'.$at_link.'"><li class="nome-editora">'.$dump.'</li></a>'; */

            $image = wp_get_attachment_image( $brand->term_id, 'medium', false, array( 'id' => 'attribute-preview-image' ) );

            if($image==""){$image = '<img src="../wp-content/plugins/woocommerce/assets/images/placeholder.png" alt="Awaiting product image" class="wp-post-image">';}
            
            $string = "{$string} <a href='{$at_link}'><li class='nome-editora'>{$image}<span>{$brand->name}</span></li></a>";
    
        }
        $string = $string . '</ul></div>';
    }
    $string = $string . '</div>';

	return $string;
}

add_shortcode( 'editoras', 'brands_shortcode' );
