(function ($) {
    'use strict';

    $('.home-slider-container').loopslider({
        autoplay: true,
        visibleItems: 1,
        step: 1,
        slideDuration: 500, // Slide transition duration (in ms)
        autoplayInterval: 300000, // Delay between slides
        stopOnHover: true, // Stop slideshow on mouse over
        navigation: true, // prev and next buttons
        pagination: false,
        prevButton: '#home-slideshow-prev', // CSS selector for element used to populate the "Prev" control
        nextButton: '#home-slideshow-next' // CSS selector for element used to populate the "Next" control
    });

})(jQuery);