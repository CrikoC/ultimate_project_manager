jQuery(document).ready(function($){
    var msg = $('#msg');

    //Fetching all rows from database
    function get_users() {
        $.ajax({
            type: "POST",
            url: ajaxurl,
            dataType: 'html',
            data: {
                action: 'upm_users_read_action'
            },
            success: function (data) {
                //Populate the table body with all the partners
                $('#users-list').html(data);
            }
        });
    }
    get_users();


    /* Create new user */
    $(".crud-create-user").click(function(e){
        e.preventDefault();
        var user_login  =  $("#create-user").find("input[name='user_login']").val();
        var user_pass    =  $("#create-user").find("input[name='user_pass']").val();
        var first_name  =  $("#create-user").find("input[name='first_name']").val();
        var last_name   =  $("#create-user").find("input[name='last_name']").val();
        var user_email  =  $("#create-user").find("input[name='user_email']").val();
        var manager_id  =  $("#create-user").find("input[name='manager_id']").val();
        var telephone   =  $("#create-user").find("input[name='telephone']").val();
        var cellphone   =  $("#create-user").find("input[name='cellphone']").val();
        var user_url    =  $("#create-user").find("input[name='user_url']").val();

        if (user_login != "" || password != "" || user_email != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action:     'upm_users_create_action',
                    user_login: user_login,
                    user_pass:   user_pass,
                    first_name: first_name,
                    last_name:  last_name,
                    user_email: user_email,
                    manager_id: manager_id,
                    telephone:  telephone,
                    cellphone:  cellphone,
                    user_url:   user_url,
                    role:       'partner'
                },
                success: function (data) {
                    console.log('success');
                    $(".modal").modal('hide');

                    get_users();

                    //Empty all inputs
                    $("#create-user").children('input').each(function () {
                        $(this).val('');
                    });


                    msgSuccess = '<div class="alert alert-success">User Created Successfully.</div>';
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

    /* Edit user */
    $("body").on("click",".edit-user",function(){
        var id          = $(this).parent().parent().parent().find('#user_id').val();
        var user_login  = $(this).parent().parent().parent().find('#user_login').val();
        var first_name  = $(this).parent().parent().parent().find('#first_name').text();
        var last_name   = $(this).parent().parent().parent().find('#last_name').text();
        var user_email  = $(this).parent().parent().parent().find('#user_email').text();
        var user_url    = $(this).parent().parent().parent().find('#user_url').text();
        var telephone   = $(this).parent().parent().parent().find('#telephone').text();
        var cellphone   = $(this).parent().parent().parent().find('#cellphone').text();

        $("#edit-user").find("input[name='user_id']").val(id);
        $("#edit-user").find("input[name='user_login']").val(user_login);
        $("#edit-user").find("input[name='first_name']").val(first_name);
        $("#edit-user").find("input[name='last_name']").val(last_name);
        $("#edit-user").find("input[name='user_email']").val(user_email);
        $("#edit-user").find("input[name='user_url']").val(user_url);
        $("#edit-user").find("input[name='telephone']").val(telephone);
        $("#edit-user").find("input[name='cellphone']").val(cellphone);
    });

    /* Updated new user */
    $(".crud-edit-user").click(function(e){
        e.preventDefault();
        var id          =  $("#edit-user").find("input[name='user_id']").val();
        var first_name  =  $("#edit-user").find("input[name='first_name']").val();
        var last_name   =  $("#edit-user").find("input[name='last_name']").val();
        var user_email  =  $("#edit-user").find("input[name='user_email']").val();
        var telephone   =  $("#edit-user").find("input[name='telephone']").val();
        var cellphone   =  $("#edit-user").find("input[name='cellphone']").val();
        var user_url    =  $("#edit-user").find("input[name='user_url']").val();
        if (first_name != ""  || last_name != "" || user_email != "") {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'upm_users_update_action',
                    id:         id,
                    first_name: first_name,
                    last_name:  last_name,
                    user_email: user_email,
                    user_url:   user_url,
                    telephone:  telephone,
                    cellphone:  cellphone
                },
                success: function (data) {
                    $(".modal").modal('hide');
                    get_users();
                    msgSuccess = '<div class="alert alert-success">User Updated Successfully.</div>';
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


    /* Edit user Password */
    // $("body").on("click",".edit-user-password",function(){
    //     var id = $(this).parent().parent().parent().find('#user_id').val();
    //     $("#edit-user-password").find("input[name='user_id']").val(id);
    //
    // });

    // /* Updated new partner */
    // $(".crud-edit-user-password").click(function(e){
    //     e.preventDefault();
    //     var id =  $("#edit-user-password").find("input[name='user_id']").val();
    //     var new_pass = $("#edit-user-password").find("input[name='new_pass']").val();
    //     var repeat_new_pass  = $("#edit-user-password").find("input[name='repeat_new_pass']").val();
    //
    //     if (new_pass != "" || repeat_new_pass != "") {
    //         $.ajax({
    //             url: ajaxurl,
    //             type: 'POST',
    //             dataType: 'json',
    //             data: {
    //                 action: 'upm_users_update_password_action',
    //                 id: id,
    //                 new_pass: new_pass,
    //                 repeat_new_pass: repeat_new_pass
    //
    //             },
    //             success: function (data) {
    //                 $(".modal").modal('hide');
    //                 get_users();
    //                 msgSuccess = '<div class="alert alert-success">User password Updated Successfully.</div>';
    //                 msg.after(msgSuccess);
    //                 $('.alert').delay(2000).fadeOut(2000);
    //             },
    //             error: function (err) {
    //                 console.log(err);
    //                 msgDanger = '<div class="alert alert-danger">error</div>';
    //                 msg.after(msgDanger);
    //                 $('.alert').delay(2000).fadeOut(2000);
    //             }
    //         });
    //     }
    // });


    /* Remove user */
    $("body").on("click",".remove-user",function(){
        var id = $(this).parent().parent().parent().find('#user_id').val();
        $.ajax({
            url:        ajaxurl,
            type:       'POST',
            dataType:   'json',
            data: {
                action: 'upm_users_delete_action',
                id:     id
            },
            success: (function(data) {
                get_users();
                msgSuccess = '<div class="alert alert-success">User Deleted Successfully.</div>';
                msg.after(msgSuccess);
                $('.alert').delay(2000).fadeOut(2000);
            })
        });
    });
});