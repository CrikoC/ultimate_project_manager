jQuery(document).ready(function($) {
    $("#create-project").find("input[name='end_date']").change(check);
    function check() {
        var start_date = $("#create-project").find("input[name='start_date']").val();
        var end_date = $("#create-project").find("input[name='end_date']").val();


        start_div    = $('.createProjectForm > div:eq(2) > div:eq(0)');
        start_input  = $('.createProjectForm > div:eq(2) > div:eq(0) > input');
        start_label  = $('.createProjectForm > div:eq(2) > div:eq(0) > label');
        start_icons  = $('.createProjectForm > div:eq(2) > div:eq(0) > .glyphicon');

        end_div      = $('.createProjectForm > div:eq(2) > div:eq(1)');
        end_input    = $('.createProjectForm > div:eq(2) > div:eq(1) > input');
        end_label    = $('.createProjectForm > div:eq(2) > div:eq(1) > label');
        end_icons    = $('.createProjectForm > div:eq(2) > div:eq(1) > .glyphicon');

        message    = $('.createProjectForm > div:eq(2) > div:eq(1) > .help-block');

        submit     = $('.createProjectForm .btn');

        if( (new Date(end_date).getTime() < new Date(start_date).getTime())) {
            start_div.addClass('has-error');
            start_div.removeClass('has-success');
            end_div.addClass('has-error');
            end_div.removeClass('has-success');

            start_icons.addClass('glyphicon-remove');
            start_icons.removeClass('glyphicon-ok');
            end_icons.addClass('glyphicon-remove');
            end_icons.removeClass('glyphicon-ok');

            submit.addClass('hidden');

            $message.text('Invalid Date range!');
        } else {
            start_div.addClass('has-success');
            start_div.removeClass('has-error');
            end_div.addClass('has-success');
            end_div.removeClass('has-error');


            start_icons.addClass('glyphicon-ok');
            start_icons.removeClass('glyphicon-remove');
            end_icons.addClass('glyphicon-ok');
            end_icons.removeClass('glyphicon-remove');

            submit.removeClass('hidden');

            message.text('Date range ok!');
        }
    }

    $("#create-project").find("input[name='reminder']").change(check_rem);
    function check_rem() {
        var reminder = $("#create-project").find("input[name='start_date']").val();
        var start_date = $("#create-project").find("input[name='start_date']").val();
        var end_date = $("#create-project").find("input[name='end_date']").val();

        rem_div        = $('.createProjectForm > div:eq(3)');
        rem_input      = $('.createProjectForm > div:eq(3) > input');
        rem_label      = $('.createProjectForm > div:eq(3) > label');
        rem_icons      = $('.createProjectForm > div:eq(3) > .glyphicon');

        message    = $('.createProjectForm > div:eq(3) > .help-block');

        submit     = $('.createProjectForm .btn');

        if(
            (!reminder) ||
            (new Date(reminder) < new Date(start_date)) ||
            (new Date(reminder) > new Date(end_date))
        ) {
            rem_div.addClass('has-error');
            rem_div.removeClass('has-success');

            rem_icons.addClass('glyphicon-remove');
            rem_icons.removeClass('glyphicon-ok');

            $submit.addClass('hidden');

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
    $("#edit-project").find("input[name='end_date']").change(check);
    function check() {
        var start_date = $("#edit-project").find("input[name='start_date']").val();
        var end_date = $("#edit-project").find("input[name='end_date']").val();


        start_div        = $('.editProjectForm > div:eq(2) > div:eq(0)');
        start_input      = $('.editProjectForm > div:eq(2) > div:eq(0) > input');
        start_label      = $('.editProjectForm > div:eq(2) > div:eq(0) > label');
        start_icons      = $('.editProjectForm > div:eq(2) > div:eq(0) > .glyphicon');

        end_div        = $('.editProjectForm > div:eq(2) > div:eq(1)');
        end_input      = $('.editProjectForm > div:eq(2) > div:eq(1) > input');
        end_label      = $('.editProjectForm > div:eq(2) > div:eq(1) > label');
        end_icons      = $('.editProjectForm > div:eq(2) > div:eq(1) > .glyphicon');

        message    = $('.editProjectForm > div:eq(2) > div:eq(1) > .help-block');

        submit     = $('.editProjectForm .btn');

        if( (new Date(end_date).getTime() < new Date(start_date).getTime())) {
            start_div.addClass('has-error');
            start_div.removeClass('has-success');
            end_div.addClass('has-error');
            end_div.removeClass('has-success');

            start_icons.addClass('glyphicon-remove');
            start_icons.removeClass('glyphicon-ok');
            end_icons.addClass('glyphicon-remove');
            end_icons.removeClass('glyphicon-ok');

            $submit.addClass('hidden');

            $message.text('Invalid Date range!');
        } else {
            start_div.addClass('has-success');
            start_div.removeClass('has-error');
            end_div.addClass('has-success');
            end_div.removeClass('has-error');


            start_icons.addClass('glyphicon-ok');
            start_icons.removeClass('glyphicon-remove');
            end_icons.addClass('glyphicon-ok');
            end_icons.removeClass('glyphicon-remove');

            submit.removeClass('hidden');

            message.text('Date range ok!');
        }
    }

    $("#edit-project").find("input[name='reminder']").change(check_rem);
    function check_rem() {
        var reminder = $("#edit-project").find("input[name='start_date']").val();
        var start_date = $("#edit-project").find("input[name='start_date']").val();
        var end_date = $("#edit-project").find("input[name='end_date']").val();

        rem_div        = $('.editProjectForm > div:eq(3)');
        rem_input      = $('.editProjectForm > div:eq(3) > input');
        rem_label      = $('.editProjectForm > div:eq(3) > label');
        rem_icons      = $('.editProjectForm > div:eq(3) > .glyphicon');

        message    = $('.editProjectForm > div:eq(3) > .help-block');

        submit     = $('.editProjectForm .btn');

        if(
            (!reminder) ||
            (new Date(reminder) < new Date(start_date)) ||
            (new Date(reminder) > new Date(end_date))
        ) {
            rem_div.addClass('has-error');
            rem_div.removeClass('has-success');

            rem_icons.addClass('glyphicon-remove');
            rem_icons.removeClass('glyphicon-ok');

            $submit.addClass('hidden');

            $message.text('Invalid reminder.');
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