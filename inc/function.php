<?php
require("connection.php");

function make_request($request)
{
    return mysqli_query(dbconnect(), $request);
}

function request_to_array($request)
{
    $result = array();
    while ($r = mysqli_fetch_assoc($request)) {
        $result[] = $r;
    }
    mysqli_free_result($request);
    return $result;
}

function fetch_result($request)
{
    $result = mysqli_fetch_assoc($request);
    mysqli_free_result($request);
    return $result;
}

function count_result($request)
{
    $result = mysqli_num_rows($request);
    mysqli_free_result($request);
    return $result;
}

function getAllDepartement()
{
    $sql = " SELECT * FROM departments ";
    $req = make_request($sql);
    return request_to_array($req);
}

function getAllDepartementWithCurrentEmployeeCount()
{
    $sql = "SELECT d.dept_no, d.dept_name, COUNT(de.emp_no) AS nbr FROM departments d 
        JOIN dept_emp de ON d.dept_no = de.dept_no AND de.to_date = '9999-01-01'
        GROUP BY d.dept_no, d.dept_name ORDER BY d.dept_name";
    $request = make_request($sql);
    $result['departments'] = request_to_array($request);
    $result['total_employee'] = 0;

    foreach ($result['departments'] as $dep) {
        $result['total_employee'] += $dep['nbr'];
    }

    return $result;
}

function getAllManagerEnCours($idDepartment)
{
    $sql = " SELECT * FROM dept_manager  WHERE dept_no = '%s'  AND to_date = '9999-01-01'";
    $sql = sprintf($sql, $idDepartment);
    $req = make_request($sql);
    return request_to_array($req);
}

function getManagerEnCours($idDepartment)
{
    $sql = " SELECT e.*, dm.from_date, dm.to_date, dm.dept_no FROM dept_manager dm JOIN employees e ON dm.emp_no = e.emp_no WHERE dm.dept_no = '%s' AND dm.to_date = '9999-01-01'";
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
    $res = fetch_result($req);
    return $res;
}

function getEmployeeTitleRecord($idEmployee)
{
    $sql = "SELECT e.*, t.title, t.from_date, t.to_date FROM titles t JOIN employees e ON e.emp_no = t.emp_no WHERE t.emp_no = '%s'";

    $sql = sprintf($sql, $idEmployee);
    $req = make_request($sql);
    return request_to_array($req);
}

function getEmployeeCurrentTitle($idEmployee)
{
    $sql = "SELECT e.*, t.title, t.from_date, t.to_date FROM titles t JOIN employees e ON e.emp_no = t.emp_no WHERE t.emp_no = '%s' AND t.to_date = '9999-01-01'";

    $sql = sprintf($sql, $idEmployee);
    $req = make_request($sql);
    return fetch_result($req);
}

function countAllEmployeeWithAssignedDepartment()
{
    $sql = "SELECT COUNT(DISTINCT emp_no) as total FROM dept_emp WHERE to_date = '9999-01-01'";
    $req = mysqli_query(dbconnect(), $sql);
    $res = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $res['total'];
}

function countAllEmployeeWithNoDepartment()
{
    $sql = "SELECT COUNT(*) AS total FROM employees e
                WHERE NOT EXISTS (
                    SELECT 1 FROM dept_emp de 
                    WHERE de.emp_no = e.emp_no 
                    AND de.to_date = '9999-01-01'
                )
            ";
    $req = mysqli_query(dbconnect(), $sql);
    $res = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $res['total'];
}

function countAllEmployee()
{
    $sql = "SELECT COUNT(*) as total FROM employees";
    $req = mysqli_query(dbconnect(), $sql);
    $res = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $res['total'];
}

function countAllEmployeeWithAssignedDepartmentWithGender($gender)
{
    $gender = strtoupper($gender);
    if ($gender != 'F' && $gender != 'M') {
        return 0;
    }

    $sql = "SELECT COUNT(DISTINCT de.emp_no) as nbr FROM dept_emp de JOIN employees e ON e.emp_no = de.emp_no WHERE e.gender = '%s' AND de.to_date = '9999-01-01'";
    $sql = sprintf($sql, $gender);
    $req = make_request($sql);
    return fetch_result($req)['nbr'];
}

function countAllEmployeeWithGender($gender)
{
    $gender = strtoupper($gender);
    if ($gender != 'F' && $gender != 'M') {
        return 0;
    }

    $sql = "SELECT COUNT(*) as nbr FROM employees WHERE gender = '%s'";
    $sql = sprintf($sql, $gender);
    $req = make_request($sql);
    return fetch_result($req)['nbr'];
}

function getName($employee)
{
    return $employee["last_name"] . " " . $employee["first_name"];
}


function getDepartmentEmployee($idDepartment, $start, $nbr)
{
    $sql = "SELECT e.* FROM employees e 
                JOIN dept_emp de ON e.emp_no = de.emp_no 
                WHERE de.dept_no = '%s' AND de.to_date = '9999-01-01' ORDER BY e.last_name, e.first_name, e.hire_date  LIMIT %s,%s";
    $sql = sprintf($sql, $idDepartment, $start, $nbr);
    $req = make_request($sql);
    return request_to_array($req);
}

function getDepartmentEmployeeRecord($idDepartment, $start, $nbr)
{
    $sql = "SELECT e.* FROM employees e 
                JOIN dept_emp de ON e.emp_no = de.emp_no 
                JOIN departments ON de.dept_no = departments.dept_no WHERE de.dept_no = '%s' ORDER BY e.hire_date DESC LIMIT %s,%s";
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

function countCurrentDepartmentEmployee($idDepartment)
{
    $sql = "SELECT count(*) as nbr FROM dept_emp WHERE dept_no = '%s' AND to_date = '9999-01-01'";
    $sql = sprintf($sql, $idDepartment);
    $req = make_request($sql);
    $res = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $res["nbr"];
}

function countAllTimeDepartmentEmployee($idDepartment)
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

function rechercheEmployee($nom, $prenom, $ageMin, $ageMax, $departement, $offset, $resultNbr, $currentOnly)
{
    $sql = "SELECT employees.* FROM employees ";

    $age = " TIMESTAMPDIFF(YEAR, employees.birth_date, NOW()) ";

    $conditions = [];

    if ($departement != '-1' || $currentOnly) {
        $sql .= " JOIN dept_emp ON dept_emp.emp_no = employees.emp_no ";
    }

    if ($currentOnly) {
        $condition = "dept_emp.to_date = '9999-01-01'";
        $conditions[] = $condition;
    }

    if ($departement != "-1") {

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

    $order = " ORDER BY employees.last_name, employees.first_name ";
    $sql .= $order;

    $LIMIT = " LIMIT %s, %s ";
    $LIMIT = sprintf($LIMIT, $offset, $resultNbr);
    $sql .= $LIMIT;


    // return $sql;

    $sql = make_request($sql);
    return request_to_array($sql);
}

function getTotalMatchingValue($nom, $prenom, $ageMin, $ageMax, $departement, $currentOnly)
{
    $sql = "SELECT COUNT(*) as total FROM employees ";

    $age = " TIMESTAMPDIFF(YEAR, employees.birth_date, NOW()) ";

    $conditions = [];

    if ($departement != '-1' || $currentOnly) {
        $sql .= " JOIN dept_emp ON dept_emp.emp_no = employees.emp_no ";
    }

    if ($currentOnly) {
        $condition = "dept_emp.to_date = '9999-01-01'";
        $conditions[] = $condition;
    }

    if ($departement != "-1") {
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

function getCurrentDepartment($idEmployee)
{
    $sql = "SELECT d.dept_name, d.dept_no, de.from_date, de.to_date, de.emp_no FROM dept_emp de JOIN departments d ON de.dept_no = d.dept_no WHERE de.emp_no = '%s' AND de.to_date = '9999-01-01'";
    $sql = sprintf($sql, $idEmployee);
    $request = make_request($sql);
    $result = fetch_result($request);
    return $result;
}

function isInADepartment($idEmployee)
{
    $sql = "SELECT emp_no FROM dept_emp WHERE emp_no = '%s' AND to_date = '9999-01-01'";
    $sql = sprintf($sql, $idEmployee);
    $request = make_request($sql);
    $result = count_result($request) > 0;
    return $result;
}

function leaveDepartment($idEmployee, $date)
{
    $sql = "UPDATE dept_emp SET to_date = '%s' WHERE emp_no = '%s' AND to_date = '9999-01-01' AND from_date < '%s'";
    $sql = sprintf($sql, $date, $idEmployee, $date);
    make_request($sql);
    $result = mysqli_affected_rows(dbconnect()) > 0;
    return $result;
}

function getLatestDepartment($idEmployee)
{
    $sql = "SELECT * FROM dept_emp WHERE emp_no = '%s' ORDER BY to_date DESC LIMIT 1";
    $sql = sprintf($sql, $idEmployee);
    $request = make_request($sql);
    $result = fetch_result($request);
    return $result;
}


function changeEmployeeDepartment($idEmployee, $idNewDep, $newDate)
{
    $inDepartment = isInADepartment($idEmployee);
    $isValidDate = false;

    if ($inDepartment) {
        $isValidDate = leaveDepartment($idEmployee, $newDate);
    } else {
        // get the latest department to_date and use it as a reference instead
        $latestDepartment = getLatestDepartment($idEmployee);
        $sql = "SELECT '%s' < '%s' AS valid_date";
        $sql = sprintf($sql, $latestDepartment['to_date'], $newDate);
        $request = make_request($sql);
        $isValidDate = fetch_result($request)['valid_date'] == 0 ? false : true;
    }

    if (!$isValidDate) {
        return 0;
    }

    $sql = "INSERT INTO dept_emp VALUES ('%s','%s','%s','9999-01-01')";
    $sql = sprintf($sql, $idEmployee, $idNewDep, $newDate);
    $request = make_request($sql);
    return $request;
}

function convertToPercentage($employeeCount, $decimal, $all)
{
    $totalEmployeeNumber = $all ? countAllEmployee() : countAllEmployeeWithAssignedDepartment();
    $percentage = ($employeeCount * 100) / $totalEmployeeNumber;
    return round($percentage, $decimal);
}

function getAllPositions()
{
    $sql = "SELECT DISTINCT title FROM titles";
    $request = make_request($sql);
    return request_to_array($request);
}

function countEmployeeInPosition($position)
{
    $sql = "SELECT COUNT(*) AS nbr FROM titles WHERE title = '%s'";
    $sql = sprintf($sql, $position);
    $request = make_request($sql);
    return fetch_result($request)['nbr'];
}

function getAllPositionsInfo($currentOnly)
{
    $latest_title_alias = "t_latest";
    $latest_title = "   ( SELECT t1.emp_no, t1.title FROM titles t1 JOIN 
                            (
                                SELECT emp_no, MAX(from_date) AS max_from FROM titles GROUP BY emp_no
                            ) AS t2 ON t1.emp_no = t2.emp_no AND t1.from_date = t2.max_from 
                        ) AS " . $latest_title_alias;

    $latest_salary_alias = "s_latest";
    $latest_salary = "  ( SELECT s1.emp_no, s1.salary FROM salaries s1 JOIN 
                            (
                                SELECT emp_no, MAX(from_date) AS max_from FROM salaries GROUP BY emp_no
                            ) AS s2 ON s1.emp_no = s2.emp_no AND s1.from_date = s2.max_from
                        )  AS " . $latest_salary_alias;

    $sql = "SELECT " . $latest_title_alias . ".title, COUNT(DISTINCT " . $latest_title_alias . ".emp_no) AS nbr_employee, AVG(" . $latest_salary_alias . ".salary) AS avg_salary FROM" . $latest_title
        . " JOIN "
        . $latest_salary
        . " ON " . $latest_title_alias . ".emp_no = " . $latest_salary_alias . ".emp_no ";

    if ($currentOnly) {
        $sql .= " JOIN dept_emp de ON de.emp_no = " . $latest_title_alias . ".emp_no  WHERE de.to_date = '9999-01-01' ";
    }

    $group = "GROUP BY " . $latest_title_alias . ".title ORDER BY nbr_employee DESC";
    $sql .= $group;
    $request = make_request($sql);
    return request_to_array($request);
}

function getLongestHeldPosition($idEmployee)
{
    $sql = "SELECT title, DATEDIFF(to_date, from_date) AS duration FROM titles t1
            WHERE DATEDIFF(to_date, from_date) = (
                SELECT MAX(DATEDIFF(to_date, from_date))
                FROM titles t2
                WHERE t2.emp_no = t1.emp_no
            ) AND emp_no = '%s' ";
    $sql = sprintf($sql, $idEmployee);
    $request = make_request($sql);
    return request_to_array($request);
}
