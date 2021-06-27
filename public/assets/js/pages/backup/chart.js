'use strict';
$(document).ready(function() {
   setTimeout(function() {
       floatchart()
   }, 700);
   $(window).on('resize', function() {
       floatchart();
   });
   $('#mobile-collapse').on('click', function() {
       setTimeout(function() {
           floatchart();
       }, 700);
   });
});

function floatchart() {
   // [ transactions1 chart ] start
   $.plot($("#transactions1"), [{
       data: [
           [0, 20],
           [1, 15],
           [2, 10],
           [3, 15],
           [4, 25],
           [5, 30],
           [6, 20],
           [7, 25],
           [8, 10],
           [9, 35],
           [10, 30],
           [11, 25],
           [12, 20]
       ],
       color: "#19BCBF",
       bars: {
           show: true,
           lineWidth: 4,
           fill: true,
           fillColor: {
               colors: [{
                   opacity: 1
               }, {
                   opacity: 1
               }]
           },
           barWidth: 0.4,
           align: 'center',
           horizontal: false
       },
       points: {
           show: false,
           radius: 3,
           fill: true
       },
       curvedLines: {
           apply: false,
       }
   }], {
       series: {
           label: "",
           curvedLines: {
               active: true,
               nrSplinePoints: 0
           },
       },
       tooltip: {
           show: true,
           content: "x : %x | y : %y"
       },
       grid: {
           hoverable: true,
           borderWidth: 0,
           labelMargin: 0,
           axisMargin: 0,
           minBorderMargin: 0,
       },
       yaxis: {
           min: 0,
           max: 50,
           color: 'transparent',
           font: {
               size: 0,
           }
       },
       xaxis: {
           color: 'transparent',
           font: {
               size: 0,
           }
       }
   });
   // [ transactions1 chart ] end

   // [ transactions2 chart ] start
   $.plot($("#transactions2"), [{
       data: [
           [0, 10],
           [1, 15],
           [2, 35],
           [3, 30],
           [4, 40],
           [5, 35],
           [6, 30],
           [7, 25],
           [8, 10],
           [9, 40],
           [10, 35],
           [11, 30],
           [12, 20]
       ],
       color: "#FF425C",
       bars: {
           show: true,
           lineWidth: 4,
           fill: true,
           fillColor: {
               colors: [{
                   opacity: 1
               }, {
                   opacity: 1
               }]
           },
           barWidth: 0.4,
           align: 'center',
           horizontal: false
       },
       points: {
           show: false,
           radius: 3,
           fill: true
       },
       curvedLines: {
           apply: false,
       }
   }], {
       series: {
           label: "",
           curvedLines: {
               active: true,
               nrSplinePoints: 0
           },
       },
       tooltip: {
           show: true,
           content: "x : %x | y : %y"
       },
       grid: {
           hoverable: true,
           borderWidth: 0,
           labelMargin: 0,
           axisMargin: 0,
           minBorderMargin: 0,
       },
       yaxis: {
           min: 0,
           max: 50,
           color: 'transparent',
           font: {
               size: 0,
           }
       },
       xaxis: {
           color: 'transparent',
           font: {
               size: 0,
           }
       }
   });
   // [ transactions2 chart ] end
}
// =========================================================================
//                         new js
// =========================================================================
// [ Support tracker ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // create chart
   var chart = am4core.create("hd-complited-ticket", am4charts.GaugeChart);
   chart.innerRadius = am4core.percent(82);

   var axis = chart.xAxes.push(new am4charts.ValueAxis());
   axis.min = 0;
   axis.max = 100;
   axis.strictMinMax = true;
   axis.renderer.radius = am4core.percent(80);
   axis.renderer.inside = true;
   axis.renderer.line.strokeOpacity = 0;
   axis.renderer.ticks.template.strokeOpacity = 1;
   axis.renderer.ticks.template.length = 10;
   axis.renderer.grid.template.disabled = true;
   axis.renderer.labels.template.radius = 40;
   axis.renderer.labels.template.adapter.add("text", function(text) {
       return "";
   })

   var colorSet = new am4core.ColorSet();

   var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
   axis2.min = 0;
   axis2.max = 100;
   axis2.renderer.innerRadius = 10
   axis2.strictMinMax = true;
   axis2.renderer.labels.template.disabled = true;
   axis2.renderer.ticks.template.disabled = true;
   axis2.renderer.grid.template.disabled = true;

   var range0 = axis2.axisRanges.create();
   range0.value = 0;
   range0.endValue = 50;
   range0.axisFill.fillOpacity = 1;
   range0.axisFill.fill = '#19BCBF';

   var range1 = axis2.axisRanges.create();
   range1.value = 50;
   range1.endValue = 100;
   range1.axisFill.fillOpacity = 1;
   range1.axisFill.fill = '#eff3f6';


   var label = chart.radarContainer.createChild(am4core.Label);
   label.isMeasured = false;
   label.fontSize = 18;
   label.x = am4core.percent(50);
   label.y = am4core.percent(100);
   label.horizontalCenter = "middle";
   label.verticalCenter = "bottom";
   label.text = "50%";

   var label2 = chart.radarContainer.createChild(am4core.Label);
   label2.isMeasured = false;
   label2.fontSize = 12;
   label2.x = am4core.percent(50);
   label2.y = am4core.percent(100);
   label2.horizontalCenter = "middle";
   label2.align = "center";
   label2.verticalCenter = "top";
   label2.text = "Complited Ticket";

   var hand = chart.hands.push(new am4charts.ClockHand());
   hand.axis = axis2;
   hand.innerRadius = am4core.percent(20);
   hand.startWidth = 0;
   hand.pin.disabled = true;
   hand.value = 50;
   hand.disabled = true;

   hand.events.on("propertychanged", function(ev) {
       range0.endValue = ev.target.value;
       range1.value = ev.target.value;
       axis2.invalidate();
   });
   setInterval(() => {
       var value = Math.round(Math.random() * 100);
       label.text = value + "%";
       var animation = new am4core.Animation(hand, {
           property: "value",
           to: value
       }, 1000, am4core.ease.cubicOut).start();
   }, 2000);
   chart.padding(0, 0, 0, 0);
});
// [ Support tracker ] end

// [ storage-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end
   // Create chart instance
   var chart = am4core.create("storage-chart", am4charts.XYChart);
   // Add data
   chart.data = [{
       "date": "2012-03-01",
       "price": 180,
       "price1": 50
   }, {
       "date": "2012-03-02",
       "price": 252,
       "price1": 40
   }, {
       "date": "2012-03-03",
       "price": 185,
       "price1": 55
   }, {
       "date": "2012-03-04",
       "price": 110,
       "price1": 38
   }, {
       "date": "2012-03-05",
       "price": 158,
       "price1": 87
   }, {
       "date": "2012-03-06",
       "price": 200,
       "price1": 67
   }, {
       "date": "2012-03-07",
       "price": 187,
       "price1": 100
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   // dateAxis.renderer.minGridDistance = 0;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.inside = true;
   dateAxis.renderer.labels.template.fill = am4core.color("#463699");

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = true;
   valueAxis.renderer.minGridDistance = 0;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.tensionX = 0.77;
   series.strokeWidth = 3;
   series.fillOpacity = 0.1;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#19BCBF");
   series.stroke = am4core.color("#19BCBF");
   series.strokeWidth = 2;

   // Create series
   var series1 = chart.series.push(new am4charts.LineSeries());
   series1.dataFields.valueY = "price1";
   series1.dataFields.dateX = "date";
   series1.tensionX = 0.77;

   series1.strokeWidth = 3;
   series1.fillOpacity = 0.1;
   series1.tooltipText = "{valueY.value}";
   series1.fill = am4core.color("#463699");
   series1.stroke = am4core.color("#463699");
   series1.strokeWidth = 2;

   var bullet = series.bullets.push(new am4charts.CircleBullet());
   bullet.circle.fill = am4core.color("#fff");
   bullet.circle.strokeWidth = 3;

   var bullet1 = series1.bullets.push(new am4charts.CircleBullet());
   bullet1.circle.fill = am4core.color("#fff");
   bullet1.circle.strokeWidth = 3;

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.xAxis = dateAxis;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);
});
// [ storage-chart ] end

// [ time-user-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   var chart = am4core.create("time-user", am4charts.XYChart);
   chart.maskBullets = false;

   var xAxis = chart.xAxes.push(new am4charts.CategoryAxis());
   var yAxis = chart.yAxes.push(new am4charts.CategoryAxis());

   xAxis.dataFields.category = "weekday";
   yAxis.dataFields.category = "hour";

   xAxis.renderer.grid.template.disabled = true;
   xAxis.renderer.minGridDistance = 40;

   yAxis.renderer.grid.template.disabled = true;
   yAxis.renderer.inversed = true;
   yAxis.renderer.minGridDistance = 30;

   var series = chart.series.push(new am4charts.ColumnSeries());
   series.dataFields.categoryX = "weekday";
   series.dataFields.categoryY = "hour";
   series.dataFields.value = "value";
   series.sequencedInterpolation = true;
   series.defaultState.transitionDuration = 3000;

   var bgColor = new am4core.InterfaceColorSet().getFor("background");

   var columnTemplate = series.columns.template;
   columnTemplate.strokeWidth = 1;
   columnTemplate.strokeOpacity = 0.2;
   columnTemplate.stroke = bgColor;
   columnTemplate.tooltipText = "{weekday}, {hour}: {value.workingValue.formatNumber('#.')}";
   columnTemplate.width = am4core.percent(100);
   columnTemplate.height = am4core.percent(100);

   series.heatRules.push({
       target: series.columns.template,
       property: "fill",
       min: am4core.color("#ffffff"),
       max: am4core.color("#463699")
   });

   // heat legend
   var heatLegend = chart.bottomAxesContainer.createChild(am4charts.HeatLegend);
   heatLegend.width = am4core.percent(100);
   heatLegend.series = series;
   heatLegend.valueAxis.renderer.labels.template.fontSize = 9;
   heatLegend.valueAxis.renderer.minGridDistance = 30;

   // heat legend behavior
   series.columns.template.events.on("over", (event) => {
       handleHover(event.target);
   })

   series.columns.template.events.on("hit", (event) => {
       handleHover(event.target);
   })

   function handleHover(column) {
       if (!isNaN(column.dataItem.value)) {
           heatLegend.valueAxis.showTooltipAt(column.dataItem.value)
       } else {
           heatLegend.valueAxis.hideTooltip();
       }
   }

   series.columns.template.events.on("out", (event) => {
       heatLegend.valueAxis.hideTooltip();
   })

   chart.data = [{
           "hour": "12pm",
           "weekday": "Sun",
           "value": 2990
       },
       {
           "hour": "1am",
           "weekday": "Sun",
           "value": 2520
       },
       {
           "hour": "2am",
           "weekday": "Sun",
           "value": 2334
       },
       {
           "hour": "3am",
           "weekday": "Sun",
           "value": 2230
       },
       {
           "hour": "4am",
           "weekday": "Sun",
           "value": 2325
       },
       {
           "hour": "5am",
           "weekday": "Sun",
           "value": 2019
       },
       {
           "hour": "6am",
           "weekday": "Sun",
           "value": 2128
       },
       {
           "hour": "7am",
           "weekday": "Sun",
           "value": 2246
       },
       {
           "hour": "8am",
           "weekday": "Sun",
           "value": 2421
       },
       {
           "hour": "9am",
           "weekday": "Sun",
           "value": 2788
       },
       {
           "hour": "10am",
           "weekday": "Sun",
           "value": 2959
       },
       {
           "hour": "11am",
           "weekday": "Sun",
           "value": 3018
       },
       {
           "hour": "12am",
           "weekday": "Sun",
           "value": 3154
       },
       {
           "hour": "1pm",
           "weekday": "Sun",
           "value": 3172
       },
       {
           "hour": "2pm",
           "weekday": "Sun",
           "value": 3368
       },
       {
           "hour": "3pm",
           "weekday": "Sun",
           "value": 3464
       },
       {
           "hour": "4pm",
           "weekday": "Sun",
           "value": 3746
       },
       {
           "hour": "5pm",
           "weekday": "Sun",
           "value": 3656
       },
       {
           "hour": "6pm",
           "weekday": "Sun",
           "value": 3336
       },
       {
           "hour": "7pm",
           "weekday": "Sun",
           "value": 3292
       },
       {
           "hour": "8pm",
           "weekday": "Sun",
           "value": 3269
       },
       {
           "hour": "9pm",
           "weekday": "Sun",
           "value": 3300
       },
       {
           "hour": "10pm",
           "weekday": "Sun",
           "value": 3403
       },
       {
           "hour": "11pm",
           "weekday": "Sun",
           "value": 3323
       },
       {
           "hour": "12pm",
           "weekday": "Mon",
           "value": 3346
       },
       {
           "hour": "1am",
           "weekday": "Mon",
           "value": 2725
       },
       {
           "hour": "2am",
           "weekday": "Mon",
           "value": 3052
       },
       {
           "hour": "3am",
           "weekday": "Mon",
           "value": 3876
       },
       {
           "hour": "4am",
           "weekday": "Mon",
           "value": 4453
       },
       {
           "hour": "5am",
           "weekday": "Mon",
           "value": 3972
       },
       {
           "hour": "6am",
           "weekday": "Mon",
           "value": 4644
       },
       {
           "hour": "7am",
           "weekday": "Mon",
           "value": 5715
       },
       {
           "hour": "8am",
           "weekday": "Mon",
           "value": 7080
       },
       {
           "hour": "9am",
           "weekday": "Mon",
           "value": 8022
       },
       {
           "hour": "10am",
           "weekday": "Mon",
           "value": 8446
       },
       {
           "hour": "11am",
           "weekday": "Mon",
           "value": 9313
       },
       {
           "hour": "12am",
           "weekday": "Mon",
           "value": 9011
       },
       {
           "hour": "1pm",
           "weekday": "Mon",
           "value": 8508
       },
       {
           "hour": "2pm",
           "weekday": "Mon",
           "value": 8515
       },
       {
           "hour": "3pm",
           "weekday": "Mon",
           "value": 8399
       },
       {
           "hour": "4pm",
           "weekday": "Mon",
           "value": 8649
       },
       {
           "hour": "5pm",
           "weekday": "Mon",
           "value": 7869
       },
       {
           "hour": "6pm",
           "weekday": "Mon",
           "value": 6933
       },
       {
           "hour": "7pm",
           "weekday": "Mon",
           "value": 5969
       },
       {
           "hour": "8pm",
           "weekday": "Mon",
           "value": 5552
       },
       {
           "hour": "9pm",
           "weekday": "Mon",
           "value": 5434
       },
       {
           "hour": "10pm",
           "weekday": "Mon",
           "value": 5070
       },
       {
           "hour": "11pm",
           "weekday": "Mon",
           "value": 4851
       },
       {
           "hour": "12pm",
           "weekday": "Tue",
           "value": 4468
       },
       {
           "hour": "1am",
           "weekday": "Tue",
           "value": 3306
       },
       {
           "hour": "2am",
           "weekday": "Tue",
           "value": 3906
       },
       {
           "hour": "3am",
           "weekday": "Tue",
           "value": 4413
       },
       {
           "hour": "4am",
           "weekday": "Tue",
           "value": 4726
       },
       {
           "hour": "5am",
           "weekday": "Tue",
           "value": 4584
       },
       {
           "hour": "6am",
           "weekday": "Tue",
           "value": 5717
       },
       {
           "hour": "7am",
           "weekday": "Tue",
           "value": 6504
       },
       {
           "hour": "8am",
           "weekday": "Tue",
           "value": 8104
       },
       {
           "hour": "9am",
           "weekday": "Tue",
           "value": 8813
       },
       {
           "hour": "10am",
           "weekday": "Tue",
           "value": 9278
       },
       {
           "hour": "11am",
           "weekday": "Tue",
           "value": 10425
       },
       {
           "hour": "12am",
           "weekday": "Tue",
           "value": 10137
       },
       {
           "hour": "1pm",
           "weekday": "Tue",
           "value": 9290
       },
       {
           "hour": "2pm",
           "weekday": "Tue",
           "value": 9255
       },
       {
           "hour": "3pm",
           "weekday": "Tue",
           "value": 9614
       },
       {
           "hour": "4pm",
           "weekday": "Tue",
           "value": 9713
       },
       {
           "hour": "5pm",
           "weekday": "Tue",
           "value": 9667
       },
       {
           "hour": "6pm",
           "weekday": "Tue",
           "value": 8774
       },
       {
           "hour": "7pm",
           "weekday": "Tue",
           "value": 8649
       },
       {
           "hour": "8pm",
           "weekday": "Tue",
           "value": 9937
       },
       {
           "hour": "9pm",
           "weekday": "Tue",
           "value": 10286
       },
       {
           "hour": "10pm",
           "weekday": "Tue",
           "value": 9175
       },
       {
           "hour": "11pm",
           "weekday": "Tue",
           "value": 8581
       },
       {
           "hour": "12pm",
           "weekday": "Wed",
           "value": 8145
       },
       {
           "hour": "1am",
           "weekday": "Wed",
           "value": 7177
       },
       {
           "hour": "2am",
           "weekday": "Wed",
           "value": 5657
       },
       {
           "hour": "3am",
           "weekday": "Wed",
           "value": 6802
       },
       {
           "hour": "4am",
           "weekday": "Wed",
           "value": 8159
       },
       {
           "hour": "5am",
           "weekday": "Wed",
           "value": 8449
       },
       {
           "hour": "6am",
           "weekday": "Wed",
           "value": 9453
       },
       {
           "hour": "7am",
           "weekday": "Wed",
           "value": 9947
       },
       {
           "hour": "8am",
           "weekday": "Wed",
           "value": 11471
       },
       {
           "hour": "9am",
           "weekday": "Wed",
           "value": 12492
       },
       {
           "hour": "10am",
           "weekday": "Wed",
           "value": 9388
       },
       {
           "hour": "11am",
           "weekday": "Wed",
           "value": 9928
       },
       {
           "hour": "12am",
           "weekday": "Wed",
           "value": 9644
       },
       {
           "hour": "1pm",
           "weekday": "Wed",
           "value": 9034
       },
       {
           "hour": "2pm",
           "weekday": "Wed",
           "value": 8964
       },
       {
           "hour": "3pm",
           "weekday": "Wed",
           "value": 9069
       },
       {
           "hour": "4pm",
           "weekday": "Wed",
           "value": 8898
       },
       {
           "hour": "5pm",
           "weekday": "Wed",
           "value": 8322
       },
       {
           "hour": "6pm",
           "weekday": "Wed",
           "value": 6909
       },
       {
           "hour": "7pm",
           "weekday": "Wed",
           "value": 5810
       },
       {
           "hour": "8pm",
           "weekday": "Wed",
           "value": 5151
       },
       {
           "hour": "9pm",
           "weekday": "Wed",
           "value": 4911
       },
       {
           "hour": "10pm",
           "weekday": "Wed",
           "value": 4487
       },
       {
           "hour": "11pm",
           "weekday": "Wed",
           "value": 4118
       },
       {
           "hour": "12pm",
           "weekday": "Thu",
           "value": 3689
       },
       {
           "hour": "1am",
           "weekday": "Thu",
           "value": 3081
       },
       {
           "hour": "2am",
           "weekday": "Thu",
           "value": 6525
       },
       {
           "hour": "3am",
           "weekday": "Thu",
           "value": 6228
       },
       {
           "hour": "4am",
           "weekday": "Thu",
           "value": 6917
       },
       {
           "hour": "5am",
           "weekday": "Thu",
           "value": 6568
       },
       {
           "hour": "6am",
           "weekday": "Thu",
           "value": 6405
       },
       {
           "hour": "7am",
           "weekday": "Thu",
           "value": 8106
       },
       {
           "hour": "8am",
           "weekday": "Thu",
           "value": 8542
       },
       {
           "hour": "9am",
           "weekday": "Thu",
           "value": 8501
       },
       {
           "hour": "10am",
           "weekday": "Thu",
           "value": 8802
       },
       {
           "hour": "11am",
           "weekday": "Thu",
           "value": 9420
       },
       {
           "hour": "12am",
           "weekday": "Thu",
           "value": 8966
       },
       {
           "hour": "1pm",
           "weekday": "Thu",
           "value": 8135
       },
       {
           "hour": "2pm",
           "weekday": "Thu",
           "value": 8224
       },
       {
           "hour": "3pm",
           "weekday": "Thu",
           "value": 8387
       },
       {
           "hour": "4pm",
           "weekday": "Thu",
           "value": 8218
       },
       {
           "hour": "5pm",
           "weekday": "Thu",
           "value": 7641
       },
       {
           "hour": "6pm",
           "weekday": "Thu",
           "value": 6469
       },
       {
           "hour": "7pm",
           "weekday": "Thu",
           "value": 5441
       },
       {
           "hour": "8pm",
           "weekday": "Thu",
           "value": 4952
       },
       {
           "hour": "9pm",
           "weekday": "Thu",
           "value": 4643
       },
       {
           "hour": "10pm",
           "weekday": "Thu",
           "value": 4393
       },
       {
           "hour": "11pm",
           "weekday": "Thu",
           "value": 4017
       },
       {
           "hour": "12pm",
           "weekday": "Fri",
           "value": 4022
       },
       {
           "hour": "1am",
           "weekday": "Fri",
           "value": 3063
       },
       {
           "hour": "2am",
           "weekday": "Fri",
           "value": 3638
       },
       {
           "hour": "3am",
           "weekday": "Fri",
           "value": 3968
       },
       {
           "hour": "4am",
           "weekday": "Fri",
           "value": 4070
       },
       {
           "hour": "5am",
           "weekday": "Fri",
           "value": 4019
       },
       {
           "hour": "6am",
           "weekday": "Fri",
           "value": 4548
       },
       {
           "hour": "7am",
           "weekday": "Fri",
           "value": 5465
       },
       {
           "hour": "8am",
           "weekday": "Fri",
           "value": 6909
       },
       {
           "hour": "9am",
           "weekday": "Fri",
           "value": 7706
       },
       {
           "hour": "10am",
           "weekday": "Fri",
           "value": 7867
       },
       {
           "hour": "11am",
           "weekday": "Fri",
           "value": 8615
       },
       {
           "hour": "12am",
           "weekday": "Fri",
           "value": 8218
       },
       {
           "hour": "1pm",
           "weekday": "Fri",
           "value": 7604
       },
       {
           "hour": "2pm",
           "weekday": "Fri",
           "value": 7429
       },
       {
           "hour": "3pm",
           "weekday": "Fri",
           "value": 7488
       },
       {
           "hour": "4pm",
           "weekday": "Fri",
           "value": 7493
       },
       {
           "hour": "5pm",
           "weekday": "Fri",
           "value": 6998
       },
       {
           "hour": "6pm",
           "weekday": "Fri",
           "value": 5941
       },
       {
           "hour": "7pm",
           "weekday": "Fri",
           "value": 5068
       },
       {
           "hour": "8pm",
           "weekday": "Fri",
           "value": 4636
       },
       {
           "hour": "9pm",
           "weekday": "Fri",
           "value": 4241
       },
       {
           "hour": "10pm",
           "weekday": "Fri",
           "value": 3858
       },
       {
           "hour": "11pm",
           "weekday": "Fri",
           "value": 3833
       },
       {
           "hour": "12pm",
           "weekday": "Sat",
           "value": 3503
       },
       {
           "hour": "1am",
           "weekday": "Sat",
           "value": 2842
       },
       {
           "hour": "2am",
           "weekday": "Sat",
           "value": 2808
       },
       {
           "hour": "3am",
           "weekday": "Sat",
           "value": 2399
       },
       {
           "hour": "4am",
           "weekday": "Sat",
           "value": 2280
       },
       {
           "hour": "5am",
           "weekday": "Sat",
           "value": 2139
       },
       {
           "hour": "6am",
           "weekday": "Sat",
           "value": 2527
       },
       {
           "hour": "7am",
           "weekday": "Sat",
           "value": 2940
       },
       {
           "hour": "8am",
           "weekday": "Sat",
           "value": 3066
       },
       {
           "hour": "9am",
           "weekday": "Sat",
           "value": 3494
       },
       {
           "hour": "10am",
           "weekday": "Sat",
           "value": 3287
       },
       {
           "hour": "11am",
           "weekday": "Sat",
           "value": 3416
       },
       {
           "hour": "12am",
           "weekday": "Sat",
           "value": 3432
       },
       {
           "hour": "1pm",
           "weekday": "Sat",
           "value": 3523
       },
       {
           "hour": "2pm",
           "weekday": "Sat",
           "value": 3542
       },
       {
           "hour": "3pm",
           "weekday": "Sat",
           "value": 3347
       },
       {
           "hour": "4pm",
           "weekday": "Sat",
           "value": 3292
       },
       {
           "hour": "5pm",
           "weekday": "Sat",
           "value": 3416
       },
       {
           "hour": "6pm",
           "weekday": "Sat",
           "value": 3131
       },
       {
           "hour": "7pm",
           "weekday": "Sat",
           "value": 3057
       },
       {
           "hour": "8pm",
           "weekday": "Sat",
           "value": 3227
       },
       {
           "hour": "9pm",
           "weekday": "Sat",
           "value": 3060
       },
       {
           "hour": "10pm",
           "weekday": "Sat",
           "value": 2855
       },
       {
           "hour": "11pm",
           "weekday": "Sat",
           "value": 2625
       }
   ];
   chart.padding(0, 0, 0, 0);
});
// [ time-user-chart ] end

// [ peity-chart ] start
$(function() {
   $("span.pie_1").peity("pie", {
       fill: ["#19BCBF", "#eff3f6"]
   });
   $("span.pie_2").peity("pie", {
       fill: ["#eff3f6", "#19BCBF"]
   });
   $("span.pie_3").peity("pie", {
       fill: ["#eff3f6", "#19BCBF"]
   });
   $(".data-attributes").peity("donut");
});
// [ peity-chart ] end

// [ horizontal-bar-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   var chart = am4core.create("horizontal-bar-chart", am4charts.XYChart);

   chart.data = [{
       "city": "USA",
       "income": 23.5,
       "expenses": 18.1,
       "profit": 25.5,
   }, {
       "city": "India",
       "income": 26.2,
       "expenses": 22.8,
       "profit": 18.5,
   }, {
       "city": "China",
       "income": 29.1,
       "expenses": 23.9,
       "profit": 20.5,
   }, {
       "city": "Brazil",
       "income": 29.5,
       "expenses": 25.1,
       "profit": 19.1,
   }, {
       "city": "Africa",
       "income": 24.6,
       "expenses": 10,
       "profit": 0,
   }];

   //create category axis for years
   var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
   categoryAxis.dataFields.category = "city";
   categoryAxis.renderer.inversed = true;
   categoryAxis.renderer.grid.template.location = 0;
   categoryAxis.renderer.cellStartLocation = 0.15;
   categoryAxis.renderer.cellEndLocation = 0.85;
   categoryAxis.renderer.grid.template.strokeOpacity = 0;

   //create value axis for income and expenses
   var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
   valueAxis.renderer.grid.template.strokeOpacity = 0.1;

   //create columns
   var series = chart.series.push(new am4charts.ColumnSeries());
   series.dataFields.categoryY = "city";
   series.dataFields.valueX = "income";
   series.name = "Income";
   series.columns.template.height = am4core.percent(90);
   series.tooltipText = "Income in {categoryY}: {valueX.value}";
   series.columns.template.fill = am4core.color("#FF425C");
   series.columns.template.stroke = am4core.color("#FF425C");

   var series2 = chart.series.push(new am4charts.ColumnSeries());
   series2.dataFields.categoryY = "city";
   series2.dataFields.valueX = "expenses";
   series2.columns.template.height = am4core.percent(90);
   series2.name = "Expenses";
   series2.tooltipText = "Expenses in {categoryY}: {valueX.value}";
   series2.columns.template.fill = am4core.color("#19BCBF");
   series2.columns.template.stroke = am4core.color("#19BCBF");

   var series3 = chart.series.push(new am4charts.ColumnSeries());
   series3.dataFields.categoryY = "city";
   series3.dataFields.valueX = "profit";
   series3.columns.template.height = am4core.percent(90);
   series3.name = "Expenses";
   series3.tooltipText = "Expenses in {categoryY}: {valueX.value}";
   series3.columns.template.fill = am4core.color("#13bd8a");
   series3.columns.template.stroke = am4core.color("#13bd8a");

   //add chart cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.behavior = "zoomY";

   //add legend
   chart.legend = new am4charts.Legend();
   chart.legend.position = 'top';

   chart.padding(0, 0, 0, 0);
});
// [ horizontal-bar-chart ] end

// [ am-map-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create map instance
   var chart = am4core.create("am-map-chart", am4maps.MapChart);

   // Set projection
   chart.projection = new am4maps.projections.Mercator();

   var restoreContinents = function() {
       hideCountries();
       chart.goHome();
   };

   // Zoom control
   chart.zoomControl = new am4maps.ZoomControl();

   var homeButton = new am4core.Button();
   homeButton.events.on("hit", restoreContinents);

   homeButton.icon = new am4core.Sprite();
   homeButton.padding(7, 5, 7, 5);
   homeButton.width = 20;
   homeButton.icon.path = "M16,8 L14,8 L14,16 L10,16 L10,10 L6,10 L6,16 L2,16 L2,8 L0,8 L8,0 L16,8 Z M16,8";
   homeButton.marginBottom = 10;
   homeButton.parent = chart.zoomControl;
   homeButton.insertBefore(chart.zoomControl.plusButton);

   // Shared
   var hoverColorHex = "#463699";
   var hoverColor = am4core.color(hoverColorHex);
   var hideCountries = function() {
       countryTemplate.hide();
       labelContainer.hide();
   };

   // Continents
   var continentsSeries = chart.series.push(new am4maps.MapPolygonSeries());
   continentsSeries.geodata = am4geodata_continentsLow;
   continentsSeries.useGeodata = true;
   continentsSeries.exclude = ["antarctica"];

   var continentTemplate = continentsSeries.mapPolygons.template;
   continentTemplate.tooltipText = "{name}";
   continentTemplate.properties.fillOpacity = 0.8; // Reduce conflict with back to continents map label
   continentTemplate.propertyFields.fill = "color";
   continentTemplate.events.on("hit", function(event) {
       if (!countriesSeries.visible) countriesSeries.visible = true;
       chart.zoomToMapObject(event.target);
       countryTemplate.show();
       labelContainer.show();
   });

   var contintentHover = continentTemplate.states.create("hover");
   contintentHover.properties.fill = hoverColor;
   contintentHover.properties.stroke = hoverColor;

   continentsSeries.dataFields.zoomLevel = "zoomLevel";
   continentsSeries.dataFields.zoomGeoPoint = "zoomGeoPoint";

   continentsSeries.data = [{
       "id": "africa",
       "color": am4core.color("#19BCBF"),
   }, {
       "id": "asia",
       "zoomLevel": 2,
       "zoomGeoPoint": {
           "latitude": 46,
           "longitude": 89
       }
   }, {
       "id": "oceania",
       "color": am4core.color("#FF425C")
   }, {
       "id": "europe"
   }, {
       "id": "northAmerica",
       "color": am4core.color("#13bd8a"),
   }, {
       "id": "southAmerica"
   }];


   // Countries
   var countriesSeries = chart.series.push(new am4maps.MapPolygonSeries());
   var countries = countriesSeries.mapPolygons;
   countriesSeries.visible = false; // start off as hidden
   countriesSeries.exclude = ["AQ"];
   countriesSeries.geodata = am4geodata_worldLow;
   countriesSeries.useGeodata = true;
   // Hide each country so we can fade them in
   countriesSeries.events.once("inited", function() {
       hideCountries();
   });

   var countryTemplate = countries.template;
   countryTemplate.applyOnClones = true;
   countryTemplate.fill = am4core.color("#a791b4");
   countryTemplate.fillOpacity = 0.3; // see continents underneath, however, country shapes are more detailed than continents.
   countryTemplate.strokeOpacity = 0.3;
   countryTemplate.tooltipText = "{name}";
   countryTemplate.events.on("hit", function(event) {
       chart.zoomToMapObject(event.target);
   });

   var countryHover = countryTemplate.states.create("hover");
   countryHover.properties.fill = hoverColor;
   countryHover.properties.fillOpacity = 0.8; // Reduce conflict with back to continents map label
   countryHover.properties.stroke = hoverColor;
   countryHover.properties.strokeOpacity = 1;

   var labelContainer = chart.chartContainer.createChild(am4core.Container);
   labelContainer.hide();
   labelContainer.config = {
       cursorOverStyle: [{
           "property": "cursor",
           "value": "pointer"
       }]
   };
   labelContainer.isMeasured = false;
   labelContainer.layout = "horizontal";
   labelContainer.verticalCenter = "bottom";
   labelContainer.contentValign = "middle";
   labelContainer.y = am4core.percent(100);
   labelContainer.dx = 10;
   labelContainer.dy = -25;
   labelContainer.background.fill = "#fff";
   labelContainer.background.fillOpacity = 0; // Hack to ensure entire area of labelContainer, e.g. between icon path, is clickable
   labelContainer.setStateOnChildren = true;
   labelContainer.states.create("hover");
   labelContainer.events.on("hit", restoreContinents);

   var globeIcon = labelContainer.createChild(am4core.Sprite);
   globeIcon.valign = "bottom";
   globeIcon.verticalCenter = "bottom";
   globeIcon.width = 29;
   globeIcon.height = 29;
   globeIcon.marginRight = 7;
   globeIcon.path = "M16,1.466C7.973,1.466,1.466,7.973,1.466,16c0,8.027,6.507,14.534,14.534,14.534c8.027,0,14.534-6.507,14.534-14.534C30.534,7.973,24.027,1.466,16,1.466zM27.436,17.39c0.001,0.002,0.004,0.002,0.005,0.004c-0.022,0.187-0.054,0.37-0.085,0.554c-0.015-0.012-0.034-0.025-0.047-0.036c-0.103-0.09-0.254-0.128-0.318-0.115c-0.157,0.032,0.229,0.305,0.267,0.342c0.009,0.009,0.031,0.03,0.062,0.058c-1.029,5.312-5.709,9.338-11.319,9.338c-4.123,0-7.736-2.18-9.776-5.441c0.123-0.016,0.24-0.016,0.28-0.076c0.051-0.077,0.102-0.241,0.178-0.331c0.077-0.089,0.165-0.229,0.127-0.292c-0.039-0.064,0.101-0.344,0.088-0.419c-0.013-0.076-0.127-0.256,0.064-0.407s0.394-0.382,0.407-0.444c0.012-0.063,0.166-0.331,0.152-0.458c-0.012-0.127-0.152-0.28-0.24-0.318c-0.09-0.037-0.28-0.05-0.356-0.151c-0.077-0.103-0.292-0.203-0.368-0.178c-0.076,0.025-0.204,0.05-0.305-0.015c-0.102-0.062-0.267-0.139-0.33-0.189c-0.065-0.05-0.229-0.088-0.305-0.088c-0.077,0-0.065-0.052-0.178,0.101c-0.114,0.153,0,0.204-0.204,0.177c-0.204-0.023,0.025-0.036,0.141-0.189c0.113-0.152-0.013-0.242-0.141-0.203c-0.126,0.038-0.038,0.115-0.241,0.153c-0.203,0.036-0.203-0.09-0.076-0.115s0.355-0.139,0.355-0.19c0-0.051-0.025-0.191-0.127-0.191s-0.077-0.126-0.229-0.291c-0.092-0.101-0.196-0.164-0.299-0.204c-0.09-0.579-0.15-1.167-0.15-1.771c0-2.844,1.039-5.446,2.751-7.458c0.024-0.02,0.048-0.034,0.069-0.036c0.084-0.009,0.31-0.025,0.51-0.059c0.202-0.034,0.418-0.161,0.489-0.153c0.069,0.008,0.241,0.008,0.186-0.042C8.417,8.2,8.339,8.082,8.223,8.082S8.215,7.896,8.246,7.896c0.03,0,0.186,0.025,0.178,0.11C8.417,8.091,8.471,8.2,8.625,8.167c0.156-0.034,0.132-0.162,0.102-0.195C8.695,7.938,8.672,7.853,8.642,7.794c-0.031-0.06-0.023-0.136,0.14-0.153C8.944,7.625,9.168,7.708,9.16,7.573s0-0.28,0.046-0.356C9.253,7.142,9.354,7.09,9.299,7.065C9.246,7.04,9.176,7.099,9.121,6.972c-0.054-0.127,0.047-0.22,0.108-0.271c0.02-0.015,0.067-0.06,0.124-0.112C11.234,5.257,13.524,4.466,16,4.466c3.213,0,6.122,1.323,8.214,3.45c-0.008,0.022-0.01,0.052-0.031,0.056c-0.077,0.013-0.166,0.063-0.179-0.051c-0.013-0.114-0.013-0.331-0.102-0.203c-0.089,0.127-0.127,0.127-0.127,0.191c0,0.063,0.076,0.127,0.051,0.241C23.8,8.264,23.8,8.341,23.84,8.341c0.036,0,0.126-0.115,0.239-0.141c0.116-0.025,0.319-0.088,0.332,0.026c0.013,0.115,0.139,0.152,0.013,0.203c-0.128,0.051-0.267,0.026-0.293-0.051c-0.025-0.077-0.114-0.077-0.203-0.013c-0.088,0.063-0.279,0.292-0.279,0.292s-0.306,0.139-0.343,0.114c-0.04-0.025,0.101-0.165,0.203-0.228c0.102-0.064,0.178-0.204,0.14-0.242c-0.038-0.038-0.088-0.279-0.063-0.343c0.025-0.063,0.139-0.152,0.013-0.216c-0.127-0.063-0.217-0.14-0.318-0.178s-0.216,0.152-0.305,0.204c-0.089,0.051-0.076,0.114-0.191,0.127c-0.114,0.013-0.189,0.165,0,0.254c0.191,0.089,0.255,0.152,0.204,0.204c-0.051,0.051-0.267-0.025-0.267-0.025s-0.165-0.076-0.268-0.076c-0.101,0-0.229-0.063-0.33-0.076c-0.102-0.013-0.306-0.013-0.355,0.038c-0.051,0.051-0.179,0.203-0.28,0.152c-0.101-0.051-0.101-0.102-0.241-0.051c-0.14,0.051-0.279-0.038-0.355,0.038c-0.077,0.076-0.013,0.076-0.255,0c-0.241-0.076-0.189,0.051-0.419,0.089s-0.368-0.038-0.432,0.038c-0.064,0.077-0.153,0.217-0.19,0.127c-0.038-0.088,0.126-0.241,0.062-0.292c-0.062-0.051-0.33-0.025-0.367,0.013c-0.039,0.038-0.014,0.178,0.011,0.229c0.026,0.05,0.064,0.254-0.011,0.216c-0.077-0.038-0.064-0.166-0.141-0.152c-0.076,0.013-0.165,0.051-0.203,0.077c-0.038,0.025-0.191,0.025-0.229,0.076c-0.037,0.051,0.014,0.191-0.051,0.203c-0.063,0.013-0.114,0.064-0.254-0.025c-0.14-0.089-0.14-0.038-0.178-0.012c-0.038,0.025-0.216,0.127-0.229,0.012c-0.013-0.114,0.025-0.152-0.089-0.229c-0.115-0.076-0.026-0.076,0.127-0.025c0.152,0.05,0.343,0.075,0.622-0.013c0.28-0.089,0.395-0.127,0.28-0.178c-0.115-0.05-0.229-0.101-0.406-0.127c-0.179-0.025-0.42-0.025-0.7-0.127c-0.279-0.102-0.343-0.14-0.457-0.165c-0.115-0.026-0.813-0.14-1.132-0.089c-0.317,0.051-1.193,0.28-1.245,0.318s-0.128,0.19-0.292,0.318c-0.165,0.127-0.47,0.419-0.712,0.47c-0.241,0.051-0.521,0.254-0.521,0.305c0,0.051,0.101,0.242,0.076,0.28c-0.025,0.038,0.05,0.229,0.191,0.28c0.139,0.05,0.381,0.038,0.393-0.039c0.014-0.076,0.204-0.241,0.217-0.127c0.013,0.115,0.14,0.292,0.114,0.368c-0.025,0.077,0,0.153,0.09,0.14c0.088-0.012,0.559-0.114,0.559-0.114s0.153-0.064,0.127-0.166c-0.026-0.101,0.166-0.241,0.203-0.279c0.038-0.038,0.178-0.191,0.014-0.241c-0.167-0.051-0.293-0.064-0.115-0.216s0.292,0,0.521-0.229c0.229-0.229-0.051-0.292,0.191-0.305c0.241-0.013,0.496-0.025,0.444,0.051c-0.05,0.076-0.342,0.242-0.508,0.318c-0.166,0.077-0.14,0.216-0.076,0.292c0.063,0.076,0.09,0.254,0.204,0.229c0.113-0.025,0.254-0.114,0.38-0.101c0.128,0.012,0.383-0.013,0.42-0.013c0.039,0,0.216,0.178,0.114,0.203c-0.101,0.025-0.229,0.013-0.445,0.025c-0.215,0.013-0.456,0.013-0.456,0.051c0,0.039,0.292,0.127,0.19,0.191c-0.102,0.063-0.203-0.013-0.331-0.026c-0.127-0.012-0.203,0.166-0.241,0.267c-0.039,0.102,0.063,0.28-0.127,0.216c-0.191-0.063-0.331-0.063-0.381-0.038c-0.051,0.025-0.203,0.076-0.331,0.114c-0.126,0.038-0.076-0.063-0.242-0.063c-0.164,0-0.164,0-0.164,0l-0.103,0.013c0,0-0.101-0.063-0.114-0.165c-0.013-0.102,0.05-0.216-0.013-0.241c-0.064-0.026-0.292,0.012-0.33,0.088c-0.038,0.076-0.077,0.216-0.026,0.28c0.052,0.063,0.204,0.19,0.064,0.152c-0.14-0.038-0.317-0.051-0.419,0.026c-0.101,0.076-0.279,0.241-0.279,0.241s-0.318,0.025-0.318,0.102c0,0.077,0,0.178-0.114,0.191c-0.115,0.013-0.268,0.05-0.42,0.076c-0.153,0.025-0.139,0.088-0.317,0.102s-0.204,0.089-0.038,0.114c0.165,0.025,0.418,0.127,0.431,0.241c0.014,0.114-0.013,0.242-0.076,0.356c-0.043,0.079-0.305,0.026-0.458,0.026c-0.152,0-0.456-0.051-0.584,0c-0.127,0.051-0.102,0.305-0.064,0.419c0.039,0.114-0.012,0.178-0.063,0.216c-0.051,0.038-0.065,0.152,0,0.204c0.063,0.051,0.114,0.165,0.166,0.178c0.051,0.013,0.215-0.038,0.279,0.025c0.064,0.064,0.127,0.216,0.165,0.178c0.039-0.038,0.089-0.203,0.153-0.166c0.064,0.039,0.216-0.012,0.331-0.025s0.177-0.14,0.292-0.204c0.114-0.063,0.05-0.063,0.013-0.14c-0.038-0.076,0.114-0.165,0.204-0.254c0.088-0.089,0.253-0.013,0.292-0.115c0.038-0.102,0.051-0.279,0.151-0.267c0.103,0.013,0.243,0.076,0.331,0.076c0.089,0,0.279-0.14,0.332-0.165c0.05-0.025,0.241-0.013,0.267,0.102c0.025,0.114,0.241,0.254,0.292,0.279c0.051,0.025,0.381,0.127,0.433,0.165c0.05,0.038,0.126,0.153,0.152,0.254c0.025,0.102,0.114,0.102,0.128,0.013c0.012-0.089-0.065-0.254,0.025-0.242c0.088,0.013,0.191-0.026,0.191-0.026s-0.243-0.165-0.331-0.203c-0.088-0.038-0.255-0.114-0.331-0.241c-0.076-0.127-0.267-0.153-0.254-0.279c0.013-0.127,0.191-0.051,0.292,0.051c0.102,0.102,0.356,0.241,0.445,0.33c0.088,0.089,0.229,0.127,0.267,0.242c0.039,0.114,0.152,0.241,0.19,0.292c0.038,0.051,0.165,0.331,0.204,0.394c0.038,0.063,0.165-0.012,0.229-0.063c0.063-0.051,0.179-0.076,0.191-0.178c0.013-0.102-0.153-0.178-0.203-0.216c-0.051-0.038,0.127-0.076,0.191-0.127c0.063-0.05,0.177-0.14,0.228-0.063c0.051,0.077,0.026,0.381,0.051,0.432c0.025,0.051,0.279,0.127,0.331,0.191c0.05,0.063,0.267,0.089,0.304,0.051c0.039-0.038,0.242,0.026,0.294,0.038c0.049,0.013,0.202-0.025,0.304-0.05c0.103-0.025,0.204-0.102,0.191,0.063c-0.013,0.165-0.051,0.419-0.179,0.546c-0.127,0.127-0.076,0.191-0.202,0.191c-0.06,0-0.113,0-0.156,0.021c-0.041-0.065-0.098-0.117-0.175-0.097c-0.152,0.038-0.344,0.038-0.47,0.19c-0.128,0.153-0.178,0.165-0.204,0.114c-0.025-0.051,0.369-0.267,0.317-0.331c-0.05-0.063-0.355-0.038-0.521-0.038c-0.166,0-0.305-0.102-0.433-0.127c-0.126-0.025-0.292,0.127-0.418,0.254c-0.128,0.127-0.216,0.038-0.331,0.038c-0.115,0-0.331-0.165-0.331-0.165s-0.216-0.089-0.305-0.089c-0.088,0-0.267-0.165-0.318-0.165c-0.05,0-0.19-0.115-0.088-0.166c0.101-0.05,0.202,0.051,0.101-0.229c-0.101-0.279-0.33-0.216-0.419-0.178c-0.088,0.039-0.724,0.025-0.775,0.025c-0.051,0-0.419,0.127-0.533,0.178c-0.116,0.051-0.318,0.115-0.369,0.14c-0.051,0.025-0.318-0.051-0.433,0.013c-0.151,0.084-0.291,0.216-0.33,0.216c-0.038,0-0.153,0.089-0.229,0.28c-0.077,0.19,0.013,0.355-0.128,0.419c-0.139,0.063-0.394,0.204-0.495,0.305c-0.102,0.101-0.229,0.458-0.355,0.623c-0.127,0.165,0,0.317,0.025,0.419c0.025,0.101,0.114,0.292-0.025,0.471c-0.14,0.178-0.127,0.266-0.191,0.279c-0.063,0.013,0.063,0.063,0.088,0.19c0.025,0.128-0.114,0.255,0.128,0.369c0.241,0.113,0.355,0.217,0.418,0.367c0.064,0.153,0.382,0.407,0.382,0.407s0.229,0.205,0.344,0.293c0.114,0.089,0.152,0.038,0.177-0.05c0.025-0.09,0.178-0.104,0.355-0.104c0.178,0,0.305,0.04,0.483,0.014c0.178-0.025,0.356-0.141,0.42-0.166c0.063-0.025,0.279-0.164,0.443-0.063c0.166,0.103,0.141,0.241,0.23,0.332c0.088,0.088,0.24,0.037,0.355-0.051c0.114-0.09,0.064-0.052,0.203,0.025c0.14,0.075,0.204,0.151,0.077,0.267c-0.128,0.113-0.051,0.293-0.128,0.47c-0.076,0.178-0.063,0.203,0.077,0.278c0.14,0.076,0.394,0.548,0.47,0.638c0.077,0.088-0.025,0.342,0.064,0.495c0.089,0.151,0.178,0.254,0.077,0.331c-0.103,0.075-0.28,0.216-0.292,0.47s0.051,0.431,0.102,0.521s0.177,0.331,0.241,0.419c0.064,0.089,0.14,0.305,0.152,0.445c0.013,0.14-0.024,0.306,0.039,0.381c0.064,0.076,0.102,0.191,0.216,0.292c0.115,0.103,0.152,0.318,0.152,0.318s0.039,0.089,0.051,0.229c0.012,0.14,0.025,0.228,0.152,0.292c0.126,0.063,0.215,0.076,0.28,0.013c0.063-0.063,0.381-0.077,0.546-0.063c0.165,0.013,0.355-0.075,0.521-0.19s0.407-0.419,0.496-0.508c0.089-0.09,0.292-0.255,0.268-0.356c-0.025-0.101-0.077-0.203,0.024-0.254c0.102-0.052,0.344-0.152,0.356-0.229c0.013-0.077-0.09-0.395-0.115-0.457c-0.024-0.064,0.064-0.18,0.165-0.306c0.103-0.128,0.421-0.216,0.471-0.267c0.051-0.053,0.191-0.267,0.217-0.433c0.024-0.167-0.051-0.369,0-0.457c0.05-0.09,0.013-0.165-0.103-0.268c-0.114-0.102-0.089-0.407-0.127-0.457c-0.037-0.051-0.013-0.319,0.063-0.345c0.076-0.023,0.242-0.279,0.344-0.393c0.102-0.114,0.394-0.47,0.534-0.496c0.139-0.025,0.355-0.229,0.368-0.343c0.013-0.115,0.38-0.547,0.394-0.635c0.013-0.09,0.166-0.42,0.102-0.497c-0.062-0.076-0.559,0.115-0.622,0.141c-0.064,0.025-0.241,0.127-0.446,0.113c-0.202-0.013-0.114-0.177-0.127-0.254c-0.012-0.076-0.228-0.368-0.279-0.381c-0.051-0.012-0.203-0.166-0.267-0.317c-0.063-0.153-0.152-0.343-0.254-0.458c-0.102-0.114-0.165-0.38-0.268-0.559c-0.101-0.178-0.189-0.407-0.279-0.572c-0.021-0.041-0.045-0.079-0.067-0.117c0.118-0.029,0.289-0.082,0.31-0.009c0.024,0.088,0.165,0.279,0.19,0.419s0.165,0.089,0.178,0.216c0.014,0.128,0.14,0.433,0.19,0.47c0.052,0.038,0.28,0.242,0.318,0.318c0.038,0.076,0.089,0.178,0.127,0.369c0.038,0.19,0.076,0.444,0.179,0.482c0.102,0.038,0.444-0.064,0.508-0.102s0.482-0.242,0.635-0.255c0.153-0.012,0.179-0.115,0.368-0.152c0.191-0.038,0.331-0.177,0.458-0.28c0.127-0.101,0.28-0.355,0.33-0.444c0.052-0.088,0.179-0.152,0.115-0.253c-0.063-0.103-0.331-0.254-0.433-0.268c-0.102-0.012-0.089-0.178-0.152-0.178s-0.051,0.088-0.178,0.153c-0.127,0.063-0.255,0.19-0.344,0.165s0.026-0.089-0.113-0.203s-0.192-0.14-0.192-0.228c0-0.089-0.278-0.255-0.304-0.382c-0.026-0.127,0.19-0.305,0.254-0.19c0.063,0.114,0.115,0.292,0.279,0.368c0.165,0.076,0.318,0.204,0.395,0.229c0.076,0.025,0.267-0.14,0.33-0.114c0.063,0.024,0.191,0.253,0.306,0.292c0.113,0.038,0.495,0.051,0.559,0.051s0.33,0.013,0.381-0.063c0.051-0.076,0.089-0.076,0.153-0.076c0.062,0,0.177,0.229,0.267,0.254c0.089,0.025,0.254,0.013,0.241,0.179c-0.012,0.164,0.076,0.305,0.165,0.317c0.09,0.012,0.293-0.191,0.293-0.191s0,0.318-0.012,0.433c-0.014,0.113,0.139,0.534,0.139,0.534s0.19,0.393,0.241,0.482s0.267,0.355,0.267,0.47c0,0.115,0.025,0.293,0.103,0.293c0.076,0,0.152-0.203,0.24-0.331c0.091-0.126,0.116-0.305,0.153-0.432c0.038-0.127,0.038-0.356,0.038-0.444c0-0.09,0.075-0.166,0.255-0.242c0.178-0.076,0.304-0.292,0.456-0.407c0.153-0.115,0.141-0.305,0.446-0.305c0.305,0,0.278,0,0.355-0.077c0.076-0.076,0.151-0.127,0.19,0.013c0.038,0.14,0.254,0.343,0.292,0.394c0.038,0.052,0.114,0.191,0.103,0.344c-0.013,0.152,0.012,0.33,0.075,0.33s0.191-0.216,0.191-0.216s0.279-0.189,0.267,0.013c-0.014,0.203,0.025,0.419,0.025,0.545c0,0.053,0.042,0.135,0.088,0.21c-0.005,0.059-0.004,0.119-0.009,0.178C27.388,17.153,27.387,17.327,27.436,17.39zM20.382,12.064c0.076,0.05,0.102,0.127,0.152,0.203c0.052,0.076,0.14,0.05,0.203,0.114c0.063,0.064-0.178,0.14-0.075,0.216c0.101,0.077,0.151,0.381,0.165,0.458c0.013,0.076-0.279,0.114-0.369,0.102c-0.089-0.013-0.354-0.102-0.445-0.127c-0.089-0.026-0.139-0.343-0.025-0.331c0.116,0.013,0.141-0.025,0.267-0.139c0.128-0.115-0.189-0.166-0.278-0.191c-0.089-0.025-0.268-0.305-0.331-0.394c-0.062-0.089-0.014-0.228,0.141-0.331c0.076-0.051,0.279,0.063,0.381,0c0.101-0.063,0.203-0.14,0.241-0.165c0.039-0.025,0.293,0.038,0.33,0.114c0.039,0.076,0.191,0.191,0.141,0.229c-0.052,0.038-0.281,0.076-0.356,0c-0.075-0.077-0.255,0.012-0.268,0.152C20.242,12.115,20.307,12.013,20.382,12.064zM16.875,12.28c-0.077-0.025,0.025-0.178,0.102-0.229c0.075-0.051,0.164-0.178,0.241-0.305c0.076-0.127,0.178-0.14,0.241-0.127c0.063,0.013,0.203,0.241,0.241,0.318c0.038,0.076,0.165-0.026,0.217-0.051c0.05-0.025,0.127-0.102,0.14-0.165s0.127-0.102,0.254-0.102s0.013,0.102-0.076,0.127c-0.09,0.025-0.038,0.077,0.113,0.127c0.153,0.051,0.293,0.191,0.459,0.279c0.165,0.089,0.19,0.267,0.088,0.292c-0.101,0.025-0.406,0.051-0.521,0.038c-0.114-0.013-0.254-0.127-0.419-0.153c-0.165-0.025-0.369-0.013-0.433,0.077s-0.292,0.05-0.395,0.05c-0.102,0-0.228,0.127-0.253,0.077C16.875,12.534,16.951,12.306,16.875,12.28zM17.307,9.458c0.063-0.178,0.419,0.038,0.355,0.127C17.599,9.675,17.264,9.579,17.307,9.458zM17.802,18.584c0.063,0.102-0.14,0.431-0.254,0.407c-0.113-0.027-0.076-0.318-0.038-0.382C17.548,18.545,17.769,18.529,17.802,18.584zM13.189,12.674c0.025-0.051-0.039-0.153-0.127-0.013C13.032,12.71,13.164,12.725,13.189,12.674zM20.813,8.035c0.141,0.076,0.339,0.107,0.433,0.013c0.076-0.076,0.013-0.204-0.05-0.216c-0.064-0.013-0.104-0.115,0.062-0.203c0.165-0.089,0.343-0.204,0.534-0.229c0.19-0.025,0.622-0.038,0.774,0c0.152,0.039,0.382-0.166,0.445-0.254s-0.203-0.152-0.279-0.051c-0.077,0.102-0.444,0.076-0.521,0.051c-0.076-0.025-0.686,0.102-0.812,0.102c-0.128,0-0.179,0.152-0.356,0.229c-0.179,0.076-0.42,0.191-0.509,0.229c-0.088,0.038-0.177,0.19-0.101,0.216C20.509,7.947,20.674,7.959,20.813,8.035zM14.142,12.674c0.064-0.089-0.051-0.217-0.114-0.217c-0.12,0-0.178,0.191-0.103,0.254C14.002,12.776,14.078,12.763,14.142,12.674zM14.714,13.017c0.064,0.025,0.114,0.102,0.165,0.114c0.052,0.013,0.217,0,0.167-0.127s-0.167-0.127-0.204-0.127c-0.038,0-0.203-0.038-0.267,0C14.528,12.905,14.65,12.992,14.714,13.017zM11.308,10.958c0.101,0.013,0.217-0.063,0.305-0.101c0.088-0.038,0.216-0.114,0.216-0.229c0-0.114-0.025-0.216-0.077-0.267c-0.051-0.051-0.14-0.064-0.216-0.051c-0.115,0.02-0.127,0.14-0.203,0.14c-0.076,0-0.165,0.025-0.14,0.114s0.077,0.152,0,0.19C11.117,10.793,11.205,10.946,11.308,10.958zM11.931,10.412c0.127,0.051,0.394,0.102,0.292,0.153c-0.102,0.051-0.28,0.19-0.305,0.267s0.216,0.153,0.216,0.153s-0.077,0.089-0.013,0.114c0.063,0.025,0.102-0.089,0.203-0.089c0.101,0,0.304,0.063,0.406,0.063c0.103,0,0.267-0.14,0.254-0.229c-0.013-0.089-0.14-0.229-0.254-0.28c-0.113-0.051-0.241-0.28-0.317-0.331c-0.076-0.051,0.076-0.178-0.013-0.267c-0.09-0.089-0.153-0.076-0.255-0.14c-0.102-0.063-0.191,0.013-0.254,0.089c-0.063,0.076-0.14-0.013-0.217,0.012c-0.102,0.035-0.063,0.166-0.012,0.229C11.714,10.221,11.804,10.361,11.931,10.412zM24.729,17.198c-0.083,0.037-0.153,0.47,0,0.521c0.152,0.052,0.241-0.202,0.191-0.267C24.868,17.39,24.843,17.147,24.729,17.198zM20.114,20.464c-0.159-0.045-0.177,0.166-0.304,0.306c-0.128,0.141-0.267,0.254-0.317,0.241c-0.052-0.013-0.331,0.089-0.242,0.279c0.089,0.191,0.076,0.382-0.013,0.472c-0.089,0.088,0.076,0.342,0.052,0.482c-0.026,0.139,0.037,0.229,0.215,0.229s0.242-0.064,0.318-0.229c0.076-0.166,0.088-0.331,0.164-0.47c0.077-0.141,0.141-0.434,0.179-0.51c0.038-0.075,0.114-0.316,0.102-0.457C20.254,20.669,20.204,20.489,20.114,20.464zM10.391,8.802c-0.069-0.06-0.229-0.102-0.306-0.11c-0.076-0.008-0.152,0.06-0.321,0.06c-0.168,0-0.279,0.067-0.347,0C9.349,8.684,9.068,8.65,9.042,8.692C9.008,8.749,8.941,8.751,9.008,8.87c0.069,0.118,0.12,0.186,0.179,0.178s0.262-0.017,0.288,0.051C9.5,9.167,9.569,9.226,9.712,9.184c0.145-0.042,0.263-0.068,0.296-0.119c0.033-0.051,0.263-0.059,0.263-0.059S10.458,8.861,10.391,8.802z";

   var globeHover = globeIcon.states.create("hover");
   globeHover.properties.fill = hoverColor;

   var label = labelContainer.createChild(am4core.Label);
   label.valign = "bottom";
   label.verticalCenter = "bottom";
   label.dy = -5;
   label.text = "Back to continents map";
   label.states.create("hover").properties.fill = hoverColor;

   chart.padding(0, 0, 0, 0);
});
// [ am-map-chart ] end

// [ device-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end
   // Create chart instance
   var chart = am4core.create("device-chart", am4charts.PieChart);
   // Add data
   chart.data = [{
           "sector": "Mobile",
           "size": 14.6
       },
       {
           "sector": "Tablet",
           "size": 9.3
       },
       {
           "sector": "Desktop",
           "size": 22.5
       }
   ];
   // Add label
   chart.innerRadius = 30;

   // Add and configure Series
   var pieSeries = chart.series.push(new am4charts.PieSeries());
   pieSeries.dataFields.value = "size";
   pieSeries.dataFields.category = "sector";
   pieSeries.labels.template.disabled = true;
   pieSeries.ticks.template.disabled = true;
   pieSeries.colors.step = 2;
});
// [ device-chart ] end

// [ customer-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end
   // Create chart instance
   var chart = am4core.create("customer-chart", am4charts.PieChart);
   // Add data
   chart.data = [{
           "sector": "New",
           "size": 8
       },
       {
           "sector": "Custom",
           "size": 14.6
       },
       {
           "sector": "Return",
           "size": 22.5
       }
   ];
   // Add label
   chart.innerRadius = 95;

   // Add and configure Series
   var pieSeries = chart.series.push(new am4charts.PieSeries());
   pieSeries.dataFields.value = "size";
   pieSeries.dataFields.category = "sector";
   pieSeries.labels.template.disabled = true;
   pieSeries.ticks.template.disabled = true;
   pieSeries.colors.step = 4;
});
// [ customer-chart ] end

// [ chart-percent ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end
   // Create chart instance
   var chart = am4core.create("chart-percent", am4charts.PieChart);
   // Add data
   chart.data = [{
           "sector": "Mobile",
           "size": 14.6
       },
       {
           "sector": "Tablet",
           "size": 9.3
       },
       {
           "sector": "Desktop",
           "size": 22.5
       }
   ];
   // Add label
   chart.innerRadius = 30;

   // Add and configure Series
   var pieSeries = chart.series.push(new am4charts.PieSeries());
   pieSeries.dataFields.value = "size";
   pieSeries.dataFields.category = "sector";
   pieSeries.labels.template.disabled = true;
   pieSeries.ticks.template.disabled = true;
   pieSeries.colors.step = 3;
});
// [ chart-percent ] end

// [ sale-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("sale-chart", am4charts.XYChart);

   chart.data = [{
       "city": "1",
       "income": 23.5,
   }, {
       "city": "2",
       "income": 26.2,
   }, {
       "city": "3",
       "income": 28.1,
   }, {
       "city": "4",
       "income": 28.9,
   }, {
       "city": "5",
       "income": 24.6,
   }, {
       "city": "6",
       "income": 25.2,
   }, {
       "city": "7",
       "income": 28.1,
   }, {
       "city": "8",
       "income": 29.5,
   }, {
       "city": "9",
       "income": 24.6,
   }, {
       "city": "10",
       "income": 26.2,
   }, {
       "city": "11",
       "income": 29.1,
   }, {
       "city": "12",
       "income": 29.5,
   }, {
       "city": "13",
       "income": 24.6,
   }, {
       "city": "14",
       "income": 26.2,
   }, {
       "city": "15",
       "income": 29.1,
   }, {
       "city": "15",
       "income": 29.5,
   }, {
       "city": "17",
       "income": 24.6,
   }];

   //create category axis for years
   var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
   categoryAxis.dataFields.category = "city";
   categoryAxis.renderer.grid.template.location = 0;
   categoryAxis.renderer.cellStartLocation = 0.15;
   categoryAxis.renderer.cellEndLocation = 0.85;
   categoryAxis.renderer.grid.template.strokeOpacity = 0;
   categoryAxis.renderer.inside = true;
   categoryAxis.renderer.labels.template.disabled = true;

   //create value axis for income and expenses
   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.renderer.grid.template.strokeOpacity = 0;
   valueAxis.renderer.grid.template.strokeOpacity = 0;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   //create columns
   var series = chart.series.push(new am4charts.ColumnSeries());
   series.dataFields.valueY = "income";
   series.dataFields.categoryX = "city";
   series.columns.template.height = am4core.percent(90);
   series.tooltipText = "Income in : {valueY.value}";
   series.columns.template.fill = am4core.color("#19BCBF");
   series.columns.template.stroke = am4core.color("#19BCBF");

   //add chart cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.behavior = "zoomY";
   chart.padding(0, 0, 0, 0);
});
// [ sale-chart ] end

// [ market-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("market-chart", am4charts.XYChart);

   chart.data = [{
       "city": "1",
       "facebook": 23.5,
       "twitter": 40.5,
       "youtube": 23.5,
   }, {
       "city": "2",
       "facebook": 26.2,
       "twitter": 46.5,
       "youtube": 26.2,
   }, {
       "city": "3",
       "facebook": 28.1,
       "twitter": 48.5,
       "youtube": 28.1,
   }, {
       "city": "4",
       "facebook": 28.9,
       "twitter": 42.5,
       "youtube": 28.9,
   }, {
       "city": "5",
       "facebook": 24.6,
       "twitter": 52.5,
       "youtube": 28.9,
   }, {
       "city": "6",
       "facebook": 25.2,
       "twitter": 19.5,
       "youtube": 25.2,
   }, {
       "city": "7",
       "facebook": 28.1,
       "twitter": 22.5,
       "youtube": 28.1,
   }, {
       "city": "8",
       "facebook": 29.5,
       "twitter": 44.5,
       "youtube": 29.5,
   }, {
       "city": "9",
       "facebook": 24.6,
       "twitter": 35.5,
       "youtube": 24.6,
   }, {
       "city": "10",
       "facebook": 26.2,
       "twitter": 42.5,
       "youtube": 26.2,
   }, {
       "city": "11",
       "facebook": 29.1,
       "twitter": 44.5,
       "youtube": 29.1,
   }, {
       "city": "12",
       "facebook": 29.5,
       "twitter": 40.5,
       "youtube": 29.5,
   }, {
       "city": "13",
       "facebook": 24.6,
       "twitter": 53.5,
       "youtube": 24.6,
   }, {
       "city": "14",
       "facebook": 26.2,
       "twitter": 45.5,
       "youtube": 26.2,
   }, {
       "city": "15",
       "facebook": 29.1,
       "twitter": 30.5,
       "youtube": 29.1,
   }, {
       "city": "16",
       "facebook": 29.5,
       "twitter": 43.5,
       "youtube": 29.5,
   }, {
       "city": "17",
       "facebook": 24.6,
       "twitter": 48.5,
       "youtube": 24.6,
   }];

   //create category axis for years
   var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
   categoryAxis.dataFields.category = "city";
   categoryAxis.renderer.grid.template.location = 0;
   categoryAxis.renderer.cellStartLocation = 0.15;
   categoryAxis.renderer.cellEndLocation = 0.85;
   categoryAxis.renderer.grid.template.strokeOpacity = 0;
   categoryAxis.renderer.inside = true;
   categoryAxis.renderer.labels.template.disabled = true;

   //create value axis for income and expenses
   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.renderer.grid.template.strokeOpacity = 0;
   valueAxis.renderer.grid.template.strokeOpacity = 0;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   //create columns
   var series = chart.series.push(new am4charts.ColumnSeries());
   series.dataFields.valueY = "youtube";
   series.dataFields.categoryX = "city";
   series.columns.template.height = am4core.percent(90);
   series.tooltipText = "youtube : {valueY.value}";
   series.columns.template.fill = am4core.color("#FF425C");
   series.columns.template.stroke = am4core.color("#FF425C");
   series.columns.template.column.fillOpacity = 1;
   series.columns.template.column.strokeOpacity = 1;
   series.stacked = true;

   var series = chart.series.push(new am4charts.ColumnSeries());
   series.dataFields.valueY = "facebook";
   series.dataFields.categoryX = "city";
   series.columns.template.height = am4core.percent(90);
   series.tooltipText = "facebook : {valueY.value}";
   series.columns.template.fill = am4core.color("#463699");
   series.columns.template.stroke = am4core.color("#463699");
   series.stacked = true;

   var series = chart.series.push(new am4charts.ColumnSeries());
   series.dataFields.valueY = "twitter";
   series.dataFields.categoryX = "city";
   series.columns.template.height = am4core.percent(90);
   series.tooltipText = "twitter : {valueY.value}";
   series.columns.template.fill = am4core.color("#19BCBF");
   series.columns.template.stroke = am4core.color("#19BCBF");
   series.columns.template.column.fillOpacity = 1;
   series.columns.template.column.strokeOpacity = 1;
   series.stacked = true;

   //add chart cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.behavior = "zoomY";
   chart.padding(0, 0, 0, 0);
});
// [ market-chart ] end

// [ view-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("view-chart", am4charts.XYChart);
   // Add data
   chart.data = [{
       "date": "2018-01-1",
       "price": 180
   }, {
       "date": "2018-01-2",
       "price": 252
   }, {
       "date": "2018-01-3",
       "price": 185
   }, {
       "date": "2018-01-4",
       "price": 189
   }, {
       "date": "2018-01-5",
       "price": 158
   }, {
       "date": "2018-01-6",
       "price": 200
   }, {
       "date": "2018-01-7",
       "price": 187
   }, {
       "date": "2018-01-8",
       "price": 180
   }, {
       "date": "2018-01-9",
       "price": 252
   }, {
       "date": "2018-01-10",
       "price": 185
   }, {
       "date": "2018-01-11",
       "price": 268
   }, {
       "date": "2018-01-12",
       "price": 158
   }, {
       "date": "2018-01-13",
       "price": 200
   }, {
       "date": "2018-01-14",
       "price": 187
   }, {
       "date": "2018-01-15",
       "price": 180
   }, {
       "date": "2018-01-16",
       "price": 252
   }, {
       "date": "2018-01-17",
       "price": 185
   }, {
       "date": "2018-01-18",
       "price": 250
   }, {
       "date": "2018-01-19",
       "price": 158
   }, {
       "date": "2018-01-20",
       "price": 200
   }, {
       "date": "2018-01-21",
       "price": 187
   }, {
       "date": "2018-01-22",
       "price": 180
   }, {
       "date": "2018-01-23",
       "price": 252
   }, {
       "date": "2018-01-24",
       "price": 185
   }, {
       "date": "2018-01-25",
       "price": 295
   }, {
       "date": "2018-01-26",
       "price": 158
   }, {
       "date": "2018-01-27",
       "price": 200
   }, {
       "date": "2018-01-28",
       "price": 90
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = false;
   valueAxis.renderer.minGridDistance = 1;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.fillOpacity = 0.1;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#FF425C");
   series.stroke = am4core.color("#FF425C");
   series.strokeWidth = 3;

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);
});
// [ view-chart ] end

// [ view-chart1 ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("view-chart1", am4charts.XYChart);
   // Add data
   chart.data = [{
       "date": "2018-01-6",
       "price": 190
   }, {
       "date": "2018-01-7",
       "price": 158
   }, {
       "date": "2018-01-8",
       "price": 200
   }, {
       "date": "2018-01-9",
       "price": 90
   }, {
       "date": "2018-01-10",
       "price": 175
   }, {
       "date": "2018-01-11",
       "price": 228
   }, {
       "date": "2018-01-12",
       "price": 168
   }, {
       "date": "2018-01-13",
       "price": 200
   }, {
       "date": "2018-01-14",
       "price": 187
   }, {
       "date": "2018-01-15",
       "price": 243
   }, {
       "date": "2018-01-16",
       "price": 222
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = false;
   valueAxis.renderer.minGridDistance = 1;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.fillOpacity = 0.1;
   series.tensionX = 0.8;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#463699");
   series.stroke = am4core.color("#463699");
   series.strokeWidth = 3;

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);
});
// [ view-chart1 ] start

// [ time-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("time-chart", am4charts.XYChart);
   // Add data
   chart.data = [{
       "date": "2018-01-11",
       "price": 110
   }, {
       "date": "2018-01-12",
       "price": 128
   }, {
       "date": "2018-01-13",
       "price": 135
   }, {
       "date": "2018-01-14",
       "price": 187
   }, {
       "date": "2018-01-15",
       "price": 180
   }, {
       "date": "2018-01-16",
       "price": 222
   }, {
       "date": "2018-01-17",
       "price": 185
   }, {
       "date": "2018-01-18",
       "price": 195
   }, {
       "date": "2018-01-19",
       "price": 158
   }, {
       "date": "2018-01-20",
       "price": 200
   }, {
       "date": "2018-01-21",
       "price": 187
   }, {
       "date": "2018-01-22",
       "price": 180
   }, {
       "date": "2018-01-23",
       "price": 252
   }, {
       "date": "2018-01-24",
       "price": 233
   }, {
       "date": "2018-01-25",
       "price": 200
   }, {
       "date": "2018-01-26",
       "price": 280
   }, {
       "date": "2018-01-27",
       "price": 250
   }, {
       "date": "2018-01-28",
       "price": 300
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   // valueAxis.logarithmic = true;
   valueAxis.renderer.minGridDistance = 50;
   valueAxis.renderer.inside = true;
   // valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.fillOpacity = 0;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#13bd8a");
   series.stroke = am4core.color("#13bd8a");
   series.strokeWidth = 3;

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(5, 0, 0, 0);
});
// [ time-chart ] end

// [ revenue-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("revenue-chart", am4charts.PieChart);

   // Add data
   chart.data = [{
       "sector": "New",
       "size": 8
   }, {
       "sector": "Referral",
       "size": 14.6
   }];

   // Add and configure Series
   var pieSeries = chart.series.push(new am4charts.PieSeries());
   pieSeries.dataFields.value = "size";
   pieSeries.dataFields.category = "sector";
   pieSeries.labels.template.disabled = true;
   pieSeries.ticks.template.disabled = true;
   pieSeries.colors.step = 2;
   // Add label
   chart.innerRadius = 85;
   var label = chart.seriesContainer.createChild(am4core.Label);
   label.text = "55";
   label.horizontalCenter = "middle";
   label.verticalCenter = "middle";
   label.fontSize = 50;
});
// [ revenue-chart ] end

// [ traffic-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end
   var chart = am4core.create("traffic-chart", am4charts.XYChart);
   chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

   chart.data = [{
       "date": "2018-01-01",
       "steps": 4561
   }, {
       "date": "2018-01-02",
       "steps": 5687
   }, {
       "date": "2018-01-03",
       "steps": 6348
   }, {
       "date": "2018-01-04",
       "steps": 4878
   }, {
       "date": "2018-01-05",
       "steps": 9867
   }, {
       "date": "2018-01-06",
       "steps": 7561
   }, {
       "date": "2018-01-07",
       "steps": 1287
   }, {
       "date": "2018-01-08",
       "steps": 3298
   }, {
       "date": "2018-01-09",
       "steps": 5697
   }, {
       "date": "2018-01-10",
       "steps": 4878
   }, {
       "date": "2018-01-11",
       "steps": 8788
   }, {
       "date": "2018-01-12",
       "steps": 9560
   }, {
       "date": "2018-01-13",
       "steps": 11687
   }, {
       "date": "2018-01-14",
       "steps": 5878
   }, {
       "date": "2018-01-15",
       "steps": 9789
   }, {
       "date": "2018-01-16",
       "steps": 3987
   }, {
       "date": "2018-01-17",
       "steps": 5898
   }, {
       "date": "2018-01-18",
       "steps": 9878
   }, {
       "date": "2018-01-19",
       "steps": 13687
   }, {
       "date": "2018-01-20",
       "steps": 6789
   }, {
       "date": "2018-01-21",
       "steps": 4531
   }, {
       "date": "2018-01-22",
       "steps": 5856
   }, {
       "date": "2018-01-23",
       "steps": 5737
   }, {
       "date": "2018-01-24",
       "steps": 9987
   }, {
       "date": "2018-01-25",
       "steps": 16457
   }, {
       "date": "2018-01-26",
       "steps": 7878
   }, {
       "date": "2018-01-27",
       "steps": 6845
   }, {
       "date": "2018-01-28",
       "steps": 4659
   }, {
       "date": "2018-01-29",
       "steps": 7892
   }, {
       "date": "2018-01-30",
       "steps": 7362
   }, {
       "date": "2018-01-31",
       "steps": 3268
   }, {
       "date": "2018-02-01",
       "steps": 4561
   }, {
       "date": "2018-02-02",
       "steps": 5687
   }, {
       "date": "2018-02-03",
       "steps": 6348
   }, {
       "date": "2018-02-04",
       "steps": 4878
   }, {
       "date": "2018-02-05",
       "steps": 9867
   }, {
       "date": "2018-02-06",
       "steps": 7561
   }, {
       "date": "2018-02-07",
       "steps": 1287
   }, {
       "date": "2018-02-08",
       "steps": 3298
   }, {
       "date": "2018-02-09",
       "steps": 5697
   }, {
       "date": "2018-02-10",
       "steps": 4878
   }, {
       "date": "2018-02-11",
       "steps": 8788
   }, {
       "date": "2018-02-12",
       "steps": 9560
   }, {
       "date": "2018-02-13",
       "steps": 11687
   }, {
       "date": "2018-02-14",
       "steps": 5878
   }, {
       "date": "2018-02-15",
       "steps": 9789
   }, {
       "date": "2018-02-16",
       "steps": 3987
   }, {
       "date": "2018-02-17",
       "steps": 5898
   }, {
       "date": "2018-02-18",
       "steps": 9878
   }, {
       "date": "2018-02-19",
       "steps": 13687
   }, {
       "date": "2018-02-20",
       "steps": 6789
   }, {
       "date": "2018-02-21",
       "steps": 4531
   }, {
       "date": "2018-02-22",
       "steps": 5856
   }, {
       "date": "2018-02-23",
       "steps": 5737
   }, {
       "date": "2018-02-24",
       "steps": 9987
   }, {
       "date": "2018-02-25",
       "steps": 16457
   }, {
       "date": "2018-02-26",
       "steps": 7878
   }, {
       "date": "2018-02-27",
       "steps": 6845
   }, {
       "date": "2018-02-28",
       "steps": 4659
   }];

   chart.dateFormatter.inputDateFormat = "YYYY-MM-dd";
   chart.zoomOutButton.disabled = true;

   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.strokeOpacity = 0;
   dateAxis.renderer.minGridDistance = 10;
   dateAxis.dateFormats.setKey("day", "d");
   dateAxis.tooltip.hiddenState.properties.opacity = 1;
   dateAxis.tooltip.hiddenState.properties.visible = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.fillOpacity = 0.3;
   valueAxis.renderer.grid.template.strokeOpacity = 0;
   valueAxis.min = 0;

   // goal guides
   var axisRange = valueAxis.axisRanges.create();
   axisRange.value = 6000;
   axisRange.grid.strokeOpacity = 0.1;
   axisRange.label.text = "Session";
   axisRange.label.align = "right";
   axisRange.label.verticalCenter = "bottom";
   axisRange.label.fillOpacity = 0.8;

   valueAxis.renderer.gridContainer.zIndex = 1;

   var axisRange2 = valueAxis.axisRanges.create();
   axisRange2.value = 12000;
   axisRange2.grid.strokeOpacity = 0.1;
   axisRange2.label.text = "2x Session";
   axisRange2.label.align = "right";
   axisRange2.label.verticalCenter = "bottom";
   axisRange2.label.fillOpacity = 0.8;

   var series = chart.series.push(new am4charts.ColumnSeries);
   series.dataFields.valueY = "steps";
   series.dataFields.dateX = "date";
   series.tooltipText = "{valueY.value}";

   var columnTemplate = series.columns.template;
   columnTemplate.width = am4core.percent(50);
   columnTemplate.strokeOpacity = 0;


   var gradient = new am4core.LinearGradient();
   gradient.addColor(am4core.color("#19BCBF"), 1);
   gradient.addColor(am4core.color("#149698"), 1);
   gradient.rotation = -45;

   var gradient1 = new am4core.LinearGradient();
   gradient1.addColor(am4core.color("#13bd8a"), 1);
   gradient1.addColor(am4core.color("#30a262"), 1);
   gradient1.rotation = -45;


   columnTemplate.adapter.add("fill", function(fill, target) {
       var dataItem = target.dataItem;
       if (dataItem.valueY > 6000) {
           return gradient;
       } else {
           return gradient1;
       }
   })

   var cursor = new am4charts.XYCursor();
   cursor.behavior = "panX";
   chart.cursor = cursor;

   chart.events.on("datavalidated", function() {
       dateAxis.zoomToDates(new Date(2018, 0, 11), new Date(2018, 1, 1), false, true);
   });

   chart.scrollbarX = new am4core.Scrollbar();
   chart.scrollbarX.parent = chart.bottomAxesContainer;
});
// [ traffic-chart ] end

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

// [ session-scroll ]
var px = new PerfectScrollbar('.session-scroll', {
   wheelSpeed: .5,
   swipeEasing: 0,
   wheelPropagation: 1,
   minScrollbarLength: 40,
});

// [ tooltip ] start
$('.help').popover({
   trigger: 'hover'
})
// [ tooltip ] end

// [ rating ] start
$('#example-1to10').barrating('show', {
   theme: 'bars-1to10',
   readonly: true,
   showSelectedRating: false
});
// [ rating ] end

// [ traffic - chart1 ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end
   // Create chart instance
   var chart = am4core.create("traffic-chart1", am4charts.PieChart);
   // Add data
   chart.data = [{
           "sector": "Incoming requests",
           "size": 8
       },
       {
           "sector": "Intial contact",
           "size": 14.6
       },
       {
           "sector": "Offer made",
           "size": 22.5
       }, {
           "sector": "Negotiation",
           "size": 8
       },
       {
           "sector": "Contract",
           "size": 14.6
       },
       {
           "sector": "Won leads",
           "size": 22.5
       }
   ];
   // Add label
   chart.innerRadius = 60;

   // Add and configure Series
   var pieSeries = chart.series.push(new am4charts.PieSeries());
   pieSeries.dataFields.value = "size";
   pieSeries.dataFields.category = "sector";
   pieSeries.labels.template.disabled = true;
   pieSeries.ticks.template.disabled = true;
   pieSeries.colors.step = 3;
});
// [ traffic-chart1 ] end

// [ satisfaction-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end
   // Create chart instance
   var chart = am4core.create("satisfaction-chart", am4charts.PieChart);
   // Add data
   chart.data = [{
           "sector": "Very Poor [66%]",
           "size": 8
       },
       {
           "sector": "Satisfied [50%]",
           "size": 14.6
       },
       {
           "sector": "Very Satisfied [40%]",
           "size": 22.5
       }, {
           "sector": "Poor [30%]",
           "size": 8
       }
   ];
   // Add label
   chart.innerRadius = 40;

   // Add and configure Series
   var pieSeries = chart.series.push(new am4charts.PieSeries());
   pieSeries.dataFields.value = "size";
   pieSeries.dataFields.category = "sector";
   pieSeries.labels.template.disabled = true;
   pieSeries.ticks.template.disabled = true;
   pieSeries.colors.step = 1;
});
// [ satisfaction-chart ] end

// [ site-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("site-chart", am4charts.XYChart);
   // Add data
   chart.data = [{
       "date": "2018-01-13",
       "price": 135
   }, {
       "date": "2018-01-14",
       "price": 187
   }, {
       "date": "2018-01-15",
       "price": 180
   }, {
       "date": "2018-01-16",
       "price": 222
   }, {
       "date": "2018-01-17",
       "price": 185
   }, {
       "date": "2018-01-18",
       "price": 195
   }, {
       "date": "2018-01-19",
       "price": 158
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   // dateAxis.startLocation = 0.6;
   // dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   // valueAxis.logarithmic = true;
   valueAxis.renderer.minGridDistance = 50;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;
   valueAxis.renderer.grid.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.fillOpacity = 0;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#19BCBF");
   series.stroke = am4core.color("#19BCBF");
   series.strokeWidth = 2;

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;

   var bullet = series.bullets.push(new am4charts.CircleBullet());
   bullet.circle.fill = am4core.color("#fff");
   bullet.circle.strokeWidth = 3;
   bullet.circle.properties.scale = 0.7;

   chart.padding(0, 0, 0, 0);
});
// [ site-chart ] end

// [ site-visitor-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   var chart = am4core.create("site-visitor-chart", am4charts.XYChart);
   chart.hiddenState.properties.opacity = 0;

   chart.padding(0, 0, 0, 0);

   chart.zoomOutButton.disabled = true;

   var data = [];
   var visits = 10;
   var i = 0;

   for (i = 0; i <= 30; i++) {
       visits -= Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
       data.push({
           date: new Date().setSeconds(i - 30),
           value: Math.abs(visits)
       });
   }

   chart.data = data;

   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.minGridDistance = 30;
   dateAxis.dateFormats.setKey("second", "ss");
   dateAxis.periodChangeDateFormats.setKey("second", "[bold]h:mm a");
   dateAxis.periodChangeDateFormats.setKey("minute", "[bold]h:mm a");
   dateAxis.periodChangeDateFormats.setKey("hour", "[bold]h:mm a");
   dateAxis.renderer.inside = true;
   dateAxis.renderer.axisFills.template.disabled = true;
   dateAxis.renderer.ticks.template.disabled = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.tooltip.disabled = true;
   valueAxis.interpolationDuration = 500;
   valueAxis.rangeChangeDuration = 500;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.minLabelPosition = 0.05;
   valueAxis.renderer.maxLabelPosition = 0.95;
   valueAxis.renderer.axisFills.template.disabled = true;
   valueAxis.renderer.ticks.template.disabled = true;

   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.dateX = "date";
   series.dataFields.valueY = "value";
   series.interpolationDuration = 500;
   series.defaultState.transitionDuration = 0;
   series.tensionX = 0.8;
   series.stroke = am4core.color("#FF425C");
   series.strokeWidth = 2;

   chart.events.on("datavalidated", function() {
       dateAxis.zoom({
           start: 1 / 15,
           end: 1.2
       }, false, true);
   });

   dateAxis.interpolationDuration = 500;
   dateAxis.rangeChangeDuration = 500;

   document.addEventListener("visibilitychange", function() {
       if (document.hidden) {
           if (interval) {
               clearInterval(interval);
           }
       } else {
           startInterval();
       }
   }, false);

   // add data
   var interval;

   function startInterval() {
       interval = setInterval(function() {
           visits =
               visits + Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 5);
           var lastdataItem = series.dataItems.getIndex(series.dataItems.length - 1);
           chart.addData({
               date: new Date(lastdataItem.dateX.getTime() + 1000),
               value: Math.abs(visits)
           }, 1);
       }, 1000);
   }

   setTimeout(function() {
       startInterval();
   }, 100);

   // all the below is optional, makes some fancy effects
   // gradient fill of the series
   series.fillOpacity = 1;
   var gradient = new am4core.LinearGradient();
   gradient.addColor(am4core.color("#FF425C"), 0.2);
   gradient.addColor(am4core.color("#FF425C"), 0);
   series.fill = gradient;

   // this makes date axis labels to fade out  FF9764
   dateAxis.renderer.labels.template.adapter.add("fillOpacity", function(fillOpacity, target) {
       var dataItem = target.dataItem;
       return dataItem.position;
   })

   // need to set this, otherwise fillOpacity is not changed and not set
   dateAxis.events.on("datarangechanged", function() {
       am4core.iter.each(dateAxis.renderer.labels.iterator(), function(label) {
           label.fillOpacity = label.fillOpacity;
       })
   })

   // this makes date axis labels which are at equal minutes to be rotated
   dateAxis.renderer.labels.template.adapter.add("rotation", function(rotation, target) {
       var dataItem = target.dataItem;
       if (dataItem.date && dataItem.date.getTime() == am4core.time.round(new Date(dataItem.date.getTime()), "minute").getTime()) {
           target.verticalCenter = "middle";
           target.horizontalCenter = "left";
           return -90;
       } else {
           target.verticalCenter = "bottom";
           target.horizontalCenter = "middle";
           return 0;
       }
   })

   // bullet at the front of the line
   var bullet = series.createChild(am4charts.CircleBullet);
   bullet.circle.radius = 5;
   bullet.fillOpacity = 1;
   bullet.fill = am4core.color("#FF425C");
   bullet.isMeasured = false;

   series.events.on("validated", function() {
       bullet.moveTo(series.dataItems.last.point);
       bullet.validatePosition();
   });
});
// [ site-visitor-chart ] end

// [ coversions-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("coversions-chart", am4charts.XYChart);

   chart.data = [{
       "city": "1",
       "income": 20.5,
   }, {
       "city": "2",
       "income": 18.2,
   }, {
       "city": "3",
       "income": 17.1,
   }, {
       "city": "4",
       "income": 16.9,
   }, {
       "city": "5",
       "income": 15.6,
   }, {
       "city": "6",
       "income": 14.2,
   }, {
       "city": "7",
       "income": 13.1,
   }, {
       "city": "8",
       "income": 16.5,
   }, {
       "city": "9",
       "income": 15.6,
   }, {
       "city": "10",
       "income": 16.2,
   }, {
       "city": "11",
       "income": 14.1,
   }, {
       "city": "12",
       "income": 18.5,
   }, {
       "city": "13",
       "income": 17.6,
   }, {
       "city": "14",
       "income": 19.2,
   }, {
       "city": "15",
       "income": 18.1,
   }, {
       "city": "15",
       "income": 17.5,
   }, {
       "city": "17",
       "income": 16.6,
   }, {
       "city": "18",
       "income": 19.5,
   }, {
       "city": "19",
       "income": 18.2,
   }, {
       "city": "20",
       "income": 19.1,
   }, {
       "city": "21",
       "income": 18.9,
   }, {
       "city": "22",
       "income": 15.6,
   }, {
       "city": "23",
       "income": 14.2,
   }, {
       "city": "24",
       "income": 12.1,
   }, {
       "city": "25",
       "income": 15.5,
   }, {
       "city": "26",
       "income": 19.6,
   }, {
       "city": "27",
       "income": 20.2,
   }, {
       "city": "28",
       "income": 19.1,
   }, {
       "city": "29",
       "income": 18.5,
   }, {
       "city": "30",
       "income": 17.6,
   }, {
       "city": "31",
       "income": 16.2,
   }, {
       "city": "32",
       "income": 17.1,
   }, {
       "city": "33",
       "income": 20.5,
   }, {
       "city": "34",
       "income": 21.6,
   }, {
       "city": "35",
       "income": 20.5,
   }, {
       "city": "36",
       "income": 21.2,
   }, {
       "city": "37",
       "income": 22.1,
   }, {
       "city": "38",
       "income": 20.9,
   }, {
       "city": "39",
       "income": 19.6,
   }, {
       "city": "40",
       "income": 20.2,
   }, {
       "city": "41",
       "income": 25.1,
   }, {
       "city": "42",
       "income": 26.5,
   }, {
       "city": "43",
       "income": 27.6,
   }, {
       "city": "44",
       "income": 26.2,
   }, {
       "city": "45",
       "income": 28.1,
   }, {
       "city": "46",
       "income": 25.5,
   }, {
       "city": "47",
       "income": 27.6,
   }, {
       "city": "48",
       "income": 25.9,
   }, {
       "city": "49",
       "income": 29.2,
   }, {
       "city": "50",
       "income": 25.2,
   }, {
       "city": "51",
       "income": 27.5,
   }];

   //create category axis for years
   var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
   categoryAxis.dataFields.category = "city";
   categoryAxis.renderer.grid.template.location = 0;
   categoryAxis.renderer.cellStartLocation = 0.15;
   categoryAxis.renderer.cellEndLocation = 0.85;
   categoryAxis.renderer.grid.template.strokeOpacity = 0;
   categoryAxis.renderer.inside = true;
   categoryAxis.renderer.labels.template.disabled = true;

   //create value axis for income and expenses
   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.renderer.grid.template.strokeOpacity = 0;
   valueAxis.renderer.grid.template.strokeOpacity = 0;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   //create columns
   var series = chart.series.push(new am4charts.ColumnSeries());
   series.dataFields.valueY = "income";
   series.dataFields.categoryX = "city";
   series.columns.template.height = am4core.percent(90);
   series.tooltipText = "Income in : {valueY.value}";
   series.columns.template.fill = am4core.color("#19BCBF");
   series.columns.template.stroke = am4core.color("#19BCBF");

   //add chart cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.behavior = "zoomY";
   chart.padding(0, 0, 0, 0);
});

$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("coversions-chart1", am4charts.XYChart);

   chart.data = [{
       "city": "1",
       "income": 20.5,
   }, {
       "city": "2",
       "income": 18.2,
   }, {
       "city": "3",
       "income": 17.1,
   }, {
       "city": "4",
       "income": 16.9,
   }, {
       "city": "5",
       "income": 15.6,
   }, {
       "city": "6",
       "income": 14.2,
   }, {
       "city": "7",
       "income": 13.1,
   }, {
       "city": "8",
       "income": 16.5,
   }, {
       "city": "9",
       "income": 15.6,
   }, {
       "city": "10",
       "income": 16.2,
   }, {
       "city": "11",
       "income": 14.1,
   }, {
       "city": "12",
       "income": 18.5,
   }, {
       "city": "13",
       "income": 17.6,
   }, {
       "city": "14",
       "income": 19.2,
   }, {
       "city": "15",
       "income": 18.1,
   }, {
       "city": "15",
       "income": 17.5,
   }, {
       "city": "17",
       "income": 16.6,
   }, {
       "city": "18",
       "income": 19.5,
   }, {
       "city": "19",
       "income": 18.2,
   }, {
       "city": "20",
       "income": 19.1,
   }, {
       "city": "21",
       "income": 18.9,
   }, {
       "city": "22",
       "income": 15.6,
   }, {
       "city": "23",
       "income": 14.2,
   }, {
       "city": "24",
       "income": 12.1,
   }, {
       "city": "25",
       "income": 15.5,
   }, {
       "city": "26",
       "income": 19.6,
   }, {
       "city": "27",
       "income": 20.2,
   }, {
       "city": "28",
       "income": 19.1,
   }, {
       "city": "29",
       "income": 18.5,
   }, {
       "city": "30",
       "income": 17.6,
   }, {
       "city": "31",
       "income": 16.2,
   }, {
       "city": "32",
       "income": 17.1,
   }, {
       "city": "33",
       "income": 20.5,
   }, {
       "city": "34",
       "income": 21.6,
   }, {
       "city": "35",
       "income": 20.5,
   }, {
       "city": "36",
       "income": 21.2,
   }, {
       "city": "37",
       "income": 22.1,
   }, {
       "city": "38",
       "income": 20.9,
   }, {
       "city": "39",
       "income": 19.6,
   }, {
       "city": "40",
       "income": 20.2,
   }, {
       "city": "41",
       "income": 25.1,
   }, {
       "city": "42",
       "income": 26.5,
   }, {
       "city": "43",
       "income": 27.6,
   }, {
       "city": "44",
       "income": 26.2,
   }, {
       "city": "45",
       "income": 28.1,
   }, {
       "city": "46",
       "income": 25.5,
   }, {
       "city": "47",
       "income": 27.6,
   }, {
       "city": "48",
       "income": 25.9,
   }, {
       "city": "49",
       "income": 29.2,
   }, {
       "city": "50",
       "income": 25.2,
   }, {
       "city": "51",
       "income": 27.5,
   }];

   //create category axis for years
   var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
   categoryAxis.dataFields.category = "city";
   categoryAxis.renderer.grid.template.location = 0;
   categoryAxis.renderer.cellStartLocation = 0.15;
   categoryAxis.renderer.cellEndLocation = 0.85;
   categoryAxis.renderer.grid.template.strokeOpacity = 0;
   categoryAxis.renderer.inside = true;
   categoryAxis.renderer.labels.template.disabled = true;

   //create value axis for income and expenses
   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.renderer.grid.template.strokeOpacity = 0;
   valueAxis.renderer.grid.template.strokeOpacity = 0;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   //create columns
   var series = chart.series.push(new am4charts.ColumnSeries());
   series.dataFields.valueY = "income";
   series.dataFields.categoryX = "city";
   series.columns.template.height = am4core.percent(90);
   series.tooltipText = "Income in : {valueY.value}";
   series.columns.template.fill = am4core.color("#463699");
   series.columns.template.stroke = am4core.color("#463699");

   //add chart cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.behavior = "zoomY";
   chart.padding(0, 0, 0, 0);
});
// [ coversions-chart ] end

// [ real1-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("real1-chart", am4charts.XYChart);
   // Add data
   var data = [];
   var visits = 10;
   var i = 0;

   for (i = 0; i <= 30; i++) {
       visits -= Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
       visits = (visits > -5 && visits < 5) ? visits : 0;
       visits = (visits < 0) ? 0 : visits;
       chart.data.push({
           date: new Date().setSeconds(i - 30),
           value: visits
       });
   }

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = false;
   valueAxis.renderer.minGridDistance = 1;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "value";
   series.dataFields.dateX = "date";
   series.strokeWidth = 2;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#FF425C");
   series.stroke = am4core.color("#FF425C");
   chart.padding(0, 0, 0, 0);
});
// [ real1-chart ] end

// [ real2-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("real2-chart", am4charts.XYChart);
   // Add data
   var data = [];
   var visits = 10;
   var i = 0;

   for (i = 0; i <= 30; i++) {
       visits -= Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
       visits = (visits > -5 && visits < 5) ? visits : 0;
       visits = (visits < 0) ? 0 : visits;
       chart.data.push({
           date: new Date().setSeconds(i - 30),
           value: visits
       });
   }

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = false;
   valueAxis.renderer.minGridDistance = 1;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "value";
   series.dataFields.dateX = "date";
   series.strokeWidth = 2;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#19BCBF");
   series.stroke = am4core.color("#19BCBF");
   chart.padding(0, 0, 0, 0);
});
// [ real2-chart ] end

// [ real3-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("real3-chart", am4charts.XYChart);
   // Add data
   var data = [];
   var visits = 10;
   var i = 0;

   for (i = 0; i <= 30; i++) {
       visits -= Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
       visits = (visits > -5 && visits < 5) ? visits : 0;
       visits = (visits < 0) ? 0 : visits;
       chart.data.push({
           date: new Date().setSeconds(i - 30),
           value: visits
       });
   }

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = false;
   valueAxis.renderer.minGridDistance = 1;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "value";
   series.dataFields.dateX = "date";
   series.strokeWidth = 2;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#13bd8a");
   series.stroke = am4core.color("#13bd8a");
   chart.padding(0, 0, 0, 0);
});
// [ real3-chart ] end

// [ real4-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("real4-chart", am4charts.XYChart);
   // Add data
   var data = [];
   var visits = 10;
   var i = 0;

   for (i = 0; i <= 30; i++) {
       visits -= Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
       visits = (visits > -5 && visits < 5) ? visits : 0;
       visits = (visits < 0) ? 0 : visits;
       chart.data.push({
           date: new Date().setSeconds(i - 30),
           value: visits
       });
   }

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = false;
   valueAxis.renderer.minGridDistance = 1;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "value";
   series.dataFields.dateX = "date";
   series.strokeWidth = 2;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#FF9764");
   series.stroke = am4core.color("#FF9764");
   chart.padding(0, 0, 0, 0);
});
// [ real4-chart ] end

// [ real5-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("real5-chart", am4charts.XYChart);
   // Add data
   var data = [];
   var visits = 10;
   var i = 0;

   for (i = 0; i <= 30; i++) {
       visits -= Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
       visits = (visits > -5 && visits < 5) ? visits : 0;
       visits = (visits < 0) ? 0 : visits;
       chart.data.push({
           date: new Date().setSeconds(i - 30),
           value: visits
       });
   }

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = false;
   valueAxis.renderer.minGridDistance = 1;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "value";
   series.dataFields.dateX = "date";
   series.strokeWidth = 2;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#463699");
   series.stroke = am4core.color("#463699");
   chart.padding(0, 0, 0, 0);
});
// [ real5-chart ] end

// [ real6-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("real6-chart", am4charts.XYChart);
   // Add data
   var data = [];
   var visits = 10;
   var i = 0;

   for (i = 0; i <= 30; i++) {
       visits -= Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
       visits = (visits > -5 && visits < 5) ? visits : 0;
       visits = (visits < 0) ? 0 : visits;
       chart.data.push({
           date: new Date().setSeconds(i - 30),
           value: visits
       });
   }

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = false;
   valueAxis.renderer.minGridDistance = 1;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "value";
   series.dataFields.dateX = "date";
   series.strokeWidth = 2;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#dc6788");
   series.stroke = am4core.color("#dc6788");
   chart.padding(0, 0, 0, 0);
});
// [ real6-chart ] end

// [ support-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart
   var chart = am4core.create("support-chart", am4charts.XYChart);
   // Add data
   chart.data = [{
       "date": "2018-01-1",
       "price": 180
   }, {
       "date": "2018-01-2",
       "price": 252
   }, {
       "date": "2018-01-3",
       "price": 185
   }, {
       "date": "2018-01-4",
       "price": 189
   }, {
       "date": "2018-01-5",
       "price": 158
   }, {
       "date": "2018-01-6",
       "price": 200
   }, {
       "date": "2018-01-7",
       "price": 187
   }, {
       "date": "2018-01-8",
       "price": 180
   }, {
       "date": "2018-01-9",
       "price": 252
   }, {
       "date": "2018-01-10",
       "price": 185
   }, {
       "date": "2018-01-11",
       "price": 268
   }, {
       "date": "2018-01-12",
       "price": 158
   }, {
       "date": "2018-01-13",
       "price": 200
   }, {
       "date": "2018-01-14",
       "price": 187
   }, {
       "date": "2018-01-15",
       "price": 180
   }, {
       "date": "2018-01-16",
       "price": 252
   }, {
       "date": "2018-01-17",
       "price": 185
   }, {
       "date": "2018-01-18",
       "price": 250
   }, {
       "date": "2018-01-19",
       "price": 158
   }, {
       "date": "2018-01-20",
       "price": 200
   }, {
       "date": "2018-01-21",
       "price": 187
   }, {
       "date": "2018-01-22",
       "price": 180
   }, {
       "date": "2018-01-23",
       "price": 252
   }, {
       "date": "2018-01-24",
       "price": 185
   }, {
       "date": "2018-01-25",
       "price": 295
   }, {
       "date": "2018-01-26",
       "price": 158
   }, {
       "date": "2018-01-27",
       "price": 200
   }, {
       "date": "2018-01-28",
       "price": 90
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   // dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.opposite = true;
   // dateAxis.renderer.labels.template.disabled = true;
   // dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = false;
   valueAxis.renderer.minGridDistance = 1;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.fillOpacity = 0.1;
   series.tooltipText = "{valueY.value}";
   series.stroke = am4core.color("#19BCBF");
   series.strokeWidth = 3;
   series.fillOpacity = 1;
   series.tensionX = 0.77;
   var gradient = new am4core.LinearGradient();
   gradient.addColor(am4core.color("#19BCBF"), 0.2);
   gradient.addColor(am4core.color("#19BCBF"), 0);
   gradient.rotation = 90;
   series.fill = gradient;
   series.tooltip.getFillFromObject = false;
   series.tooltip.background.fill = am4core.color("#463699");

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);

});
// [ support-chart ] end

// [ average1-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("average-chart1", am4charts.XYChart);
   // Add data
   chart.data = [{
       "date": "2018-01-1",
       "price": 180
   }, {
       "date": "2018-01-2",
       "price": 252
   }, {
       "date": "2018-01-3",
       "price": 185
   }, {
       "date": "2018-01-4",
       "price": 189
   }, {
       "date": "2018-01-5",
       "price": 158
   }, {
       "date": "2018-01-6",
       "price": 200
   }, {
       "date": "2018-01-7",
       "price": 187
   }, {
       "date": "2018-01-8",
       "price": 180
   }, {
       "date": "2018-01-9",
       "price": 252
   }, {
       "date": "2018-01-10",
       "price": 185
   }, {
       "date": "2018-01-11",
       "price": 268
   }, {
       "date": "2018-01-12",
       "price": 158
   }, {
       "date": "2018-01-13",
       "price": 200
   }, {
       "date": "2018-01-14",
       "price": 187
   }, {
       "date": "2018-01-15",
       "price": 180
   }, {
       "date": "2018-01-16",
       "price": 252
   }, {
       "date": "2018-01-17",
       "price": 185
   }, {
       "date": "2018-01-18",
       "price": 250
   }, {
       "date": "2018-01-19",
       "price": 158
   }, {
       "date": "2018-01-20",
       "price": 200
   }, {
       "date": "2018-01-21",
       "price": 187
   }, {
       "date": "2018-01-22",
       "price": 180
   }, {
       "date": "2018-01-23",
       "price": 252
   }, {
       "date": "2018-01-24",
       "price": 185
   }, {
       "date": "2018-01-25",
       "price": 295
   }, {
       "date": "2018-01-26",
       "price": 158
   }, {
       "date": "2018-01-27",
       "price": 200
   }, {
       "date": "2018-01-28",
       "price": 90
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = true;
   valueAxis.renderer.minGridDistance = 0;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#fff");
   series.stroke = am4core.color("#fff");
   series.strokeWidth = 3;


   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);
});
// [ average1-chart ] end

// [ average2-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("average-chart2", am4charts.XYChart);
   // Add data
   chart.data = [{
       "date": "2018-01-1",
       "price": 180
   }, {
       "date": "2018-01-2",
       "price": 252
   }, {
       "date": "2018-01-3",
       "price": 185
   }, {
       "date": "2018-01-4",
       "price": 189
   }, {
       "date": "2018-01-5",
       "price": 158
   }, {
       "date": "2018-01-6",
       "price": 200
   }, {
       "date": "2018-01-7",
       "price": 187
   }, {
       "date": "2018-01-8",
       "price": 180
   }, {
       "date": "2018-01-9",
       "price": 252
   }, {
       "date": "2018-01-10",
       "price": 185
   }, {
       "date": "2018-01-11",
       "price": 268
   }, {
       "date": "2018-01-12",
       "price": 158
   }, {
       "date": "2018-01-13",
       "price": 200
   }, {
       "date": "2018-01-14",
       "price": 187
   }, {
       "date": "2018-01-15",
       "price": 180
   }, {
       "date": "2018-01-16",
       "price": 252
   }, {
       "date": "2018-01-17",
       "price": 185
   }, {
       "date": "2018-01-18",
       "price": 250
   }, {
       "date": "2018-01-19",
       "price": 158
   }, {
       "date": "2018-01-20",
       "price": 200
   }, {
       "date": "2018-01-21",
       "price": 187
   }, {
       "date": "2018-01-22",
       "price": 180
   }, {
       "date": "2018-01-23",
       "price": 252
   }, {
       "date": "2018-01-24",
       "price": 185
   }, {
       "date": "2018-01-25",
       "price": 295
   }, {
       "date": "2018-01-26",
       "price": 158
   }, {
       "date": "2018-01-27",
       "price": 200
   }, {
       "date": "2018-01-28",
       "price": 90
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = true;
   valueAxis.renderer.minGridDistance = 0;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#fff");
   series.stroke = am4core.color("#fff");
   series.strokeWidth = 3;

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);
});
// [ average2-chart ] end

// [ average3-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("average-chart3", am4charts.XYChart);
   // Add data
   chart.data = [{
       "date": "2018-01-1",
       "price": 180
   }, {
       "date": "2018-01-2",
       "price": 252
   }, {
       "date": "2018-01-3",
       "price": 185
   }, {
       "date": "2018-01-4",
       "price": 189
   }, {
       "date": "2018-01-5",
       "price": 158
   }, {
       "date": "2018-01-6",
       "price": 200
   }, {
       "date": "2018-01-7",
       "price": 187
   }, {
       "date": "2018-01-8",
       "price": 180
   }, {
       "date": "2018-01-9",
       "price": 252
   }, {
       "date": "2018-01-10",
       "price": 185
   }, {
       "date": "2018-01-11",
       "price": 268
   }, {
       "date": "2018-01-12",
       "price": 158
   }, {
       "date": "2018-01-13",
       "price": 200
   }, {
       "date": "2018-01-14",
       "price": 187
   }, {
       "date": "2018-01-15",
       "price": 180
   }, {
       "date": "2018-01-16",
       "price": 252
   }, {
       "date": "2018-01-17",
       "price": 185
   }, {
       "date": "2018-01-18",
       "price": 250
   }, {
       "date": "2018-01-19",
       "price": 158
   }, {
       "date": "2018-01-20",
       "price": 200
   }, {
       "date": "2018-01-21",
       "price": 187
   }, {
       "date": "2018-01-22",
       "price": 180
   }, {
       "date": "2018-01-23",
       "price": 252
   }, {
       "date": "2018-01-24",
       "price": 185
   }, {
       "date": "2018-01-25",
       "price": 295
   }, {
       "date": "2018-01-26",
       "price": 158
   }, {
       "date": "2018-01-27",
       "price": 200
   }, {
       "date": "2018-01-28",
       "price": 90
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = true;
   valueAxis.renderer.minGridDistance = 0;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#fff");
   series.stroke = am4core.color("#fff");
   series.strokeWidth = 3;

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);
});
// [ average3-chart ] end

// [ average4-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("average-chart4", am4charts.XYChart);
   // Add data
   chart.data = [{
       "date": "2018-01-1",
       "price": 180
   }, {
       "date": "2018-01-2",
       "price": 252
   }, {
       "date": "2018-01-3",
       "price": 185
   }, {
       "date": "2018-01-4",
       "price": 189
   }, {
       "date": "2018-01-5",
       "price": 158
   }, {
       "date": "2018-01-6",
       "price": 200
   }, {
       "date": "2018-01-7",
       "price": 187
   }, {
       "date": "2018-01-8",
       "price": 180
   }, {
       "date": "2018-01-9",
       "price": 252
   }, {
       "date": "2018-01-10",
       "price": 185
   }, {
       "date": "2018-01-11",
       "price": 268
   }, {
       "date": "2018-01-12",
       "price": 158
   }, {
       "date": "2018-01-13",
       "price": 200
   }, {
       "date": "2018-01-14",
       "price": 187
   }, {
       "date": "2018-01-15",
       "price": 180
   }, {
       "date": "2018-01-16",
       "price": 252
   }, {
       "date": "2018-01-17",
       "price": 185
   }, {
       "date": "2018-01-18",
       "price": 250
   }, {
       "date": "2018-01-19",
       "price": 158
   }, {
       "date": "2018-01-20",
       "price": 200
   }, {
       "date": "2018-01-21",
       "price": 187
   }, {
       "date": "2018-01-22",
       "price": 180
   }, {
       "date": "2018-01-23",
       "price": 252
   }, {
       "date": "2018-01-24",
       "price": 185
   }, {
       "date": "2018-01-25",
       "price": 295
   }, {
       "date": "2018-01-26",
       "price": 158
   }, {
       "date": "2018-01-27",
       "price": 200
   }, {
       "date": "2018-01-28",
       "price": 90
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = true;
   valueAxis.renderer.minGridDistance = 0;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.tensionX = 0.77;
   series.tooltipText = "{valueY.value}";
   series.fill = am4core.color("#fff");
   series.stroke = am4core.color("#fff");
   series.strokeWidth = 3;

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);
});
// [ average4-chart ] end

// [ average11-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("average-chart11", am4charts.XYChart);
   // Add data
   chart.data = [{
     "date": "2018-01-1",
     "price": 180
   }, {
     "date": "2018-01-2",
     "price": 252
   }, {
     "date": "2018-01-3",
     "price": 185
   }, {
     "date": "2018-01-4",
     "price": 189
   }, {
     "date": "2018-01-5",
     "price": 158
   }, {
     "date": "2018-01-6",
     "price": 200
   }, {
     "date": "2018-01-7",
     "price": 187
   }, {
     "date": "2018-01-8",
     "price": 180
   }, {
     "date": "2018-01-9",
     "price": 252
   }, {
     "date": "2018-01-10",
     "price": 185
   }, {
     "date": "2018-01-11",
     "price": 268
   }, {
     "date": "2018-01-12",
     "price": 158
   }, {
     "date": "2018-01-13",
     "price": 200
   }, {
     "date": "2018-01-14",
     "price": 187
   }, {
     "date": "2018-01-15",
     "price": 180
   }, {
     "date": "2018-01-16",
     "price": 252
   }, {
     "date": "2018-01-17",
     "price": 185
   }, {
     "date": "2018-01-18",
     "price": 250
   }, {
     "date": "2018-01-19",
     "price": 158
   }, {
     "date": "2018-01-20",
     "price": 200
   }, {
     "date": "2018-01-21",
     "price": 187
   }, {
     "date": "2018-01-22",
     "price": 180
   }, {
     "date": "2018-01-23",
     "price": 252
   }, {
     "date": "2018-01-24",
     "price": 185
   }, {
     "date": "2018-01-25",
     "price": 295
   }, {
     "date": "2018-01-26",
     "price": 158
   }, {
     "date": "2018-01-27",
     "price": 200
   }, {
     "date": "2018-01-28",
     "price": 90
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = true;
   valueAxis.renderer.minGridDistance = 0;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.tooltipText = "{valueY.value}";
   series.stroke = am4core.color("#19BCBF");
   series.strokeWidth = 3;
   series.fillOpacity  = 1;
   series.tensionX = 0.77;
   var gradient = new am4core.LinearGradient();
   gradient.addColor(am4core.color("#19BCBF"), 0.2);
   gradient.addColor(am4core.color("#19BCBF"), 0);
   gradient.rotation = 90;
   series.fill = gradient;
   series.tooltip.getFillFromObject = false;
   series.tooltip.background.fill = am4core.color("#19BCBF");

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);
});
// [ average11-chart ] end

// [ average12-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("average-chart12", am4charts.XYChart);
   // Add data
   chart.data = [{
     "date": "2018-01-1",
     "price": 180
   }, {
     "date": "2018-01-2",
     "price": 252
   }, {
     "date": "2018-01-3",
     "price": 185
   }, {
     "date": "2018-01-4",
     "price": 189
   }, {
     "date": "2018-01-5",
     "price": 158
   }, {
     "date": "2018-01-6",
     "price": 200
   }, {
     "date": "2018-01-7",
     "price": 187
   }, {
     "date": "2018-01-8",
     "price": 180
   }, {
     "date": "2018-01-9",
     "price": 252
   }, {
     "date": "2018-01-10",
     "price": 185
   }, {
     "date": "2018-01-11",
     "price": 268
   }, {
     "date": "2018-01-12",
     "price": 158
   }, {
     "date": "2018-01-13",
     "price": 200
   }, {
     "date": "2018-01-14",
     "price": 187
   }, {
     "date": "2018-01-15",
     "price": 180
   }, {
     "date": "2018-01-16",
     "price": 252
   }, {
     "date": "2018-01-17",
     "price": 185
   }, {
     "date": "2018-01-18",
     "price": 250
   }, {
     "date": "2018-01-19",
     "price": 158
   }, {
     "date": "2018-01-20",
     "price": 200
   }, {
     "date": "2018-01-21",
     "price": 187
   }, {
     "date": "2018-01-22",
     "price": 180
   }, {
     "date": "2018-01-23",
     "price": 252
   }, {
     "date": "2018-01-24",
     "price": 185
   }, {
     "date": "2018-01-25",
     "price": 295
   }, {
     "date": "2018-01-26",
     "price": 158
   }, {
     "date": "2018-01-27",
     "price": 200
   }, {
     "date": "2018-01-28",
     "price": 90
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = true;
   valueAxis.renderer.minGridDistance = 0;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.tooltipText = "{valueY.value}";
   series.stroke = am4core.color("#13bd8a");
   series.strokeWidth = 3;
   series.fillOpacity  = 1;
   series.tensionX = 0.77;
   var gradient = new am4core.LinearGradient();
   gradient.addColor(am4core.color("#13bd8a"), 0.2);
   gradient.addColor(am4core.color("#13bd8a"), 0);
   gradient.rotation = 90;
   series.fill = gradient;
   series.tooltip.getFillFromObject = false;
   series.tooltip.background.fill = am4core.color("#13bd8a");

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);
});
// [ average12-chart ] end

// [ average13-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("average-chart13", am4charts.XYChart);
   // Add data
   chart.data = [{
     "date": "2018-01-1",
     "price": 180
   }, {
     "date": "2018-01-2",
     "price": 252
   }, {
     "date": "2018-01-3",
     "price": 185
   }, {
     "date": "2018-01-4",
     "price": 189
   }, {
     "date": "2018-01-5",
     "price": 158
   }, {
     "date": "2018-01-6",
     "price": 200
   }, {
     "date": "2018-01-7",
     "price": 187
   }, {
     "date": "2018-01-8",
     "price": 180
   }, {
     "date": "2018-01-9",
     "price": 252
   }, {
     "date": "2018-01-10",
     "price": 185
   }, {
     "date": "2018-01-11",
     "price": 268
   }, {
     "date": "2018-01-12",
     "price": 158
   }, {
     "date": "2018-01-13",
     "price": 200
   }, {
     "date": "2018-01-14",
     "price": 187
   }, {
     "date": "2018-01-15",
     "price": 180
   }, {
     "date": "2018-01-16",
     "price": 252
   }, {
     "date": "2018-01-17",
     "price": 185
   }, {
     "date": "2018-01-18",
     "price": 250
   }, {
     "date": "2018-01-19",
     "price": 158
   }, {
     "date": "2018-01-20",
     "price": 200
   }, {
     "date": "2018-01-21",
     "price": 187
   }, {
     "date": "2018-01-22",
     "price": 180
   }, {
     "date": "2018-01-23",
     "price": 252
   }, {
     "date": "2018-01-24",
     "price": 185
   }, {
     "date": "2018-01-25",
     "price": 295
   }, {
     "date": "2018-01-26",
     "price": 158
   }, {
     "date": "2018-01-27",
     "price": 200
   }, {
     "date": "2018-01-28",
     "price": 90
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = true;
   valueAxis.renderer.minGridDistance = 0;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.tooltipText = "{valueY.value}";
   series.stroke = am4core.color("#FF425C");
   series.strokeWidth = 3;
   series.fillOpacity  = 1;
   series.tensionX = 0.77;
   var gradient = new am4core.LinearGradient();
   gradient.addColor(am4core.color("#FF425C"), 0.2);
   gradient.addColor(am4core.color("#FF425C"), 0);
   gradient.rotation = 90;
   series.fill = gradient;
   series.tooltip.getFillFromObject = false;
   series.tooltip.background.fill = am4core.color("#FF425C");

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);
});
// [ average13-chart ] end

// [ average14-chart ] start
$(function() {
   // Themes begin
   am4core.useTheme(am4themes_animated);
   // Themes end

   // Create chart instance
   var chart = am4core.create("average-chart14", am4charts.XYChart);
   // Add data
   chart.data = [{
     "date": "2018-01-1",
     "price": 180
   }, {
     "date": "2018-01-2",
     "price": 252
   }, {
     "date": "2018-01-3",
     "price": 185
   }, {
     "date": "2018-01-4",
     "price": 189
   }, {
     "date": "2018-01-5",
     "price": 158
   }, {
     "date": "2018-01-6",
     "price": 200
   }, {
     "date": "2018-01-7",
     "price": 187
   }, {
     "date": "2018-01-8",
     "price": 180
   }, {
     "date": "2018-01-9",
     "price": 252
   }, {
     "date": "2018-01-10",
     "price": 185
   }, {
     "date": "2018-01-11",
     "price": 268
   }, {
     "date": "2018-01-12",
     "price": 158
   }, {
     "date": "2018-01-13",
     "price": 200
   }, {
     "date": "2018-01-14",
     "price": 187
   }, {
     "date": "2018-01-15",
     "price": 180
   }, {
     "date": "2018-01-16",
     "price": 252
   }, {
     "date": "2018-01-17",
     "price": 185
   }, {
     "date": "2018-01-18",
     "price": 250
   }, {
     "date": "2018-01-19",
     "price": 158
   }, {
     "date": "2018-01-20",
     "price": 200
   }, {
     "date": "2018-01-21",
     "price": 187
   }, {
     "date": "2018-01-22",
     "price": 180
   }, {
     "date": "2018-01-23",
     "price": 252
   }, {
     "date": "2018-01-24",
     "price": 185
   }, {
     "date": "2018-01-25",
     "price": 295
   }, {
     "date": "2018-01-26",
     "price": 158
   }, {
     "date": "2018-01-27",
     "price": 200
   }, {
     "date": "2018-01-28",
     "price": 90
   }];

   // Create axes
   var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
   dateAxis.renderer.grid.template.location = 0;
   dateAxis.renderer.grid.template.disabled = true;
   dateAxis.startLocation = 0.6;
   dateAxis.endLocation = 0.4;
   dateAxis.renderer.labels.template.disabled = true;
   dateAxis.renderer.inside = true;

   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.logarithmic = true;
   valueAxis.renderer.minGridDistance = 0;
   valueAxis.renderer.grid.template.disabled = true;
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;

   // Create series
   var series = chart.series.push(new am4charts.LineSeries());
   series.dataFields.valueY = "price";
   series.dataFields.dateX = "date";
   series.strokeWidth = 3;
   series.tooltipText = "{valueY.value}";
   series.stroke = am4core.color("#FF9764");
   series.strokeWidth = 3;
   series.fillOpacity  = 1;
   series.tensionX = 0.77;
   var gradient = new am4core.LinearGradient();
   gradient.addColor(am4core.color("#FF9764"), 0.2);
   gradient.addColor(am4core.color("#FF9764"), 0);
   gradient.rotation = 90;
   series.fill = gradient;
   series.tooltip.getFillFromObject = false;
   series.tooltip.background.fill = am4core.color("#FF9764");

   // Add cursor
   chart.cursor = new am4charts.XYCursor();
   chart.cursor.fullWidthLineX = true;
   chart.cursor.lineX.strokeWidth = 0;
   chart.cursor.lineX.fill = am4core.color("#fff");
   chart.cursor.lineX.fillOpacity = 0;
   chart.padding(0, 0, 0, 0);
});
// [ average14-chart ] end
// ==============================  new chart  ==================
