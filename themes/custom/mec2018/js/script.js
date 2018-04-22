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

    $( "a[href='/ticket']" ).addClass("ticketing");
    $( "a[href='/pages/passbar']" ).addClass("ticketing");

})(jQuery);
