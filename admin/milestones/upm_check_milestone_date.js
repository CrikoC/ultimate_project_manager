jQuery(document).ready(function($) {
    $("body").on("click",".create-milestone",function(){
        var wp_start_date = $(this).closest('tr').attr('data-wp-start-date');
        var wp_end_date = $(this).closest('tr').attr('data-wp-end-date');

        $("#create-milestone").find("input[name='wp_start_date']").val(wp_start_date);
        $("#create-milestone").find("input[name='wp_end_date']").val(wp_end_date);
    });

    $("#create-milestone").find("input[name='mil_date']").change(check);
    function check() {
        var mil_date = $("#create-milestone").find("input[name='mil_date']").val();

        var wp_start_date = $("#create-milestone").find("input[name='wp_start_date']").val();
        var wp_end_date = $("#create-milestone").find("input[name='wp_end_date']").val();

        div   = $('.createMilestoneForm > div:eq(2) > div:eq(0)');
        input = $('.createMilestoneForm > div:eq(2) > div:eq(0) > input');
        label = $('.createMilestoneForm > div:eq(2) > div:eq(0) > label');
        icons = $('.createMilestoneForm > div:eq(2) > div:eq(0) > .glyphicon');

        message = $('.createMilestoneForm > div:eq(2) > div:eq(1) > .help-block');

        submit = $('.createMilestoneForm .btn');

        if(
            (!mil_date) ||
            (new Date(mil_date) < new Date(wp_start_date)) ||
            (new Date(mil_date) > new Date(wp_end_date))

        ) {
            div.addClass('has-error');
            div.removeClass('has-success');

            icons.addClass('glyphicon-remove');
            icons.removeClass('glyphicon-ok');

            $submit.addClass('hidden');

            $message.text('Invalid date.');
        } else {
            div.addClass('has-success');
            div.removeClass('has-error');

            icons.addClass('glyphicon-ok');
            icons.removeClass('glyphicon-remove');

            submit.removeClass('hidden');

            message.text('Date range ok!');
        }
    }

    $("#create-milestone").find("input[name='reminder']").change(check_rem);
    function check_rem() {

        var reminder = $("#create-milestone").find("input[name='reminder']").val();
        var wp_start_date = $("#create-milestone").find("input[name='wp_start_date']").val();
        var wp_end_date = $("#create-milestone").find("input[name='wp_end_date']").val();

        rem_div   = $('.createMilestoneForm > div:eq(3)');
        rem_input = $('.createMilestoneForm > div:eq(3) > input');
        rem_label = $('.createMilestoneForm > div:eq(3) > label');
        rem_icons = $('.createMilestoneForm > div:eq(3) > .glyphicon');

        message = $('.createMilestoneForm > div:eq(3) > .help-block');

        submit = $('.createMilestoneForm .btn');

        if(
            (!reminder) ||
            (!wp_start_date) ||
            (!wp_end_date) ||
            (new Date(reminder) < new Date(wp_start_date)) ||
            (new Date(reminder) > new Date(wp_end_date))

        ) {
            rem_div.addClass('has-error');
            rem_div.removeClass('has-success');

            rem_icons.addClass('glyphicon-remove');
            rem_icons.removeClass('glyphicon-ok');

            submit.addClass('hidden');

            message.text('Invalid reminder');
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
    $("body").on("click",".edit-milestone",function(){
        var wp_start_date = $(this).closest('tr').attr('data-wp-start-date');
        var wp_end_date = $(this).closest('tr').attr('data-wp-end-date');

        $("#edit-milestone").find("input[name='wp_start_date']").val(wp_start_date);
        $("#create-milestone").find("input[name='wp_end_date']").val(wp_end_date);
    });
    
    $("#edit-milestone").find("input[name='mil_date']").change(check);
    function check() {
        var mil_date = $("#edit-milestone").find("input[name='mil']").val();

        var wp_start_date = $("#edit-milestone").find("input[name='wp_start_date']").val();
        var wp_end_date = $("#edit-milestone").find("input[name='wp_end_date']").val();

        div        = $('.editMilestoneForm > div:eq(2)');
        input      = $('.editMilestoneForm > div:eq(2) > input');
        label      = $('.editMilestoneForm > div:eq(2) > label');
        icons      = $('.editMilestoneForm > div:eq(2) > .glyphicon');

        message    = $('.editMilestoneForm > div:eq(2) > div:eq(1) > .help-block');

        submit     = $('.editMilestoneForm .btn');

        if(
            (!mil_date) ||
            (new Date(mil_date) < new Date(wp_start_date)) ||
            (new Date(mil_date) > new Date(wp_end_date))
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

    $("#edit-milestone").find("input[name='reminder']").change(check_rem);
    function check_rem() {

        var reminder = $("#edit-milestone").find("input[name='reminder']").val();
        var wp_start_date = $("#edit-milestone").find("input[name='wp_start_date']").val();
        var wp_end_date = $("#edit-milestone").find("input[name='wp_end_date']").val();

        rem_div   = $('.editMilestoneForm > div:eq(3)');
        rem_input = $('.editMilestoneForm > div:eq(3) > input');
        rem_label = $('.editMilestoneForm > div:eq(3) > label');
        rem_icons = $('.editMilestoneForm > div:eq(3) > .glyphicon');

        message = $('.editMilestoneForm > div:eq(3) > .help-block');

        submit = $('.editMilestoneForm .btn');

        if(
            (!reminder) ||
            (!wp_start_date) ||
            (!wp_end_date) ||
            (new Date(reminder) < new Date(wp_start_date)) ||
            (new Date(reminder) > new Date(wp_end_date))

        ) {
            rem_div.addClass('has-error');
            rem_div.removeClass('has-success');

            rem_icons.addClass('glyphicon-remove');
            rem_icons.removeClass('glyphicon-ok');

            submit.addClass('hidden');

            message.text('Invalid reminder');
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