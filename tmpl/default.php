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
<script>

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
</script>