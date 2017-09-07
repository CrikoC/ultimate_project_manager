<?php
/***********************************************/
/*                   CREATE                    */
/***********************************************/
function upm_users_create_callback() {

    $user_login = sanitize_user($_POST['user_login']);
    $password   = esc_attr($_POST['password']);
    $email      = sanitize_email($_POST['user_email']);
    $user_url    = esc_url( $_POST['user_url']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name  = sanitize_text_field($_POST['last_name']);
    $manager_id = $_POST['manager_id'];
    $telephone  = $_POST['telephone'];
    $cellphone  = $_POST['cellphone'];

    $user_data = [
        'user_login'    => $user_login,
        'user_email'    => $email,
        'user_pass'     => $password,
        'user_url'      => $user_url,
        'first_name'    => $first_name,
        'last_name'     => $last_name,
        'user_nicename' => $first_name.' '.$last_name,
        'role'          => 'partner'
    ];

    $user_id = wp_insert_user($user_data);

    add_user_meta($user_id, 'manager_id',$manager_id);
    add_user_meta($user_id, 'telephone', $telephone);
    add_user_meta($user_id, 'cellphone', $cellphone);
}
/***********************************************/


/***********************************************/
/*                    READ                     */
/***********************************************/
function upm_users_read_callback() {
    global $current_user;
    get_current_user();

    $args = [
        'role' => 'partner',
        'manager_id' => $current_user->ID
    ];

    $partners_query = new WP_User_Query($args);
    $partners = $partners_query->get_results();
    if (!empty($partners)) {
        foreach($partners  as $partner) {
            if(!empty(wp_get_attachment_image($partner->user_image))) {
                $avatar = wp_get_attachment_image_url($partner->user_image,'thumbnail', false);
            } else {
                $avatar = get_avatar_url($partner->ID);
            }

            echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">';
                echo '<div class="card" style="width: 20rem;">';
                    echo '<input type="hidden" id="user_id" name="user_id" value="'.$partner->ID.'">';
                    echo '<input type="hidden" id="user_login" name="user_login" value="'.$partner->user_login.'">';
                    echo '<input type="hidden" id="role" name="role" value="'.$partner->role.'">';
                    echo '<div class="card-block text-center">';
                        echo '<img class="card-img-top img-circle"  src="'.$avatar.'" alt="'.$partner->display_name.'">';
                    echo '</div>';
                    echo '<div class="card-block">';
                        echo '<h4 class="card-title text-center"><span id="first_name">'.$partner->first_name.'</span> <span id="last_name">'.$partner->last_name.'</span></h4>';
                        echo '<p class="card-text text-center" id="user_email">'.$partner->user_email.'</p>';
                    echo '</div>';
                    echo '<table class="table table-responsive">';
                        echo '<tr><td><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span></td><td id="telephone"> ';
                            echo $partner->telephone;
                        echo '</td></tr>';
                        echo '<tr><td><span class="glyphicon glyphicon-phone" aria-hidden="true"></span></td><td id="cellphone">';
                            echo $partner->cellphone;
                        echo '</td></tr>';
                        echo '<tr><td><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></td><td id="user_url">';
                            echo $partner->user_url;
                        echo '</td></tr>';
                    echo '</table>';
                    echo '<div class="card-block text-center">';
                        echo "<button type='button' class='btn btn-primary edit-user' data-toggle='modal' data-target='#edit-user'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button> ";
                        //echo "<button type='button' class='btn btn-warning edit-user-password' data-toggle='modal' data-target='#edit-user-password'><span class='glyphicon glyphicon-lock' aria-hidden='true'></span></span></button> ";
                        echo "<button type='button' class='btn btn-danger remove-user' data-toggle='modal' data-target='#remove-user'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="col-md-3 col-sm-4"><div class="alert alert-warning">No Partners were found.</div></div>';
    }
}

/***********************************************/


/***********************************************/
/*                   UPDATE                    */
/***********************************************/
function upm_users_update_callback() {
    $user_id    = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $user_email = $_POST['user_email'];
    $user_url   = $_POST['user_url'];
    $telephone  = $_POST['telephone'];
    $cellphone  = $_POST['cellphone'];

    wp_update_user(['ID' => $user_id, 'first_name'  => $first_name]);
    wp_update_user(['ID' => $user_id, 'last_name'   => $last_name]);
    wp_update_user(['ID' => $user_id, 'user_email'  => $user_email]);
    wp_update_user(['ID' => $user_id, 'user_url'    => esc_url($user_url)]);

    update_user_meta($user_id, 'telephone', $telephone);
    update_user_meta($user_id, 'cellphone', $cellphone);
}

//function upm_users_update_password_callback() {
//    $user_id = $_POST['user_id'];
//    $new_pass = $_POST['new_pass'];
//    $repeat_new_pass = $_POST['repeat_new_pass'];
//
//    /* Update user password. */
//    if (!empty($new_pass) && !empty($repeat_new_pass)) {
//        if ($new_pass == $repeat_new_pass) {
//            wp_update_user(['ID' => $user_id, 'user_pass' => $new_pass]);
//        }
//    }
//}
/***********************************************/


/***********************************************/
/*                   DELETE                    */
/***********************************************/
function upm_users_delete_callback() {
    $user_id = $_POST['user_id'];
    require_once(ABSPATH.'wp-admin/includes/user.php');
    wp_delete_user($user_id);
}
/***********************************************/