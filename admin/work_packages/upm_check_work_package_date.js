jQuery(document).ready(function($) {
    $("body").on("click",".create-work-package",function(){
        var project_start_date = $(this).closest('tr').attr('data-project-start-date');
        var project_end_date = $(this).closest('tr').attr('data-project-end-date');

        $("#create-work-package").find("input[name='project_start_date']").val(project_start_date);
        $("#create-work-package").find("input[name='project_end_date']").val(project_end_date);
    });

    $("#create-work-package").find("input[name='start_date']").change(check_start);
    function check_start() {
        var start_date = $("#create-work-package").find("input[name='start_date']").val();

        var project_start_date = $("#create-work-package").find("input[name='project_start_date']").val();
        var project_end_date = $("#create-work-package").find("input[name='project_end_date']").val();

        start_div   = $('.createWPForm > div:eq(2) > div:eq(0)');
        start_input = $('.createWPForm > div:eq(2) > div:eq(0) > input');
        start_label = $('.createWPForm > div:eq(2) > div:eq(0) > label');
        start_icons = $('.createWPForm > div:eq(2) > div:eq(0) > .glyphicon');

        start_message = $('.createWPForm > div:eq(2) > div:eq(0) > .help-block');

        submit = $('.createWPForm .btn');

        if(
            (!start_input) ||
            (new Date(start_date) < new Date(project_start_date)) ||
            (new Date(start_date) > new Date(project_end_date))

        ) {
            start_div.addClass('has-error');
            start_div.removeClass('has-success');

            start_icons.addClass('glyphicon-remove');
            start_icons.removeClass('glyphicon-ok');

            start_message.text('Invalid date range!');

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

    $("#create-work-package").find("input[name='end_date']").change(check_end);
    function check_end() {
        var start_date = $("#create-work-package").find("input[name='start_date']").val();
        var end_date = $("#create-work-package").find("input[name='end_date']").val();

        var project_start_date = $("#create-work-package").find("input[name='project_start_date']").val();
        var project_end_date = $("#create-work-package").find("input[name='project_end_date']").val();

        end_div     = $('.createWPForm > div:eq(2) > div:eq(1)');
        end_input   = $('.createWPForm > div:eq(2) > div:eq(1) > input');
        end_label   = $('.createWPForm > div:eq(2) > div:eq(1) > label');
        end_icons   = $('.createWPForm > div:eq(2) > div:eq(1) > .glyphicon');

        end_message = $('.createWPForm > div:eq(2) > div:eq(1) > .help-block');

        submit = $('.createWPForm .btn');

        if(
            (!end_date) ||
            (!start_date) ||
            (new Date(end_date) < new Date(start_date)) ||
            (new Date(end_date) < new Date(project_start_date)) ||
            (new Date(end_date) > new Date(project_end_date))

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

    $("#create-work-package").find("input[name='reminder']").change(check_rem);
    function check_rem() {
        var reminder = $("#create-work-package").find("input[name='reminder']").val();
        var start_date = $("#create-work-package").find("input[name='start_date']").val();
        var end_date = $("#create-work-package").find("input[name='end_date']").val();

        rem_div   = $('.createWPForm > div:eq(3)');
        rem_input = $('.createWPForm > div:eq(3) > input');
        rem_label = $('.createWPForm > div:eq(3) > label');
        rem_icons = $('.createWPForm > div:eq(3) > .glyphicon');

        rem_message = $('.createWPForm > div:eq(3) > .help-block');

        submit = $('.createWPForm .btn');

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
    $("body").on("click",".edit-work-package",function(){
        var project_start_date = $(this).closest('tr').attr('data-project-start-date');
        var project_end_date = $(this).closest('tr').attr('data-project-end-date');

        $("#edit-work-package").find("input[name='project_start_date']").val(project_start_date);
        $("#edit-work-package").find("input[name='project_end_date']").val(project_end_date);
    });

    $("#edit-work-package").find("input[name='start_date']").change(check_start);
    function check_start() {
        var start_date = $("#edit-work-package").find("input[name='start_date']").val();

        var project_start_date = $("#edit-work-package").find("input[name='project_start_date']").val();
        var project_end_date = $("#edit-work-package").find("input[name='project_end_date']").val();

        start_div   = $('.editWPForm > div:eq(2) > div:eq(0)');
        start_input = $('.editWPForm > div:eq(2) > div:eq(0) > input');
        start_label = $('.editWPForm > div:eq(2) > div:eq(0) > label');
        start_icons = $('.editWPForm > div:eq(2) > div:eq(0) > .glyphicon');

        start_message = $('.editWPForm > div:eq(2) > div:eq(0) > .help-block');

        submit = $('.editWPForm .btn');

        if(
            (!start_date) ||
            (new Date(start_date) < new Date(project_start_date)) ||
            (new Date(start_date) > new Date(project_end_date))

        ) {
            start_div.addClass('has-error');
            start_div.removeClass('has-success');

            start_icons.addClass('glyphicon-remove');
            start_icons.removeClass('glyphicon-ok');

            submit.addClass('hidden');

            start_message.text('Invalid date range!');
        } else {
            start_div.addClass('has-success');
            start_div.removeClass('has-error');

            start_icons.addClass('glyphicon-ok');
            start_icons.removeClass('glyphicon-remove');

            submit.removeClass('hidden');

            start_message.text('Date range ok!');
        }
    }

    $("#edit-work-package").find("input[name='end_date']").change(check_end);
    function check_end() {
        var start_date = $("#edit-work-package").find("input[name='start_date']").val();
        var end_date = $("#edit-work-package").find("input[name='end_date']").val();

        var project_start_date = $("#edit-work-package").find("input[name='project_start_date']").val();
        var project_end_date = $("#edit-work-package").find("input[name='project_end_date']").val();

        end_div     = $('.editWPForm > div:eq(2) > div:eq(1)');
        end_input   = $('.editWPForm > div:eq(2) > div:eq(1) > input');
        end_label   = $('.editWPForm > div:eq(2) > div:eq(1) > label');
        end_icons   = $('.editWPForm > div:eq(2) > div:eq(1) > .glyphicon');

        end_message = $('.editWPForm > div:eq(2) > div:eq(1) > .help-block');

        submit = $('.editWPForm .btn');

        if(
            (!end_date) ||
            (!start_date) ||
            (new Date(end_date) < new Date(start_date)) ||
            (new Date(end_date) < new Date(project_start_date)) ||
            (new Date(end_date) > new Date(project_end_date))

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

    $("#edit-work-package").find("input[name='reminder']").change(check_rem);
    function check_rem() {

        var reminder = $("#edit-work-package").find("input[name='reminder']").val();
        var start_date = $("#edit-work-package").find("input[name='start_date']").val();
        var end_date = $("#edit-work-package").find("input[name='end_date']").val();

        rem_div   = $('.editWPForm > div:eq(3)');
        rem_input = $('.editWPForm > div:eq(3) > input');
        rem_label = $('.editWPForm > div:eq(3) > label');
        rem_icons = $('.editWPForm > div:eq(3) > .glyphicon');

        rem_message = $('.editWPForm > div:eq(3) > .help-block');

        submit = $('.editWPForm .btn');

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