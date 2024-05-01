<?php
dd_action('woocommerce_before_quantity_input_field', 'btn_before_input_qty_field');
function btn_before_input_qty_field(){
    echo '<button type="button" class="button button-qty" data-quantity="minus">-</button>';
}

add_action('woocommerce_after_quantity_input_field', 'btn_after_input_qty_field');
function btn_after_input_qty_field(){
    echo '<button type="button" class="button button-qty" data-quantity="plus">+</button>';
}
?>