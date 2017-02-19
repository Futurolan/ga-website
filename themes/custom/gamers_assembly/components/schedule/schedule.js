(function ($) {
    'use strict';

console.log('ici');

console.log(test);
    google.charts.load('current', {'packages':['timeline']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var container = document.getElementById('timeline');
        var chart = new google.visualization.Timeline(container);
        var dataTable = new google.visualization.DataTable();

        dataTable.addColumn({ type: 'string', id: 'Salle' });
        dataTable.addColumn({ type: 'date', id: 'Start' });
        dataTable.addColumn({ type: 'date', id: 'End' });
        dataTable.addRows([
            [ 'Washington', new Date(1789, 3, 30), new Date(1797, 2, 4) ],
            [ 'Adams',      new Date(1797, 2, 4),  new Date(1801, 2, 4) ],
            [ 'Jefferson',  new Date(1801, 2, 4),  new Date(1809, 2, 4) ]]);

        chart.draw(dataTable);
    }

})(jQuery);