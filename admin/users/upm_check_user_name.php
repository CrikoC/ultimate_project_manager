<?php
function upm_check_user_name_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix .'users';
    $user_login = $_GET['user_login'];
    $sql = "SELECT * FROM ".$table_name." WHERE user_login = '$user_login'";

    $wpdb->get_results($sql);
    $rows = $wpdb->num_rows;

    if($rows == 0) {
        echo "available";
    } else {
        echo "exists";
    }
}
