<?php
function upm_edit_profile_page() {
    //post status and options
    $post = [
        'comment_status'    => 'closed',
        'ping_status'       => 'closed',
        'post_author'       => 1,
        'post_date'         => date('Y-m-d H:i:s'),
        'post_name'         => 'edit_profile',
        'post_status'       => 'publish' ,
        'post_title'        => 'Edit Profile',
        'post_type'         => 'page',
        'post_content'      => '[edit_profile_content]'
    ];
    //insert page and save the id
    $new_page = wp_insert_post( $post, false );
    //save the id in the database
    update_option( 'hclpage', $new_page );
}

function upm_edit_profile_content($atts, $content = null) {
    ob_start();
    upm_custom_update_function();
    ob_flush();
}

function upm_custom_update_function() {
    global $current_user;
    wp_get_current_user();

    global $edit_errors;
    $edit_errors = new WP_Error;

    if (isset($_POST['update'])) {
        $user_email = $_POST['user_email'];
        $user_url   = $_POST['user_url'];
        $telephone  = $_POST['telephone'];
        $cellphone  = $_POST['cellphone'];

        /* Update user email. */
        if (!empty($user_email)){
            if (!is_email(esc_attr($user_email))) {
                $edit_errors->add('user_email', __('The Email you entered is not valid.  please try again.'));
            }
            elseif(email_exists(esc_attr($user_email)) && $user_email != $current_user->user_email) {
                $edit_errors->add('user_email', __('This email is already used by another user.'));
            } else {
                wp_update_user(['ID' => $current_user->ID, 'user_email' => esc_attr($user_email)]);
            }
        }
        /* Update user url. */
        wp_update_user(['ID' => $current_user->ID, 'user_url' => esc_url($user_url)]);

        /* Update profile picture */
        if (!function_exists('wp_generate_attachment_metadata')){
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        }
        //if the user decides to select a new picture, first the old one must be deleted
        if(isset($_FILES['user_image'])) {
            if ($_FILES) {
                wp_delete_attachment($current_user->user_image);
                delete_user_meta($current_user->ID, 'user_image', $current_user->user_image);

                foreach ($_FILES as $file => $array) {
                    if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                        return "upload error : " . $_FILES[$file]['error'];
                    }
                    $attach_id = media_handle_upload($file, $current_user->ID);
                }
            }
            if ($attach_id > 0) {
                //and if you want to set that image as Post  then use:
                add_user_meta($current_user->ID, 'user_image', $attach_id);
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

        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);

        update_user_meta($current_user->ID, 'telephone', $telephone);
        update_user_meta($current_user->ID, 'cellphone', $cellphone);

        $_SESSION['message'] = "Your profile has been updated!";

        //custom redirect to prevent the "modify header" error
        add_action ('template_redirect', 'mp_edit_redirect');

        function upm_edit_redirect() {
            wp_redirect(home_url('/profile'));
            exit;
        }
    }
    ?>
    <h1>Edit Profile</h1>
    <a href="<?php echo home_url('edit_profile'); ?>">Edit Password</a>
    <form action="<?php the_permalink(); ?>" method="post" enctype="multipart/form-data">
        <hr>
        <div>
            <label for="user_email"><?php echo __("Email:"); ?></label>
            <input type="email" id="user_email" name="user_email" value="<?php echo $current_user->user_email; ?>" placeholder="example@example.com" required>
        </div>
        <br/>
        <div>
            <label for="user_url"><?php echo __("Website:"); ?></label>
            <input type="url" id="user_url" name="user_url" value="<?php echo $current_user->user_url; ?>" placeholder="http://my-site.com">
        </div>
        <br/>
        <div>
            <label for="telephone"><?php echo __("Telephone:"); ?></label>
            <input type="text" id="telephone" name="telephone" value="<?php echo $current_user->telephone; ?>" placeholder=" Numbers only" required>
        </div>
        <br/>
        <div>
            <label for="cellphone"><?php echo __("Cellphone:"); ?></label>
            <input type="text" id="cellphone" name="cellphone" value="<?php echo $current_user->cellphone; ?>" placeholder=" Numbers only" required>
        </div>
        <br/>
        <strong>Profile Image:</strong><br/>
        <input type="file" name="user_image" id="user_image" />
        <hr>
        <input type="submit" id="update" name="update" value="Save Changes">
    </form>
    <?php
}
