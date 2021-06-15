'use strict';
$(document).ready(function() {
    // [ type-chart ] start
    $(function() {
       // Themes begin
       am4core.useTheme(am4themes_animated);
       // Themes end
       // Create chart instance
       var chart = am4core.create("type-chart", am4charts.PieChart);
       // Add data
       chart.data = [{
               "sector": "Desktop Computers",
               "size": 8
           },
           {
               "sector": "Smartphones",
               "size": 14.6
           },
           {
               "sector": "Tablets",
               "size": 22.5
           }
       ];
       // Add label
       chart.innerRadius = 35;

       // Add and configure Series
       var pieSeries = chart.series.push(new am4charts.PieSeries());
       pieSeries.dataFields.value = "size";
       pieSeries.dataFields.category = "sector";
       pieSeries.labels.template.disabled = true;
       pieSeries.ticks.template.disabled = true;
       pieSeries.colors.step = 3;
    });
    // [ type-chart ] end

    // [ rating ] start
    $('#example-1to10').barrating('show', {
       theme: 'bars-1to10',
       readonly: true,
       showSelectedRating: false
    });
    // [ rating ] end

    // [ new-scroll ] start
    var px = new PerfectScrollbar('.new-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ new-scroll ] end

    // [ user-scroll ] start
    var px = new PerfectScrollbar('.user-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ user-scroll ] end

});
