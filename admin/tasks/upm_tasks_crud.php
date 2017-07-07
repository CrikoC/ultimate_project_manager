<?php
/***********************************************/
/*                   CREATE                    */
/***********************************************/
function upm_tasks_create_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_tasks";
    $id             = $_POST["id"];
    $name           = $_POST["name"];
    $slug           = $_POST["slug"];
    $description    = $_POST["description"];
    $project_id     = $_POST['project_id'];
    $wp_id          = $_POST['wp_id'];
    $partner_id     = $_POST["partner_id"];
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
                'wp_id'             => $wp_id,
                'partner_id'        => $partner_id,
                'start_date'        => $start_date,
                'end_date'          => $end_date,
                'reminder'          => $reminder,
                'status'            => 'in_progress',
                'completed'         => 0
            ],                      //data
            ['%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s']//data format
        );
    }
}
/***********************************************/


/***********************************************/
/*                   UPDATE                    */
/***********************************************/
function upm_tasks_update_callback() {
    global $wpdb;
    $table_name     = $wpdb->prefix . "upm_tasks";
    $id             = $_POST["id"];
    $name           = $_POST["name"];
    $slug           = $_POST["slug"];
    $description    = $_POST["description"];
    $project_id     = $_POST['project_id'];
    $partner_id     = $_POST["partner_id"];
    $start_date     = $_POST["start_date"];
    $end_date       = $_POST["end_date"];
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
                'name'          => $name,
                'slug'          => $slug,
                'description'   => $description,
                'project_id'    => $project_id,
                'partner_id'    => $partner_id,
                'start_date'    => $start_date,
                'end_date'      => $end_date,
                'reminder'      => $reminder,
                'completed'     => $completed
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
function upm_tasks_delete_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_tasks";
    $id = $_POST["id"];
    $wpdb->delete(
        $table_name,        //table
        ['id' => $id],      //where
        ['%s']              //where format
    );

    $del_table_name = $wpdb->prefix . "upm_deliverables";
    $wpdb->delete(
        $del_table_name,
        ['task_id' => $id]
    );
}
/***********************************************/