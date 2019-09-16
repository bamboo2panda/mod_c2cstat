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

?>


<!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>
<script src="https://test1.mioo.ru/media/mod_c2cstat/js/chosen/chosen.jquery.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<!-- Load color scale -->
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>
<script src="https://test1.mioo.ru/media/mod_c2cstat/js/chosen_v1.8.7/chosen.jquery.min.js"></script>

<!-- Create a div where the graph will take place -->
<div class="uk-grid">
    <div class="uk-width-medium-4-5" id="draw-panel">
    </div>
    <div class="uk-width-medium-1-5">
        <div class="uk-panel uk-panel-box"><div id="control-panel"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    let cityData = {
        "children": [

            {
                "Name": "Рейтингование образовательных организаций",
                "City": "Москва",
                "Count": "18",
                "Link": "#",
                "Partners": [{"name": "Архангельск"}, {"name": "Балаково"}, {"name": "Барнаул"}, {"name": "Владимир"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Калуга"}, {"name": "Кемерово"}, {"name": "Магнитогорск"}, {"name": "Набережные Челны"}, {"name": "Орел"}, {"name": "Петрозаводск"}, {"name": "Салават"}, {"name": "Саратов"}, {"name": "Смоленск"}, {"name": "Тверь"}, {"name": "Сочи"}, {"name": "Волгоград"}]
            },

            {
                "Name": "Аттестация руководителей образовательных организаций",
                "City": "Москва",
                "Count": "20",
                "Link": "#",
                "Partners": [{"name": "Архангельск"}, {"name": "Барнаул"}, {"name": "Екатеринбург"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Краснодар"}, {"name": "Магнитогорск"}, {"name": "Новомосковск"}, {"name": "Орел"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Салават"}, {"name": "Саратов"}, {"name": "Тверь"}, {"name": "Томск"}, {"name": "Уфа"}, {"name": "Якутск"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },
            {
                "Name": "Менторинг в системе образования",
                "City": "Москва",
                "Count": "17",
                "Link": "#",
                "Partners": [{"name": "Архангельск"}, {"name": "Балаково"}, {"name": "Владимир"}, {"name": "Выборг"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Магнитогорск"}, {"name": "Новомосковск"}, {"name": "Омск"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Салават"}, {"name": "Сочи"}, {"name": "Тверь"}, {"name": "Тамбов"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },
            {
                "Name": "Реализация управленческих проектов в деятельности руководителей и управленческих команд образовательных организаций",
                "City": "Москва",
                "Count": "20",
                "Link": "#",
                "Partners": [{"name": "Архангельск"}, {"name": "Балаково"}, {"name": "Барнаул"}, {"name": "Выборг"}, {"name": "Екатеринбург"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Магнитогорск"}, {"name": "Набережные Челны"}, {"name": "Новомосковск"}, {"name": "Омск"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Саратов"}, {"name": "Смоленск"}, {"name": "Сочи"}, {"name": "Тверь"}, {"name": "Томск"}, {"name": "Волгоград"}]
            },
            {
                "Name": "Московская олимпиада школьников",
                "City": "Москва",
                "Count": "8",
                "Link": "#",
                "Partners": [{"name": "Архангельск"}, {"name": "Барнаул"}, {"name": "Кемерово"}, {"name": "Магнитогорск"}, {"name": "Омск"}, {"name": "Петрозаводск"}, {"name": "Иваново"}, {"name": "Саранск"}]
            },
            {
                "Name": "Олимпиада \"История и культура храмов столицы\"",
                "City": "Москва",
                "Count": "6",
                "Link": "#",
                "Partners": [{"name": "Архангельск"}, {"name": "Омск"}, {"name": "Тверь"}, {"name": "Якутск"}, {"name": "Омск"}, {"name": "Тверь"}]
            },

            {
                "Name": "Городской проект \"Московская электронная школа\"",
                "City": "Москва",
                "Count": "9",
                "Link": "#",
                "Partners": [{"name": "Балаково"}, {"name": "Братск"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Орел"}, {"name": "Тамбов"}, {"name": "Улан-Удэ"}, {"name": "Волгоград"}]
            },

            {
                "Name": "Городской проект \"Инженерный класс в московской школе\"",
                "City": "Москва",
                "Count": "10",
                "Link": "#",
                "Partners": [{"name": "Балаково"}, {"name": "Барнаул"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Тверь"}, {"name": "Нефтеюганск"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },

            {
                "Name": "Городской проект \"Медицинский класс в московской школе\"",
                "City": "Москва",
                "Count": "7",
                "Link": "#",
                "Partners": [{"name": "Барнаул,Белгород"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Ижевск"}, {"name": "Тверь"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },

            {
                "Name": "Городской проект \"Кадетский класс в московской школе\"",
                "City": "Москва",
                "Count": "17",
                "Link": "#",
                "Partners": [{"name": "Барнаул"}, {"name": "Белгород"}, {"name": "Бийск"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Калуга"}, {"name": "Кемерово"}, {"name": "Магнитогорск"}, {"name": "Нефтеюганск"}, {"name": "Новомосковск"}, {"name": "Салават"}, {"name": "Тверь"}, {"name": "Челябинск"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },

            {
                "Name": "Городской проект \"Субботы московского школьника\"",
                "City": "Москва",
                "Count": "8",
                "Link": "#",
                "Partners": [{"name": "Барнаул"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Иваново"}, {"name": "Калуга"}, {"name": "Кемерово"}, {"name": "Орел"}, {"name": "Салават"}]
            },

            {
                "Name": "Городской проект \"Математическая вертикаль\"",
                "City": "Москва",
                "Count": "3",
                "Link": "#",
                "Partners": [{"name": "Белгород"}, {"name": "Магнитогорск"}, {"name": "Саранск"}]
            },

            {
                "Name": "Городской проект \"Академический (научно-технологический) класс в московской школе\"",
                "City": "Москва",
                "Count": "2",
                "Link": "#",
                "Partners": [{"name": "Братск"}, {"name": "Кемерово"}]
            },

            {
                "Name": "Кружки от чемпионов",
                "City": "Москва",
                "Count": "3",
                "Link": "#",
                "Partners": [{"name": "Братск"}, {"name": "Ижевск"}, {"name": "Якутск"}]
            },

            {
                "Name": "Опыт Москвы в подготовке победителей \"JuniorSkills Russia\"",
                "City": "Москва",
                "Count": "4",
                "Link": "#",
                "Partners": [{"name": "Ижевск"}, {"name": "Новомосковск"}, {"name": "Петрозаводск"}, {"name": "Саратов"}]
            },

            {
                "Name": "Опыт Москвы в подготовке победителей Национального чемпионата \"Абилимпикс\"",
                "City": "Москва",
                "Count": "3",
                "Link": "#",
                "Partners": [{"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Петрозаводск"}]
            },

            {
                "Name": "Интеграция общего и дополнительного образования на основе детско-юношеского образовательного туризма",
                "City": "Сочи",
                "Count": "3",
                "Link": "#",
                "Partners": [{"name": "Новороссийск"}, {"name": "Краснодар"}, {"name": "Тольятти"}]
            },
            {
                "Name": "Городской проект \"Классный руководитель - руководитель класса\"",
                "City": "Москва",
                "Count": "4",
                "Link": "#",
                "Partners": [{"name": "Магнитогорск"}, {"name": "Саратов"}, {"name": "Тамбов"}, {"name": "Тверь"}]
            },
            {
                "Name": "Взаимообучение городов",
                "City": "Москва",
                "Count": "5",
                "Link": "#",
                "Partners": [{"name": "Архагельск"}, {"name": "Улан-Удэ"}, {"name": "Кемерово"}, {"name": "Грозный"}, {"name": "Новосибирск"}]
            },
            {
                "Name": "Дошкольная образовательная организация как центр социокультурного партнерства  в работе с детьми, охваченными и не охваченными дошкольным образованием",
                "City": "Сочи",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Краснодар"}]
            },

            {
                "Name": "Проект \"Растим будущих инженеров\"",
                "City": "Сургут, Тюмень, Москва, Челябинск, Ижевск, Казань",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Уфа"}]
            },

            {
                "Name": "Ресурсный центр инклюзивного образования",
                "City": "Самара, Псков",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Уфа"}]
            },

            {
                "Name": "Образовательная программа \"Сетевая организация профильного обучения в школах Омска\"",
                "City": "Омск",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Уфа"}]
            },


            {
                "Name": "Олимпиада \"Парки. Музеи. Усадьбы\"",
                "City": "Москва",
                "Count": "2",
                "Link": "#",
                "Partners": [{"name": "Омск"}, {"name": "Тверь"}]
            },

            {
                "Name": "Опыт Москвы в подготовке победителей Всероссийской олимпиады профессионального мастерства",
                "City": "Москва",
                "Count": "2",
                "Link": "#",
                "Partners": [{"name": "Петрозаводск"}, {"name": "Смоленск"}]
            },

            {
                "Name": "Опыт Москвы в подготовке победителей чемпионата \"WorldSkills Russia\"",
                "City": "Москва",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Петрозаводск"}]
            },

            // {
            //     "Name": "Олимпиада \"История и культура храмов столицы\"",
            //     "City": "Москва",
            //     "Partners": [{"name": "Якутск"}, {"name": "Омск"}, {"name": "Тверь"}]
            // },

            {
                "Name": "Взаимообучение школ",
                "City": "Москва",
                "Count": "2",
                "Link": "#",
                "Partners": [{"name": "Ижевск"}, {"name": "Балаково"}]
            },

            {
                "Name": "Городский проект \"Эффективная начальная школа\"",
                "City": "Москва",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Сочи"}]
            },
            {
                "Name": "Директорские  субботы",
                "City": "Москва",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Сочи"}
                ]
            },
            {
                "Name": "Музейная педагогика",
                "City": "Брянск",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Сочи"}]
            },
            {
                "Name": "Университетские субботы",
                "City": "Москва",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Ульяновск"}]
            },

            {
                "Name": "Проект \"Ресурсный класс\"",
                "City": "Москва",
                "Count": "2",
                "Link": "#",
                "Partners": [{"name": "Новомосковск"}, {"name": "Уфа"}]
            },


            {
                "Name": "Проект  ранней профориентации школьников \"Билет в будущее\":организация работы профессионально-ориентированных классов при поддержке социально-ответственного бизнеса",
                "City": "Балаково",
                "Count": "2",
                "Link": "#",
                "Partners": [{"name": "Выборг"}, {"name": "Ижевск"}]
            },

            {
                "Name": "Организация альтернативных форм предоставления дошкольного образования в городе Белгороде",
                "City": "Белгород",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Южно-Сахалинск"}]
            },

            {"Name": "Областной проект \"Георгиевский сбор\"", "City": "Курск", "Partners": [{"name": "Белгород"}]},

            {
                "Name": "От Фребеля до робота: растим будущих инженеров",
                "City": "Самара",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Белгород"}]
            },

            {
                "Name": "Образовательный проект \"ТИКО-конструирование и робототехника в ДОУ\"",
                "City": "Екатеринбург",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Белгород"}]
            },

            {
                "Name": "Образовательный проект \"ТЕХНОСИТИ\"",
                "City": "Магнитогорск",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Челябинская область"}]
            },

            {
                "Name": "Образовательный проект \"ТЕМП\"",
                "City": "Челябинск",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Магнитогорск"}]
            },

            {
                "Name":
                    "Партнерство ВУЗа и школы как возможный путь повышения эффективности профориентационной работы среди старшеклассников",
                "City": "Красноярск",
                "Count": "1",
                "Link": "#",
                "Partners": [{"name": "Волгоград"}]
            }
        ]
    };
    let cityFilters = [];
    cityFilters['creators'] = [];
    cityFilters['participants'] = [];
    let middleCounter = 10;
    makeCreatorCityFilter();
    makeParticipantCityFilter();
    makeChart(cityData, cityFilters);

    function guid() {
        function _p8(s) {
            let p = (Math.random().toString(16)+"000000000").substr(2,8);
            return s ? "-" + p.substr(0,4) + "-" + p.substr(4,4) : p ;
        }
        return _p8() + _p8(true) + _p8(true) + _p8();
    }
    function makeChart(data, filters){
        let dataset = Object.assign({},data);
        if (document.getElementById("bubble")) {
            document.getElementById("bubble").remove()
        }
        if (filters['creators'] !== null && filters['creators'].length > 0) {
            dataset['children'] = dataset['children'].filter(function (i) {
                return filters['creators'].includes(i['City']);
            });
        }
        if (filters['participants'] !== null && filters['participants'].length > 0 ){
            dataset['children'] = dataset['children'].filter(function (i) {
                let partnersArray = Object.values(i['Partners']).map(({name})=>[name]).reduce((a, b) => a.concat(b), []);
                if (filters['participants'].filter(value => partnersArray.includes(value)).length > 0){
                    return true
                }else{
                    return false
                }
            });
        }
        let mouseclick = function(d) {
            if (Tooltip.style("opacity") === "1") {
                Tooltip
                    .style("opacity", 0)
                    .style("left", "0 px")
                    .style("top", "0 px")
                    .transition();
            }else {
                Tooltip
                    .style("opacity", 1)
                    .html("<h5>Реализуют проект:</h5><ul>" + d.data.Partners.map(x => '<li key = ' + x.name + '>' + x.name + '</li>').join(' ') + "</ul>" + "<a href='" + d.data.Link + "'>Ссылка на проект</a>")
                    .style("left", (d.x + d3.mouse(this)[0]+ 30) + "px")
                    .style("top", (d.y + d3.mouse(this)[1] + 30) + "px")
                    .style("class", "bubble-tooltip")
                    .transition(1000);
            }
        }

        let diameter = 1200;
        let color = d3.scaleOrdinal(d3.schemeCategory10);
        let bubble = d3.pack(dataset)
            .size([diameter, diameter])
            .padding(5);
        let svg = d3.select("#draw-panel")
            .append("svg")
            .attr("width", diameter)
            .attr("height", diameter)
            .attr("class", "bubble")
            .attr("id", "bubble");
        let nodes = d3.hierarchy(dataset)
        // .sum(Math.floor(Math.random() * Math.floor(15));
            .sum(function(d) { return Math.floor((middleCounter + d.Count * 0.9) * Math.floor(15)); });
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
            .style("fill", (d,i)  => color(i))
            .style("stroke-width", "10px");
        node.append('foreignObject')
            .attr("id", guid())
            .attr('x', function(d) {
                return - d.r * 0.75;
            })
            .attr('y', function(d) {
                return - d.r *(0.6);
            })
            .attr('width', function(d) {
                return d.r * 1.5;
            })
            .attr('height', function(d) {
                return d.r * 1.5;

            })
            .on("click", mouseclick)
            .on("mouseover", function (d) {

            })
            .style("cursor", "pointer")
            .html(function (d,i) {
                return '<div style="width:' +
                    d.r * 1.5 +
                    'px; background-color: transparent' +
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

        let Tooltip = d3.select("#draw-panel")
            .append("div")
            .style("opacity", 0)
            .attr("class", "tooltip")
            .style("background-color", "white")
            .style("border", "solid")
            .style("border-width", "2px")
            .style("border-radius", "5px")
            .style("padding", "5px");
    }
    function makeCreatorCityFilter(){
        let uniqCities =  function () {
            function onlyUnique(value, index, self) {
                return self.indexOf(value) === index;
            }
            let cities = []
            for (let v in cityData['children']){
                cities.push(cityData['children'][v]['City'])
            }
            let u = cities.filter(onlyUnique);
            return u
        };

        (function($){
            let cityList = $('<select/>',{id:'cityCreatorListSelect', class:'js-example-basic-multiple',name: '[]', multiple:"multiple", onChange:'updateCreatorCityFilter()', style:'margin-bottom: 10px;'});
            uniqCities().forEach(function (item) {
                $('<option />', {value: item, text: item}).appendTo(cityList);
            })
            cityList.appendTo('#control-panel');
            $('#cityCreatorListSelect').select2();
        })(jQuery);
    }
    function makeParticipantCityFilter(){
        let uniqCities =  function () {
            function onlyUnique(value, index, self) {
                return self.indexOf(value) === index;
            }
            let cities = [];
            for (let v in cityData['children']){
                cities.push(cityData['children'][v]['Partners'])
            }
            let u = cities.reduce((a, b) => a.concat(b), []).map(({name})=>[name]).reduce((a, b) => a.concat(b), []);
            u = u.filter(onlyUnique)
             return u
        };

        (function($){
            let cityList = $('<select/>',{id:'cityParticipantListSelect', class:'js-example-basic-multiple',name: '[]', multiple:"multiple", onChange:'updateParticipantCityFilter()'});
            uniqCities().forEach(function (item) {
                $('<option />', {value: item, text: item}).appendTo(cityList);
            })
            cityList.appendTo('#control-panel');
            $('#cityParticipantListSelect').select2();
        })(jQuery);
    }
    function updateCreatorCityFilter(){

        (function($){
            if ($("#cityCreatorListSelect").val() !== null){
                cityFilters['creators'] = $("#cityCreatorListSelect").val()
            }else{
                cityFilters['creators'] = []
            }
            makeChart(cityData, cityFilters);
        })(jQuery);
    }
    function updateParticipantCityFilter(){
        (function($){
            if ($("#cityParticipantListSelect").val() !== null) {
                cityFilters['participants'] = $("#cityParticipantListSelect").val()
            }else{
                cityFilters['participants'] = []
            }
            makeChart(cityData, cityFilters)
        })(jQuery);
    }
</script>


