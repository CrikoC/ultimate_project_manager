<?php

function upm_remove_pages() {
    $register_id = get_option('register');
    wp_delete_post( $register_id, true );

    $login_id = get_option('login');
    wp_delete_post( $login_id, true );

    $profile_id = get_option('profile');
    wp_delete_post( $profile_id, true );

    $edit_profile_id = get_option('edit_profile');
    wp_delete_post( $edit_profile_id, true );

    $edit_password_id = get_option('edit_password');
    wp_delete_post( $edit_password_id, true );
}

function upm_drop_tables() {
    upm_drop_projects();
    upm_drop_work_packages();
    upm_drop_tasks();
    upm_drop_milestones();
    upm_drop_deliverables();
}

function upm_drop_projects() {
    global $wpdb;
    $table_name = $wpdb->prefix."upm_projects";
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

function upm_drop_work_packages() {
    global $wpdb;
    $table_name = $wpdb->prefix."upm_work_packages";
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

function upm_drop_tasks() {
    global $wpdb;
    $table_name = $wpdb->prefix."upm_tasks";
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

function upm_drop_milestones() {
    global $wpdb;
    $table_name = $wpdb->prefix."upm_milestones";
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

function upm_drop_deliverables() {
    global $wpdb;
    $table_name = $wpdb->prefix."deliverables";
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

function upm_remove_user_roles() {
    remove_role('partner');
    remove_role('manager');
}
