<?php
// Add tags filter in Woocommerce product admin panel
function product_admin_filter_by_tags() {
	// Get current screen
	$screen = get_current_screen();
	
	// Check if current screen is product post type
	if ( $screen->post_type === 'product' ) {
		// Get all product tags
		$tags = get_terms( array(
			'taxonomy'   => 'product_tag',
			'hide_empty' => false,
		) );

		// Output the filter dropdown
		?>
		<select name="product_tag" id="product-tag-filter">
			<option value=""><?php esc_html_e( 'All tags', 'text-domain' ); ?></option>
			<?php foreach ( $tags as $tag ) : ?>
				<option value="<?php echo esc_attr( $tag->slug ); ?>"><?php echo esc_html( $tag->name ); ?></option>
			<?php endforeach; ?>
		</select>
		<?php
		
		// Add filter for the query
		add_action( 'pre_get_posts', 'product_admin_filter_by_tags_query' );
	}
}
add_action( 'restrict_manage_posts', 'product_admin_filter_by_tags' );

// Handle the query by tag filter 
function product_admin_filter_by_tags_query( $query ) {
	// Get current screen
	$screen = get_current_screen();

	// Check if current screen is product post type
	if ( $screen->post_type === 'product' && isset( $_GET['product_tag'] ) ) {
		$tag_slug = sanitize_text_field( $_GET['product_tag'] );

		if ( $tag_slug ) {
			$query->set( 'tax_query', array(
				array(
					'taxonomy' => 'product_tag',
					'field'    => 'slug',
					'terms'    => $tag_slug,
				),
			) );
		}
	}
}