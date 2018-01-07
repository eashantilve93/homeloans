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
$halfQuery = $_GET["halfQuery"];
$loan = $_GET["loan"];

$dbhost = $_SERVER['RDS_HOSTNAME'];
$dbport = $_SERVER['RDS_PORT'];
$dbname = $_SERVER['RDS_DB_NAME'];
$charset = 'utf8' ;

$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = $_SERVER['RDS_USERNAME'];
$password = $_SERVER['RDS_PASSWORD'];
$pdo = new PDO($dsn, $username, $password);

$sql = "SELECT id,bank_name,product_name,comparison_rate,advertised_rate " . $halfQuery;
$sqlCount = "SELECT count(1) as rowCount " . $halfQuery;

 foreach ($pdo->query($sqlCount) as $row) {
?>
						<div>
							<div></div>
							<div class="modifySearch">
								<span>We found <?php print $row['rowCount'];?> matching home loans. </span> <a> Modify
									your search</a> <span class="compareButton">Compare <small>3</small></span>
							</div>
							<div class="container">
								<div class="row row-inline titleBar">
									<div class="mainSection col-xs-12">
										<div>
											<span class="breadCrumb"><a class="anchor"
												href="javascript:;">Dashboard</a><span>/</span><span>Search
													results</span></span>
											<h2>We found <?php print $row['rowCount'];?> matching home loans</h2>
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
											<span>Refinance my home</span>
										</div>
									</div>
									<div class="menu" id="menu2">
										<div class="sTitle">
											<span>BORROW</span> <span class="iconField"><i
												class="fa fa fa-angle-down"></i></span>
										</div>
										<div class="sDesc">
											<span><?php print $loan ?></span>
										</div>
									</div>
									<div class="menu" id="menu3">
										<div class="sTitle">
											<span>REPAYING</span> <span class="iconField"><i
												class="fa fa fa-angle-down"></i></span>
										</div>
										<div class="sDesc">
											<span>Principal and interest, Yearly, 2 years</span>
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

}
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
													<h3><?php print $row['advertised_rate']; ?>%</h3>
													<div class="productDiscount"></div>
												</div>
												<h3 class="comparisonRateColumn"><?php print $row['comparison_rate']; ?>%</h3>
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
													<span><strong><?php print $row['product_name'];?></strong></span><span> -
														<?php print $row['product_name'];?></span><span> - Variable Rate</span>
												</div>
												<a class="button" href="./product.php?id=<?php echo $row['id']; ?>"><span>View
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
													<span><strong><?php print $row['bank_name'];?></strong></span><span>
														- Extra Variable Rate</span><span> - Variable Rate</span>
													<div class="productFeatureContainer">
														<p class="featureFalse">
															<i class="icon-cross"></i><span>Offset</span>
														</p>
														<p class="featureTrue">
															<i class="icon-tick"></i><span>Redraw</span>
														</p>
														<p class="featureTrue">
															<i class="icon-tick"></i><span>Extra Repayment</span>
														</p>
														<p class="featureFalse">
															<i class="icon-cross"></i><span>Package</span>
														</p>
													</div>
												</div>
											</div>

											<div class="loanAmountColumn">
												<h3><?php print $loan;?></h3>
												<div class="lmiInfo"></div>
											</div>
											<div class="interestRateColumn">
												<h3><?php print $row['advertised_rate']; ?>%</h3>
												<div class="productDiscount">-0.46% included</div>
											</div>
											<h3 class="comparisonRateColumn"><?php print $row['comparison_rate']; ?>%</h3>
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
												<a class="button" href="./product.php?id=<?php echo $row['id']; ?>"><span>View
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
						<div class="popup searchMenuContentPopup" id="firstBox">
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
														tabindex="0"><select class="gwt-ListBox comboBox"><option
																value=""></option>
															<option value="Purchase">Buy a property</option>
															<option value="Refinance">Refinance my home loan</option></select><i
														class="fa fa-angle-down"></i></span>
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
															name="gwt-uid-1" value="on" id="gwt-uid-3" tabindex="0"
															checked=""> <label for="gwt-uid-3"> <span></span></label>
															<label for="gwt-uid-3">Investment</label>
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
												href="javascript:;"><span>Update search</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="popup searchMenuContentPopup" id="secondBox"
							style="position: absolute; left: 314px; top: 160px; margin-top: 0px; opacity: 1;">
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
							style="position: absolute; left: 433px; top: 160px; margin-top: 0px; opacity: 1;">
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
															name="gwt-uid-7" value="on" id="gwt-uid-8" tabindex="0"
															checked=""><label for="gwt-uid-8"><span></span></label><label
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
												href="javascript:;"><span>Update search</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="popup searchMenuContentPopup" id="fourthBox"
							style="position: absolute; left: 706px; top: 160px; margin-top: 0px; opacity: 1;">
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
															name="gwt-uid-10" value="on" id="gwt-uid-11" tabindex="0"
															checked=""><label for="gwt-uid-11"><span></span></label><label
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
														<a class="button simpleFormButtonSwitch"
															href="javascript:;"><span>Offset</span></a><a
															class="button simpleFormButtonSwitch" href="javascript:;"><span>Extra
																repayment</span></a><a class="button simpleFormButtonSwitch"
															href="javascript:;"><span>$0 ongoing fees</span></a><a
															class="button simpleFormButtonSwitch" href="javascript:;"><span>$0
																upfront fees</span></a><a class="button simpleFormButtonSwitch"
															href="javascript:;"><span>Redraw</span></a><a
															class="button simpleFormButtonSwitch" href="javascript:;"><span>Package</span></a>
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


						<div class="popup searchMenuContentPopup" id="fifthBox"
							style="position: absolute; left: 924px; top: 160px; margin-top: 0px; opacity: 1;">
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
	 var $div1 = $('.navDrawer')
                var $div2 = $('.mobile')


                $('#openNavDraw').click(function() {
    
                  $('.navDrawer').css('left','0px');

                 // $('#removeGlass').remove(); 
                  $('#glassPart').append(' <div glass="1"  id="removeGlass" class="glass shaded" style="z-index: 109;"></div>');
                  
                });

                $('#glassPart').click(function() {
                 
                  $($div1).css("left", "-100%");
           
                  $('#removeGlass').remove();                
                });
      

                 

                 $("#expandAll").click(function(){

                       $('.productDetailSectionBody').attr('style','display: block');
                       $("#expandAll").attr('style' , 'display:none');
                       $("#collapse").attr('style' , 'display:block');
                        


                  });

                   $("#collapse").click(function(){
                     $('.productDetailSectionBody').attr('style','display: none');
                     $("#expandAll").attr('style' , 'display:block');
                     $("#collapse").attr('style' , 'display:none');
               });


                $("#firstBox").hide();
                $("#secondBox").hide();
                $("#thirdBox").hide();
                $("#fourthBox").hide();
                $("#fifthBox").hide();

                 $("#menu1").click(function() {
                       
         
                    $("#firstBox").css({"position": "absolute","left": "152px","top":"160px",
                            "margin-top":"0px",
                            "opacity":"1"}).toggle();

                        $("#secondBox").hide();
                        $("#thirdBox").hide();
                        $("#fourthBox").hide();
                        $("#fifthBox").hide();
                     

                   });

                 $("#menu2").click(function() {
                       
         
                    $("#secondBox").css({"position": "absolute","left": "252px","top":"160px",
                            "margin-top":"0px",
                            "opacity":"1"}).toggle();


                        $("#firstBox").hide();
                        $("#thirdBox").hide();
                        $("#fourthBox").hide();
                        $("#fifthBox").hide();

                     

                   });

                    $("#menu3").click(function() {
                       
         
                    $("#thirdBox").css({"position": "absolute","left": "442px","top":"160px",
                            "margin-top":"0px",
                            "opacity":"1"}).toggle();


                        $("#firstBox").hide();
                        $("#secondBox").hide();
                        $("#fourthBox").hide();
                        $("#fifthBox").hide();

                     

                   });


                    $("#menu4").click(function() {
                       
         
                    $("#fourthBox").css({"position": "absolute","left": "642px","top":"160px",
                            "margin-top":"0px",
                            "opacity":"1"}).toggle();


                        $("#firstBox").hide();
                        $("#secondBox").hide();
                        $("#thirdBox").hide();
                        $("#fifthBox").hide();

                     

                   });

                       $("#menu5").click(function() {
                       
         
                    $("#fifthBox").css({"position": "absolute","left": "742px","top":"160px",
                            "margin-top":"0px",
                            "opacity":"1"}).toggle();
                     

                            $("#firstBox").hide();
                            $("#secondBox").hide();
                            $("#thirdBox").hide();
                            $("#fourthBox").hide();
                          

                   });
                       
                       $(document).mouseup(function(e) 
                    		   {
                    		       var container = $("#firstBox");

                    		       // if the target of the click isn't the container nor a descendant of the container
                    		       if (!container.is(e.target) && container.has(e.target).length === 0) 
                    		       {
                    		           container.hide();
                    		       }
                    		       
                    		       container = $("#secondBox");

                    		       // if the target of the click isn't the container nor a descendant of the container
                    		       if (!container.is(e.target) && container.has(e.target).length === 0) 
                    		       {
                    		           container.hide();
                    		       }
                    		       container = $("#thirdBox");

                    		       // if the target of the click isn't the container nor a descendant of the container
                    		       if (!container.is(e.target) && container.has(e.target).length === 0) 
                    		       {
                    		           container.hide();
                    		       }
                    		       container = $("#fourthBox");

                    		       // if the target of the click isn't the container nor a descendant of the container
                    		       if (!container.is(e.target) && container.has(e.target).length === 0) 
                    		       {
                    		           container.hide();
                    		       }
                    		       container = $("#fifthBox");

                    		       // if the target of the click isn't the container nor a descendant of the container
                    		       if (!container.is(e.target) && container.has(e.target).length === 0) 
                    		       {
                    		           container.hide();
                    		       }
                    		   });                       
</script>
</body>
</html>
