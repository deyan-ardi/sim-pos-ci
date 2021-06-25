function chartOne(data_transaksi) {
  var jsonData = data_transaksi;

  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  // Create chart
  var chart = am4core.create("support-chart", am4charts.XYChart);
  // Add data
  data = [];
  chart.data = data;
  for (const val of jsonData) {
    data.push(val);
  }

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
  series.stroke = am4core.color("#463699");
  series.strokeWidth = 3;
  series.fillOpacity = 1;
  series.tensionX = 0.77;
  var gradient = new am4core.LinearGradient();
  gradient.addColor(am4core.color("#463699"), 0.2);
  gradient.addColor(am4core.color("#463699"), 0);
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
}
// [ support-chart ] end

// [ support1-chart ] start
function chartTwo(data_order) {
  var jsonData = data_order;
  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  // Create chart
  var chart = am4core.create("support-chart1", am4charts.XYChart);
  // Add data

  data = [];
  chart.data = data;
  for (const val of jsonData) {
    data.push(val);
  }
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
  series.tooltip.background.fill = am4core.color("#19BCBF");

  // Add cursor
  chart.cursor = new am4charts.XYCursor();
  chart.cursor.fullWidthLineX = true;
  chart.cursor.lineX.strokeWidth = 0;
  chart.cursor.lineX.fillOpacity = 0;
  chart.padding(0, 0, 0, 0);
}
// [ support1-chart ] end


