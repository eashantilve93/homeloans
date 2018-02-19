<?php
$insertValues = $_GET["insertValues"];
$email = $_GET["email"];

$dbhost = $_SERVER['RDS_HOSTNAME'];
$dbport = $_SERVER['RDS_PORT'];
$dbname = $_SERVER['RDS_DB_NAME'];
$charset = 'utf8' ;

$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = $_SERVER['RDS_USERNAME'];
$password = $_SERVER['RDS_PASSWORD'];

$sql = "INSERT INTO cus_details(  cus_name,cus_email,cus_phone,refinance_home,purchase_price,deposit,cus_type,employment_type,tax_returns,loan_offset,loan_redraw,loan_extra_repay,interest_only,repayment_frequency,interest_type,first_home_buyers) VALUES(" . $insertValues . ")";

try {
	$pdo = new PDO($dsn, $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // use exec() because no results are returned
    $pdo->exec($sql);
    echo "New record created successfully";
	 
	header("location: search.php?email=" . $email);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

?>
