<?php
/***********************************************/
/*                   CREATE                    */
/***********************************************/
function upm_deliverables_create_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_deliverables";
    $id             = $_POST["id"];
    $name           = $_POST["name"];
    $slug           = $_POST["slug"];
    $description    = $_POST["description"];
    $project_id     = $_POST['project_id'];
    $task_id        = $_POST['task_id'];
    $partner_id     = $_POST["partner_id"];
    $del_date       = date("Y-m-d",strtotime($_POST["del_date"]));
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
                'task_id'           => trim($task_id),
                'partner_id'        => trim($partner_id),
                'del_date'          => trim($del_date),
                'reminder'          => trim($reminder),
                'status'            => trim('in_progress'),
                'completed'         => 0
            ]                      //data
        );
    }

    global $current_user;
    get_current_user();

    $partner = get_user_by('ID', $partner_id);
    $project_table = $wpdb->prefix."upm_projects";
    $project = $wpdb->get_row("SELECT * FROM $project_table WHERE is = '$project_id'");

    $message = "<p>Dear ".$partner->user_nicename.".</p>";
    $message .= "<p>You have been assigned to bring forth a deliverable for project: ".$project->name.".<br/>";
    $message .= "For more information visit your <a href='".home_url()."'>profile</a></p>";
    $message .= "With regards ".$current_user->first_name." ". $current_user->last_name.". Project Manager of ".$project->name;

    wp_mail(
        $partner->user_email,
        'Message From Ultimate Project Manager',
        $message
    );

}
/***********************************************/


/***********************************************/
/*                   UPDATE                    */
/***********************************************/
function upm_deliverables_update_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_deliverables";
    $id             = $_POST["id"];
    $name           = $_POST["name"];
    $slug           = $_POST["slug"];
    $description    = $_POST["description"];
    $project_id     = $_POST['project_id'];
    $task_id        = $_POST['task_id'];
    $partner_id     = $_POST["partner_id"];
    $del_date       = $_POST["del_date"];
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
                'name'              => trim($name),
                'slug'              => trim($slug),
                'description'       => trim($description),
                'project_id'        => trim($project_id),
                'task_id'           => trim($task_id),
                'partner_id'        => trim($partner_id),
                'del_date'          => trim($del_date),
                'reminder'          => trim($reminder),
                'completed'         => trim($completed)
            ],                  //data
            ['id' => $id]      //where
             //where format
        );
    }
}
/***********************************************/


/***********************************************/
/*                   DELETE                    */
/***********************************************/
function upm_deliverables_delete_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_deliverables";
    $id = $_POST["id"];
    $wpdb->delete(
        $table_name,        //table
        ['id' => $id]      //where
    );
}
/***********************************************/