<?php
include("../inc/function.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="../assets/scripts/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <header class="bg-white shadow-sm container">
        <?php include("../inc/header.php"); ?>
    </header>

    <main class="container">
        <section class="row">
            <section class="col-lg-4 mx-auto mt-3 text-center">
                <h2 class="text-danger fw-bold">Available Departments</h2>
                <p class="figure-caption">We'll provide full service at every step</p>
            </section>
        </section>

        <section class="row">
            <section class="col-lg-12">
                <section class="row mx-auto">

                    <article class="col-lg-3 gap-1 mb-3">
                        <section class="card" style="width: 18rem;">
                            <img src="../assets/images/dep_placeholder.jpg" class="card-img-top img-fluid" style="height: 200px" alt="...">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <span class="card-title fw-bold">title</span>
                                    <span class="card-text d-flex align-items-center gap-2">
                                        <img src="../assets/images/activity.svg" class="img-fluid" style="width: 20px" alt="">
                                        <img src="../assets/images/share.svg" class="img-fluid" style="width: 20px" alt="">
                                        <img src="../assets/images/bar-chart-fill.svg" alt="" class="img-fluid" style="width: 20px">
                                    </span>
                                </section>
                                <a href="department.php?id=" class="btn btn-danger">Explore</a>
                            </section>
                        </section>
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