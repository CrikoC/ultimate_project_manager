<?php
function upm_admin_enqueue() {
    wp_register_style('ump_bootstrap_css', plugins_url('/admin/_includes/css/bootstrap.css', UPM_PLUGIN_URL));
    wp_enqueue_style('ump_bootstrap_css');

    wp_register_script('upm_bootstrap_js', plugins_url('/admin/_includes/js/bootstrap.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_bootstrap_js');

    wp_register_script('upm_datepicker_js', plugins_url('/admin/_includes/js/datepicker.js', UPM_PLUGIN_URL), ['jquery',"jquery-ui-datepicker"], '20172104', true);
    wp_enqueue_script('upm_datepicker_js');

    wp_register_style('upm_styles_css', plugins_url('/admin/_includes/css/styles.css', UPM_PLUGIN_URL));
    wp_enqueue_style('upm_styles_css');

    wp_register_style('upm_jquery_ui_css', plugins_url('/admin/_includes/css/jquery-ui.css', UPM_PLUGIN_URL));
    wp_enqueue_style('upm_jquery_ui_css');

    wp_register_script('upm_md5_js', plugins_url('/admin/_includes/js/jquery.md5.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_md5_js');
    
    //projects
    wp_register_script('upm_projects_crud_js', plugins_url('/admin/projects/upm_projects_crud.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_projects_crud_js');

    wp_register_script('upm_generate_project_slug_js', plugins_url('/admin/projects/upm_generate_project_slug.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_generate_project_slug_js');

    wp_register_script('upm_check_project_name_js', plugins_url('/admin/projects/upm_check_project_name.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_project_name_js');

    wp_register_script('upm_check_project_end_date_js', plugins_url('/admin/projects/upm_check_project_end_date.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_project_end_date_js');

    //Project
    wp_register_script('upm_project_crud_js', plugins_url('/admin/project/upm_project_crud.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_project_crud_js');

    //partners
    wp_register_script('upm_users_crud_js', plugins_url('/admin/users/upm_users_crud.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_users_crud_js');

    wp_register_script('upm_check_user_name_js', plugins_url('/admin/users/upm_check_user_name.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_user_name_js');

    //work_packages
    wp_register_script('upm_work_packages_crud_js', plugins_url('/admin/work_packages/upm_work_packages_crud.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_work_packages_crud_js');

    wp_register_script('upm_generate_work_package_slug_js', plugins_url('/admin/work_packages/upm_generate_work_package_slug.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_generate_work_package_slug_js');

    wp_register_script('upm_check_work_package_name_js', plugins_url('/admin/work_packages/upm_check_work_package_name.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_work_package_name_js');

    wp_register_script('upm_check_work_package_date_js', plugins_url('/admin/work_packages/upm_check_work_package_date.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_work_package_date_js');

    //tasks
    wp_register_script('upm_tasks_crud_js', plugins_url('/admin/tasks/upm_tasks_crud.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_tasks_crud_js');

    wp_register_script('upm_generate_task_slug_js', plugins_url('/admin/tasks/upm_generate_task_slug.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_generate_task_slug_js');

    wp_register_script('upm_check_task_name_js', plugins_url('/admin/tasks/upm_check_task_name.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_task_name_js');

    wp_register_script('upm_check_task_date_js', plugins_url('/admin/tasks/upm_check_task_date.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_task_date_js');

    //milestones
    wp_register_script('upm_milestones_crud_js', plugins_url('/admin/milestones/upm_milestones_crud.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_milestones_crud_js');

    wp_register_script('upm_generate_milestone_slug_js', plugins_url('/admin/milestones/upm_generate_milestone_slug.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_generate_milestone_slug_js');

    wp_register_script('upm_check_milestone_name_js', plugins_url('/admin/milestones/upm_check_milestone_name.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_milestone_name_js');

    wp_register_script('upm_check_milestone_date_js', plugins_url('/admin/milestones/upm_check_milestone_date.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_milestone_date_js');

    //deliverables
    wp_register_script('upm_deliverables_crud_js', plugins_url('/admin/deliverables/upm_deliverables_crud.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_deliverables_crud_js');

    wp_register_script('upm_generate_deliverable_slug_js', plugins_url('/admin/deliverables/upm_generate_deliverable_slug.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_generate_deliverable_slug_js');

    wp_register_script('upm_check_deliverable_name_js', plugins_url('/admin/deliverables/upm_check_deliverable_name.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_deliverable_name_js');

    wp_register_script('upm_check_deliverable_date_js', plugins_url('/admin/deliverables/upm_check_deliverable_date.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_deliverable_date_js');


    //Noticeboard
    wp_register_script('upm_noticeboard_crud_js', plugins_url('/admin/noticeboard/upm_noticeboard_crud.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_noticeboard_crud_js');

    wp_register_script('upm_generate_notice_slug_js', plugins_url('/admin/noticeboard/upm_generate_notice_slug.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_generate_notice_slug_js');

    wp_register_script('upm_check_notice_name_js', plugins_url('/admin/noticeboard/upm_check_notice_name.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_check_notice_name_js');

    //Cron jobs
    wp_register_script('upm_projects_cron_jobs_js', plugins_url('/admin/cron_jobs/upm_projects_cron_jobs.js', UPM_PLUGIN_URL), ['jquery'], '20172104', true);
    wp_enqueue_script('upm_projects_cron_jobs_js');
}