<?php
/***********************************************/
/*                   CREATE                    */
/***********************************************/
function upm_notice_create_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_noticeboard";
    $id             = $_POST["id"];
    $name           = $_POST["name"];
    $slug           = $_POST["slug"];
    $description    = $_POST["description"];
    $project_id     = $_POST['project_id'];

    if($id != "" || $name != "" || $slug != "") {
        $wpdb->insert(
            $table_name,            //table
            [
                'id'                => $id,
                'name'              => $name,
                'slug'              => $slug,
                'description'       => $description,
                'project_id'        => $project_id,
            ]                      //data
        );
    }
}
/***********************************************/



/***********************************************/
/*                    READ                     */
/***********************************************/
function upm_notice_read_callback() {
    global $wpdb;

    $project_id = $_GET['id'];

    $noticeboard_table = $wpdb->prefix."upm_noticeboard";
    $noticeboard = $wpdb->get_results("SELECT * FROM $noticeboard_table WHERE project_id = '$project_id'");
    if (!empty($noticeboard)) {
        foreach($noticeboard  as $notice) {
            echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">';
                echo '<div class="card" style="width: 20rem;">';
                    echo '<input type="hidden" id="project_id" name="project_id" value="'.$project_id.'">';
                    echo '<input type="hidden" id="id" name="id" value="'.$notice->id.'">';
                    echo '<input type="hidden" id="slug" name="slug" value="'.$notice->slug.'">';
                    echo '<div class="card-block">';
                        echo '<h4 class="card-title text-center"><span id="name">'.$notice->name.'</span></h4>';
                        echo '<p class="card-text text-center" id="description">'.$notice->description.'</p>';
                        echo '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> '.$notice->published_at;
                        echo '<hr>';
                    echo '</div>';
                    echo '<div class="card-block text-center">';
                        echo "<button type='button' class='btn btn-primary edit-notice' data-toggle='modal' data-target='#edit-notice'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button> ";
                        echo "<button type='button' class='btn btn-danger remove-notice' data-toggle='modal' data-target='#remove-notice'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="col-md-3 col-sm-4"><div class="alert alert-warning">Noticeboard is empty.</div></div>';
    }
}

/***********************************************/



/***********************************************/
/*                   UPDATE                    */
/***********************************************/
function upm_notice_update_callback() {
    global $wpdb;
    $table_name     = $wpdb->prefix . "upm_noticeboard";
    $id             = $_POST["id"];
    $name           = $_POST["name"];
    $slug           = $_POST["slug"];
    $description    = $_POST["description"];
    $project_id     = $_POST['project_id'];

    if($name != "" || $slug != "") {
        $wpdb->update(
            $table_name,        //table
            [
                'name'          => $name,
                'slug'          => $slug,
                'description'   => $description,
                'project_id'    => $project_id
            ],                  //data
            ['id' => $id]      //where
        );
    }
}
/***********************************************/


/***********************************************/
/*                   DELETE                    */
/***********************************************/
function upm_notice_delete_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . "upm_noticeboard";
    $id = $_POST["id"];
    $wpdb->delete(
        $table_name,        //table
        ['id' => $id]      //where
    );
}
/***********************************************/