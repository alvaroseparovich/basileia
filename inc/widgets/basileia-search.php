<?php
/**
 * Class for adding advertisement widget
 * A new way to add advertisement
 * @package Acme Themes
 * @subpackage Online Shop
 * @since 1.0.0
 */

function basileia_widgets_start() {
	// Widgets Registration
	register_widget( "Basileia_Search_Widget" );
}
add_action( 'widgets_init', 'basileia_widgets_start' );

class Basileia_Search_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
        /*Base ID of your widget*/
            'basileia_product_search',
            /*Widget name will appear in UI*/
            esc_html__('Basileia Product Search', 'basileia'),
            /*Widget description*/
            array( 'description' => esc_html__( 'Search only on products', 'basileia' ), )
        );
    }

    /*defaults values for fields*/
    private $defaults = array(
        'basileia_search_placeholder'  => ''
    );

    public function form( $instance ) {
        /*merging arrays*/
        $instance = wp_parse_args( (array) $instance, $this->defaults);
        $basileia_search_placeholder = esc_attr( $instance['basileia_search_placeholder'] );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'basileia_search_placeholder' ) ); ?>"><?php esc_html_e( 'Placeholder Text', 'online-shop' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'basileia_search_placeholder' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'basileia_search_placeholder' ) ); ?>" type="text" value="<?php echo esc_attr( $basileia_search_placeholder ); ?>" />
        </p>
        <?php
    }

    /**
     * Function to Updating widget replacing old instances with new
     *
     * @access public
     * @since 1.0
     *
     * @param array $new_instance new arrays value
     * @param array $old_instance old arrays value
     * @return array
     *
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['basileia_search_placeholder'] = ( isset( $new_instance['basileia_search_placeholder'] ) ) ?  sanitize_text_field( $new_instance['basileia_search_placeholder'] ): '';

        return $instance;
    }

    /**
     * Function to Creating widget front-end. This is where the action happens
     *
     * @access public
     * @since 1.0
     *
     * @param array $args widget setting
     * @param array $instance saved values
     * @return void
     *
     */
    function widget( $args, $instance ) {
        $instance = wp_parse_args( (array) $instance, $this->defaults);
        global $basileia_search_placeholder;
        $basileia_search_placeholder = esc_attr( $instance['basileia_search_placeholder'] );
        echo $args['before_widget'];
        get_template_part( 'inc/widgets/basileia-search-form' );
        echo $args['after_widget'];
    }
}