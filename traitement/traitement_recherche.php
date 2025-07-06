<?php
session_start();
require("../inc/function.php");


if (!isset($_GET["nom"])) {
    $_GET["nom"] = "";
}
if (!isset($_GET["prenom"])) {
    $_GET["prenom"] = "";
}
if (!isset($_GET["ageMin"])) {
    $_GET["agemin"] = 18;
}
if (!isset($_GET["ageMax"])) {
    $_GET["nom"] = 100;
}
if (!isset($_GET["departement"])) {
    $_GET["departement"] = "";
}

$_SESSION["EmployeeFiltrer"] = rechercheEmployee($_GET["nom"],$_GET["prenom"],$_GET["ageMin"],$_GET["ageMax"],$_GET["departement"]);

header("location : ../pages/historique_employee.php");
?>
