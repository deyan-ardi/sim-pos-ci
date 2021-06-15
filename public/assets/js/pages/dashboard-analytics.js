'use strict';
$(document).ready(function() {

    $(function(){
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create map instance
        var chart = am4core.create("sales-analytics-chart", am4maps.MapChart);
        var latlong = {
          "AU": {"latitude": -27,"longitude": 133 },
            "BR": {"latitude": -10,"longitude": -55},
            "BW": {"latitude": -22,"longitude": 24},
            "IN": {"latitude": 20,"longitude": 77},
            "KE": {"latitude": 1,"longitude": 38},
            "MX": {"latitude": 23,"longitude": -102},
            "MY": {"latitude": 2.5,"longitude": 112.5},
            "NI": {"latitude": 13,"longitude": -85},
            "NZ": {"latitude": -41,"longitude": 174},
            "PH": {"latitude": 13,"longitude": 122},
            "PL": {"latitude": 52,"longitude": 20},
            "RU": {"latitude": 60,"longitude": 100},
            "TH": {"latitude": 15,"longitude": 100},
            "ZA": {"latitude": -29,"longitude": 24}
        };

        var mapData = [
                 { "id": "MX", "name": "Mexico", "value": 114793341, "color": am4core.color("#2DCEE3")},
                 { "id": "BR", "name": "Brazil", "value": 196655014, "color": am4core.color("#13bd8a")},
                 { "id": "PL", "name": "Poland", "value": 38298949, "color": am4core.color("#f44236")},
                 { "id": "KE", "name": "Kenya", "value": 41609728, "color": am4core.color("#FF9764")},
                 { "id": "ZA", "name": "South Africa", "value": 50459978, "color": am4core.color("#463699")},
                 { "id": "RU", "name": "Russia", "value": 142835555, "color": am4core.color("#463699")},
                 { "id": "IN", "name": "India", "value": 241491960, "color": am4core.color("#13bd8a")},
                 { "id": "PH", "name": "Philippines", "value": 94852030, "color": am4core.color("#19BCBF")},
                 { "id": "AU", "name": "Australia", "value": 22605732, "color": am4core.color("#FF9764")},
                 { "id": "TH", "name": "Thailand", "value": 69518555, "color": am4core.color("#FF425C")},
                 { "id": "BW", "name": "Botswana", "value": 2030738, "color": am4core.color("#19BCBF")},
                 { "id": "MY", "name": "Malaysia", "value": 28859154, "color": am4core.color("#2DCEE3")},
                 { "id": "NZ", "name": "New Zealand", "value": 4414509, "color": am4core.color("#19BCBF")},
                 { "id": "NI", "name": "Nicaragua", "value": 5869859, "color": am4core.color("#2DCEE3")}
        ];

        // Add lat/long information to data
        for(var i = 0; i < mapData.length; i++) {
          mapData[i].latitude = latlong[mapData[i].id].latitude;
          mapData[i].longitude = latlong[mapData[i].id].longitude;
        }

        // Set map definition
        chart.geodata = am4geodata_worldLow;

        // Set projection
        chart.projection = new am4maps.projections.Miller();

        // Create map polygon series
        var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
        polygonSeries.exclude = ["AQ"];
        polygonSeries.useGeodata = true;
        polygonSeries.nonScalingStroke = true;
        polygonSeries.strokeWidth = 0.5;

        var imageSeries = chart.series.push(new am4maps.MapImageSeries());
        imageSeries.data = mapData;
        imageSeries.dataFields.value = "value";

        var imageTemplate = imageSeries.mapImages.template;
        imageTemplate.propertyFields.latitude = "latitude";
        imageTemplate.propertyFields.longitude = "longitude";
        imageTemplate.nonScaling = true

        var circle = imageTemplate.createChild(am4core.Circle);
        circle.fillOpacity = 0.7;
        circle.propertyFields.fill = "color";
        circle.tooltipText = "{name}: [bold]{value}[/]";

        imageSeries.heatRules.push({
          "target": circle,
          "property": "radius",
          "min": 4,
          "max": 30,
          "dataField": "value"
        })
    });

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
        series.fillOpacity = 1;
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
        series.fillOpacity = 1;
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

    // [ session-scroll ] start
    var px = new PerfectScrollbar('.session-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    // [ session-scroll ] end

});
