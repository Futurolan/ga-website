(function ($) {
    'use strict';

    $(".stream-video-list .stream-video-list-item").each(function () {
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

    $(".stream-video-list .stream-video-list-item").click(function () {
        var key = $(this).attr("x-key");
        $(".stream-video iframe").attr('src', "https://player.twitch.tv/?channel=" + key);
        $(".stream-video-list-item").removeClass('active');
        $("#stream-video-list-item-" + key).addClass('active');
    });

    $(".stream-tab-video-list").click(function () {
        $(".stream-video-list").show();
        $(".stream-chat").hide();
        $(".stream-tab-video-list").addClass("active");
        $(".stream-tab-chat").removeClass("active");
    });
    $(".stream-tab-chat").click(function () {
        $(".stream-video-list").hide();
        $(".stream-chat").show();
        $(".stream-tab-video-list").removeClass("active");
        $(".stream-tab-chat").addClass("active");
    });

})(jQuery);