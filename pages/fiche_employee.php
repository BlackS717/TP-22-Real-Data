<?php
require("../inc/function.php");

if (!isset($_GET['employee'])) {
    header("Location: index.php");
}

$idEmployee = $_GET["employee"];

$employee = getEmployee($idEmployee);

$ficheDepartments = getEmployeeDepartmentRecord($idEmployee);
$ficheSalaires = getEmployeeSalaryRecord($idEmployee);
$fichePositions = getEmployeeTitleRecord($idEmployee);

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
    <main class="container pt-2">

        <section class="row">
            <div class="col-lg-12">
                <div class="row">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="col-md-12 col-lg-12">
                            <?php if ($_GET['error'] == 0) { ?>
                                <p class="alert alert-danger">
                                    Failed to Update the Department because the date provided is invalid !!!
                                </p>
                            <?php } else { ?>
                                <p class="alert alert-success">
                                    Department Updated Successfully !!!
                                </p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="col-md-12 col-lg-4">
                        <div class="col-md-6 mx-sm-auto mx-lg-0">
                            <?php
                            $img = $employee["gender"] == "M" ? "../assets/images/m_placeholder.jpg" : "../assets/images/f_placeholder.jpg";
                            $name = getName($employee);
                            $age = getAge($employee);

                            $longestHeldPositions = getLongestHeldPosition($employee['emp_no']);

                            ?>
                            <article class="col gap-1 mb-3 list-employees d-inline-flex  justify-content-evenly align-items-center flex-wrap">
                                <div class="card " style="width: 18rem;">
                                    <img src="<?= $img ?>" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <div class="">
                                            <span class="card-title fw-bold"><?= $name ?></span>
                                            <hr>
                                            <span class="card-text align-items-center">Age: <?= $age ?></span>
                                            <hr>

                                            <h6 class="card-text align-items-center">Longest Held Position:</h6>
                                            <?php
                                            foreach ($longestHeldPositions as $position) {
                                            ?>
                                                <p class="card-text align-items-center">- <?= $position['title'] ?></p>
                                            <?php
                                            }
                                            ?>
                                            <hr>

                                            <span class="card-text"><a href="department_change.php?idEmployee=<?= $idEmployee ?>">Change Department</a></span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-8">
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

                                    <?php foreach ($ficheSalaires as $ficheSalaire) {

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
                                    <?php foreach ($ficheDepartments as $ficheDepartment) {
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
                                    <?php foreach ($fichePositions as $fichePosition) {
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