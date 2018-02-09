SELECT 
    id,
    bank_name,
    product_name,
    comparison_rate,
    advertised_rate
FROM
    loan_options
        NATURAL JOIN
    product
        NATURAL JOIN
    bank
WHERE
    loan_offset = '0' AND loan_redraw = '0'
        AND 21333 >= min_loan
        AND 21333 <= max_loan
        AND 0.010009697061184755 <= max_lvr
        AND cus_type_id = '2'
        AND loan_interest_only = '0'
        AND (doc_type_id = '1' OR doc_type_id = '2'
        OR doc_type_id = '3');


        
SELECT 
    *
FROM
    loan_options;
    
    SELECT * FROM cus_type;

show tables;

select * from cus_details;

use ebdb;

SELECT 
    a.id,
    bank_name,
    product_name,
    comparison_rate,
    advertised_rate
FROM
    (SELECT 
        *
    FROM
        loan_options
    NATURAL JOIN product
    NATURAL JOIN bank) AS a
        JOIN
    cus_details AS b
WHERE
    a.loan_offset = b.loan_offset
		AND b.cus_email =  'eashantilve93@gmail.com'
        AND a.loan_redraw = b.loan_redraw
        AND (b.purchase_price - b.deposit) >= min_loan
        AND (b.purchase_price - b.deposit) <= max_loan
        AND (b.purchase_price - b.deposit) / b.purchase_price <= max_lvr
        AND a.cus_type = b.cus_type
        AND a.loan_interest_only = b.loan_interest_only
        AND ((a.doc_type = 'LOW' OR a.doc_type = 'NO'
        OR a.doc_type = 'FULL')
        AND (b.employment_type = 'EMPLOYEE'
        OR (b.employment_type = 'SELF'
        AND b.tax_returns = 'YES'))
        OR (a.doc_type = 'LOW' OR a.doc_type = 'NO'));
        
        select * from bank;
   
SELECT 
    a.id,
    bank_name,
    product_name,
    comparison_rate,
    advertised_rate
FROM
    (SELECT 
        *
    FROM
        loan_options
    NATURAL JOIN product
    NATURAL JOIN bank) AS a
        JOIN
    cus_details AS b
WHERE
    a.loan_offset = b.loan_offset
        AND b.cus_email = 'some@gmail.com'
        AND a.loan_redraw = b.loan_redraw
        AND (b.purchase_price - b.deposit) >= min_loan
        AND (b.purchase_price - b.deposit) <= max_loan
        AND (b.purchase_price - b.deposit) / b.purchase_price <= max_lvr
        AND a.cus_type = b.cus_type
        AND a.loan_interest_only = b.loan_interest_only
        AND ((a.doc_type = 'LOW' OR a.doc_type = 'NO'
        OR a.doc_type = 'FULL')
        AND (b.employment_type = 'EMPLOYEE'
        OR (b.employment_type = 'SELF'
        AND b.tax_returns = 'YES'))
        OR (a.doc_type = 'LOW' OR a.doc_type = 'NO'));
