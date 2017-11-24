<?php

//To keep members off the administration side and only to the front-end
function upm_custom_login_redirect($redirect, $request, $user) {
    if( $user && is_object($user) && is_a($user, 'WP_User')) {
        if(in_array( 'administrator', $user->roles ) || in_array( 'manager', $user->roles )) {
            $redirect = admin_url();
        } else {
            $redirect = home_url('/profile');
        }
    }
    return $redirect;
}

function upm_custom_logout_redirect($redirect, $request, $user) {
    if( $user && is_object($user) && is_a($user, 'WP_User')) {
        if(in_array( 'administrator', $user->roles ) || in_array( 'manager', $user->roles )) {
            $redirect = admin_url();
        } else {
            $redirect = home_url();
        }
    }
    return $redirect;
}

//Restrict access to profile and edit_profile pages is member is not logged in
function upm_template_redirect() {
    if(is_page('profile') || is_page('edit_profile') || is_page('edit_password')) {
        if(!is_user_logged_in ()) {
            wp_redirect(home_url('/login'));
            exit();
        }
    }
    if(is_page('login') && is_user_logged_in()) {
        wp_redirect('profile');
        exit();
    }
    //redirects for administrator
    global $current_user;
    if(is_page('profile') || is_page('edit_profile') || is_page('edit_password')) {
        if(in_array( 'administrator', $current_user->roles ) || in_array( 'manager', $current_user->roles )) {
            wp_redirect(admin_url());
        }
    }
}