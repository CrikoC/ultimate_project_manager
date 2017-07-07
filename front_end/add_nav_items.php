<?php
function upm_add_nav_menu_items($items) {
    if (!is_user_logged_in()) {
        $items .= '<li><a href="'. home_url("/login").'">Log In</a></li>';
        $items .= '<li><a href="'. home_url("/register").'">Register</a></li>';
    }
    return $items;
}