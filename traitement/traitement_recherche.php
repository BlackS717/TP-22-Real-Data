<?php
session_start();
require("../inc/function.php");

// $_SESSION["EmployeeFiltrer"] = rechercheEmployee($_GET["nom"],$_GET["prenom"],$_GET["ageMin"],$_GET["ageMax"],$_GET["departement"]);

$nbrResult = 20;
$startIndex = 0;

$dummy = rechercheEmployee($_GET["nom"],$_GET["prenom"],$_GET["ageMin"],$_GET["ageMax"],$_GET["departement"], $startIndex, $nbrResult);

var_dump($dummy);


// header("location : ../pages/historique_employee.php");
?>
