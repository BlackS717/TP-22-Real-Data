<?php
require("../inc/function.php");
$list_departements = getAllDepartement();


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recherche</title>
  <link href="../assets/scripts/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/scripts/css/style.css">
</head>

<body>


  <header class="bg-white shadow-sm container">
    <?php include("../inc/header.php"); ?>
  </header>

  <main>
    <div class="container border">
      <h2 class="row">Recherche</h2>

      <form action="../traitement/traitement_recherche.php" method="get" class="form-group row">
        <div class="col-md-6">
          <label class="form-label" for="nom">Nom :</label>
          <input class="form-control" type="text" id="nom" name="nom" placeholder="Nom" />
        </div>

        <hr class="d-sm-block d-md-none">

        <div class="col-md-6">
          <label class="form-label" for="Prenom">Prenom :</label>
          <input class="form-control" type="text" id="Prenom" name="prenom" placeholder="Prenom" />
        </div>

        <hr>

        <div class="col-md-6">
          <label class="form-label" for="ageMin">Age min :</label>
          <input class="form-control" type="number" id="ageMin" name="ageMin" placeholder="Age minimum" min="0" />
        </div>

        <hr class="d-sm-block d-md-none">

        <div class="col-md-6">
          <label class="form-label" for="ageMax">Age max :</label>
          <input class="form-control" type="number" id="ageMax" name="ageMax" placeholder="Age maximum" min="0"/>
        </div>

        <hr>

        <div class="col-md-12">
          <label class="form-label" for="departement">Departmement :</label>
          <select class="form-control" name="departement" id="departement">
            <option value="-1">Tous les departements</option>

            <?php
            foreach ($list_departements as $departement) {
            ?>
              <option value="<?= $departement['dept_no'] ?>"><?= $departement['dept_name'] ?></option>
            <?php
            }
            ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Rechercher</button>

      </form>
    </div>

  </main>
  <footer class="bg-white shadow-sm pt-2" id="footer">
    <?php include("../inc/footer.php"); ?>
  </footer>
  <script src="../assets/scripts/js/bootstrap.bundle.min.js"></script>

</body>

</html>