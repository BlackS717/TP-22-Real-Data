<?php
session_start();
require("../inc/function.php");

$idEmployee = isset($_GET["idEmployee"]) ? $_GET["idEmployee"] : 0;

$employee = getEmployee($idEmployee);
$age = getAge($employee);
$name = getName($employee);

$list_departments = getAllDepartement();
$current_department = getEmployeeDepartmentRecord($idEmployee)[0]['dept_name'];

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
        <div class="col-md-4">
          <div class="card">
            <img src="../assets/images/m_placeholder.jpg" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <span class="card-title fw-bold"><?= $name ?></span>
              <hr>
              <span class="card-text">Age: <?= $age ?></span>
              <hr>
              <p class="card-text">Current Department</p>
              <p class="card-text">- <?= $current_department ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <hr class="d-sm-block d-md-none">
          <h2 class="text-danger">Department Change Form</h2>
          <form action="../traitement/traitement_changement_department.php?$idemployee= <?= $idEmployee ?>" method="GET" class="form-group">

            <label class="form-label" for="date">Start Date :</label>
            <input class="form-control" type="date" id="date" name="from_date" placeholder="Start Date" required />

            <hr>

            <label class="form-label" for="departement">Select Department :</label>
            <select class="form-control" name="new_departement" id="departement" required>
              <?php
              foreach ($list_departments as $departement) {

                if ($departement['dept_name'] == $current_department) {
                  continue;
                }

              ?>
                <option value="<?= $departement['dept_no'] ?>"><?= $departement['dept_name'] ?></option>
              <?php
              }
              ?>
            </select>

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