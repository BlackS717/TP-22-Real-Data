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
      <h2 class="row">Search</h2>

      <form action="./resultat_recherche.php" method="GET" class="form-group row">
        <div class="col-md-6 mb-2">
          <label class="form-label" for="nom">Last name :</label>
          <input class="form-control" type="text" id="nom" name="nom" placeholder="Last name" />
        </div>

        <hr class="d-sm-block d-md-none">

        <div class="col-md-6 mb-2">
          <label class="form-label" for="Prenom">First name :</label>
          <input class="form-control" type="text" id="Prenom" name="prenom" placeholder="First name" />
        </div>

        <hr>

        <div class="col-md-6 mb-2">
          <label class="form-label" for="ageMin">Age min :</label>
          <input class="form-control" type="number" id="ageMin" name="ageMin" placeholder="Minimum age" min="0" />
        </div>

        <hr class="d-sm-block d-md-none">

        <div class="col-md-6 mb-2">
          <label class="form-label" for="ageMax">Age max :</label>
          <input class="form-control" type="number" id="ageMax" name="ageMax" placeholder="Maximum age" min="0" />
        </div>

        <hr>

        <div class="col-md-12 mb-2 row">
          <label class="form-label" for="departement">Department :</label>
          <div class="col-md-6">
            <select class="form-control" name="departement" id="departement">
              <option value="-1">All</option>

              <?php
              foreach ($list_departements as $departement) {
              ?>
                <option value="<?= $departement['dept_no'] ?>"><?= $departement['dept_name'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="col-md-6 form-check">
            <label for="current" class="form-check-label">Show Only Employee in a Department</label>
            <input type="checkbox" name="currentOnly" id="current" class="form-check-input" />
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Search</button>

      </form>
    </div>

  </main>
  <footer class="bg-white shadow-sm pt-2" id="footer">
    <?php include("../inc/footer.php"); ?>
  </footer>
  <script src="../assets/scripts/js/bootstrap.bundle.min.js"></script>

</body>

</html>