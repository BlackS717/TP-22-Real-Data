<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recherche</title>
</head>

<body>


  <h2>Recherche</h2>
  <form action="../traitement/traitement_recherche.php" method="get">
    <div class="form-group">
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom" placeholder="RAKOTO" />
      <br><br>
      <label for="Prenom">Prenom :</label>
      <input type="text" id="Prenom" name="prenom" placeholder="Kevin" />
      <br><br>
      <label for="nom">Age min :</label>
      <input type="number" id="ageMin" name="ageMin" placeholder="18" />
      <br><br>
      <label for="Prenom">Age max :</label>
      <input type="number" id="ageMax" name="ageMax" placeholder="70" />
      <br><br>
      <label for="Prenom">Departmement :</label>
      <input type="text" id="departement" name="departement" placeholder="Development" />

    </div>
    <br>
    <button type="submit" class="btn-login">Se connecter</button>
  </form>


</body>

</html>