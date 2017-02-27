(function ($) {
    'use strict';


    var day = Object.keys(activityDay)[0];
    console.log(day);
    $('.filter').click(function () {
        day = $(this).attr('x-data');
    });
    var container = document.getElementById('timeline');

    // Configuration for the Timeline
    var options = {
        zoomMin: 1000 * 60 * 60 * 24,
        zoomMax: 1000 * 60 * 60 * 24,
        min: new Date(day),
        max: addDays(day,1)
    };
    // Create a Timeline
    var timeline = new vis.Timeline(container, activityDay[day], options);
    timeline.setWindow(new Date(day), addDays(day,1), {animation: false});


    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

})(jQuery);