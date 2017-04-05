(function ($) {
    'use strict';
    console.log(_);

    var uniqueRooms = _.unique(rooms, 'id');
    var groups = new vis.DataSet(uniqueRooms);


    //Filter function
    $('.filter').click(function () {
        var day = $(this).attr('x-data');
        $('.filter').removeClass('active');

        timeline.setWindow(day, addDays(day, 1));

        $(this).addClass('active');
    });


    var data = new vis.DataSet(activities);
    var options = {
        zoomMin: 1000 * 60 * 60 * 4,
        zoomMax: 1000 * 60 * 60 * 24 * 3,
        rollingMode: false,
        hiddenDates: [{start: '2017-04-15 00:00:00', end: '2017-04-15 10:00:00', repeat: 'daily'}, {start: '2017-04-17 17:00:00', end: '2017-04-18 00:00:00'}],
        stack: false,
        groupOrder: function (a, b) {
            return a.value - b.value;
        },
        locale: 'fr',
	orientation: 'both',
    };

    var timeline = new vis.Timeline(document.getElementById('timeline'), data, options);
    timeline.setGroups(groups);

    timeline.on('select', function (properties) {
        activities.forEach(function (activity) {
            if (activity.id === properties.items[0]) {
                $('#activity-modal-label').text(activity.titleText);
                $('#activity-modal-content').html(activity.description);
                if (activity.url) {
                    $('#activity-modal-url').show();
                    $('#activity-modal-url a').attr('href', activity.url);
                }
                else {
                    $('#activity-modal-url').hide();
                }
                $('#activity-modal').modal();


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
