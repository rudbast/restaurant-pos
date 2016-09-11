/**
 * Setup modal action's form's url and show modal.
 *
 * @param {Object} modal Modal element
 * @param {string} url   Form's url
 */
function setupModalFormUrl(modal, url) {
    modal.find('form').attr('action', url);
    modal.modal('show');
}

/**
 * Setup modal form reset on hidden and form submit event.
 *
 * @param {Array} modals Array of modal element
 */
function setupModalsForms(modals, validationRule) {
    modals.forEach(function (modal) {
        modal.on('hidden.bs.modal', function (event) {
            modal.find('form').trigger('reset');
            modal.find('div.form-group').removeClass('has-error').removeClass('has-success');
            modal.find('div.form-group > label[class="has-error"]').remove();
            modal.find('.chosen-select').val([]).trigger('chosen:updated');
        });

        var formElement = modal.find('form');
        var validator = validateForm(formElement, validationRule);

        formElement.submit(function (event) {
            event.preventDefault();

            if (!formElement.valid()) {
                return;
            }

            $.ajax({
                url: formElement.prop('action'),
                method: formElement.prop('method'),
                data: formElement.serialize()
            }).done(function (data) {
                if (data.success) {
                    // Reload page.
                    location.reload();
                } else {
                    alert('Form submission error.');
                }
            }).fail(function (errors) {
                showValidationErrors($.parseJSON(errors.responseText), validator);
            });
        });
    });
}

/**
 * Validate form using jquery validator plugin and return the
 * validator instance.
 *
 * @param  {Object} elementForm jQuery form element
 * @param  {Object} rule        Validation rules
 * @return {Object}             Validator instance
 */
function validateForm(elementForm, rule) {
    return elementForm.validate({
        rules: rule,
        errorClass: 'has-error',
        validClass: 'has-success',
        highlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group')
                .addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group')
                .removeClass(errorClass).addClass(validClass);
        },
        errorPlacement: function (error, element) {
            error.insertAfter(
                $(element).closest('.form-group').children(':last-child')
            );
        },
    });
}

/**
 * Error validation handler.
 *
 * @param  {object} errors    Parsed JSON object containing error message
 * @param  {object} validator jQuery validator object for current form
 */
function showValidationErrors(errors, validator) {
    var objectError = {};

    $.each(errors, function(attribute, errorMessages) {
        errorMessages.forEach(function (message) {
            objectError[attribute] = message;

            // Extra error for any attribute is omitted, only shows
            // the first error.
            return;
        });
    });

    // Use jquery validator to show the error right below the input
    // component.
    validator.showErrors(objectError);
}
