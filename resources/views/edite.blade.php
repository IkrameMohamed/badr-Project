<!DOCTYPE html>
<html lang="en">
  <head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="C:\Users\BOUMDHAL Ahlem\Desktop\pfe\firstlogo.png">
<link rel="icon" type="image/png" href="image/firstlogo.png">
<title>
   Acces admin
</title>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

<link id="pagestyle" href="css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
<style>
      html, body {
      display: flex;
      justify-content: center;
      font-family: Roboto, Arial, sans-serif;
      font-size: 15px;
      }
      form {
      border: 5px solid #f1f1f1;
      }
      input[type=text], input[type=password] {
      width: 100%;
      padding: 16px 8px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
      }
      .icon {
      font-size: 110px;
      display: flex;
      justify-content: center;
      color: #4286f4;
      }
      button {
      background-color: #4286f4;
      color: white;
      padding: 14px 0;
      margin: 10px 0;
      border: none;
      cursor: grab;
      width: 48%;
      }
      h1 {
      text-align:center;
      fone-size:18;
      }
      button:hover {
      opacity: 0.8;
      }
      .formcontainer {
      text-align: center;
      margin: 24px 50px 12px;
      }
      .container {
      padding: 16px 0;
      text-align:left;
      }
      span.psw {
      float: right;
      padding-top: 0;
      padding-right: 15px;
      }
      /* Change styles for span on extra small screens */
      @media screen and (max-width: 500px) {
      span.psw {
      display: block;
      float: none;
      }
    </style>
</head>

  <body class="g-sidenav-show  bg-gray-100">




    <form action="{{url('updatedata/'.$VisitTypes->id)}}" method="post">

    @csrf
    @method('PUT')
    <h1>Modifier la quantite</h1>
      <div class="icon">
        <i class="fas fa-user-circle"></i>
      </div>
      <div class="formcontainer">
      <div class="container">


      <label for=""><strong>Nom de produit</strong></label>

      <input type="text" placeholder="type" value='{{$VisitTypes->name}}' name="name" id="nom" required>


      </div>
      <button type="submit"><strong>Modifier</strong></button>

      <br>
      <button><strong><a href="/type">retour</a></strong></button>

    </form>

       </main>
  </body>

</html>
