$.fn.select2.amd.require(['select2/selection/search'], function (Search) {
    var oldRemoveChoice = Search.prototype.searchRemoveChoice;

    Search.prototype.searchRemoveChoice = function () {
        oldRemoveChoice.apply(this, arguments);
        this.$search.val('');
    };
});

$(function () {
    if ($('input[name=time_zone_browser]').length) {
        let objectDate = new Date()
        let timezone = 0 - objectDate.getTimezoneOffset()/60
        $('input[name=time_zone_browser]').val(timezone)
    }
    if ($('.check-add-lesson').length) {
        $('#publish_start_date input').datetimepicker({
            format: 'YYYY/MM/DD HH:mm',
            useCurrent: false,
            minDate: moment().format('YYYY/MM/DD HH:mm'),
            defaultDate: moment(),
            showClear: true
        })

        $('#publish_end_date input').datetimepicker({
            format: 'YYYY/MM/DD HH:mm',
            useCurrent: false,
            minDate: moment().format('YYYY/MM/DD HH:mm'),
            defaultDate: false,
            showClear: true
        })
    }

    $('.thumbnail-of-video input').datetimepicker({
        format: 'HH:mm:ss',
        useCurrent: false,
        showClear: true
    })

    if ($('.check-edit-lesson').length) {
        let valStart = $('#publish_start_date input').data('val')
        let defaultStart = valStart ? convertToLocale(valStart).format('YYYY/MM/DD HH:mm') : false
        var now = moment();
        if(defaultStart){
            $('#publish_start_date input').val(defaultStart)
        }
        $('#publish_start_date input').datetimepicker({
            format: 'YYYY/MM/DD HH:mm',
            useCurrent: false,
            minDate: now,
            showClear: true,
            keepInvalid: true,
            //defaultDate: defaultStart
        })

        // $('#publish_start_date input').on('dp.change', e => {
        //     $('#publish_end_date input').data("DateTimePicker").options({
        //         minDate: e.date ? e.date : false
        //     })
        // })

        let valEnd = $('#publish_end_date input').data('val')
        let defaultEnd = valEnd ? convertToLocale(valEnd).format('YYYY/MM/DD HH:mm') : false
        if(defaultEnd){
            $('#publish_end_date input').val(defaultEnd);
        }
        $('#publish_end_date input').datetimepicker({
            format: 'YYYY/MM/DD HH:mm',
            useCurrent: false,
            minDate: now,
            showClear: true,
            keepInvalid: true,
            //defaultDate: defaultEnd,
        })

        // $('#publish_end_date input').on('dp.change', e => {
        //     $('#publish_start_date input').data("DateTimePicker").options({
        //         maxDate: e.date ? e.date : false
        //     })
        // })
    }

    //excute thumbnail
    $('#thumbnail').on('dragover', function(e) {
        e.preventDefault()
        e.stopPropagation()
    })

    $('#thumbnail').on('dragenter', function(e) {
        e.preventDefault()
        e.stopPropagation()
    })

    var fileUploadTest;
    $('#thumbnail').on('drop', function(e){
        if(e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {
            e.preventDefault()
            e.stopPropagation()
            //document.getElementById('file-img-thumbnail').files = e.originalEvent.dataTransfer.files
            fileUploadTest = e.originalEvent.dataTransfer.files;
            //$('#thumbnail input[type=file]').trigger('change');
            checkFile(fileUploadTest);
        }
    })

    function checkFile(file){
        if (file.length) {
            let nameFile = file.length ? file[0].name : null
            $("#thumbnail input[type=text]").val(nameFile)
            document.getElementById("preview-thumbnail").src = URL.createObjectURL(file[0])
        } else {
            $("#thumbnail input[type=text]").val(null)
            document.getElementById("preview-thumbnail").src = ''
        }
    }

    $("#thumbnail input[type=file]").on('change', event => {
        fileUploadTest = event.target.files;
        checkFile(fileUploadTest)
    })

    $('#thumbnail .clear-file').on('click', event => {
        fileUploadTest = null
        $("#thumbnail input[type=file]").val(null)
        checkFile([])
    })

    //excute upload video
    $('.upload-one-file input[type=file]').on('change', event => {
        let parent = $(event.target).parents('.upload-one-file')
        let inputText = $(event.target).parents('.input-group-btn').siblings('input[type=text]')

        if (event.target.files.length) {
            let nameFile = event.target.files.length ? event.target.files[0].name : null
            inputText.val(nameFile)
            if ($(event.target).hasClass('input-video')) {
                let video = document.createElement('video');
                let duration = 0
                video.preload = 'metadata';
                video.onloadedmetadata = () => {
                    window.URL.revokeObjectURL(video.src);
                    duration = video.duration;
                    parent.find('.duration-video').val(duration)
                }
                video.src = URL.createObjectURL(event.target.files[0]);
                parent.find('.video-option').show()
            }
        } else {
            inputText.val(null)
            if ($(event.target).hasClass('input-video')) {
                parent.find('.video-option').hide()
                parent.find('.video-option input[type=file]').val(null).change()
                parent.find('.thumbnail-video input[type=text]').val('00:00:00')
            }
        }
    })

    $('.upload-one-file .fa-times-circle').on('click', event => {
        let parent = $(event.target).parents('.upload-one-file')
        let inputFile = $(event.target).siblings('.input-group-btn').find('input[type=file]')
        let inputText = $(event.target).siblings('input[type=text]')

        $(event.target).parents('.video').siblings('.status-video').empty();
        inputFile.val(null).change()
        inputText.val(null)
    })

    //ajax remove image on server
    function removeFileInServer(path) {
        $.ajax(
        {
            url: path,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_method": 'DELETE',
            }
        });
    }

    function softDelFileLesson(path) {
        $.ajax(
        {
            url: path,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_method": 'DELETE',
            }
        });
    }

    //quill for content create lesson
    if ($('.add-lesson').length) {
        let tranFromServer = $('#dataFromServer').data('trans')
        let options = {
            modules: {
                toolbar: [
                    [{ 'font': [] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['fullscreen'],
                ],
                imageResize: {
                    displaySize: true
                }
            },
            placeholder: tranFromServer['placeholder'],
            theme: 'snow'
        };

        let editor = new Quill('#content-quill', options);
        $('.ql-fullscreen').html('<i class="fa fa-arrows-alt" aria-hidden="true"></i>')
        let customButton = document.querySelector('.ql-fullscreen')
        let elFullScreen = document.getElementById('tab-quill')
        customButton.addEventListener('click', function(e) {
          if (screenfull.enabled) {
            screenfull.toggle(elFullScreen)
          } else {

          }
        });

        editor.on('text-change', function(delta, oldDelta, source) {
            if (editor.getLength() > 5000) {
                editor.deleteText(5000, editor.getLength());
            }
            $('#content-lesson').val($('.ql-editor').html())
            $('#content-text-lesson').val($('.ql-editor').text())
        })

        $('.ql-editor').html($('#content-lesson').text())

        let base_url = $('#dataFromServer').data('url-search-tag')
        $('.tag-select').select2({
            tags: true,
            maximumInputLength: 15,
            maximumSelectionLength: 5,
            language: $('meta[name="app-lang"]').attr('content'),
        }).on('select2:open', function() {
            $('.select2-search__field').attr('maxlength', 15);
        });
    }

    //list lesson
    if ($('#datatable-list').length) {
        let langDatatable = $('#message-data').data('lang-datatable');
        let langMessConfirm = $('#message-data').data('mess-confirm');
        let urlAjaxDataTable = $('#message-data').data('url-datatable');
        let messAction = $('#message-data').data('mess-action');
        let urlDelete = $('#message-data').data('url-delete')
        let urlEdit = $('#message-data').data('url-edit');

        let table = $('#datatable-list').dataTable({
            'processing': true,
            'serverSide': true,
            'searchDelay': 400,
            'info': false,
            "order": [],
            'language': {
                'infoFiltered': '',
                'info' : langDatatable['info'],
                'paginate': {
                    'previous': langDatatable['previous'],
                    'next': langDatatable['next'],
                    'first': langDatatable['first'],
                    'last': langDatatable['last'],
                },
                'search': langDatatable['search'],
                'searchPlaceholder': langDatatable['searchPlaceholder'],
                'zeroRecords': langDatatable['zeroRecords'],
                'lengthMenu': langDatatable['lengthMenu'],
            },
            "sPaginationType": "full_numbers",
            "info": false,
            'ajax': {
                'url' : urlAjaxDataTable,
                'data': function (d) {
                    if ($('.toggle-advanced-search i').hasClass('fa-caret-up')) {
                        d.category_id = $('.category-search .advanced-select-search').val()
                        d.teacher_id = $('.teacher-search .advanced-select-search').val()
                        d.tag_id = $('.tag-search .advanced-select-search').val()
                    }
                }
            },
            'columns': [
                { 'data': 'lesson_name'},
                { 'data': 'teacher_name' },
                { 'data': 'category_name' },
                { 'data': 'publish_start_date' },
                { 'data': 'publish_end_date' },
                { 'data': 'level' },
                { 'data': null },
            ],
            'columnDefs': [
                {
                    'targets': 0,
                },
                {
                    'targets': 1,
                    'searchable': false,
                    'sortable': false,
                },
                {
                    'targets': 2,
                    'class': 'text-center',
                    'searchable': false,
                    'sortable': false,
                },
                {
                    'targets': 3,
                    'searchable': false,
                },
                {
                    'targets': 4,
                    'searchable': false,
                },
                {
                    'targets': 5,
                    'searchable': false,
                },
                {
                    'targets': 6,
                    'searchable': false,
                    'sortable': false,
                    'class': 'text-center',
                },
            ],
            'createdRow': function (row, data, index) {
                let editLink = urlEdit.replace('ID_REPLY_IN_URL', data.id);
                let isDelete = !data.deleted_at
                $('td', row).eq(6).empty().append(`
                    <div class="group-action">
                        <a data-toggle="tooltip" data-placement="left" title="${ messAction['edit'] }" href="${ editLink }" class="btn btn-primary group-action-link">
                            <i class="fa fa-pencil-square-o fa fa-lg"></i></a>
                        <div class="onoffswitch group-action-switch">
                            <button class="show-modal-confirm" data-toggle="modal" data-target="#modal-default" style="display:none;"></button>
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch-${data.id}"
                                ${isDelete ? 'checked' : ''} data-id="${data.id}" data-show-modal="true">
                            <label class="onoffswitch-label" for="myonoffswitch-${data.id}">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                `).addClass('text-center');

                $('td', row).eq(5).empty().append(`
                    <p class="lesson_level">${renderHtmlLevel(data.level)}</p>
                `)

                $('td', row).eq(0).empty().append(`
                    <a href='${editLink}'>${data.lesson_name}</a>
                `)
                if (convertToLocale(data.publish_start_date)._isValid) {
                    $('td', row).eq(3).empty().append(convertToLocale(data.publish_start_date).format('YYYY/MM/DD HH:mm'))
                }
                if (convertToLocale(data.publish_end_date)._isValid) {
                    $('td', row).eq(4).empty().append(convertToLocale(data.publish_end_date).format('YYYY/MM/DD HH:mm'))
                }
            },
        });


        let idInputOnOff = null
        $('body').on('change', '.lesson-list .onoffswitch-checkbox', function(e){
            idInputOnOff = '#' + $(this).attr('id')
            var action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
            $('#delete-lesson-form').attr('action', action)
            if(this.checked) { //delete
                $('#modal-default .modal-title').text(langMessConfirm['anable_lesson'])
                $(this).siblings('.show-modal-confirm').trigger('click')
            } else { //open
                $('#modal-default .modal-title').text(langMessConfirm['disable_lesson'])
                $(this).siblings('.show-modal-confirm').trigger('click')
            }
        })

        $('body').on('click', '.lesson-list #modal-default .close-confirm, .lesson-list #modal-default .close', e => {
            $('#delete-lesson-form').attr('action', urlDelete)
            $(idInputOnOff).prop('checked', !$(idInputOnOff).prop('checked'))
            e.stopPropagation()
        })

        $('body').on('click', '.lesson-list #modal-default, .lesson-list #modal-default .modal-dialog', e => {
            $('#delete-lesson-form').attr('action', urlDelete)
            $(idInputOnOff).prop('checked', !$(idInputOnOff).prop('checked'))
        })

        $('body').on('click', '.lesson-list #modal-default .yes-confirm', e => {
            $('#delete-lesson-form').submit()
        })

        $('body').on('click', '.lesson-list .search_lesson span', e => {
            let keysearch = $(e.target).siblings('input').val()
            table.fnFilter(keysearch)
        })

        $('.advanced-select-search').select2({
            maximumInputLength: 15,
            maximumSelectionLength: 3,
            language: $('meta[name="app-lang"]').attr('content')
        });

        $('body').on('click', '.toggle-advanced-search a', function (e) {
            $('.wrap-advanced-search').slideToggle()
            $(this).siblings('i').toggleClass('fa-caret-up')
            $(this).siblings('i').toggleClass('fa-caret-down')
        })

        $('body').on('keydown', '.search_lesson input[type=search]', e => {
            if (e.which == 13) {
                e.preventDefault();
                let keysearch = $(e.target).val()
                table.fnFilter(keysearch)
            }
        })
    }

    $('body').on('click', '.add-lesson #modal-default .yes-confirm', e => {
        let url = $('#submit-form p.btn-danger').data('url')
        window.location.href = url
    })

    //handle load teacher in create and edit lesson
    setTimeout(function(){
        $('.select-box-teacher div.filter-option').each(function (index) {
            $(this).click()
        })

        $('#name').click()
        $('#name').focus()
        $('#name').blur()

        if ($('.check-edit-lesson').length) {
            $('select.select-teacher').each(function (index) {
                $(this).trigger('change')
            })
        }
    }, 500);

    $('body').on('change', 'select.select-teacher', function (e) {
        let el = $(this)
        let positionChange = el.data('teacher')

        whenChoiseTeacher(positionChange)
        e.stopPropagation()
    })


    let whenChoiseTeacher = function (positionChange) {
        if (positionChange == 'main') {
            handleSelectBox($('select.select-teacher-one'), $('select.select-teacher-main'), $('select.select-teacher-two'))
            handleSelectBox($('select.select-teacher-two'), $('select.select-teacher-main'), $('select.select-teacher-one'))
        } else if (positionChange == 'one') {
            handleSelectBox($('select.select-teacher-main'), $('select.select-teacher-one'), $('select.select-teacher-two'))
            handleSelectBox($('select.select-teacher-two'), $('select.select-teacher-one'), $('select.select-teacher-main'))
        } else if (positionChange == 'two') {
            handleSelectBox($('select.select-teacher-main'), $('select.select-teacher-two'), $('select.select-teacher-one'))
            handleSelectBox($('select.select-teacher-one'), $('select.select-teacher-two'), $('select.select-teacher-main'))
        }
    }

    let handleSelectBox = function (handleFor, selectOne, selectTwo) {
        let teacherChoised = []
        let valOne = selectOne.val()[0]
        let valTwo = selectTwo.val()[0]

        if (valOne) {
            teacherChoised.push($(`select.select-teacher-main option[value=${valOne}]`).text())
        }

        if (valTwo) {
            teacherChoised.push($(`select.select-teacher-main option[value=${valTwo}]`).text())
        }

        handleFor.find('option').each(function (index) {
            let textInOption = $(this).text()

            if ($.inArray(textInOption, teacherChoised) != -1) {
                $(this).prop('disabled', true)
            } else {
                $(this).prop('disabled', false)
            }
        })

        handleFor.selectpicker('render')
    }

    //end handle load teacher in create and edit lesson

    //submit form create
    $('body').on('submit', '#add-lesson', function (e) {
        e.preventDefault()
        $('span.text-danger').empty()
        let url = $(this).attr('action')
        let urlIndex = $(this).data('url-index')
        let formData = new FormData(this)
        fileUploadTest = fileUploadTest || '';
        if(fileUploadTest){
            formData.append('thumbnail', fileUploadTest[0], fileUploadTest[0].name);
        }
        $('.progress-upload-form').show()

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: data => {
              window.location.href = urlIndex
            },
            error: data => {
                if (data.status == 422) {
                    $('.progress-upload-form').hide()
                    showMessErrForm(data.responseJSON.errors)
                }
            },
            xhr: progressUpload,
        })
    })

    function renderHtmlLevel(level) {
        let stringHtml = ''
        for (let i = 1; i <= 5; i++) {
            stringHtml += `<i class="fa ${i <= level ? 'fa-star below-level' : 'fa-star-o above-level'}" aria-hidden="true"></i>`
        }

        return stringHtml
    }

    function convertToLocale(val)
    {
        let objectDate = new Date()
        let timezone = 0 - objectDate.getTimezoneOffset()/60

        return moment(val).add(timezone, 'h')
    }

    function appendMes(messages, classEl)
    {
        let htmlCode = ''

        $.each(messages, (key1, val1) => {
          htmlCode += `<strong>${val1}</strong><br>`
        })

        $('.text-danger.' + classEl).html(htmlCode)
    }

    function progressUpload() {
        var xhr = new window.XMLHttpRequest();

        xhr.upload.addEventListener("progress", function(evt) {
          if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            percentComplete = parseInt(percentComplete * 100);
            $('.progress-upload-form span').text(percentComplete + '%')
          }
        }, false);

        return xhr;
    }

    function showMessErrForm(errors)
    {
      $.each(errors, (key, val) => {
        switch (true) {
          case key == 'name':
            appendMes(val, 'name-error')
            break
          case key == 'group_id':
            appendMes(val, 'group_id')
            break
          case key == 'level':
            appendMes(val, 'level')
            break
          case key == 'teacher_main':
            appendMes(val, 'teacher_main')
            break
          case key == 'teacher_one':
            appendMes(val, 'teacher_one')
            break
          case key == 'teacher_two':
            appendMes(val, 'teacher_two')
            break
          case key == 'category_id':
            appendMes(val, 'category_id')
            break
          case key == 'content':
            appendMes(val, 'content-mes-error')
            break
          case /tag_id[.\d*]?/.test(key):
            appendMes(val, 'tag_id')
            break
          case key == 'publish_start_date':
            appendMes(val, 'publish_start_date')
            break
          case key == 'publish_end_date':
            appendMes(val, 'publish_end_date')
            break
          case key == 'attachFiles.1':
            appendMes(val, 'attach-file-1')
            break
          case key == 'attachFiles.2':
            appendMes(val, 'attach-file-2')
            break
          case key == 'attachFiles.3':
            appendMes(val, 'attach-file-3')
            break
          case /updateFiles[.\d*]?/.test(key):
            let classE = key.replace('.', '-')
            appendMes(val, classE)
            break
          case key == 'thumbnail':
            appendMes(val, 'thumbnail-mes')
            break
          case key == 'videos.1.v':
            appendMes(val, 'video-1')
            break
          case key == 'videos.2.v':
            appendMes(val, 'video-2')
            break
          case key == 'videos.3.v':
            appendMes(val, 'video-3')
            break
          case key == 'videos.1.en':
            appendMes(val, 'sub-1-en')
            break
          case key == 'videos.2.en':
            appendMes(val, 'sub-2-en')
            break
          case key == 'videos.3.en':
            appendMes(val, 'sub-3-en')
            break
          case key == 'videos.1.ja':
            appendMes(val, 'sub-1-ja')
            break
          case key == 'videos.2.ja':
            appendMes(val, 'sub-2-ja')
            break
          case key == 'videos.3.ja':
            appendMes(val, 'sub-3-ja')
            break
        }
      })
    }
});
