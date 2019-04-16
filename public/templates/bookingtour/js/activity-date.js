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
/******/ 	return __webpack_require__(__webpack_require__.s = 63);
/******/ })
/************************************************************************/
/******/ ({

/***/ 63:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(64);


/***/ }),

/***/ 64:
/***/ (function(module, exports) {

;(function ($, window, undefined) {

	'use strict';

	$.CatSlider = function (options, element) {
		this.$el = $(element);
		this._init(options);
	};

	$.CatSlider.prototype = {

		_init: function _init(options) {

			// the categories (ul)
			this.$categories = this.$el.children('ul');
			// the navigation
			this.$navcategories = this.$el.find('nav > a');
			var animEndEventNames = {
				'WebkitAnimation': 'webkitAnimationEnd',
				'OAnimation': 'oAnimationEnd',
				'msAnimation': 'MSAnimationEnd',
				'animation': 'animationend'
			};
			// animation end event name
			this.animEndEventName = animEndEventNames[Modernizr.prefixed('animation')];
			// animations and transforms support
			this.support = Modernizr.csstransforms && Modernizr.cssanimations;
			// if currently animating
			this.isAnimating = false;
			// current category
			this.current = 0;
			var $currcat = this.$categories.eq(0);
			if (!this.support) {
				this.$categories.hide();
				$currcat.show();
			} else {
				$currcat.addClass('mi-current');
			}
			// current nav category
			this.$navcategories.eq(0).addClass('mi-selected');
			// initialize the events
			this._initEvents();
		},
		_initEvents: function _initEvents() {

			var self = this;
			this.$navcategories.on('click.catslider', function () {
				self.showCategory($(this).index());
				return false;
			});

			// reset on window resize..
			$(window).on('resize', function () {
				self.$categories.removeClass().eq(0).addClass('mi-current');
				self.$navcategories.eq(self.current).removeClass('mi-selected').end().eq(0).addClass('mi-selected');
				self.current = 0;
			});
		},
		showCategory: function showCategory(catidx) {

			if (catidx === this.current || this.isAnimating) {
				return false;
			}
			this.isAnimating = true;
			// update selected navigation
			this.$navcategories.eq(this.current).removeClass('mi-selected').end().eq(catidx).addClass('mi-selected');

			var dir = catidx > this.current ? 'right' : 'left',
			    toClass = dir === 'right' ? 'mi-moveToLeft' : 'mi-moveToRight',
			    fromClass = dir === 'right' ? 'mi-moveFromRight' : 'mi-moveFromLeft',

			// current category
			$currcat = this.$categories.eq(this.current),

			// new category
			$newcat = this.$categories.eq(catidx),
			    $newcatchild = $newcat.children(),
			    lastEnter = dir === 'right' ? $newcatchild.length - 1 : 0,
			    self = this;

			if (this.support) {

				$currcat.removeClass().addClass(toClass);

				setTimeout(function () {

					$newcat.removeClass().addClass(fromClass);
					$newcatchild.eq(lastEnter).on(self.animEndEventName, function () {

						$(this).off(self.animEndEventName);
						$newcat.addClass('mi-current');
						self.current = catidx;
						var $this = $(this);
						// solve chrome bug
						self.forceRedraw($this.get(0));
						self.isAnimating = false;
					});
				}, $newcatchild.length * 90);
			} else {

				$currcat.hide();
				$newcat.show();
				this.current = catidx;
				this.isAnimating = false;
			}
		},
		// based on http://stackoverflow.com/a/8840703/989439
		forceRedraw: function forceRedraw(element) {
			if (!element) {
				return;
			}
			var n = document.createTextNode(' '),
			    position = element.style.position;
			element.appendChild(n);
			element.style.position = 'relative';
			setTimeout(function () {
				element.style.position = position;
				n.parentNode.removeChild(n);
			}, 25);
		}

	};

	$.fn.catslider = function (options) {
		var instance = $.data(this, 'catslider');
		if (typeof options === 'string') {
			var args = Array.prototype.slice.call(arguments, 1);
			this.each(function () {
				instance[options].apply(instance, args);
			});
		} else {
			this.each(function () {
				instance ? instance._init() : instance = $.data(this, 'catslider', new $.CatSlider(options, this));
			});
		}
		return instance;
	};
})(jQuery, window);

// Avoid `console` errors in browsers that lack a console.
(function () {
	"use strict";

	jQuery(window).ready(function ($) {
		if ($('#mi-slider').length > 0) {
			$('#mi-nav').height(($('#mi-nav a').length - 1) * ($('#mi-nav a').outerHeight() + parseInt($('#mi-nav a').css('margin-bottom'))));
			jQuery('#mi-slider').catslider();
			$('#mi-slider ul li').each(function () {
				var el = $(this).find('a');
				var img = el.find('img');
				el.css('background-image', 'url(' + img.attr('src') + ')');
				img.remove();
			});
		}
	});

	$(window).bind("load", function () {
		$('#status').fadeOut(); // will first fade out the loading animation
		$('#preloader').delay(1000).fadeOut('slow'); // will fade out the white DIV that covers the website.
		$('body').delay(1000).css({ 'overflow-x': 'hidden' }).css({ 'overflow-y': 'auto' });
	});
})();

/***/ })

/******/ });