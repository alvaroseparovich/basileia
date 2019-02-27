<?php
register_sidebar( array(
	'name'          => esc_html__( 'Banner Principal', 'Basileia' ),
        'id'            => 'basileia_home_main_space',
        'description'   => 'Espaço para widgets na pagina home',
        'before_widget' => '<section id="basileia-main-banner-area" class="widget basileia basileia-main-banner-area">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>'
) );
register_sidebar( array(
	'name'          => esc_html__( 'Banner Lateral', 'Basileia' ),
        'id'            => 'basileia_home_side_space',
        'description'   => 'Espaço para widgets na pagina home',
        'before_widget' => '<section id="basileia-side-banner-area" class="widget basileia basileia-side-banner-area">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>'
) );