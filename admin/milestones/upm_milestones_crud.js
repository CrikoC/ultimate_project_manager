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

    /* Create milestone */
    $("body").on("click",".create-milestone",function(){
        var wp_id = $(this).closest('tr').attr('id');

        $("#create-milestone").find("input[name='wp_id']").val(wp_id);
    });

    $(".crud-create-milestone").click(function(e){
        e.preventDefault();
        var name            = $("#create-milestone").find("input[name='name']").val();
        var slug            = $("#create-milestone").find("input[name='slug']").val();
        var description     = $("#create-milestone").find("textarea[name='description']").val();
        var project_id      = $("input[name='project_id']").val();
        var wp_id           = $("#create-milestone").find("input[name='wp_id']").val();
        var coordinator_id  = $("#create-milestone").find("select[name='coordinator_id']").val();
        var mil_date        = $("#create-milestone").find("input[name='mil_date']").val();
        var reminder        = $("#create-milestone").find("input[name='reminder']").val();

        if (name != "" || slug != "" || coordinator_id != "" || mil_date != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action:         'upm_milestones_create_action',
                    id:             $.md5(slug.toUpperCase()),
                    name:           name,
                    slug:           slug,
                    description:    description,
                    coordinator_id: coordinator_id,
                    wp_id:          wp_id,
                    project_id:     project_id,
                    mil_date:       mil_date,
                    reminder:       reminder,
                    status:         'in_progress'
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_project();
                    //Empty all inputs
                    $("#create-milestone").find(':input').val('');

                    msgSuccess = '<div class="alert alert-success">Milestone Created Successfully.</div>';
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

    /* Edit milestone */
    $("body").on("click",".edit-milestone",function(){
        var id              = $(this).closest('tr').attr('id');
        var slug            = $(this).closest('tr').attr('data-slug');
        var wp_id           = $(this).closest('tr').attr('data-wp-id');
        var project_id           = $(this).closest('tr').attr('data-project-id');
        var description     = $(this).closest('tr').attr('data-description');
        var reminder        = $(this).closest('tr').attr('data-reminder');
        var coordinator_id  = $(this).closest('tr').attr('data-partner-id');
        var name            = $(this).parent('td').next('td').next('td').text();
        var coordinator_name= $(this).parent('td').next('td').next('td').next('td').text();
        var mil_date        = $(this).parent('td').next('td').next('td').next('td').next('td').text();

        var completed      = $(this).closest('tr').attr('data-completed');

        if(completed == 1) {
            $("#edit-milestone").find("input[name='completed']").prop('checked', true);
        } else {
            $("#edit-milestone").find("input[name='completed']").prop('checked', false);
        }

        $("#edit-milestone").find("input[name='id']").val(id);
        $("#edit-milestone").find("input[name='name']").val(name);
        $("#edit-milestone").find("input[name='slug']").val(slug);
        $("#edit-milestone").find("input[name='wp_id']").val(wp_id);
        $("#edit-milestone").find("input[name='project_id']").val(project_id);
        $("#edit-milestone").find("textarea[name='description']").val(description);
        $("#edit-milestone").find("input[name='mil_date']").val(mil_date);
        $("#edit-milestone").find("input[name='reminder']").val(reminder);
        $("#edit-milestone").find("select[name='coordinator_id'] option:first").attr("value", coordinator_id);
        $("#edit-milestone").find("select[name='coordinator_id'] option:first").text(coordinator_name);

    });

    /* Updated new milestone */
    $(".crud-edit-milestone").click(function(e){
        e.preventDefault();
        var id              = $("#edit-milestone").find("input[name='id']").val();
        var name            = $("#edit-milestone").find("input[name='name']").val();
        var slug            = $("#edit-milestone").find("input[name='slug']").val();
        var description     = $("#edit-milestone").find("textarea[name='description']").val();
        var coordinator_id  = $("#edit-milestone").find("select[name='coordinator_id']").val();
        var project_id      = $("#edit-milestone").find("input[name='project_id']").val();
        var wp_id           = $("#edit-milestone").find("input[name='wp_id']").val();
        var mil_date        = $("#edit-milestone").find("input[name='mil_date']").val();
        var reminder        = $("#edit-milestone").find("input[name='reminder']").val();
        var completed       = $("#edit-milestone").find("input[name='completed']").val();
        if (name != "" || slug != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'upm_milestones_update_action',
                    id:             id,
                    name:           name,
                    slug:           slug,
                    description:    description,
                    coordinator_id: coordinator_id,
                    project_id:     project_id,
                    wp_id:          wp_id,
                    mil_date:       mil_date,
                    reminder:       reminder,
                    completed:      completed
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_project();
                    msgSuccess = '<div class="alert alert-success">Milestone Updated Successfully.</div>';
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
    $("body").on("click",".remove-milestone",function(){
        var id          = $(this).closest('tr').attr('id');
        $.ajax({
            url:        ajaxurl,
            type:       'POST',
            dataType:   'json',
            data: {
                action: 'upm_milestones_delete_action',
                id:     id
            },
            success: (function(data) {
                get_project();
                msgSuccess = '<div class="alert alert-success">Milestone Deleted Successfully.</div>';
                msg.after(msgSuccess);
                $('.alert').delay(2000).fadeOut(2000);
            })
        });
    });
});