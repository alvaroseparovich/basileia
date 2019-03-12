<?php

// basileia banner com imagem
class banner_img extends WP_Widget {
	function __construct() {
		$widget_ops = array(
					'classname'   => 'banner collection-wrapper clearfix',
					'description' => esc_html__( 'Display a responsive banner.', 'basileia' ) );
		$control_ops = array(
				'width'  => 200,
				'height' => 250
			);
		parent::__construct( false, $name = esc_html__( 'A-C: banner', 'basileia' ), $widget_ops, $control_ops);
	}

	function form( $instance ) {

		$defaults[ 'attr_link1' ]   = '';
		$defaults[ 'attr_image_1' ]  = '';
		$defaults[ 'attr_image_2' ]  = '';
		$defaults[ 'lazy' ]  = '';
		$defaults[ 'bg_color' ]  = '';

		$instance = wp_parse_args( (array) $instance, $defaults );

		$attr_link1 = esc_url( $instance[ 'attr_link1' ] );
		$attr_image_1 = esc_url( $instance[ 'attr_image_1' ] );
		$attr_image_2 = esc_url( $instance[ 'attr_image_2' ] );
		$lazy = $instance[ 'lazy' ];
		$bg_color = $instance[ 'bg_color' ];
		?>
		<label><h3><?php esc_html_e( 'Add your First Image here.', 'estore' ); ?></h3></label>
		<p>
			<label for="<?php echo $this->get_field_id( 'lazy' ); ?>"> <?php esc_html_e( 'Carregamento tardío', 'basileia' ); ?></label>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'lazy' ); ?>" name="<?php echo $this->get_field_name( 'lazy' ); ?>" <?php checked( $instance[ 'lazy' ], 'on' ); ?>/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'bg_color' ); ?>"> <?php esc_html_e( 'Cor do Background', 'estore' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'bg_color' ); ?>" name="<?php echo $this->get_field_name( 'bg_color' ); ?>" value="<?php echo $instance[ 'bg_color' ]; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'attr_link1' ); ?>"> <?php esc_html_e( 'Link', 'estore' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'attr_link1' ); ?>" name="<?php echo $this->get_field_name( 'attr_link1' ); ?>" value="<?php echo $instance[ 'attr_link1' ]; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'attr_image_1' ); ?>"> <?php esc_html_e( 'Image full', 'estore' ); ?></label>
			<div class="media-uploader" id="<?php echo $this->get_field_id( 'attr_image_1' ); ?>">
				<div class="custom_media_preview">
					<?php if ( $instance[ 'attr_image_1' ] != '' ) : ?>
						<img class="custom_media_preview_default" src="<?php echo esc_url( $instance[ 'attr_image_1' ] ); ?>" id="<?php echo $this->get_field_id( 'attr_image_1' ); ?>" style="max-width:100%;" />
					<?php endif; ?>
				</div>
				<input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id( 'attr_image_1' ); ?>" name="<?php echo $this->get_field_name( 'attr_image_1' ); ?>" value="<?php echo esc_url( $instance['attr_image_1'] ); ?>" style="margin-top:5px;" />
				<button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id( 'attr_image_1' ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'estore' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'estore' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select Full Banner', 'estore' ); ?></button>
			</div>
		</p>
		<hr>
		<p>
			<label for="<?php echo $this->get_field_id( 'attr_image_2' ); ?>"> <?php esc_html_e( 'Image mobile', 'estore' ); ?></label>
			<div class="media-uploader" id="<?php echo $this->get_field_id( 'attr_image_2' ); ?>">
				<div class="custom_media_preview">
					<?php if ( $instance[ 'attr_image_2' ] != '' ) : ?>
						<img class="custom_media_preview_default" src="<?php echo esc_url( $instance[ 'attr_image_2' ] ); ?>" id="<?php echo $this->get_field_id( 'attr_image_2' ); ?>"  style="max-width:100%;" />
					<?php endif; ?>
				</div>
				<input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id( 'attr_image_2' ); ?>" name="<?php echo $this->get_field_name( 'attr_image_2' ); ?>" value="<?php echo esc_url( $instance['attr_image_2'] ); ?>" style="margin-top:5px;" />
				<button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id( 'attr_image_2' ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'estore' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'estore' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select Mobile Banner', 'estore' ); ?></button>
			</div>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'attr_link1' ] = esc_url_raw( $new_instance[ 'attr_link1' ]);
		$instance[ 'attr_image_1' ] = esc_url_raw( $new_instance[ 'attr_image_1' ] );
		$instance[ 'attr_image_2' ]  = esc_url_raw( $new_instance[ 'attr_image_2' ] );
		$instance[ 'lazy' ]  = $new_instance[ 'lazy' ];
		$instance[ 'bg_color' ]  = $new_instance[ 'bg_color' ];

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		global $post;
		$attr_link1   = isset( $instance[ 'attr_link1' ] ) ? $instance[ 'attr_link1' ] : '';
		$attr_image_1   = isset( $instance[ 'attr_image_1' ] ) ? $instance[ 'attr_image_1' ] : '';
		$attr_image_2    = isset( $instance[ 'attr_image_2' ] ) ? $instance[ 'attr_image_2' ] : '';
		$bg_color    = isset( $instance[ 'bg_color' ] ) ? $instance[ 'bg_color' ] : '';
		$lazy    = $instance[ 'lazy' ]? 'true' : 'false';
        echo $before_widget; ?>
        
            <div class="collection-block banner-adaptive">
                <a href="<?php echo esc_url( $attr_link1 ); ?>" target="_blank">
                <figure class="banner-adaptive-img" style="background:<?=$bg_color?>;">
                <?php
                if(!$lazy){
                    ?>
                    <picture>
                        <source media="(min-width: 600px)" srcset="<?=esc_url( $attr_image_1)?>">
                        <img src="<?=esc_url( $attr_image_2 )?>" alt="Flowers" style="width:auto;">
                    </picture>
                    <?php
                }else{
                    if ( $attr_image_1 and $attr_image_2 ) {                            
                        echo "<img class='fll' src='{$attr_image_1}'/> <img class='mb' src='{$attr_image_2}'/>";
                }}
                ?>
                </figure>
            </a>
            </div>

			<?php
		echo $after_widget;
	}
}