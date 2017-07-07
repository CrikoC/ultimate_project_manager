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
                'id'                => $id,
                'name'              => $name,
                'slug'              => $slug,
                'description'       => $description,
                'project_id'        => $project_id,
                'coordinator_id'    => $coordinator_id,
                'start_date'        => $start_date,
                'end_date'          => $end_date,
                'reminder'          => $reminder,
                'status'            => 'in_progress',
            ],                      //data
            ['%s','%s','%s','%s','%s','%s','%s','%s','%s','%s']//data format
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
                'name'              => $name,
                'slug'              => $slug,
                'description'       => $description,
                'project_id'        => $project_id,
                'coordinator_id'    => $coordinator_id,
                'start_date'        => $start_date,
                'end_date'          => $end_date,
                'reminder'          => $reminder,
            ],                  //data
            ['id' => $id],      //where
            ['%s','%s','%s','%s','%s','%s','%s','%s']//data format
            ['%s']              //where format
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
        ['id' => $id],      //where
        ['%s']              //where format
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