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


/*foreach ($relations as $relation){
    print_r($relation->technology);
    echo '<br>';
}

*/?>

<!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>

<!-- Load color scale -->
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>

<!-- Create a div where the graph will take place -->
<div id="my_dataviz"></div>
<script type="text/javascript">

    dataset = {
        "children": [{"Name":"Московская электронная школа","Count":3,"City":"Москва"},
            {"Name":"Образовательное телевидение (МособрТВ)","Count":2,"City":"Москва"},
            {"Name":"Менторинг в системе образования","Count":3,"City":"Москва"},
            {"Name":"Субботы московского школьника","Count":3,"City":"Москва"},
            {"Name":"Обучение слепых детей в обычных классах","Count":1,"City":"Ижевск"}]

    };

    var diameter = 750;
    var color = d3.scaleOrdinal(d3.schemeCategory20);

    var bubble = d3.pack(dataset)
        .size([diameter, diameter])
        .padding(1.5);

    var svg = d3.select("#my_dataviz")
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

    node.append("circle")
        .attr("r", function(d) {
            return d.r;
        })
        .style("fill", function(d,i) {
            return color(i);
        })
        .attr("stroke", "white")
        .style("stroke-width", "2px");

    node.append('foreignObject')
        .attr('x', function(d) {
            return - d.r * 0.75;
        })
        .attr('y', function(d) {
            return - d.r * 0.4;
        })
        .attr('width', function(d) {
            return d.r * 1.5;
        })
        .attr('height', function(d) {
            return d.r * 1.5;
        })
        .html(function (d,i) {
            return '<div style="width:' +
                d.r * 1.5 +
                'px; background-color: ' +
                color(i) +
                '; ' +
                'text-align: center; font-size:' +
                d.r/7 +
                'px;' +
                'line-height: ' +
                d.r/7 +
                'px"><p style="color: white">' +
                d.data.Name +
                '<br><br>--' +
                d.data.City +
                '--</p></div>';
        });

    d3.select(self.frameElement)
        .style("height", diameter + "px");

    var color = d3.scaleOrdinal(d3.schemeCategory20);

    var bubble = d3.pack(dataset)
        .size([diameter, diameter])
        .padding(1.5);

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

</script>