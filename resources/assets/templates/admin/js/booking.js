$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// $.fn.select2.amd.require(['select2/selection/search'], function (Search) {
//     var oldRemoveChoice = Search.prototype.searchRemoveChoice;

//     Search.prototype.searchRemoveChoice = function () {
//         oldRemoveChoice.apply(this, arguments);
//         this.$search.val('');
//     };
// });
//add booking
$(function () {
    if ($('.check-add-booking').length) {
        $('#time_start input').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false,
            minDate: moment().format('YYYY-MM-DD'),
            defaultDate: moment(),
            showClear: true
        })

        $('#time_finish input').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false,
            minDate: moment().format('YYYY-MM-DD'),
            defaultDate: false,
            showClear: true
        })

        $('#time_finish input').on('dp.change', function(e) {
            var dateStart = new Date($('#time_start input').val())
            var dateFinish = new Date(e.target.value)
            var timeDiff = dateFinish.getTime() - dateStart.getTime() + 1

            if (timeDiff > 0) {
              var numDays = Math.ceil(timeDiff / (1000 * 3600 *24))
              var objTo = document.getElementById('active_date')
              $('#active_date').empty()
              $('#active_date').data('total-date', numDays)
              $('#label-detail-progam').show()
              var htmlAppend = ''
              for (var i = 0; i < numDays; i++) {
                htmlAppend += `<div id="active-${i}">
                                <div class="col-sm-5 nopadding">
                                  <div class="form-group">
                                    <label for="day-active-date">Time</label>
                                    <input type="text"
                                      name="activity_dates[time][]"
                                      readonly
                                      maxlength="350"
                                      id="time-${i}"
                                      class="form-control pull-right time-active-date"
                                      value="Day ${i+1}">
                                  </div>
                                  <div class="form-group">
                                    <label for="title-active-date">Title: </label><span class="field-required">*</span>
                                    <div class="input-group date">
                                      <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-book"></span>
                                      </span>
                                      <input type="text"
                                        name="activity_dates[title][]"
                                        required="required"
                                        maxlength="{{config('setting.booking.maxlength_name')}}"
                                        class="form-control pull-right title-active-date"
                                        placeholder="Title"
                                        id="title-${i}"
                                        value="">
                                    </div>
                                    <span class="text-danger title_active_date" role="alert"></span>
                                  </div>
                                </div>
                                <div class="col-sm-7 nopadding">
                                  <div class="form-group">
                                    <label for="content-active-date">Detail: </label><span class="field-required">*</span>
                                    <div>
                                      <textarea type="text"
                                        class="form-control content-active-date" rows="7"
                                        required="required"
                                        maxlength="{{config('setting.booking.maxlength_description')}}"
                                        id="detail-${i}"
                                        name="activity_dates[detail][]" placeholder="Content activity date"></textarea>
                                    </div>
                                    <span class="text-danger content_active_date" role="alert"></span>
                                  </div>
                                </div>
                              </div>`;
              }

              $('#active_date').append(htmlAppend)
            }

        })

        // $('.time_active input').datetimepicker({
        //   format: 'YYYY-MM-DD',
        //   useCurrent: false,
        //   minDate: moment().format('YYYY-MM-DD'),
        //   defaultDate: false,
        //   showClear: true
        // })

        // $('#add-active-date .time_active_other input').datetimepicker({
        //   format: 'YYYY-MM-DD',
        //   useCurrent: false,
        //   minDate: moment().format('YYYY-MM-DD'),
        //   defaultDate: false,
        //   showClear: true
        // })
    }

    if ($('.check-edit-booking').length) {
        $('#label-detail-progam').show()
        let valStart = $('#time_start input').data('val')
        let defaultStart = valStart ? convertToLocale(valStart).format('YYYY-MM-DD') : false
        var now = moment();
        if(defaultStart){
            $('#time_start input').val(defaultStart)
        }
        $('#time_start input').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false,
            minDate: now,
            showClear: true,
            keepInvalid: true,
            //defaultDate: defaultStart
        })

        // $('#time_start input').on('dp.change', e => {
        //     $('#time_finish input').data("DateTimePicker").options({
        //         minDate: e.date ? e.date : false
        //     })
        // })

        let valEnd = $('#time_finish input').data('val')
        let defaultEnd = valEnd ? convertToLocale(valEnd).format('YYYY-MM-DD') : false
        if(defaultEnd){
            $('#time_finish input').val(defaultEnd);
        }
        $('#time_finish input').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false,
            minDate: now,
            showClear: true,
            keepInvalid: true,
            //defaultDate: defaultEnd,
        })

        $('#time_finish input').on('dp.change', function(e) {
            var dateStart = new Date($('#time_start input').val())
            var dateFinish = new Date(e.target.value)
            var timeDiff = dateFinish.getTime() - dateStart.getTime() + 1
            if (timeDiff > 0) {
              var numDays = Math.ceil(timeDiff / (1000 * 3600 *24))
              var objTo = document.getElementById('active_date')
              $('#active_date').empty()
              $('#active_date').data('total-date', numDays)
              $('#label-detail-progam').show()
              var htmlAppend = ''
              for (var i = 0; i < numDays; i++) {
                htmlAppend += `<div id="active-${i}">
                                <div class="col-sm-5 nopadding">
                                  <div class="form-group">
                                    <label for="day-active-date">Time</label>
                                    <input type="text"
                                      name="activity_dates[time][]"
                                      readonly
                                      maxlength="350"
                                      id="time-${i}"
                                      class="form-control pull-right time-active-date"
                                      value="Day ${i+1}">
                                  </div>
                                  <div class="form-group">
                                    <label for="title-active-date">Title: </label><span class="field-required">*</span>
                                    <div class="input-group date">
                                      <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-book"></span>
                                      </span>
                                      <input type="text"
                                        name="activity_dates[title][]"
                                        required="required"
                                        maxlength="{{config('setting.booking.maxlength_name')}}"
                                        class="form-control pull-right title-active-date"
                                        placeholder="Title"
                                        id="title-${i}"
                                        value="">
                                    </div>
                                    <span class="text-danger title_active_date" role="alert"></span>
                                  </div>
                                </div>
                                <div class="col-sm-7 nopadding">
                                  <div class="form-group">
                                    <label for="content-active-date">Detail: </label><span class="field-required">*</span>
                                    <div>
                                      <textarea type="text"
                                        class="form-control content-active-date" rows="7"
                                        required="required"
                                        maxlength="{{config('setting.booking.maxlength_description')}}"
                                        id="detail-${i}"
                                        name="activity_dates[detail][]" placeholder="Content activity date"></textarea>
                                    </div>
                                    <span class="text-danger content_active_date" role="alert"></span>
                                  </div>
                                </div>
                              </div>`;
              }

              $('#active_date').append(htmlAppend)
            }

        })

        // $('#time_finish input').on('dp.change', e => {
        //     $('#time_start input').data("DateTimePicker").options({
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


    //quill for content create booking
    if ($('.add-booking').length) {
        let tranFromServer = $('#dataFromServer').data('trans')
        let options = {
            modules: {
                toolbar: [
                    [{ 'font': [] }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'image'],
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
            $('#content-booking').val($('.ql-editor').html())
            $('#content-text-booking').val($('.ql-editor').text())
        })

        $('.ql-editor').html($('#content-booking').text())

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

    $('body').on('click', '.add-booking #modal-default .yes-confirm', e => {
        let url = $('#submit-form p.btn-danger').data('url')
        window.location.href = url
    })

    //handle load teacher in create and edit booking
    setTimeout(function(){
        $('.select-box-teacher div.filter-option').each(function (index) {
            $(this).click()
        })

        $('#name').click()
        $('#name').focus()
        $('#name').blur()

        if ($('.check-edit-booking').length) {
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

    //end handle load teacher in create and edit booking

    //get data active dates

    function getAllActiveDetails(allDay) {
      let activeDetailArr = []

      for (var i = 0; i < allDay; i++) {
        let objActive = {
          id: $('#active-date-id-' + i).val() || null,
          time: $('#time-' + i).val() || null,
          title: $('#title-' + i).val() || null,
          detail: $('#detail-' + i).val() || null,
        }
        activeDetailArr.push(objActive)
      }

      return activeDetailArr
    }
//prevent submit form create booking
    $('body').on('submit', '#add-booking', function (e) {
        e.preventDefault()
        $('span.text-danger').empty()
        let url = $(this).attr('action')
        let urlIndex = $(this).data('url-index')
        let formData = new FormData(this)
        let allDay = $('#active_date').data('total-date')
        let activeDateDatas = allDay > 0 ? getAllActiveDetails(allDay) : null
        let jsonActiveDatas = JSON.stringify(activeDateDatas);

        formData.append('activity_dates', jsonActiveDatas)

        fileUploadTest = fileUploadTest || '';
        if(fileUploadTest){
            formData.append('thumbnail', fileUploadTest[0], fileUploadTest[0].name);
        }
        // $('.progress-upload-form').show()
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
                console.log(data)
                if (data.status == 422) {
                    // $('.progress-upload-form').hide()
                    showMessErrForm(data.responseJSON.errors)
                }
            },
            // xhr: progressUpload,
        })
    })

//prevent submit form create edit booking
    $('body').on('submit', '#edit-booking', function (e) {
        e.preventDefault()
        $('span.text-danger').empty()
        let url = $(this).attr('action')
        let urlIndex = $(this).data('url-index')
        let formData = new FormData(this)
        let allDay = $('#active_date').data('total-date')
        let activeDateDatas = allDay > 0 ? getAllActiveDetails(allDay) : null
        let jsonActiveDatas = JSON.stringify(activeDateDatas)

        console.log(jsonActiveDatas, allDay)

        formData.append('activity_dates', jsonActiveDatas)

        fileUploadTest = fileUploadTest || '';
        if(fileUploadTest){
            formData.append('thumbnail', fileUploadTest[0], fileUploadTest[0].name);
        }
        // $('.progress-upload-form').show()
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: data => {
              // window.location.href = urlIndex
            },
            error: data => {
                console.log(data)
                if (data.status == 422) {
                    // $('.progress-upload-form').hide()
                    showMessErrForm(data.responseJSON.errors)
                }
            },
            // xhr: progressUpload,
        })
    })

//table list booking
    var langDatatable = $('#message-data').data('lang-datatable');
    if($('#datatable-list').length){
        var langDatatable = $('#message-data').data('lang-datatable');
        var urlAjaxDataTable = $('#message-data').data('url-datatable');
        var urlDelete = $('#message-data').data('url-delete');
        var urlEdit = $('#message-data').data('url-edit');
        var messConfirm = $('#message-data').data('mess-confirm');
        var table = $('#datatable-list').DataTable({
            'language': {
                'infoFiltered': '',
                'info' : langDatatable['info'],
                'paginate': {
                    'previous': langDatatable['previous'],
                    'next': langDatatable['next'],
                    'first': langDatatable['first'],
                    'last': langDatatable['last'],
                },
                'zeroRecords': langDatatable['zeroRecords'],
                'lengthMenu': langDatatable['lengthMenu'],
            },
            "order": [],
            "info": false,
            "oSearch": {"bSmart": false},
            "sPaginationType": "full_numbers",
            'columnDefs': [{
                'targets': 0,
                'sortable': false,
                'searchable': false,
            },
            {
                'targets': 5,
                'sortable': false,
                'searchable': false,
            },
            {
                'targets': 7,
                'sortable': false,
                'searchable': false,
            }],
        })

        let idInputOnOff = null
        $('body').on('change', '.booking-list .onoffswitch-checkbox', function(e){
            idInputOnOff = '#' + $(this).attr('id')
            var action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
            $('#delete-booking-form').attr('action', action)

            if(this.checked) { //delete
                $('#modal-default .modal-title').text(langDatatable['title-modal-publish'])
                $(this).siblings('.show-modal-confirm').trigger('click')
            } else { //open
                $('#modal-default .modal-title').text(langDatatable['title-modal-delete'])
                $(this).siblings('.show-modal-confirm').trigger('click')
            }
        })

        $('body').on('click', '.booking-list #modal-default .close-confirm, .booking-list #modal-default .close', e => {
            $('#delete-booking-form').attr('action', urlDelete)
            $(idInputOnOff).prop('checked', !$(idInputOnOff).prop('checked'))
            e.stopPropagation()
        })

        $('body').on('click', '.booking-list #modal-default, .booking-list #modal-default .modal-dialog', e => {
            $('#delete-booking-form').attr('action', urlDelete)
            $(idInputOnOff).prop('checked', !$(idInputOnOff).prop('checked'))
        })

        $('body').on('click', '.booking-list #modal-default .yes-confirm', e => {
            $('#delete-booking-form').submit()
        })
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
          case key == 'place':
            appendMes(val, 'place')
            break
          case key == 'category_id':
            appendMes(val, 'category_id')
            break
          case key == 'hotel_id':
            appendMes(val, 'hotel_id')
            break
          case key == 'guide_id':
            appendMes(val, 'guide_id')
            break
          case key == 'price':
            appendMes(val, 'price')
            break
          case key == 'participants_min':
            appendMes(val, 'participants_min')
            break
          case key == 'participants_max':
            appendMes(val, 'participants_max')
            break
          case key == 'description':
            appendMes(val, 'description-mes-error')
            break
          case key == 'time_start':
            appendMes(val, 'time_start')
            break
          case key == 'time_finish':
            appendMes(val, 'time_finish')
            break
          case key == 'day_active_date':
            appendMes(val, 'day_active_date')
            break
          case key == 'title_active_date':
            appendMes(val, 'title_active_date')
            break
          case key == 'content_active_date':
            appendMes(val, 'content_active_date')
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

    $('body').on('click', '.delete-booking-trigger', function(e){
        let bookingId = $(this).data("booking-id");
        event.preventDefault();
        $('#modal-default').modal('show', {backdrop: 'true'});
        var url_delete = $(this).data('url-delete')
        $('.delete-booking-form').attr('action', url_delete);
    })

    $('body').on('click', '.booking-list #modal-default .yes-confirm', e => {
        $('.delete-booking-form').submit();
    })

    $('body').on('click', '.booking-list .search_item span', e => {
        let keysearch = $(e.target).siblings('input').val()
        table.fnFilter(keysearch)
    })

    $('body').on('click', '.booking #modal-default .yes-confirm', e => {
        window.location.href = route('admin.booking.index');
    })

    // var step = 0;
    // $('body').on('click', '#btn-add-active', function(e) {
    //     step++;
    //     var objTo = document.getElementById('active_date')
    //     var divtest = document.createElement("div");
    //     divtest.setAttribute("class", "form-group row panel-body removeclass" + step);
    //     var rdiv = 'removeclass' + step;
    //     divtest.innerHTML =  `<div class="col-sm-1 nopadding">
    //                             <div class="form-group"  data-active-id="${step}">
    //                               <h5>Day ${step}:</h5>
    //                             </div>
    //                           </div>
    //                           <div class="col-sm-3 nopadding">
    //                             <div class="form-group">
    //                               <input type="text" class="form-control" id="title-active-date" name="title_active_date[]" value="" placeholder="Title">
    //                             </div>
    //                           </div>
    //                           <div class="col-sm-7 nopadding">
    //                             <div class="form-group">
    //                               <textarea type="text" class="form-control" rows="7" id="content-active-date" name="content_active_date[]" placeholder="Content activity date"></textarea>
    //                             </div>
    //                           </div>

    //                           <div class="col-sm-1 nopadding">
    //                             <div class="form-group">
    //                               <div class="input-group">
    //                                 <div class="input-group-btn">
    //                                   <button class="btn btn-danger" type="button" id="btn-cancel-active" onclick="remove_active_date(${step});"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button>
    //                                 </div>
    //                               </div>
    //                             </div>
    //                           </div>

    //                           <div class="clear"></div>`;

    //     objTo.appendChild(divtest)
    //     let dayFinal = step + 1
    //     $('#day-final').html(`Day ${dayFinal}:`)
    //     console.log('check1', step,step+1)
    // })

    // function remove_active_date(rid) {
    //    $('.removeclass'+rid).remove();
    // }


  $('.time_active_other input').datetimepicker({
    format: 'YYYY-MM-DD',
    useCurrent: false,
    defaultDate: false,
    showClear: true
  })
})


