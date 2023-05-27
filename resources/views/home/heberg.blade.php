<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hébergement</title>
    <style type="text/css">
        body {

            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;

        }

        .header {
            margin-top: 0;
            height: 300px;
            background-image: url({{asset('assets/images/pic5.jpg')}} );
            background-repeat: no-repeat;
            background-size: 100% 100%;

            color: #F5B041;
            text-align: center;

            padding: 30px;
            font-size: 36px;
            text-shadow: 2px 2px #000;

        }
        .header h2 {
            margin-top: 100px;
        }



        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);

            height: 500px;

            display: flex;
        }

        .card1:hover {
            padding: 10px;
        }
        .card2:hover{
            padding: 10px;
        }
        .card3:hover{
            padding: 10px;
        }

        .card1 , .card2 , .card3 {

            width: 30%;
            height: 400px;
            margin: 20px auto;
            box-shadow: 5px 10px 18px #888888;
            transition: 1 s;


            border-style: groove;
            text-align: center;
            background-color: #F5B041; ;
            color: white;
        }

        .img{
            height: 300px;
            border-radius: 5px 5px 0 0;
            position: relative;

        }
        .title{
            text-align: center;
            color: #F5B041;;
        }
        .container2{
            width: 70%;
            height: 750px;

            margin : 10px auto;

            text-indent: 20px;
            font-size: 20px;
            padding: 35px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            background-color: #e8e8e8;

        }

        td {
            text-align: left;
        }
        table{
            width: 95%;
            margin: 10px auto;
        }
        textarea{
            width: 800px;
            height: 70px;
        }
        .combo{
            font-family: Arial;
            padding: 8px 16px;
            border: 1px solid #F5B041;
            background-color: #F5B041;
            color:white ;
            border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
            cursor: pointer;

        }

        select {
            cursor: pointer;
            display: inline-block;
            position: relative;
            font-size: 16px;
            color: $select-color;
            width: $select-width;
            height: $select-height;
        }

        input[type=radio]{

            accent-color: #F5B041 ;
        }
        .bn{
            display: flex;
            margin : 10px auto;

        }
        .btn{
            margin: 10px auto;
            height: 60px;
            width: 250px;
            font-family: Arial;
            font-size: 22px;
            color: white;
            background-color: #F5B041 ;
            border: 1px solid #F5B041;

        }
        .back{
            background-color: #B2D2A4 ;
        }

    </style>
</head>
<body>
<header class="header">
    <h2> Hébergement </h2>
</header>
<div class="container">
    <h2 class="title"> Les Maison De L'association </h2>


    <div class="card">
        <div class="card1">
            <img class="img" src={{asset('assets/images/pic1.jpg')}}  style="width:100%">
            <div class="nom">
                <h4><b> Dar badr 01 </b></h4>
                <p> Pour Homme </p>
            </div>
        </div>
        <div class="card2">
            <img class="img" src={{asset('assets/images/pic2.jpg')}} style="width:100%">
            <div class="nom">
                <h4><b>Dar badr 02</b></h4>
                <p> Pour Homme/Femme </p>
            </div>
        </div>
        <div class="card3">
            <img class="img" src={{asset('assets/images/pic3.jpg')}}  style="width:100%">
            <div class="nom">
                <h4><b>Dar Ihsan</b></h4>
                <p>Pour Femme</p>
            </div>

        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="back" >

        <div class="container2">
            <h2 class="title">Demande De l'hébergement </h2> <hr>
            <form method="post" action="{{ url('/hebergs') }}">
                @csrf
                <table  cellpadding="10px" cellspacing="5px"> <tr>
                        <td colspan="1"> <p > Quel est votre sexe :</p> </td>
                          <td style="text-align: right;"><input  type="radio" id="femme" name="sexe" value="femme"></td>
                         <td>  <label for="femme">Femme</label><br></td>
                         <td>  <input type="radio" id="homme" name="sexe"  value="homme"> </td>
                         <td>  <label for="homme">Homme</label><br> </td>
                    </tr>
                    <tr>
                        <td colspan="2"> <label for="maison">Quelle est la maison dans laquelle vous souhaitez résider :</label> </td>
                        <td>

                            <select class="combo" name="maison" id="maison" >
                                <option value="" disabled selected hidden >Choisir Un Maison</option>
                                <option value="darBadr1">Dar Badr 01</option>
                                <option value="darBadr2">Dar Badr 02</option>
                                <option value="darIhsan">Dar Ihsan</option>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"> <label  for="date_entrir">Quelle est la date de votre arrivée :</label></td>
                        <td>  <input  class="combo" type="date" id="date_entrir" name="date_entrir"> </td>
                    </tr>
                    <tr>
                        <td colspan="2"> <label class="lab" for="date_sortir">Quelle est la date de votre départ :</label></td>
                        <td>  <input  class="combo" type="date" id="date_sortir" name="date_sortir"> </td>
                    </tr>
                    <tr>
                        <td colspan="1"> <p > Est-ce que tu as besoin d'un garde-malade : </p> </td>
                         <td  style="text-align: right;">  <input type="radio" name="gard"  value="Oui"> </td>
                          <td> <label for="Oui">Oui</label><br> </td>
                          <td> <input type="radio" name="gard" value="Non"> </td>
                          <td> <label for="Non">Non</label><br> </td>
                    </tr>
                    <tr>
                        <td colspan="2"> 	<p > Pourquoi as-tu besoin d'un garde-malade : </p> </td>
                    </tr>
                    <tr>
                        <td colspan="4">  <textarea id="besoin" name="besoin" rows="4" cols="100"> </textarea> </td>
                    </tr>
                </table>
            </form>
            <div class="bn">
                <button class="btn" type="button" >Confirmer le demande</button>
                <button class="btn" type="button" >Annuler le demande </button>
                <button class="btn" type="button" >Modifier les dates</button>
            </div>
        </div>
    </div>


</div>
<script type="text/javascript">

    // JavaScript code to disable a specific option in the combo box
    const radioButtons = document.getElementsByName("sexe");
    const comboBox = document.getElementById("maison");

    for (let i = 0; i < radioButtons.length; i++) {
        radioButtons[i].addEventListener("click", function() {
            if (radioButtons[i].value === "femme") {
                comboBox.options[1].disabled = true; // disable Item 1
                comboBox.options[3].disabled = false;
            }
            if (radioButtons[i].value === "homme") {
                comboBox.options[3].disabled = true; // disable Item 3
                comboBox.options[1].disabled = false;
            }


        });
    }

</script>
</body>
</html>
