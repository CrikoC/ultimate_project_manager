
jQuery(document).ready(function($){
    $.ajax({
        type: "POST",
        url: ajaxurl,
        dataType: 'html',
        data: {
            action: 'upm_projects_cron_jobs_action'
        },
        success: function (data) {
        }
    });
});