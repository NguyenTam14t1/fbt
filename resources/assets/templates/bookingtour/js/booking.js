$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(function () {
    //get info guest
    function getAllGuests(allGuest) {
      let infoGuestArr = []

      for (var i = 0; i < allGuest; i++) {
        let objGuest = {
          full_name: $('#guest-full-name-' + i).val() || null,
          date_born: $('#guest-date-born-' + i).val() || null,
          guest_type: $('#guest-guest-type-' + i).val() || null,
        }
        infoGuestArr.push(objGuest)
      }

      return infoGuestArr
    }

    //prevent submit form create booking
    $('body').on('submit', '#add-tour', function (e) {
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
})
//create booking tour