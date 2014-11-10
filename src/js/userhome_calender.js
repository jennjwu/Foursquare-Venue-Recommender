/**
 * Created by Corn on 11/9/14.
 */

(function($){
    $(document).ready(function () {


            var v_names = $("#user-venue-results").find(".v_name");
            var u_dates = $("#user-venue-results").find(".u_date");
            var events =[];

            if(v_names.length != 0){
                console.log(v_names);
                console.log(u_dates);

                //build event data
                for(var i = 0; i< v_names.length; i++){
                    var name = $(v_names[i]).html();
                    var date = $(u_dates[i]).html();

                    var event = {title: name, start: date};
                    console.log(event);
                    events.push(event);
                }


                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'
                    },
                    defaultDate: events[0].start,
                    //editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: events
                });

            } else {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'
                    }
                });
            }




    });

})(jQuery);