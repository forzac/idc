$(document).ready(function() {
var reqObject = new ReqObject();
    $('.submitBtn').click(function(event) {
        event.preventDefault();
        $.each($(this).closest('form').find('div[required]'), function(i, item) {

            if ($(item).attr('required') === 'required') {
                 $(item).children('input').focusout();
                 $(item).children('textarea').focusout();
                if ($(item).attr('type') === 'radio') {
                     $(item).children('input').change();
                } else if ($(item).attr('type') === 'checkbox') {
                    $(item).children('input').change();
                } else if ($(item).find('select').length) {
                    $(item).children('select').change();
                }
            } else {
                return false;
            }
        });

    });

    $('input').focusout(function() {
        if ($(this).attr('required') || $(this).parent().attr('required')) {
            if ($(this).hasClass('confirm')) {
                reqObject.compareFields($(this).closest('form').find(':password'));
            } else {
                reqObject.checkField($(this).parent());
            }
        } else {
            return false;
        }
        if ($(this).parent().hasClass('false')) {
            $(this).parent().find('.errorBox').css('height', $(this).parent().find('.errorBox p').outerHeight());
            $(this).parent().css('paddingTop', $(this).parent().find('.errorBox p').outerHeight());
        } else {
            $(this).parent().find('.errorBox').css('height', 0);
            $(this).parent().css('paddingTop', $(this).parent().css('paddingBottom'));
        }

    });

    $('textarea').focusout(function() {
        if ($(this).attr('required') || $(this).parent().attr('required')) {
                reqObject.checkField($(this).parent());
        }

        if ($(this).parent().hasClass('false')) {
            $(this).parent().find('.errorBox').css('height', $(this).parent().find('.errorBox p').outerHeight());
            $(this).parent().css('paddingTop', $(this).parent().find('.errorBox p').outerHeight());
        } else {
            $(this).parent().find('.errorBox').css('height', 0);
            $(this).parent().css('paddingTop', $(this).parent().css('paddingBottom'));
        }

    });

    $('input').change(function() {

        if ($(this).attr('required') || $(this).parent().attr('required')) {
            if ($(this).hasClass('confirm')) {
                reqObject.compareFields($(this).closest('form').find(':password'));
            } else if ($(this).parent().attr('type') === 'checkbox') {
                reqObject.checkboxFields($(this).parent());
            } else if ($(this).parent().attr('type') === 'radio') {
                reqObject.radioField($(this).parent());
            } else if ($(this).parent().attr('type') === 'file') {
                reqObject.fileField($(this).parent());

            } else {
                reqObject.checkField($(this).parent());
            }
        } else {
            return false;
        }

        if ($(this).parent().hasClass('false')) {
            $(this).parent().find('.errorBox').css('height', $(this).parent().find('.errorBox p').outerHeight());
            $(this).parent().css('paddingTop', $(this).parent().find('.errorBox p').outerHeight());
        } else {
             $(this).parent().find('.errorBox').css('height', 0);
            $(this).parent().css('paddingTop', $(this).parent().css('paddingBottom'));
        }

    });

    $('select').change(function() {
        reqObject.selectField($(this));
        if ($(this).parent().parent().hasClass('false')) {
            $(this).parent().find('.errorBox').css('height', $(this).parent().find('.errorBox p').outerHeight());
            $(this).parent().css('paddingTop', $(this).parent().find('.errorBox p').outerHeight());
            $(this).parent().parent().css('paddingTop', 0);
        } else {
            $(this).parent().find('.errorBox').css('height', 0);
            $(this).parent().css('paddingTop', 0);
            $(this).parent().parent().css('paddingTop', $(this).parent().parent().css('paddingBottom'));
        }
    });

});


function ReqObject () {
    this.patterns = {
        text_title: /^[A-ZА-ЯЁІЇ]{1}[a-zа-яёії]{0,20}((\-)|(\'))?[A-zА-яёЁіІїЇ]{0,20}((\-)|(\'))?[A-zА-яёЁіїІЇ]{1,20}(\s{1,3}[A-ZА-ЯЁІЇ]{1}[a-zа-яёії]{0,20}((\-)|(\'))?[A-zА-яёЁіїІЇ]{0,20}((\-)|(\'))?[A-zА-яёЁіїІЇ]{1,20}){0,3}\s*$/,
        phone: /^\+380\d{9}$/,
        email: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/,
        password: /^[A-ZА-ЯЁІЇa-zа-яёії0-9]{3,}$/,
        subdomain: /^[a-z0-9]+([a-z0-9]*[\-]*[a-z0-9]*)*[a-z0-9]+$/,
        textarea: /^[a-z0-9]+$/
    },

    this.errortext = {
        emptyField: 'Поле не может быть пустым',
        emailField: 'не верно введен Email, например name@domain.com',
        passwordField: 'Пароль слишком прост',
        passwordСonfirmation: 'Пароли не совпадают',
        passConfirmationEmptyField: 'Подтвердите пароль',
        checkboxField: 'Необходимо отметить',
        radioField: 'Выберите одно из значений',
        fileField: 'Выберите файл',
        textareaField: 'введены недопустимые символы',
        selectField: 'Выберите одно из значений',
        btnSubmit: 'Корректно заполните все поля помеченные "*"'
    },

    this.checkField = function(obj) {
        $.each($(obj), function(i, item) {
            pattt = this.patterns[$(item).attr('pattern')];
            if (($(item).children('input').length && $(item).children('input').val().length === 0) || ($(item).children('textarea').length && $(item).children('textarea').val().length === 0)) {
                $(item).removeClass('true').addClass('false');
                $(item).find('.errorBox p').html(this.errortext['emptyField']);
            } else if ($(item).attr('type') === 'radio' || $(item).attr('type') === 'checkbox') {
                return false;
            } else if ($(item).attr('pattern')) {
                if ( ($(item).children('input').length && !(pattt).test($(item).children('input').val())) || ($(item).children('textarea').length && !(pattt).test($(item).children('textarea').val())) ) {
                    $(item).removeClass('true').addClass('false');
                    if ($(item).children('textarea').length) {
                         $(item).find('.errorBox p').text(this.errortext['textareaField']);
                    } else {
                         $(item).find('.errorBox p').text(this.errortext[$(obj).attr('type') + "Field"]);
                    }
                    if ($(item).attr('type') === 'password') {
                        $(item).closest('form').find('.confirm').prop('disabled', true);
                    }

                } else {
                    $(item).removeClass('false').addClass('true');
                    if ($(item).attr('type') === 'password') {
                        $(item).closest('form').find('.confirm').prop('disabled', false);
                    }
                    return true;
                }

            }

        }.bind(this));

    };

    this.compareFields = function(obj) {
        if (!$.trim($(obj[1]).val()).length) {
            $(obj[1]).parent().removeClass('true').addClass('false');
            $(obj[1]).parent().find('.errorBox p').text(this.errortext['passConfirmationEmptyField']);
        } else {
            $(obj[1]).parent().removeClass('false').addClass('true');
            // $(obj[1]).parent().find('.errorBox p').text('');
        }

        if ($.trim($(obj[0]).val()).length && $.trim($(obj[1]).val()).length) {

            if ($.trim($(obj[0]).val()) !== $.trim($(obj[1]).val())) {
                $(obj[1]).parent().removeClass('true').addClass('false');
                $(obj[1]).parent().find('.errorBox p').text(this.errortext['passwordСonfirmation']);
                return false;
            } else {
                $(obj[1]).parent().removeClass('false').addClass('true');
                // $(obj[1]).parent().find('.errorBox p').text('');
                return true;
            }

        }
    };

    this.checkboxFields = function(obj) {
        $.each($(obj), function(i, item) {
            if (!$(item).children('input').prop("checked")) {
                $(item).removeClass('true').addClass('false');
                $(item).find('.errorBox p').html(this.errortext[$(obj).attr('type') + "Field"]);
            } else {
                $(item).removeClass('false').addClass('true');
            }
        }.bind(this));
    };

    this.radioField = function(obj) {
        $.each($(obj).find('input'), function(i, item) {
            if (!$(item).prop('checked')) {
                $(item).parent().removeClass('true').addClass('false');
                $(item).parent().find('.errorBox p').html(this.errortext[$(obj).attr('type') + "Field"]);
                return true;

            } else {
                $(item).parent().removeClass('false').addClass('true');
                $(item).parent().find('.errorBox p').html('');
                return false;
            }
        }.bind(this));
    };

    this.fileField = function(obj) {
        var filesNumber = $(obj).children('input')[0].files.length;

        if (!$(obj).children('input')[0].files.length) {
            $(obj).removeClass('true').addClass('false');
            $(obj).children('input').prevAll().find('.fileName').text(this.errortext[$(obj).attr('type') + "Field"]);
        } else {
            $(obj).removeClass('false').addClass('true');
            if (filesNumber == 1) {
                $(obj).children('input').prevAll().find('.fileName').text('Выбран ' + filesNumber + ' файл');
            } else {
                $(obj).children('input').prevAll().find('.fileName').text('Выбрано ' + filesNumber + ' файлa(ов)');
            }
        }
    };

    this.selectField = function (obj) {
        if ($(obj).val() === '0') {
            $(obj).parent().parent().removeClass('true').addClass('false');
            $(obj).parent().parent().find('.errorBox p').text(this.errortext['selectField']);
            return true;
        } else {
            $(obj).parent().parent().removeClass('false').addClass('true');
            $(obj).parent().parent().find('.errorBox p').text('');
            return false;
        }
    };

}