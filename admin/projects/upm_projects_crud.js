jQuery(document).ready(function($){
    var msg = $('#msg');

    //Fetching all rows from database
    function get_projects() {
        $.ajax({
            type: "POST",
            url: ajaxurl,
            dataType: 'html',
            data: {
                action: 'upm_projects_read_action'
            },
            success: function (data) {
                //Populate the table body with all the projects
                $('#projects-list').html(data);
            }
        });
    }
    get_projects();

    /* Create new project */
    $(".crud-create-project").click(function(e){
        e.preventDefault();
        var name        = $("#create-project").find("input[name='name']").val();
        var slug        = $("#create-project").find("input[name='slug']").val();
        var description = $("#create-project").find("textarea[name='description']").val();
        var manager_id  = $("#create-project").find("input[name='manager_id']").val();
        var start_date  = $("#create-project").find("input[name='start_date']").val();
        var end_date    = $("#create-project").find("input[name='end_date']").val();
        var reminder    = $("#create-project").find("input[name='reminder']").val();

        if (name != "" || slug != "" || manager_id != "" || start_date != "" || end_date != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action:         'upm_projects_create_action',
                    id:             $.md5(slug.toUpperCase()),
                    name:           name,
                    slug:           slug,
                    description:    description,
                    manager_id:     manager_id,
                    start_date:     start_date,
                    end_date:       end_date,
                    reminder:       reminder,
                    status:         'in_progress'
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_projects();

                    //Empty all inputs
                    $("#create-project").children('input').each(function () {
                        $(this).val('');
                    });

                    msgSuccess = '<div class="alert alert-success">project Created Successfully.</div>';
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

    /* Edit project */
    $("body").on("click",".edit-project",function(){
        var id          = $(this).parent().parent().parent().find('#id').val();
        var name        = $(this).parent().parent().parent().find('#name').text();
        var slug        = $(this).parent().parent().parent().find('#slug').val();
        var description = $(this).parent().parent().parent().find('#description').text();
        var start_date  = $(this).parent().parent().parent().find('#start_date').text();
        var end_date    = $(this).parent().parent().parent().find('#end_date').text();
        var reminder    = $(this).parent().parent().parent().find('#reminder').text();

        $("#edit-project").find("input[name='id']").val(id);
        $("#edit-project").find("input[name='name']").val(name);
        $("#edit-project").find("input[name='slug']").val(slug);
        $("#edit-project").find("textarea[name='description']").val(description);
        $("#edit-project").find("input[name='start_date']").val(start_date);
        $("#edit-project").find("input[name='end_date']").val(end_date);
        $("#edit-project").find("input[name='reminder']").val(reminder);
    });

    /* Updated new project */
    $(".crud-edit-project").click(function(e){
        e.preventDefault();
        var id          = $("#edit-project").find("input[name='id']").val();
        var name        = $("#edit-project").find("input[name='name']").val();
        var slug        = $("#edit-project").find("input[name='slug']").val();
        var description = $("#edit-project").find("textarea[name='description']").val();
        var manager_id  = $("#edit-project").find("input[name='manager_id']").val();
        var start_date  = $("#edit-project").find("input[name='start_date']").val();
        var end_date    = $("#edit-project").find("input[name='end_date']").val();
        var reminder    = $("#edit-project").find("input[name='reminder']").val();
        if (name != "" || slug != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'upm_projects_update_action',
                    id:             id,
                    name:           name,
                    slug:           slug,
                    description:    description,
                    manager_id:     manager_id,
                    start_date:     start_date,
                    end_date:       end_date,
                    reminder:       reminder,
                    status:         status
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_projects();
                    msgSuccess = '<div class="alert alert-success">Project Updated Successfully.</div>';
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
    $("body").on("click",".remove-project",function(){
        var id          = $(this).parent().parent().parent().find('#id').val();
        $.ajax({
            url:        ajaxurl,
            type:       'POST',
            dataType:   'json',
            data: {
                action: 'upm_projects_delete_action',
                id:     id
            },
            success: (function(data) {
                get_projects();
                msgSuccess = '<div class="alert alert-success">Project Deleted Successfully.</div>';
                msg.after(msgSuccess);
                $('.alert').delay(2000).fadeOut(2000);
            })
        });
    });
});