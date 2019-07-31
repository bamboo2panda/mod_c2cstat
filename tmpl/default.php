<?php
/**
 * @package    mod_c2cstat
 *
 * @author     Pavel <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addScript(JURI::root(). 'media/mod_c2cstat/script.js');


foreach ($relations as $relation){
    print_r($relation->technology);
    echo '<br>';
}

?>

<!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>

<!-- Load color scale -->
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>

<!-- Create a div where the graph will take place -->
<div id="my_dataviz"></div>
<!--<script>

    // set the dimensions and margins of the graph
    var margin = {top: 10, right: 20, bottom: 30, left: 50},
        width = 500 - margin.left - margin.right,
        height = 420 - margin.top - margin.bottom;

    // append the svg object to the body of the page
    var svg = d3.select("#my_dataviz")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");

    //Read the data
    d3.csv("https://test1.mioo.ru/media/mod_c2cstat/data2.csv", function(data) {

        // Add X axis 123
        var x = d3.scaleLinear()
            .domain([0, 5])
            .range([  width, 0 ]);
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x));

        // Add Y axis
        var y = d3.scaleLinear()
            .domain([0, 5])
            .range([ height, 0]);
        svg.append("g")
            .call(d3.axisLeft(y));

        // Add a scale for bubble size
        var z = d3.scaleLinear()
            .domain([1, 5])
            .range([ 1, 5]);

        // Add a scale for bubble color
        var myColor = d3.scaleOrdinal()
            .domain(["МЭШ", "РЭШ", "ПЭШ"])
            .range(d3.schemeSet2);

        // Add dots
        svg.append('g')
            .selectAll("dot")
            .data(data)
            .enter()
            .append("circle")
            .attr("cx", function (d) { return x(d.Связи); } )
            .attr("cy", function (d) { return y(d.Связи); } )
            .attr("r", function (d) { return z(d.Связи)*10; } )
            .style("fill", function (d) { return myColor(d.Проект); } )
            .style("opacity", "0.7")
            .attr("stroke", "white")
            .style("stroke-width", "2px");
        svg.append('g')
            .selectAll("title")
            .data(data)
            .enter()
            .append("text")
            .attr("x", function (d) { return x(d.Связи); } )
            .attr("y", function (d) { return y(d.Связи); } )
            .text(function (d) { return d.Проект; } );

    })
</script>-->


<script type="text/javascript">

    dataset = {
        "children": [{"Name":"Olives","Count":4319},
            {"Name":"Tea","Count":4159},
            {"Name":"Mashed Potatoes","Count":2583},
            {"Name":"Boiled Potatoes","Count":2074},
            {"Name":"Milk","Count":1894},
            {"Name":"Chicken Salad","Count":1809},
            {"Name":"Vanilla Ice Cream","Count":1713},
            {"Name":"Cocoa","Count":1636},
            {"Name":"Lettuce Salad","Count":1566},
            {"Name":"Lobster Salad","Count":1511},
            {"Name":"Chocolate","Count":1489},
            {"Name":"Apple Pie","Count":1487},
            {"Name":"Orange Juice","Count":1423},
            {"Name":"American Cheese","Count":1372},
            {"Name":"Green Peas","Count":1341},
            {"Name":"Assorted Cakes","Count":1331},
            {"Name":"French Fried Potatoes","Count":1328},
            {"Name":"Potato Salad","Count":1306},
            {"Name":"Baked Potatoes","Count":1293},
            {"Name":"Roquefort","Count":1273},
            {"Name":"Stewed Prunes","Count":1268}]
    };

    var diameter = 600;
    var color = d3.scaleOrdinal(d3.schemeCategory20);

    var bubble = d3.pack(dataset)
        .size([diameter, diameter])
        .padding(1.5);

    var svg = d3.select("body")
        .append("svg")
        .attr("width", diameter)
        .attr("height", diameter)
        .attr("class", "bubble");

    var nodes = d3.hierarchy(dataset)
        .sum(function(d) { return d.Count; });

    var node = svg.selectAll(".node")
        .data(bubble(nodes).descendants())
        .enter()
        .filter(function(d){
            return  !d.children
        })
        .append("g")
        .attr("class", "node")
        .attr("transform", function(d) {
            return "translate(" + d.x + "," + d.y + ")";
        });

    node.append("title")
        .text(function(d) {
            return d.Name + ": " + d.Count;
        });

    node.append("circle")
        .attr("r", function(d) {
            return d.r;
        })
        .style("fill", function(d,i) {
            return color(i);
        });

    node.append("text")
        .attr("dy", ".2em")
        .style("text-anchor", "middle")
        .text(function(d) {
            return d.data.Name.substring(0, d.r / 3);
        })
        .attr("font-family", "sans-serif")
        .attr("font-size", function(d){
            return d.r/5;
        })
        .attr("fill", "white");

    node.append("text")
        .attr("dy", "1.3em")
        .style("text-anchor", "middle")
        .text(function(d) {
            return d.data.Count;
        })
        .attr("font-family",  "Gill Sans", "Gill Sans MT")
        .attr("font-size", function(d){
            return d.r/5;
        })
        .attr("fill", "white");

    d3.select(self.frameElement)
        .style("height", diameter + "px");



</script>