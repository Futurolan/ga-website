(function ($) {
    'use strict';


    $('.filter').click(function () {

        activities = activities.slice(0, -1);
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
        dataTable.addRows(activities);

        chart.draw(dataTable);
    }

})(jQuery);