(function ($) {
    'use strict';


    var uniqueRooms = []
    $.each(rooms, function (i, el) {
        if ($.inArray(el, uniqueRooms) === -1) uniqueRooms.push(el);
    });

    var groups = new vis.DataSet();
    uniqueRooms.forEach(function (room) {
        groups.add({id: room, content: room})
    });

    //Init the timeline on first day
    var day = Object.keys(activityDay)[0];
    createTimeline(day);


    //Filter function
    $('.filter').click(function () {
        day = $(this).attr('x-data');
        createTimeline(day);
    });

    //Timeline creation
    function createTimeline(day) {
        var data = new vis.DataSet(activityDay[day]);
        var options = {
            zoomMin: 1000 * 60 * 60 * 24,
            zoomMax: 1000 * 60 * 60 * 24,
            min: new Date(day),
            max: addDays(day, 1)
        };

        $('#timeline').empty();
        var timeline = new vis.Timeline( document.getElementById('timeline'), data, options);
        timeline.setWindow(new Date(day), addDays(day, 1), {animation: false});
        timeline.setGroups(groups);

    }

    //Add a day to a date
    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

})(jQuery);