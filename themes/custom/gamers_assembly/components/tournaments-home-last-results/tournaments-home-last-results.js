(function ($) {
    'use strict';

    setLastResults();
    function setLastResults() {

        $.ajax({
            url: "/toornament_last_results"
        }).done(function (data) {
            var str = '';
            $.each(data, function (index, result) {
                str += '<tr>';
                str += '<td class="date">' + result.created + '</td>';
                str += '<td class="game">'+result.field_game_short_name+'</td>';
                str += '<td class="participant participant-1">'+result.field_toornament_participant+'</td>';
                str += '<td class="'+(result.field_toornament_result>result.field_toornament_result2?'win':'loose')+'">'+result.field_toornament_result+'</td>';
                str += '<td class="'+(result.field_toornament_result<result.field_toornament_result2?'win':'loose')+'">'+result.field_toornament_result2+'</td>';
                str += '<td class="participant participant-2">'+result.field_toornament_participant2+'</td>';
                str += '</tr>';
            });
            $('.last-result table').html(str);
            setTimeout(setLastResults, 60000);
        });

    }
})(jQuery);
