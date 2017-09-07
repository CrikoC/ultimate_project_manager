jQuery(document).ready(function($){
    var msg = $('#msg');

    var id = $('#id').val();

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

    /* Create Task */
    $("body").on("click",".create-task",function(){
        var wp_id = $(this).closest('tr').attr('id');

        $("#create-task").find("input[name='wp_id']").val(wp_id);
    });

    $(".crud-create-task").click(function(e){
        e.preventDefault();
        var name            = $("#create-task").find("input[name='name']").val();
        var slug            = $("#create-task").find("input[name='slug']").val();
        var description     = $("#create-task").find("textarea[name='description']").val();
        var project_id      = $("input[name='project_id']").val();
        var wp_id           = $("#create-task").find("input[name='wp_id']").val();
        var partner_id      = $("#create-task").find("select[name='partner_id']").val();
        var start_date      = $("#create-task").find("input[name='start_date']").val();
        var end_date        = $("#create-task").find("input[name='end_date']").val();
        var reminder        = $("#create-task").find("input[name='reminder']").val();

        if (name != "" || slug != "" || partner_id != "" || start_date != "" || end_date != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action:         'upm_tasks_create_action',
                    id:             $.md5(slug.toUpperCase()),
                    name:           name,
                    slug:           slug,
                    description:    description,
                    partner_id:     partner_id,
                    wp_id:          wp_id,
                    project_id:     project_id,
                    start_date:     start_date,
                    end_date:       end_date,
                    reminder:       reminder,
                    status:         'in_progress'
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_project();
                    //Empty all inputs
                    $("#create-task").find(':input').val('');

                    msgSuccess = '<div class="alert alert-success">Task Created Successfully.</div>';
                    msg.after(msgSuccess);
                    $('.alert').delay(2000).fadeOut(2000);
                },
                error: function (data) {
                    msgDanger = '<div class="alert alert-danger">Error</div>';
                    msg.after(msgDanger);
                    $('.alert').delay(2000).fadeOut(2000);
                }
            });
        }
    });

    /* Edit Task */
    $("body").on("click",".edit-task",function(){
        var id              = $(this).closest('tr').attr('id');
        var slug            = $(this).closest('tr').attr('data-slug');
        var description     = $(this).closest('tr').attr('data-description');
        var reminder        = $(this).closest('tr').attr('data-reminder');
        var partner_id      = $(this).closest('tr').attr('data-partner-id');
        var project_id      = $(this).closest('tr').attr('data-project-id');
        var wp_id        = $(this).closest('tr').attr('data-wp-id');
        var name            = $(this).parent('td').next('td').next('td').text();
        var partner_name    = $(this).parent('td').next('td').next('td').next('td').text();
        var start_date      = $(this).parent('td').next('td').next('td').next('td').next('td').text();
        var end_date        = $(this).parent('td').next('td').next('td').next('td').next('td').next('td').text();

        var completed      = $(this).closest('tr').attr('data-completed');

        if(completed == 1) {
            $("#edit-task").find("input[name='completed']").prop('checked', true);
        } else {
            $("#edit-task").find("input[name='completed']").prop('checked', false);
        }

        $("#edit-task").find("input[name='id']").val(id);
        $("#edit-task").find("input[name='name']").val(name);
        $("#edit-task").find("input[name='slug']").val(slug);
        $("#edit-task").find("textarea[name='description']").val(description);
        $("#edit-task").find("input[name='project_id']").val(project_id);
        $("#edit-task").find("input[name='wp_id']").val(wp_id);
        $("#edit-task").find("input[name='start_date']").val(start_date);
        $("#edit-task").find("input[name='end_date']").val(end_date);
        $("#edit-task").find("input[name='reminder']").val(reminder);
        $("#edit-task").find("select[name='partner_id'] option:first").attr("value", partner_id);
        $("#edit-task").find("select[name='partner_id'] option:first").text(partner_name);

    });

    /* Updated new Task */
    $(".crud-edit-task").click(function(e){
        e.preventDefault();
        var id          = $("#edit-task").find("input[name='id']").val();
        var name        = $("#edit-task").find("input[name='name']").val();
        var slug        = $("#edit-task").find("input[name='slug']").val();
        var description = $("#edit-task").find("textarea[name='description']").val();
        var partner_id  = $("#edit-task").find("select[name='partner_id']").val();
        var project_id  = $("input[name='project_id']").val();
        var wp_id       = $("#edit-task").find("input[name='wp_id']").val();
        var start_date  = $("#edit-task").find("input[name='start_date']").val();
        var end_date    = $("#edit-task").find("input[name='end_date']").val();
        var reminder    = $("#edit-task").find("input[name='reminder']").val();
        var completed   = $("#edit-task").find("input[name='completed']").val();
        if (name != "" || slug != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'upm_tasks_update_action',
                    id:             id,
                    name:           name,
                    slug:           slug,
                    description:    description,
                    partner_id:     partner_id,
                    project_id:     project_id,
                    wp_id:          wp_id,
                    start_date:     start_date,
                    end_date:       end_date,
                    reminder:       reminder,
                    completed:      completed
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_project();
                    msgSuccess = '<div class="alert alert-success">Task Updated Successfully.</div>';
                    msg.after(msgSuccess);
                    $('.alert').delay(2000).fadeOut(2000);
                },
                error: function (err) {
                    console.log(err);
                    msgDanger = '<div class="alert alert-danger">error</div>';
                    msg.after(msgDanger);
                    $('.alert').delay(2000).fadeOut(2000);
                }
            });
        }
    });

    /* Remove project */
    $("body").on("click",".remove-task",function(){
        var id          = $(this).closest('tr').attr('id');
        $.ajax({
            url:        ajaxurl,
            type:       'POST',
            dataType:   'json',
            data: {
                action: 'upm_tasks_delete_action',
                id:     id
            },
            success: (function(data) {
                get_project();
                msgSuccess = '<div class="alert alert-success">Task Deleted Successfully.</div>';
                msg.after(msgSuccess);
                $('.alert').delay(2000).fadeOut(2000);
            })
        });
    });
});