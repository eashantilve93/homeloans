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
