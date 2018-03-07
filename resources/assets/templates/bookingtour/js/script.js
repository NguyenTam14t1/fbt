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

    // rating
    $('.rating-select input').click(function (){
        var rate = $(this).attr('value');
        $(this).parent().attr('value', rate);
        rate = 0;
        $('.rating-select').each(function () {
            rate += parseInt($(this).attr('value'));
        });
        rate = rate / 3;
        $('#rating-total-show').attr('value', rate);
        rate = Math.round(rate);
        checkStyle = 'checked-3';

        if (rate < 3) {
            checkStyle = 'checked-1';
        } else if (rate < 5) {
            checkStyle = 'checked-2';
        }

        $('#rating-total-show').children('label').each(function () {
            $(this).removeClass('checked-1');
            $(this).removeClass('checked-2');
            $(this).removeClass('checked-3');
        });

        $('#rating-total-show').children('label').each(function () {
            if (!rate) {
                return;
            }
            $(this).addClass(checkStyle);
            rate--;
        });
    })

    // set default value
    $('.rating-select').each(function () {
        $(this).children('#star-place-' + $(this).attr('value')).click();
        $(this).children('#star-food-' + $(this).attr('value')).click();
        $(this).children('#star-service-' + $(this).attr('value')).click();
    });

    $('.rating-show').each(function () {
        var rate = $(this).attr('value');
        rate = Math.round(rate);
        checkStyle = 'checked-3';

        if (rate < 3) {
            checkStyle = 'checked-1';
        } else if (rate < 5) {
            checkStyle = 'checked-2';
        }

        $(this).children('label').each(function() {
            if (!rate) {
                return;
            }

            $(this).addClass(checkStyle);
            rate--;
        });
    })

    // booking
    $(document).ready(function () {
        $('.increase-btn').click(function () {
            var participantsMax = $('#participants_max').val();
            var totalParticipants = parseInt($('.adult').prop('value')) + parseInt($('.child').prop('value')) / 2;
            active = totalParticipants + 0.5;
            if ($(this).prev().hasClass('adult')) {
                totalParticipants = Math.ceil(totalParticipants);
                active = totalParticipants + 1;
            }
            if (totalParticipants >= participantsMax) {
                return false;
            }

            if (active >= participantsMax) {
                $('.increase-btn').css('opacity', '0.2');
            }

            var val = parseInt($(this).prev().prop('value'));
            $(this).prev().prop('value', val + 1);

            var price = parseInt($(this).parent().parent().next().children().attr('value'));
            var totalCost = parseInt($('.totalCostRight').attr('value')) + price;
            $('.totalCostRight').text('$' + totalCost);
            $('.totalCostRight').attr('value', totalCost);
            
            return false;
        });

        $('.decrease-btn').click(function () {
            var val = parseInt($(this).next().prop('value'));
            if (!val) {
                return false;
            }
            $(this).next().prop('value', val - 1);
            $(this).next().next().css('opacity', '1');

            var participantsMax = $('#participants_max').val();
            var totalParticipants = parseInt($('.adult').prop('value')) + parseInt($('.child').prop('value')) / 2;

            totalParticipants = totalParticipants + 0.5;
            if ($(this).prev().hasClass('adult')) {
                totalParticipants = totalParticipants + 1;
            }

            if (totalParticipants < participantsMax) {
                $('.increase-btn').css('opacity', '1');
            }

            var price = parseInt($(this).parent().parent().next().children().attr('value'));
            var totalCost = parseInt($('.totalCostRight').attr('value')) - price;
            $('.totalCostRight').text('$' + totalCost);
            $('.totalCostRight').attr('value', totalCost);
            
            return false;
        });

        $('.quantity').change(function () {
            var val = parseInt($(this).prop('value'));
            if (!val || val < 0) {
                val = 1;
            }
            
            var participantsMax = $('#participants_max').val();
            var adult = parseInt($('.adult').prop('value'));
            var child = parseInt($('.child').prop('value')) / 2;
            var totalParticipants = adult + child;
            if (totalParticipants > participantsMax) {
                $(this).next().css('opacity', 0.2);
                if ($(this).hasClass('adult')) {
                    val = Math.floor(participantsMax - child);
                    if (val == (participantsMax - child)) {
                        $('.increase-btn').css('opacity', '0.2');
                    }
                } else if ($(this).hasClass('child')) {
                    val = (participantsMax - adult) * 2;
                    $('.increase-btn').css('opacity', '0.2');
                }
            }
            $(this).prop('value', val);

            var quantity = [];
            var totalCost = 0;

            $('.quantity').each(function(i) {
                var price = parseInt($(this).parent().parent().next().children().attr('value')) * $(this).val();
                totalCost += price;
            });

            $('.totalCostRight').text('$' + totalCost);
            $('.totalCostRight').attr('value', totalCost);
        });

    });
});
