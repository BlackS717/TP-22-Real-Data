<?php 
require("../inc/function.php");

$date = $_POST['from_date'];
$id_departement = $_POST['dept_no'];
$id_employee = $_POST['emp_no'];


$request = changeEmployeeDepartment($id_employee, $id_departement, $date);
var_dump( $request );





?>