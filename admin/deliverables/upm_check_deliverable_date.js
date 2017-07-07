jQuery(document).ready(function($) {
    $("body").on("click",".create-deliverable",function(){
        var task_start_date = $(this).closest('tr').attr('data-task-start-date');
        var task_end_date = $(this).closest('tr').attr('data-task-end-date');

        $("#create-deliverable").find("input[name='task_start_date']").val(task_start_date);
        $("#create-deliverable").find("input[name='task_end_date']").val(task_end_date);
    });

    $("#create-deliverable").find("input[name='del_date']").change(check);
    function check() {
        var del_date = $("#create-deliverable").find("input[name='del_date']").val();

        var task_start_date = $("#create-deliverable").find("input[name='task_start_date']").val();
        var task_end_date = $("#create-deliverable").find("input[name='task_end_date']").val();

        div   = $('.createDeliverableForm > div:eq(2)');
        input = $('.createDeliverableForm > div:eq(2) > input');
        label = $('.createDeliverableForm > div:eq(2) > label');
        icons = $('.createDeliverableForm > div:eq(2) > .glyphicon');

        message = $('.createDeliverableForm > div:eq(2) > .help-block');

        submit = $('.createDeliverableForm .btn');

        if(
            (!del_date) ||
            (new Date(del_date) < new Date(task_start_date)) ||
            (new Date(del_date) > new Date(task_end_date))

        ) {
            div.addClass('has-error');
            div.removeClass('has-success');

            icons.addClass('glyphicon-remove');
            icons.removeClass('glyphicon-ok');

            submit.addClass('hidden');

            message.text('Invalid Date range!');
        } else {
            div.addClass('has-success');
            div.removeClass('has-error');

            icons.addClass('glyphicon-ok');
            icons.removeClass('glyphicon-remove');

            submit.removeClass('hidden');

            message.text('Date range ok!');
        }
    }

    $("#create-deliverable").find("input[name='reminder']").change(check_rem);
    function check_rem() {

        var reminder = $("#create-deliverable").find("input[name='reminder']").val();
        var task_start_date = $("#create-deliverable").find("input[name='task_start_date']").val();
        var task_end_date = $("#create-deliverable").find("input[name='task_end_date']").val();

        rem_div   = $('.createDeliverableForm > div:eq(3)');
        rem_input = $('.createDeliverableForm > div:eq(3) > input');
        rem_label = $('.createDeliverableForm > div:eq(3) > label');
        rem_icons = $('.createDeliverableForm > div:eq(3) > .glyphicon');

        message = $('.createDeliverableForm > div:eq(3) > .help-block');

        submit = $('.createDeliverableForm .btn');

        if(
            (!reminder) ||
            (!task_start_date) ||
            (!task_end_date) ||
            (new Date(reminder) < new Date(task_start_date)) ||
            (new Date(reminder) > new Date(task_end_date))

        ) {
            rem_div.addClass('has-error');
            rem_div.removeClass('has-success');

            rem_icons.addClass('glyphicon-remove');
            rem_icons.removeClass('glyphicon-ok');

            submit.addClass('hidden');

            message.text('Invalid reminder.');
        } else {
            rem_div.addClass('has-success');
            rem_div.removeClass('has-error');

            rem_icons.addClass('glyphicon-ok');
            rem_icons.removeClass('glyphicon-remove');

            submit.removeClass('hidden');

            message.text('Reminder ok!');
        }
    }
});

jQuery(document).ready(function($) {
    $("body").on("click",".edit-deliverable",function(){
        var task_start_date = $(this).closest('tr').attr('data-task-start-date');
        var task_end_date = $(this).closest('tr').attr('data-task-end-date');

        $("#edit-deliverable").find("input[name='task_start_date']").val(task_start_date);
        $("#create-deliverable").find("input[name='task_end_date']").val(task_end_date);
    });

    $("#edit-deliverable").find("input[name='end_date']").change(check);
    function check() {
        var del_date = $("#edit-deliverable").find("input[name='del_date']").val();

        var task_start_date = $("#edit-deliverable").find("input[name='task_start_date']").val();
        var task_end_date = $("#edit-deliverable").find("input[name='task_end_date']").val();


        div        = $('.editDeliverableForm > div:eq(2)');
        input      = $('.editDeliverableForm > div:eq(2) > input');
        label      = $('.editDeliverableForm > div:eq(2) > label');
        icons      = $('.editDeliverableForm > div:eq(2) > .glyphicon');

        message    = $('.editDeliverableForm > div:eq(2) > div:eq(1) > .help-block');

        submit     = $('.editDeliverableForm .btn');

        if(
            (!del_date) ||
            (new Date(del_date).getTime() < new Date(task_start_date).getTime()) ||
            (new Date(del_date).getTime() > new Date(task_end_date).getTime())
        ) {
            div.addClass('has-error');
            div.removeClass('has-success');

            icons.addClass('glyphicon-remove');
            icons.removeClass('glyphicon-ok');

            $submit.addClass('hidden');

            $message.text('Invalid Date range!');
        } else {
            div.addClass('has-success');
            div.removeClass('has-error');

            icons.addClass('glyphicon-ok');
            icons.removeClass('glyphicon-remove');

            submit.removeClass('hidden');

            message.text('Date range ok!');
        }
    }

    $("#edit-deliverable").find("input[name='reminder']").change(check_rem);
    function check_rem() {

        var reminder = $("#edit-deliverable").find("input[name='reminder']").val();
        var task_start_date = $("#edit-deliverable").find("input[name='task_start_date']").val();
        var task_end_date = $("#edit-deliverable").find("input[name='task_end_date']").val();

        rem_div   = $('.editDeliverableForm > div:eq(3)');
        rem_input = $('.editDeliverableForm > div:eq(3) > input');
        rem_label = $('.editDeliverableForm > div:eq(3) > label');
        rem_icons = $('.editDeliverableForm > div:eq(3) > .glyphicon');

        message = $('.editDeliverableForm > div:eq(3) > .help-block');

        submit = $('.editDeliverableForm .btn');

        if(
            (!reminder) ||
            (!task_start_date) ||
            (!task_end_date) ||
            (new Date(reminder) < new Date(task_start_date)) ||
            (new Date(reminder) > new Date(task_end_date))

        ) {
            rem_div.addClass('has-error');
            rem_div.removeClass('has-success');

            rem_icons.addClass('glyphicon-remove');
            rem_icons.removeClass('glyphicon-ok');

            submit.addClass('hidden');

            message.text('Invalid reminder.');
        } else {
            rem_div.addClass('has-success');
            rem_div.removeClass('has-error');

            rem_icons.addClass('glyphicon-ok');
            rem_icons.removeClass('glyphicon-remove');

            submit.removeClass('hidden');

            message.text('Reminder ok!');
        }
    }
});