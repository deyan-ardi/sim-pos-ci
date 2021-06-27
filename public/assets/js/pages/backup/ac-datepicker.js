'use strict';
$(document).ready(function() {
    // [ day-week ]
    $('#d_week').datepicker({
        daysOfWeekDisabled: "2"
    });
    // [ day-highlight ]
    $('#d_highlight').datepicker({
        daysOfWeekHighlighted: "1"
    });
    // [ day-auto ]
    $('#d_auto').datepicker({
        autoclose: true
    });
    // [ day-disable ]
    $('#d_disable').datepicker({
        datesDisabled: ['10/15/2018', '10/16/2018' ,  '10/17/2018' , '10/18/2018' ]
    });
    // [ day-toggle ]
    $('#d_toggle').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        toggleActive: true
    });
    // [ day-today ]
    $('#d_today').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        todayHighlight: true
    });
    // [ disp-week ]
    $('#disp_week').datepicker({
        calendarWeeks: true
    });
    // [ date-range ]
    $('#datepicker_range').datepicker({});
});
