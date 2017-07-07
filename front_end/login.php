<?php
function upm_login_page()
{
    //post status and options
    $post = [
        'comment_status'    => 'closed',
        'ping_status'       => 'closed' ,
        'post_author'       => 1,
        'post_date'         => date('Y-m-d H:i:s'),
        'post_name'         => 'login',
        'post_status'       => 'publish' ,
        'post_title'        => 'Log In',
        'post_type'         => 'page',
        'post_content'      => '[login_content]'
    ];
    //insert page and save the id
    $new_page = wp_insert_post( $post, false );
    //save the id in the database
    update_option( 'hclpage', $new_page );
}

function upm_login_content($atts, $content = null) {
    $args = [
        'echo'           => true,
        'redirect'       => home_url('/wp-admin/'),
        'form_id'        => 'loginform',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in'   => __( 'Log In' ),
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'remember'       => true,
        'value_username' => NULL,
        'value_remember' => true
    ];

    // Calling the login form.
    wp_login_form($args);
}

