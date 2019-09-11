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

*/
$r = $params->get('relations');
$s = [];
foreach ($r as $rel){
    $s[] = $rel->source_city;
//    echo $rel->source_city.'<br>';
}
$s = array_unique($s);

//print_r($s);





//print_r(json_encode( (array)$params->get('relations')));
?>

<!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>

<!-- Load color scale -->
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>

<!-- Create a div where the graph will take place -->
<div id="my_dataviz"></div>
<script type="text/javascript">
    function guid() {
        function _p8(s) {
            var p = (Math.random().toString(16)+"000000000").substr(2,8);
            return s ? "-" + p.substr(0,4) + "-" + p.substr(4,4) : p ;
        }
        return _p8() + _p8(true) + _p8(true) + _p8();
    }
    function log(sel,msg) {
        console.log(msg,sel);
    }
    let dataset = {
        "children": [{"Name":"Московская электронная школа","Count":3,"City":"Москва","Partners":"<ul><li>Ижевск</li><li>Пермь</li></ul>"},
            {"Name":"Образовательное телевидение (МособрТВ)","Count":15,"City":"Москва","Partners":"<ul><li>Ижевск</li><li>Каспийск</li></ul>"},
            {"Name":"Менторинг в системе образования","Count":3,"City":"Москва","Partners":"<ul><li>Ижевск</li><li>Сочи</li></ul>"},
            {"Name":"Субботы московского школьника","Count":3,"City":"Москва","Partners":"<ul><li>Тюмень</li></ul>"},
            {"Name":"Образовательное телевидение (МособрТВ)","Count":2,"City":"Москва","Partners":"<ul><li>Ижевск</li><li>Каспийск</li></ul>"},
            {"Name":"Менторинг в системе образования","Count":3,"City":"Москва","Partners":"<ul><li>Ижевск</li><li>Сочи</li></ul>"},
            {"Name":"Субботы московского школьника","Count":10,"City":"Москва","Partners":"<ul><li>Тюмень</li></ul>"},
            {"Name":"Образовательное телевидение (МособрТВ)","Count":2,"City":"Москва","Partners":"<ul><li>Ижевск</li><li>Каспийск</li></ul>"},
            {"Name":"Менторинг в системе образования","Count":3,"City":"Москва","Partners":"<ul><li>Ижевск</li><li>Сочи</li></ul>"},
            {"Name":"Субботы московского школьника","Count":3,"City":"Москва","Partners":"<ul><li>Тюмень</li></ul>"},
            {"Name":"Обучение слепых детей в обычных классах","Count":1,"City":"Ижевск","Partners":"<ul><li>Ижевск</li></ul>"}]

    };

    let diameter = 750;
    let color = d3.scaleOrdinal(d3.schemeCategory10);

    // Three function that change the tooltip when user hover / move / leave a cell
    let mouseover = function(d) {
        Tooltip.style("opacity") === "1" ? Tooltip.style("opacity", 0):
            Tooltip
                .style("opacity", 1)
                .html("<h5>Реализуют проект:<br>" + d.data.Partners + "</h5>")
                .style("left", (d.x + d3.mouse(this)[0]+ 30) + "px")
                .style("top", (d.y + d3.mouse(this)[1] + 30) + "px")
                .style("class", "bubble-tooltip");
        console.log("mouseover")

    }
    let mouseup = function (d) {
        Tooltip
            .style("opacity", 0)
    }

    let mousemove = function(d) {
        // Tooltip


    }
    var mouseleave = function(d) {
        Tooltip
        // .style("opacity", 0)

    }

    let bubble = d3.pack(dataset)
        .size([diameter, diameter])
        .padding(1.5);

    let svg = d3.select("#my_dataviz")
        .append("svg")
        .attr("width", diameter)
        .attr("height", diameter)
        .attr("class", "bubble");

    let nodes = d3.hierarchy(dataset)
        .sum(function(d) { return d.Count; });

    let node = svg.selectAll("node")
        .data(bubble(nodes).descendants())
        .enter()
        .filter((d)=> !d.children)
        .append("g")
        .attr("class", "node")
        .attr("transform", (d) => "translate(" + d.x + "," + d.y + ")");

    node.append("circle")
        .attr("id", guid())
        .attr("r", function(d) {
            return d.r;
        })
        .style("fill", function(d,i) {
            return color(i);
        })
        .attr("stroke", "white")
        .attr("transition", "1500")
        .style("stroke-width", "2px")
    // .on("mouseover", mouseover)
    // .on("mousemove", mousemove)
    // .on("mouseleave", mouseleave)

    ;

    node.append('foreignObject')
        .attr("id", guid())
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
        // .on("mouseover", mouseover)
        .on("click", mouseover)
        //.on("mousemove", mousemove)
        .on("mouseleave", mouseleave)
        .style("cursor", "pointer")
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

    // create a tooltip
    let Tooltip = d3.select("#my_dataviz")
        .append("div")
        .style("opacity", 0)
        .attr("class", "tooltip")
        .style("background-color", "white")
        .style("border", "solid")
        .style("border-width", "2px")
        .style("border-radius", "5px")
        .style("padding", "5px");

</script>