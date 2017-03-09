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
        $('.filter').removeClass('active');
        $(this).addClass('active');
        createTimeline(day);
    });


    //Timeline creation
    function createTimeline(day) {

        var min = addDays(day, 10);
        var max = addDays(day, -10)

        activityDay[day].forEach(function (activity) {
            if (activity.start < min)
                min = activity.start;
            if (activity.end > max)
                max = activity.end;
        });
        console.log(min);
        console.log(max);
        var data = new vis.DataSet(activityDay[day]);
        var options = {
            zoomMin: max.getTime()-min.getTime(),
            zoomMax: max.getTime()-min.getTime(),
            min: min,
            max: max
        };

        $('#timeline').empty();
        var timeline = new vis.Timeline(document.getElementById('timeline'), data, options);
        timeline.setWindow(new Date(day), addDays(day, 1), {animation: false});
        timeline.setGroups(groups);

        timeline.on('select', function (properties) {
            console.log(properties.items[0]);
            activityDay[day].forEach(function (activity) {
                if (activity.id === properties.items[0]) {
                    window.location = activity.url
                }
            })
        });
    }

    //Add a day to a date
    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

})(jQuery);