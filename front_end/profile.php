<?php
function upm_profile_page()
{
    //post status and options
    $post = [
        'comment_status'    => 'closed',
        'ping_status'       => 'closed' ,
        'post_author'       => 1,
        'post_date'         => date('Y-m-d H:i:s'),
        'post_name'         => 'profile',
        'post_status'       => 'publish' ,
        'post_title'        => 'Profile',
        'post_type'         => 'page',
        'post_content'      => '[profile_content]'
    ];
    //insert page and save the id
    $new_page = wp_insert_post( $post, false );
    //save the id in the database
    update_option( 'hclpage', $new_page );
}

function upm_profile_content($atts, $content = null) {
    if ( !is_user_logged_in() ) {
        wp_redirect(home_url(). '/login');
        exit();
    }

    global $current_user;
    wp_get_current_user();

    if(!empty($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    ?>


    <hr>
    <h1><?php echo $current_user->display_name; ?></h1>
    <?php
        if(!empty(wp_get_attachment_image($current_user->user_image))) {
            $avatar = wp_get_attachment_image_url($current_user->user_image,'thumbnail', false);
        } else {
            $avatar = get_avatar_url($current_user->ID);
        }
    ?>
    <img src='<?php echo $avatar; ?>'>
    <a href="<?php echo home_url(). '/edit_profile'; ?>">Edit Profile</a>
    <a href="<?php echo home_url(). '/edit_password'; ?>">Security</a>
    <a id="wp-submit" href="<?php echo wp_logout_url(); ?>" title="Logout">Logout</a>
    <hr>
    <br/>
    <div class="email_container">
        <strong>Email: </strong><?php echo $current_user->user_email; ?>
    </div>
    <br/>
    <div class="telephone_container">
        <strong>Telephone: </strong><?php echo $current_user->telephone; ?>
    </div>
    <br/>
    <div class="cellphone_container">
        <strong>Cellphone: </strong><?php echo $current_user->cellphone; ?>
    </div>
    <hr>
    <h2>Assignments</h2>

    <table>
        <thead>
        <th>Name</th>
        <th>Description</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>
        </thead>
        <tbody>
    <?php
        global $wpdb;
        $workpackages_table = $wpdb->prefix."upm_work_packages";
        $workpackages = $wpdb->get_results("SELECT * FROM $workpackages_table WHERE coordinator_id = '$current_user->ID'");
        foreach($workpackages as $workpackage) {

    ?>
        <tr>
            <td><?php echo $workpackage->name; ?></td>
            <td><?php echo $workpackage->description; ?></td>
            <td><?php echo $workpackage->start_date; ?></td>
            <td><?php echo $workpackage->end_date; ?></td>
            <td><?php echo $workpackage->status; ?></td>
        </tr>
    <?php
    }

    $tasks_table = $wpdb->prefix."upm_tasks";
    $tasks = $wpdb->get_results("SELECT * FROM $tasks_table WHERE partner_id = '$current_user->ID'");
    foreach($tasks as $task) {

        ?>
        <tr>
            <td><?php echo $task->name; ?></td>
            <td><?php echo $task->description; ?></td>
            <td><?php echo $task->start_date; ?></td>
            <td><?php echo $task->end_date; ?></td>
            <td><?php echo $task->status; ?></td>
        </tr>
        <?php
    }

    $milestones_table = $wpdb->prefix."upm_milestones";
    $milestones = $wpdb->get_results("SELECT * FROM $milestones_table WHERE coordinator_id = '$current_user->ID'");
    foreach($milestones as $milestone) {

        ?>
        <tr>
            <td><?php echo $milestone->name; ?></td>
            <td><?php echo $milestone->description; ?></td>
            <td colspan="2"><?php echo $milestone->mil_date; ?></td>
            <td><?php echo $milestone->status; ?></td>
        </tr>
        <?php
    }

    $deliverables_table = $wpdb->prefix."upm_deliverables";
    $deliverables_ = $wpdb->get_results("SELECT * FROM $deliverables_table WHERE partner_id = '$current_user->ID'");
    foreach($deliverables_ as $deliverables) {

        ?>
        <tr>
            <td><?php echo $deliverables->name; ?></td>
            <td><?php echo $deliverables->description; ?></td>
            <td colspan="2"><?php echo $deliverables->del_date; ?></td>
            <td><?php echo $deliverables->status; ?></td>
        </tr>
        <?php
    }
    ?>
        </tbody>
    </table>
<?php
}
