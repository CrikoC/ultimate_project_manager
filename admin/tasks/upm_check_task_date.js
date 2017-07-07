jQuery(document).ready(function($) {
    $("body").on("click",".create-task",function(){
        var wp_start_date = $(this).closest('tr').attr('data-wp-start-date');
        var wp_end_date = $(this).closest('tr').attr('data-wp-end-date');

        $("#create-task").find("input[name='wp_start_date']").val(wp_start_date);
        $("#create-task").find("input[name='wp_end_date']").val(wp_end_date);
    });

    $("#create-task").find("input[name='start_date']").change(check_start);
    function check_start() {
        var start_date = $("#create-task").find("input[name='start_date']").val();

        var wp_start_date = $("#create-task").find("input[name='wp_start_date']").val();
        var wp_end_date = $("#create-task").find("input[name='wp_end_date']").val();

        start_div   = $('.createTaskForm > div:eq(2) > div:eq(0)');
        start_input = $('.createTaskForm > div:eq(2) > div:eq(0) > input');
        start_label = $('.createTaskForm > div:eq(2) > div:eq(0) > label');
        start_icons = $('.createTaskForm > div:eq(2) > div:eq(0) > .glyphicon');

        start_message = $('.createTaskForm > div:eq(2) > div:eq(0) > .help-block');

        submit = $('.createTaskForm .btn');

        if(
            (!start_input) ||
            (new Date(start_date) < new Date(wp_start_date)) ||
            (new Date(start_date) > new Date(wp_end_date))

        ) {
            start_div.addClass('has-error');
            start_div.removeClass('has-success');

            start_icons.addClass('glyphicon-remove');
            start_icons.removeClass('glyphicon-ok');

            start_message.text('Invalid Date range!');

            submit.addClass('hidden');
        } else {
            start_div.addClass('has-success');
            start_div.removeClass('has-error');

            start_icons.addClass('glyphicon-ok');
            start_icons.removeClass('glyphicon-remove');

            start_message.text('Date range ok!');

            submit.removeClass('hidden');
        }
    }

    $("#create-task").find("input[name='end_date']").change(check_end);
    function check_end() {
        var start_date = $("#create-task").find("input[name='start_date']").val();
        var end_date = $("#create-task").find("input[name='end_date']").val();

        var wp_start_date = $("#create-task").find("input[name='wp_start_date']").val();
        var wp_end_date = $("#create-task").find("input[name='wp_end_date']").val();

        end_div     = $('.createTaskForm > div:eq(2) > div:eq(1)');
        end_input   = $('.createTaskForm > div:eq(2) > div:eq(1) > input');
        end_label   = $('.createTaskForm > div:eq(2) > div:eq(1) > label');
        end_icons   = $('.createTaskForm > div:eq(2) > div:eq(1) > .glyphicon');

        end_message = $('.createTaskForm > div:eq(2) > div:eq(1) > .help-block');

        submit = $('.createTaskForm .btn');

        if(
            (!end_date) ||
            (!start_date) ||
            (new Date(end_date) < new Date(start_date)) ||
            (new Date(end_date) < new Date(wp_start_date)) ||
            (new Date(end_date) > new Date(wp_end_date))

        ) {
            end_div.addClass('has-error');
            end_div.removeClass('has-success');

            end_icons.addClass('glyphicon-remove');
            end_icons.removeClass('glyphicon-ok');

            end_message.text('Invalid Date range!');

            submit.addClass('hidden');
        } else {
            end_div.addClass('has-success');
            end_div.removeClass('has-error');

            end_icons.addClass('glyphicon-ok');
            end_icons.removeClass('glyphicon-remove');

            end_message.text('Date range ok!');

            submit.removeClass('hidden');
        }
    }

    $("#create-task").find("input[name='reminder']").change(check_rem);
    function check_rem() {
        var reminder = $("#create-task").find("input[name='reminder']").val();
        var start_date = $("#create-task").find("input[name='start_date']").val();
        var end_date = $("#create-task").find("input[name='end_date']").val();

        rem_div   = $('.createTaskForm > div:eq(3)');
        rem_input = $('.createTaskForm > div:eq(3) > input');
        rem_label = $('.createTaskForm > div:eq(3) > label');
        rem_icons = $('.createTaskForm > div:eq(3) > .glyphicon');

        rem_message = $('.createTaskForm > div:eq(3) > .help-block');

        submit = $('.createTaskForm .btn');

        if(
            (!reminder) ||
            (!start_date) ||
            (!end_date) ||
            (new Date(reminder) < new Date(start_date)) ||
            (new Date(reminder) > new Date(end_date))
        ) {
            rem_div.addClass('has-error');
            rem_div.removeClass('has-success');

            rem_icons.addClass('glyphicon-remove');
            rem_icons.removeClass('glyphicon-ok');

            rem_message.text('Invalid reminder.');

            submit.addClass('hidden');
        } else {
            rem_div.addClass('has-success');
            rem_div.removeClass('has-error');

            rem_icons.addClass('glyphicon-ok');
            rem_icons.removeClass('glyphicon-remove');

            rem_message.text('Reminder ok!');

            submit.removeClass('hidden');
        }
    }
});

jQuery(document).ready(function($) {
    $("body").on("click",".edit-task",function(){
        var wp_start_date = $(this).closest('tr').attr('data-wp-start-date');
        var wp_end_date = $(this).closest('tr').attr('data-wp-end-date');

        $("#edit-task").find("input[name='wp_start_date']").val(wp_start_date);
        $("#edit-task").find("input[name='wp_end_date']").val(wp_end_date);
    });

    $("#edit-task").find("input[name='start_date']").change(check_start);
    function check_start() {
        var start_date = $("#edit-task").find("input[name='start_date']").val();

        var wp_start_date = $("#edit-task").find("input[name='wp_start_date']").val();
        var wp_end_date = $("#edit-task").find("input[name='wp_end_date']").val();

        start_div   = $('.editTaskForm > div:eq(2) > div:eq(0)');
        start_input = $('.editTaskForm > div:eq(2) > div:eq(0) > input');
        start_label = $('.editTaskForm > div:eq(2) > div:eq(0) > label');
        start_icons = $('.editTaskForm > div:eq(2) > div:eq(0) > .glyphicon');

        start_message = $('.editTaskForm > div:eq(2) > div:eq(0) > .help-block');

        submit = $('.editTaskForm .btn');

        if(
            (!start_date) ||
            (new Date(start_date) < new Date(wp_start_date)) ||
            (new Date(start_date) > new Date(wp_end_date))

        ) {
            start_div.addClass('has-error');
            start_div.removeClass('has-success');

            start_icons.addClass('glyphicon-remove');
            start_icons.removeClass('glyphicon-ok');

            submit.addClass('hidden');

            start_message.text('Invalid Date range!');
        } else {
            start_div.addClass('has-success');
            start_div.removeClass('has-error');

            start_icons.addClass('glyphicon-ok');
            start_icons.removeClass('glyphicon-remove');

            submit.removeClass('hidden');

            start_message.text('Date range ok!');
        }
    }

    $("#edit-task").find("input[name='end_date']").change(check_end);
    function check_end() {
        var start_date = $("#edit-task").find("input[name='start_date']").val();
        var end_date = $("#edit-task").find("input[name='end_date']").val();

        var wp_start_date = $("#edit-task").find("input[name='wp_start_date']").val();
        var wp_end_date = $("#edit-task").find("input[name='wp_end_date']").val();

        end_div     = $('.editTaskForm > div:eq(2) > div:eq(1)');
        end_input   = $('.editTaskForm > div:eq(2) > div:eq(1) > input');
        end_label   = $('.editTaskForm > div:eq(2) > div:eq(1) > label');
        end_icons   = $('.editTaskForm > div:eq(2) > div:eq(1) > .glyphicon');

        end_message = $('.editTaskForm > div:eq(2) > div:eq(1) > .help-block');

        submit = $('.editTaskForm .btn');

        if(
            (!end_date) ||
            (!start_date) ||
            (new Date(end_date) < new Date(start_date)) ||
            (new Date(end_date) < new Date(wp_start_date)) ||
            (new Date(end_date) > new Date(wp_end_date))

        ) {
            end_div.addClass('has-error');
            end_div.removeClass('has-success');

            end_icons.addClass('glyphicon-remove');
            end_icons.removeClass('glyphicon-ok');

            end_message.text('Invalid Date range!');

            submit.addClass('hidden');
        } else {
            end_div.addClass('has-success');
            end_div.removeClass('has-error');

            end_icons.addClass('glyphicon-ok');
            end_icons.removeClass('glyphicon-remove');

            end_message.text('Date range ok!');

            submit.removeClass('hidden');
        }
    }

    $("#edit-task").find("input[name='reminder']").change(check_rem);
    function check_rem() {

        var reminder = $("#edit-task").find("input[name='reminder']").val();
        var start_date = $("#edit-task").find("input[name='start_date']").val();
        var end_date = $("#edit-task").find("input[name='end_date']").val();

        rem_div   = $('.editTaskForm > div:eq(3)');
        rem_input = $('.editTaskForm > div:eq(3) > input');
        rem_label = $('.editTaskForm > div:eq(3) > label');
        rem_icons = $('.editTaskForm > div:eq(3) > .glyphicon');

        rem_message = $('.editTaskForm > div:eq(3) > .help-block');

        submit = $('.editTaskForm .btn');

        if(
            (!reminder) ||
            (!start_date) ||
            (!end_date) ||
            (new Date(reminder) < new Date(start_date)) ||
            (new Date(reminder) > new Date(end_date))
        ) {
            rem_div.addClass('has-error');
            rem_div.removeClass('has-success');

            rem_icons.addClass('glyphicon-remove');
            rem_icons.removeClass('glyphicon-ok');

            rem_message.text('Invalid reminder.');

            submit.addClass('hidden');
        } else {
            rem_div.addClass('has-success');
            rem_div.removeClass('has-error');

            rem_icons.addClass('glyphicon-ok');
            rem_icons.removeClass('glyphicon-remove');

            rem_message.text('Reminder ok!');

            submit.removeClass('hidden');
        }
    }
});