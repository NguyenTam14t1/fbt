$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})

$(function() {
    //table list hotel
    var langDatatable = $('#message-data').data('lang-datatable')
    if($('#data-list-hotel').length){
        var table = $('#data-list-hotel').DataTable({
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
            'columnDefs': [
                { "width": "10%", "targets": 0 },
                { "width": "20%", "targets": 1 },
                {
                    'targets': 2,
                    'sortable': false,
                    'searchable': false,
                    "width": "15%",
                },
                { "width": "15%", "targets": 3 },
                { "width": "20%", "targets": 4 },
                {
                    'targets': 5,
                    'sortable': false,
                    'searchable': false,
                    "width": "20%",
                }
            ],
            fixedColumns: true,
        })
    }

    //submit create hotel
    var urlIndex = $('#add-hotel').data('url-index')
    $('#btn-select-hotel').click(function(e) {
        e.preventDefault()
        let name = $('#iw-url').data('name-hotel') || null
        let address = $('#iw-address').data('address-hotel') || null
        let phone = $('#iw-phone').data('phone-hotel') || null
        let rating = $('#iw-rating').data('rating-hotel') || null
        let website = $('#iw-website').data('website-hotel') || null
        $.ajax({
        url: route('admin.hotel.store'),
        type: 'POST',
        data: {
            name: name,
            address: address,
            phone: phone,
            rating: rating,
            website: website
        },
        success: data => {
            console.log(data, 'check sel')
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

    $('body').on('click', '.delete-hotel-trigger', function(e){
        let hotelId = $(this).data("hotel-id");
        event.preventDefault();
        $('#modal-default').modal('show', {backdrop: 'true'});
        var url_delete = $(this).data('url-delete')
        $('.delete-hotel-form').attr('action', url_delete);
    })

    $('body').on('click', '.hotel-list #modal-default .yes-confirm', e => {
        $('.delete-hotel-form').submit();
    })

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

    $('body').on('click', '.add-hotel #modal-default .yes-confirm', e => {
        let url = $('#submit-form p.btn-danger').data('url')
        window.location.href = url
    })
})

