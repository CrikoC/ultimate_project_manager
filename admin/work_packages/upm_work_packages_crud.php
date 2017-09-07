<?php
/***********************************************/
/*                   CREATE                    */
/***********************************************/
function upm_work_packages_create_callback() {
    global $wpdb;
    $table_name     = $wpdb->prefix . "upm_work_packages";
    $id             = $_POST["id"];
    $name           = $_POST["name"];
    $slug           = $_POST["slug"];
    $description    = $_POST["description"];
    $project_id     = $_POST['project_id'];
    $coordinator_id = $_POST["coordinator_id"];
    $start_date     = date("Y-m-d",strtotime($_POST["start_date"]));
    $end_date       = date("Y-m-d",strtotime($_POST["end_date"]));
    $reminder       = date("Y-m-d",strtotime($_POST["reminder"]));
    
    if($id != "" || $name != "" || $slug != "") {
        $wpdb->insert(
            $table_name,            //table
            [
                'id'                => trim($id),
                'name'              => trim($name),
                'slug'              => trim($slug),
                'description'       => trim($description),
                'project_id'        => trim($project_id),
                'coordinator_id'    => trim($coordinator_id),
                'start_date'        => trim($start_date),
                'end_date'          => trim($end_date),
                'reminder'          => trim($reminder),
                'status'            => trim('in_progress'),
            ]                      //data
        );
    }
}
/***********************************************/


/***********************************************/
/*                   UPDATE                    */
/***********************************************/
function upm_work_packages_update_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_work_packages";
    $id             = $_POST["id"];
    $name           = $_POST["name"];
    $slug           = $_POST["slug"];
    $description    = $_POST["description"];
    $project_id     = $_POST['project_id'];
    $coordinator_id = $_POST["coordinator_id"];
    $start_date     = date("Y-m-d h:i:s",strtotime($_POST["start_date"]));
    $end_date       = date("Y-m-d h:i:s",strtotime($_POST["end_date"]));
    $reminder       = date("Y-m-d h:i:s",strtotime($_POST["reminder"]));

    if($name != "" || $slug != "") {
        $wpdb->update(
            $table_name,        //table
            [
                'name'              => trim($name),
                'slug'              => trim($slug),
                'description'       => trim($description),
                'project_id'        => trim($project_id),
                'coordinator_id'    => trim($coordinator_id),
                'start_date'        => trim($start_date),
                'end_date'          => trim($end_date),
                'reminder'          => trim($reminder),
            ],                  //data
            ['id' => $id]       //where
        );
    }
}
/***********************************************/


/***********************************************/
/*                   DELETE                    */
/***********************************************/
function upm_work_packages_delete_callback() {
    global $wpdb;
    $wp_table_name = $wpdb->prefix . "upm_work_packages";
    $id = $_POST["id"];
    $wpdb->delete(
        $wp_table_name,        //table
        ['id' => $id]      //where
    );

    $tasks_table_name = $wpdb->prefix . "upm_tasks";
    $wpdb->delete(
        $tasks_table_name,
        ['wp_id' => $id]
    );

    $mil_table_name = $wpdb->prefix . "upm_milestones";
    $wpdb->delete(
        $mil_table_name,
        ['wp_id' => $id]
    );

}
/***********************************************/