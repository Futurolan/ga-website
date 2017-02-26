(function ($) {
    'use strict';
    $(window).resize(function(){
        drawChart();
    });

    var day = 0;
    $('.filter').click(function () {
        day = $(this).attr('x-data');
        drawChart();
    });
    google.charts.load('current', {'packages': ['timeline']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var container = document.getElementById('timeline');
        var chart = new google.visualization.Timeline(container);
        var dataTable = new google.visualization.DataTable();

        dataTable.addColumn({type: 'string', id: 'Salle'});
        dataTable.addColumn({type: 'string', id: 'Nom'});

        dataTable.addColumn({type: 'date', id: 'Start'});
        dataTable.addColumn({type: 'date', id: 'End'});
        dataTable.addRows(activityDay[day]);

        chart.draw(dataTable);
    }
})(jQuery);