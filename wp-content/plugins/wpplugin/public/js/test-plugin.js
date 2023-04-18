jQuery(document).ready(function($) {
    var data = {
        'action': 'get_records',
        'nonce': getRecords.nonce,
    };

    $.post(getRecords.ajaxUrl, data, function(response) {
        if (response.success) {
            $('body').append(response.data);
        }
    });
});
