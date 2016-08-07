(function ($, Drupal) {
    'use strict';

    $(".stream-block-video-list .stream-video-list-item").each(function () {
        var key = $(this).attr("x-key");
        $.ajax({
            url: "https://api.twitch.tv/kraken/streams/" + key,
        }).done(function (data) {
            if (data && data.stream) {
                $("#stream-video-list-item-" + key).addClass('online');
                if (data.stream.viewers) {
                    $("#stream-video-list-item-" + key + " .stream-video-list-count").text(data.stream.viewers.toString());
                }
            } else {
                $("#stream-video-list-item-" + key).addClass('offline');
            }
        });
    });

})(jQuery, Drupal);