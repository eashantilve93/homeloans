<<<<<<< HEAD

CREATE TABLE cus_type (
    cus_type_id INT(2),
=======
DROP table if exists loan_options;
DROP table if exists product;
DROP table if exists bank;
DROP table if exists doc_type;
DROP table if exists interest_type;
DROP table if exists cus_type;

CREATE TABLE cus_type (
    cus_type_id INT(2) AUTO_INCREMENT,
>>>>>>> e403c4a60850895f7508e77b9183660666222559
    cus_type VARCHAR(10) NOT NULL,
    PRIMARY KEY (cus_type_id)
);

CREATE TABLE interest_type (
<<<<<<< HEAD
    interest_type_id INT(2),
=======
    interest_type_id INT(2) AUTO_INCREMENT,
>>>>>>> e403c4a60850895f7508e77b9183660666222559
    interest_type VARCHAR(10) NOT NULL,
    PRIMARY KEY (interest_type_id)
);

CREATE TABLE doc_type (
<<<<<<< HEAD
    doc_type_id INT(2),
=======
    doc_type_id INT(2) AUTO_INCREMENT,
>>>>>>> e403c4a60850895f7508e77b9183660666222559
    doc_type VARCHAR(10) NOT NULL,
    PRIMARY KEY (doc_type_id)
);

CREATE TABLE bank (
    bank_id VARCHAR(10),
    bank_name VARCHAR(100) NOT NULL,
    PRIMARY KEY (bank_id)
);

CREATE TABLE product (
<<<<<<< HEAD
    product_id INT(5),
=======
    product_id INT(5) AUTO_INCREMENT,
>>>>>>> e403c4a60850895f7508e77b9183660666222559
    bank_id VARCHAR(10),
    product_name VARCHAR(100) NOT NULL,
    product_description VARCHAR(500),
    setup_costs REAL NOT NULL,
    ongoing_costs REAL NOT NULL,
    comparison_rate REAL NOT NULL,
    advertised_rate REAL NOT NULL,
    PRIMARY KEY (product_id),
    FOREIGN KEY (bank_id)
        REFERENCES bank (bank_id)
);

CREATE TABLE loan_options (
<<<<<<< HEAD
    id INT(5),
=======
    id INT(5) AUTO_INCREMENT,
>>>>>>> e403c4a60850895f7508e77b9183660666222559
    cus_type_id INT(2),
    max_lvr REAL NOT NULL,
    min_loan REAL,
    max_loan REAL,
    interest_type_id INT(2),
    loan_offset BIT,
    loan_redraw BIT,
    loan_extra_repay BIT,
    loan_interest_only BIT,
    doc_type_id INT(2),
    product_id INT(5),
    PRIMARY KEY (id),
    FOREIGN KEY (cus_type_id)
        REFERENCES cus_type (cus_type_id),
    FOREIGN KEY (interest_type_id)
        REFERENCES interest_type (interest_type_id),
    FOREIGN KEY (doc_type_id)
        REFERENCES doc_type (doc_type_id),
    FOREIGN KEY (product_id)
        REFERENCES product (product_id)
);

<<<<<<< HEAD
INSERT INTO cus_type values('1', 'INVESTOR' );
INSERT INTO cus_type values('2', 'OWNER' );

INSERT INTO interest_type values('1', 'FIXED' );
INSERT INTO interest_type values('2', 'VARIABLE' );

INSERT INTO doc_type values('1', 'NO' );
INSERT INTO doc_type values('2', 'LOW' );
INSERT INTO doc_type values('3', 'FULL' );
=======
INSERT INTO cus_type(cus_type) values('INVESTOR' );
INSERT INTO cus_type(cus_type) values('OWNER' );

INSERT INTO interest_type(interest_type) values('FIXED' );
INSERT INTO interest_type(interest_type) values('VARIABLE' );

INSERT INTO doc_type(doc_type) values('NO' );
INSERT INTO doc_type(doc_type) values('LOW' );
INSERT INTO doc_type(doc_type) values('FULL' );
>>>>>>> e403c4a60850895f7508e77b9183660666222559

INSERT INTO bank values('CBA', 'Commonwealth Bank' );
INSERT INTO bank values('ANZ', 'Australia and New Zealand Bank' );

<<<<<<< HEAD
INSERT INTO product values('1', 'CBA','Standard Home Loan', 'Standard Home Loan','500','500','4.5','4.4');

INSERT INTO loan_options values('1', '1','30', '0','50000000','2','1','1','1','1','3','1');

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
    bank where loan_offset = '1' AND loan_redraw = '1';

=======
INSERT INTO product(bank_id,
    product_name,
    product_description,
    setup_costs,
    ongoing_costs,
    comparison_rate,
    advertised_rate) values( 'CBA','Standard Home Loan', 'Standard Home Loan','500','500','4.5','4.4');
    
INSERT INTO product(bank_id,
    product_name,
    product_description,
    setup_costs,
    ongoing_costs,
    comparison_rate,
    advertised_rate) values('ANZ','Some Loan', 'Some Loan','5030','5030','4.2','4.1');

INSERT INTO loan_options(cus_type_id,
    max_lvr,
    min_loan,
    max_loan,
    interest_type_id,
    loan_offset,
    loan_redraw,
    loan_extra_repay,
    loan_interest_only,
    doc_type_id,
    product_id ) values( '1','30', '0','50000000','2','1','1','1','1','3','1');
    
INSERT INTO loan_options(cus_type_id,
    max_lvr,
    min_loan,
    max_loan,
    interest_type_id,
    loan_offset,
    loan_redraw,
    loan_extra_repay,
    loan_interest_only,
    doc_type_id,
    product_id ) values( '1','30', '0','50000000','2','1','1','1','1','3','2');
>>>>>>> e403c4a60850895f7508e77b9183660666222559
