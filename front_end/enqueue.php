<?php
function upm_front_end_enqueue()
{
    wp_register_style('upm_styles_css', plugins_url('/front_end/css/styles.css', MP_PLUGIN_URL));
    wp_enqueue_style('upm_styles_css');
}
