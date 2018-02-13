use ebdb;
DROP table if exists cus_details;
DROP table if exists product;
DROP table if exists bank;
DROP table if exists doc_type;
DROP table if exists cus_type;
DROP table if exists employment_type;
DROP table if exists loan_type;
DROP table if exists buying_situation;
DROP table if exists preapproved;
DROP table if exists tax_returns;
DROP table if exists exchanged_contracts;
DROP table if exists credit_history;
DROP table if exists allows_guarantor;
DROP table if exists allows_low_doc;
DROP table if exists allows_split_loan;
DROP table if exists has_any_ongoing_fees;
DROP table if exists has_fortnightly_repayments;
DROP table if exists has_full_offset;
DROP table if exists has_internet_withdrawals;
DROP table if exists has_monthly_repayments;
DROP table if exists has_offset_account;
DROP table if exists has_redraw_facility;
DROP table if exists has_repay_holiday;
DROP table if exists has_transaction_account;
DROP table if exists has_weekly_repayments;
DROP table if exists interest_only;
DROP table if exists principal_and_interest;
DROP table if exists investment_purpose;
DROP table if exists is_refinance_available;
DROP table if exists refinance_home;
DROP table if exists owner_occupied;
DROP table if exists ongoing_fee_frequency;

CREATE TABLE cus_type (
    cus_type VARCHAR(10) NOT NULL,
    PRIMARY KEY (cus_type)
);

CREATE TABLE employment_type (
    employment_type VARCHAR(20),
    PRIMARY KEY (employment_type)
);

CREATE TABLE doc_type (
    doc_type VARCHAR(5) NOT NULL,
    PRIMARY KEY (doc_type)
);

CREATE TABLE allows_guarantor (
    allows_guarantor VARCHAR(5),
    PRIMARY KEY (allows_guarantor)
);

CREATE TABLE allows_low_doc (
    allows_low_doc VARCHAR(5),
    PRIMARY KEY (allows_low_doc)
);

CREATE TABLE allows_split_loan (
    allows_split_loan VARCHAR(5),
    PRIMARY KEY (allows_split_loan)
);

CREATE TABLE has_any_ongoing_fees (
    has_any_ongoing_fees VARCHAR(5),
    PRIMARY KEY (has_any_ongoing_fees)
);

CREATE TABLE has_fortnightly_repayments (
    has_fortnightly_repayments VARCHAR(5),
    PRIMARY KEY (has_fortnightly_repayments)
);

CREATE TABLE has_full_offset (
    has_full_offset VARCHAR(5),
    PRIMARY KEY (has_full_offset)
);

CREATE TABLE has_internet_withdrawals (
    has_internet_withdrawals VARCHAR(5),
    PRIMARY KEY (has_internet_withdrawals)
);

CREATE TABLE has_monthly_repayments (
    has_monthly_repayments VARCHAR(5),
    PRIMARY KEY (has_monthly_repayments)
);

CREATE TABLE has_offset_account (
    has_offset_account VARCHAR(5),
    PRIMARY KEY (has_offset_account)
);


CREATE TABLE has_redraw_facility (
    has_redraw_facility VARCHAR(5),
    PRIMARY KEY (has_redraw_facility)
);

CREATE TABLE has_repay_holiday (
    has_repay_holiday VARCHAR(5),
    PRIMARY KEY (has_repay_holiday)
);

CREATE TABLE has_transaction_account (
    has_transaction_account VARCHAR(5),
    PRIMARY KEY (has_transaction_account)
);

CREATE TABLE has_weekly_repayments (
    has_weekly_repayments VARCHAR(5),
    PRIMARY KEY (has_weekly_repayments)
);

CREATE TABLE interest_only (
    interest_only VARCHAR(5),
    PRIMARY KEY (interest_only)
);

CREATE TABLE principal_and_interest (
    principal_and_interest VARCHAR(5),
    PRIMARY KEY (principal_and_interest)
);

CREATE TABLE investment_purpose (
    investment_purpose VARCHAR(5),
    PRIMARY KEY (investment_purpose)
);

CREATE TABLE is_refinance_available (
    is_refinance_available VARCHAR(5),
    PRIMARY KEY (is_refinance_available)
);

CREATE TABLE refinance_home (
    refinance_home VARCHAR(5),
    PRIMARY KEY (refinance_home)
);

CREATE TABLE owner_occupied (
    owner_occupied VARCHAR(5),
    PRIMARY KEY (owner_occupied)
);

CREATE TABLE ongoing_fee_frequency (
    ongoing_fee_frequency VARCHAR(10),
    PRIMARY KEY (ongoing_fee_frequency)
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
    preapproved VARCHAR(5),
    PRIMARY KEY (preapproved)
);

CREATE TABLE tax_returns (
    tax_returns VARCHAR(3),
    PRIMARY KEY (tax_returns)
);

CREATE TABLE exchanged_contracts (
    exchanged_contracts VARCHAR(5),
    PRIMARY KEY (exchanged_contracts)
);

CREATE TABLE bank (
    bank_name VARCHAR(100),
    bank_description VARCHAR(10000) NOT NULL,
    PRIMARY KEY (bank_name)
);

CREATE TABLE product (
    product_name VARCHAR(100),
	bank_name VARCHAR(100),
    advertised_rate REAL,
    allows_extra_repay VARCHAR(5),
    extra_repayments VARCHAR(50),
	extra_repayments_value REAL,
	allows_guarantor VARCHAR(5),
	allows_low_doc VARCHAR(5),
    allows_split_loan VARCHAR(5),
    has_any_ongoing_fees VARCHAR(5),
    has_fortnightly_repayments VARCHAR(5),
    has_full_offset VARCHAR(5),
    has_internet_withdrawals VARCHAR(5),
    has_monthly_repayments VARCHAR(5),
    has_offset_account VARCHAR(5),
    has_redraw_facility VARCHAR(5),
    has_repay_holiday VARCHAR(5),
    has_transaction_account VARCHAR(5),
    has_weekly_repayments VARCHAR(5),
    interest_only VARCHAR(5),
    principal_and_interest VARCHAR(5),
    investment_purpose VARCHAR(5),
    is_refinance_available VARCHAR(5),
    owner_occupied VARCHAR(5),
	refinance_home VARCHAR(5),
    annual_fees REAL,
    application_fee REAL,
    comparison_rate REAL,
    discharge_fee REAL,
    introductory_rate REAL,
    redraw_activation_fee REAL,
    ongoing_fee REAL,
    ongoing_fee_frequency VARCHAR(10),
    legal_fee VARCHAR(10),
    valuation_fee VARCHAR(10),
    max_borrowing_amount REAL,
    min_borrowing_amount REAL,
    max_LVR REAL,
    max_loan_term REAL,
    min_loan_term REAL,
    min_deposit REAL,
    offset_account VARCHAR(50),
    rate_type VARCHAR(50),
    redraw_fee VARCHAR(50),
    revert_ongoing_fee_freq varchar(5),
    revert_rate REAL,
    settlement_fee REAL,
    upfront_fee REAL,
    PRIMARY KEY (product_name,bank_name),
    FOREIGN KEY (bank_name)
        REFERENCES bank (bank_name),
	FOREIGN KEY (allows_extra_repay)
        REFERENCES allows_extra_repay (allows_extra_repay),
	FOREIGN KEY (allows_guarantor)
        REFERENCES allows_guarantor (allows_guarantor),
    FOREIGN KEY (allows_low_doc)
        REFERENCES allows_low_doc (allows_low_doc),
	FOREIGN KEY (allows_split_loan)
        REFERENCES allows_split_loan (allows_split_loan),
	FOREIGN KEY (has_any_ongoing_fees)
        REFERENCES has_any_ongoing_fees (has_any_ongoing_fees),
	FOREIGN KEY (has_fortnightly_repayments)
        REFERENCES has_fortnightly_repayments (has_fortnightly_repayments),
	FOREIGN KEY (has_full_offset)
        REFERENCES has_full_offset (has_full_offset),
	FOREIGN KEY (has_internet_withdrawals)
        REFERENCES has_internet_withdrawals (has_internet_withdrawals),
	FOREIGN KEY (has_monthly_repayments)
        REFERENCES has_monthly_repayments (has_monthly_repayments),
	FOREIGN KEY (has_offset_account)
        REFERENCES has_offset_account (has_offset_account),
	FOREIGN KEY (has_redraw_facility)
        REFERENCES has_redraw_facility (has_redraw_facility),
	FOREIGN KEY (has_repay_holiday)
        REFERENCES has_repay_holiday (has_repay_holiday),
	FOREIGN KEY (has_transaction_account)
        REFERENCES has_transaction_account (has_transaction_account),
	FOREIGN KEY (has_weekly_repayments)
        REFERENCES has_weekly_repayments (has_weekly_repayments),
	FOREIGN KEY (interest_only)
        REFERENCES interest_only (interest_only),
	FOREIGN KEY (investment_purpose)
        REFERENCES investment_purpose (investment_purpose),
	FOREIGN KEY (is_refinance_available)
        REFERENCES is_refinance_available (is_refinance_available),
	FOREIGN KEY (ongoing_fee_frequency)
        REFERENCES ongoing_fee_frequency (ongoing_fee_frequency),
	FOREIGN KEY (owner_occupied)
        REFERENCES owner_occupied (owner_occupied),
	FOREIGN KEY (refinance_home)
        REFERENCES refinance_home (refinance_home)
);

CREATE TABLE cus_details (
    cus_name VARCHAR(100) NOT NULL,
    cus_email VARCHAR(100) NOT NULL UNIQUE,
    cus_phone VARCHAR(20),
    refinance_home VARCHAR(5),
    purchase_price INT(20),
    deposit INT(20),
    buying_situation VARCHAR(10),
    preapproved VARCHAR(5),
    exchanged_contracts VARCHAR(5),
    expected_settlement_date DATE,
    cus_type VARCHAR(10),
    credit_history VARCHAR(5),
    employment_type VARCHAR(20),
    tax_returns VARCHAR(3),
    loan_offset VARCHAR(5),
    loan_redraw VARCHAR(5),
    loan_extra_repay VARCHAR(5),
    interest_only VARCHAR(5),
    PRIMARY KEY (cus_email),
    FOREIGN KEY (refinance_home)
        REFERENCES refinance_home (refinance_home),
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
    FOREIGN KEY (loan_offset)
        REFERENCES has_full_offset (has_full_offset),
    FOREIGN KEY (loan_redraw)
        REFERENCES has_redraw_facility (has_redraw_facility),
    FOREIGN KEY (loan_extra_repay)
        REFERENCES allows_extra_repay (allows_extra_repay),
    FOREIGN KEY (interest_only)
        REFERENCES interest_only (interest_only)
	
);

INSERT INTO employment_type(employment_type) values('EMPLOYEE' );
INSERT INTO employment_type(employment_type) values('SELF' );
INSERT INTO employment_type(employment_type) values('OTHER' );

INSERT INTO exchanged_contracts values('true' );
INSERT INTO exchanged_contracts values('false' );
INSERT INTO exchanged_contracts values('NA' );

INSERT INTO allows_guarantor values('false' );
INSERT INTO allows_guarantor values('true' );

INSERT INTO allows_low_doc values('false' );
INSERT INTO allows_low_doc values('true' );

INSERT INTO allows_split_loan values('false' );
INSERT INTO allows_split_loan values('true' );

INSERT INTO has_any_ongoing_fees values('false' );
INSERT INTO has_any_ongoing_fees values('true' );

INSERT INTO has_fortnightly_repayments values('false' );
INSERT INTO has_fortnightly_repayments values('true' );

INSERT INTO has_full_offset values('false' );
INSERT INTO has_full_offset values('true' );

INSERT INTO has_internet_withdrawals values('false' );
INSERT INTO has_internet_withdrawals values('true' );

INSERT INTO has_monthly_repayments values('false' );
INSERT INTO has_monthly_repayments values('true' );

INSERT INTO has_offset_account values('false' );
INSERT INTO has_offset_account values('true' );

INSERT INTO investment_purpose values('false' );
INSERT INTO investment_purpose values('true' );

INSERT INTO is_refinance_available values('false' );
INSERT INTO is_refinance_available values('true' );

INSERT INTO owner_occupied values('false' );
INSERT INTO owner_occupied values('true' );

INSERT INTO has_redraw_facility values('false' );
INSERT INTO has_redraw_facility values('true' );

INSERT INTO has_repay_holiday values('false' );
INSERT INTO has_repay_holiday values('true' );

INSERT INTO has_transaction_account values('false' );
INSERT INTO has_transaction_account values('true' );

INSERT INTO has_weekly_repayments values('false' );
INSERT INTO has_weekly_repayments values('true' );

INSERT INTO refinance_home values('false' );
INSERT INTO refinance_home values('true' );

INSERT INTO ongoing_fee_frequency values('monthly' );
INSERT INTO ongoing_fee_frequency values('annually' );
INSERT INTO ongoing_fee_frequency values('' );

INSERT INTO interest_only values('false' );
INSERT INTO interest_only values('true' );

INSERT INTO principal_and_interest values('false' );
INSERT INTO principal_and_interest values('true' );

INSERT INTO tax_returns values('true' );
INSERT INTO tax_returns values('false' );
INSERT INTO tax_returns values('NA' );

INSERT INTO preapproved values('true' );
INSERT INTO preapproved values('false' );
INSERT INTO preapproved values('NA' );

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

INSERT INTO doc_type(doc_type) values('NO' );
INSERT INTO doc_type(doc_type) values('LOW' );
INSERT INTO doc_type(doc_type) values('FULL' );

INSERT INTO cus_details VALUES(
     'Eashan',
    'eashantilve93@gmail.com',
    '451146447',
    'true',
    '1000000',
    '100',
    'READY',
    'true',
    'true',
    STR_TO_DATE('1-01-2019', '%d-%m-%Y'),
    'INVESTOR',
    'EXT',
    'EMPLOYEE',
    'NA',
    'true',
    'true',
    'true',
    'true'
    
);

