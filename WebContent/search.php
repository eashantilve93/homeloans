<!DOCTYPE html>
<html>

<head>
    <title>Page I</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/tripledes.js"></script>
    <script src="https://use.fontawesome.com/bd42e35c2d.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./productCSS.css">

</head>

<body>
    <div class="navLayout app" style="min-height: 600px;">
        <div class="mobile">
            <div class="navTopBar">
                <div class="navTopBarPrimary">
                    <a class="button" href="javascript:;" id="openNavDraw" aria-hidden="true" style="display: block; float: left;"><i
						class="fa fa-bars" style="font-size: 24px;"></i><span></span></a>


                    <h1 style="float: left;"></h1>
                    <div class="appLogo" style="float: left;">
                        <img src="//cdn.unohomeloans.com.au/images/uno.svg" class="gwt-Image">
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
                    <div class="advisorPanel offline" aria-hidden="true" style="display: show; float: right;">
                        <span class="advisorIcon"> <img
							src="//cdn.unohomeloans.com.au/images/headshot-carlo.jpg"
							class="gwt-Image"></span> <span class="advisorInfo">
							<div class="advisorStatus">
								<span>Chat now?</span>
                        <div class="advisorTitle">Carlo is offline</div>
                    </div>
                    </span>
                </div>
                <span style="float: right;">133 866</span> <a class="anchor" href="https://unohomeloans.com.au/how-it-works" target="_blank" style="float: right;">How uno works</a>
            </div>
        </div>
        <div class="navContent pageContainer" style="padding-top: 65px;">
            <div class="fitPanel pageDisplay">
                <div class="page container-fluid productPage">
                    <?php
$email = $_GET["email"];
$orderBy = $_GET["orderBy"];

$dbhost = $_SERVER['RDS_HOSTNAME'];
$dbport = $_SERVER['RDS_PORT'];
$dbname = $_SERVER['RDS_DB_NAME'];
$charset = 'utf8' ;

$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = $_SERVER['RDS_USERNAME'];
$password = $_SERVER['RDS_PASSWORD'];
$pdo = new PDO($dsn, $username, $password);


$halfQuery = " FROM
    product AS a
        JOIN
    cus_details AS b
WHERE
   			((a.has_offset_account = b.loan_offset AND b.loan_offset = 'true') 
		OR  b.loan_offset = 'false')
		AND b.cus_email =  '" . $email . "'
        AND ((a.has_redraw_facility = b.loan_redraw AND b.loan_redraw = 'true')
		OR b.loan_redraw = 'false')
		AND ((a.allows_extra_repay = b.loan_extra_repay AND b.loan_extra_repay = 'true') 
		OR b.loan_extra_repay = 'false') 
		AND ((b.interest_only = 'true' AND a.interest_only = 'true')
		OR 	(b.interest_only = 'false' AND a.principal_and_interest = 'true'))
        AND ( b.repayment_frequency = 'ALL' 
		OR (b.repayment_frequency = 'FORTNIGHTLY' AND a.has_fortnightly_repayments = 'true')
		OR (b.repayment_frequency = 'MONTHLY' AND a.has_monthly_repayments = 'true')
		OR (b.repayment_frequency = 'WEEKLY' AND a.has_weekly_repayments = 'true'))
		AND ( b.interest_type = 'ALL' 
		OR (b.interest_type = 'VARIABLE' AND a.rate_type = 'Variable')
		OR (b.interest_type = 'FIXED' AND a.rate_type != 'Variable'))
		AND (b.purchase_price - b.deposit) >= min_borrowing_amount
        AND (b.purchase_price - b.deposit) <= max_borrowing_amount
        AND (b.purchase_price - b.deposit) / b.purchase_price <= max_LVR
        AND ((b.cus_type = 'INVESTOR' AND a.investment_purpose = 'true')
		OR (b.cus_type = 'OWNER' AND a.owner_occupied = 'true'))
        AND a.interest_only = b.interest_only
        AND ((b.employment_type = 'EMPLOYEE'
        OR (b.employment_type = 'SELF'
        AND b.tax_returns = 'true'))
        OR (a.allows_low_doc = 'true'))
		AND (b.first_home_buyers = 'false'
		OR (b.first_home_buyers = 'true' AND a.first_home_buyers = 'true'))
		AND ((a.is_refinance_available = 'true' AND b.refinance_home = 'true')
		OR b.refinance_home = 'false') ";
	
$sql = "SELECT *,(POWER(1+(advertised_rate/100),0.08333) -1)/(1-POWER(POWER(1+(advertised_rate/100),0.08333),-(max_loan_term*12))) as monthly_factor " . $halfQuery . $orderBy;

$sqlCount = "SELECT count(1) as rowCount " . $halfQuery;

 foreach ($pdo->query($sqlCount) as $row) {
$count = $row['rowCount'];
}

$sqlCusDetails = "SELECT * FROM cus_details WHERE cus_email='" . $email . "'";
foreach ($pdo->query($sqlCusDetails) as $row) {
 $refinance = $row['refinance_home'];
 $purchasePrice = $row['purchase_price'];
 $deposit = $row['deposit'];
 $cusType = $row['cus_type']; 
 $employmentType = $row['employment_type'] ;
 $loanOffset = $row['loan_offset'] ;
 $loanRedraw = $row['loan_redraw'] ;
 $loanExtraRepay = $row['loan_extra_repay'];
 $loanInterestOnly = $row['interest_only'];
 $repayFreq = $row['repayment_frequency'];
 $interestType = $row['interest_type'];
 $first_home_buyers = $row['first_home_buyers'];
}
$loanType = ('true' == $refinance) ? 'Refinance' : 'Buy a new Home'; 

$loan = number_format((float)$purchasePrice - (float)$deposit);
?>
                        <div>
                            <div></div>
                            <div class="modifySearch">
                                <span>We found <?php print $count;?> matching home loans.
								
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
                                    <?php print $count;?> matching home loans
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
                            <span>INTEREST RATE &amp; FEATURES</span> <span class="iconField"><i class="fa fa fa-angle-down"></i></span>
                        </div>
                        <div class="sDesc">
                            <span>Variable</span>
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
            <!-- Table starts here-->
            <div class="wrapper">
                <div class="productTable container">
                    <div class="productRow productTableHeader collectionCard odd">

                        <div class="lenderColumn">Lender</div>
                        <div class="comparisonRateColumn">
                            <span>Comparison rate<sup>1</sup></span><span class="iconField" onclick="comparisonRateSort();" style="cursor: pointer;"><img
												onload="this.__gwtLastUnhandledEvent=&quot;load&quot;;"
												id="comparisonRateSort"
												src="../image/clear.cache.gif"
												style="width: 16px; height: 16px; background: url(../image/sort.png) no-repeat 0px 0px;"
												border="0"></span>
                        </div>
                        <div class="paymentsColumn">
                            <span>Monthly payments</span><span class="iconField" style="cursor: pointer;"><img
												onload="this.__gwtLastUnhandledEvent=&quot;load&quot;;"
												id="monthlyPaymentSort"
												onclick="monthlyPaymentSort();"
												src="../image/clear.cache.gif"
												style="width: 16px; height: 16px; background: url(../image/sort.png) no-repeat 0px 0px;"
												border="0"></span>
                        </div>
                        <div class="interestRateColumn">
                            <span>Interest rate<sup>2</sup></span> <span class="iconField" style="cursor: pointer;" onclick="interestRateSort();"> <img
												onload="this.__gwtLastUnhandledEvent=&quot;load&quot;;"
												id="interestRateSort"
												src="../image/clear.cache.gif"
												style="width: 16px; height: 16px; background: url(../image/sort.png) no-repeat 0px 0px;"
												border="0"></span>
                        </div>
                        <div class="ongoingFeesColumn">
                            <span>Ongoing fees</span> <span class="iconField" style="cursor: pointer;" onclick="ongoingFeesSort();"> <img
												onload="this.__gwtLastUnhandledEvent=&quot;load&quot;;"
												src="../image/clear.cache.gif"
												id="ongoingFeesSort"
												style="width: 16px; height: 16px; background: url(../image/sort.png) no-repeat 0px 0px;"
												border="0"></span>
                        </div>
                        <div class="upfrontFeesColumn">
                            <span>Upfront fees</span> <span class="iconField" style="cursor: pointer;" onclick="upfrontFeesSort();"> <img
												onload="this.__gwtLastUnhandledEvent=&quot;load&quot;;"
												src="../image/clear.cache.gif" 
												id="upfrontFeesSort"
												style="width: 16px; height: 16px; background: url(../image/sort.png) no-repeat 0px 0px;"
												border="0"></span>
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
                                        <li>- Number of times home loans from this lender were added to Compare list</li>
                                        <li>- Number of applications submitted for home loans from this lender</li>
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
                                <a class="button" href="./product.php?id=<?php echo $row['product_id']; ?>"><span>Apply
														now</span></a>
                            </div>
                        </div>
                    </div>
                    <?php

foreach ($pdo->query($sql) as $row) {
		$offsetFeature = ('true' == $row['has_offset_account']) ? 'featureTrue' : 'featureFalse'; 
		$offsetFeatureTick = ('true' == $row['has_offset_account']) ? 'icon-tick' : 'icon-cross'; 
		$redrawFeature = ('true' == $row['has_redraw_facility']) ? 'featureTrue' : 'featureFalse'; 
		$redrawFeatureTick = ('true' == $row['has_redraw_facility']) ? 'icon-tick' : 'icon-cross'; 
		$extra_repayFeature = ('true' == $row['allows_extra_repay']) ? 'featureTrue' : 'featureFalse'; 
		$extra_repayFeatureTick = ('true' == $row['allows_extra_repay']) ? 'icon-tick' : 'icon-cross'; 
		$monthlyFactor = $row['monthly_factor'];
		$ongoing_fee = $row['ongoing_fee'];
		$ongoing_fee_frequency = $row['ongoing_fee_frequency'];
if ($ongoing_fee_frequency == "Annually") {
    $monthly_ongoing_fee=floatval($ongoing_fee)/12;
} elseif ($ongoing_fee_frequency == "Monthly") {
    $monthly_ongoing_fee=floatval($ongoing_fee);
} else {
    $monthly_ongoing_fee=$ongoing_fee;
}	
$logo="logos/" . $row['bank_name'] . ".png";

$monthlyPayments =floatval(str_replace(",", "",$loan)) * floatval($row['monthly_factor']);


?>

                        <div class="other">
                            <div class="productRow bestMatchProduct collectionCard even">
                                <div class="lenderColumn">
                                    <span class="lenderLogo"><img width="60"
													src="<?php print $logo;?>"
													onerror="this.onerror=null;this.src='https://cdn.unohomeloans.com.au/lenders/logo/DEFAULT.svg'"></span>
                                    <div class="productName">
                                        <a class="button" href="./product.php?id=<?php echo $row['product_id'];?>"><span>
															<?php print $row['bank_name'] . " - " . $row['product_name'];?>
													</span></a>
                                        <div class="productFeatureContainer">
                                            <p class="<?php echo $offsetFeature; ?>">
                                                <i class="<?php echo $offsetFeatureTick; ?>"></i><span>Offset</span>
                                            </p>
                                            <p class="<?php echo $redrawFeature; ?>">
                                                <i class="<?php echo $redrawFeatureTick; ?>"></i><span>Redraw</span>
                                            </p>
                                            <p class="<?php echo $extra_repayFeature; ?>">
                                                <i class="<?php echo $extra_repayFeatureTick; ?>"></i><span>Extra
																Repayment</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="comparisonRateColumn">
                                    <?php print $row['comparison_rate'] . "%"; ?>
                                </h3>
                                <h3 class="paymentsColumn"> <?php print "$" .  number_format($monthlyPayments,2); ?></h3>
                                <div class="interestRateColumn">
                                    <h3>
                                        <?php print $row['advertised_rate'] . "%"; ?>
                                    </h3>
                                </div>
                                <div class="ongoingFeesColumn">
                                    <h3>
                                        <?php echo "$" . number_format($monthly_ongoing_fee,2); ?>
                                    </h3>
                                </div>
                                <div class="upfrontFeesColumn">
                                    <h3>
                                        <?php echo "$" . number_format($row['upfront_fee'],2); ?>
                                    </h3>
                                </div>

                                <div class="ctaColumn">
                                    <a class="button" href="./product.php?id=<?php echo $row['product_id'];?>"><span>Apply
														now</span></a>
                                </div>
                            </div>
                        </div>

                        <?php	
		    }

?>
                </div>
            </div>
            <div class="productPageFootNote container">
                <div>
                    <sup>1</sup> WARNING: This comparison rate is true only for the examples given and may not include all fees and charges. Different terms, fees or other loan amounts might result in a different comparison rate. The comparison rate is calculated on the basis of a loan of $150,000 over a term of 25 years.
                </div>

                <div>
                    <sup>2</sup> Results are based on what you entered and should be used as a guide only. Lender rates and products may change. We cannot recommend a product until we have double checked that the home loan is suitable for you.
                </div>
            </div>

        </div>
        <div class="logPanel" aria-hidden="true" style="display: none;">
            <a class="button" href="javascript:;"><span>close</span></a>
            <div>
                <pre></pre>
            </div>
        </div>
        <div class="popup searchMenuContentPopup" id="firstBox" style="position: absolute; left: 152px; top: 160px; margin-top: 0px; opacity: 1; display: none;">
            <div class="searchMenuContent">
                <div class="container-fluid">
                    <div class="simple-form-default">
                        <div class="simpleForm">
                            <div class="simpleFormSection collectionCard odd" id="">
                                <span class="simpleFormSectionTitle" aria-hidden="true" style="display: none;"></span><span class="simpleFormSectionTitleDescription" aria-hidden="true" style="display: none;"></span>
                                <div class="simpleFormRow vertical">
                                    <span class="simpleFormRowTitle"><span>I want
															to</span><span class="simpleFormRowSubTitle"></span></span><span class="simpleFormSelection simpleFormRowField" tabindex="0"><select class="gwt-ListBox comboBox"
														id="loanType">
															<option value="Purchase">Buy a property</option>
															<option value="Refinance">Refinance my home loan</option>
													</select><i class="fa fa-angle-down"></i></span>
                                </div>
                                <div class="simpleFormRow vertical">
                                    <span class="simpleFormRowTitle"><span>Purpose
															is</span><span class="simpleFormRowSubTitle"></span></span>
                                    <div class="radioBoxes vertical simpleFormRowField" tabindex="0">
                                        <span class="radioBox flat"> <input type="radio"
															name="gwt-uid-1" value="on" id="gwt-uid-2" tabindex="0">
															<label for="gwt-uid-2"><span></span></label> <label for="gwt-uid-2">To live in</label>
                                        </span> <span class="radioBox flat"> <input type="radio"
															name="gwt-uid-1" value="on" id="gwt-uid-3" tabindex="0">
															<label for="gwt-uid-3"> <span></span></label> <label for="gwt-uid-3">Investment</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="simpleFormRow vertical">
                                    <span class="simpleFormRowTitle"><span>First
															home buyer?</span><span class="simpleFormRowSubTitle"></span></span>
                                    <div class="radioBoxes horizontal simpleFormRowField" tabindex="0">
                                        <span class="radioBox flat"><input type="radio"
															name="gwt-uid-4" value="on" id="gwt-uid-5" tabindex="0"><label
															for="gwt-uid-5"><span></span></label><label for="gwt-uid-5">Yes</label></span><span class="radioBox flat"><input
															type="radio" name="gwt-uid-4" value="on" id="gwt-uid-6"
															tabindex="0" checked=""><label for="gwt-uid-6"><span></span></label><label for="gwt-uid-6">No</label></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="searchMenuContentButtonContainer">
                            <a class="button push searchMenuContentButton" onclick="update1()"><span>Update search</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="popup searchMenuContentPopup" id="secondBox" style="position: absolute; left: 314px; top: 160px; margin-top: 0px; opacity: 1; display: none;">
            <div class="searchMenuContent">
                <div class="container-fluid">
                    <div class="simple-form-default">
                        <div class="simpleForm">
                            <div class="simpleFormSection collectionCard odd" id="">
                                <span class="simpleFormSectionTitle" aria-hidden="true" style="display: none;"></span><span class="simpleFormSectionTitleDescription" aria-hidden="true" style="display: none;"></span>
                                <div class="simpleFormPlaceHolderRow" style="position: relative;">
                                    <div class="simpleFormSection rowWithLeadingWidget" id="">
                                        <span class="simpleFormSectionTitle" aria-hidden="true" style="display: none;"></span><span class="simpleFormSectionTitleDescription" aria-hidden="true" style="display: none;"></span>
                                        <div class="simpleFormRow vertical leadingWidget">
                                            <span class="simpleFormRowTitle" aria-hidden="true" style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span class="simpleFormRowSubTitle"></span></span>
                                            <div class="simpleFormPlaceHolderRow simpleFormRowField" tabindex="0" style="position: relative;">
                                                <div></div>
                                            </div>
                                        </div>
                                        <div class="simpleFormRow vertical tailingRow">
                                            <span class="simpleFormRowTitle"><span>Property
																	worth</span><span class="simpleFormRowSubTitle"></span></span><input type="text" class="textField numberField simpleFormRowField" tabindex="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="simpleFormPlaceHolderRow" style="position: relative;">
                                    <div class="simpleFormSection rowWithLeadingWidget" id="">
                                        <span class="simpleFormSectionTitle" aria-hidden="true" style="display: none;"></span><span class="simpleFormSectionTitleDescription" aria-hidden="true" style="display: none;"></span>
                                        <div class="simpleFormRow vertical leadingWidget">
                                            <span class="simpleFormRowTitle" aria-hidden="true" style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span class="simpleFormRowSubTitle"></span></span>
                                            <div class="simpleFormPlaceHolderRow simpleFormRowField" tabindex="0" style="position: relative;">
                                                <div></div>
                                            </div>
                                        </div>
                                        <div class="simpleFormRow vertical tailingRow">
                                            <span class="simpleFormRowTitle"><span>I
																	currently owe</span><span class="simpleFormRowSubTitle"></span></span><input type="text" class="textField numberField simpleFormRowField" tabindex="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="simpleFormPlaceHolderRow" style="position: relative;">
                                    <div class="simpleFormSection rowWithLeadingWidget" id="">
                                        <span class="simpleFormSectionTitle" aria-hidden="true" style="display: none;"></span><span class="simpleFormSectionTitleDescription" aria-hidden="true" style="display: none;"></span>
                                        <div class="simpleFormRow vertical leadingWidget">
                                            <span class="simpleFormRowTitle" aria-hidden="true" style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span class="simpleFormRowSubTitle"></span></span>
                                            <div class="simpleFormPlaceHolderRow simpleFormRowField" tabindex="0" style="position: relative;">
                                                <span>+</span>
                                            </div>
                                        </div>
                                        <div class="simpleFormRow vertical tailingRow">
                                            <span class="simpleFormRowTitle"><span>Cash
																	out</span><span class="simpleFormRowSubTitle"></span></span><input type="text" class="textField numberField simpleFormRowField" tabindex="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="simpleFormPlaceHolderRow" style="position: relative;">
                                    <div class="simpleFormSection rowWithLeadingWidget" id="">
                                        <span class="simpleFormSectionTitle" aria-hidden="true" style="display: none;"></span><span class="simpleFormSectionTitleDescription" aria-hidden="true" style="display: none;"></span>
                                        <div class="simpleFormRow vertical leadingWidget">
                                            <span class="simpleFormRowTitle" aria-hidden="true" style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span class="simpleFormRowSubTitle"></span></span>
                                            <div class="simpleFormPlaceHolderRow simpleFormRowField" tabindex="0" style="position: relative;">
                                                <span>+</span>
                                            </div>
                                        </div>
                                        <div class="simpleFormRow vertical tailingRow">
                                            <span class="simpleFormRowTitle"><span>Government
																	Costs</span><span class="simpleFormRowSubTitle"><a
																	target="_blank"
																	href="https://unohomeloans.com.au/much-will-stamp-duty-cost/">More
																		information</a></span></span><input type="text" class="textField numberField simpleFormRowField" disabled="" tabindex="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="simpleFormPlaceHolderRow" aria-hidden="true" style="position: relative; display: none;">
                                    <div class="simpleFormSection rowWithLeadingWidget" id="">
                                        <span class="simpleFormSectionTitle" aria-hidden="true" style="display: none;"></span><span class="simpleFormSectionTitleDescription" aria-hidden="true" style="display: none;"></span>
                                        <div class="simpleFormRow vertical leadingWidget">
                                            <span class="simpleFormRowTitle" aria-hidden="true" style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span class="simpleFormRowSubTitle"></span></span>
                                            <div class="simpleFormPlaceHolderRow simpleFormRowField" tabindex="0" style="position: relative;">
                                                <span>-</span>
                                            </div>
                                        </div>
                                        <div class="simpleFormRow vertical tailingRow">
                                            <span class="simpleFormRowTitle"><span>Deposit</span><span class="simpleFormRowSubTitle"></span></span><input type="text" class="textField numberField simpleFormRowField" tabindex="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="simpleFormPlaceHolderRow" style="position: relative;">
                                    <div class="simpleFormSection rowWithLeadingWidget" id="">
                                        <span class="simpleFormSectionTitle" aria-hidden="true" style="display: none;"></span><span class="simpleFormSectionTitleDescription" aria-hidden="true" style="display: none;"></span>
                                        <div class="simpleFormRow vertical leadingWidget">
                                            <span class="simpleFormRowTitle" aria-hidden="true" style="display: none;"><span aria-hidden="true"
																style="display: none;"></span><span class="simpleFormRowSubTitle"></span></span>
                                            <div class="simpleFormPlaceHolderRow simpleFormRowField" tabindex="0" style="position: relative;">
                                                <span>=</span>
                                            </div>
                                        </div>
                                        <div class="simpleFormRow vertical tailingRow">
                                            <span class="simpleFormRowTitle"><span>Base
																	loan amount</span><span class="simpleFormRowSubTitle"></span></span><input type="text" class="textField numberField simpleFormRowField" disabled="" tabindex="0"><span class="tip">You
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
                            <a class="button push searchMenuContentButton"><span>Update
													search</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="popup searchMenuContentPopup" id="thirdBox" style="position: absolute; left: 433px; top: 160px; margin-top: 0px; opacity: 1; display: none;">
            <div class="searchMenuContent">
                <div class="container-fluid">
                    <div class="simple-form-default">
                        <div class="simpleForm">
                            <div class="simpleFormSection collectionCard odd" id="">
                                <span class="simpleFormSectionTitle" aria-hidden="true" style="display: none;"></span><span class="simpleFormSectionTitleDescription" aria-hidden="true" style="display: none;"></span>
                                <div class="simpleFormRow vertical">
                                    <span class="simpleFormRowTitle"><span>Repaying</span><span class="simpleFormRowSubTitle"></span></span>
                                    <div class="radioBoxes vertical simpleFormRowField" tabindex="0">
                                        <span class="radioBox flat"><input type="radio"
															name="gwt-uid-7" value="on" id="gwt-uid-8" tabindex="0"><label
															for="gwt-uid-8"><span></span></label><label for="gwt-uid-8">Principal &amp; interest</label></span><span class="radioBox flat"><input type="radio"
															name="gwt-uid-7" value="on" id="gwt-uid-9" tabindex="0"><label
															for="gwt-uid-9"><span></span></label><label for="gwt-uid-9">Interest only</label></span>
                                    </div>
                                </div>
                                <div class="simpleFormRow vertical">
                                    <span class="simpleFormRowTitle"><span>Repayment
															frequency</span><span class="simpleFormRowSubTitle"></span></span><span class="simpleFormSelection simpleFormRowField" tabindex="0"><select class="gwt-ListBox comboBox"
														id="repaymentFrequency"><option value="WEEKLY">Weekly</option>
															<option value="FORTNIGHTLY">Fortnightly</option>
															<option value="MONTHLY">Monthly</option>
															<option value="ALL">Show All</option></select><i
														class="fa fa-angle-down"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="searchMenuContentButtonContainer">
                            <a class="button push searchMenuContentButton" onclick="update3()"><span>Update search</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="popup searchMenuContentPopup" id="fourthBox" style="position: absolute; left: 600px; top: 160px; margin-top: 0px; opacity: 1; display: none;">
            <div class="searchMenuContent">
                <div class="container-fluid">
                    <div class="simple-form-default">
                        <div class="simpleForm">
                            <div class="simpleFormSection collectionCard odd" id="">
                                <span class="simpleFormSectionTitle" aria-hidden="true" style="display: none;"></span><span class="simpleFormSectionTitleDescription" aria-hidden="true" style="display: none;"></span>
                                <div class="simpleFormRow vertical">
                                    <span class="simpleFormRowTitle"><span>Interest
															rate preference</span><span class="simpleFormRowSubTitle"></span></span>
                                    <div class="radioBoxes vertical simpleFormRowField" tabindex="0">
                                        <span class="radioBox flat"><input type="radio"
															name="gwt-uid-10" value="on" id="gwt-uid-11" tabindex="0"><label
															for="gwt-uid-11"><span></span></label><label for="gwt-uid-11">Variable</label></span><span class="radioBox flat"><input type="radio"
															name="gwt-uid-10" value="on" id="gwt-uid-12" tabindex="0"><label
															for="gwt-uid-12"><span></span></label><label for="gwt-uid-12">Fixed</label></span><span class="radioBox flat"><input
															type="radio" name="gwt-uid-10" value="on" id="gwt-uid-13"
															tabindex="0"><label for="gwt-uid-13"><span></span></label><label for="gwt-uid-13">Show me all</label></span>
                                    </div>
                                </div>
                                <div class="simpleFormRow vertical">
                                    <span class="simpleFormRowTitle"><span>Features
															I want</span><span class="simpleFormRowSubTitle"><a
															href="https://unohomeloans.com.au/help/product-features-explained"
															target="_blank">Unsure about features?</a></span></span>
                                    <div class="simpleFormMultiButtonsField simpleFormRowField" tabindex="0">
                                        <a class="button simpleFormButtonSwitch" id="offset" onclick="offsetToggle()"><span>Offset</span></a><a class="button simpleFormButtonSwitch" id="extra_repay" onclick="extra_repayToggle()"><span>Extra
																repayment</span></a><a class="button simpleFormButtonSwitch" id="redraw" onclick="redrawToggle()"><span>Redraw</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="searchMenuContentButtonContainer">
                            <a class="button push searchMenuContentButton" onclick="update4();"><span>Update search</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="popup searchMenuContentPopup" id="fifthBox" style="position: absolute; left: 800px; top: 160px; margin-top: 0px; opacity: 1; display: none;">
            <div class="searchMenuContent">
                <div class="container-fluid">
                    <div class="simple-form-default">
                        <div class="simpleForm">
                            <div class="simpleFormSection collectionCard odd" id="">
                                <span class="simpleFormSectionTitle" aria-hidden="true" style="display: none;"></span><span class="simpleFormSectionTitleDescription" aria-hidden="true" style="display: none;"></span>
                                <div class="simpleFormRow vertical">
                                    <span class="simpleFormRowTitle"><span>Show
															home loans from</span><span class="simpleFormRowSubTitle"></span></span>
                                    <div class="radioBoxes vertical simpleFormRowField" tabindex="0">
                                        <span class="radioBox flat"><input type="radio"
															name="gwt-uid-14" value="on" id="gwt-uid-15" tabindex="0"
															checked=""><label for="gwt-uid-15"><span></span></label><label for="gwt-uid-15">All lenders</label></span><span class="radioBox flat"><input type="radio"
															name="gwt-uid-14" value="on" id="gwt-uid-16" tabindex="0"><label
															for="gwt-uid-16"><span></span></label><label for="gwt-uid-16">Major lenders only</label></span><span class="radioBox flat"><input type="radio"
															name="gwt-uid-14" value="on" id="gwt-uid-17" tabindex="0"><label
															for="gwt-uid-17"><span></span></label><label for="gwt-uid-17">Highest borrowing power</label></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="searchMenuContentButtonContainer">
                            <a class="button push searchMenuContentButton" href="javascript:;"><span>Update search</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div id="glassPart"></div>


    <script type="text/javascript">
        var email = <?php echo json_encode($email); ?>;
        var orderBy = "" + <?php echo json_encode($orderBy); ?>;
        var loan = <?php echo json_encode($loan); ?>;
        var refinance = <?php echo json_encode($refinance); ?>;
        var repayFreq = <?php echo json_encode($repayFreq); ?>;
        var count = <?php echo json_encode($count); ?>;
        var cusType = <?php echo json_encode($cusType); ?>;
        var firstHomeBuyer = <?php echo json_encode($first_home_buyers); ?>;
        var loanInterestOnly = <?php echo json_encode($loanInterestOnly); ?>;
        var loanOffset = <?php echo json_encode($loanOffset); ?>;
        var loanRedraw = <?php echo json_encode($loanRedraw); ?>;
        var loanExtraRepay = <?php echo json_encode($loanExtraRepay); ?>;
        var interestType = <?php echo json_encode($interestType); ?>;
        var investment = document.getElementById("gwt-uid-3");
        var live = document.getElementById("gwt-uid-2");
        var pandI = document.getElementById("gwt-uid-8");
        var iOnly = document.getElementById("gwt-uid-9");
        var ddl = document.getElementById("loanType");
        var repaymentFrequency = document.getElementById("repaymentFrequency");
        var variableI = document.getElementById("gwt-uid-11");
        var fixedI = document.getElementById("gwt-uid-12");
        var bothI = document.getElementById("gwt-uid-13");

        if (orderBy.includes("comparison_rate")) {
            if (orderBy.includes("ASC"))
                document.getElementById("comparisonRateSort").style.background = "url(../image/sort.png) no-repeat -16px 0px";
            else if (orderBy.includes("DESC"))
                document.getElementById("comparisonRateSort").style.background = "url(../image/sort.png) no-repeat -32px 0px";
        } else {
            document.getElementById("comparisonRateSort").style.background = "url(../image/sort.png) no-repeat -0px 0px";
        }

        if (orderBy.includes("advertised_rate")) {
            if (orderBy.includes("ASC"))
                document.getElementById("interestRateSort").style.background = "url(../image/sort.png) no-repeat -16px 0px";
            else if (orderBy.includes("DESC"))
                document.getElementById("interestRateSort").style.background = "url(../image/sort.png) no-repeat -32px 0px";
        } else {
            document.getElementById("interestRateSort").style.background = "url(../image/sort.png) no-repeat -0px 0px";
        }

        if (orderBy.includes("upfront_fee")) {
            if (orderBy.includes("ASC"))
                document.getElementById("upfrontFeesSort").style.background = "url(../image/sort.png) no-repeat -16px 0px";
            else if (orderBy.includes("DESC"))
                document.getElementById("upfrontFeesSort").style.background = "url(../image/sort.png) no-repeat -32px 0px";
        } else {
            document.getElementById("upfrontFeesSort").style.background = "url(../image/sort.png) no-repeat -0px 0px";
        }

        if (orderBy.includes("ongoing_fee")) {
            if (orderBy.includes("ASC"))
                document.getElementById("ongoingFeesSort").style.background = "url(../image/sort.png) no-repeat -16px 0px";
            else if (orderBy.includes("DESC"))
                document.getElementById("ongoingFeesSort").style.background = "url(../image/sort.png) no-repeat -32px 0px";
        } else {
            document.getElementById("ongoingFeesSort").style.background = "url(../image/sort.png) no-repeat -0px 0px";
        }

        if (orderBy.includes("monthly_factor")) {
            if (orderBy.includes("ASC"))
                document.getElementById("monthlyPaymentSort").style.background = "url(../image/sort.png) no-repeat -16px 0px";
            else if (orderBy.includes("DESC"))
                document.getElementById("monthlyPaymentSort").style.background = "url(../image/sort.png) no-repeat -32px 0px";
        } else {
           	 document.getElementById("monthlyPaymentSort").style.background = "url(../image/sort.png) no-repeat -0px 0px";
        }
        
        if (refinance == "true")
            ddl.selectedIndex = 1;
        else ddl.selectedIndex = 0;

        if (repayFreq == "ALL")
            repaymentFrequency.selectedIndex = 3;
        else if (repayFreq == "MONTHLY")
            repaymentFrequency.selectedIndex = 2;
        else if (repayFreq == "FORTNIGHTLY")
            repaymentFrequency.selectedIndex = 1;
        else if (repayFreq == "WEEKLY")
            repaymentFrequency.selectedIndex = 0;

        if (cusType == "OWNER")
            live.checked = true;
        else if (cusType == "INVESTOR")
            investment.checked = true;

        if (firstHomeBuyer == "true")
            document.getElementById("gwt-uid-5").checked = true;
        else if (firstHomeBuyer == "false")
            document.getElementById("gwt-uid-6").checked = true;

        if (interestType == "FIXED")
            fixedI.checked = true;
        else if (interestType == "VARIABLE")
            variableI.checked = true;
        else if (interestType == "ALL")
            bothI.checked = true;

        if (loanInterestOnly == "false") {
            pandI.checked = true;
            document.getElementById("menu3content").innerHTML = "Principal and Interest";
        } else if (loanInterestOnly == "true") {
            iOnly.checked = true;
            document.getElementById("menu3content").innerHTML = "Interest Only";
        }

        if (loanOffset == "true") {
            offsetToggle();
        }
        if (loanRedraw == "true") {
            redrawToggle();
        }
        if (loanExtraRepay == "true") {
            extra_repayToggle();
        }

        function update1() {
            var cus_type = "'OWNER'";
            var is_refinance = "'false'";
            var first_home_buyers = "'true'";
            if (ddl.selectedIndex == 1) is_refinance = "'true'";
            if (document.getElementById('gwt-uid-2').checked) {
                //To live in radio button is checked
                cus_type = "'OWNER'";
            } else if (document.getElementById('gwt-uid-3').checked) {
                //Investment radio button is checked
                cus_type = "'INVESTOR'";
            }
            if (document.getElementById('gwt-uid-5').checked) {
                var first_home_buyers = "'true'";
            } else if (document.getElementById('gwt-uid-6').checked) {
                var first_home_buyers = "'false'";
            }
            window.location = "../updateCustomer.php?email=" + email + "&halfQuery=SET cus_type=" + cus_type + ",first_home_buyers=" + first_home_buyers + ",refinance_home=" + is_refinance;
        }


        function update3() {
            var repayFrequency = repaymentFrequency.options[repaymentFrequency.selectedIndex].value;

            if (document.getElementById('gwt-uid-8').checked) {
                //Principal and Interest in radio button is checked
                window.location = "../updateCustomer.php?email=" + email + "&halfQuery=SET interest_only = 'false',repayment_frequency = '" + repayFrequency + "'";
            } else if (document.getElementById('gwt-uid-9').checked) {
                ""
                //Interest Only radio button is checked
                window.location = "../updateCustomer.php?email=" + email + "&halfQuery=SET interest_only = 'true',repayment_frequency = '" + repayFrequency + "'";
            }
        }

        function update4() {
            var offset = "'false'";
            var redraw = "'false'";
            var extraRepay = "'false'";
            var interest = "'ALL'";

            if (document.getElementById('gwt-uid-11').checked) {
                //Variable radio button is checked
                interest = "'VARIABLE'";
            } else if (document.getElementById('gwt-uid-12').checked) {
                ""
                //Fixed radio button is checked
                interest = "'FIXED'";
            }

            if (document.getElementById("offset").classList.contains('on')) {
                offset = "'true'";
            }

            if (document.getElementById("redraw").classList.contains('on')) {
                redraw = "'true'";
            }

            if (document.getElementById("extra_repay").classList.contains('on')) {
                extraRepay = "'true'";
            }

            window.location = "../updateCustomer.php?email=" + email + "&halfQuery=SET loan_offset = " + offset + ", loan_redraw = " + redraw + ", loan_extra_repay = " + extraRepay + ", interest_type = " + interest;

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



        function comparisonRateSort() {
            if (orderBy.includes("comparison_rate") && orderBy.includes("ASC"))
                window.location = "../search.php?email=" + email + "&orderBy=ORDER BY comparison_rate DESC";
            else window.location = "../search.php?email=" + email + "&orderBy=ORDER BY comparison_rate ASC";

        }

        function interestRateSort() {
            if (orderBy.includes("advertised_rate") && orderBy.includes("ASC"))
                window.location = "../search.php?email=" + email + "&orderBy=ORDER BY advertised_rate DESC";
            else window.location = "../search.php?email=" + email + "&orderBy=ORDER BY advertised_rate ASC";
        }

        function ongoingFeesSort() {
            if (orderBy.includes("ongoing_fee") && orderBy.includes("ASC"))
                window.location = "../search.php?email=" + email + "&orderBy=ORDER BY ongoing_fee DESC";
            else window.location = "../search.php?email=" + email + "&orderBy=ORDER BY ongoing_fee ASC";
        }

        function upfrontFeesSort() {
            if (orderBy.includes("upfront_fee") && orderBy.includes("ASC"))
                window.location = "../search.php?email=" + email + "&orderBy=ORDER BY upfront_fee DESC";
            else window.location = "../search.php?email=" + email + "&orderBy=ORDER BY upfront_fee ASC";
        }
        
        function monthlyPaymentSort() {
        		if (orderBy.includes("monthly_factor") && orderBy.includes("ASC"))
                window.location = "../search.php?email=" + email + "&orderBy=ORDER BY monthly_factor DESC";
            else window.location = "../search.php?email=" + email + "&orderBy=ORDER BY monthly_factor ASC";
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

        $(document).mouseup(function(e) {
            var container = $("#firstBox");
            var menu = $("#menu1");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && !menu.is(e.target) && menu.has(e.target).length === 0 && container.has(e.target).length === 0) {
                container.hide();
            }

            container = $("#secondBox");
            menu = $("#menu2");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && !menu.is(e.target) && menu.has(e.target).length === 0 && container.has(e.target).length === 0) {
                container.hide();
            }
            container = $("#thirdBox");
            menu = $("#menu3");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && !menu.is(e.target) && menu.has(e.target).length === 0 && container.has(e.target).length === 0) {
                container.hide();
            }
            container = $("#fourthBox");
            menu = $("#menu4");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && !menu.is(e.target) && menu.has(e.target).length === 0 && container.has(e.target).length === 0) {
                container.hide();
            }
        });
    </script>
</body>

</html>