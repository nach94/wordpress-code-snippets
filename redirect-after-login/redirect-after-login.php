<?php
// Redirect after successful login
function redirect_after_login($redirect_to, $request, $user) {
    // Specify the URL you want to redirect to after login
    $redirect_url = '___URL_REDIRECTION___';

    if (isset($user->ID)) {
        // Check if the user has a specific role before redirecting
        if (in_array('administrator', $user->roles)) {
            // If you are an admin, redirect to admin panel
            $redirect_url = admin_url();
        }
    }

    return $redirect_url;
}
add_filter('login_redirect', 'redirect_after_login', 10, 3);