<?php
/*
Plugin Name: Ultimate Project Management
Description: Manage you projects with ease! add your partners, assign tasks to them, organize the workflow and have constant communication with the build-in chat and message service!
Version: 1.0
Author: Kostas Christopoulos
*/

/***********************************************/
/*                   Setup                     */
/***********************************************/
if(!defined('ABSPATH')) exit;
define('UPM_PLUGIN_URL', __FILE__);
/***********************************************/


/***********************************************/
/*                 INCLUDES                    */
/***********************************************/
include(plugin_dir_path(UPM_PLUGIN_URL).'/activate.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/deactivate.php');
//Admin
include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/upm_admin_enqueue.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/upm_add_menu_pages.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/upm_users.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/upm_projects.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/upm_project.php');

include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/projects/upm_projects_crud.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/projects/upm_check_project_name.php');

include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/project/upm_project_crud.php');

include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/users/upm_users_crud.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/users/upm_check_user_name.php');

include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/work_packages/upm_work_packages_crud.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/work_packages/upm_check_work_package_name.php');

include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/tasks/upm_tasks_crud.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/tasks/upm_check_task_name.php');

include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/milestones/upm_milestones_crud.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/milestones/upm_check_milestone_name.php');

include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/deliverables/upm_deliverables_crud.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/deliverables/upm_check_deliverable_name.php');

include(plugin_dir_path(UPM_PLUGIN_URL).'/admin/cron_jobs/upm_projects_cron_jobs.php');


//Front End
include(plugin_dir_path(UPM_PLUGIN_URL).'/front_end/enqueue.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/front_end/register.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/front_end/login.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/front_end/redirect.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/front_end/profile.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/front_end/edit_profile.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/front_end/edit_password.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/front_end/add_nav_items.php');
include(plugin_dir_path(UPM_PLUGIN_URL).'/front_end/edit_toolbar.php');
/***********************************************/


/***********************************************/
/*                ACTIVATION                   */
/***********************************************/
//Custom user roles
register_activation_hook(UPM_PLUGIN_URL, 'upm_add_user_roles');
//custom tables
register_activation_hook(UPM_PLUGIN_URL, 'upm_create_tables');
//Disable WP_Cron
register_activation_hook(UPM_PLUGIN_URL,'upm_disable_wp_cron');
//Custom pages
register_activation_hook(UPM_PLUGIN_URL, 'upm_register_page');
register_activation_hook(UPM_PLUGIN_URL, 'upm_login_page');
register_activation_hook(UPM_PLUGIN_URL, 'upm_profile_page');
register_activation_hook(UPM_PLUGIN_URL, 'upm_edit_profile_page');
register_activation_hook(UPM_PLUGIN_URL, 'upm_edit_password_page');
/***********************************************/


/***********************************************/
/*                   HOOKS                     */
/***********************************************/

/*Admin**************************************************************************/
//Styles and scrips
add_action('admin_enqueue_scripts', 'upm_admin_enqueue');
//Admin menu pages
add_action('admin_menu','upm_add_menu_pages');

/*Ajax crud actions*************************************/
//projects
add_action('wp_ajax_upm_projects_create_action', 'upm_projects_create_callback');
add_action('wp_ajax_upm_projects_read_action',   'upm_projects_read_callback');
add_action('wp_ajax_upm_projects_update_action', 'upm_projects_update_callback');
add_action('wp_ajax_upm_projects_delete_action', 'upm_projects_delete_callback');
add_action('wp_ajax_upm_check_project_name_action', 'upm_check_project_name_callback');

//Project
add_action('wp_ajax_upm_project_read_action',   'upm_project_read_callback');
//Projects cron jobs
add_action('wp_ajax_upm_projects_cron_jobs_action',   'upm_projects_cron_jobs_callback');

//users
add_action('wp_ajax_upm_users_create_action', 'upm_users_create_callback');
add_action('wp_ajax_upm_users_read_action',   'upm_users_read_callback');
add_action('wp_ajax_upm_users_update_action', 'upm_users_update_callback');
add_action('wp_ajax_upm_users_update_password_action', 'upm_users_update_password_callback');
add_action('wp_ajax_upm_users_delete_action', 'upm_users_delete_callback');
add_action('wp_ajax_upm_check_user_name_action', 'upm_check_user_name_callback');

//work_packages
add_action('wp_ajax_upm_work_packages_create_action', 'upm_work_packages_create_callback');
add_action('wp_ajax_upm_work_packages_update_action', 'upm_work_packages_update_callback');
add_action('wp_ajax_upm_work_packages_delete_action', 'upm_work_packages_delete_callback');
add_action('wp_ajax_upm_check_work_package_name_action', 'upm_check_work_package_name_callback');


//tasks
add_action('wp_ajax_upm_tasks_create_action', 'upm_tasks_create_callback');
add_action('wp_ajax_upm_tasks_update_action', 'upm_tasks_update_callback');
add_action('wp_ajax_upm_tasks_delete_action', 'upm_tasks_delete_callback');
add_action('wp_ajax_upm_check_task_name_action', 'upm_check_task_name_callback');

//milestones
add_action('wp_ajax_upm_milestones_create_action', 'upm_milestones_create_callback');
add_action('wp_ajax_upm_milestones_update_action', 'upm_milestones_update_callback');
add_action('wp_ajax_upm_milestones_delete_action', 'upm_milestones_delete_callback');
add_action('wp_ajax_upm_check_milestone_name_action', 'upm_check_milestone_name_callback');

//deliverables
add_action('wp_ajax_upm_deliverables_create_action', 'upm_deliverables_create_callback');
add_action('wp_ajax_upm_deliverables_update_action', 'upm_deliverables_update_callback');
add_action('wp_ajax_upm_deliverables_delete_action', 'upm_deliverables_delete_callback');
add_action('wp_ajax_upm_check_deliverable_name_action', 'upm_check_deliverable_name_callback');
/********************************************************************************/

/*Frontend***********************************************************************/
add_action('admin_enqueue_scripts', 'upm_front_end_enqueue');
add_filter('admin_bar_menu', 'upm_replace_howdy',20);

/* if the logged in user has a role of member: */
     //1.Remove some nodes from the toolbar
    add_action('admin_bar_menu', 'upm_remove_nodes_toolbar', 999);
    //2. Edit the "user-info" and "edit-profile" links to keep the member in the front end
    add_action('admin_bar_menu', function() { upm_edit_admin_bar(['user-info', 'my-account'], 'href', home_url('/profile')); } );
    add_action('admin_bar_menu', function() { upm_edit_admin_bar(['edit-profile', 'my-account'], 'href', home_url('/edit_profile')); } );
    //3. Replace the avatar thumbnail with the custom member image, uploaded in the user meta
    //add_filter( 'get_avatar', 'upm_get_avatar', 10, 5 );
/*********************************************/

//if the logged in user has a role of member, modify the log in and out redirects
add_filter('login_redirect', 'upm_custom_login_redirect', 10, 3 );
add_filter('logout_redirect', 'upm_custom_logout_redirect', 10, 3 );

/*
 * Restrict access to profile and edit_profile pages if member is not logged in
*  or if the logged in user is an administrator
*/
add_action('template_redirect', 'upm_template_redirect');

//Adding link of the custom pages, to the nav menu
add_filter( 'wp_nav_menu_items', 'upm_add_nav_menu_items', 10, 2 );
/***********************************************/


/***********************************************/
/*                Short-codes                  */
/***********************************************/
add_shortcode('register_content', 'upm_register_content');
add_shortcode('login_content', 'upm_login_content');
add_shortcode('profile_content', 'upm_profile_content');
add_shortcode('edit_profile_content', 'upm_edit_profile_content');
add_shortcode('edit_password_content', 'upm_edit_password_content');
/***********************************************/


/***********************************************/
/*               DEACTIVATION                  */
/***********************************************/
//Custom user roles
register_deactivation_hook(UPM_PLUGIN_URL, 'upm_remove_user_roles');
//custom pages
register_deactivation_hook(UPM_PLUGIN_URL,'upm_remove_pages');
//custom tables
register_deactivation_hook(UPM_PLUGIN_URL, 'upm_drop_tables');
/***********************************************/