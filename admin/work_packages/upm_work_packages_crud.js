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

    /* Create new project */
    $(".crud-create-work-package").click(function(e){
        e.preventDefault();
        var name            = $("#create-work-package").find("input[name='name']").val();
        var slug            = $("#create-work-package").find("input[name='slug']").val();
        var description     = $("#create-work-package").find("textarea[name='description']").val();
        var project_id      = $("input[name='project_id']").val();
        var coordinator_id  = $("#create-work-package").find("select[name='coordinator_id']").val();
        var start_date      = $("#create-work-package").find("input[name='start_date']").val();
        var end_date        = $("#create-work-package").find("input[name='end_date']").val();
        var reminder        = $("#create-work-package").find("input[name='reminder']").val();

        console.log(project_id);


        if (name != "" || slug != "" || coordinator_id != "" || start_date != "" || end_date != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action:         'upm_work_packages_create_action',
                    id:             $.md5(slug.toUpperCase()),
                    name:           name,
                    slug:           slug,
                    description:    description,
                    coordinator_id: coordinator_id,
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
                    $("#create-work-package").find(':input').val('');

                    msgSuccess = '<div class="alert alert-success">Work Package Created Successfully.</div>';
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

    /* Edit Work Package */
    $("body").on("click",".edit-work-package",function(){
        var id              = $(this).closest('tr').attr('id');
        var slug            = $(this).closest('tr').attr('data-slug');
        var description     = $(this).closest('tr').attr('data-description');
        var reminder        = $(this).closest('tr').attr('data-reminder');
        var project_id        = $(this).closest('tr').attr('data-project-id');
        var coordinator_id  = $(this).closest('tr').attr('data-partner-id');
        var name            = $(this).parent('td').next('td').next('td').text();
        var coordinator_name= $(this).parent('td').next('td').next('td').next('td').text();
        var start_date      = $(this).parent('td').next('td').next('td').next('td').next('td').text();
        var end_date        = $(this).parent('td').next('td').next('td').next('td').next('td').next('td').text();

        $("#edit-work-package").find("input[name='id']").val(id);
        $("#edit-work-package").find("input[name='name']").val(name);
        $("#edit-work-package").find("input[name='slug']").val(slug);
        $("#edit-work-package").find("textarea[name='description']").val(description);
        $("#edit-work-package").find("input[name='start_date']").val(start_date);
        $("#edit-work-package").find("input[name='end_date']").val(end_date);
        $("#edit-work-package").find("input[name='reminder']").val(reminder);
        $("#edit-work-package").find("select[name='coordinator_id'] option:first").attr("value", coordinator_id);
        $("#edit-work-package").find("select[name='coordinator_id'] option:first").text(coordinator_name);

        $("#edit-work-package").find("input[name='project_id']").val(project_id);
    });

    /* Updated new Work Package */
    $(".crud-edit-work-package").click(function(e){
        e.preventDefault();
        var id              = $("#edit-work-package").find("input[name='id']").val();
        var name            = $("#edit-work-package").find("input[name='name']").val();
        var slug            = $("#edit-work-package").find("input[name='slug']").val();
        var description     = $("#edit-work-package").find("textarea[name='description']").val();
        var coordinator_id  = $("#edit-work-package").find("select[name='coordinator_id']").val();
        var project_id      = $("#edit-work-package").find("input[name='project_id']").val();
        var start_date      = $("#edit-work-package").find("input[name='start_date']").val();
        var end_date        = $("#edit-work-package").find("input[name='end_date']").val();
        var reminder        = $("#edit-work-package").find("input[name='reminder']").val();
        if (name != "" || slug != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'upm_work_packages_update_action',
                    id:             id,
                    name:           name,
                    slug:           slug,
                    description:    description,
                    coordinator_id: coordinator_id,
                    project_id:     project_id,
                    start_date:     start_date,
                    end_date:       end_date,
                    reminder:       reminder
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_project();
                    msgSuccess = '<div class="alert alert-success">Work Package Updated Successfully.</div>';
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
    $("body").on("click",".remove-work-package",function(){
        var id          = $(this).closest('tr').attr('id');
        $.ajax({
            url:        ajaxurl,
            type:       'POST',
            dataType:   'json',
            data: {
                action: 'upm_work_packages_delete_action',
                id:     id
            },
            success: (function(data) {
                get_project();
                msgSuccess = '<div class="alert alert-success">Work Package Deleted Successfully.</div>';
                msg.after(msgSuccess);
                $('.alert').delay(2000).fadeOut(2000);
            })
        });
    });
});