<?php

function upm_add_user_roles() {
    add_role( 'partner', 'Partner', ['read' => true, 'level_0' => true ]);

    add_role('manager', 'Manager',
        array(
            // Dashboard
            'read'              => true,  // true allows this capability
            'edit_posts'        => false, // Allows user to edit their own posts
            'edit_pages'        => false, // Allows user to edit pages
            'edit_others_posts' => false, // Allows user to edit others posts not just their own
            'create_posts'      => false, // Allows user to create new posts
            'manage_categories' => false, // Allows user to manage post categories
            'publish_posts'     => false, // Allows the user to publish, otherwise posts stays in draft mode
            'manage_options'    => true
        )
    );
}

function upm_disable_wp_cron() {
    define('DISABLE_WP_CRON', true);
}


// function to create the DB / Options / Defaults					
function upm_create_tables() {
    upm_create_projects();
    upm_create_work_packages();
    upm_create_tasks();
    upm_create_milestones();
    upm_create_deliverables();
}

function upm_create_projects() {
    global $wpdb;

    $table_name = $wpdb->prefix . "upm_projects";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS `". $table_name."` (
        `id` varchar(250) NOT NULL,
        `name` varchar(250) CHARACTER SET utf8 NOT NULL,
        `slug` varchar(250) CHARACTER SET utf8 NOT NULL,
        `description` TEXT CHARACTER SET utf8 NOT NULL,
        `manager_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `start_date` DATE,
        `end_date` DATE,
        `reminder` DATE,
        `status` varchar(250) CHARACTER SET utf8 NOT NULL,
        `completed` TINYINT,
        PRIMARY KEY (`id`)
    ) $charset_collate; ";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function upm_create_work_packages() {
    global $wpdb;

    $table_name = $wpdb->prefix . "upm_work_packages";

    $sql .= "CREATE TABLE IF NOT EXISTS `". $table_name."` (
        `id` varchar(250) NOT NULL,
        `name` varchar(250) CHARACTER SET utf8 NOT NULL,
        `slug` varchar(250) CHARACTER SET utf8 NOT NULL,
        `description` TEXT CHARACTER SET utf8 NOT NULL,
        `project_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `coordinator_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `start_date` DATE,
        `end_date` DATE,
        `reminder` DATE,
        `status` varchar(250) CHARACTER SET utf8 NOT NULL,
        PRIMARY KEY (`id`)
    ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function upm_create_tasks() {
    global $wpdb;

    $table_name = $wpdb->prefix . "upm_tasks";

    $sql .= "CREATE TABLE IF NOT EXISTS `". $table_name."` (
        `id` varchar(250) NOT NULL,
        `name` varchar(250) CHARACTER SET utf8 NOT NULL,
        `slug` varchar(250) CHARACTER SET utf8 NOT NULL,
        `description` TEXT CHARACTER SET utf8 NOT NULL,
        `project_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `wp_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `partner_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `start_date` DATE,
        `end_date` DATE,
        `reminder` DATE,
        `status` varchar(250) CHARACTER SET utf8 NOT NULL,
        `completed` TINYINT,
      
        PRIMARY KEY (`id`)
    ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function upm_create_milestones() {
    global $wpdb;

    $table_name = $wpdb->prefix . "upm_milestones";

    $sql .= "CREATE TABLE IF NOT EXISTS `". $table_name."` (
        `id` varchar(250) NOT NULL,
        `name` varchar(250) CHARACTER SET utf8 NOT NULL,
        `slug` varchar(250) CHARACTER SET utf8 NOT NULL,
        `description` TEXT CHARACTER SET utf8 NOT NULL,
        `project_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `wp_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `coordinator_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `mil_date` DATE,
        `reminder` DATE,
        `status` varchar(250) CHARACTER SET utf8 NOT NULL,
        `completed` TINYINT,
        PRIMARY KEY (`id`)
    ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function upm_create_deliverables() {
    global $wpdb;

    $table_name = $wpdb->prefix . "upm_deliverables";

    $sql .= "CREATE TABLE IF NOT EXISTS `". $table_name."` (
        `id` varchar(250) NOT NULL,
        `name` varchar(250) CHARACTER SET utf8 NOT NULL,
        `slug` varchar(250) CHARACTER SET utf8 NOT NULL,
        `description` TEXT CHARACTER SET utf8 NOT NULL,
        `project_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `task_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `partner_id` varchar(250) CHARACTER SET utf8 NOT NULL,
        `del_date` DATE,
        `reminder` DATE,
        `status` varchar(250) CHARACTER SET utf8 NOT NULL,
        `completed` TINYINT,
        PRIMARY KEY (`id`)
    ) $charset_collate; ";


    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}
