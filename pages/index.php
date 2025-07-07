<?php
include("../inc/function.php");
$departements = getAllDepartement();
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
            <section class="col-12 mx-auto mt-3 text-center">
                <h2 class="text-danger fw-bold">Explore Our Departments</h2>
                <p class="figure-caption">Total number of employee: <?= countAllEmployee() ?></p>
            </section>
        </section>

        <section class="row">
            <section class="col-lg-12">
                <section class="row mx-auto">
                    <article class="col gap-1 mb-3 list-departements d-inline-flex  justify-content-evenly align-items-center flex-wrap">
                        <?php for ($i = 0; $i < count($departements); $i++) {
                            $departement = $departements[$i];
                            $idDepartement = $departement['dept_no'];
                            $idManagerEnCours = getManagerEnCours($departement["dept_no"])["emp_no"];
                            $managerEnCours = getEmployee($idManagerEnCours);
                            $nbrEmployee = getCountDepartmentEmployee($idDepartement)
                        ?>

                            <section class="card" style="width: 18rem;min-width: 18rem;">
                                <img src="../assets/images/dep_placeholder.jpg" class="card-img-top img-fluid" style="height: 200px" alt="...">
                                <section class="card-body">
                                    <section class="d-flex flex-column justify-content-between">
                                        <span class="card-title fw-bold"><?=
                                                                            $departement["dept_name"] ?></span>
                                        <span class="card-title fw-bold"><?= $nbrEmployee ?> employees</span>
                                        <hr>
                                        <span class="card-text ">Manager: <?= getName($managerEnCours)  ?></span>
                                        <hr>
                                        <span class="card-text d-flex align-items-center gap-2">
                                            <a href="department_info.php?id=<?= $idDepartement ?>">
                                                <img src="../assets/images/person-circle.svg" class="img-fluid" style="width: 20px" alt="">
                                            </a>

                                            <a href="department_stats.php?id_department=<?= $idDepartement ?>">
                                                <img src="../assets/images/bar-chart-fill.svg" alt="" class="img-fluid" style="width: 20px">
                                            </a>
                                        </span>
                                    </section>
                                </section>
                            </section>
                        <?php
                        }
                        ?>

                    </article>

                </section>
            </section>
        </section>
    </main>

    <footer class="bg-white shadow-sm pt-2" id="footer">
        <?php include("../inc/footer.php"); ?>
    </footer>
    <script src="../assets/scripts/js/bootstrap.bundle.min.js"></script>
</body>

</html>