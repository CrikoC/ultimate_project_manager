<?php
function upm_check_milestone_name_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix .'upm_milestones';
    $name = $_GET['name'];
    $sql = "SELECT * FROM ".$table_name." WHERE name = '$name'";

    $wpdb->get_results($sql);
    $rows = $wpdb->num_rows;

    if($rows == 0) {
        echo "available";
    } else {
        echo "exists";
    }
}
