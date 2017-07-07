<?php
function upm_add_menu_pages() {
    //this is the main item for the menu
    add_menu_page(
        'Ultimate Project Manager', //page title
        'Projects',          //menu title
        'manage_options',   //capabilities
        'projects',          //menu slug
        'upm_projects',      //function
        'dashicons-id-alt'   //Icon
    );

    add_submenu_page(
        'projects',         //parent slug
        'Project',          //Page title
        '',                     //menu title
        'manage_options',   //capabiliy
        'project',          //sub menu slug
        'upm_project'       // function
    );

    add_submenu_page(
        'projects',         //parent slug
        'Users',         //Page title
        'Users',         //menu title
        'manage_options',   //capabiliy
        'users',         //sub menu slug
        'upm_users'      // function
    );
}