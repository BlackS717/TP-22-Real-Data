<?php
require("connection.php");

function getAllDepartement()
{
    $sql = " select * from departments ";
    $req = mysqli_query(dbconnect(), $sql);
    $res = array();
    while ($dep = mysqli_fetch_assoc($req)) {
        $res[] = $dep;
    }
    mysqli_free_result($req);
    return $res;
}

function getAllManagerEnCours($idDepartment)
{
    $sql = " select * from dept_manager  where dept_no = '%s' ";
    $sql = sprintf($sql, $idDepartment);
    $req = mysqli_query(dbconnect(), $sql);

    while ($man = mysqli_fetch_assoc($req)) {
        $res = $man;
    }

    mysqli_free_result($req);
    return $res;
}

function getManagerEnCours($idDepartment)
{
    $sql = " select * from dept_manager  where dept_no = '%s' order by from_date desc limit 1";
    $sql = sprintf($sql, $idDepartment);
    $req = mysqli_query(dbconnect(), $sql);

    while ($man = mysqli_fetch_assoc($req)) {
        $res = $man;
    }

    mysqli_free_result($req);
    return $res;
}

function getEmployee($idEmployee)
{
    $sql = "select * from employees where emp_no = '%s'";
    $sql = sprintf($sql, $idEmployee);
    $req = mysqli_query(dbconnect(), $sql);
    $res = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $res;
}

function getName($employee)
{
    return $employee["first_name"] . " " . $employee["last_name"];
}



function getDepartmentEmployee($idDepartment, $start, $nbr)
{
    $sql = "select employees.* from employees 
                join dept_emp on employees.emp_no = dept_emp.emp_no 
                join departments on dept_emp.dept_no = '%s' limit %s,%s";
    $sql = sprintf($sql, $idDepartment, $start, $nbr);
    $req = mysqli_query(dbconnect(), $sql);
    $res = array();
    while ($emp = mysqli_fetch_assoc($req)) {
        $res[] = $emp;
    }
    return $res;
}

function getDepartment($idDepartment)
{
    $sql = "select * from departments where dept_no = '%s'";
    $sql = sprintf($sql, $idDepartment);
    $req = mysqli_query(dbconnect(), $sql);
    $res = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $res;
}

function getCountDepartmentEmployee($idDepartment)
{
    $sql = "select count(*) as nbr from dept_emp where dept_no = '%s'";
    $sql = sprintf($sql, $idDepartment);
    $req = mysqli_query(dbconnect(), $sql);
    $res = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $res["nbr"];
}

function getAge($employee)
{
    $date = $employee["birth_date"];
    return getDateDiff($date);
}
function getDateDiff($date)
{
    $query = "SELECT TIMESTAMPDIFF(YEAR, '%s', NOW()) AS diffYear";
    $query = sprintf($query, $date);

    $result = mysqli_query(dbconnect(), $query);
    $data = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $data['diffYear'];
}

