
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
    loan_offset = '1' AND loan_redraw = '1';

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
    loan_offset = '1';

select * from loan_options;