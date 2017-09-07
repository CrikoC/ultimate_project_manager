<?php
/***********************************************/
/*                   CREATE                    */
/***********************************************/
function upm_projects_create_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_projects";
    $id             = $_POST["id"];
    $name           = $_POST["name"];
    $slug           = $_POST["slug"];
    $description    = $_POST["description"];
    $manager_id     = $_POST["manager_id"];
    $start_date     = date("Y-m-d h:i:s",strtotime($_POST["start_date"]));
    $end_date       = date("Y-m-d h:i:s",strtotime($_POST["end_date"]));
    $reminder       = date("Y-m-d h:i:s",strtotime($_POST["reminder"]));

    if($id != "" || $name != "" || $slug != "") {
        $wpdb->insert(
            $table_name,            //table
            [
                'id'            => trim($id),
                'name'          => trim($name),
                'slug'          => trim($slug),
                'description'   => trim($description),
                'manager_id'    => trim($manager_id),
                'start_date'    => trim($start_date),
                'end_date'      => trim($end_date),
                'reminder'      => trim($reminder),
                'status'        => trim('in_progress'),
            ]                      //data
        );
    }
}
/***********************************************/


/***********************************************/
/*                    READ                     */
/***********************************************/
function upm_projects_read_callback() {
    global $wpdb;
    global $current_user;
    get_current_user();

    $table_name = $wpdb->prefix."upm_projects";
    $results = $wpdb->get_results("SELECT * FROM $table_name WHERE manager_id = $current_user->ID");

    if(!empty($results)){
        foreach($results  as $result) {
            echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">';
                echo '<input type="hidden" id="id" name="id" value="'.$result->id.'">';
                echo '<input type="hidden" id="slug" name="slug" value="'.$result->slug.'">';
                echo '<div class="card">';
                    echo '<div class="card-block">';
                        echo '<h4 class="card-title text-center"><a href="'.admin_url('admin.php?page=project&id='.$result->id, 'http' ).'"><span id="name">'.$result->name.'</span></a></h4>';
                        echo '<p class="card-text text-center" id="description">'.$result->description.'</p>';
                    echo '</div>';
                        echo '<table class="table table-responsive">';
                            echo '<tr><td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></td><td id="start_date"> ';
                                echo date("Y-m-d",strtotime($result->start_date));
                            echo '</td></tr>';
                            echo '<tr><td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></td><td id="end_date">';
                                echo date("Y-m-d",strtotime($result->end_date));
                            echo '</td></tr>';
                            echo '<tr><td><span class="glyphicon glyphicon-reminder" aria-hidden="true"></span></td><td id="reminder">';
                                echo date("Y-m-d",strtotime($result->reminder));
                            echo '</td></tr>';
                        echo '</table>';
                    echo '<div class="card-block text-center">';
                        echo "<button type='button' class='btn btn-primary edit-project' data-toggle='modal' data-target='#edit-project'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button> ";
                        echo "<button type='button' class='btn btn-danger remove-project' data-toggle='modal' data-target='#remove-project'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="col-md-6"><div class="alert alert-warning">No Projects were found.</div></div>';
    }
}

/***********************************************/


/***********************************************/
/*                   UPDATE                    */
/***********************************************/
function upm_projects_update_callback() {
    global $wpdb;
    $table_name     = $wpdb->prefix . "upm_projects";
    $id             = $_POST["id"];
    $name           = $_POST["name"];
    $slug           = $_POST["slug"];
    $description    = $_POST["description"];
    $start_date     = date("Y-m-d h:i:s",strtotime($_POST["start_date"]));
    $end_date       = date("Y-m-d h:i:s",strtotime($_POST["end_date"]));
    $reminder       = date("Y-m-d h:i:s",strtotime($_POST["reminder"]));

    if($name != "" || $slug != "") {
        $wpdb->update(
            $table_name,        //table
            [
                'name'          => trim($name),
                'slug'          => trim($slug),
                'description'   => trim($description),
                'start_date'    => trim($start_date),
                'end_date'      => trim($end_date),
                'reminder'      => trim($reminder),
            ],                  //data
            ['id' => $id] //where
        );
    }
}
/***********************************************/


/***********************************************/
/*                   DELETE                    */
/***********************************************/
function upm_projects_delete_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_projects";
    $id = $_POST["id"];
    $wpdb->delete(
        $table_name,        //table
        ['id' => $id]      //where
    );

    $wp_table_name = $wpdb->prefix . "upm_work_packages";
    $id = $_POST["id"];
    $wpdb->delete(
        $wp_table_name,
        ['project_id' => $id]
    );

    $taks_table_name = $wpdb->prefix . "upm_tasks";
    $id = $_POST["id"];
    $wpdb->delete(
        $taks_table_name,
        ['project_id' => $id]
    );

    $mil_table_name = $wpdb->prefix . "upm_milestones";
    $id = $_POST["id"];
    $wpdb->delete(
        $mil_table_name,
        ['project_id' => $id]
    );

    $del_table_name = $wpdb->prefix . "upm_deliverables";
    $id = $_POST["id"];
    $wpdb->delete(
        $del_table_name,
        ['project_id' => $id]
    );
}
/***********************************************/