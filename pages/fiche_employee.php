<?php
require("../inc/function.php");

$idEmployee = isset($_GET["employee"]) ? $_GET["employee"] : 0;

$employee = getEmployee($idEmployee);

$ficheDepartments = getEmployeeDepartmentRecord($idEmployee);
$ficheSalaires = getEmployeeSalaryRecord($idEmployee);

$fichePositions = getEmployeeTitleRecord($idEmployee);

$numberSalary = getNombreSalaire($idEmployee);
$nbrDepEmp = getNombreEmployeDepartement($idEmployee);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="../assets/scripts/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/scripts/css/style.css">
</head>

<body class="bg-light">
    <header class="bg-white shadow-sm container">
        <?php include("../inc/header.php"); ?>
    </header>
    <main class="container">

        <section class="row">
            <div class="col-lg-12">
                <div class="row">

                    <div class="col-md-12 col-lg-6">
                        <div class="col-md-6 mx-auto">
                            <?php
                            $img = $employee["gender"] == "M" ? "../assets/images/m_placeholder.jpg" : "../assets/images/f_placeholder.jpg";
                            $name = getName($employee);
                            $age = getAge($employee);
                            ?>
                            <article class="col gap-1 mb-3 list-employees d-inline-flex  justify-content-evenly align-items-center flex-wrap">
                                <img src="<?= $img ?>" class="card-img-top img-fluid" style="max-height: 100px max-width :100px" alt="...">
                                <div class="card " style="width: 18rem;min-width: 18rem;">
                                    <div class="card-body">
                                        <div class="d-flex flex-column justify-content-between">
                                            <span class="card-title fw-bold"><?= $name ?></span>
                                            <hr>
                                            <span class="card-text d-flex align-items-center gap-2">Age: <?= $age ?></span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-12 ">
                                <table class="col gap-3 table table-primary table-striped table-hover align-middle caption-top "
                                    style="max-height: fit-content;">
                                    <caption>Employee Salary Record</caption>
                                    <tr>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Salary</th>
                                    </tr>

                                    <?php for ($i = 0; $i < $numberSalary; $i++) {
                                        $ficheSalaire = $ficheSalaires[$i];

                                        $terminated = $ficheSalaire["to_date"] != "9999-01-01";

                                        $start_date = $ficheSalaire["from_date"];

                                        $end_date = $terminated ? $ficheSalaire["to_date"] : "-";
                                        
                                        $salary = $ficheSalaire["salary"];

                                    ?>
                                        <tr>
                                            <td><?= $start_date ?></td>
                                            <td><?= $end_date ?></td>
                                            <td><?= $salary ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </table>
                            </div>

                            <div class="col-12">
                                <table class="col gap-3  table table-warning table-striped table-sm table-hover align-middle caption-top table-hover ">
                                    <caption>Employee Department Records</caption>
                                    <tr>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Department</th>
                                    </tr>
                                    <?php for ($i = 0; $i < $nbrDepEmp; $i++) {
                                        $ficheDepartment = $ficheDepartments[$i];
                                        $terminated = $ficheDepartment["to_date"] != "9999-01-01";

                                        $start_date = $ficheDepartment["from_date"];
                                        $end_date = $terminated ? $ficheDepartment["to_date"] : "-";
                                        $nomDepartement = $ficheDepartment["dept_name"];


                                    ?>
                                        <tr>
                                            <td><?= $start_date ?></td>
                                            <td><?= $end_date ?></td>
                                            <td><?= $nomDepartement ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>

                            <div class="col-12">
                                <table class="col gap-3  table table-success table-striped table-sm table-hover align-middle caption-top table-hover ">
                                    <caption>Employee Position Records</caption>
                                    <tr>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Position</th>
                                    </tr>
                                    <?php for ($i = 0; $i < $nbrDepEmp; $i++) {
                                        $fichePosition = $fichePositions[$i];
                                        $terminated = $fichePosition["to_date"] != "9999-01-01";

                                        $start_date = $fichePosition['from_date'];
                                        $end_date = $terminated ? $fichePosition['to_date'] : "-";
                                        $position = $fichePosition['title'];



                                    ?>
                                        <tr>
                                            <td><?= $start_date ?></td>
                                            <td><?= $end_date ?></td>
                                            <td><?= $position ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <footer class="bg-white shadow-sm pt-2" id="footer">
        <?php include("../inc/footer.php"); ?>
    </footer>
    <script src="../assets/scripts/js/bootstrap.bundle.min.js"></script>
</body>

</html>