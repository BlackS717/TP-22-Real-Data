<?php
require("../inc/function.php");
$idDepartment = isset($_GET['id_department']) ? $_GET['id_department'] : "-1";

// idDepartment -1 => all department
// else specific department stats
// for now show all department no matter what

$femaleEmployeeCount = countAllFemaleEmployee();
$maleEmployeeCount = countAllMaleEmployee();

$decimal = 2;
$maleEmployeePercentage = convertToPercentage($maleEmployeeCount, $decimal);
$femaleEmployeePercentage = convertToPercentage($femaleEmployeeCount, $decimal);
$totalEmployeeCount = countAllEmployee();
$totalEmployeePercentage = convertToPercentage($totalEmployeeCount, $decimal);

$positionsEmployee = getAllPositionsInfo();


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
                        <td><?= $maleEmployeePercentage ?> %</td>
                    </tr>
                    <tr>
                        <td>Female</td>
                        <td><?= $femaleEmployeeCount ?></td>
                        <td><?= $femaleEmployeePercentage ?> %</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td><?= $totalEmployeeCount ?></td>
                        <td><?= $totalEmployeePercentage ?> </td>
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
                    <?php

                    for ($i = 0; $i < count($positionsEmployee); $i++) {
                        $positionEmployee = $positionsEmployee[$i];
                        $title = $positionEmployee['title'];
                        $nbrEmployee = $positionsEmployee[$i]['nbr_employee'];
                        $salary = $positionEmployee['avg_salary'];
                    ?>
                        <tr>
                            <td><?= $title ?></td>
                            <td><?= $salary ?></td>
                            <td><?= $nbrEmployee ?></td>
                        </tr>
                    <?php
                    }

                    ?>
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