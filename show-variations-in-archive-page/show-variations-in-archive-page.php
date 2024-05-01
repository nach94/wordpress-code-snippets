<?
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_after_shop_loop_item', 'change_template_loop_add_to_cart', 10);
function change_template_loop_add_to_cart()
{
    global $product;

    if (!$product->is_type('variable')) {
        woocommerce_template_loop_add_to_cart();
        return;
    }

    remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
    add_action('woocommerce_single_variation', 'add_loop_variation_add_to_cart_button', 20);
    woocommerce_template_single_add_to_cart();
}


function add_loop_variation_add_to_cart_button()
{
    global $product;
?>
    <div class="woocommerce-variation-add-to-cart variations_button">
        <button type="submit" class="single_add_to_cart_button button"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
        <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
        <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
        <input type="hidden" name="variation_id" class="variation_id" value="0" />
    </div>
<?php
}
?>