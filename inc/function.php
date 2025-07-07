<?php
require("connection.php");

function make_request($request){
    return mysqli_query(dbconnect(), $request);
}

function request_to_array($request){
    $result = array();
    while($r = mysqli_fetch_assoc($request)){
        $result[] = $r;
    }
    mysqli_free_result($request);
    return $result;
}

function fetch_result($request){
    $result = mysqli_fetch_assoc($request);
    mysqli_free_result($request);
    return $result;
}

function getAllDepartement()
{
    $sql = " SELECT * FROM departments ";
    $req = make_request($sql);
    return request_to_array($req);
}

function getAllManagerEnCours($idDepartment)
{
    $sql = " SELECT * FROM dept_manager  WHERE dept_no = '%s' ";
    $sql = sprintf($sql, $idDepartment);
    $req = make_request($sql);
    return request_to_array($req);

}

function getManagerEnCours($idDepartment)
{
    $sql = " SELECT * FROM dept_manager  WHERE dept_no = '%s' ORDER BY from_date DESC LIMIT 1";
    $sql = sprintf($sql, $idDepartment);
    $req = make_request($sql);
    $res = mysqli_fetch_assoc($req);    
    mysqli_free_result($req);
    return $res;
}

function getEmployee($idEmployee)
{
    $sql = "SELECT * FROM employees WHERE emp_no = '%s'";
    $sql = sprintf($sql, $idEmployee);
    $req = make_request($sql);
    $res = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $res;
}

function getEmployeeTitleRecord($idEmployee){
    $sql = "SELECT * FROM titles JOIN employees ON employees.emp_no = titles.emp_no WHERE titles.emp_no = '%s'";

    $sql = sprintf($sql, $idEmployee);
    $req = make_request($sql);
    return request_to_array($req);
}

function countAllEmployee(){
    $sql = "SELECT COUNT(*) as total FROM employees";
    $req = mysqli_query(dbconnect(), $sql);
    $res = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $res['total'];
}

function countAllFemaleEmployee(){
    $sql = "SELECT COUNT(*) as nbr FROM employees WHERE gender = 'F'";
    $req = make_request($sql);
    return fetch_result($req)['nbr'];
}

function countAllMaleEmployee(){
    $sql = "SELECT COUNT(*) as nbr FROM employees WHERE gender = 'M'";
    $req = make_request($sql);
    return fetch_result($req)['nbr'];
}

function getName($employee)
{
    return $employee["first_name"] . " " . $employee["last_name"];
}


function getDepartmentEmployee($idDepartment, $start, $nbr)
{
    $sql = "SELECT employees.* FROM employees 
                JOIN dept_emp ON employees.emp_no = dept_emp.emp_no 
                JOIN departments ON dept_emp.dept_no = departments.dept_no WHERE dept_emp.dept_no = '%s' ORDER BY employees.hire_date DESC LIMIT %s,%s";
    $sql = sprintf($sql, $idDepartment, $start, $nbr);
    $req = make_request($sql);
    return request_to_array($req);
}

function getDepartment($idDepartment)
{
    $sql = "SELECT * FROM departments WHERE dept_no = '%s'";
    $sql = sprintf($sql, $idDepartment);
    $req = make_request($sql);
    $res = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $res;
}

function getCountDepartmentEmployee($idDepartment)
{
    $sql = "SELECT count(*) as nbr FROM dept_emp WHERE dept_no = '%s'";
    $sql = sprintf($sql, $idDepartment);
    $req = make_request($sql);
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

    $result = make_request($query);
    $data = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $data['diffYear'];
}

function getEmployeeSalaryRecord($idEmployee)
{
    $sql = "SELECT salary,from_date,to_date FROM salaries 
            WHERE emp_no = '%s' ORDER BY from_date desc";
    $sql = sprintf($sql, $idEmployee);
    $sql = make_request($sql);
    return request_to_array($sql);
}

function getEmployeeDepartmentRecord($idEmployee)
{
    $sql = "SELECT dept_emp.from_date, dept_emp.to_date, dept_emp.from_date, dept_emp.dept_no, departments.dept_name FROM dept_emp JOIN departments ON dept_emp.dept_no = departments.dept_no WHERE dept_emp.emp_no = '%s' ORDER BY dept_emp.from_date DESC";
    $sql = sprintf($sql, $idEmployee);
    $sql = make_request($sql);
    return request_to_array($sql);
}

function getNombreSalaire($idEmployee)
{
    $sql = "SELECT count(*) as nbr FROM salaries WHERE emp_no='%s'";
    $sql = sprintf($sql, $idEmployee);
    $sql = make_request($sql);
    $req = mysqli_fetch_assoc($sql);
    mysqli_free_result($sql);
    return $req["nbr"];
}

function getNombreEmployeDepartement($idEmployee)
{
    $sql = "SELECT count(*) as nbr FROM titles WHERE emp_no='%s'";
    $sql = sprintf($sql, $idEmployee);
    $sql = make_request($sql);
    $req = mysqli_fetch_assoc($sql);
    mysqli_free_result($sql);
    return $req["nbr"];
}

function rechercheEmployee($nom, $prenom, $ageMin, $ageMax, $departement, $offset, $resultNbr)
{
    $sql = "SELECT employees.* FROM employees ";

    $age = " TIMESTAMPDIFF(YEAR, employees.birth_date, NOW()) ";

    $conditions = [];

    if ($departement != "-1") {
        $sql .= " JOIN dept_emp ON dept_emp.emp_no = employees.emp_no ";

        $condition = "dept_emp.dept_no = '%s'";
        $conditions[] = sprintf($condition, $departement);
    }

    if (!empty($nom)) {
        $formatted = "%" . $nom . "%";
        $condition = " employees.last_name LIKE '%s' ";
        $conditions[] = sprintf($condition, $formatted);
    }

    if (!empty($prenom)) {
        $formatted = "%" . $prenom . "%";
        $condition = " employees.first_name LIKE '%s' ";
        $conditions[] = sprintf($condition, $formatted);
    }

    if (!empty($ageMin)) {
        $condition = $age . " >= '%s' ";
        $conditions[] = sprintf($condition, $ageMin);
    }

    if (!empty($ageMax)) {
        $condition = $age . " <= '%s' ";
        $conditions[] = sprintf($condition, $ageMax);
    }

    if (!empty($conditions)) {
        $sql .= " WHERE ";
        $sql .= implode(" AND ", $conditions);
    }

    $LIMIT = " LIMIT %s, %s ";
    $LIMIT = sprintf($LIMIT, $offset, $resultNbr);
    $sql .= $LIMIT;

    // return $sql;

    $sql = make_request($sql);
    return request_to_array($sql);
}

function getTotalMatchingValue($nom, $prenom, $ageMin, $ageMax, $departement)
{
    $sql = "SELECT COUNT(*) as total FROM employees ";

    $age = " TIMESTAMPDIFF(YEAR, employees.birth_date, NOW()) ";

    $conditions = [];

    if ($departement != "-1") {
        $sql .= " JOIN dept_emp ON dept_emp.emp_no = employees.emp_no ";

        $condition = "dept_emp.dept_no = '%s'";
        $conditions[] = sprintf($condition, $departement);
    }

    if (!empty($nom)) {
        $formatted = "%" . $nom . "%";
        $condition = " employees.last_name LIKE '%s' ";
        $conditions[] = sprintf($condition, $formatted);
    }

    if (!empty($prenom)) {
        $formatted = "%" . $prenom . "%";
        $condition = " employees.first_name LIKE '%s' ";
        $conditions[] = sprintf($condition, $formatted);
    }

    if (!empty($ageMin)) {
        $condition = $age . " >= '%s' ";
        $conditions[] = sprintf($condition, $ageMin);
    }

    if (!empty($ageMax)) {
        $condition = $age . " <= '%s' ";
        $conditions[] = sprintf($condition, $ageMax);
    }

    if (!empty($conditions)) {
        $sql .= " WHERE ";
        $sql .= implode(" AND ", $conditions);
    }

    $request = make_request($sql);

    if (!$request) {
        return 0;
    }

    return fetch_result($request)['total'];
}


function changeEmployeeDepartment($idEmployee,$idNewDep,$newDate)
{
    $ancienDep = getEmployeeDepartmentRecord($idEmployee)[0];
    $sql = "update dept_emp set to_date = '%s' WHERE emp_no = '%s'";
    $sql = sprintf($sql,$idEmployee,$newDate);
    make_request($sql);

    $sql1 = "insert into dept_emp values ('%s','%s','%s','9999-01-01')";
    $sql1 = sprintf($sql1,$idEmployee,$idNewDep,$newDate);
    make_request($sql1);
}

function convertToPercentage($employeeCount){
    $totalEmployeeNumber = countAllEmployee();
    $percentage = ($employeeCount * 100) / $totalEmployeeNumber;
    return $percentage ;
}