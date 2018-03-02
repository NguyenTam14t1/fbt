$(document).ready(function () {
    $('.user-login').click(function() {
        $('#popup-login').attr('value', 'login');
    });

    $('.user-register').click(function() {
        $('#popup-register').attr('value', 'register');
    });

    if ($('.popup-error').length) {
        var popup = ".user-";
        var popup_login = $('#popup-login').attr('value');
        var popup_register = $('#popup-register').attr('value');
        
        if (popup_login) {
            popup += popup_login;
            $('.register-message, .reset-message').html('');
            $('#email-register, #email-reset').attr('value', '');
        } else if (popup_register) {
            popup += popup_register;
            $('.login-message, .reset-message').html('');
            $('#email, #email-reset').attr('value', '');
        } else {
            $('.register-message, .login-message').html('');
            $('#email-register, #email').attr('value', '');
        }

        $('#popup-login').attr('value', '');
        $('#popup-register').attr('value', '');
        $(popup).click();
    }

    $('#register-btn').click(function () {
        $('.user-login').click();
    });

    $('#login-btn').click(function () {
        $('.user-register').click();
    });
});
