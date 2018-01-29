<!DOCTYPE html>
<html>
<head>
<title>Page I</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript"
	src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
<script type="text/javascript"
	src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/tripledes.js"></script>
<script src="https://use.fontawesome.com/bd42e35c2d.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./productCSS.css">

</head>
<body>
	<div class="navLayout app" style="min-height: 600px;">
		<div class="navDrawer">
			<div class="navDrawerHeader">
				<div>
					<img src="//cdn.unohomeloans.com.au/images/uno-white.svg"
						class="gwt-Image"> <span class="label inline">V.3.42.1113</span>
				</div>

			</div>
			<div class="navDrawerBody">
				<div class="drawerUserProfile drawerMenuItem">
					<i class="i-user" style=""></i><a class="anchor"
						href="javascript:;" aria-hidden="true" style="display: none;"></a><a
						class="button push signUpButton" href="javascript:;"><span>Sign
							up</span></a><a class="button push loginButton" href="javascript:;"><span>Login</span></a>
				</div>
				<div>
					<div class="drawerMenuItem">
						<i class="i-home" style=""></i> <a class="anchor"
							href="javascript:;">Dashboard</a>
					</div>
					<div class="drawerMenuItem">
						<i class="i-calculate" style=""></i> <a class="anchor"
							href="javascript:;">Calculators</a>
					</div>
					<div class="drawerMenuItem">
						<i class="i-search" style=""></i> <a class="anchor"
							href="javascript:;">Search loans</a>
					</div>
					<div class="drawerMenuItem">
						<i class="i-shortlist" style=""></i> <a class="anchor"
							href="javascript:;">Compare</a>
					</div>
					<div class="drawerMenuItem">
						<i class="i-apply" style=""></i> <a class="anchor"
							href="javascript:;">Apply</a>
					</div>
				</div>
			</div>
			<div class="navDrawerFooter">
				<a class="drawerMenuItem" href="https://unohomeloans.com.au/learn"
					target="_blank"> <i class="i-help" style=""></i><span>Help</span></a>
			</div>
		</div>
		<div class="mobile">
			<div class="navTopBar">
				<div class="navTopBarPrimary">
					<a class="button" href="javascript:;" id="openNavDraw"
						aria-hidden="true" style="display: block; float: left;"><i
						class="fa fa-bars" style="font-size: 24px;"></i><span></span></a>


					<h1 style="float: left;"></h1>
					<div class="appLogo" style="float: left;">
						<img src="//cdn.unohomeloans.com.au/images/uno.svg"
							class="gwt-Image">
					</div>
					<div class="topBarUserProfile" style="float: right;">
						<a class="button signUp" href="javascript:;"><span>Sign
								up</span></a> <a class="button logIn" href="javascript:;"><span>Login</span></a>
						<div style="display: none;">
							<div class="label"></div>
							<div class="topBarUserAvatar">
								<span class="iconField"> <img
									src="/api/user-account/avatar/-1/new">
								</span>
							</div>
							<span class="iconField"> <i class="fa fa-angle-down"></i>
							</span>
						</div>
					</div>
					<div class="advisorPanel offline" aria-hidden="true"
						style="display: show; float: right;">
						<span class="advisorIcon"> <img
							src="//cdn.unohomeloans.com.au/images/headshot-carlo.jpg"
							class="gwt-Image"></span> <span class="advisorInfo">
							<div class="advisorStatus">
								<span>Chat now?</span>
								<div class="advisorTitle">Carlo is offline</div>
							</div>
						</span>
					</div>
					<span style="float: right;">133 866</span> <a class="anchor"
						href="https://unohomeloans.com.au/how-it-works" target="_blank"
						style="float: right;">How uno works</a>
				</div>
			</div>
			<div class="navContent pageContainer" style="padding-top: 65px;">
				<div class="fitPanel pageDisplay">
					<div class="page container-fluid productPage">
						<?php
$email = $_GET["email"];
$loan = $_GET["loan"];

$dbhost = $_SERVER['RDS_HOSTNAME'];
$dbport = $_SERVER['RDS_PORT'];
$dbname = $_SERVER['RDS_DB_NAME'];
$charset = 'utf8' ;

$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = $_SERVER['RDS_USERNAME'];
$password = $_SERVER['RDS_PASSWORD'];
$pdo = new PDO($dsn, $username, $password);


$halfQuery = " FROM
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
		AND b.cus_email =  '" . $email . "'
        AND a.loan_redraw = b.loan_redraw
		AND a.loan_extra_repay = b.loan_extra_repay
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
        OR (a.doc_type = 'LOW' OR a.doc_type = 'NO'))";

$sql = "SELECT 
    a.id,
    bank_name,
    product_name,
    comparison_rate,
    advertised_rate " . $halfQuery;

$sqlCount = "SELECT count(1) as rowCount " . $halfQuery;

 foreach ($pdo->query($sqlCount) as $row) {
$count = $row['rowCount'];
}

$sqlCusDetails = "SELECT * FROM cus_details WHERE cus_email='" . $email . "'";
echo $sqlCusDetails;
foreach ($pdo->query($sqlCusDetails) as $row) {
 $loanType = $row['loan_type'];
 $purchasePrice = $row['purchase_price'];
 $deposit = $row['deposit'];
 $cusType = $row['cus_type']; 
 $employmentType = $row['employment_type'] ;
 $loanOffset = $row['loan_offset'] ;
 $loanRedraw = $row['loan_redraw'] ;
 $loanExtraRepay = $row['loan_extra_repay'];
 $loanInterestOnly = $row['loan_interest_only'];
}
echo "loan type" . $loanType ;
$loan = (float)$purchasePrice - (float)$deposit;
echo "loan" . $loan;
?>
						<div>
							<div></div>
							<div class="modifySearch">
								<span>We found <?php print $count;?> matching
									home loans.
								</span> <a> Modify your search</a> <span class="compareButton">Compare
									<small>3</small>
								</span>
							</div>
							<div class="container">
								<div class="row row-inline titleBar">
									<div class="mainSection col-xs-12">
										<div>
											<span class="breadCrumb"><a class="anchor"
												href="javascript:;">Dashboard</a><span>/</span><span>Search
													results</span></span>
											<h2>
												We found
												<?php print $count;?>
												matching home loans
											</h2>
										</div>
									</div>
								</div>
							</div>

							<div class="searchBar">
								<div class="container">
									<div class="menu" id="menu1">
										<div class="sTitle">
											<span>I WANT TO</span> <span class="iconField"><i
												class="fa fa fa-angle-down"></i></span>
										</div>
										<div class="sDesc">
											<span id="menu1content"> <?php echo $loanType; ?>
											</span>
										</div>
									</div>
									<div class="menu" id="menu2">
										<div class="sTitle">
											<span>BORROW</span> <span class="iconField"><i
												class="fa fa fa-angle-down"></i></span>
										</div>
										<div class="sDesc">
											<span> <?php echo $loan; ?>
											</span>
										</div>
									</div>
									<div class="menu" id="menu3">
										<div class="sTitle">
											<span>REPAYING</span> <span class="iconField"><i
												class="fa fa fa-angle-down"></i></span>
										</div>
										<div class="sDesc">
											<span id="menu3content"></span>
										</div>
									</div>
									<div class="menu" id="menu4">
										<div class="sTitle">
											<span>INTEREST RATE &amp; FEATURES</span> <span
												class="iconField"><i class="fa fa fa-angle-down"></i></span>
										</div>
										<div class="sDesc">
											<span>Variable</span>
										</div>
									</div>
									<div class="menu" id="menu5">
										<div class="sTitle">
											<span>SHOW</span><span class="iconField"><i
												class="fa fa fa-angle-down"></i></span>
										</div>
										<div class="sDesc">
											<span>All lenders</span>
										</div>
									</div>
									<div class="menu">
										<div class="sTitle">
											<span>BORROWING POWER</span><span class="iconField"><i
												class="fa fa fa-calculator"></i></span>
										</div>
										<div class="sDesc">
											<span>NULL</span>
										</div>
									</div>
								</div>
							</div>

							<?php

echo "the query: " . $sql;
echo "<br>";
    foreach ($pdo->query($sql) as $row) {
		print $row['id'] . "\t";
		print $row['rowCount'] . "\t";
        print $row['bank_name'] . "\t";
        print $row['product_name'] . "\t";
        print $row['setup_costs'] . "\t";
        print $row['ongoing_costs'] . "\t";
        print $row['comparison_rate'] . "\t";
        print $row['advertised_rate'];
		echo "<br>";

?>
							<!-- Table starts here-->
							<div class="wrapper">
								<div class="productTable container">
									<div class="productRow productTableHeader collectionCard odd">

										<div class="lenderColumn">Lender</div>
										<div class="loanAmountColumn">Total loan amount</div>
										<div class="interestRateColumn">
											<span>Interest rate<sup>2</sup></span> <span
												class="iconField" style="cursor: pointer;"> <img
												onload="this.__gwtLastUnhandledEvent=&quot;load&quot;;"
												src="https://unohomeloans.com.au/home-loans/clear.cache.gif"
												style="width: 16px; height: 16px; background: url(https://unohomeloans.com.au/home-loans/E88523BFCEE66BB8CA22ECB17362E8B6.cache.png) no-repeat -32px 0px;"
												border="0"></span>
										</div>
										<div class="comparisonRateColumn">
											<span>Comparison rate<sup>1</sup></span><span
												class="iconField" style="cursor: pointer;"><img
												onload="this.__gwtLastUnhandledEvent=&quot;load&quot;;"
												src="https://unohomeloans.com.au/home-loans/clear.cache.gif"
												style="width: 16px; height: 16px; background: url(https://unohomeloans.com.au/home-loans/E88523BFCEE66BB8CA22ECB17362E8B6.cache.png) no-repeat 0px 0px;"
												border="0"></span>
										</div>
										<div class="paymentsColumn">
											<span>Monthly payments</span><span class="iconField"
												style="cursor: pointer;"><img
												onload="this.__gwtLastUnhandledEvent=&quot;load&quot;;"
												src="https://unohomeloans.com.au/home-loans/clear.cache.gif"
												style="width: 16px; height: 16px; background: url(https://unohomeloans.com.au/home-loans/E88523BFCEE66BB8CA22ECB17362E8B6.cache.png) no-repeat 0px 0px;"
												border="0"></span>
										</div>
										<div class="borrowingPowerColumn">Borrowing power</div>
										<div class="ctaColumn">
											<div class="compareButton">
												Compare loans <small>0</small>
											</div>
										</div>
									</div>

									<div class="mobileRow">
										<div class="productRow bestMatchProduct collectionCard even">
											<div class="bestMatchLabel">BEST MATCH</div>
											<div class="popularLender nTooltip">
												POPULAR LENDER
												<div class="nTooltipText">
													Popularity is based on:
													<ul>
														<li>- Number of times home loans from this lender
															were added to Compare list</li>
														<li>- Number of applications submitted for home loans
															from this lender</li>
													</ul>
												</div>
											</div>
											<div class="productSummary">
												<span class="lenderLogo"><img width="40"
													src="https://cdn.unohomeloans.com.au/lenders/logo/HLL.svg"
													onerror="this.onerror=null;this.src='https://cdn.unohomeloans.com.au/lenders/logo/DEFAULT.svg'"></span>
												<div class="interestRateColumn">
													<h3>
														<?php print $row['advertised_rate'] . "%"; ?>
													</h3>
													<div class="productDiscount"></div>
												</div>
												<h3 class="comparisonRateColumn">
													<?php print $row['comparison_rate'] . "%"; ?>
												</h3>
												<h3 class="paymentsColumn">NULL</h3>
												<span class="iconField" style="cursor: pointer;"><img
													src="//cdn.unohomeloans.com.au/icons/icon-star-off.svg"></span>
											</div>
											<div class="borrowingPowerIndicator">
												<div class="levelBar">
													<div class="levelHigh"></div>
												</div>
												<div class="levelBarInfo">
													<span class="levelHigh">High</span> borrowing power
												</div>
											</div>
											<div class="productSummary">
												<div class="productName">
													<span><strong> <?php print $row['product_name'];?>
													</strong></span><span> - <?php print $row['product_name'];?></span><span>
														- Variable Rate</span>
												</div>
												<a class="button"
													href="./product.php?id=<?php echo $row['id']; ?>"><span>View
														details</span></a>
											</div>
										</div>
									</div>
									<div class="other">
										<div class="productRow bestMatchProduct collectionCard even">
											<div class="lenderColumn">
												<span class="lenderLogo"><img width="40"
													src="https://cdn.unohomeloans.com.au/lenders/logo/CBA.svg"
													onerror="this.onerror=null;this.src='https://cdn.unohomeloans.com.au/lenders/logo/DEFAULT.svg'"></span>
												<div class="bestMatchLabel">BEST MATCH</div>
												<div class="productName">
													<span><strong> <?php print $row['bank_name'];?>
													</strong></span><span> - Extra Variable Rate</span><span> - Variable
														Rate</span>
													<div class="productFeatureContainer">
														<p class="featureFalse offsetFeature" >
															<i class="icon-cross offsetFeatureTick"></i><span>Offset</span>
														</p>
														<p class="featureFalse redrawFeature">
															<i class="icon-cross redrawFeatureTick"></i><span>Redraw</span>
														</p>
														<p class="featureFalse extra_repayFeature">
															<i class="icon-cross extra_repayFeatureTick"></i><span>Extra
																Repayment</span>
														</p>
													</div>
												</div>
											</div>

											<div class="loanAmountColumn">
												<h3>
													<?php print "$" . $loan ;?>
												</h3>
												<div class="lmiInfo"></div>
											</div>
											<div class="interestRateColumn">
												<h3>
													<?php print $row['advertised_rate'] . "%"; ?>
												</h3>
												<div class="productDiscount">-0.46% included</div>
											</div>
											<h3 class="comparisonRateColumn">
												<?php print $row['comparison_rate'] . "%"; ?>
											</h3>
											<h3 class="paymentsColumn">NULL</h3>
											<div class="borrowingPowerColumn">
												<div class="borrowingPowerIndicator">
													<div class="levelBar">
														<div class="levelHigh">High</div>
													</div>
													<div class="levelBarInfo">Loan amount within lender's
														max borrowing limit</div>
													<a class="callToAction">Get advice</a>
												</div>
											</div>
											<div class="ctaColumn">
												<a class="button"
													href="./product.php?id=<?php echo $row['id']; ?>"><span>View
														details</span></a> <span class="iconField" style="cursor: pointer;"><img
													src="//cdn.unohomeloans.com.au/icons/icon-star-off.svg"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php	
		    }
echo "<br>";
echo "testing";

?>

							<div class="productPageFootNote container">
								<div>
									<sup>1</sup> WARNING: This comparison rate is true only for the
									examples given and may not include all fees and charges.
									Different terms, fees or other loan amounts might result in a
									different comparison rate. The comparison rate is calculated on
									the basis of a loan of $150,000 over a term of 25 years.
								</div>

								<div>
									<sup>2</sup> Results are based on what you entered and should
									be used as a guide only. Lender rates and products may change.
									We cannot recommend a product until we have double checked that
									the home loan is suitable for you.
								</div>
							</div>

						</div>
						<div class="logPanel" aria-hidden="true" style="display: none;">
							<a class="button" href="javascript:;"><span>close</span></a>
							<div>
								<pre></pre>
							</div>
						</div>
						<div class="popup searchMenuContentPopup" id="firstBox"
							style="position: absolute; left: 152px; top: 160px; margin-top: 0px; opacity: 1; display: none;">
							<div class="searchMenuContent">
								<div class="container-fluid">
									<div class="simple-form-default">
										<div class="simpleForm">
											<div class="simpleFormSection collectionCard odd" id="">
												<span class="simpleFormSectionTitle" aria-hidden="true"
													style="display: none;"></span><span
													class="simpleFormSectionTitleDescription"
													aria-hidden="true" style="display: none;"></span>
												<div class="simpleFormRow vertical">
													<span class="simpleFormRowTitle"><span>I want
															to</span><span class="simpleFormRowSubTitle"></span></span><span
														class="simpleFormSelection simpleFormRowField"
														tabindex="0"><select class="gwt-ListBox comboBox"
														id="loanType">
															<option value="Purchase">Buy a property</option>
															<option value="Refinance">Refinance my home loan</option>
													</select><i class="fa fa-angle-down"></i></span>
												</div>
												<div class="simpleFormRow vertical">
													<span class="simpleFormRowTitle"><span>Purpose
															is</span><span class="simpleFormRowSubTitle"></span></span>
													<div class="radioBoxes vertical simpleFormRowField"
														tabindex="0">
														<span class="radioBox flat"> <input type="radio"
															name="gwt-uid-1" value="on" id="gwt-uid-2" tabindex="0">
															<label for="gwt-uid-2"><span></span></label> <label
															for="gwt-uid-2">To live in</label>
														</span> <span class="radioBox flat"> <input type="radio"
															name="gwt-uid-1" value="on" id="gwt-uid-3" tabindex="0">
															<label for="gwt-uid-3"> <span></span></label> <label
															for="gwt-uid-3">Investment</label>
														</span>
													</div>
												</div>
												<div class="simpleFormRow vertical">
													<span class="simpleFormRowTitle"><span>Property
															location</span><span class="simpleFormRowSubTitle"></span></span><span
														class="simpleFormSelection simpleFormRowField"
														tabindex="0"><select class="gwt-ListBox comboBox"><option
																value="">Select one</option>
															<option value="ACT">ACT</option>
															<option value="NSW">NSW</option>
															<option value="NT">NT</option>
															<option value="QLD">QLD</option>
															<option value="SA">SA</option>
															<option value="TAS">TAS</option>
															<option value="VIC">VIC</option>
															<option value="WA">WA</option></select><i class="fa fa-angle-down"></i></span>
												</div>
												<div class="simpleFormRow vertical" aria-hidden="true"
													style="display: none;">
													<span class="simpleFormRowTitle"><span>I'm
															purchasing</span><span class="simpleFormRowSubTitle"></span></span><span
														class="simpleFormSelection simpleFormRowField"
														tabindex="0"><select class="gwt-ListBox comboBox"><option
																value="">Select one</option>
															<option value="A New Home">A New Home</option>
															<option value="Construction">Construction</option>
															<option value="An Established Home">An
																Established Home</option>
															<option value="Vacant Land">Vacant Land</option></select><i
														class="fa fa-angle-down"></i></span>
												</div>
												<div class="simpleFormRow vertical">
													<span class="simpleFormRowTitle"><span>First
															home buyer?</span><span class="simpleFormRowSubTitle"></span></span>
													<div class="radioBoxes horizontal simpleFormRowField"
														tabindex="0">
														<span class="radioBox flat"><input type="radio"
															name="gwt-uid-4" value="on" id="gwt-uid-5" tabindex="0"><label
															for="gwt-uid-5"><span></span></label><label
															for="gwt-uid-5">Yes</label></span><span class="radioBox flat"><input
															type="radio" name="gwt-uid-4" value="on" id="gwt-uid-6"
															tabindex="0" checked=""><label for="gwt-uid-6"><span></span></label><label
															for="gwt-uid-6">No</label></span>
													</div>
												</div>
											</div>
										</div>
										<div class="searchMenuContentButtonContainer">
											<a class="button push searchMenuContentButton"
												onclick="update1()"><span>Update search</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="popup searchMenuContentPopup" id="secondBox"
							style="position: absolute; left: 314px; top: 160px; margin-top: 0px; opacity: 1; display: none;">
							<div class="searchMenuContent">
								<div class="container-fluid">
									<div class="simple-form-default">
										<div class="simpleForm">
											<div class="simpleFormSection collectionCard odd" id="">
												<span class="simpleFormSectionTitle" aria-hidden="true"
													style="display: none;"></span><span
													class="simpleFormSectionTitleDescription"
													aria-hidden="true" style="display: none;"></span>
												<div class="simpleFormPlaceHolderRow"
													style="position: relative;">
													<div class="simpleFormSection rowWithLeadingWidget" id="">
														<span class="simpleFormSectionTitle" aria-hidden="true"
															style="display: none;"></span><span
															class="simpleFormSectionTitleDescription"
															aria-hidden="true" style="display: none;"></span>
														<div class="simpleFormRow vertical leadingWidget">
															<span class="simpleFormRowTitle" aria-hidden="true"
																style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span
																class="simpleFormRowSubTitle"></span></span>
															<div class="simpleFormPlaceHolderRow simpleFormRowField"
																tabindex="0" style="position: relative;">
																<div></div>
															</div>
														</div>
														<div class="simpleFormRow vertical tailingRow">
															<span class="simpleFormRowTitle"><span>Property
																	worth</span><span class="simpleFormRowSubTitle"></span></span><input
																type="text"
																class="textField numberField simpleFormRowField"
																tabindex="0">
														</div>
													</div>
												</div>
												<div class="simpleFormPlaceHolderRow"
													style="position: relative;">
													<div class="simpleFormSection rowWithLeadingWidget" id="">
														<span class="simpleFormSectionTitle" aria-hidden="true"
															style="display: none;"></span><span
															class="simpleFormSectionTitleDescription"
															aria-hidden="true" style="display: none;"></span>
														<div class="simpleFormRow vertical leadingWidget">
															<span class="simpleFormRowTitle" aria-hidden="true"
																style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span
																class="simpleFormRowSubTitle"></span></span>
															<div class="simpleFormPlaceHolderRow simpleFormRowField"
																tabindex="0" style="position: relative;">
																<div></div>
															</div>
														</div>
														<div class="simpleFormRow vertical tailingRow">
															<span class="simpleFormRowTitle"><span>I
																	currently owe</span><span class="simpleFormRowSubTitle"></span></span><input
																type="text"
																class="textField numberField simpleFormRowField"
																tabindex="0">
														</div>
													</div>
												</div>
												<div class="simpleFormPlaceHolderRow"
													style="position: relative;">
													<div class="simpleFormSection rowWithLeadingWidget" id="">
														<span class="simpleFormSectionTitle" aria-hidden="true"
															style="display: none;"></span><span
															class="simpleFormSectionTitleDescription"
															aria-hidden="true" style="display: none;"></span>
														<div class="simpleFormRow vertical leadingWidget">
															<span class="simpleFormRowTitle" aria-hidden="true"
																style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span
																class="simpleFormRowSubTitle"></span></span>
															<div class="simpleFormPlaceHolderRow simpleFormRowField"
																tabindex="0" style="position: relative;">
																<span>+</span>
															</div>
														</div>
														<div class="simpleFormRow vertical tailingRow">
															<span class="simpleFormRowTitle"><span>Cash
																	out</span><span class="simpleFormRowSubTitle"></span></span><input
																type="text"
																class="textField numberField simpleFormRowField"
																tabindex="0">
														</div>
													</div>
												</div>
												<div class="simpleFormPlaceHolderRow"
													style="position: relative;">
													<div class="simpleFormSection rowWithLeadingWidget" id="">
														<span class="simpleFormSectionTitle" aria-hidden="true"
															style="display: none;"></span><span
															class="simpleFormSectionTitleDescription"
															aria-hidden="true" style="display: none;"></span>
														<div class="simpleFormRow vertical leadingWidget">
															<span class="simpleFormRowTitle" aria-hidden="true"
																style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span
																class="simpleFormRowSubTitle"></span></span>
															<div class="simpleFormPlaceHolderRow simpleFormRowField"
																tabindex="0" style="position: relative;">
																<span>+</span>
															</div>
														</div>
														<div class="simpleFormRow vertical tailingRow">
															<span class="simpleFormRowTitle"><span>Government
																	Costs</span><span class="simpleFormRowSubTitle"><a
																	target="_blank"
																	href="https://unohomeloans.com.au/much-will-stamp-duty-cost/">More
																		information</a></span></span><input type="text"
																class="textField numberField simpleFormRowField"
																disabled="" tabindex="0">
														</div>
													</div>
												</div>
												<div class="simpleFormPlaceHolderRow" aria-hidden="true"
													style="position: relative; display: none;">
													<div class="simpleFormSection rowWithLeadingWidget" id="">
														<span class="simpleFormSectionTitle" aria-hidden="true"
															style="display: none;"></span><span
															class="simpleFormSectionTitleDescription"
															aria-hidden="true" style="display: none;"></span>
														<div class="simpleFormRow vertical leadingWidget">
															<span class="simpleFormRowTitle" aria-hidden="true"
																style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span
																class="simpleFormRowSubTitle"></span></span>
															<div class="simpleFormPlaceHolderRow simpleFormRowField"
																tabindex="0" style="position: relative;">
																<span>-</span>
															</div>
														</div>
														<div class="simpleFormRow vertical tailingRow">
															<span class="simpleFormRowTitle"><span>Deposit</span><span
																class="simpleFormRowSubTitle"></span></span><input type="text"
																class="textField numberField simpleFormRowField"
																tabindex="0">
														</div>
													</div>
												</div>
												<div class="simpleFormPlaceHolderRow"
													style="position: relative;">
													<div class="simpleFormSection rowWithLeadingWidget" id="">
														<span class="simpleFormSectionTitle" aria-hidden="true"
															style="display: none;"></span><span
															class="simpleFormSectionTitleDescription"
															aria-hidden="true" style="display: none;"></span>
														<div class="simpleFormRow vertical leadingWidget">
															<span class="simpleFormRowTitle" aria-hidden="true"
																style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span
																class="simpleFormRowSubTitle"></span></span>
															<div class="simpleFormPlaceHolderRow simpleFormRowField"
																tabindex="0" style="position: relative;">
																<span>=</span>
															</div>
														</div>
														<div class="simpleFormRow vertical tailingRow">
															<span class="simpleFormRowTitle"><span>Base
																	loan amount</span><span class="simpleFormRowSubTitle"></span></span><input
																type="text"
																class="textField numberField simpleFormRowField"
																disabled="" tabindex="0"><span class="tip">You
																are borrowing 127.98% (LVR) which means you may also
																have to pay lender Mortgage Insurance (LMI). <a
																href="https://unohomeloans.com.au/explaining-loan-value-ratios/"
																target="_blank">Find out more</a>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="searchMenuContentButtonContainer">
											<a class="button push searchMenuContentButton"
												href="javascript:;"><span>Update search</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="popup searchMenuContentPopup" id="thirdBox"
							style="position: absolute; left: 433px; top: 160px; margin-top: 0px; opacity: 1; display: none;">
							<div class="searchMenuContent">
								<div class="container-fluid">
									<div class="simple-form-default">
										<div class="simpleForm">
											<div class="simpleFormSection collectionCard odd" id="">
												<span class="simpleFormSectionTitle" aria-hidden="true"
													style="display: none;"></span><span
													class="simpleFormSectionTitleDescription"
													aria-hidden="true" style="display: none;"></span>
												<div class="simpleFormRow vertical">
													<span class="simpleFormRowTitle"><span>Repaying</span><span
														class="simpleFormRowSubTitle"></span></span>
													<div class="radioBoxes vertical simpleFormRowField"
														tabindex="0">
														<span class="radioBox flat"><input type="radio"
															name="gwt-uid-7" value="on" id="gwt-uid-8" tabindex="0"><label
															for="gwt-uid-8"><span></span></label><label
															for="gwt-uid-8">Principal &amp; interest</label></span><span
															class="radioBox flat"><input type="radio"
															name="gwt-uid-7" value="on" id="gwt-uid-9" tabindex="0"><label
															for="gwt-uid-9"><span></span></label><label
															for="gwt-uid-9">Interest only</label></span>
													</div>
												</div>
												<div class="simpleFormRow vertical">
													<span class="simpleFormRowTitle"><span>Repayment
															frequency</span><span class="simpleFormRowSubTitle"></span></span><span
														class="simpleFormSelection simpleFormRowField"
														tabindex="0"><select class="gwt-ListBox comboBox"><option
																value="Weekly">Weekly</option>
															<option value="Fortnightly">Fortnightly</option>
															<option value="Monthly">Monthly</option>
															<option value="Yearly">Yearly</option></select><i
														class="fa fa-angle-down"></i></span>
												</div>
												<div class="simpleFormRow vertical">
													<span class="simpleFormRowTitle"><span>Total
															term</span><span class="simpleFormRowSubTitle"></span></span>
													<div class="simpleFormAmountField simpleFormRowField"
														tabindex="0">
														<input type="text"
															class="textField numberField simpleFormAmountFieldNumber">
														<div class="label simpleFormAmountFieldPeriodUnit">Years</div>
													</div>
												</div>
											</div>
										</div>
										<div class="searchMenuContentButtonContainer">
											<a class="button push searchMenuContentButton"
												onclick="update3()"><span>Update search</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="popup searchMenuContentPopup" id="fourthBox"
							style="position: absolute; left: 600px; top: 160px; margin-top: 0px; opacity: 1; display: none;">
							<div class="searchMenuContent">
								<div class="container-fluid">
									<div class="simple-form-default">
										<div class="simpleForm">
											<div class="simpleFormSection collectionCard odd" id="">
												<span class="simpleFormSectionTitle" aria-hidden="true"
													style="display: none;"></span><span
													class="simpleFormSectionTitleDescription"
													aria-hidden="true" style="display: none;"></span>
												<div class="simpleFormRow vertical">
													<span class="simpleFormRowTitle"><span>Interest
															rate preference</span><span class="simpleFormRowSubTitle"></span></span>
													<div class="radioBoxes vertical simpleFormRowField"
														tabindex="0">
														<span class="radioBox flat"><input type="radio"
															name="gwt-uid-10" value="on" id="gwt-uid-11" tabindex="0"><label
															for="gwt-uid-11"><span></span></label><label
															for="gwt-uid-11">Variable</label></span><span
															class="radioBox flat"><input type="radio"
															name="gwt-uid-10" value="on" id="gwt-uid-12" tabindex="0"><label
															for="gwt-uid-12"><span></span></label><label
															for="gwt-uid-12">Fixed</label></span><span class="radioBox flat"><input
															type="radio" name="gwt-uid-10" value="on" id="gwt-uid-13"
															tabindex="0"><label for="gwt-uid-13"><span></span></label><label
															for="gwt-uid-13">Show me all</label></span>
													</div>
												</div>
												<div class="simpleFormRow vertical">
													<span class="simpleFormRowTitle"><span>Features
															I want</span><span class="simpleFormRowSubTitle"><a
															href="https://unohomeloans.com.au/help/product-features-explained"
															target="_blank">Unsure about features?</a></span></span>
													<div class="simpleFormMultiButtonsField simpleFormRowField"
														tabindex="0">
														<a class="button simpleFormButtonSwitch" id="offset"
															onclick="offsetToggle()"><span>Offset</span></a><a
															class="button simpleFormButtonSwitch" id="extra_repay"
															onclick="extra_repayToggle()"><span>Extra
																repayment</span></a><a class="button simpleFormButtonSwitch"
															href="javascript:;"><span>$0 ongoing fees</span></a><a
															class="button simpleFormButtonSwitch" href="javascript:;"><span>$0
																upfront fees</span></a><a class="button simpleFormButtonSwitch"
															id="redraw" onclick="redrawToggle()"><span>Redraw</span></a><a
															class="button simpleFormButtonSwitch" href="javascript:;"><span>Package</span></a>
													</div>
												</div>
											</div>
										</div>
										<div class="searchMenuContentButtonContainer">
											<a class="button push searchMenuContentButton"
												onclick="update4();"><span>Update search</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="popup searchMenuContentPopup" id="fifthBox"
							style="position: absolute; left: 800px; top: 160px; margin-top: 0px; opacity: 1; display: none;">
							<div class="searchMenuContent">
								<div class="container-fluid">
									<div class="simple-form-default">
										<div class="simpleForm">
											<div class="simpleFormSection collectionCard odd" id="">
												<span class="simpleFormSectionTitle" aria-hidden="true"
													style="display: none;"></span><span
													class="simpleFormSectionTitleDescription"
													aria-hidden="true" style="display: none;"></span>
												<div class="simpleFormRow vertical">
													<span class="simpleFormRowTitle"><span>Show
															home loans from</span><span class="simpleFormRowSubTitle"></span></span>
													<div class="radioBoxes vertical simpleFormRowField"
														tabindex="0">
														<span class="radioBox flat"><input type="radio"
															name="gwt-uid-14" value="on" id="gwt-uid-15" tabindex="0"
															checked=""><label for="gwt-uid-15"><span></span></label><label
															for="gwt-uid-15">All lenders</label></span><span
															class="radioBox flat"><input type="radio"
															name="gwt-uid-14" value="on" id="gwt-uid-16" tabindex="0"><label
															for="gwt-uid-16"><span></span></label><label
															for="gwt-uid-16">Major lenders only</label></span><span
															class="radioBox flat"><input type="radio"
															name="gwt-uid-14" value="on" id="gwt-uid-17" tabindex="0"><label
															for="gwt-uid-17"><span></span></label><label
															for="gwt-uid-17">Highest borrowing power</label></span>
													</div>
												</div>
											</div>
										</div>
										<div class="searchMenuContentButtonContainer">
											<a class="button push searchMenuContentButton"
												href="javascript:;"><span>Update search</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="glassPart"></div>


						<script type="text/javascript">
				var email=<?php echo json_encode($email); ?>;
				var loan=<?php echo json_encode($loan); ?>;
				var loanType=<?php echo json_encode($loanType); ?>;
				var count = <?php echo json_encode($count); ?>;
				var cusType = <?php echo json_encode($cusType); ?>;
				var loanInterestOnly = <?php echo json_encode($loanInterestOnly); ?>;
				var loanOffset = <?php echo json_encode($loanOffset); ?>;
				var loanRedraw = <?php echo json_encode($loanRedraw); ?>;
				var loanExtraRepay = <?php echo json_encode($loanExtraRepay); ?>;
				var investment = document.getElementById("gwt-uid-3");
	            var live = document.getElementById("gwt-uid-2");
	            var pandI = document.getElementById("gwt-uid-8");
	            var iOnly = document.getElementById("gwt-uid-9");
	            var ddl = document.getElementById("loanType");
	            /* var variableI = document.getElementById("gwt-uid-11");
	            var fixedI = document.getElementById("gwt-uid-12");
	            var bothI = document.getElementById("gwt-uid-13");
 				*/
 				if(loanType == "REFINANCE")
 					ddl.selectedIndex = 1;
 				else ddl.selectedIndex = 0;
 				
	            if(cusType == "OWNER")
	            	live.checked = true;
	            else if(cusType == "INVESTOR")
	            	investment.checked = true;

	            if(loanInterestOnly == "NO") {
	           	 	pandI.checked = true;
 					document.getElementById("menu3content").innerHTML = "Principal and Interest";
 				}
	            else if(loanInterestOnly == "YES") {
	           	 	iOnly.checked = true;
 					document.getElementById("menu3content").innerHTML = "Interest Only";
	            }
	            
	            if(loanOffset == "YES"){
	           	 	offsetToggle();
	            	if(count > 0) {
	            		 var x = document.getElementsByClassName("offsetFeature");
	            		    for (var i = 0; i < x.length; i++) {
	            		    	x[i].classList.remove('featureFalse');
	            		    	x[i].classList.add('featureTrue');
	            		    }
	            		    x = document.getElementsByClassName("offsetFeatureTick");
	            		    for (var i = 0; i < x.length; i++) {
	            		    	x[i].classList.remove('icon-cross');
	            		    	x[i].classList.add('icon-tick');
	            		    }
	            	}
	            }
	            if(loanRedraw == "YES"){
	            	redrawToggle();
	            	if(count > 0) {
	            		 var x = document.getElementsByClassName("redrawFeature");
	            		    for (var i = 0; i < x.length; i++) {
	            		    	x[i].classList.remove('featureFalse');
	            		    	x[i].classList.add('featureTrue');
	            		    }
	            		    x = document.getElementsByClassName("redrawFeatureTick");
	            		    for (var i = 0; i < x.length; i++) {
	            		    	x[i].classList.remove('icon-cross');
	            		    	x[i].classList.add('icon-tick');
	            		    }
	            	}
	            }
	            if(loanExtraRepay == "YES"){
	            	extra_repayToggle();
	            	if(count > 0) {
	            		 var x = document.getElementsByClassName("extra_repayFeature");
	            		    for (var i = 0; i < x.length; i++) {
	            		    	x[i].classList.remove('featureFalse');
	            		    	x[i].classList.add('featureTrue');
	            		    }
	            		    x = document.getElementsByClassName("extra_repayFeatureTick");
	            		    for (var i = 0; i < x.length; i++) {
	            		    	x[i].classList.remove('icon-cross');
	            		    	x[i].classList.add('icon-tick');
	            		    }
	            	}
	            }
	             
				function update1() {
					
						if(document.getElementById('gwt-uid-2').checked) {
						  //To live in radio button is checked
							window.location="../updateCustomer.php?email="+email+"&halfQuery=SET cus_type='OWNER'";
						}else if(document.getElementById('gwt-uid-3').checked) {
						  //Investment radio button is checked
							window.location="../updateCustomer.php?email="+email+"&halfQuery=SET cus_type='INVESTOR'";

						}
					
				}
				
				function update3() {
					if(document.getElementById('gwt-uid-8').checked) {
						  //Principal and Interest in radio button is checked
							window.location="../updateCustomer.php?email="+email+"&halfQuery=SET loan_interest_only = 'NO'";
						}else if(document.getElementById('gwt-uid-9').checked) {""
						  //Interest Only radio button is checked
							window.location="../updateCustomer.php?email="+email+"&halfQuery=SET loan_interest_only = 'YES'";
						}
				}
				
				function update4() {
					var offset = "'NO'";
					var redraw = "'NO'";
					var extraRepay = "'NO'";
					if(document.getElementById("offset").classList.contains('on')){
						offset = "'YES'";
					}
					
					if(document.getElementById("redraw").classList.contains('on')){
						redraw = "'YES'";
					}
					
					if(document.getElementById("extra_repay").classList.contains('on')){
						extraRepay = "'YES'";
					}
					
					window.location="../updateCustomer.php?email="+email+"&halfQuery=SET loan_offset = "+offset+ ", loan_redraw = "+redraw+", loan_extra_repay = " + extraRepay;

				}
				
				function offsetToggle() {
					document.getElementById("offset").classList.toggle('on');
				}
				function extra_repayToggle() {
					document.getElementById("extra_repay").classList.toggle('on');
				}
				function redrawToggle() {
					document.getElementById("redraw").classList.toggle('on');
				}
				
                 $("#menu1").click(function() {
	                $("#firstBox").toggle();
                   });
                
                 $("#menu2").click(function() {
                    $("#secondBox").toggle();
                   });
                
                $("#menu3").click(function() {
                    $("#thirdBox").toggle();
                   });


                $("#menu4").click(function() {
                    $("#fourthBox").toggle();
	               });

                $("#menu5").click(function() {
                    $("#fifthBox").toggle();
                   });
               
               $(document).mouseup(function(e) 
            		   {
            		       var container = $("#firstBox");
					   var menu = $("#menu1");
            		       // if the target of the click isn't the container nor a descendant of the container
            		       if (!container.is(e.target) && !menu.is(e.target) && menu.has(e.target).length === 0 && container.has(e.target).length === 0) 
            		       {
            		           container.hide();
            		       }
            		       
            		       container = $("#secondBox");
            		       menu = $("#menu2");
            		       // if the target of the click isn't the container nor a descendant of the container
            		       if (!container.is(e.target) && !menu.is(e.target) && menu.has(e.target).length === 0 && container.has(e.target).length === 0) 
            		       {
            		           container.hide();
            		       }
            		       container = $("#thirdBox");
            		       menu = $("#menu3");
            		       // if the target of the click isn't the container nor a descendant of the container
            		       if (!container.is(e.target) && !menu.is(e.target) && menu.has(e.target).length === 0 && container.has(e.target).length === 0) 
            		       {
            		           container.hide();
            		       }
            		       container = $("#fourthBox");
            		       menu = $("#menu4");
            		       // if the target of the click isn't the container nor a descendant of the container
            		       if (!container.is(e.target) && !menu.is(e.target) && menu.has(e.target).length === 0 && container.has(e.target).length === 0) 
            		       {
            		           container.hide();
            		       }
            		       container = $("#fifthBox");
            		       menu = $("#menu5");
            		       // if the target of the click isn't the container nor a descendant of the container
            		       if (!container.is(e.target) && !menu.is(e.target) && menu.has(e.target).length === 0 && container.has(e.target).length === 0) 
            		       {
            		           container.hide();
            		       }
            		   }); 
                     
</script>
</body>
</html>
