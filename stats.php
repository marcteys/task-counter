<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appart</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.3.0/d3.js"></script>
      <script src="vendor/dimple.v2.3.0.min.js"></script>
</head>
<body>
  <?php  require "fllat.php";
    $data = new Fllat("data"); ?>
  <div id="plot" style="width: 800px; height: 600px;"></div>
  <div id="plot2" style="width: 800px; height: 600px;"></div>

  <script type="text/javascript">
    var svg = dimple.newSvg("#plot", 800, 600);
    d3.csv("db/count2.csv", function (data) {
      console.log(data);
      var myChart = new dimple.chart(svg, data);
      myChart.setBounds(60, 30, 510, 330)
      myChart.addCategoryAxis("x", ["type", "user"]);
      myChart.addMeasureAxis("y", "count");
      myChart.addSeries("user", dimple.plot.bar);
      myChart.addLegend(65, 10, 510, 20, "right");
      myChart.draw();
    });

    var svg2 = dimple.newSvg("#plot2", 800, 600);
    d3.csv("db/all.csv", function (data) {
      console.log(data);
      //data = dimple.filterData(data, "Owner", ["Aperture", "Black Mesa"])
      var myChart = new dimple.chart(svg2, data);
     // myChart.setBounds(60, 30, 505, 305);
      var x = myChart.addCategoryAxis("x", "date");
      x.addOrderRule("Date");
      myChart.addCategoryAxis("y", "type");
      myChart.addSeries("user", dimple.plot.line);
     // myChart.addLegend(60, 10, 500, 20, "right");
      myChart.draw();
    });

    /*
    var chart = new dimple.chart(svg, data);
    chart.addCategoryAxis("x", "Word");
    chart.addMeasureAxis("y", "Awesomeness");
    chart.addSeries(null, dimple.plot.bar);
    chart.draw();
*/
/*

var margin = {top: 80, right: 80, bottom: 80, left: 80},
    width = 600 - margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;
var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .1);
var y0 = d3.scale.linear().domain([300, 1100]).range([height, 0]),
y1 = d3.scale.linear().domain([20, 80]).range([height, 0]);
var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");
// create left yAxis
var yAxisLeft = d3.svg.axis().scale(y0).ticks(4).orient("left");
// create right yAxis
var yAxisRight = d3.svg.axis().scale(y1).ticks(6).orient("right");
var svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("class", "graph")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
d3.csv("db/count.csv", type, function(error, data) {
  x.domain(data.map(function(d) { return d.type; }));
  y0.domain([0, d3.max(data, function(d) { return d.marion; })]);
  
  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);
  svg.append("g")
    .attr("class", "y axis axisLeft")
    .attr("transform", "translate(0,0)")
    .call(yAxisLeft)
  .append("text")
    .attr("y", 6)
    .attr("dy", "-2em")
    .style("text-anchor", "end")
    .style("text-anchor", "end")
    .text("Fréquence");
  
  bars = svg.selectAll(".bar").data(data).enter();
  bars.append("rect")
      .attr("class", "bar1")
      .attr("x", function(d) { return x(d.type); })
      .attr("width", x.rangeBand()/2)
      .attr("y", function(d) { return y0(d.marion); })
    .attr("height", function(d,i,j) { return height - y0(d.marion); }); 
  bars.append("rect")
      .attr("class", "bar2")
      .attr("x", function(d) { return x(d.type) + x.rangeBand()/2; })
      .attr("width", x.rangeBand() / 2)
      .attr("y", function(d) { return y1(d.marc); })
    .attr("height", function(d,i,j) { return height - y1(d.marc); }); 
});
function type(d) {
  d.marion = +d.marion;
  return d;
}
*/

</script>
</body>
</html>