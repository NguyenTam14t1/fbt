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
$(function() {
    if ($('.check-add-booking').length) {
        $('body').on('click', '.add-booking #modal-default .yes-confirm', e => {
            let url = $('#submit-form p.btn-danger').data('url')
            window.location.href = url
        })
    }

    //prevent submit form create booking
    $('body').on('submit', '#add-booking', function(e) {
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
        if (fileUploadTest) {
            formData.append('thumbnail', fileUploadTest[0], fileUploadTest[0].name);
        }
        // $('.progress-upload-form').show()
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
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
    $('body').on('submit', '#edit-booking', function(e) {
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
        if (fileUploadTest) {
            formData.append('thumbnail', fileUploadTest[0], fileUploadTest[0].name);
        }
        // $('.progress-upload-form').show()
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
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
    if ($('#datatable-list').length) {
        var langDatatable = $('#message-data').data('lang-datatable');
        var urlAjaxDataTable = $('#message-data').data('url-datatable');
        var urlDelete = $('#message-data').data('url-delete');
        var urlEdit = $('#message-data').data('url-edit');
        var messConfirm = $('#message-data').data('mess-confirm');
        var table = $('#datatable-list').DataTable({
            'language': {
                'infoFiltered': '',
                'info': langDatatable['info'],
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
            "oSearch": {
                "bSmart": false
            },
            "sPaginationType": "full_numbers",
            'columnDefs': [{
                'targets': 0,
                'sortable': false,
                'searchable': false,
            }, {
                'targets': 5,
                'sortable': false,
                'searchable': false,
            }, {
                'targets': 7,
                'sortable': false,
                'searchable': false,
            }],
        })

        let isConfirm = null

        $('body').on('change', '.booking-list .onoffswitch1-checkbox', function(e) {
            var actionEdit = urlEdit.replace('ID_REPLY_IN_URL', $(this).data('id'));
            $('#edit-booking-form').attr('action', actionEdit)
            var statusCheck = this.checked

            isConfirm = statusCheck == true ? confirm('Bạn có chắc chắn muốn đổi sang trạng thái đã thanh toán?') : confirm('Bạn có chắc chắn muốn đổi sang trạng thái chưa thanh toán?')

            if (isConfirm) {
                $('#status-payment').val(statusCheck)
                $('#edit-booking-form').submit()
            } else {
                $(this).prop('checked', !statusCheck)
            }
        })
        let idInputOnOff = null
        $('body').on('change', '.booking-list .onoffswitch-checkbox', function(e) {
            idInputOnOff = '#' + $(this).attr('id')
            var action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
            $('#delete-booking-form').attr('action', action)

            if (this.checked) { //delete
                $('#modal-default .modal-title').text('Bạn có chắc chắn muốn kích hoạt lại đơn đặt tour?')
                $(this).siblings('.show-modal-confirm').trigger('click')
            } else { //open
                $('#modal-default .modal-title').text('Bạn có chắc chắn muốn hủy đơn đặt tour')
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

    function appendMes(messages, classEl) {
        let htmlCode = ''

        $.each(messages, (key1, val1) => {
            htmlCode += `<strong>${val1}</strong><br>`
        })

        $('.text-danger.' + classEl).html(htmlCode)
    }

    function showMessErrForm(errors) {
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

    $('body').on('click', '.add-booking #modal-default .yes-confirm', e => {
        let url = $('#submit-form p.btn-danger').data('url')
        window.location.href = url
    })
})
