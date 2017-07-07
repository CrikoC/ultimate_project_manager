<?php
/***********************************************/
/*                    READ                     */
/***********************************************/
function upm_project_read_callback() {
    global $wpdb;
    global $current_user;
    get_current_user();

    $table_name = $wpdb->prefix."upm_projects";
    $project_id = $_GET['id'];
    $project = $wpdb->get_row("SELECT * FROM $table_name WHERE id = '$project_id'");
    ?>
    <div class="row">
        <div class="col-md-12">
            <h2><span class="glyphicon glyphicon-list"></span>
                <?php echo $project->name; ?>
            </h2>
        </div>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-12" style="overflow: auto;">
            <table class="table table-responsive project_table">
                <?php
                $project_start_date =  strtotime($project->start_date);
                $project_end_date = strtotime($project->end_date);
                $project_offset = $project_end_date-$project_start_date;
                $project_dates = floor($project_offset/ 86400 / 30);
                ?>
                <thead>
                <tr class="bg-primary">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Name</th>
                    <th>Responsible</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <!---- Project Year range ---->
                    <?php
                    for ($project_year_count = 0; $project_year_count < $project_dates; $project_year_count++)
                    {
                        $project_new_year = date("Y", mktime(12,0,0,(date("m", strtotime($project->start_date))+ $project_year_count),
                            date("d", strtotime($project->start_date)), date("Y", strtotime($project->start_date))));
                        echo '<th align="center">'.$project_new_year .'</th>';
                    }
                    ?>
                    <!----------- END ------------>
                </tr>
                </thead>
                <tbody>
                <tr id="project_info" class="bg-primary"
                    data-project-start-date="<?php echo $project->start_date;?>"
                    data-project-end-date="<?php echo $project->end_date;?>"
                >
                    <th>
                        <button type="button" class="btn btn-xs btn-success create-work-package" data-toggle="modal" data-target="#create-work-package">
                            <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                        </button>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><?php echo $project->name; ?></th>
                    <th><?php echo $current_user->user_nicename; ?></th>
                    <th><?php echo date('Y-m-d', strtotime($project->start_date)); ?></th>
                    <th><?php echo date('Y-m-d', strtotime($project->end_date)); ?></th>
                    <th><?php echo $project->status; ?></th>
                    <!--- Project Month range ---->
                    <?php
                    for ($project_month_count = 0; $project_month_count < $project_dates; $project_month_count++)
                    {
                        $project_new_month = date("m", mktime(12,0,0,(date("m", strtotime($project->start_date))+ $project_month_count),
                            date("d", strtotime($project->start_date)), date("Y", strtotime($project->start_date))));
                        echo '<th align="center">'.$project_new_month .'</th>';
                    }
                    ?>
                    <!----------- END ------------>
                </tr>
                <?php
                $workpackages_table = $wpdb->prefix."upm_work_packages";
                $workpackages = $wpdb->get_results("SELECT * FROM $workpackages_table WHERE project_id = '$project->id'");
                foreach($workpackages as $workpackage) { ?>
                    <tr class="alert-info"
                        id="<?php echo $workpackage->id; ?>"
                        data-slug="<?php echo $workpackage->slug; ?>"
                        data-partner-id="<?php echo $workpackage->coordinator_id; ?>"
                        data-description="<?php echo $workpackage->description; ?>"
                        data-reminder="<?php echo date('Y-m-d', strtotime($workpackage->reminder)); ?>"
                        data-project-start-date="<?php echo $project->start_date;?>"
                        data-project-end-date="<?php echo $project->end_date;?>"
                        data-wp-start-date="<?php echo $workpackage->start_date;?>"
                        data-wp-end-date="<?php echo $workpackage->end_date;?>"
                        data-completed="<?php echo $workpackage->completed;?>"
                    >
                        <td>
                            <button type="button" class="btn btn-xs btn-success create-task" data-toggle="modal" data-target="#create-task">
                                <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-xs btn-success create-milestone" data-toggle="modal" data-target="#create-milestone">
                                <span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>
                            </button>
                        </td>
                        <td>
                            <button type='button' class='btn btn-xs btn-primary edit-work-package' data-toggle='modal' data-target='#edit-work-package'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>
                        </td>
                        <td>
                            <button type='button' class='btn btn-xs btn-danger remove-work-package' data-toggle='modal' data-target='#remove-work-package'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>
                        </td>
                        <td>
                            <?php echo $workpackage->name; ?>
                        </td>
                        <td>
                            <?php
                            $partner = get_user_by('ID', $workpackage->coordinator_id);
                            echo $partner->user_nicename;
                            ?>
                        </td>
                        <td>
                            <?php echo date('Y-m-d', strtotime($workpackage->start_date)); ?>
                        </td>
                        <td>
                            <?php echo date('Y-m-d', strtotime($workpackage->end_date)); ?>
                        </td>
                        <td><?php echo $workpackage->status; ?></td>
                        <!-- Workpackage date range -->
                        <?php
                        $wp_dates = month_range($workpackage->start_date,$workpackage->end_date)+1;
                        $wp_before_dates = month_range($project->start_date,$workpackage->start_date);
                        $wp_after_dates = month_range($workpackage->end_date,$project->end_date);

                        if($wp_before_dates == 0) {
                            echo "";
                        }
                        else {
                            $wp_count = 0;
                            while($wp_count < $wp_before_dates)
                            {
                                echo '<td align="center" class="empty_gantt"></td>';
                                $wp_count++;
                            }
                        }
                        $wp_count = 0;
                        while($wp_count < $wp_dates)
                        {
                            echo '<td align="center" class="wp_gantt"></td>';
                            $wp_count++;
                        }
                        if($wp_after_dates == 0) {
                            echo "";
                        }
                        else {
                            $wp_count = 0;
                            while($wp_count < $wp_after_dates)
                            {
                                echo '<td align="center" class="empty_gantt"></td>';
                                $wp_count++;
                            }
                        }
                        ?>
                        <!----------- END ------------>
                    </tr>
                    <?php
                    $milestones_table = $wpdb->prefix."upm_milestones";
                    $milestones = $wpdb->get_results("SELECT * FROM $milestones_table WHERE wp_id = '$workpackage->id'");
                    foreach($milestones as $milestone) { ?>
                        <tr class="alert-info"
                            id="<?php echo $milestone->id; ?>"
                            data-slug="<?php echo $milestone->slug; ?>"
                            data-wp-id="<?php echo $milestone->id; ?>"
                            data-partner-id="<?php echo $milestone->coordinator_id; ?>"
                            data-description="<?php echo $milestone->description; ?>"
                            data-reminder="<?php echo date('Y-m-d', strtotime($milestone->reminder)); ?>"
                            data-wp-start-date="<?php echo $workpackage->start_date;?>"
                            data-wp-end-date="<?php echo $workpackage->end_date;?>"
                            data-completed="<?php echo $milestone->completed;?>"
                        >
                            <td></td>
                            <td></td>
                            <td>
                                <button type='button' class='btn btn-xs btn-primary edit-milestone' data-toggle='modal' data-target='#edit-milestone'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>
                            </td>
                            <td>
                                <button type='button' class='btn btn-xs btn-danger remove-milestone' data-toggle='modal' data-target='#remove-milestone'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>
                            </td>
                            <td>
                                <small><?php echo $milestone->name; ?></small>
                            </td>
                            <td>
                                <?php
                                $partner = get_user_by('ID', $milestone->coordinator_id);
                                echo $partner->user_nicename;
                                ?>
                            </td>
                            <td colspan="2" align="center">
                                <?php echo date('Y-m-d', strtotime($milestone->mil_date)); ?>
                            </td>
                            <td><?php echo $milestone->status; ?></td>
                            <!--- Milestone date range --->
                            <?php
                            $mil_before_dates = month_range($project->start_date,$milestone->mil_date);
                            $mil_after_dates = month_range($milestone->mil_date,$project->end_date);

                            if($mil_before_dates==0) {
                                echo "";
                            }
                            else {
                                $mil_count=0;
                                while($mil_count < $mil_before_dates)
                                {
                                    echo '<td></td>';
                                    $mil_count++;
                                }
                            }
                            echo '<td align="center"><span class="glyphicon glyphicon-certificate" aria-hidden="true"></td>';

                            if($mil_after_dates==0) {
                                echo "";
                            }
                            else {
                                $mil_count=0;
                                while($mil_count < $mil_after_dates)
                                {
                                    echo '<td></td>';
                                    $mil_count++;
                                }
                            }
                            ?>
                            <!----------- END ------------>
                        </tr>
                    <?php } ?>
                    <?php
                    $tasks_table = $wpdb->prefix."upm_tasks";
                    $tasks = $wpdb->get_results("SELECT * FROM $tasks_table WHERE wp_id = '$workpackage->id'");
                    foreach($tasks as $task) { ?>
                        <tr class="alert-warning"
                            id="<?php echo $task->id; ?>"
                            data-slug="<?php echo $task->slug; ?>"
                            data-partner-id="<?php echo $task->partner_id; ?>"
                            data-description="<?php echo $task->description; ?>"
                            data-reminder="<?php echo date('Y-m-d', strtotime($task->reminder)); ?>"
                            data-wp-start-date="<?php echo $workpackage->start_date;?>"
                            data-wp-end-date="<?php echo $workpackage->end_date;?>"
                            data-task-start-date="<?php echo $task->start_date;?>"
                            data-task-end-date="<?php echo $task->end_date;?>"
                            data-completed="<?php echo $task->completed;?>"
                        >
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-xs btn-success create-deliverable" data-toggle="modal" data-target="#create-deliverable">
                                    <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                                </button>
                            </td>
                            <td>
                                <button type='button' class='btn btn-xs btn-primary edit-task' data-toggle='modal' data-target='#edit-task'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>
                            </td>
                            <td>
                                <button type='button' class='btn btn-xs btn-danger remove-task' data-toggle='modal' data-target='#remove-task'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>
                            </td>
                            <td>
                                <?php echo $task->name; ?>
                            </td>
                            <td>
                                <?php
                                $partner = get_user_by('ID', $task->partner_id);
                                echo $partner->user_nicename;
                                ?>
                            </td>
                            <td><?php echo date('Y-m-d', strtotime($task->start_date)); ?>
                            </td>
                            <td><?php echo date('Y-m-d', strtotime($task->end_date)); ?>
                            </td>
                            <td><?php echo $task->status; ?></td>
                            <!----- Task date range ------>
                            <?php
                            $task_dates = month_range($task->start_date,$task->end_date)+1;
                            $task_before_dates = month_range($project->start_date,$task->start_date);
                            $task_after_dates = month_range($task->end_date,$project->end_date);

                            if($task_before_dates==0) {
                                echo "";
                            }
                            else {
                                $task_count=0;
                                while($task_count < $task_before_dates)
                                {
                                    echo '<td align="center" class="empty_gantt"></td>';
                                    $task_count++;
                                }
                            }
                            $task_count=0;
                            while($task_count < $task_dates)
                            {
                                echo '<td align="center" class="task_gantt"></td>';
                                $task_count++;
                            }
                            if($task_after_dates==0) {
                                echo "";
                            }
                            else {
                                $task_count=0;
                                while($task_count < $task_after_dates)
                                {
                                    echo '<td align="center" class="empty_gantt"></td>';
                                    $task_count++;
                                }
                            }
                            ?>
                            <!----------- END ------------>
                        </tr>
                        <?php $deliverables_table = $wpdb->prefix."upm_deliverables";
                        $deliverables = $wpdb->get_results("SELECT * FROM $deliverables_table WHERE task_id = '$task->id'");
                        foreach($deliverables as $deliverable) { ?>
                            <tr class="alert-warning"
                                id="<?php echo $deliverable->id; ?>"
                                data-slug="<?php echo $deliverable->slug; ?>"
                                data-task-id="<?php echo $task->id; ?>"
                                data-partner-id="<?php echo $deliverable->partner_id; ?>"
                                data-description="<?php echo $deliverable->description; ?>"
                                data-reminder="<?php echo date('Y-m-d', strtotime($deliverable->reminder)); ?>"
                                data-task-start-date="<?php echo $task->start_date;?>"
                                data-task-end-date="<?php echo $task->end_date;?>"
                                data-completed="<?php echo $deliverable->completed;?>"
                            >
                                <td></td>
                                <td></td>
                                <td>
                                    <button type='button' class='btn btn-xs btn-primary edit-deliverable' data-toggle='modal' data-target='#edit-deliverable'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>
                                </td>
                                <td>
                                    <button type='button' class='btn btn-xs btn-danger remove-deliverable' data-toggle='modal' data-target='#remove-deliverable'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>
                                </td>
                                <td>
                                    <?php echo $deliverable->name; ?>
                                </td>
                                <td>
                                    <?php
                                    $partner = get_user_by('ID', $deliverable->partner_id);
                                    echo $partner->user_nicename;
                                    ?>
                                </td>
                                <td colspan="2" align="center">
                                    <small><?php echo date('Y-m-d', strtotime($deliverable->del_date)); ?></small>
                                </td>
                                <td><?php echo $deliverable->status; ?></td>
                                <!-- Deliverable date range -->
                                <?php
                                $del_before_dates = month_range($project->start_date,$deliverable->del_date);
                                $del_after_dates = month_range($deliverable->del_date,$project->end_date);

                                if($del_before_dates==0) {
                                    echo "";
                                }
                                else {
                                    $del_count=0;
                                    while($del_count < $del_before_dates)
                                    {
                                        echo '<td></td>';
                                        $del_count++;
                                    }
                                }
                                echo '<td align="center"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></td>';

                                if($del_after_dates==0) {
                                    echo "";
                                }
                                else {
                                    $del_count=0;
                                    while($del_count < $del_after_dates)
                                    {
                                        echo '<td></td>';
                                        $del_count++;
                                    }
                                }
                                ?>
                                <!----------- END ------------>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
}
/***********************************************/
