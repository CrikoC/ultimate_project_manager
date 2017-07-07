
jQuery(document).ready(function($) {
    var nameCreateInput = $("#create-user").find("input[name='user_login']");
    nameCreateInput.keyup(function() {
        $.ajax({
            type: "GET",
            url: ajaxurl,
            dataType: 'html',
            data: {
                action: 'upm_check_user_name_action',
                user_login: nameCreateInput.val()
            },
            success: function (data) {
                $div = $('.createUserForm > div:first ');
                $input = $('.createUserForm > div:first > input');
                $label = $('.createUserForm > div:first > label');
                $icons = $('.createUserForm > div:first > .glyphicon');
                $message = $('.createUserForm > div:first > .help-block');
                $submit = $('.createUserForm .btn');
                //Custom Form validation using bottstrap styles

                //If there is no entry in database and the input value is not empty
                if(data == 'available0' && nameCreateInput.val() != '') {
                    $div.addClass('has-success');
                    $div.removeClass('has-error');

                    $icons.addClass('glyphicon-ok');
                    $icons.removeClass('glyphicon-remove');

                    $submit.removeClass('hidden');

                    $message.text('Username available');
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
                    $message.text('Username exists in database');
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
});

jQuery(document).ready(function($) {
    var nameEditInput = $("#edit-user").find("input[name='user_login']");
    nameEditInput.keyup(function() {
        $.ajax({
            type: "GET",
            url: ajaxurl,
            dataType: 'html',
            data: {
                action: 'upm_check_user_name_action',
                name: nameEditInput.val()
            },
            success: function (data) {
                $div = $('.editUserForm > div:first');
                $input = $('.editUserForm > div:first > input');
                $label = $('.editUserForm  > div:first > label');
                $icons = $('.editUserForm > div:first > .glyphicon');
                $message = $('.editUserForm > div:first > .help-block');
                $submit = $('.editUserForm .btn');
                //Custom Form validation using bottstrap styles

                //If there is no entry in database and the input value is not empty
                if(data == 'available0' && nameEditInput.val() != '') {
                    $div.addClass('has-success');
                    $div.removeClass('has-error');

                    $icons.addClass('glyphicon-ok');
                    $icons.removeClass('glyphicon-remove');

                    $submit.removeClass('hidden');

                    $message.text('Username available');
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
                    $message.text('Username exists in database');
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