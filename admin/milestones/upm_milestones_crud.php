<?php
/***********************************************/
/*                   CREATE                    */
/***********************************************/
    function upm_milestones_create_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_milestones";
        $id             = $_POST["id"];
        $name           = $_POST["name"];
        $slug           = $_POST["slug"];
        $description    = $_POST["description"];
        $project_id     = $_POST['project_id'];
        $wp_id          = $_POST['wp_id'];
        $coordinator_id = $_POST["coordinator_id"];
        $mil_date       = date("Y-m-d",strtotime($_POST["mil_date"]));
        $reminder       = date("Y-m-d",strtotime($_POST["reminder"]));

    if($id != "" || $name != "" || $slug != "") {
        $wpdb->insert(
            $table_name,            //table
            [
                'id'                => $id,
                'name'              => $name,
                'slug'              => $slug,
                'description'       => $description,
                'project_id'        => $project_id,
                'wp_id'             => $wp_id,
                'coordinator_id'    => $coordinator_id,
                'mil_date'          => $mil_date,
                'reminder'          => $reminder,
                'status'            => 'in_progress',
                'completed'         => 0
            ],                      //data
            ['%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s']//data format
        );
    }
}
/***********************************************/


/***********************************************/
/*                   UPDATE                    */
/***********************************************/
function upm_milestones_update_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_milestones";
    $id             = $_POST["id"];
    $name           = $_POST["name"];
    $slug           = $_POST["slug"];
    $description    = $_POST["description"];
    $project_id     = $_POST['project_id'];
    $wp_id          = $_POST['wp_id'];
    $coordinator_id = $_POST["coordinator_id"];
    $mil_date       = $_POST["mil_date"];
    $reminder       = $_POST["reminder"];

    if(isset($_POST['completed'])) {
        $completed = $_POST['completed'];
    } else {
        $completed = 0;
    }

    if($name != "" || $slug != "") {
        $wpdb->update(
            $table_name,        //table
            [
                'name'              => $name,
                'slug'              => $slug,
                'description'       => $description,
                'project_id'        => $project_id,
                'wp_id'             => $wp_id,
                'coordinator_id'    => $coordinator_id,
                'mil_date'          => $mil_date,
                'reminder'          => $reminder,
                'completed'         => $completed
            ],                  //data
            ['id' => $id],      //where
            ['%s','%s','%s','%s','%s','%s','%s','%s','%s','%s']//data format
            ['%s']              //where format
        );
    }
}
/***********************************************/


/***********************************************/
/*                   DELETE                    */
/***********************************************/
function upm_milestones_delete_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_milestones";
    $id = $_POST["id"];
    $wpdb->delete(
        $table_name,        //table
        ['id' => $id],      //where
        ['%s']              //where format
    );
}
/***********************************************/