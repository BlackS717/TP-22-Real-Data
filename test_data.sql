-- get employee that worked in more than one department, used for testing
SELECT e.emp_no, e.first_name, e.last_name, COUNT(DISTINCT de.dept_no) AS departments_count
FROM employees e
JOIN dept_emp de ON e.emp_no = de.emp_no
GROUP BY e.emp_no, e.first_name, e.last_name
HAVING COUNT(DISTINCT de.dept_no) > 1 
LIMIT 10;

-- get employee with no department assigned to them

SELECT e.*
FROM employees e
WHERE NOT EXISTS (
    SELECT 1
    FROM dept_emp de
    WHERE de.emp_no = e.emp_no AND de.to_date = '9999-01-01'
)
LIMIT 10;
