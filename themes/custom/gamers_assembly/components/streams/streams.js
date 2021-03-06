(function ($) {
    'use strict';

    $(".stream-video-list .stream-video-list-item").each(function () {
        var key = $(this).attr("x-key");
        $.ajax({
            url: "https://api.twitch.tv/kraken/streams/" + key+"?client_id=3e1bo4w4sfblm61c8baoacmcxab9dq",
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
        $(".stream-video iframe").prop('src', "https://player.twitch.tv/?channel=" + key);
        $(".stream-chat iframe").prop('src', "https://www.twitch.tv/"+key+"/chat?darkpopout");
        $(".stream-video-list-item").removeClass('active');
        $("#stream-video-list-item-" + key).addClass('active');
    });

    $(".stream-tab-video-list").click(function () {
        $(".stream-chat").css({position:"absolute"});
        $(".stream-chat").css({top:-5000+"px"});
        $(".stream-video-list").css({position:"static"});
        $(".stream-tab-video-list").addClass("active");
        $(".stream-tab-chat").removeClass("active");
    });
    $(".stream-tab-chat").click(function () {
        $(".stream-video-list").css({position:"absolute"});
        $(".stream-video-list").css({top:-5000+"px"});
        $(".stream-chat").css({position:"static"});
        $(".stream-tab-video-list").removeClass("active");
        $(".stream-tab-chat").addClass("active");
    });

    $('.stream-video-more').click(function() {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('.stream-video-list-content').height('200px');
        } else {
            $(this).addClass('active');
            $('.stream-video-list-content').height('auto');
        }
    });

})(jQuery);
