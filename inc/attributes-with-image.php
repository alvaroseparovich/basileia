<?php

// Add term page
function basileia_add_img_meta_field() {
    // this will add the custom img field to the add new term page
    $image = '<img id="attribute-preview-image" src="https://some.default.image.jpg" />';

	?>
    <div class="form-field">
        <?php echo $image; ?>
        <input type="text" name="term_meta[brand_img]" id="term_meta[brand_img]" value="" class="regular-text" />
        <input type='button' class="button-primary" value="<?php esc_attr_e( 'Select a image', 'mytextdomain' ); ?>" id="media_manager_btn"/>
    </div>
    <?php

}
add_action( 'pa_editora_add_form_fields', 'basileia_add_img_meta_field', 10, 2 );


// Edit term page
function basileia_edit_img_meta_field($term) {
	
	// put the term ID into a variable
	$t_id = $term->term_id;
	// retrieve the existing value(s) for this img field. This returns an array
    $term_meta = get_option( "taxonomy_term_$t_id" ); 
        
    if($term_meta['brand_img'] ) {
        // Change with the image size you want to use
        $image = wp_get_attachment_image( $term_meta['brand_img'], 'medium', false, array( 'id' => 'attribute-preview-image' ) );
    } else {
        // Some default image
        $image = '<img id="attribute-preview-image" src="https://some.default.image.jpg" />';
    }
    ?>
	<pre> <?php var_dump($term_meta); ?><pre>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_img"><?php _e( 'Imagem', 'basileia' ); ?></label></th>
		<td>
            <?php echo $image; ?>
            <input type="text" name="term_meta[brand_img]" id="term_meta[brand_img]" value="<?php echo $term_meta['brand_img'] ? $term_meta['brand_img'] : ''; ?>" class="regular-text" />
            <input type='button' class="button-primary" value="<?php esc_attr_e( 'Select a image', 'mytextdomain' ); ?>" id="media_manager_btn"/>
			<br>
			<p class="description" style="color:darkred;"><?php _e( 'SALVE PARA VER A ALTERAÇÃO DA IMAGEM!','basileia' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'pa_editora_edit_form_fields', 'basileia_edit_img_meta_field', 10, 2 );


// Save extra taxonomy img callback function.
function save_taxonomy_img_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_term_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_term_$t_id", $term_meta );
	}
}  
add_action( 'edited_pa_editora', 'save_taxonomy_img_meta', 10, 2 );  
add_action( 'create_pa_editora', 'save_taxonomy_img_meta', 10, 2 );

