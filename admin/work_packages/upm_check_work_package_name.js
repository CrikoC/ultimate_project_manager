
jQuery(document).ready(function($) {
    var nameCreateInput = $("#create-work-package").find("input[name='name']");
    nameCreateInput.keyup(function() {
        $.ajax({
            type: "GET",
            url: ajaxurl,
            dataType: 'html',
            data: {
                action: 'upm_check_work_package_name_action',
                name: nameCreateInput.val()
            },
            success: function (data) {
                $div = $('.createWPForm > div:first > div:first');
                $input = $('.createWPForm > div:first > div:first > input');
                $label = $('.createWPForm > div:first > div:first > label');
                $icons = $('.createWPForm > div:first > div:first > .glyphicon');
                $message = $('.createWPForm > div:first > div:first > .help-block');
                $submit = $('.createWPForm .btn');
                //Custom Form validation using bottstrap styles

                //If there is no entry in database and the input value is not empty
                if(data == 'available0' && nameCreateInput.val() != '') {
                    $div.addClass('has-success');
                    $div.removeClass('has-error');

                    $icons.addClass('glyphicon-ok');
                    $icons.removeClass('glyphicon-remove');

                    $submit.removeClass('hidden');

                    $message.text('item available');
                }
                //if the data exists in database table or the input value is empty
                else if(data == 'exists0' || nameCreateInput.val() == '') {
                    $div.addClass('has-error');
                    $div.removeClass('has-success');

                    $icons.addClass('glyphicon-remove');
                    $icons.removeClass('glyphicon-ok');

                    $submit.addClass('hidden');
                }
                //Output different warning message depending on the situation
                if(data == 'exists0') {
                    $message.text('item exists in database');
                }
                if(nameCreateInput.val() == '') {
                    $message.text('Enter a name');
                }
            },
            error: function (data, err) {
                console.log('Error: '+ err);
            }
        });
    });

    var nameEditInput = $("#edit-work-package").find("input[name='name']");
    nameEditInput.keyup(function() {
        $.ajax({
            type: "GET",
            url: ajaxurl,
            dataType: 'html',
            data: {
                action: 'upm_check_work_package_name_action',
                name: nameEditInput.val()
            },
            success: function (data) {
                $div = $('.editWPForm > div:first > div:first');
                $input = $('.editWPForm > div:first > div:first > input');
                $label = $('.editWPForm > div:first > div:first > label');
                $icons = $('.editWPForm > div:first > div:first > .glyphicon');
                $message = $('.editWPForm > div:first > div:first > .help-block');
                $submit = $('.editWPForm .btn');
                //Custom Form validation using bottstrap styles

                //If there is no entry in database and the input value is not empty
                if(data == 'available0' && nameEditInput.val() != '') {
                    $div.addClass('has-success');
                    $div.removeClass('has-error');

                    $icons.addClass('glyphicon-ok');
                    $icons.removeClass('glyphicon-remove');

                    $submit.removeClass('hidden');

                    $message.text('item available');
                }
                //if the data exists in database table or the input value is empty
                else if(data == 'exists0' || nameEditInput.val() == '') {
                    $div.addClass('has-error');
                    $div.removeClass('has-success');

                    $icons.addClass('glyphicon-remove');
                    $icons.removeClass('glyphicon-ok');

                    $submit.addClass('hidden');
                }
                //Output different warning message depending on the situation
                if(data == 'exists0') {
                    $message.text('item exists in database');
                }
                if(nameEditInput.val() == '') {
                    $message.text('Enter a name');
                }
            },
            error: function (data, err) {
                console.log('Error: '+ err);
            }
        });
    });
});