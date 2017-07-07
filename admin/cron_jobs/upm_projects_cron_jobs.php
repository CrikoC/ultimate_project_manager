<?php
/****************************************************************************/
/*                           CHECK PROJECT STATUS                           */
/****************************************************************************/
function upm_projects_cron_jobs_callback() {
    global $wpdb;
    $today = strtotime(date('Y-m-d'));

    /*************************************************/
    /*             DELIVERABLES STATUS               */
    /*************************************************/
    $del_table = $wpdb->prefix . "upm_deliverables";
    $deliverables = $wpdb->get_results("SELECT * FROM $del_table");

    foreach ($deliverables as $deliverable) {
        $del_date = date('Y-m-d',strtotime($deliverable->del_date));

        if($del_date > $today) {
            if($deliverable->completed == 1) {
                //status completed
                $wpdb->update($del_table, ['status' => 'completed'] ,['id' => $deliverable->id]);
            } else {
                // status delayed
                $wpdb->update($del_table, ['status' => 'delayed'] ,['id' => $deliverable->id]);
            }
        } else {
            //status in progress
            $wpdb->update($del_table, ['status' => 'in_progress'] ,['id' => $deliverable->id]);
        }
    }
    /*************************************************/


    /*************************************************/
    /*              MILESTONES STATUS                */
    /*************************************************/
    $mil_table = $wpdb->prefix . "upm_milestones";
    $milestones = $wpdb->get_results("SELECT * FROM $mil_table");

    foreach ($milestones as $milestone) {
        $mil_date = date('Y-m-d',strtotime($milestone->mil_date));

        if($mil_date > $today) {
            if($milestone->completed == 1) {
                //status completed
                $wpdb->update($mil_table, ['status' => 'completed'] ,['id' => $milestone->id]);
            } else {
                // status delayed
                $wpdb->update($mil_table, ['status' => 'delayed'] ,['id' => $milestone->id]);
            }
        } else {
            //status in progress
            $wpdb->update($mil_table, ['status' => 'in_progress'] ,['id' => $milestone->id]);
        }
    }
    /*************************************************/


    /*************************************************/
    /*                 TASKS STATUS                  */
    /*************************************************/
    $tasks_table = $wpdb->prefix . "upm_tasks";
    $tasks = $wpdb->get_results("SELECT * FROM $tasks_table");

    foreach($tasks as $task) {
        $task_end_date = date('Y-m-d',strtotime($task->end_date));
        $all_deliverables = $wpdb->get_var("SELECT COUNT(*) FROM $del_table WHERE task_id = '$task->id'");
        $completed_deliverables = $wpdb->get_var("SELECT COUNT(*) FROM $del_table WHERE task_id = '$task->id' AND status = `completed`");

        if($task_end_date > $today) {
            //Check if the task has deliverables
            if($all_deliverables != 0) {
                if($task->completed == 1 && $completed_deliverables == $all_deliverables) {
                    //status completed
                    $wpdb->update($tasks_table, ['status' => 'completed'] ,['id' => $task->id]);
                } else {
                    //status delayed
                    $wpdb->update($tasks_table, ['status' => 'delayed'] ,['id' => $task->id]);
                }
            } else {
                if($task->completed == 1) {
                    //status completed
                    $wpdb->update($tasks_table, ['status' => 'completed'] ,['id' => $task->id]);
                } else {
                    //status delayed
                    $wpdb->update($tasks_table, ['status' => 'delayed'] ,['id' => $task->id]);
                }
            }
        } else {
            //status in_progress
            $wpdb->update($tasks_table, ['status' => 'in_progress'] ,['id' => $task->id]);
        }
    }
    /*************************************************/


    /*************************************************/
    /*            WORK PACKAGES STATUS               */
    /*************************************************/
    $work_packages_table = $wpdb->prefix . "upm_work_packages";
    $work_packages = $wpdb->get_results("SELECT * FROM $work_packages_table");

    foreach($work_packages as $work_package) {
        $work_package_end_date = date('Y-m-d',strtotime($work_package->end_date));

        $all_milestones = $wpdb->get_var("SELECT COUNT(*) FROM $mil_table WHERE work_package_id = '$work_package->id'");
        $completed_milestones = $wpdb->get_var("SELECT COUNT(*) FROM $mil_table WHERE work_package_id = '$work_package->id' AND status = `completed`");

        $all_tasks = $wpdb->get_var("SELECT COUNT(*) FROM $task_table WHERE wp_id = '$work_package->id'");
        $completed_tasks = $wpdb->get_var("SELECT COUNT(*) FROM $task_table WHERE wp_id = '$work_package->id' AND status = `completed`");

        if($work_package_end_date > $today) {
            if($all_milestones != 0) {
                if($completed_milestones == $all_milestones && $completed_tasks == $all_tasks) {
                    //status completed
                    $wpdb->update($work_packages_table, ['status' => 'completed'] ,['id' => $work_package->id]);
                } else {
                    //status delayed
                    $wpdb->update($work_packages_table, ['status' => 'delayed'] ,['id' => $work_package->id]);
                }
            } else {
                if($completed_tasks == $all_tasks) {
                    //status completed
                    $wpdb->update($work_packages_table, ['status' => 'completed'] ,['id' => $work_package->id]);
                } else {
                    //status delayed
                    $wpdb->update($work_packages_table, ['status' => 'delayed'] ,['id' => $work_package->id]);
                }
            }
        } else {
            //status in_progress
            $wpdb->update($work_packages_table, ['status' => 'in_progress'] ,['id' => $work_package->id]);
        }
    }
    /*************************************************/


    /*************************************************/
    /*               PROJECTS STATUS                 */
    /*************************************************/
    $projects_table = $wpdb->prefix . "upm_projects";
    $projects = $wpdb->get_results("SELECT * FROM $projects_table");

    foreach ($projects as $project) {
        $project_end_date = date('Y-m-d',strtotime($project->end_date));
        $work_packages_table = $wpdb->prefix . "upm_work_packages";
        $all_work_packages = $wpdb->get_var("SELECT COUNT(*) FROM $work_packages_table WHERE project_id = '$project->id'");
        $completed_work_packages = $wpdb->get_var("SELECT COUNT(*) FROM $work_packages_table WHERE project_id = '$project->id' AND status = `completed`");

        if($project_end_date > $today) {
            if($completed_work_packages == $all_work_packages) {
                //status completed
                $wpdb->update($projects_table, ['status' => 'completed'] ,['id' => $project->id]);
            } else {
                //status delayed
                $wpdb->update($projects_table, ['status' => 'delayed'] ,['id' => $project->id]);
            }
        } else {
            //status in_progress
            $wpdb->update($projects_table, ['status' => 'in_progress'] ,['id' => $project->id]);
        }
    }
    /*************************************************/
}
/****************************************************************************/