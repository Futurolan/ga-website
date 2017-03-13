(function ($) {
    'use strict';

    var uniqueRooms = _.unique(rooms,'id');
    var groups = new vis.DataSet(uniqueRooms);
    console.log(groups);


    //Filter function
    $('.filter').click(function () {
        var day = $(this).attr('x-data');
        $('.filter').removeClass('active');

        timeline.setWindow(day, addDays(day,1));

        $(this).addClass('active');
    });



    var data = new vis.DataSet(activities);
    var options = {
        zoomMin: 1000 * 60 * 60 * 4,
        zoomMax: 1000 * 60 * 60 * 24 * 3,
        rollingMode:false,
        hiddenDates: [{start: '2017-04-15 00:00:00', end: '2017-04-15 08:00:00', repeat: 'daily'}],
        stack: false,
        groupOrder: function (a, b) {
            return a.value - b.value;
        }
    };

    var timeline = new vis.Timeline(document.getElementById('timeline'), data, options);
    timeline.setGroups(groups);

    timeline.on('select', function (properties) {
        activities.forEach(function (activity) {
            if (activity.id === properties.items[0] && activity.url) {
                window.location = activity.url
            }
        })
    });

    $('.filter.active').click();

    //Add a day to a date
    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

})(jQuery);