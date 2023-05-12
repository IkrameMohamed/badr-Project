<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
   <style>

    body {
  background-color: lightgray;
  display: flex;
  justify-content: center;
  align-items: center;
}
.container {
  background-color: #B2D2A4 ;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
  width: 600px;
  text-align: center;
}

h1 {
  text-align: center;
  color: #fd7e14;
}

form {
  max-width: 400px;
  margin: 20px auto;
  text-align: center;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"],
input[type="file"] {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  box-sizing: border-box;
  background-color: white;
}

input[type="submit"] {
  margin-top: 20px;
   width: 100%;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
  background-color: #fd7e14;
  font-size: 22px;
}

   </style>
  </head>
  <body>
    <div class="container">
    <h1>Sign Up</h1>
    <form action="">
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom">
      </div>
      <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="numeroTel">Numéro de Téléphone</label>
        <input type="tel" id="numeroTel" name="numeroTel">
      </div>
      <div class="form-group">
        <label for="motDePasse">Mot de Passe</label>
        <input type="password" id="motDePasse" name="motDePasse">
      </div>
      <div class="form-group">
        <label for="dossierMedical">Dossier Médical</label>
        <input type="file" id="dossierMedical" name="dossierMedical">
      </div>
      <input type="submit" value="Sign Up">
    </form>
  </div>
  </body>
</html>
