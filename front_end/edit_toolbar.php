<?php


function upm_remove_nodes_toolbar($wp_toolbar) {
    global $current_user;
    wp_get_current_user();
    if( $current_user && is_object($current_user) && is_a($current_user, 'WP_User')) {
        if ($current_user->has_cap('member')) {
            $wp_toolbar->remove_node('wp-logo');
            $wp_toolbar->remove_node('site-name');
            $wp_toolbar->remove_node('search');
        }
    }
}

//Replace the howdy greeting
function upm_replace_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $new_title = str_replace( 'Howdy,', 'Welcome,', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $new_title,
    ) );
}

//Replace the avatar with the uploaded image, stored in the user meta table
function upm_get_avatar($avatar = '') {
    global $current_user;
    wp_get_current_user();

    if( $current_user && is_object($current_user) && is_a($current_user, 'WP_User')) {
        if ($current_user->has_cap('partner') && !empty($current_user->user_image)) {
            $avatar = wp_get_attachment_image_url($current_user->user_image,'thumbnail', false);
        } else {
            $avatar = get_avatar_url($current_user->ID);
        }
    }
    return "<img class='avatar avatar-64 photo' src='" . $avatar . "'>";
}

//Function for replacing nodes
function upm_edit_admin_bar($id, $property, $value) {
    global $wp_admin_bar;
    global $current_user;
    wp_get_current_user();

    if($current_user && is_object($current_user) && is_a($current_user, 'WP_User')) {
        if ($current_user->has_cap('partner')) {
            if(!is_array($id)) {
                $id = [$id];
            }
            $all_nodes = $wp_admin_bar->get_nodes();

            foreach($all_nodes as $key => $val) {
                $current_node = $all_nodes[$key];
                $wp_admin_bar->remove_node($key);

                if(in_array($key, $id)) {
                    $current_node->$property = $value;
                }
                $wp_admin_bar->add_node($current_node);
            }
        }
    }
}
