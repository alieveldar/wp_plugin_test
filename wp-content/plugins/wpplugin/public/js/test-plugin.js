jQuery(document).ready(function($) {
    var data = {
        'action': 'oldest_posts',
        'nonce': oldestPostsAjax.nonce,
    };

    $.post(oldestPostsAjax.ajaxUrl, data, function(response) {
        if (response.success) {
            $('body').append(response.data);
        }
    });
});
