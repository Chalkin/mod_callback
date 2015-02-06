(function ($) {
    $(function () {

        // Append to body to avoid z-index issues on some sites
        $('.callbackform > a').click( function() {

            var id = $(this).data('target');
            $(id).appendTo("body").modal('show');
        });

        $('#callbackForm').formValidation({
            framework: 'bootstrap',
            live: 'enabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                fullname: {
                    validators: {
                        notEmpty: {
                            message: 'Bitte den Namen mit angeben.'
                        },
                        stringLength: {
                            min: 5,
                            message: 'Mindestens 5 Zeichen.'
                        }
                    }
                },
                phonenumber: {
                    validators: {
                        notEmpty: {
                            message: 'Darf nicht leer sein.'
                        }
                    }
                },
                message: {
                    validators: {
                        notEmpty: {
                            message: 'Bitte einen Grund mit angeben.'
                        },
                        stringLength: {
                            min: 20,
                            message: 'Die Beschreibung muss mindestens 20 Zeichen lang sein.'
                        }
                    }
                }
            }
        })
        .on('success.field.fv', function(e, data) {
            if (data.fv.getInvalidFields().length > 0) {
                data.fv.disableSubmitButtons(true);
            }
        })
        .on('success.form.fv', function (e) {

            // Prevent from submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the FormValidation instance
            var bv = $form.data('formValidation');

            $.ajax({
                url: $form.attr('action'),
                type: 'post',
                data: $form.serialize(),
                dataType: 'json',
                success: function(result) {

                    if (result['success'])
                    {
                        // Reset the form validation
                        bv.resetForm(true);

                        // Close Modal
                        $('.modal').modal('hide');

                        // Render Joomla message and remove after timer
                        Joomla.renderMessages({'success': result['messages']});

                        setTimeout(function() {
                            $('#system-message').fadeOut('slow');
                            Joomla.removeMessages();
                        }, 4000);
                    }
                }
            });
        });
    });
})(jQuery);
