<?php
add_filter('wp_nav_menu_items', 'do_shortcode');
add_shortcode('woo_cart_count', 'woo_cart_count');

function woo_cart_count()
{
    ob_start();
    $items_count = WC()->cart->get_cart_contents_count(); ?>
    <a href="https://ninayco.helloeveryone.me/carrito/" class="prod_count">
        <svg width="22" height="25" viewBox="0 0 22 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.91641 10.0159C1.96195 9.43953 2.21956 8.90172 2.63793 8.50959C3.0563 8.11746 3.60473 7.89978 4.174 7.8999H17.826C18.3953 7.89978 18.9437 8.11746 19.3621 8.50959C19.7804 8.90172 20.038 9.43953 20.0836 10.0159L20.9927 21.5159C21.0177 21.8324 20.978 22.1507 20.8759 22.4508C20.7739 22.7509 20.6118 23.0263 20.3998 23.2596C20.1879 23.4929 19.9306 23.6792 19.6443 23.8066C19.358 23.934 19.0489 23.9998 18.7363 23.9999H3.26372C2.95115 23.9998 2.64198 23.934 2.35568 23.8066C2.06938 23.6792 1.81215 23.4929 1.60018 23.2596C1.38822 23.0263 1.22611 22.7509 1.12407 22.4508C1.02202 22.1507 0.982252 21.8324 1.00726 21.5159L1.91641 10.0159V10.0159Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M15.5287 11.35V5.6C15.5287 4.38 15.0516 3.20998 14.2023 2.34731C13.353 1.48464 12.2011 1 11 1C9.79886 1 8.64695 1.48464 7.79764 2.34731C6.94833 3.20998 6.47119 4.38 6.47119 5.6V11.35" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span class="mini_cart_count"><?php echo $items_count ? $items_count : '0'; ?></span>
    </a>
<?php
    return ob_get_clean();
}

add_filter('woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
function wc_refresh_mini_cart_count($fragments)
{
    ob_start();
    $items_count = WC()->cart->get_cart_contents_count(); ?>
    <span class="mini_cart_count"><?php echo $items_count ? $items_count : '0'; ?></span>
<?php
    $fragments['.mini_cart_count'] = ob_get_clean();
    return $fragments;
}
?>