DROP table if exists loan_options;
DROP table if exists product;
DROP table if exists bank;
DROP table if exists doc_type;
DROP table if exists interest_type;
DROP table if exists cus_type;

CREATE TABLE cus_type (
    cus_type_id INT(2) AUTO_INCREMENT,
    cus_type VARCHAR(10) NOT NULL,
    PRIMARY KEY (cus_type_id)
);

CREATE TABLE interest_type (
    interest_type_id INT(2) AUTO_INCREMENT,
    interest_type VARCHAR(10) NOT NULL,
    PRIMARY KEY (interest_type_id)
);

CREATE TABLE doc_type (
    doc_type_id INT(2) AUTO_INCREMENT,
    doc_type VARCHAR(10) NOT NULL,
    PRIMARY KEY (doc_type_id)
);

CREATE TABLE bank (
    bank_id VARCHAR(10),
    bank_name VARCHAR(100) NOT NULL,
    PRIMARY KEY (bank_id)
);

CREATE TABLE product (
    product_id INT(5) AUTO_INCREMENT,
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
    id INT(5) AUTO_INCREMENT,
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

INSERT INTO cus_type(cus_type) values('INVESTOR' );
INSERT INTO cus_type(cus_type) values('OWNER' );

INSERT INTO interest_type(interest_type) values('FIXED' );
INSERT INTO interest_type(interest_type) values('VARIABLE' );

INSERT INTO doc_type(doc_type) values('NO' );
INSERT INTO doc_type(doc_type) values('LOW' );
INSERT INTO doc_type(doc_type) values('FULL' );

INSERT INTO bank values('CBA', 'Commonwealth Bank' );
INSERT INTO bank values('ANZ', 'Australia and New Zealand Bank' );

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
