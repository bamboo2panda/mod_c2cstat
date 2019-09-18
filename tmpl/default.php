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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<!-- Load color scale -->
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>
<script src="https://test1.mioo.ru/media/mod_c2cstat/js/chosen_v1.8.7/chosen.jquery.min.js"></script>
<h3 style="text-align: center; padding-left: 200px; padding-right: 200px;">В разделе представлена инфографика о городах-участниках проекта &laquo;Взаимообучение городов&raquo;, которые транслируют эффективные практики в системе образования и города, которые применяют их в своей деятельности</h3>
<!-- Create a div where the graph will take place -->
<div class="uk-grid">
    <div class="uk-width-medium-4-5" id="draw-panel">
    </div>
    <div class="uk-width-medium-1-5">
        <div class="uk-panel uk-panel-box"><div id="control-panel"></div>
        </div>
        <p style="margin-top:20px; text-align: right;" id="contact"></p>
    </div>
    <div id="contactForm" class="modal" style="left: 35% !important;">
        <label>Сообщение</label><br /><textarea placeholder="Сообщение"></textarea><br />
        <label>Email</label><br /><input type="email" placeholder="example@example.com"><br /><br />
        <button type="submit">Отправить</button>
        <a href="#" rel="modal:close">Закрыть окно</a>
    </div>

</div>

<script type="text/javascript">
    let cityData = {
        "children": [

            {
                "Name": "Система аттестации руководителей образовательных организаций",
                "City": "Москва",
                "Count": "20",
                "Link": "#",
                "id": "2",
                "Category": "Подготовка управленческих кадров",
                "Partners": [{"name": "Архангельск"}, {"name": "Барнаул"}, {"name": "Екатеринбург"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Краснодар"}, {"name": "Магнитогорск"}, {"name": "Новомосковск"}, {"name": "Орел"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Салават"}, {"name": "Саратов"}, {"name": "Тверь"}, {"name": "Томск"}, {"name": "Уфа"}, {"name": "Якутск"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },
            {
                "Name": "Менторинг в системе образования",
                "City": "Москва",
                "Count": "17",
                "Link": "#",
                "id": "3",
                "Category": "Подготовка управленческих кадров",
                "Partners": [{"name": "Архангельск"}, {"name": "Балаково"}, {"name": "Владимир"}, {"name": "Выборг"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Магнитогорск"}, {"name": "Новомосковск"}, {"name": "Омск"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Салават"}, {"name": "Сочи"}, {"name": "Тверь"}, {"name": "Тамбов"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },
            {
                "Name": "Управленческий проект",
                "City": "Москва",
                "Count": "20",
                "Link": "#",
                "id": "4",
                "Category": "Подготовка управленческих кадров",
                "Partners": [{"name": "Архангельск"}, {"name": "Балаково"}, {"name": "Барнаул"}, {"name": "Выборг"}, {"name": "Екатеринбург"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Магнитогорск"}, {"name": "Набережные Челны"}, {"name": "Новомосковск"}, {"name": "Омск"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Саратов"}, {"name": "Смоленск"}, {"name": "Сочи"}, {"name": "Тверь"}, {"name": "Томск"}, {"name": "Волгоград"}]
            },
            {
                "Name": "Формирование крупных образовательных комплексов ",
                "City": "Москва",
                "Count": "20",
                "Link": "#",
                "id": "4",
                "Category": "Интеграция образовательных ресурсов",
                "Partners": [{"name": "Архангельск"}, {"name": "Белгород"}, {"name": "Барнаул"}, {"name": "Выборг"}, {"name": "Екатеринбург"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Нефтеюганск"}, {"name": "Новомосковск"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Саратов"}, {"name": "Салават"}, {"name": "Тверь"}, {"name": "Челябинск"}, {"name": "Якутск"}, {"name": "Волгоград"}]
            },
            {
                "Name": "Московская олимпиада школьников",
                "City": "Москва",
                "Count": "8",
                "Link": "#",
                "id": "5",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Архангельск"}, {"name": "Барнаул"}, {"name": "Кемерово"}, {"name": "Магнитогорск"}, {"name": "Омск"}, {"name": "Петрозаводск"}, {"name": "Иваново"}, {"name": "Саранск"}]
            },
            {
                "Name": "Ресурсный класс",
                "City": "Москва",
                "Count": "2",
                "Link": "#",
                "id": "55",
                "Category": "Инклюзивная среда",
                "Partners": [{"name": "Новомосковск"}, {"name": "Уфа"}]
            },
            {
                "Name": "Олимпиада \"История и культура храмов столицы\"",
                "City": "Москва",
                "Count": "6",
                "Link": "#",
                "id": "6",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Архангельск"}, {"name": "Омск"}, {"name": "Тверь"}, {"name": "Якутск"}, {"name": "Омск"}, {"name": "Тверь"}]
            },

            {
                "Name": "Мегарпроект \"Московская электронная школа\"",
                "City": "Москва",
                "Count": "9",
                "Link": "#",
                "id": "7",
                "Category": "Московская электронная школа",
                "Partners": [{"name": "Балаково"}, {"name": "Братск"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Орел"}, {"name": "Тамбов"}, {"name": "Улан-Удэ"}, {"name": "Волгоград"}]
            },

            {
                "Name": "\"Инженерный класс в московской школе\"",
                "City": "Москва",
                "Count": "10",
                "Link": "#",
                "id": "8",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Балаково"}, {"name": "Барнаул"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Тверь"}, {"name": "Нефтеюганск"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },

            {
                "Name": "\"Медицинский класс в московской школе\"",
                "City": "Москва",
                "Count": "7",
                "Link": "#",
                "id": "9",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Барнаул,Белгород"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Ижевск"}, {"name": "Тверь"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },

            {
                "Name": "\"Кадетский класс в московской школе\"",
                "City": "Москва",
                "Count": "17",
                "Link": "#",
                "id": "10",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Барнаул"}, {"name": "Белгород"}, {"name": "Бийск"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Калуга"}, {"name": "Кемерово"}, {"name": "Магнитогорск"}, {"name": "Нефтеюганск"}, {"name": "Новомосковск"}, {"name": "Салават"}, {"name": "Тверь"}, {"name": "Челябинск"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },

            {
                "Name": "\"Субботы московского школьника\"",
                "City": "Москва",
                "Count": "8",
                "Link": "#",
                "id": "11",
                "Category": "Дополнительное образование",
                "Partners": [{"name": "Барнаул"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Иваново"}, {"name": "Калуга"}, {"name": "Кемерово"}, {"name": "Орел"}, {"name": "Салават"}]
            },


            {
                "Name": "\"Математическая вертикаль\"",
                "City": "Москва",
                "Count": "3",
                "Link": "#",
                "id": "12",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Белгород"}, {"name": "Магнитогорск"}, {"name": "Саранск"}]
            },

            {
                "Name": "\"Академический (научно-технологический) класс в московской школе\"",
                "City": "Москва",
                "Count": "2",
                "Link": "#",
                "id": "13",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Братск"}, {"name": "Кемерово"}]
            },

            {
                "Name": "Кружки от чемпионов",
                "City": "Москва",
                "Count": "3",
                "Link": "#",
                "id": "14",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Братск"}, {"name": "Ижевск"}, {"name": "Якутск"}]
            },

            {
                "Name": "Подготовка победителей \"JuniorSkills Russia\"",
                "City": "Москва",
                "Count": "4",
                "Link": "#",
                "id": "15",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Ижевск"}, {"name": "Новомосковск"}, {"name": "Петрозаводск"}, {"name": "Саратов"}]
            },

            {
                "Name": "Подготовка победителей Национального чемпионата \"Абилимпикс\"",
                "City": "Москва",
                "Count": "3",
                "Link": "#",
                "id": "16",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Петрозаводск"}]
            },

            {
                "Name": "Интеграция общего и дополнительного образования на основе детско-юношеского образовательного туризма",
                "City": "Сочи",
                "Count": "3",
                "Link": "#",
                "id": "17",
                "Category": "Дополнительное образование",
                "Partners": [{"name": "Новороссийск"}, {"name": "Краснодар"}, {"name": "Тольятти"}]
            },
            {
                "Name": "\"Классный руководитель - руководитель класса\"",
                "City": "Москва",
                "Count": "4",
                "Link": "#",
                "id": "18",
                "Category": "Подготовка управленческих кадров",
                "Partners": [{"name": "Магнитогорск"}, {"name": "Саратов"}, {"name": "Тамбов"}, {"name": "Тверь"}]
            },
            {
                "Name": "Взаимообучение городов",
                "City": "Москва",
                "Count": "5",
                "Link": "#",
                "id": "19",
                "Category": "",
                "Partners": [{"name": "Архагельск"}, {"name": "Улан-Удэ"}, {"name": "Кемерово"}, {"name": "Грозный"}, {"name": "Новосибирск"}]
            },
            {
                "Name": "Социальное партнерство в дошкольном образовании",
                "City": "Сочи",
                "Count": "1",
                "Link": "#",
                "id": "20",
                "Category": "Дошкольное образование",
                "Partners": [{"name": "Краснодар"}]
            },

            {
                "Name": "Проект \"Растим будущих инженеров\"",
                "City": "Казань",
                "Count": "1",
                "Link": "#",
                "id": "21",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Уфа"}]
            },

            {
                "Name": "Ресурсный центр инклюзивного образования",
                "City": "Самара",
                "Count": "1",
                "Link": "#",
                "id": "22",
                "Category": "Инклюзивное образования",
                "Partners": [{"name": "Уфа"}]
            },

            {
                "Name": "\"Сетевая организация профильного обучения в школах\"",
                "City": "Омск",
                "Count": "1",
                "Link": "#",
                "id": "23",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Уфа"}]
            },


            {
                "Name": "Олимпиада \"Парки. Музеи. Усадьбы\"",
                "City": "Москва",
                "Count": "2",
                "Link": "#",
                "id": "24",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Омск"}, {"name": "Тверь"}]
            },

            {
                "Name": "Подготовка победителей Всероссийской олимпиады профессионального мастерства",
                "City": "Москва",
                "Count": "2",
                "Link": "#",
                "id": "25",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Петрозаводск"}, {"name": "Смоленск"}]
            },

            {
                "Name": "Подготовка победителей чемпионата \"WorldSkills Russia\"",
                "City": "Москва",
                "Count": "1",
                "Link": "#",
                "id": "26",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Петрозаводск"}]
            },

            // {
            //     "Name": "Олимпиада \"История и культура храмов столицы\"",
            //     "City": "Москва",
            //     "Partners": [{"name": "Якутск"}, {"name": "Омск"}, {"name": "Тверь"}]
            // },
            //
            {
                "Name": "Взаимообучение школ",
                "City": "Москва",
                "Count": "2",
                "Link": "#",
                "id": "27",
                "Category": "Подготовка управленческих кадров",
                "Partners": [{"name": "Ижевск"}, {"name": "Балаково"}]
            },

            {
                "Name": "\"Эффективная начальная школа\"",
                "City": "Москва",
                "Count": "1",
                "Link": "#",
                "id": "28",
                "Category": "Начальное образование",
                "Partners": [{"name": "Сочи"}]
            },
            // {
            //     "Name": "Директорские  субботы",
            //     "City": "Москва",
            //     "Count": "1",
            //     "Link": "#",
            //     "id": "",
            //     "Category": "",
            //     "Partners": [{"name": "Сочи"}
            //     ]
            // },
            {
                "Name": "Музейная педагогика",
                "City": "Брянск",
                "Count": "1",
                "Link": "#",
                "id": "29",
                "Category": "Дополнительное образование",
                "Partners": [{"name": "Сочи"}]
            },
            {
                "Name": "Университетские субботы",
                "City": "Москва",
                "Count": "1",
                "Link": "#",
                "id": "30",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Ульяновск"}]
            },

            // {
            //     "Name": "Проект \"Ресурсный класс\"",
            //     "City": "Москва",
            //     "Count": "2",
            //     "Link": "#",
            //     "id": "31",
            //     "Category": "",
            //     "Partners": [{"name": "Новомосковск"}, {"name": "Уфа"}]
            // },


            {
                "Name": "Ранняя профориентация школьников \"Билет в будущее\"",
                "City": "Балаково",
                "Count": "2",
                "Link": "#",
                "id": "32",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Выборг"}, {"name": "Ижевск"}]
            },

            {
                "Name": "Организация альтернативных форм предоставления дошкольного образования",
                "City": "Белгород",
                "Count": "1",
                "Link": "#",
                "id": "33",
                "Category": "Дошкольное образование",
                "Partners": [{"name": "Южно-Сахалинск"}]
            },
            //
            // {"Name": "Областной проект \"Георгиевский сбор\"", "City": "Курск", "Partners": [{"name": "Белгород"}]},

            {
                "Name": "От Фребеля до робота: растим будущих инженеров",
                "City": "Самара",
                "Count": "1",
                "Link": "#",
                "id": "34",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Белгород"}]
            },

            {
                "Name": "\"ТИКО-конструирование и робототехника в дошкольном образовании\"",
                "City": "Екатеринбург",
                "Count": "1",
                "Link": "#",
                "id": "35",
                "Category": "Дошкольное образование",
                "Partners": [{"name": "Белгород"}]
            },

            {
                "Name": "Образовательный проект \"ТЕХНОСИТИ\"",
                "City": "Магнитогорск",
                "Count": "1",
                "Link": "#",
                "id": "36",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Челябинская область"}]
            },

            {
                "Name": "Образовательный проект \"ТЕМП\"",
                "City": "Челябинск",
                "Count": "1",
                "Link": "#",
                "id": "37",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Магнитогорск"}]
            },

            {
                "Name":"Партнерство ВУЗа и школы - эффективная профориентация старшеклассников",
                "City": "Красноярск",
                "Count": "1",
                "Link": "#",
                "id": "38",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Волгоград"}]
            }
        ]
    };
    let cityFilters = [];
    cityFilters['creators'] = [];
    cityFilters['participants'] = [];
    cityFilters['category'] = [];
    let middleCounter = 9;
    makeCreatorCityFilter();
    makeParticipantCityFilter();
    makeCategoryFilter();
    makeContactForm();
    makeChart(cityData, cityFilters);

    function guid() {
        function _p8(s) {
            let p = (Math.random().toString(16)+"000000000").substr(2,8);
            return s ? "-" + p.substr(0,4) + "-" + p.substr(4,4) : p ;
        }
        return _p8() + _p8(true) + _p8(true) + _p8();
    }
    function makeChart(data, filters){
        if (document.getElementById("bubble")) {
            document.getElementById("bubble").remove()
        }
        let dataset = Object.assign({},data);

        dataset['children'].forEach(function (item, i, arr) {
            item['Opacity']  = 1
            let partnersArray = Object.values(item['Partners']).map(({name})=>[name]).reduce((a, b) => a.concat(b), []);
            if ((filters['creators'] !== null && filters['creators'].length > 0) && !filters['creators'].includes(item['City'])) {
                item['Opacity']  = 0.1
            }
            if ((filters['participants'] !== null && filters['participants'].length > 0) && !(filters['participants'].filter(value => partnersArray.includes(value)).length > 0)) {
                item['Opacity']  = 0.1
            }
            if ((filters['category'] !== null && filters['category'].length > 0) && !filters['category'].includes(item['Category'])) {
                item['Opacity']  = 0.1
            }

        });
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
                    .html("<h5>Реализуется в городах:</h5><ul>" + d.data.Partners.map(x => '<li key = ' + x.name + '>' + x.name + '</li>').join(' ') + "</ul>" + "<a href='" + d.data.Link + "'>Подробнее о проекте</a>")
                    .style("left", (d.x + d3.mouse(this)[0]+ 30) + "px")
                    .style("top", (d.y + d3.mouse(this)[1] + 30) + "px")
                    .style("class", "bubble-tooltip")
                    .transition(1000);
            }
        };

        let diameter = 1200;
        let color = d3.scaleOrdinal(d3.schemeCategory10);
        let bubble = d3.pack(dataset)
            .size([diameter, diameter])
            .padding(5);
        let svg = d3.select("#draw-panel")
            .append("svg")
            .attr("width", diameter)
            .style("margin-top", "-100px")
            .attr("height", diameter)
            .attr('viewBox','0 0 '+Math.min(diameter,diameter)+' '+Math.min(diameter,diameter))
            .attr('preserveAspectRatio','xMinYMin')
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
            // .style("opacity", 1)
            .style("opacity", (d)=> d.data.Opacity)
            .attr("transform", "translate(" + Math.min(diameter,diameter) / 2 + "," + Math.min(diameter,diameter) / 2 + ")")
            .on("mouseover", function (d) {
                d3.select(this).transition().duration(50)

                    .attr("transform", (d) => "translate(" + d.x + "," + d.y + ")scale(" + 1.2 + ")")
            })
            .on("mouseout", function (d) {
                d3.select(this).transition().duration(50)

                    .attr("transform", (d) => "translate(" + d.x + "," + d.y + ")scale(" + 1 + ")")
            })
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
            let fieldName = $('<h2/>',{text:'Поиск по параметрам'});
            let cityListName = $('<h5/>',{text:'Город-транслятор'});
            let cityList = $('<select/>',{id:'cityCreatorListSelect', class:'js-example-basic-multiple',name: '[]', multiple:"multiple", onChange:'updateCreatorCityFilter()', style:'margin-bottom: 10px;'});
            uniqCities().forEach(function (item) {
                $('<option />', {value: item, text: item}).appendTo(cityList);
            })
            fieldName.appendTo('#control-panel')
            cityListName.appendTo('#control-panel')
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
            let cityListName = $('<h5/>',{text:'Город-пользователь'});
            let cityList = $('<select/>',{id:'cityParticipantListSelect', class:'js-example-basic-multiple',name: '[]', multiple:"multiple", onChange:'updateParticipantCityFilter()'});
            uniqCities().forEach(function (item) {
                $('<option />', {value: item, text: item}).appendTo(cityList);
            })
            cityListName.appendTo('#control-panel')
            cityList.appendTo('#control-panel');
            $('#cityParticipantListSelect').select2();
        })(jQuery);
    }
    function makeCategoryFilter(){
        let uniqCategories =  function () {
            function onlyUnique(value, index, self) {
                return self.indexOf(value) === index;
            }
            let categories = []
            for (let v in cityData['children']){
                categories.push(cityData['children'][v]['Category'])
            }
            let u = categories.filter(onlyUnique);
            return u
        };

        (function($){
            let categoryListName = $('<h5/>',{text:'Направления'});
            let categoryList = $('<select/>',{id:'categorySelect', class:'js-example-basic-multiple',name: '[]', multiple:"multiple", onChange:'updateCategoryFilter()', style:'margin-bottom: 10px;'});
            uniqCategories().forEach(function (item) {
                $('<option />', {value: item, text: item}).appendTo(categoryList);
            })
            categoryListName.appendTo('#control-panel')
            categoryList.appendTo('#control-panel');
            $('#categorySelect').select2();
        })(jQuery);
    }
    function makeContactForm(){
        (function($){

            let contactFormButton = $('<a/>',{href:'#contactForm', rel:'modal:open', id:'contactButton', text:'Связаться с нами'});
            contactFormButton.appendTo('#contact');


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
    function updateCategoryFilter(){
        (function($){
            if ($("#categorySelect").val() !== null) {
                cityFilters['category'] = $("#categorySelect").val()
            }else{
                cityFilters['category'] = []
            }
            makeChart(cityData, cityFilters)
        })(jQuery);
    }
</script>

