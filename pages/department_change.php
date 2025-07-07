<?php 
session_start();
require("../inc/function.php");

$idEmployee = isset($_GET["idEmployee"]) ? $_GET["idEmployee"] : 0;


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
      <h2 class="row">Changer</h2>

      <form action="./traitement_changement_department.php?$idemployee= <?= $idEmployee?>" method="GET" class="form-group row">
        <div class="col-md-6">
          <label class="form-label" for="date">Date de debut :</label>
          <input class="form-control" type="date" id="date" name="Date" placeholder="Date de debut" required/>
        </div>

        <hr>

        <div class="col-md-12">
          <label class="form-label" for="departement">Department :</label>
          <select class="form-control" name="departement" id="departement" required>
            <option value="-1" aria-required="true">All</option>

            <?php
            foreach ($list_departements as $departement) {
            ?>
              <option value="<?= $departement['dept_no'] ?>"><?= $departement['dept_name'] ?></option>
            <?php
            }
            ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Change</button>

      </form>
    </div>

  </main>
  <footer class="bg-white shadow-sm pt-2" id="footer">
    <?php include("../inc/footer.php"); ?>
  </footer>
  <script src="../assets/scripts/js/bootstrap.bundle.min.js"></script>

</body>

</html>