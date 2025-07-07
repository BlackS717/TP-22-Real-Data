<?php
require("../inc/function.php");
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
        <h1>Stats</h1>
        <p class="bg-warning">Créer un tableau contenant le nombre d'employé (homme et femme ), et le
salaire moyen pour chaque emploi</p>
    </main>

    <footer class="bg-white shadow-sm pt-2" id="footer">
        <?php include("../inc/footer.php"); ?>
    </footer>
    <script src="../assets/scripts/js/bootstrap.bundle.min.js"></script>
</body>

</html>