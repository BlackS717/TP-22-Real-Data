<?php
require("../inc/function.php");
$idDepartment = isset($_GET['id_department']) ? $_GET['id_department'] : "-1";

// idDepartment -1 => all department
// else specific department stats
// for now show all department no matter what

$femaleEmployeeCount = 0;
$maleEmployeeCount = 0;



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
        <div class="alert alert-warning mt-2">
            <p class="lead">TODO: Créer un tableau contenant le nombre d'employé (homme et femme ), et le salaire moyen pour chaque emploi</p>
        </div>

        <h1 class="text-danger">Employee Statistics</h1>
        <p class="lead">An overview of workforce composition and salary insights.</p>

        <div class="row">
            <h4 class="">Gender Distribution</h4>
            <table class="table table-striped table-bordered">
                <caption>Breakdown of employees by gender</caption>
                <thead>
                    <tr>
                        <th>Gender</th>
                        <th>Count</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Male</td>
                        <td><?= $maleEmployeeCount ?></td>
                        <td><?= convertToPercentage($maleEmployeeCount) ?> %</td>
                    </tr>
                    <tr>
                        <td>Female</td>
                        <td><?= $femaleEmployeeCount ?></td>
                        <td><?= convertToPercentage($femaleEmployeeCount) ?> %</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <h4 class="">Average Salary by Position</h4>
            <table class="table table-striped table-bordered">
                <caption>Average salary data for each position</caption>
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Average Salary</th>
                        <th>Employee Count</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <div class="row">
            <h4 class="">Employees per Department</h4>
            <table class="table table-striped table-bordered">
                <caption>Number of employees in each department</caption>
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Employee Count</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>


    </main>

    <footer class="bg-white shadow-sm pt-2" id="footer">
        <?php include("../inc/footer.php"); ?>
    </footer>
    <script src="../assets/scripts/js/bootstrap.bundle.min.js"></script>
</body>

</html>