<!DOCTYPE html>
<html>
<head>
    <title>Rendez-vous</title>

    <style type="text/css">
        :root {
            --dark-text: #f8fbff;
            --light-body: #f3f8fe;
            --light-main: #fdfdfd;
            --light-second: #c3c2c8;
            --light-hover: #f0f0f0;
            --light-text: #151426;
            --light-btn: #9796f0;
            --blue: #0000ff;
            --white: #fff;
            --shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            --font-family: consolas;
        }
        body {
            background-color: #B2D2A4 ;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            margin-top: 0;
            height: 400px;
            background-image: url({{asset('assets/images/rnv3.jpg')}} );
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #333;
            color: #F5B041;
            justify-content: center;
            align-items: center;
            font-size: 36px;
            text-shadow: 2px 2px #000;
            position: relative;
            display: flex;
        }
        .con{
            width: 100%;
            height: 100%;
            position: absolute;
            background-color: rgba(178, 210, 164,0.0);
            margin: 0;

        }
        .header h2 {
            margin-top: 100px;
            z-index: 1;
        }

        .container {
            background-color: #F2F4F4;
            width: 60%;
            border: 	#B2D2A4  solid;
            border-radius: 20px;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        label ::first{
            margin-top: 30px ;
            color: #F5B041;

        }

        select {

            margin: 10px auto;

            border-style:  solid;
            border-radius: 5px;
            width: 50%;
            height: 40px;
            background-color: #eee;
            font-size: 18px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
        }
        .p , optgroup {
            font-size: 20px;
            font-weight: bold;

        }
        .contianer2 {
            width: max-content ;
            height: max-content ;
            position: relative;
            display: flex;
            padding: 2% 0px 0px 0px;
            justify-content: center;
            top: 10%;
            right: 0%;
            width: 100%;
            height: 100%;
        }
        .calendar {
            height: 600px;
            width: max-content;
            background-color: white;
            border-radius: 25px;
            overflow: hidden;
            padding: 30px 50px 0px 50px;
        }
        .calendar {
            box-shadow: var(--shadow);
        }
        .calendar-header {
            background: #B2D2A4 ;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 700;
            color: var(--white);
            padding: 10px;
        }
        .calendar-body {
            pad: 10px;
        }
        .calendar-week-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            font-weight: 600;
            cursor: pointer;
            color:rgb(104, 104, 104);
        }
        .calendar-week-days div:hover {
            color:black;
            transform: scale(1.2);
            transition: all .2s ease-in-out;
        }
        .calendar-week-days div {
            display: grid;
            place-items: center;
            color: var(--bg-second);
            height: 50px;
        }
        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            color: var(--color-txt);
        }
        .calendar-days div {
            width: 37px;
            height: 33px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            position: relative;
            cursor: pointer;
            animation: to-top 1s forwards;
        }
        .month-picker {
            padding: 5px 10px;
            border-radius: 10px;
            cursor: pointer;
        }
        .month-picker:hover {
            background-color: #B2D2A4 ;
        }
        .month-picker:hover {
            color: var(--color-txt);
        }
        .year-picker {
            display: flex;
            align-items: center;
        }
        .year-change {
            height: 30px;
            width: 30px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            margin: 0px 10px;
            cursor: pointer;
        }
        .year-change:hover {

            transition:all .2s ease-in-out ;
            transform: scale(1.12);
        }
        .year-change:hover pre {
            color: var(--bg-body);
        }
        .calendar-footer {
            padding: 10px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        #year:hover{
            cursor: pointer;
            transform: scale(1.2);
            transition: all 0.2 ease-in-out;
        }
        .calendar-days div span {
            position: absolute;
        }
        .calendar-days div:hover {
            transition: width 0.2s ease-in-out, height 0.2s ease-in-out;
            background-color: #F5B041;
            border-radius: 20%;
            color: var(--dark-text);
        }
        .calendar-days div.current-date {
            color: var(--dark-text);
            background-color: #B2D2A4 ;
            border-radius: 20%;
        }
        .month-list {
            position: relative;
            left: 0;
            top: -50px;
            background-color: #ebebeb;
            color: var(--light-text);
            display: grid;
            grid-template-columns: repeat(3, auto);
            gap: 5px;
            border-radius: 20px;
        }
        .month-list > div {
            display: grid;
            place-content: center;
            margin: 5px 10px;
            transition: all 0.2s ease-in-out;
        }
        .month-list > div > div {
            border-radius: 15px;
            padding: 10px;
            cursor: pointer;
        }
        .month-list > div > div:hover {
            background-color:#F5B041;
            color: var(--dark-text);
            transform: scale(0.9);
            transition: all 0.2s ease-in-out;
        }
        .month-list.show {
            visibility: visible;
            pointer-events: visible;
            transition: 0.6s ease-in-out;
            animation: to-left .71s forwards;
        }
        .month-list.hideonce{
            visibility: hidden;
        }
        .month-list.hide {
            animation: to-right 1s forwards;
            visibility: none;
            pointer-events: none;
        }
        .date-time-formate {
            width: max-content;
            height: max-content;
            font-family: Dubai Light, Century Gothic;
            position: relative;
            display: inline;
            top: 140px;
            justify-content: center;
        }
        .day-text-formate {
            font-family: Microsoft JhengHei UI;
            font-size: 1.4rem;
            padding-right: 5%;
            border-right: 3px solid #F5B041;
            position: absolute;
            left: -1rem;
        }
        .date-time-value {
            display: block;
            height: max-content;
            width: max-content;
            position: relative;
            left: 40%;
            top: -18px;
            text-align: center;
        }
        .time-formate {
            font-size: 1.5rem;
        }
        .time-formate.hideTime {
            animation: hidetime 1.5s forwards;
        }
        .day-text-formate.hidetime {
            animation: hidetime 1.5s forwards;
        }
        .date-formate.hideTime {
            animation: hidetime 1.5s forwards;
        }
        .day-text-formate.showtime{
            animation: showtime 1s forwards;
        }
        .time-formate.showtime {
            animation: showtime 1s forwards;
        }
        .date-formate.showtime {
            animation: showtime 1s forwards;
        }
        @keyframes to-top {
            0% {
                transform: translateY(0);
                opacity: 0;
            }
            100% {
                transform: translateY(100%);
                opacity: 1;
            }
        }
        @keyframes to-left {
            0% {
                transform: translatex(230%);
                opacity: 1;
            }
            100% {
                transform: translatex(0);
                opacity: 1;
            }
        }
        @keyframes to-right {
            10% {
                transform: translatex(0);
                opacity: 1;
            }
            100% {
                transform: translatex(-150%);
                opacity: 1;
            }
        }
        @keyframes showtime {
            0% {
                transform: translatex(250%);
                opacity: 1;
            }
            100% {
                transform: translatex(0%);
                opacity: 1;
            }
        }
        @keyframes hidetime {
            0% {
                transform: translatex(0%);
                opacity: 1;
            }
            100% {
                transform: translatex(-370%);
                opacity: 1;
            }
        }
        @media (max-width:375px) {
            .month-list>div{

                margin: 5px 0px;
            }
        }
        .btn{
            margin: 20px ;
            display: flex;
        }
        .btn1 , .btn2{
            background-color: #FFD580;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 20px;

        }


    </style>
</head>
<body>
<header class="header">
    <h2>Rendez-vous </h2>
    <div class="con"></div>
</header>
<div class="container">
    <form method="POST" action="{{ route('makeRnv') }}">
        @csrf
    <label > <h3 style="color:#F5B041;">Choisir un type de visite:</h3></label>

    <select id="first-list" onchange="filterSecondList()">
        <option value="" disabled selected hidden >Choisir Un Visite</option>
        <optgroup label="Radiologeu">
            <option value="1-1">Scanner</option>
            <option value="1-2">IRM</option>
            <option value="1-3">Echographie</option>
            <option value="1-4">Mamographie</option>
            <option value="1-5">Scientigraphie</option>
            <option value="1-6">Coloscopie</option>
            <option value="1-7">Radiographie</option>
            <option value="1-8">Biopsie</option>
            <option value="1-9">Radiographie Diamond</option>
        </optgroup>
        <option class="p" value="2"> Médecin généraliste </option>
        <option class="p" value="3">Médecin spécialiste</option>
        <option class="p" value="4">Labo et les analyses</option>
    </select>

    <label > <h3 style="color:#F5B041;">Choisir un médecin:</h3></label>
    <select id="second-list" >
        <option value=""  disabled selected hidden data-filter="1 2 3 4" >Choisir Un Medecin</option>
        <option value="a"  data-filter="1-1 1-2 1-3 1-4 1-5 1-6 1-7">Dr Lakhal</option>
        <!--be showed if either option 1 or option 2 is selected in the first select list. -->
        <option value="b"  data-filter="1-1 1-2 1-3 1-4 1-5 1-6 1-7">Dr Zaid</option>
        <option value="c" data-filter="1-1 1-2 1-3 1-4 1-5 1-6 1-7 1-8">Dr Missoum</option>
        <option value="d"  data-filter="1-1 1-2 1-3 1-7">Dr Bouras</option>
        <option value="e"  data-filter="1-1 1-2 1-3 1-4 1-6 1-7 4">Dr Naili</option>
        <option value="f"  data-filter="3">Cardiologue Boumahdi</option>
        <option value="g"  data-filter="3">Cardiologue Lekhal Cabinet Ferhat</option>
        <option value="h"  data-filter="4">Dr Medah</option>
        <option value="i"  data-filter="4">Dr Zemouri</option>
        <option value="g"  data-filter="4">Dr khatib</option>
        <option value="k"  data-filter="4">Dr Kara</option>
        <option value="l"  data-filter="1-9">L'hopital Fabor</option>
        <option value="m"  data-filter="2">Dr Bn Dahbia</option>
        <option value="n"  data-filter="2">Dr Osalem</option>
        <option value="o"  data-filter="2">Dr Mansour</option>
    </select>

    <label id="doctor-label"></label>
    <label id="doctor-info"></label>

    <label for="date"> <h3 style="color:#F5B041;">Choisir une Date:</h3></label>

    <div class="contianer2">
        <div class="calendar">
            <div class="calendar-header">
                <span class="month-picker" id="month-picker"> May </span>
                <div class="year-picker" id="year-picker">
            <span class="year-change" >

            </span>
                    <span id="year">2023 </span>
                    <span class="year-change" >

            </span>
                </div>
            </div>

            <div class="calendar-body">
                <div class="calendar-week-days">
                    <div>Dim</div>
                    <div>Lun</div>
                    <div>Mar</div>
                    <div>Mer</div>
                    <div>Jeu</div>
                    <div>Fend</div>
                    <div>Sam</div>
                </div>
                <div class="calendar-days">
                </div>
            </div>
            <div class="calendar-footer">
            </div>
            <div class="date-time-formate">
                <div class="day-text-formate">Aujourd'hui</div>
                <div class="date-time-value">
                    <div class="time-formate">02:51:20</div>
                    <div class="date-formate">23 - july - 2022</div>
                </div>
            </div>
            <div class="month-list"></div>
        </div>
    </div>

    <div class="btn">
        <button type="button" class="btn1"  disabled >Prendre un Rendez-vous</button>
        <button type="button" class="btn2"  disabled >Annuler le Rendez-vous</button>
    </div>
    </form>
 </div>

<script type="text/javascript">

    //to display some values in the second list according to the first list

    function filterSecondList() {
        var firstListValue = document.getElementById("first-list").value;
        var secondList = document.getElementById("second-list");
        var options = secondList.getElementsByTagName("option");

        for (var i = 0; i < options.length; i++) {
            var filterValues = options[i].getAttribute("data-filter").split(" ");

            if (filterValues.indexOf(firstListValue) === -1) {
                options[i].style.display = "none";
            } else {
                options[i].style.display = "";
            }
        }
    }

    // to show to discount of the doctor

    const doctorInfo = [
        { name: "Dr Lakhal", Promotion: "30%" },
        { name: "Dr Zaid", Promotion: "50%" },
        { name: "Dr Missoum", Promotion: "50%"},
        { name: "Dr Bouras", Promotion: "50% pour les enfant uniquement" },
        { name: "Dr Naili", Promotion: "50%" },
        { name: "Cardiologue Boumahdi", Promotion: "50%"},
        { name: "Cardiologue Lekhal Cabinet Ferhat", Promotion: "100% gratuit" },
        { name: "Dr Medah", Promotion: "100% gratuit" },
        { name: "Dr Zemouri", Promotion: "100% gratuit"},
        { name: "Dr khatib", Promotion: "50%" },
        { name: "Dr Kara", Promotion: "40%" },
        { name: "L'hopital Fabor", Promotion: "100%" },
        { name: "Dr Bn Dahbia", Promotion: "60%" },
        { name: "Dr Osalem", Promotion: "100% gratuit"},
        { name: "Dr Mansour", Promotion: "80%" }

    ];


    const select = document.getElementById("second-list");
    const label = document.getElementById("doctor-label");
    const info = document.getElementById("doctor-info");

    select.addEventListener("change", function() {
        const selectedOption = select.options[select.selectedIndex];
        const selectedDoctor = doctorInfo.find(doctor => doctor.name === selectedOption.text);

        label.innerText = selectedDoctor.name;
        info.innerText = `Promotion: ${selectedDoctor.Promotion}`;
    });









    //the calender

    const isLeapYear = (year) => {
        return (
            (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) ||
            (year % 100 === 0 && year % 400 === 0)
        );
    };
    const getFebDays = (year) => {
        return isLeapYear(year) ? 29 : 28;
    };
    let calendar = document.querySelector('.calendar');
    const month_names = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];
    let month_picker = document.querySelector('#month-picker');
    const dayTextFormate = document.querySelector('.day-text-formate');
    const timeFormate = document.querySelector('.time-formate');
    const dateFormate = document.querySelector('.date-formate');
    const button1 = document.querySelector('.btn1');
    const button2 = document.querySelector('.btn2');


    const generateCalendar = (month, year) => {
        let calendar_days = document.querySelector('.calendar-days');
        calendar_days.innerHTML = '';
        let calendar_header_year = document.querySelector('#year');
        let days_of_month = [
            31,
            getFebDays(year),
            31,
            30,
            31,
            30,
            31,
            31,
            30,
            31,
            30,
            31,
        ];

        let currentDate = new Date();

        month_picker.innerHTML = month_names[month];

        calendar_header_year.innerHTML = year;

        let first_day = new Date(year, month);



        for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {

            let day = document.createElement('div');

            if (i >= first_day.getDay()) {
                day.innerHTML = i - first_day.getDay() + 1;

                if (i - first_day.getDay() + 1 === currentDate.getDate() &&
                    year === currentDate.getFullYear() &&
                    month === currentDate.getMonth()
                ) {
                    day.classList.add('current-date');
                }
                day.addEventListener('click', () => {
                    button1.disabled = false;
                    button1.style.backgroundColor = '#F5B041';
                    button1.style.cursor= 'pointer';
                    day.style.backgroundColor='#F5B041';
                    console.log("dd",day)
                });
                button1.addEventListener('click', () => {
                    button2.disabled = false;
                    button2.style.backgroundColor = '#F5B041';
                    button2.style.cursor= 'pointer';

                });

                button2.addEventListener('click', () => {
                    const cd = document.querySelector('.current-date');
                    day.style.backgroundColor='white';
                    day.style.color='black';
                    cd.style.backgroundColor='#B2D2A4 ';
                    button2.disabled=true;
                    button1.disabled=true;
                    button1.style.backgroundColor='#FFD580';
                    button2.style.backgroundColor='#FFD580';
                });

            }


            calendar_days.appendChild(day);

        }
    };



    let month_list = calendar.querySelector('.month-list');
    month_names.forEach((e, index) => {
        let month = document.createElement('div');
        month.innerHTML = `<div>${e}</div>`;

        //i deleted 2 things

    });

    (function () {
        month_list.classList.add('hideonce');
    })();

    //make changes


    let currentDate = new Date();
    let currentMonth = { value: currentDate.getMonth() };
    let currentYear = { value: currentDate.getFullYear() };
    generateCalendar(currentMonth.value, currentYear.value);

    const todayShowTime = document.querySelector('.time-formate');
    const todayShowDate = document.querySelector('.date-formate');

    const currshowDate = new Date();
    const showCurrentDateOption = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        weekday: 'long',
    };
    const currentDateFormate = new Intl.DateTimeFormat(

        showCurrentDateOption
    ).format(currshowDate);
    todayShowDate.textContent = currentDateFormate;
    setInterval(() => {
        const timer = new Date();
        const option = {
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
        };
        const formateTimer = new Intl.DateTimeFormat('en-us', option).format(timer);
        let time = `${`${timer.getHours()}`.padStart(
            2,
            '0'
        )}:${`${timer.getMinutes()}`.padStart(
            2,
            '0'
        )}: ${`${timer.getSeconds()}`.padStart(2, '0')}`;
        todayShowTime.textContent = formateTimer;
    }, 1000);

</script>
</body>
</html>
