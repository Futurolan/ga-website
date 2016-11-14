(function ($) {
    'use strict';


    function stickyFooter() {
    	console.log($("body").height());
    	var footerH = $(".menu-footer").outerHeight();
    	$("body").css("margin-bottom", footerH+"px");
        /*var wrapper = document.getElementById('body');
        var push = document.getElementById('sticky-push');
        var footer = document.getElementById('sticky-footer');

        wrapper.style.margin = "0 auto -"+footer.offsetHeight+'px';
        push.style.height = footer.offsetHeight+'px';*/
    }

    stickyFooter();

	$( window ).resize(function() {
		stickyFooter();
	});
})(jQuery);