<?php
require("../inc/function.php");

$values = [];

$nom = isset($_GET["nom"]) ? $_GET['nom'] : "";
$values[] = "nom=" . $nom;

$prenom = isset($_GET["prenom"]) ? $_GET['prenom'] : "";
$values[] = "prenom=" . $prenom;

$ageMin = isset($_GET["ageMin"]) ? $_GET['ageMin'] : "0";
$values[] = "ageMin=" . $ageMin;

$ageMax = isset($_GET["ageMax"]) ? $_GET['ageMax'] : "0";
$values[] = "ageMax=" . $ageMax;

$idDepartementR = isset($_GET["departement"]) ? $_GET['departement'] : "-1";
$values[] = "departement=" . $idDepartementR;

$start = isset($_GET["start"]) ? $_GET["start"] : 0;
$nbrToShow = 20;

$employees = rechercheEmployee($nom, $prenom, $ageMin, $ageMax, $idDepartementR, $start, $nbrToShow);

$nbrEmployees = getTotalMatchingValue($nom, $prenom, $ageMin, $ageMax, $idDepartementR);

$nbrEmployeesdivided = ceil($nbrEmployees / $nbrToShow);
$next = $start + $nbrToShow;
if ($next > $nbrEmployees) {
    $next = 0;
}
$previous = $start - $nbrToShow;

$activePrevious = $previous < 0 ? "disabled" : "";
$activeNext = $next == 0 ? "disabled" : "";

$valueToPass = implode("&&", $values);

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
            <h3><?= $nbrEmployees ?> resultat(s)</h3>
        </section>
        <section class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">

                    <li class="page-item <?= $activePrevious ?>">
                        <a class="page-link" href="resultat_recherche.php?start=<?= $previous ?>&&<?= $valueToPass ?>">Previous</a>
                    </li>

                    <li class="page-item disabled">
                        <a href="" class="page-link"><?= $start + 1 ?> - <?= $start + count($employees) ?></a>
                    </li>

                    <li class="page-item <?= $activeNext ?>">
                        <a class="page-link" href="resultat_recherche.php?start=<?= $next ?>&&<?= $valueToPass ?>">Next</a>
                    </li>

                </ul>
            </nav>
        </section>
        <section class="row">
            <section class="col-lg-12">
                <section class="row mx-auto">
                    <article class="col gap-1 mb-3 list-employees d-inline-flex  justify-content-evenly align-items-center flex-wrap">
                        <?php for ($i = 0; $i < count($employees); $i++) {
                        ?>
                            <a href="historique_employee.php?employee=<?= $employees[$i]["emp_no"] ?>">

                                <?php
                                $employee = $employees[$i];
                                $img = $employee["gender"] == "M" ? "../assets/images/m_placeholder.jpg" : "../assets/images/f_placeholder.jpg";
                                $name = getName($employee);
                                $age = getAge($employee);
                                $hireDate = $employee["hire_date"];
                                ?>
                                <section class="card " style="width: 18rem;min-width: 18rem;">
                                    <img src="<?= $img ?>" class="card-img-top img-fluid" style="height: 310px" alt="...">
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
                        <a class="page-link" href="resultat_recherche.php?start=<?= $previous ?>&&<?= $valueToPass ?>">Previous</a>
                    </li>

                    <li class="page-item disabled">
                        <a href="" class="page-link"><?= $start + 1 ?> - <?= $start + count($employees) ?></a>
                    </li>

                    <li class="page-item <?= $activeNext ?>">
                        <a class="page-link" href="resultat_recherche.php?start=<?= $next ?>&&<?= $valueToPass ?>">Next</a>
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