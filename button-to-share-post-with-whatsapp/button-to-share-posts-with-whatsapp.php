<?php

function add_wpp_button() {
	
	//Get permalink from post with Wordpress native function and put it into this variable.
    $url = get_permalink();
	
	//Get the post title with Wordpress native function and put it into this variable.
	$post_title = get_the_title();
	
	//This variable contains the url structure for send whatsapp message with custom text. In this case, we concatenate last variables to generate dynamic url.
    $whatsapp_link = 'https://api.whatsapp.com/send?text=' . rawurlencode($post_title . ': ' . $url);
	
	//This variable contains the structure for anchor <a> for button to share posts with whatsapp.
    $whatsapp_button = '<a href="' . esc_url($whatsapp_link) . '" target="_blank" rel="nofollow" class="whatsapp-button">Share with Whatsapp</a>';
	
	//Print the whatsapp button.
	echo $whatsapp_button;
}

//Select the hook what you want to print the button to share posts with Whatsapp and paste between the firsts quotation marks. You can use WP HOOKS FINDER plugin to catch that hook.
add_filter('PASTE_THE_HOOK_HERE', 'add_wpp_button');

?>