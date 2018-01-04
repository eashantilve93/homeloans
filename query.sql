SELECT 
    bank_name,
    product_name,
    setup_costs,
    ongoing_costs,
    comparison_rate,
    advertised_rate
FROM
    loan_options
        NATURAL JOIN
    product
        NATURAL JOIN
    bank
WHERE
    loan_offset = '1' AND loan_redraw = '1'
        AND 123 >= min_loan
        AND 123 <= max_loan
        AND 0.09909445393316361 <= max_lvr
        AND cus_type_id = '2'
        AND loan_interest_only = '0'
        AND (doc_type_id = '1' OR doc_type_id = '2'
        OR doc_type_id = '3');

        
SELECT 
    *
FROM
    loan_options;
    
