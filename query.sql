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
    product;
    
    SELECT * FROM cus_type;

show tables;

SELECT * FROM product NATURAL JOIN bank ;

use ebdb;

SELECT 
    a.product_name,
    bank_name,
    product_name,
    comparison_rate,
    advertised_rate
FROM
    product AS a
        JOIN
    cus_details AS b
WHERE
    ((a.has_full_offset = b.loan_offset
        AND b.loan_offset = 'true')
        OR b.loan_offset = 'false')
        AND b.cus_email = 'toby@gmail.com'
        AND ((a.has_redraw_facility = b.loan_redraw
        AND b.loan_redraw = 'true')
        OR b.loan_redraw = 'false')
        AND ((a.allows_extra_repay = b.loan_extra_repay
        AND b.loan_extra_repay = 'true')
        OR b.loan_extra_repay = 'false')
        AND ((b.interest_only = 'true'
        AND a.interest_only = 'true')
        OR (b.interest_only = 'false'
        AND a.principal_and_interest = 'true'))
        AND (b.repayment_frequency = 'ALL'
        OR (b.repayment_frequency = 'FORTNIGHTLY'
        AND a.has_fortnightly_repayments = 'true')
        OR (b.repayment_frequency = 'MONTHLY'
        AND a.has_monthly_repayments = 'true')
        OR (b.repayment_frequency = 'WEEKLY'
        AND a.has_weekly_repayments = 'true'))
        AND (b.purchase_price - b.deposit) >= min_borrowing_amount
        AND (b.purchase_price - b.deposit) <= max_borrowing_amount
        AND (b.purchase_price - b.deposit) / b.purchase_price <= max_LVR
        AND ((b.cus_type = 'INVESTOR'
        AND a.investment_purpose = 'true')
        OR (b.cus_type = 'OWNER'
        AND a.owner_occupied = 'true'))
        AND a.interest_only = b.interest_only
        AND ((b.employment_type = 'EMPLOYEE'
        OR (b.employment_type = 'SELF'
        AND b.tax_returns = 'true'))
        OR (a.allows_low_doc = 'true'));

SELECT * FROM product NATURAL JOIN bank WHERE product.bank_name='NAB' AND product_name='Choice Package Tailored Home Loan (Principal and Interest) ($750k+)';
   
SELECT * FROM product NATURAL JOIN bank WHERE product_name='Choice Package Tailored Home Loan (Principal and Interest) ($750k )'; 
 
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
        
