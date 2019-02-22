<?php

// Add term page
function basileia_add_img_meta_field() {
	// this will add the custom img field to the add new term page
	?>
	<div class="form-field">
		<label for="term_img"><?php _e( 'Imagem', 'basileia' ); ?></label>
		<input type="text" name="term_img" id="term_img" value="">
		<p class="description"><?php _e( 'Adicione uma imagem','basileia' ); ?></p>
	</div>
<?php
}
add_action( 'pa_editora_add_form_fields', 'basileia_add_img_meta_field', 10, 2 );


// Edit term page
function basileia_edit_img_meta_field($term) {
	
	// put the term ID into a variable
	$t_id = $term->term_id;
	
	// retrieve the existing value(s) for this img field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_img"><?php _e( 'Imagem', 'basileia' ); ?></label></th>
		<td>
			<input type="text" name="term_img" id="term_img" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">
			<p class="description"><?php _e( 'Adicione uma imagem','basileia' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'pa_editora_edit_form_fields', 'basileia_edit_img_meta_field', 10, 2 );

// Save extra taxonomy img callback function.
function save_taxonomy_img_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_pa_editora', 'save_taxonomy_img_meta', 10, 2 );  
add_action( 'create_pa_editora', 'save_taxonomy_img_meta', 10, 2 );

