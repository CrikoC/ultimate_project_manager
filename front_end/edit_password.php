<?php
function upm_edit_password_page() {
    //post status and options
    $post = [
        'comment_status'    => 'closed',
        'ping_status'       => 'closed',
        'post_author'       => 1,
        'post_date'         => date('Y-m-d H:i:s'),
        'post_name'         => 'edit_password',
        'post_status'       => 'publish' ,
        'post_title'        => 'Edit Password',
        'post_type'         => 'page',
        'post_content'      => '[edit_password_content]'
    ];
    //insert page and save the id
    $new_page = wp_insert_post( $post, false );
    //save the id in the database
    update_option( 'hclpage', $new_page );
}

function upm_edit_password_content($atts, $content = null) {
    ob_start();
    upm_custom_update_pass_function();
    ob_flush();
}


function upm_password_reset( $current_user, $new_pass ) {
    global $current_user;
    wp_get_current_user();
    wp_update_user(['ID' => $current_user->ID, 'user_pass' => $new_pass]);
    wp_redirect(home_url('profile'));
    exit;
}

function upm_custom_update_pass_function() {
    global $current_user;
    get_current_user();
    global $edit_errors;
    $edit_errors = new WP_Error;

if (isset($_POST['update'])) {
    $new_pass = $_POST['new_user_pass'];
    $repeat_new_pass = $_POST['repeat_new_pass'];

    /* Update user password. */
    if (!empty($new_pass) && !empty($repeat_new_pass)) {
        if ($new_pass == $repeat_new_pass) {
            wp_update_user([
                'ID' => $current_user->ID,
                'user_pass' => esc_attr($new_pass)
            ]);
            $_SESSION['message'] = 'Password updated!';
            echo $_SESSION['message'];
        } else {
            $edit_errors->add('new_pass', __('The passwords you entered does not match.  Your password was not updated.'));
        }
    }

    if (is_wp_error($edit_errors)) {
        foreach ($edit_errors->get_error_messages() as $error) {
            echo '<div>';
            echo '<strong>ERROR</strong>:';
            echo $error . '<br/>';
            echo '</div>';
        }
    }

    $_SESSION['message'] = "Password has been updated!";
    //custom redirect to prevent the "modify header" error
    add_action ('template_redirect', 'mp_password_redirect');
}
function upm_password_redirect() {
    wp_redirect(home_url('profile'));
    exit;
}
?>
<h2>Change Password</h2>
<form action="<?php the_permalink(); ?>" method="post">
    <div>
        <label for="new_user_pass">New Password:</label>
        <input type="password" id="new_user_pass" name="new_user_pass">
        <br/>
        <label for="repeat_new_pass">Create New Password:</label>
        <input type="password" id="repeat_new_pass" name="repeat_new_pass">
    </div>
    <br/>
    <input type="submit" id="update" name="update" value="Save Changes">
    <a href="<?php echo home_url('edit_profile'); ?>">Back to Profile editing</a>
</form>

<?php
}


