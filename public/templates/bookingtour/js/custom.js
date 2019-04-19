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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/bookingtour/custom.js":
/*!********************************************!*\
  !*** ./resources/js/bookingtour/custom.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

jQuery(document).ready(function () {
  "use strict";

  $(".ed-datepicker input.form-control").focus(function () {
    $(".sbOptions").css("display", "none");
  }), $(".ed-datepicker").datepicker({
    format: "dd/mm/yyyy",
    autoclose: !0,
    orientation: "top auto",
    todayBtn: "linked",
    todayHighlight: !0
  }), $(".dropdown").hover(function () {
    $(this).addClass("open");
  }, function () {
    $(this).removeClass("open");
  }), jQuery(".custom_rev_slider").show().revolution({
    delay: 5e3,
    sliderLayout: "fullwidth",
    sliderType: "standard",
    responsiveLevels: [1201, 1025, 768, 480],
    gridwidth: [1201, 1025, 769, 480],
    gridheight: [745, 744, 644, 544],
    dottedOverlay: "twoxtwo",
    navigation: {
      arrows: {
        enable: !0,
        style: "hesperiden",
        hide_onleave: !1
      },
      bullets: {
        enable: !0,
        style: "hesperiden",
        hide_onleave: !1,
        h_align: "center",
        v_align: "bottom",
        h_offset: 0,
        v_offset: 20,
        space: 15
      }
    },
    disableProgressBar: "on"
  }), jQuery("#rev_video_slider").show().revolution({
    dottedOverlay: "none",
    delay: 9e3,
    navigation: {
      onHoverStop: "off"
    },
    responsiveLevels: [1240, 1024, 778, 480],
    visibilityLevels: [1240, 1024, 778, 480],
    gridwidth: [1240, 1024, 778, 480],
    gridheight: [750, 550, 425, 250],
    shadow: 0,
    spinner: "off",
    stopLoop: "on",
    stopAfterLoops: 0,
    stopAtSlide: 1,
    shuffle: "off",
    autoHeight: "off",
    disableProgressBar: "on",
    hideThumbsOnMobile: "off",
    hideSliderAtLimit: 0,
    hideCaptionAtLimit: 0,
    hideAllCaptionAtLilmit: 0,
    debugMode: !1,
    fallbacks: {
      simplifyAll: "off",
      nextSlideOnWindowFocus: "off",
      disableFocusListener: !1
    }
  });
  var e = $(".changeHeader .navbar-fixed-top");
  $(window).scroll(function () {
    $(window).scrollTop() >= 1 && $(".navbar-default").hasClass("navbar-main") ? e.addClass("lightHeader") : $(".navbar-default").hasClass("static-light") ? e.addClass("lightHeader") : e.removeClass("lightHeader");
  }), $(".select-drop").selectbox(), $(".datepicker").datepicker({
    startDate: "dateToday",
    autoclose: !0
  }), $(document).ready(function (e) {
    e(".counter").counterUp({
      delay: 10,
      time: 2e3
    });
  }), jQuery(document).ready(function () {
    $("#price-range").slider({
      range: !0,
      min: 20,
      max: 300,
      values: [20, 300],
      slide: function slide(e, a) {
        $("#price-amount-1").val("$" + a.values[0]), $("#price-amount-2").val("$" + a.values[1]);
      }
    }), $("#price-amount-1").val("$" + $("#price-range").slider("values", 0)), $("#price-amount-2").val("$" + $("#price-range").slider("values", 1));
  });
  var a = $(".singlePackage .panel-heading i.fa");
  $(".singlePackage .panel-heading").click(function () {
    a.removeClass("fa-minus").addClass("fa-plus"), $(this).find("i.fa").removeClass("fa-plus").addClass("fa-minus");
  });
  var i = $(".accordionWrappar .panel-heading i.fa");
  $(".accordionWrappar .panel-heading").click(function () {
    i.removeClass("fa-minus").addClass("fa-plus"), $(this).find("i.fa").removeClass("fa-plus").addClass("fa-minus");
  });
  var o = $(".solidBgTitle .panel-heading i.fa");
  $(".solidBgTitle .panel-heading").click(function () {
    o.removeClass("fa-minus").addClass("fa-plus"), $(this).find("i.fa").removeClass("fa-plus").addClass("fa-minus");
  });
  var s = $(".accordionSolidTitle .panel-heading i.fa");
  $(".accordionSolidTitle .panel-heading").click(function () {
    s.removeClass("fa-arrow-circle-up").addClass("fa-arrow-circle-down"), $(this).find("i.fa").removeClass("fa-arrow-circle-down").addClass("fa-arrow-circle-up");
  });
  var l = $(".accordionSolidBar .panel-heading i.fa");
  $(".accordionSolidBar .panel-heading").click(function () {
    l.removeClass("fa-chevron-circle-up").addClass("fa-chevron-circle-down"), $(this).find("i.fa").removeClass("fa-chevron-circle-down").addClass("fa-chevron-circle-up");
  }), $(document).ready(function () {
    $(".accordionWrappar .panel-collapse, .accordionSolidTitle .panel-collapse, .accordionSolidBar .panel-collapse, .toggle-container .panel-collapse").on("show.bs.collapse", function () {
      $(this).siblings(".panel-heading").addClass("active"), $(this).addClass("active");
    }), $(".accordionWrappar .panel-collapse, .accordionSolidTitle .panel-collapse, .accordionSolidBar .panel-collapse, .toggle-container .panel-collapse").on("hide.bs.collapse", function () {
      $(this).siblings(".panel-heading").removeClass("active"), $(this).removeClass("active");
    });
  }), $("#simple_timer").syotimer({
    year: 2018,
    month: 5,
    day: 9,
    hour: 20,
    minute: 30
  }), $(".incr-btn").on("click", function (e) {
    var a,
        i = $(this),
        o = i.parent().find(".quantity").val();
    i.parent().find(".incr-btn[data-action=decrease]").removeClass("inactive"), "increase" === i.data("action") ? a = parseFloat(o) + 1 : o > 1 ? a = parseFloat(o) - 1 : (a = 0, i.addClass("inactive")), i.parent().find(".quantity").val(a), e.preventDefault();
  }), $(".slick-carousel").slick({
    centerMode: !0,
    centerPadding: "100px",
    slidesToShow: 1,
    responsive: [{
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: !0
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: !1
      }
    }]
  }), $(".brandSlider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    centerMode: !0,
    centerPadding: "0px",
    responsive: [{
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: !0
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }, {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  }), $(".google-maps").click(function () {
    $(this).find("iframe").addClass("clicked");
  }).mouseleave(function () {
    $(this).find("iframe").removeClass("clicked");
  });
});

(function (i, s, o, g, r, a, m) {
  i['GoogleAnalyticsObject'] = r;
  i[r] = i[r] || function () {
    (i[r].q = i[r].q || []).push(arguments);
  }, i[r].l = 1 * new Date();
  a = s.createElement(o), m = s.getElementsByTagName(o)[0];
  a.async = 1;
  a.src = g;
  m.parentNode.insertBefore(a, m);
})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-71155940-4', 'auto');
ga('send', 'pageview');

(function (w, i, d, g, e, t, s) {
  w[d] = w[d] || [];
  t = i.createElement(g);
  t.async = 1;
  t.src = e;
  s = i.getElementsByTagName(g)[0];
  s.parentNode.insertBefore(t, s);
})(window, document, '_gscq', 'script', '//widgets.getsitecontrol.com/46851/script.js');

/***/ }),

/***/ 1:
/*!**************************************************!*\
  !*** multi ./resources/js/bookingtour/custom.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\DATN_booking_tour\resources\js\bookingtour\custom.js */"./resources/js/bookingtour/custom.js");


/***/ })

/******/ });