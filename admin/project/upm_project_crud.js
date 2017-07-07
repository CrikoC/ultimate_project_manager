jQuery(document).ready(function($){
    //Fetching the project
    function get_project() {
        var project_id = $('#project_id').val();
        $.ajax({
            type: "GET",
            url: ajaxurl,
            dataType: 'html',
            data: {
                action: 'upm_project_read_action',
                id: project_id
            },
            success: function (data) {
                //Populate the table body with all the projects
                $('#project-container').html(data);
            }
        });
    }
    get_project();
});