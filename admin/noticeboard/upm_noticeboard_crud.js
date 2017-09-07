jQuery(document).ready(function($){
    var msg = $('#msg');

    var id = $('#id').val();

    function get_noticeboard() {
        var project_id = $('#project_id').val();
        $.ajax({
            type: "GET",
            url: ajaxurl,
            dataType: 'html',
            data: {
                action: 'upm_notice_read_action',
                id: project_id
            },
            success: function (data) {
                //Populate the table body with all the projects
                $('#noticeboard-container').html(data);
            }
        });
    }

    get_noticeboard();

    /* Create Task */
    $("body").on("click",".create-notice",function(){

    });

    $(".crud-create-notice").click(function(e){
        e.preventDefault();
        var name            = $("#create-notice").find("input[name='name']").val();
        var slug            = $("#create-notice").find("input[name='slug']").val();
        var description     = $("#create-notice").find("textarea[name='description']").val();
        var project_id      = $("input[name='project_id']").val();

        if (name != "" || slug != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action:         'upm_notice_create_action',
                    id:             $.md5(slug.toUpperCase()),
                    project_id:     project_id,
                    name:           name,
                    slug:           slug,
                    description:    description
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_noticeboard();
                    //Empty all inputs
                    $("#create-notice").find(':input').val('');

                    msgSuccess = '<div class="alert alert-success">Notice Created Successfully.</div>';
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
    $("body").on("click",".edit-notice",function(){
        var id              = $(this).parent().parent().find('#id').val();
        var name            = $(this).parent().parent().find('#name').text();
        var slug            = $(this).parent().parent().find('#slug').val();
        var description     = $(this).parent().parent().find('#description').text();
        var project_id      = $(this).parent().parent().find('#project_id').val();

        $("#edit-notice").find("input[name='id']").val(id);
        $("#edit-notice").find("input[name='name']").val(name);
        $("#edit-notice").find("input[name='slug']").val(slug);
        $("#edit-notice").find("textarea[name='description']").val(description);
        $("#edit-notice").find("input[name='project_id']").val(project_id);
    });

    /* Updated new Task */
    $(".crud-edit-notice").click(function(e){
        e.preventDefault();
        var id          = $("#edit-notice").find("input[name='id']").val();
        var name        = $("#edit-notice").find("input[name='name']").val();
        var slug        = $("#edit-notice").find("input[name='slug']").val();
        var description = $("#edit-notice").find("textarea[name='description']").val();
        var project_id  = $("#edit-notice").find("input[name='project_id']").val();

        if (name != "" || slug != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'upm_notice_update_action',
                    id:             id,
                    name:           name,
                    slug:           slug,
                    description:    description,
                    project_id:     project_id
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_noticeboard();
                    msgSuccess = '<div class="alert alert-success">Notice Updated Successfully.</div>';
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
    $("body").on("click",".remove-notice",function(){
        var id          = $(this).parent().parent().find('#id').val();
        $.ajax({
            url:        ajaxurl,
            type:       'POST',
            dataType:   'json',
            data: {
                action: 'upm_notice_delete_action',
                id:     id
            },
            success: (function(data) {
                get_noticeboard();
                msgSuccess = '<div class="alert alert-success">Notice Deleted Successfully.</div>';
                msg.after(msgSuccess);
                $('.alert').delay(2000).fadeOut(2000);
            })
        });
    });
});