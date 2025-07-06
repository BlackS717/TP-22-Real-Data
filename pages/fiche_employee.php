<?php
require("../inc/function.php");

$idEmployee = isset($_GET["employee"]) ? $_GET["employee"] : 0;

$employee = getEmployee($idEmployee);

$ficheDep = getEmployeeDepartment($idEmployee);
$ficheSalaire = getEmployeeSalaire($idEmployee);

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
            <section class="col-lg-12">
                <section class="row mx-auto">

                    <section class="col-md-3 mb-3">

                        <?php
                        $img = $employee["gender"] == "M" ? "../assets/images/m_placeholder.jpg" : "../assets/images/f_placeholder.jpg";
                        $name = getName($employee);
                        $age = getAge($employee);
                        ?>
                        <article class="col gap-1 mb-3 list-employees d-inline-flex  justify-content-evenly align-items-center flex-wrap">
                            <img src="<?= $img ?>" class="card-img-top img-fluid" style="max-height: 100px max-width :100px" alt="...">
                            <section class="card " style="width: 18rem;min-width: 18rem;">
                                <section class="card-body">
                                    <section class="d-flex flex-column justify-content-between">
                                        <span class="card-title fw-bold"><?= $name ?></span>
                                        <hr>
                                        <span class="card-text d-flex align-items-center gap-2">Age: <?= $age ?></span>
                                    </section>
                                </section>
                        </article>
                    </section>

                    <section class="col-md-9 mb-3">
                        <section class="row">
                            <div class="col-md-6 mb-3 ms-3 ">
                                <table class="col gap-3  table table-primary table-striped table-hover align-middle caption-top "
                                    style="max-height: fit-content;">
                                    <caption>Salaire de l'employee</caption>
                                    <tr>
                                        <th>Debut</th>
                                        <th>Fin</th>
                                        <th>Salaire</th>
                                    </tr>

                                    <?php for ($i = 0; $i < $numberSalary; $i++) {
                                    ?>
                                        <tr>
                                            <td><?= $ficheSalaire[$i]["from_date"] ?></td>
                                            <td><?= $ficheSalaire[$i]["to_date"] ?></td>
                                            <td><?= $ficheSalaire[$i]["salary"] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </table>
                            </div>

                            <div class="col-md-5">
                                <table class="col gap-3  table table-striped table-sm table-hover align-middle caption-top table-hover ">
                                    <caption>Departement de l'employee</caption>
                                    <tr>
                                        <th>Debut</th>
                                        <th>Fin</th>
                                        <th>Departement</th>
                                    </tr>
                                    <?php for ($i = 0; $i < $nbrDepEmp; $i++) {
                                    ?>
                                        <tr>
                                            <td><?= $ficheDep[$i]["from_date"] ?></td>
                                            <td><?= $ficheDep[$i]["to_date"] ?></td>
                                            <td><?= $ficheDep[$i]["title"] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </section>
                    </section>

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