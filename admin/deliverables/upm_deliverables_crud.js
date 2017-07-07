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


    /* Create deliverable */
    $("body").on("click",".create-deliverable",function(){
        var task_id = $(this).closest('tr').attr('id');

        $("#create-deliverable").find("input[name='task_id']").val(task_id);
    });

    $(".crud-create-deliverable").click(function(e){
        e.preventDefault();
        var name            = $("#create-deliverable").find("input[name='name']").val();
        var slug            = $("#create-deliverable").find("input[name='slug']").val();
        var description     = $("#create-deliverable").find("textarea[name='description']").val();
        var project_id      = $("input[name='project_id']").val();
        var task_id         = $("#create-deliverable").find("input[name='task_id']").val();
        var partner_id      = $("#create-deliverable").find("select[name='partner_id']").val();
        var del_date        = $("#create-deliverable").find("input[name='del_date']").val();
        var reminder        = $("#create-deliverable").find("input[name='reminder']").val();

        if (name != "" || slug != "" || partner_id != "" || mil_date != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action:         'upm_deliverables_create_action',
                    id:             $.md5(slug.toUpperCase()),
                    name:           name,
                    slug:           slug,
                    description:    description,
                    partner_id:     partner_id,
                    task_id:        task_id,
                    project_id:     project_id,
                    del_date:       del_date,
                    reminder:       reminder,
                    status:         'in_progress'
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_project();
                    //Empty all inputs
                    $("#create-deliverable").find(':input').val('');

                    msgSuccess = '<div class="alert alert-success">deliverable Created Successfully.</div>';
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

    /* Edit deliverable */
    $("body").on("click",".edit-deliverable",function(){
        var id              = $(this).closest('tr').attr('id');
        var slug            = $(this).closest('tr').attr('data-slug');
        var description     = $(this).closest('tr').attr('data-description');
        var reminder        = $(this).closest('tr').attr('data-reminder');
        var task_id         = $(this).closest('tr').attr('data-task-id');
        var partner_id      = $(this).closest('tr').attr('data-partner-id');
        var name            = $(this).parent('td').next('td').next('td').text();
        var partner_name    = $(this).parent('td').next('td').next('td').next('td').text();
        var del_date        = $(this).parent('td').next('td').next('td').next('td').next('td').text();

        var completed      = $(this).closest('tr').attr('data-completed');

        if(completed == 1) {
            $("#edit-deliverable").find("input[name='completed']").prop('checked', true);
        } else {
            $("#edit-deliverable").find("input[name='completed']").prop('checked', false);
        }

        $("#edit-deliverable").find("input[name='id']").val(id);
        $("#edit-deliverable").find("input[name='name']").val(name);
        $("#edit-deliverable").find("input[name='slug']").val(slug);
        $("#edit-deliverable").find("input[name='task_id']").val(task_id);
        $("#edit-deliverable").find("textarea[name='description']").val(description);
        $("#edit-deliverable").find("input[name='del_date']").val(del_date);
        $("#edit-deliverable").find("input[name='reminder']").val(reminder);
        $("#edit-deliverable").find("select[name='partner_id'] option:first").attr("value", partner_id);
        $("#edit-deliverable").find("select[name='partner_id'] option:first").text(partner_name);

    });

    /* Updated new deliverable */
    $(".crud-edit-deliverable").click(function(e){
        e.preventDefault();
        var id          = $("#edit-deliverable").find("input[name='id']").val();
        var name        = $("#edit-deliverable").find("input[name='name']").val();
        var slug        = $("#edit-deliverable").find("input[name='slug']").val();
        var description = $("#edit-deliverable").find("textarea[name='description']").val();
        var partner_id  = $("#edit-deliverable").find("select[name='partner_id']").val();
        var project_id  = $("input[name='project_id']").val();
        var task_id     = $("#edit-deliverable").find("input[name='task_id']").val();
        var mil_date    = $("#edit-deliverable").find("input[name='del_date']").val();
        var reminder    = $("#edit-deliverable").find("input[name='reminder']").val();
        var completed   = $("#edit-deliverable").find("input[name='completed']").val();
        if (name != "" || slug != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'upm_deliverables_update_action',
                    id:             id,
                    name:           name,
                    slug:           slug,
                    description:    description,
                    partner_id:     partner_id,
                    project_id:     project_id,
                    task_id:        task_id,
                    mil_date:       mil_date,
                    reminder:       reminder,
                    status:         status,
                    completed:      completed
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_project();
                    msgSuccess = '<div class="alert alert-success">deliverable Updated Successfully.</div>';
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
    $("body").on("click",".remove-deliverable",function(){
        var id          = $(this).closest('tr').attr('id');
        $.ajax({
            url:        ajaxurl,
            type:       'POST',
            dataType:   'json',
            data: {
                action: 'upm_deliverables_delete_action',
                id:     id
            },
            success: (function(data) {
                get_project();
                msgSuccess = '<div class="alert alert-success">deliverable Deleted Successfully.</div>';
                msg.after(msgSuccess);
                $('.alert').delay(2000).fadeOut(2000);
            })
        });
    });
});