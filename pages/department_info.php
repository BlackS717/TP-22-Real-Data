<?php
require("../inc/function.php");
$idDepartement = isset($_GET["id"]) ? $_GET["id"] : 0;

$start = isset($_GET["start"]) ? $_GET["start"] : 0;

$nbrToShow = 20;
$employees = getDepartmentEmployee($idDepartement, $start, $nbrToShow);
$employeeCount = count($employees);


$nbrEmployees = getCountDepartmentEmployee($idDepartement);
$nbrEmployeesdivided = ceil($nbrEmployees / $nbrToShow);
$next = $start + $employeeCount;
$previous = $start - $nbrToShow;
if ($previous < 0) {
    $previous = 0;
}

$activePrevious = $previous == 0 ? "disabled" : "";
$activeNext = $next == $nbrEmployees ? "disabled" : "";

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
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $activePrevious ?>">
                        <a class="page-link" href="department_info.php?start=<?= $previous ?>&&id=<?= $idDepartement ?>">Previous</a>
                    </li>

                    <li class="page-item disabled">
                        <a href="" class="page-link"><?= $start + 1 ?> - <?= $start + $employeeCount ?></a>
                    </li>

                    <li class="page-item <?= $activeNext ?>">
                        <a class="page-link" href="department_info.php?start=<?= $next ?>&&id=<?= $idDepartement ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </section>
        <section class="row">
            <section class="col-lg-12">
                <section class="row mx-auto">
                    <article class="col gap-1 mb-3 list-employees d-inline-flex  justify-content-evenly align-items-center flex-wrap">
                        <?php for ($i = 0; $i < $employeeCount; $i++) {
                        ?>
                            <a href="fiche_employee.php?employee=<?= $employees[$i]["emp_no"] ?>">

                                <?php
                                $employee = $employees[$i];
                                $img = $employee["gender"] == "M" ? "../assets/images/m_placeholder.jpg" : "../assets/images/f_placeholder.jpg";
                                $name = getName($employee);
                                $age = getAge($employee);
                                $hireDate = $employee["hire_date"];
                                ?>
                                <section class="card " style="width: 18rem;min-width: 18rem;">
                                    <img src="<?= $img ?>" class="card-img-top img-fluid" alt="...">
                                    <section class="card-body">
                                        <section class="d-flex flex-column justify-content-between">
                                            <span class="card-title fw-bold"><?= $name ?></span>
                                            <hr>
                                            <span class="card-text d-flex align-items-center gap-2">Age: <?= $age ?></span>
                                            <span class="card-text d-flex align-items-center gap-2">Date d'embauche: <?= $hireDate ?></span>
                                        </section>
                                    </section>
                                </section>
                            </a>
                        <?php
                        }
                        ?>

                    </article>

                </section>
            </section>
        </section>
        <section class="row">

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $activePrevious ?>">
                        <a class="page-link" href="department_info.php?start=<?= $previous ?>&&id=<?= $idDepartement ?>">Previous</a>
                    </li>
                    <li class="page-item <?= $activeNext ?>">
                        <a class="page-link" href="department_info.php?start=<?= $next ?>&&id=<?= $idDepartement ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </section>
    </main>

    <footer class="bg-white shadow-sm pt-2" id="footer">
        <?php include("../inc/footer.php"); ?>
    </footer>
    <script src="../assets/scripts/js/bootstrap.bundle.min.js"></script>
</body>

</html>