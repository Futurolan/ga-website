(function ($) {
    'use strict';

    setNextActivities();
    function setNextActivities() {

        $.ajax({
            url: "/next_activities"
        }).done(function (data) {
            var str = '';
            $.each(data, function (index, activity) {
                str += '<tr>';
                str += '<td class="date">' + activity.field_date + '</td>';
                if(activity.field_lien && activity.field_lien != ''){
                    str += '<td class="title"><a href="'+activity.field_lien+'">'+ activity.title + '</a></td>';
                }else {
                    str += '<td class="title">' + activity.title + '</td>';
                }
                str += '<td class="room">' + activity.field_room + '</td>';
                str += '</tr>';
            });
            $('.tournaments-home-next table').html(str);
            setTimeout(setNextActivities,60000);
        });

    }
})(jQuery);
