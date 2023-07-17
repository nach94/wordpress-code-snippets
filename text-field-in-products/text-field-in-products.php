<?php
function display_text_field() {

// show custom field in product page.
	echo '
    <div class="custom-field-wrapper" id="customDiv" style="display: none;">
        <label for="custom-field">Detalle como quiere su pedido:</label>
        <br>
        <input class="input-detalle" type="text" id="custom-field" name="custom-field" value="">
    </div>
    <br>

    <!– Optional script to display field on select any product variation –>

    <script>
        var selectBox = document.getElementById("___ID PRODUCT SELECTOR___");
        var customDiv = document.getElementById("customDiv");
        selectBox.addEventListener("change", function() {
        var selectedValue = selectBox.value;
        if (selectedValue === "___VALUE NAME TO COMPARE___") {customDiv.style.display = "block";}
        else {customDiv.style.display = "none";}
        });
    </script>';
}
add_action( 'woocommerce_before_add_to_cart_button', 'display_text_field', 10, 0 );

// OPTIONAL: Validate custom field
function field_validation( $passed, $product_id, $quantity  ) {
	if( isset( $_REQUEST['custom-field'] ) && empty($_REQUEST['custom-field'])) {
		$passed = false;
		wc_add_notice( 'ERROR TEXT WHEN INPUT IS EMPTY', 'error' );
	}
	return $passed;
}
add_filter( 'woocommerce_add_to_cart_validation', 'field_validation', 10, 3 );

// Add field data to the cart
function add_text_field_to_cart( $cart_item_data, $product_id, $variation_id ) {
	if( ! empty( $_REQUEST['custom-field'] ) ) {
		$cart_item_data['custom-field'] = sanitize_text_field($_REQUEST['custom-field']);
	}
	return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'add_text_field_to_cart', 10, 3 );

// Display field in the cart
function display_text_field_to_cart( $item_name, $cart_item, $cart_item_key ) {
	if ( isset($cart_item['custom-field']) ){
		$item_name .= sprintf("<p>TEXT BEFORE THE VALUE TYPED BY THE USER IN THE TEXT INPUT: %s </p>", $cart_item['custom-field']);
	}
	return $item_name;
}
add_filter( 'woocommerce_cart_item_name', 'display_text_field_to_cart', 10, 3 );

// Add custom field to order
function add_field_to_order( $item, $cart_item_key, $values, $order ) {
	if ( isset( $values['custom-field'] )){
		$item->add_meta_data( 'TEXT BEFORE THE VALUE TYPED BY THE USER IN THE TEXT INPUT: ', $values['custom-field'], true );
	}
}
add_action( 'woocommerce_checkout_create_order_line_item', 'add_field_to_order', 10, 4 );