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
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>
<script src="https://d3js.org/d3-color.v1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<style>
    ul.col{
        display: flex;
        flex-wrap: wrap;
    }
    li.col {
        flex-basis: 30%;
        display: block;
        padding-left: 1em;
    }

</style>
<!-- Load color scale -->

<h3 style="text-align: center; padding-left: 5%; padding-right: 5%;">В разделе представлена инфографика о городах-участниках проекта &laquo;Взаимообучение городов&raquo;, которые транслируют эффективные практики в системе образования, и городах, которые применяют их в своей деятельности</h3>
<!-- Create a div where the graph will take place -->
<div class="uk-grid">
    <div class="uk-width-medium-4-5" id="draw-panel">
    </div>
    <div class="uk-width-medium-1-5">
        <div class="uk-panel uk-panel-box"><div id="control-panel"></div>
        </div>
        <p style="margin-top:20px; text-align: left; padding-left:10px; font-size: 18px; font-weight: bold; text-decoration: underline;" id="contact"></p>
    </div>
    <div id="contactForm" class="modal" style="left: 35% !important;">
        <h3>Связаться с нами</h3>
        {rsform 49}
    </div>

</div>

<script type="text/javascript">
    let cityData = {
        "children": [
            {
                "Name": "Взаимообучение городов",
                "City": "Москва",
                "Count": "92",
                "Link": "https://mcrkpo.ru/upravlentsam/depozitarij.html",
                "id": "19",
                "Category": "",
                "Partners": [{"name": "Архангельск"}, {"name": "Ачинск"}, {"name": "Балаково"}, {"name": "Барнаул"}, {"name": "Белгород"}, {"name": "Березники"}, {"name": "Бийск"}, {"name": "Братск	"}, {"name": "Брянск"}, {"name": "Великий Новгород"}, {"name": "Владимир"}, {"name": "Волгоград"}, {"name": "Волжский"}, {"name": "Воронеж"}, {"name": "Выборг"}, {"name": "Димитровград"}, {"name": "Дзержинск"}, {"name": "Евпатория"}, {"name": "Екатеринбург"}, {"name": "Елец"}, {"name": "Златоуст"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Йошкар-Ола"}, {"name": "Иркутск"}, {"name": "Казань"}, {"name": "Калининград"}, {"name": "Калуга"}, {"name": "Каспийск"}, {"name": "Кемерово"}, {"name": "Киров"}, {"name": "Кисловодск"}, {"name": "Коломна"}, {"name": "Кострома"}, {"name": "Краснодар"}, {"name": "Красноярск"}, {"name": "Курган"}, {"name": "Курск"}, {"name": "Липецк"}, {"name": "Магнитогорск"}, {"name": "Миасс"}, {"name": "Москва"}, {"name": "Набережные Челны"}, {"name": "Находка"}, {"name": "Нефтекамск"}, {"name": "Нефтеюганск"}, {"name": "Нижневартовск"}, {"name": "Нижний Новгород"}, {"name": "Новокузнецк"}, {"name": "Новомосковск"}, {"name": "Новороссийск"}, {"name": "Новосибирск"}, {"name": "Ногинск"}, {"name": "Обнинск"}, {"name": "Омск"}, {"name": "Оренбург"}, {"name": "Орел"}, {"name": "Пенза"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Псков"}, {"name": "Пятигорск"}, {"name": "Ростов-на-Дону"}, {"name": "Рубцовск"}, {"name": "Рыбинск"}, {"name": "Рязань"}, {"name": "Салават"}, {"name": "Самара"}, {"name": "Саранск"}, {"name": "Саратов"}, {"name": "Севастополь"}, {"name": "Северск"}, {"name": "Смоленск"}, {"name": "Сочи"}, {"name": "Ставрополь"}, {"name": "Старый Оскол"}, {"name": "Тамбов"}, {"name": "Тверь"}, {"name": "Тольятти"}, {"name": "Томск"}, {"name": "Тюмень"}, {"name": "Улан-Удэ"}, {"name": "Ульяновск"}, {"name": "Уфа"}, {"name": "Хабаровск"}, {"name": "Чебоксары"}, {"name": "Челябинск"}, {"name": "Чита"}, {"name": "Элиста"}, {"name": "Энгельс"}, {"name": "Якутск"}, {"name": "Ярославль"}]
            },
            {
                "Name": "Система аттестации руководителей образовательных организаций",
                "City": "Москва",
                "Count": "20",
                "Link": "https://mcrkpo.ru/attest-rukovod-kadrov/normativnaya-baza-po-attestatsii.html",
                "id": "2",
                "Category": "Подготовка управленческих кадров",
                "Partners": [{"name": "Архангельск"}, {"name": "Барнаул"}, {"name": "Екатеринбург"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Краснодар"}, {"name": "Магнитогорск"}, {"name": "Новомосковск"}, {"name": "Орел"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Салават"}, {"name": "Саратов"}, {"name": "Тверь"}, {"name": "Томск"}, {"name": "Уфа"}, {"name": "Якутск"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },
            {
                "Name": "Менторинг в системе образования",
                "City": "Москва",
                "Count": "17",
                "Link": "https://mcrkpo.ru/mentori.html",
                "id": "3",
                "Category": "Подготовка управленческих кадров",
                "Partners": [{"name": "Архангельск"}, {"name": "Балаково"}, {"name": "Владимир"}, {"name": "Выборг"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Магнитогорск"}, {"name": "Новомосковск"}, {"name": "Омск"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Салават"}, {"name": "Сочи"}, {"name": "Тверь"}, {"name": "Тамбов"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },

            {
                "Name": "Управленческий проект",
                "City": "Москва",
                "Count": "20",
                "Link": "https://mcrkpo.ru/upravlentsam/upravlencheskie-proekty-direktorov-shkol.html",
                "id": "4",
                "Category": "Подготовка управленческих кадров",
                "Partners": [{"name": "Архангельск"}, {"name": "Балаково"}, {"name": "Барнаул"}, {"name": "Выборг"}, {"name": "Екатеринбург"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Магнитогорск"}, {"name": "Набережные Челны"}, {"name": "Новомосковск"}, {"name": "Омск"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Саратов"}, {"name": "Смоленск"}, {"name": "Сочи"}, {"name": "Тверь"}, {"name": "Томск"}, {"name": "Волгоград"}]
            },
            {
                "Name": "Формирование крупных образовательных комплексов ",
                "City": "Москва",
                "Count": "20",
                "Link": "https://mcrkpo.ru/book/#p=55",
                "id": "4",
                "Category": "Интеграция образовательных ресурсов",
                "Partners": [{"name": "Архангельск"}, {"name": "Белгород"}, {"name": "Барнаул"}, {"name": "Выборг"}, {"name": "Екатеринбург"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Нефтеюганск"}, {"name": "Новомосковск"}, {"name": "Петрозаводск"}, {"name": "Прокопьевск"}, {"name": "Саратов"}, {"name": "Салават"}, {"name": "Тверь"}, {"name": "Челябинск"}, {"name": "Якутск"}, {"name": "Волгоград"}]
            },
            {
                "Name": "Московская олимпиада школьников",
                "City": "Москва",
                "Count": "8",
                "Link": "http://mos.olimpiada.ru/",
                "id": "5",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Архангельск"}, {"name": "Барнаул"}, {"name": "Кемерово"}, {"name": "Магнитогорск"}, {"name": "Омск"}, {"name": "Петрозаводск"}, {"name": "Иваново"}, {"name": "Саранск"}]
            },
            {
                "Name": "Ресурсный класс",
                "City": "Москва",
                "Count": "2",
                "Link": "https://school.moscow/dirnavigator/1/365",
                "id": "55",
                "Category": "Инклюзивная среда",
                "Partners": [{"name": "Новомосковск"}, {"name": "Уфа"}]
            },
            {
                "Name": "Олимпиада \"История и культура храмов столицы\"",
                "City": "Москва",
                "Count": "6",
                "Link": "https://mosmetod.ru/metodicheskoe-prostranstvo/nachalnaya-shkola/orkse/olimpiady-konkursy/moskovskaya-gorodskaya-issledovatelskaya-kulturologicheskaya-olimpiada-istoriya-i-kultura-khramov-stolitsy.html",
                "id": "6",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Архангельск"}, {"name": "Омск"}, {"name": "Тверь"}, {"name": "Якутск"}, {"name": "Омск"}, {"name": "Тверь"}]
            },

            {
                "Name": "Мегарпроект \"Московская электронная школа\"",
                "City": "Москва",
                "Count": "9",
                "Link": "https://school.moscow/projects/mesh",
                "id": "7",
                "Category": "Московская электронная школа",
                "Partners": [{"name": "Балаково"}, {"name": "Братск"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Орел"}, {"name": "Тамбов"}, {"name": "Улан-Удэ"}, {"name": "Волгоград"}]
            },

            {
                "Name": "\"Инженерный класс в московской школе\"",
                "City": "Москва",
                "Count": "10",
                "Link": "http://profil.mos.ru/inj/o-proekte.html",
                "id": "8",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Балаково"}, {"name": "Барнаул"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Тверь"}, {"name": "Нефтеюганск"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },

            {
                "Name": "\"Медицинский класс в московской школе\"",
                "City": "Москва",
                "Count": "7",
                "Link": "http://profil.mos.ru/med/o-proekte.html",
                "id": "9",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Барнаул"}, {"name": "Белгород"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Ижевск"}, {"name": "Тверь"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },

            {
                "Name": "\"Кадетский класс в московской школе\"",
                "City": "Москва",
                "Count": "17",
                "Link": "http://profil.mos.ru/kadet/o-proekte.html",
                "id": "10",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Барнаул"}, {"name": "Белгород"}, {"name": "Бийск"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Иваново"}, {"name": "Ижевск"}, {"name": "Калуга"}, {"name": "Кемерово"}, {"name": "Магнитогорск"}, {"name": "Нефтеюганск"}, {"name": "Новомосковск"}, {"name": "Салават"}, {"name": "Тверь"}, {"name": "Челябинск"}, {"name": "Саранск"}, {"name": "Волгоград"}]
            },

            {
                "Name": "\"Субботы московского школьника\"",
                "City": "Москва",
                "Count": "8",
                "Link": "https://school.moscow/projects/events",
                "id": "11",
                "Category": "Дополнительное образование",
                "Partners": [{"name": "Барнаул"}, {"name": "Братск"}, {"name": "Выборг"}, {"name": "Иваново"}, {"name": "Калуга"}, {"name": "Кемерово"}, {"name": "Орел"}, {"name": "Салават"}]
            },


            {
                "Name": "\"Математическая вертикаль\"",
                "City": "Москва",
                "Count": "3",
                "Link": "https://school.moscow/projects/vertical",
                "id": "12",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Белгород"}, {"name": "Магнитогорск"}, {"name": "Саранск"}]
            },

            {
                "Name": "\"Академический (научно-технологический) класс в московской школе\"",
                "City": "Москва",
                "Count": "2",
                "Link": "http://profil.mos.ru/ntek/o-proekte.html ",
                "id": "13",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Братск"}, {"name": "Кемерово"}]
            },

            {
                "Name": "Кружки от чемпионов",
                "City": "Москва",
                "Count": "3",
                "Link": "https://school.moscow/projects/lesson-from-champions",
                "id": "14",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Братск"}, {"name": "Ижевск"}, {"name": "Якутск"}]
            },

            {
                "Name": "Подготовка победителей \"JuniorSkills Russia\"",
                "City": "Москва",
                "Count": "4",
                "Link": "https://worldskills.ru/final/naczionalnyij-final/juniorskills.html",
                "id": "15",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Ижевск"}, {"name": "Новомосковск"}, {"name": "Петрозаводск"}, {"name": "Саратов"}]
            },

            {
                "Name": "Подготовка победителей Национального чемпионата \"Абилимпикс\"",
                "City": "Москва",
                "Count": "3",
                "Link": "http://eduprof.ru/abilympics/",
                "id": "16",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Ижевск"}, {"name": "Кемерово"}, {"name": "Петрозаводск"}]
            },

            {
                "Name": "Интеграция общего и дополнительного образования на основе детско-юношеского образовательного туризма",
                "City": "Сочи",
                "Count": "3",
                "Link": "https://docplayer.ru/69693825-Proekt-organizacionno-soderzhatelnaya-model-integracii-obshchego-i-dopolnitelnogo-obrazovaniya-na-osnove-detsko-yunosheskogo-obrazovatelnogo-turizma.html",
                "id": "17",
                "Category": "Дополнительное образование",
                "Partners": [{"name": "Новороссийск"}, {"name": "Краснодар"}, {"name": "Тольятти"}]
            },
            {
                "Name": "\"Классный руководитель - руководитель класса\"",
                "City": "Москва",
                "Count": "4",
                "Link": "https://mcrkpo.ru/upravlentsam/rukovoditel-klassa.html",
                "id": "18",
                "Category": "Подготовка управленческих кадров",
                "Partners": [{"name": "Магнитогорск"}, {"name": "Саратов"}, {"name": "Тамбов"}, {"name": "Тверь"}]
            },

            {
                "Name": "Социальное партнерство в дошкольном образовании",
                "City": "Сочи",
                "Count": "1",
                "Link": "http://www.sochi.edu.ru/activity/innovatsionnaya-deyatelnost/innovatsionnye-ploshchadki.php",
                "id": "20",
                "Category": "Дошкольное образование",
                "Partners": [{"name": "Краснодар"}]
            },

            {
                "Name": "Проект \"Растим будущих инженеров\"",
                "City": "Казань",
                "Count": "1",
                "Link": "http://kazanobr.ru/node/8833",
                "id": "21",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Уфа"}]
            },

            {
                "Name": "Ресурсный центр инклюзивного образования",
                "City": "Самара",
                "Count": "1",
                "Link": "https://www.niasam.ru/Obschestvo/Otkrylsya-pervyj-v-Samarskoj-oblasti-resursnyj-tsentr-inklyuzivnogo-obrazovaniya-89360.html",
                "id": "22",
                "Category": "Инклюзивная среда",
                "Partners": [{"name": "Уфа"}]
            },

            {
                "Name": "\"Сетевая организация профильного обучения в школах\"",
                "City": "Омск",
                "Count": "1",
                "Link": "https://omgpu.ru/razvitie-setevogo-profilnogo-obucheniya-v-omskoj-oblasti",
                "id": "23",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Уфа"}]
            },


            {
                "Name": "Олимпиада \"Парки. Музеи. Усадьбы\"",
                "City": "Москва",
                "Count": "2",
                "Link": "https://museum.olimpiada.ru/",
                "id": "24",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Омск"}, {"name": "Тверь"}]
            },

            {
                "Name": "Подготовка победителей Всероссийской олимпиады профессионального мастерства",
                "City": "Москва",
                "Count": "2",
                "Link": "https://spo.mosmetod.ru/olimp",
                "id": "25",
                "Category": "Выявление и развитие талантов",
                "Partners": [{"name": "Петрозаводск"}, {"name": "Смоленск"}]
            },

            {
                "Name": "Подготовка победителей чемпионата \"WorldSkills Russia\"",
                "City": "Москва",
                "Count": "1",
                "Link": "https://worldskills.moscow/",
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
                "Link": "https://mcrkpo.ru/upravlentsam/obuchenie/vzaimoobuchenie-moskovskikh-shkol.html",
                "id": "27",
                "Category": "Подготовка управленческих кадров",
                "Partners": [{"name": "Ижевск"}, {"name": "Балаково"}]
            },

            {
                "Name": "\"Эффективная начальная школа\"",
                "City": "Москва",
                "Count": "1",
                "Link": "http://www.ug.ru/archive/74445",
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
                "Link": "http://www.turizmbrk.ru/page/page55.html",
                "id": "29",
                "Category": "Дополнительное образование",
                "Partners": [{"name": "Сочи"}]
            },
            {
                "Name": "Университетские субботы",
                "City": "Москва",
                "Count": "1",
                "Link": "http://us.educom.ru/about",
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
                "Link": "http://archive.admbal.ru/content/bilet-v-budushchee",
                "id": "32",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Выборг"}, {"name": "Ижевск"}]
            },

            {
                "Name": "Организация альтернативных форм предоставления дошкольного образования",
                "City": "Белгород",
                "Count": "1",
                "Link": "https://www.beluo31.ru/doc/post36.pdf",
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
                "Link": "http://gov.cap.ru/Content/orgs/GovId_121/ot_frebelya_do_robota.pdf",
                "id": "34",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Белгород"}]
            },

            {
                "Name": "\"ТИКО-конструирование и робототехника в дошкольном образовании\"",
                "City": "Екатеринбург",
                "Count": "1",
                "Link": "http://rnp.irro.ru/index.php?cid=564",
                "id": "35",
                "Category": "Дошкольное образование",
                "Partners": [{"name": "Белгород"}]
            },

            {
                "Name": "Образовательный проект \"ТЕХНОСИТИ\"",
                "City": "Магнитогорск",
                "Count": "1",
                "Link": "http://cpkimr.ru/Downloads/Deiatel/TEMP/%D0%9F%D1%80%D0%B8%D0%BA%D0%B0%D0%B7_%D0%A2%D0%B5%D1%85%D0%BD%D0%BE%D0%BF%D0%B0%D1%80%D0%BA.pdf",
                "id": "36",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Челябинская область"}]
            },

            {
                "Name": "Образовательный проект \"ТЕМП\"",
                "City": "Челябинск",
                "Count": "1",
                "Link": "http://ipk74.ru/upload/iblock/afc/afcbb930d72480dbf4cb6895334eb000.pdf",
                "id": "37",
                "Category": "Предпрофессиональное образование",
                "Partners": [{"name": "Магнитогорск"}]
            },

            {
                "Name":"Партнерство ВУЗа и школы - эффективная профориентация старшеклассников",
                "City": "Красноярск",
                "Count": "1",
                "Link": "http://www.wikiregstandard.ru/index.php/%D0%9E%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5_%D0%BF%D1%80%D0%B0%D0%BA%D1%82%D0%B8%D0%BA%D0%B8_%D0%BE%D1%80%D0%B3%D0%B0%D0%BD%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D0%B8_%D0%BF%D1%80%D0%BE%D1%84%D0%BE%D1%80%D0%B8%D0%B5%D0%BD%D1%82%D0%B0%D1%86%D0%B8%D0%BE%D0%BD%D0%BD%D0%BE%D0%B9_%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D1%8B_%D0%B2_%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%BE%D1%8F%D1%80%D1%81%D0%BA%D0%BE%D0%BC_%D0%BA%D1%80%D0%B0%D0%B5",
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
    let colors = {
        "Предпрофессиональное образование": "rgb(31, 119, 180)",
        "Дошкольное образование": "rgb(227, 119, 194)",
        "Подготовка управленческих кадров": "rgb(44, 160, 44)",
        "Начальное образование" : "rgb(23, 190, 207)",
        "Московская электронная школа" : "rgb(30, 230, 189)",
        "Интеграция образовательных ресурсов" : "rgb(188, 189, 34)",
        "Инклюзивная среда" : "rgb(148, 103, 189)",
        "Дополнительное образование" : "rgb(140, 86, 75)",
        "Выявление и развитие талантов" : "rgb(255, 127, 14)",
        "" : "rgb(214, 39, 40)"
    };
    console.log("colors");
    console.log(colors);
    let middleCounter = 9;
    makeCreatorCityFilter();
    makeParticipantCityFilter();
    makeCategoryFilter();
    makeContactForm();
    makeChart(cityData, cityFilters);
    document.addEventListener('mousemove', mousePosition);
    let mouseX;
    let mouseY;
    function mousePosition(e) {
        mouseX = e['pageX'] || e.clientX;
        mouseY = e['pageY'] || e.clientY;
    }
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
            console.log(d);
            if (d.data.Opacity === 1){
                Tooltip.id = d.data.id;

                if (Tooltip.style("opacity") === "1") {
                    Tooltip
                        .style("opacity", 0)
                        .style("left", "-1000px")
                        .style("top", "-1000px")
                        .transition().duration(500);
                    console.log("Mouse click - Hide");

                    //TODO: Make
                    // comeDown();
                }else {
                    Tooltip
                        .style("opacity", 1)

                        .html("<h5>Реализуется в городах:</h5><ul class='col'>" + d.data.Partners.map(x => '<li class="col" key = ' + x.name + '>' + x.name + '</li>').join(' ') + "</ul>" + "<strong><a target='_blank' href='" + d.data.Link + "'>Подробнее о проекте</a></strong>")
                        // .style("left", (d.x) + "px")
                        // .style("top", (d.y) + "px")
                        // .style("left", (mouseX) + "px")
                        // .style("top", (mouseY - diameter) + "px")
                        .style("left", (d.x + d3.mouse(this)[0]+ 30) + "px")
                        .style("top", (d.y + d3.mouse(this)[1] + 30) + "px")
                        .style("class", "bubble-tooltip")
                        .transition().duration(500);
                    console.log('d3.mouse(this)[0]');
                    console.log(mouseX);
                    console.log(mouseY);
                    // .attr("transform", (d) => "translate(" + d.x + "," + d.y + ")opacity(" + 1 + ")");
                    console.log("Mouse click - Show");
                    d3.event.stopPropagation();
                }
            }

        };
        let comeUp = function (d) {
            console.log(d.data.id)
            if (d.data.Opacity === 1){
                this.parentNode.appendChild(this);
                d3.select(this).transition().duration(100)

                    .attr("transform", (d) => "translate(" + d.x + "," + d.y + ")scale(" + 1.2 + ")")
                    // .attr('stroke', function (d) { return d3.hsl("steelblue"); })

                    .attr('stroke-width', '5px');
            }

        };

        let comeDown =  function (d) {

            if (Tooltip.style("opacity") === "0" || d.data.id !== Tooltip.id) {
                d3.select(this).transition().duration(500)
                    .attr("transform", (d) => "translate(" + d.x + "," + d.y + ")scale(" + 1 + ")")
                    .attr('stroke-width', '1px');
            }
        };

        let hideTooltip = function(){
            Tooltip.style("opacity", 0)
                .style("left", "-1000px")
                .style("top", "-1000px");
            console.log("hideTooltip")
        }


        // let diameter = document.getElementById('draw-panel').offsetWidth;
        let diameter = 1200;
        let color = d3.scaleOrdinal(d3.schemeCategory10);
        let bubble = d3.pack(dataset)
            .size([diameter, diameter])
            .padding(5);
        let svg = d3.select("#draw-panel")
            .append("svg")
            .attr("id", "svg")
            .attr("width", diameter)
            .style("margin-top", "-70px")
            .style('z-index', 1)
            .attr("height", diameter)
            .attr('viewBox','0 0 '+Math.min(diameter,diameter)+' '+Math.min(diameter,diameter))
            .attr('preserveAspectRatio','xMinYMin')
            .attr("class", "bubble")
            .attr("id", "bubble")
            .on("click", hideTooltip);
        let nodes = d3.hierarchy(dataset)
            .sum(function(d) { return Math.floor((middleCounter + d.Count * 0.9) * Math.floor(15)); });
        let node = svg.selectAll("node")
            .data(bubble(nodes).descendants())
            .enter()
            .filter((d)=> !d.children)
            .append("g")
            .style("opacity", (d)=> d.data.Opacity)
            .style('position', 'absolute')
            .attr('stroke', function (d) { return d3.hsl("#ececec"); })
            .attr('stroke-width', '1px')
            .attr("transform", "translate(" + Math.min(diameter,diameter) / 2 + "," + Math.min(diameter,diameter) / 2 + ")")
            .on("mouseover", comeUp)
            .on("mouseout", comeDown)
            .attr("class", "node")
            .attr("transform", (d) => "translate(" + d.x + "," + d.y + ")");
        node.append("circle")
            .attr("id", guid())
            .attr("r", function(d) {
                return d.r;
            })
            .style("fill", (d,i)  => d3.hsl(colors[d.data.Category]))
        console.log("d");
        console.log(d3.hsl(colors['Предпрофессиональное образование']));

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
            .attr('preserveAspectRatio','xMinYMin')
            .attr('viewBox','0 0 '+Math.min(diameter,diameter)+' '+Math.min(diameter,diameter))
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
            let u = cities.filter(onlyUnique).sort();
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
            u = u.filter(onlyUnique).sort();
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
                if (cityData['children'][v]['Category'] !== ""){
                    categories.push(cityData['children'][v]['Category']);
                }
            }
            let u = categories.filter(onlyUnique).sort();
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

