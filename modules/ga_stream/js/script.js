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

    $(".stream-block-video-list .stream-video-list-item").click(function () {
        var key = $(this).attr("x-key");
        $(".stream-block-video iframe").attr('src', "http://player.twitch.tv/?channel=" + key);
        $(".stream-video-list-item").removeClass('active');
        $("#stream-video-list-item-" + key).addClass('active');
    });

    $(".stream-tab-video-list").click(function(){
        $(".stream-block-video-list").show();
        $(".stream-block-chat").hide();
        $(".stream-tab-video-list").addClass("active");
        $(".stream-tab-chat").removeClass("active");
    });
    $(".stream-tab-chat").click(function(){
        $(".stream-block-video-list").hide();
        $(".stream-block-chat").show();
        $(".stream-tab-video-list").removeClass("active");
        $(".stream-tab-chat").addClass("active");
    });

})(jQuery, Drupal);