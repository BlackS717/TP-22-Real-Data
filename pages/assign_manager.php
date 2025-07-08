<?php
session_start();
require("../inc/function.php");

if (!isset($_GET["idEmployee"])) {
  header("Location: index.php");
}

$idEmployee = $_GET["idEmployee"];

$employee = getEmployee($idEmployee);
$age = getAge($employee);
$name = getName($employee);

$current_department = getCurrentDepartment($idEmployee);
if ($current_department == null) {
  header("Location: fiche_employee.php?employee=" . $idEmployee . "&&error=2");
}

$currentManager = getManagerEnCours($current_department['dept_no']);
$ageManager = getAge($currentManager);
$managerName = getName($currentManager);


$employeePosition = getEmployeeCurrentTitle($idEmployee);
$managerPosition = getEmployeeCurrentTitle($currentManager['emp_no']);


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
    <div class="container mt-3">
      <div class="row">
        <div class="col-md-8 row gap-2">

          <div class="card col-md-5">
            <img src="../assets/images/<?= strtolower($employee['gender']) ?>_placeholder.jpg" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <span class="card-title fw-bold"><?= $name ?></span>
              <hr>
              <span class="card-text">Age: <?= $age ?></span>
              <hr>
              <p class="card-text">Current Position</p>
              <p class="card-text">- <?= $employeePosition['title'] ?> : <?= $employeePosition['from_date'] ?></p>

            </div>
          </div>

          <div class="card bg-dark text-white col-md-5">
            <img src="../assets/images/<?= strtolower($employee['gender']) ?>_placeholder.jpg" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <span class="card-title fw-bold"><?= $managerName ?> (Current Manager)</span>
              <hr>
              <span class="card-text">Age: <?= $ageManager ?></span>
              <hr>
              <p class="card-text">Current Position</p>
              <p class="card-text">- <?= $managerPosition['title'] ?> : <?= $managerPosition['from_date'] ?></p>
            </div>
          </div>

        </div>
        <div class="col-md-4">
          <hr class="d-sm-block d-md-none">
          <h2 class="text-danger">Manager assignement Form</h2>
          <form action="../traitement/traitement_changement_position.php" method="POST" class="form-group">

            <input class="form-control" type="hidden" name="emp_no" value="<?= $idEmployee ?>" />
            <input class="form-control" type="hidden" name="emp_no" value="<?= $managerPosition['title'] ?>" />

            <label class="form-label" for="date">Start Date :</label>
            <input class="form-control" type="date" id="date" name="from_date" placeholder="Start Date" required />

            <button type="submit" class="btn btn-primary mt-3">Submit Change</button>


          </form>
        </div>

      </div>

    </div>

  </main>
  <footer class="bg-white shadow-sm pt-2" id="footer">
    <?php include("../inc/footer.php"); ?>
  </footer>
  <script src="../assets/scripts/js/bootstrap.bundle.min.js"></script>

</body>

</html>