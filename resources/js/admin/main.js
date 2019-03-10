$(document).ready(function () {
    $('#check-all').click(function () {
        var check = $(this).prop('checked');
        $('.checkbox-input').prop('checked', (check ? 'checked' : ''));
        
    });
    $('.export-btn').click(function () {
        $(this).next().submit();
        return false;
    });
});
