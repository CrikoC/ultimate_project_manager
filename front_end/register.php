<?php
function upm_register_page()
{
    //post status and options
    $post = [
        'comment_status'    => 'closed',
        'ping_status'       => 'closed' ,
        'post_author'       => 1,
        'post_date'         => date('Y-m-d H:i:s'),
        'post_name'         => 'register',
        'post_status'       => 'publish' ,
        'post_title'        => 'Register',
        'post_type'         => 'page',
        'post_content'      => '[register_content]'
    ];
    //insert page and save the id
    $new_page = wp_insert_post( $post, false );
    //save the id in the database
    update_option( 'hclpage', $new_page );
}

function upm_register_content($atts, $content = null) {
    ob_start();
    upm_custom_registration();
    return ob_get_clean();
}


function upm_custom_registration() {
    if (isset($_POST['register'])) {
        $username   =  sanitize_user($_POST['username']);
        $password   =  esc_attr($_POST['password']);
        $repeat_password = esc_attr($_POST['repeat_password']);
        $email      =  sanitize_email($_POST['email']);
        $website    =  esc_url( $_POST['website']);
        $first_name =  sanitize_text_field($_POST['first_name']);
        $last_name  =  sanitize_text_field($_POST['last_name']);
        $telephone  =  $_POST['telephone'];
        $cellphone  =  $_POST['cellphone'];

        //ERROR CHECKING
        global $reg_errors;
        $reg_errors = new WP_Error;

        if (empty($username) || empty($password) || empty($email) || empty($first_name) || empty($last_name)) {
          $reg_errors->add('field', __('Required form field is missing'));
        }
        if (4 > strlen($username)) {
          $reg_errors->add( 'username_length', __('Username too short. At least 4 characters is required'));
        }
        if (username_exists($username)) {
          $reg_errors->add('user_name', __('Sorry, that username already exists!'));
        }
        if (!validate_username($username)) {
          $reg_errors->add( 'username_invalid', __('Sorry, the username you entered is not valid'));
        }
        if (5 > strlen($password)) {
          $reg_errors->add( 'password', __('Password length must be greater than 5'));
        }
        if(empty($repeat_password)) {
            $reg_errors->add('password', __('You must repeat the password'));
        }
        if($repeat_password != $password) {
            $reg_errors->add( 'password', __('Password was not repeated correctly'));
        }

        if (!is_email($email)) {
          $reg_errors->add( 'email_invalid', __('Email is not valid'));
        }
        if (email_exists($email)) {
          $reg_errors->add( 'email', __('Email Already in use'));
        }
        if ( is_wp_error( $reg_errors ) ) {
            foreach ( $reg_errors->get_error_messages() as $error ) {
                echo '<div>';
                echo '<strong>ERROR</strong>: ';
                echo $error . '<br/>';
                echo '</div>';
            }
        }

        if (1 > count($reg_errors->get_error_messages())) {
            $user_data = [
              'user_login'    =>   $username,
              'user_email'    =>   $email,
              'user_pass'     =>   $password,
              'role'          =>   'manager',
              'user_url'      =>   $website,
              'first_name'    =>   $first_name,
              'last_name'     =>   $last_name
            ];
            $user = wp_insert_user( $user_data );

            add_user_meta( $user, 'telephone', $telephone);
            add_user_meta( $user, 'cellphone', $cellphone);

            if (!function_exists('wp_generate_attachment_metadata')){
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                require_once(ABSPATH . "wp-admin" . '/includes/media.php');
            }
            if ($_FILES) {
                foreach ($_FILES as $file => $array) {
                    if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                        return "upload error : " . $_FILES[$file]['error'];
                    }
                    $attach_id = media_handle_upload( $file, $user );
                }
            }
            if ($attach_id > 0){
                //and if you want to set that image as Post  then use:
                add_user_meta($user,'user_image',$attach_id);
            }

            echo 'Registration complete. Goto <a href="' . get_site_url() . '/login">login page</a>.';
        }
    }
    ?>
    <h1>Register</h1>
    <form action="<?php the_permalink(); ?>" method="post" enctype="multipart/form-data">
        <hr>
        <h2>Account Info</h2>
        <div>
            <label for="username">User Name:</label>
            <input type="text" id="username" name="username" placeholder="User Name" required>
        </div>
        <br/>
        <div>
            <label for="last_name">Email:</label>
            <input type="email" id="email" name="email" placeholder="example@example.com" required>
        </div>
        <br/>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <br/>
        <div>
            <label for="repeat_password">Repeat Password:</label>
            <input type="password" id="repeat_password" name="repeat_password" placeholder="Repeat Password" required>
        </div>
        <hr>
        <h2>Personal Info</h2>
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
        </div>
        <br/>
        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
        </div>
        <br/>
        <div>
            <label for="telephone">Telephone:</label>
            <input type="text" id="telephone" name="telephone" placeholder="Telephone">
        </div>
        <br/>
        <div>
            <label for="cellphone">Cellphone:</label>
            <input type="text" id="cellphone" name="cellphone" placeholder="Cellphone">
        </div>
        <br/>
        <label for="website">Website:</label>
        <input type="url" name="website" id="website" value="" placeholder="http//your_site.com">
        <br>
        <strong>Profile Image:</strong><br/>
        <input type="file" name="user_image" id="user_image" />
        <hr>
        <input type="submit" id="register" name="register" value="Register">
    </form>
    <?php
}
