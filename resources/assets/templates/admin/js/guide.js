$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})

$(function() {
    //table list guide
    var langDatatable = $('#message-data').data('lang-datatable')
    if($('#data-list-guide').length){
        var table = $('#data-list-guide').DataTable({
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
                { "width": "35%", "targets": 3 },
                {
                    'targets': 4,
                    'sortable': false,
                    'searchable': false,
                    "width": "20%",
                }
            ],
            fixedColumns: true,
        })
    }

    $('body').on('click', '.add-guide #modal-default .yes-confirm', e => {
        let url = $('#submit-form p.btn-danger').data('url')
        window.location.href = url
    })

    $('body').on('click', '.delete-guide-trigger', function(e){
        let guideId = $(this).data("guide-id");
        event.preventDefault();
        $('#modal-default').modal('show', {backdrop: 'true'});
        var url_delete = $(this).data('url-delete')
        $('.delete-guide-form').attr('action', url_delete);
    })

    $('body').on('click', '.guide-list #modal-default .yes-confirm', e => {
        $('.delete-guide-form').submit();
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
              case key == 'guide_id':
                appendMes(val, 'guide_id')
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
})

