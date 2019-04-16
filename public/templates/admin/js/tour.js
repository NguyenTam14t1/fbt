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
/******/ 	return __webpack_require__(__webpack_require__.s = 67);
/******/ })
/************************************************************************/
/******/ ({

/***/ 67:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(68);


/***/ }),

/***/ 68:
/***/ (function(module, exports) {

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$.fn.select2.amd.require(['select2/selection/search'], function (Search) {
    var oldRemoveChoice = Search.prototype.searchRemoveChoice;

    Search.prototype.searchRemoveChoice = function () {
        oldRemoveChoice.apply(this, arguments);
        this.$search.val('');
    };
});

$(function () {
    if ($('input[name=time_zone_browser]').length) {
        var objectDate = new Date();
        var timezone = 0 - objectDate.getTimezoneOffset() / 60;
        $('input[name=time_zone_browser]').val(timezone);
    }
    if ($('.check-add-tour').length) {
        $('#publish_start_date input').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            useCurrent: false,
            minDate: moment().format('YYYY-MM-DD HH:mm'),
            defaultDate: moment(),
            showClear: true
        });

        $('#publish_end_date input').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            useCurrent: false,
            minDate: moment().format('YYYY-MM-DD HH:mm'),
            defaultDate: false,
            showClear: true
        });
    }

    $('.thumbnail-of-video input').datetimepicker({
        format: 'HH:mm:ss',
        useCurrent: false,
        showClear: true
    });

    if ($('.check-edit-tour').length) {
        var valStart = $('#publish_start_date input').data('val');
        var defaultStart = valStart ? convertToLocale(valStart).format('YYYY-MM-DD HH:mm') : false;
        var now = moment();
        if (defaultStart) {
            $('#publish_start_date input').val(defaultStart);
        }
        $('#publish_start_date input').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            useCurrent: false,
            minDate: now,
            showClear: true,
            keepInvalid: true
            //defaultDate: defaultStart
        });

        // $('#publish_start_date input').on('dp.change', e => {
        //     $('#publish_end_date input').data("DateTimePicker").options({
        //         minDate: e.date ? e.date : false
        //     })
        // })

        var valEnd = $('#publish_end_date input').data('val');
        var defaultEnd = valEnd ? convertToLocale(valEnd).format('YYYY-MM-DD HH:mm') : false;
        if (defaultEnd) {
            $('#publish_end_date input').val(defaultEnd);
        }
        $('#publish_end_date input').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            useCurrent: false,
            minDate: now,
            showClear: true,
            keepInvalid: true
            //defaultDate: defaultEnd,
        });

        // $('#publish_end_date input').on('dp.change', e => {
        //     $('#publish_start_date input').data("DateTimePicker").options({
        //         maxDate: e.date ? e.date : false
        //     })
        // })
    }

    //excute thumbnail
    $('#thumbnail').on('dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    $('#thumbnail').on('dragenter', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    var fileUploadTest;
    $('#thumbnail').on('drop', function (e) {
        if (e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {
            e.preventDefault();
            e.stopPropagation();
            //document.getElementById('file-img-thumbnail').files = e.originalEvent.dataTransfer.files
            fileUploadTest = e.originalEvent.dataTransfer.files;
            //$('#thumbnail input[type=file]').trigger('change');
            checkFile(fileUploadTest);
        }
    });

    function checkFile(file) {
        if (file.length) {
            var nameFile = file.length ? file[0].name : null;
            $("#thumbnail input[type=text]").val(nameFile);
            document.getElementById("preview-thumbnail").src = URL.createObjectURL(file[0]);
        } else {
            $("#thumbnail input[type=text]").val(null);
            document.getElementById("preview-thumbnail").src = '';
        }
    }

    $("#thumbnail input[type=file]").on('change', function (event) {
        fileUploadTest = event.target.files;
        checkFile(fileUploadTest);
    });

    //ajax remove image on server
    function removeFileInServer(path) {
        $.ajax({
            url: path,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_method": 'DELETE'
            }
        });
    }

    //quill for content create tour
    if ($('.add-tour').length) {
        var tranFromServer = $('#dataFromServer').data('trans');
        var options = {
            modules: {
                toolbar: [[{ 'font': [] }], ['bold', 'italic', 'underline'], ['link', 'image'], [{ 'list': 'ordered' }, { 'list': 'bullet' }], [{ 'align': [] }], [{ 'color': [] }, { 'background': [] }], ['fullscreen']],
                imageResize: {
                    displaySize: true
                }
            },
            placeholder: tranFromServer['placeholder'],
            theme: 'snow'
        };

        var editor = new Quill('#content-quill', options);
        $('.ql-fullscreen').html('<i class="fa fa-arrows-alt" aria-hidden="true"></i>');
        var customButton = document.querySelector('.ql-fullscreen');
        var elFullScreen = document.getElementById('tab-quill');
        customButton.addEventListener('click', function (e) {
            if (screenfull.enabled) {
                screenfull.toggle(elFullScreen);
            } else {}
        });

        editor.on('text-change', function (delta, oldDelta, source) {
            if (editor.getLength() > 5000) {
                editor.deleteText(5000, editor.getLength());
            }
            $('#content-tour').val($('.ql-editor').html());
            $('#content-text-tour').val($('.ql-editor').text());
        });

        $('.ql-editor').html($('#content-tour').text());

        // let base_url = $('#dataFromServer').data('url-search-tag')
        // $('.tag-select').select2({
        //     tags: true,
        //     maximumInputLength: 15,
        //     maximumSelectionLength: 5,
        //     language: $('meta[name="app-lang"]').attr('content'),
        // }).on('select2:open', function() {
        //     $('.select2-search__field').attr('maxlength', 15);
        // });
    }

    $('body').on('click', '.add-tour #modal-default .yes-confirm', function (e) {
        var url = $('#submit-form p.btn-danger').data('url');
        window.location.href = url;
    });

    //handle load teacher in create and edit tour
    setTimeout(function () {
        $('.select-box-teacher div.filter-option').each(function (index) {
            $(this).click();
        });

        $('#name').click();
        $('#name').focus();
        $('#name').blur();

        if ($('.check-edit-tour').length) {
            $('select.select-teacher').each(function (index) {
                $(this).trigger('change');
            });
        }
    }, 500);

    $('body').on('change', 'select.select-teacher', function (e) {
        var el = $(this);
        var positionChange = el.data('teacher');

        whenChoiseTeacher(positionChange);
        e.stopPropagation();
    });

    //end handle load teacher in create and edit tour

    //submit form create
    $('body').on('submit', '#add-tour', function (e) {
        e.preventDefault();
        $('span.text-danger').empty();
        var url = $(this).attr('action');
        var urlIndex = $(this).data('url-index');
        var formData = new FormData(this);
        fileUploadTest = fileUploadTest || '';
        if (fileUploadTest) {
            formData.append('thumbnail', fileUploadTest[0], fileUploadTest[0].name);
        }
        $('.progress-upload-form').show();

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function success(data) {
                window.location.href = urlIndex;
            },
            error: function error(data) {
                if (data.status == 422) {
                    $('.progress-upload-form').hide();
                    showMessErrForm(data.responseJSON.errors);
                }
            },
            xhr: progressUpload
        });
    });

    function convertToLocale(val) {
        var objectDate = new Date();
        var timezone = 0 - objectDate.getTimezoneOffset() / 60;

        return moment(val).add(timezone, 'h');
    }

    function appendMes(messages, classEl) {
        var htmlCode = '';

        $.each(messages, function (key1, val1) {
            htmlCode += '<strong>' + val1 + '</strong><br>';
        });

        $('.text-danger.' + classEl).html(htmlCode);
    }

    function progressUpload() {
        var xhr = new window.XMLHttpRequest();

        xhr.upload.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                percentComplete = parseInt(percentComplete * 100);
                $('.progress-upload-form span').text(percentComplete + '%');
            }
        }, false);

        return xhr;
    }

    function showMessErrForm(errors) {
        $.each(errors, function (key, val) {
            switch (true) {
                case key == 'name':
                    appendMes(val, 'name-error');
                    break;
                case key == 'group_id':
                    appendMes(val, 'group_id');
                    break;
                case key == 'level':
                    appendMes(val, 'level');
                    break;
                case key == 'teacher_main':
                    appendMes(val, 'teacher_main');
                    break;
                case key == 'teacher_one':
                    appendMes(val, 'teacher_one');
                    break;
                case key == 'teacher_two':
                    appendMes(val, 'teacher_two');
                    break;
                case key == 'category_id':
                    appendMes(val, 'category_id');
                    break;
                case key == 'content':
                    appendMes(val, 'content-mes-error');
                    break;
                case /tag_id[.\d*]?/.test(key):
                    appendMes(val, 'tag_id');
                    break;
                case key == 'publish_start_date':
                    appendMes(val, 'publish_start_date');
                    break;
                case key == 'publish_end_date':
                    appendMes(val, 'publish_end_date');
                    break;
                case key == 'attachFiles.1':
                    appendMes(val, 'attach-file-1');
                    break;
                case key == 'attachFiles.2':
                    appendMes(val, 'attach-file-2');
                    break;
                case key == 'attachFiles.3':
                    appendMes(val, 'attach-file-3');
                    break;
                case /updateFiles[.\d*]?/.test(key):
                    var classE = key.replace('.', '-');
                    appendMes(val, classE);
                    break;
                case key == 'thumbnail':
                    appendMes(val, 'thumbnail-mes');
                    break;
                case key == 'videos.1.v':
                    appendMes(val, 'video-1');
                    break;
                case key == 'videos.2.v':
                    appendMes(val, 'video-2');
                    break;
                case key == 'videos.3.v':
                    appendMes(val, 'video-3');
                    break;
                case key == 'videos.1.en':
                    appendMes(val, 'sub-1-en');
                    break;
                case key == 'videos.2.en':
                    appendMes(val, 'sub-2-en');
                    break;
                case key == 'videos.3.en':
                    appendMes(val, 'sub-3-en');
                    break;
                case key == 'videos.1.ja':
                    appendMes(val, 'sub-1-ja');
                    break;
                case key == 'videos.2.ja':
                    appendMes(val, 'sub-2-ja');
                    break;
                case key == 'videos.3.ja':
                    appendMes(val, 'sub-3-ja');
                    break;
            }
        });
    }

    $('body').on('click', '.delete-tour-trigger', function (e) {
        var tourId = $(this).data("tour-id");
        event.preventDefault();
        $('#modal-default').modal('show', { backdrop: 'true' });
        var url_delete = $(this).data('url-delete');
        $('.delete-tour-form').attr('action', url_delete);
    });

    $('body').on('click', '.tour-list #modal-default .yes-confirm', function (e) {
        $('.delete-tour-form').submit();
    });

    $('body').on('click', '.tour-list .search_item span', function (e) {
        var keysearch = $(e.target).siblings('input').val();
        table.fnFilter(keysearch);
    });

    $('body').on('click', '.tour #modal-default .yes-confirm', function (e) {
        window.location.href = route('admin.tour.index');
    });
});

/***/ })

/******/ });