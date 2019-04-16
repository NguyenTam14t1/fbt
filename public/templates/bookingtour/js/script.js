/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 61);
/******/ })
/************************************************************************/
/******/ ({

/***/ 61:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(62);


/***/ }),

/***/ 62:
/***/ (function(module, exports) {

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function () {
    $('.user-login').click(function () {
        $('#popup-login').attr('value', 'login');
    });

    $('.user-register').click(function () {
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
    $('.rating-select input').click(function () {
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
    });

    // set default value
    $('.rating-select').each(function () {
        $(this).children('#star-place-' + $(this).attr('value')).click();
        $(this).children('#star-food-' + $(this).attr('value')).click();
        $(this).children('#star-service-' + $(this).attr('value')).click();
    });

    $('.rating-show').each(function () {
        $(this).children('label').removeClass('checked-1');
        $(this).children('label').removeClass('checked-2');
        $(this).children('label').removeClass('checked-3');
        var rate = $(this).attr('value');
        rate = Math.round(rate);
        checkStyle = 'checked-3';

        if (rate < 3) {
            checkStyle = 'checked-1';
        } else if (rate < 5) {
            checkStyle = 'checked-2';
        }

        $(this).children('label').each(function () {
            if (!rate) {
                return;
            }

            $(this).addClass(checkStyle);
            rate--;
        });
    });

    // booking
    $('.increase-btn').click(function () {
        var participantsMax = $('#participants_max').val();
        var adult = parseInt($('.adult').prop('value'));
        var child = parseInt($('.child').prop('value')) / 2;
        var totalParticipants = adult + child;
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
            if (adult + child < active - 1) {
                $('.child').next().css('opacity', '1');
            }
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

        if ($(this).next().hasClass('adult') && val <= 1) {
            return false;
        }

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
        $('.increase-btn').css('opacity', '1');
        var val = parseInt($(this).prop('value'));
        if (!val || val < 0) {
            val = 1;
        }

        var participantsMax = $('#participants_max').val();
        var adult = parseInt($('.adult').prop('value'));
        var child = parseInt($('.child').prop('value')) / 2;
        var totalParticipants = adult + child;
        if (totalParticipants >= participantsMax) {
            $(this).next().css('opacity', '0.2');
            if ($(this).hasClass('adult')) {
                val = Math.floor(participantsMax - child);
                if (val == participantsMax - child) {
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

        $('.quantity').each(function (i) {
            var price = parseInt($(this).parent().parent().next().children().attr('value')) * $(this).val();
            totalCost += price;
        });

        $('.totalCostRight').text('$' + totalCost);
        $('.totalCostRight').attr('value', totalCost);
    });

    // program day
    $('#day-1').addClass('active');
    $('#day-icon-1').addClass('active');

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var href = $(e.target).attr('href');
        var $curr = $(".process-model  a[href='" + href + "']").parent();

        $('.process-model li').removeClass();

        $curr.addClass("active");
        $curr.prevAll().addClass("visited");

        $('.tab-pane').removeClass('active');
        $(href).addClass('active');
    });

    // review paginate
    $('#review-show .pagination li a').click(function () {
        var page = $(this).attr('href').split('page=')[1];
        var tour_id = $('#review-show').attr('value');
        $.ajax({
            method: 'POST',
            url: route('reviewPaginate'),
            data: {
                tour_id: tour_id,
                page: page
            },
            success: function success(data) {
                $('#review-show').html(data);
            }
        });
        return false;
    });

    // reviewing
    $('#review').submit(function () {
        var tour_id = $(this).attr('tour');
        var place_rate = $('#place-rate').attr('value');
        var food_rate = $('#food-rate').attr('value');
        var service_rate = $('#service-rate').attr('value');
        var total_rate = $('#rating-total-show').attr('value');
        var content = $('#review-content').val();
        $.ajax({
            method: 'POST',
            url: route('review'),
            data: {
                tour_id: tour_id,
                place_rate: place_rate,
                food_rate: food_rate,
                service_rate: service_rate,
                total_rate: total_rate,
                content: content
            },
            success: function success(data) {
                $('#review-show').html(data);
                $('#place-rate-info').attr('value', $('#rate-info').attr('place'));
                $('#food-rate-info').attr('value', $('#rate-info').attr('food'));
                $('#service-rate-info').attr('value', $('#rate-info').attr('service'));
                $('#total-rate-info').attr('value', $('#rate-info').attr('total'));
                $('#total-show').text($('#rate-info').attr('total'));
            }
        });

        return false;
    });

    // booking step
    $('#booking-btn').click(function () {
        var adults = $('.adult').val();
        var children = $('.child').val();
        $.ajax({
            method: 'POST',
            url: route('selectParticipant'),
            data: {
                adults: adults,
                children: children
            },
            success: function success(data) {}
        });
    });

    $('#step1-btn').click(function () {
        $('#personal-info-form').submit();
        return false;
    });

    $('#send-again-btn').click(function () {
        var adults = $('#paticipants').attr('adults');
        var children = $('#paticipants').attr('children');
        $.ajax({
            method: 'POST',
            url: route('selectParticipant'),
            data: {
                adults: adults,
                children: children
            },
            success: function success(data) {
                location.reload();
            }
        });
        return false;
    });

    $('#continue-payment-btn').click(function () {
        $('#payment-continue-form').submit();
        return false;
    });

    // check authenticate
    if ($('#login-request').length) {
        $('.user-login').click();
    }

    // view manager booking
    $('#update-booking-btn').click(function () {
        $('#update-booking-form').submit();
        return false;
    });

    $('#send-mail-again-btn').click(function () {
        $('#send-mail-again-form').submit();
        return false;
    });

    $('#cancel-btn').click(function () {
        $('#cancel-form').submit();
        return false;
    });

    // booking-list paginate
    $('#booking-show .pagination li a').click(function () {
        var page = $(this).attr('href').split('page=')[1];
        var user_id = $('#booking-show').attr('value');
        var status = $('.bookingList').attr('status');
        $.ajax({
            method: 'POST',
            url: route('bookingPaginate'),
            data: {
                user_id: user_id,
                page: page,
                status: status
            },
            success: function success(data) {
                $('#booking-show').html(data);
            }
        });
        return false;
    });

    var status = $('.bookingList').attr('status');
    $('.bookingList li a').removeClass('active');
    $('.bookingList li a').each(function () {
        if ($(this).attr('status') == status) {
            $(this).addClass('active');
        }
    });

    // change header
    var e = $(".changeHeader1 .navbar-fixed-top");
    $(window).scroll(function () {
        $(window).scrollTop() >= 1 && $(".navbar-default").hasClass("navbar-main") ? e.addClass("lightHeader2") : $(".navbar-default").hasClass("static-light") ? e.addClass("lightHeader") : e.removeClass("lightHeader2");
    });

    // home show rate
    $('.rate-home').each(function () {
        var val = Math.round($(this).parent().attr('value'));
        $(this).children().children().each(function () {
            if (val > 0) {
                $(this).addClass('fa-star');
            } else {
                $(this).addClass('fa-star-o');
            }
            val--;
        });
    });

    // preloader
    $('#status').fadeOut();
    $('#preloader').delay(300).fadeOut('slow');
});

/***/ })

/******/ });