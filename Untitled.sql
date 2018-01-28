use ebdb;
DROP table if exists loan_options;
DROP table if exists cus_details;
DROP table if exists product;
DROP table if exists bank;
DROP table if exists doc_type;
DROP table if exists interest_type;
DROP table if exists cus_type;
DROP table if exists employment_type;
DROP table if exists loan_offset;
DROP table if exists loan_redraw;
DROP table if exists loan_extra_repay;
DROP table if exists loan_interest_only;
DROP table if exists loan_type;
DROP table if exists buying_situation;
DROP table if exists preapproved;
DROP table if exists tax_returns;
DROP table if exists exchanged_contracts;
DROP table if exists credit_history;

CREATE TABLE cus_type (
    cus_type VARCHAR(10) NOT NULL,
    PRIMARY KEY (cus_type)
);

CREATE TABLE employment_type (
    employment_type VARCHAR(20),
    PRIMARY KEY (employment_type)
);

CREATE TABLE interest_type (
    interest_type VARCHAR(10),
    PRIMARY KEY (interest_type)
);

CREATE TABLE doc_type (
    doc_type VARCHAR(5) NOT NULL,
    PRIMARY KEY (doc_type)
);

CREATE TABLE loan_offset (
    loan_offset VARCHAR(3),
    PRIMARY KEY (loan_offset)
);

CREATE TABLE loan_redraw (
    loan_redraw VARCHAR(3),
    PRIMARY KEY (loan_redraw)
);

CREATE TABLE loan_extra_repay (
    loan_extra_repay VARCHAR(3),
    PRIMARY KEY (loan_extra_repay)
);

CREATE TABLE loan_interest_only (
    loan_interest_only VARCHAR(3),
    PRIMARY KEY (loan_interest_only)
);

CREATE TABLE loan_type (
    loan_type VARCHAR(15) NOT NULL,
    PRIMARY KEY (loan_type)
);

CREATE TABLE buying_situation (
    buying_situation VARCHAR(10),
    PRIMARY KEY (buying_situation)
);

CREATE TABLE credit_history (
    credit_history VARCHAR(5),
    PRIMARY KEY (credit_history)
);

CREATE TABLE preapproved (
    preapproved VARCHAR(3),
    PRIMARY KEY (preapproved)
);

CREATE TABLE tax_returns (
    tax_returns VARCHAR(3),
    PRIMARY KEY (tax_returns)
);

CREATE TABLE exchanged_contracts (
    exchanged_contracts VARCHAR(3),
    PRIMARY KEY (exchanged_contracts)
);

CREATE TABLE bank (
    bank_id VARCHAR(10),
    bank_name VARCHAR(100) NOT NULL,
    bank_description VARCHAR(10000) NOT NULL,
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
    cus_type VARCHAR(10),
    max_lvr REAL NOT NULL,
    min_loan REAL,
    max_loan REAL,
    interest_type VARCHAR(10),
    loan_offset VARCHAR(3),
    loan_redraw VARCHAR(3),
    loan_extra_repay VARCHAR(3),
    loan_interest_only VARCHAR(3),
    doc_type VARCHAR(5),
    product_id INT(5),
    PRIMARY KEY (id),
    FOREIGN KEY (cus_type)
        REFERENCES cus_type (cus_type),
    FOREIGN KEY (interest_type)
        REFERENCES interest_type (interest_type),
    FOREIGN KEY (doc_type)
        REFERENCES doc_type (doc_type),
    FOREIGN KEY (loan_offset)
        REFERENCES loan_offset (loan_offset),
    FOREIGN KEY (loan_redraw)
        REFERENCES loan_redraw (loan_redraw),
    FOREIGN KEY (loan_extra_repay)
        REFERENCES loan_extra_repay (loan_extra_repay),
    FOREIGN KEY (loan_interest_only)
        REFERENCES loan_interest_only (loan_interest_only),
    FOREIGN KEY (product_id)
        REFERENCES product (product_id)
);

CREATE TABLE cus_details (
    cus_name VARCHAR(100) NOT NULL,
    cus_email VARCHAR(100) NOT NULL UNIQUE,
    cus_phone VARCHAR(20),
    loan_type VARCHAR(15),
    purchase_price INT(20),
    deposit INT(20),
    buying_situation VARCHAR(10),
    preapproved VARCHAR(3),
    exchanged_contracts VARCHAR(3),
    expected_settlement_date DATE,
    cus_type VARCHAR(10),
    credit_history VARCHAR(5),
    employment_type VARCHAR(20),
    tax_returns VARCHAR(3),
    loan_offset VARCHAR(3),
    loan_redraw VARCHAR(3),
    loan_extra_repay VARCHAR(3),
    loan_interest_only VARCHAR(3),
    PRIMARY KEY (cus_email),
    FOREIGN KEY (loan_type)
        REFERENCES loan_type (loan_type),
    FOREIGN KEY (buying_situation)
        REFERENCES buying_situation (buying_situation),
    FOREIGN KEY (preapproved)
        REFERENCES preapproved (preapproved),
    FOREIGN KEY (exchanged_contracts)
        REFERENCES exchanged_contracts (exchanged_contracts),
    FOREIGN KEY (cus_type)
        REFERENCES cus_type (cus_type),
    FOREIGN KEY (credit_history)
        REFERENCES credit_history (credit_history),
    FOREIGN KEY (employment_type)
        REFERENCES employment_type (employment_type),
	FOREIGN KEY (tax_returns)
        REFERENCES tax_returns (tax_returns),
    FOREIGN KEY (loan_interest_only)
        REFERENCES loan_interest_only (loan_interest_only),
    FOREIGN KEY (loan_offset)
        REFERENCES loan_offset (loan_offset),
    FOREIGN KEY (loan_redraw)
        REFERENCES loan_redraw (loan_redraw),
    FOREIGN KEY (loan_extra_repay)
        REFERENCES loan_extra_repay (loan_extra_repay),
    FOREIGN KEY (loan_interest_only)
        REFERENCES loan_interest_only (loan_interest_only)
);

INSERT INTO employment_type(employment_type) values('EMPLOYEE' );
INSERT INTO employment_type(employment_type) values('SELF' );
INSERT INTO employment_type(employment_type) values('OTHER' );

INSERT INTO exchanged_contracts values('YES' );
INSERT INTO exchanged_contracts values('NO' );
INSERT INTO exchanged_contracts values('NA' );

INSERT INTO loan_offset values('YES' );
INSERT INTO loan_offset values('NO' );

INSERT INTO loan_redraw values('YES' );
INSERT INTO loan_redraw values('NO' );

INSERT INTO loan_extra_repay values('YES' );
INSERT INTO loan_extra_repay values('NO' );

INSERT INTO loan_interest_only values('YES' );
INSERT INTO loan_interest_only values('NO' );

INSERT INTO tax_returns values('YES' );
INSERT INTO tax_returns values('NO' );
INSERT INTO tax_returns values('NA' );

INSERT INTO preapproved values('YES' );
INSERT INTO preapproved values('NO' );
INSERT INTO preapproved values('NA' );

INSERT INTO loan_type values('BUY');
INSERT INTO loan_type values('REFINANCE' );

INSERT INTO buying_situation values('READY' );
INSERT INTO buying_situation values('ACTIVE' );
INSERT INTO buying_situation values('6MONTHS');
INSERT INTO buying_situation values('EXPLORING');

INSERT INTO credit_history values('EXT');
INSERT INTO credit_history values('AVG');
INSERT INTO credit_history values('FAIR');
INSERT INTO credit_history values('POOR');

INSERT INTO cus_type(cus_type) values('INVESTOR' );
INSERT INTO cus_type(cus_type) values('OWNER' );

INSERT INTO interest_type(interest_type) values('FIX' );
INSERT INTO interest_type(interest_type) values('VAR' );

INSERT INTO doc_type(doc_type) values('NO' );
INSERT INTO doc_type(doc_type) values('LOW' );
INSERT INTO doc_type(doc_type) values('FULL' );

INSERT INTO bank values('CBA', 'Commonwealth Bank', 'Commonwealth Bank Decription');
INSERT INTO bank values('ANZ', 'Australia and New Zealand Bank' ,'Australia and New Zealand Bank Decription');


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

INSERT INTO loan_options(cus_type,
    max_lvr,
    min_loan,
    max_loan,
    interest_type,
    loan_offset,
    loan_redraw,
    loan_extra_repay,
    loan_interest_only,
    doc_type,
    product_id ) values( 'INVESTOR','90', '0','500000000','FIX','YES','YES','YES','YES','FULL','1');
    
INSERT INTO loan_options(cus_type,
    max_lvr,
    min_loan,
    max_loan,
    interest_type,
    loan_offset,
    loan_redraw,
    loan_extra_repay,
    loan_interest_only,
    doc_type,
    product_id ) values( 'INVESTOR','90', '0','500000000','FIX','YES','YES','YES','YES','FULL','2');
    
    INSERT INTO loan_options(cus_type,
    max_lvr,
    min_loan,
    max_loan,
    interest_type,
    loan_offset,
    loan_redraw,
    loan_extra_repay,
    loan_interest_only,
    doc_type,
    product_id ) values( 'OWNER','90', '0','500000000','FIX','YES','YES','YES','YES','FULL','2');
    
    
    INSERT INTO loan_options(cus_type,
    max_lvr,
    min_loan,
    max_loan,
    interest_type,
    loan_offset,
    loan_redraw,
    loan_extra_repay,
    loan_interest_only,
    doc_type,
    product_id ) values( 'OWNER','90', '0','500000000','FIX','YES','YES','YES','NO','FULL','2');
    
INSERT INTO cus_details VALUES(
     'Eashan',
    'eashantilve93@gmail.com',
    '451146447',
    'BUY',
    '1000000',
    '100',
    'READY',
    'YES',
    'YES',
    STR_TO_DATE('1-01-2019', '%d-%m-%Y'),
    'INVESTOR',
    'EXT',
    'EMPLOYEE',
    'NA',
    'YES',
    'YES',
    'YES',
    'YES'
    
);

