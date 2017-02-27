(function ($) {
    'use strict';

    var container = document.getElementById('timeline');

    console.log(activityDay);
    $('.filter').click(function () {
        day = $(this).attr('x-data');
        createTimeline(day);
    });


    var day = Object.keys(activityDay)[0];

    createTimeline(day);

    function createTimeline(day) {
        var data = new vis.DataSet(activityDay[day]);
        var options = {
            zoomMin: 1000 * 60 * 60 * 24,
            zoomMax: 1000 * 60 * 60 * 24,
            min: new Date(day),
            max: addDays(day, 1)
        };

        $('#timeline').empty();
        var timeline = new vis.Timeline(container, data, options);
        timeline.setWindow(new Date(day), addDays(day,1), {animation: false});

    }

    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

})(jQuery);