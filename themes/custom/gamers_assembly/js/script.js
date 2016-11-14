(function ($) {
    'use strict';


    function stickyFooter() {
    	var footerH = $(".menu-footer").outerHeight();
    	$("body").css("margin-bottom", footerH+"px");
    }

    stickyFooter();

    $(window).resize(function () {
        stickyFooter();
    });
})(jQuery);