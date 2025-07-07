-- get employee that worked in more than one department, used for testing
SELECT e.emp_no, e.first_name, e.last_name, COUNT(DISTINCT de.dept_no) AS departments_count
FROM employees e
JOIN dept_emp de ON e.emp_no = de.emp_no
GROUP BY e.emp_no, e.first_name, e.last_name
HAVING COUNT(DISTINCT de.dept_no) > 1 
LIMIT 10;

-- 

