
<link rel="stylesheet" href="./productCSS.css">

<?php
$id = $_GET["id"];
$dbhost = $_SERVER['RDS_HOSTNAME'];
$dbport = $_SERVER['RDS_PORT'];
$dbname = $_SERVER['RDS_DB_NAME'];
$charset = 'utf8' ;

$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = $_SERVER['RDS_USERNAME'];
$password = $_SERVER['RDS_PASSWORD'];
$pdo = new PDO($dsn, $username, $password);

$sql = "SELECT * FROM loan_options NATURAL JOIN product WHERE id='" . $id . "'";

echo "the query: " . $sql;
 foreach ($pdo->query($sql) as $row) {
        print $row['comparison_rate'] . "\t";
        print $row['advertised_rate'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Page I</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="./productCSS.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript"
	src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
<script type="text/javascript"
	src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/tripledes.js"></script>
<script src="https://use.fontawesome.com/bd42e35c2d.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">
</style>
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
						style="display: none; float: right;">
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

			<div class="navContent" style="padding-top: 65px;">
				<div class="fitPanel pageDisplay">
					<div class="page container-fluid">
						<div>
							<div class="mobileHeading">
								<div>
									<div>
										<div class="topLenderLabel nTooltip">
											POPULAR LENDER
											<div class="nTooltipText">
												Popularity is based on:
												<ul>
													<li>- Number of times home loans from this lender were
														added to Compare list</li>
													<li>- Number of applications submitted for home loans
														from this lender</li>
												</ul>
											</div>
										</div>
									</div>
									<span class="lenderLogo"><img width="64"
										src="https://cdn.unohomeloans.com.au/lenders/logo/CBA.svg"
										onerror="this.onerror=null;this.src='https://cdn.unohomeloans.com.au/lenders/logo/DEFAULT.svg'"
										class="productDetailLogo"></span><span class="lenderName"><h4>Commonwealth
											Bank Extra Variable Rate</h4></span><span class="addShortlistStar"><img
										src="//cdn.unohomeloans.com.au/icons/icon-star-off.svg"
										class="gwt-Image"></span>
								</div>
							</div>



							<div class="productDetailContainer container">
								<div class="container">
									<div class="row row-inline titleBar productDetailTitleBar">
										<span class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<div>
												<div class="topLenderLabel nTooltip">
													POPULAR LENDER
													<div class="nTooltipText">
														Popularity is based on:
														<ul>
															<li>- Number of times home loans from this lender
																were added to Compare list</li>
															<li>- Number of applications submitted for home
																loans from this lender</li>
														</ul>
													</div>
												</div>
											</div> <span> <img width="64"
												src="https://cdn.unohomeloans.com.au/lenders/logo/CBA.svg"
												onerror="this.onerror=null;this.src='https://cdn.unohomeloans.com.au/lenders/logo/DEFAULT.svg'"
												class="productDetailLogo"> &nbsp;&nbsp;&nbsp;&nbsp;
												<h2
													style="display: inline-flex; margin-top: 10px; position: absolute; top: 5px;">
													<?php print $row['product_name']; ?>
												</h2>
										</span>
										</span>
									</div>
								</div>
							</div>
							<div class="productDetailContainer container">

								<div class="productDetailSummaryContainer">
									<div class="productDetailSummary">
										<div class="productDetailProperty">
											<div class="col-xs-12 col-md-9">
												<div class="col-xs-12 col-md-8">
													<div class="col-xs-5 col-md-4">
														<h3 class="productPropertyHeader">
															<?php print $row['advertised_rate']; ?>
															%
														</h3>
														<div class="productPropertyInfo">Variable interest
															rate p.a.</div>
														<div class="productPropertyFooter productDiscountInfo">Discount
															included off standard rate of 4.45%</div>
													</div>
													<div class="productIcon col-xs-2 col-md-4">+</div>
													<div class="col-xs-5 col-md-4">
														<h3 class="productPropertyHeader">
															<?php print $row['ongoing_costs']; ?>
															$
														</h3>
														<div class="productPropertyInfo">Ongoing fees per
															month</div>
													</div>
												</div>
												<div class="productIcon col-xs-5 col-md-1">=</div>
												<div class="col-xs-5 col-md-3">
													<h3 class="productPropertyHeader">$517</h3>
													<div class="productPropertyInfo">Payment per month</div>
												</div>
											</div>
											<div class="col-xs-12 col-md-3">
												<div class="productDiscountInfo  desktop col-xs-6">
													<h3 class="productPropertyHeader">-0.46%</h3>
													<div class="productPropertyInfo">Discount included
														off standard rate of 4.45%</div>
												</div>
												<div class="col-xs-6 col-md-12">
													<h3 class="productPropertyHeader">
														<?php print $row['comparison_rate']; ?>
														%*
													</h3>
													<div class="productPropertyInfo">Comparison rate:
														ASIC standard for comparing loans of $150K over 25 years</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="defaultScenarioInfo">
									<span>Product details current as at 20/12/2017. Based
										on: Deposit $250,000, Property value $750,000, Owner Occupied,
										Principal and interest, Purchase. </span><a class="anchor"
										href="javascript:;">Sign up</a><span> or </span><a
										class="anchor" href="javascript:;">Login</a><span> to
										see your tailored rate.</span>
								</div>


								<div class="productDetailButtonGrid">
									<div class="container-fluid">
										<div class="buttonRow">
											<div>
												<a
													class="button simpleButton productDetailButtonGridItem applyButton"
													href="javascript:;"><span>Apply</span></a>
												<div class="creditScoreDisclaimer">
													<span>This will not affect your credit score</span>
												</div>
											</div>
											<a
												class="button simpleButton productDetailButtonGridItem expertReviewButton"
												href="javascript:;"><span>Let us find a deal for
													you</span></a>
										</div>
									</div>
								</div>
								<div class="productDetailBody">
									<div class="productDetailButtonGridItem expand">
										<span class="iconField productDetailSectionHeaderIcon">
											<i class="fa fa-angle-right"></i>
										</span> <a class="button expand" id="expandAll" href="javascript:;"
											style="display: block;"><span>Expand All</span></a> <a
											class="button expand" id="collapse" href="javascript:;"
											style="display: none;"><span>Collapse All</span></a>

									</div>
									<div class="productDetailSection">

										<button id="button1">
											<div class="productDetailSectionHeader">

												<span class="iconField productDetailSectionHeaderIcon"
													id="button1"><i class="fa fa-angle-down"></i></span>



												<div class="productDetailSectionHeaderName">Features</div>
												<div class="productDetailSectionHeaderDesc">5 of 11</div>

											</div>
										</button>

										<div class="productDetailSectionBody" style="display: none;"
											id="answer1">

											<div class="productDetailSectionFooter" aria-hidden="true"
												style="display: none;">
												<div class="productDetailPropertyDesc" id="answer"></div>
											</div>
											<div>
												<div
													class="productDetailPropertyCard col-xs-12 col-sm-6 col-md-4 collectionCard odd">
													<div class="productDetailPropertyIcon checked">
														<i class="fa fa-check"></i>
													</div>
													<div class="productDetailPropertyName checked">Extra
														Repayment</div>
													<div class="productDetailPropertyDesc checked"></div>
												</div>
												<div
													class="productDetailPropertyCard col-xs-12 col-sm-6 col-md-4 collectionCard even">
													<div class="productDetailPropertyIcon checked">
														<i class="fa fa-check"></i>
													</div>
													<div class="productDetailPropertyName checked">Loan
														Increase</div>
													<div class="productDetailPropertyDesc checked"></div>
												</div>
												<div
													class="productDetailPropertyCard col-xs-12 col-sm-6 col-md-4 collectionCard odd">
													<div class="productDetailPropertyIcon unchecked">
														<i class="fa fa-times"></i>
													</div>
													<div class="productDetailPropertyName unchecked">Locked
														Rate</div>
													<div class="productDetailPropertyDesc unchecked"></div>
												</div>
												<div
													class="productDetailPropertyCard col-xs-12 col-sm-6 col-md-4 collectionCard even">
													<div class="productDetailPropertyIcon unchecked">
														<i class="fa fa-times"></i>
													</div>
													<div class="productDetailPropertyName unchecked">Offset</div>
													<div class="productDetailPropertyDesc unchecked"></div>
												</div>
												<div
													class="productDetailPropertyCard col-xs-12 col-sm-6 col-md-4 collectionCard odd">
													<div class="productDetailPropertyIcon unchecked">
														<i class="fa fa-times"></i>
													</div>
													<div class="productDetailPropertyName unchecked">Partial
														Offset</div>
													<div class="productDetailPropertyDesc unchecked"></div>
												</div>
												<div
													class="productDetailPropertyCard col-xs-12 col-sm-6 col-md-4 collectionCard even">
													<div class="productDetailPropertyIcon unchecked">
														<i class="fa fa-times"></i>
													</div>
													<div class="productDetailPropertyName unchecked">Package</div>
													<div class="productDetailPropertyDesc unchecked"></div>
												</div>
												<div
													class="productDetailPropertyCard col-xs-12 col-sm-6 col-md-4 collectionCard odd">
													<div class="productDetailPropertyIcon checked">
														<i class="fa fa-check"></i>
													</div>
													<div class="productDetailPropertyName checked">Portability</div>
													<div class="productDetailPropertyDesc checked"></div>
												</div>
												<div
													class="productDetailPropertyCard col-xs-12 col-sm-6 col-md-4 collectionCard even">
													<div class="productDetailPropertyIcon checked">
														<i class="fa fa-check"></i>
													</div>
													<div class="productDetailPropertyName checked">Redraw</div>
													<div class="productDetailPropertyDesc checked"></div>
												</div>
												<div
													class="productDetailPropertyCard col-xs-12 col-sm-6 col-md-4 collectionCard odd">
													<div class="productDetailPropertyIcon checked">
														<i class="fa fa-check"></i>
													</div>
													<div class="productDetailPropertyName checked">Repayment
														Holiday</div>
													<div class="productDetailPropertyDesc checked"></div>
												</div>
												<div
													class="productDetailPropertyCard col-xs-12 col-sm-6 col-md-4 collectionCard even">
													<div class="productDetailPropertyIcon unchecked">
														<i class="fa fa-times"></i>
													</div>
													<div class="productDetailPropertyName unchecked">Splitting</div>
													<div class="productDetailPropertyDesc unchecked"></div>
												</div>
												<div
													class="productDetailPropertyCard col-xs-12 col-sm-6 col-md-4 collectionCard odd">
													<div class="productDetailPropertyIcon unchecked">
														<i class="fa fa-times"></i>
													</div>
													<div class="productDetailPropertyName unchecked">Interest
														In Advance</div>
													<div class="productDetailPropertyDesc unchecked"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="productDetailSection">


										<button id="button2">
											<div class="productDetailSectionHeader">

												<span class="iconField productDetailSectionHeaderIcon"><i
													class="fa fa-angle-down"></i></span>
												<div class="productDetailSectionHeaderName">Upfront
													Fees</div>





												<div class="productDetailSectionHeaderDesc">Total*
													$215</div>
											</div>
										</button>
										<div class="productDetailSectionBody" style="display: none;"
											id="answer2">
											<div
												class="productDetailSectionFooter col-sm-12 col-md-7 col-lg-9">
												<div class="productDetailPropertyDesc">
													This is a fee that may be payable by the borrower to a
													credit intermediary or a lender prior to or at the
													application stage, of the lending process. An example of an
													upfront fee maybe an Application fee (while some may charge
													upfront, most do not), or Valuation fee (some lenders may
													charge, while others will cover this cost)<br>
													<br>* Only mandatory fees are included in the Total
													and Total Cost
												</div>
											</div>

											<div class="col-sm-12 col-md-5 col-lg-3">
												<div class="productDetailPropertyCard collectionCard odd">
													<div class="productDetailPropertyName">Establishment
														Fee*</div>
													<div class="productDetailPropertyValue">$0</div>
													<div class="productDetailPropertyDesc"></div>
												</div>
												<div class="productDetailPropertyCard collectionCard even">
													<div class="productDetailPropertyName">Lock Rate Fee*</div>
													<div class="productDetailPropertyValue">$0</div>
													<div class="productDetailPropertyDesc"></div>
												</div>
												<div class="productDetailPropertyCard collectionCard odd">
													<div class="productDetailPropertyName">Settlement
														Cheque Fee*</div>
													<div class="productDetailPropertyValue">$15</div>
													<div class="productDetailPropertyDesc"></div>
												</div>
												<div class="productDetailPropertyCard collectionCard even">
													<div class="productDetailPropertyName">Settlement
														Fee*</div>
													<div class="productDetailPropertyValue">$200</div>
													<div class="productDetailPropertyDesc"></div>
												</div>
												<div class="productDetailPropertyCard collectionCard odd">
													<div class="productDetailPropertyName">Valuation Fee*</div>
													<div class="productDetailPropertyValue">$0</div>
													<div class="productDetailPropertyDesc"></div>
												</div>
												<div class="productDetailPropertyCard collectionCard even">
													<div class="productDetailPropertyName">Settlement
														Administration Fee*</div>
													<div class="productDetailPropertyValue">$0</div>
													<div class="productDetailPropertyDesc"></div>
												</div>
												<div class="productDetailPropertyCard collectionCard odd">
													<div class="productDetailPropertyName">Title Search
														Fee*</div>
													<div class="productDetailPropertyValue">$0</div>
													<div class="productDetailPropertyDesc"></div>
												</div>
											</div>
										</div>
									</div>


									<div class="productDetailSection">

										<button id="button3">
											<div class="productDetailSectionHeader">
												<span class="iconField productDetailSectionHeaderIcon"><i
													class="fa fa-angle-down"></i></span>
												<div class="productDetailSectionHeaderName">Ongoing
													Fees</div>



												<div class="productDetailSectionHeaderDesc">Total* $0
													/year</div>
											</div>
										</button>
										<div class="productDetailSectionBody" style="display: none;"
											id="answer3">
											<div
												class="productDetailSectionFooter col-sm-12 col-md-7 col-lg-9">
												<div class="productDetailPropertyDesc">
													An ongoing fee refers to a reoccurring charge or cost that
													is present for the life of the loan. This may appear in the
													form of an annual fee (sometimes known as package) or a
													monthly account fee.<br>
													<br>* Only mandatory fees are included in the Total
													and Total Cost
												</div>
											</div>
											<div class="col-sm-12 col-md-5 col-lg-3"></div>
										</div>
									</div>

									<div class="productDetailSection">

										<button id="button4">
											<div class="productDetailSectionHeader">
												<span class="iconField productDetailSectionHeaderIcon"><i
													class="fa fa-angle-down"></i></span>
												<div class="productDetailSectionHeaderName">Exit Fees</div>




												<div class="productDetailSectionHeaderDesc">Total* $0</div>
											</div>
										</button>

										<div class="productDetailSectionBody" style="display: none;"
											id="answer4">
											<div
												class="productDetailSectionFooter col-sm-12 col-md-7 col-lg-9">
												<div class="productDetailPropertyDesc">
													Exit fees represent costs associated with discharging a
													loan, either paying out a loan by refinancing or sale of a
													property.It is important to note that discharging fixed
													rate loans during the fixed period may incur break costs
													(penalty). Details of break costs will vary depending on
													situation so this information should be obtained directly
													from the lender.<br>
													<br>* Only mandatory fees are included in the Total
													and Total Cost
												</div>
											</div>
											<div class="col-sm-12 col-md-5 col-lg-3">
												<div class="productDetailPropertyCard collectionCard odd">
													<div class="productDetailPropertyName">Discharge Fee*</div>
													<div class="productDetailPropertyValue">$0</div>
													<div class="productDetailPropertyDesc"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="productDetailSection">


										<button id="button5">
											<div class="productDetailSectionHeader">
												<span class="iconField productDetailSectionHeaderIcon"><i
													class="fa fa-angle-down"></i></span>
												<div class="productDetailSectionHeaderName">Eligibility</div>
											</div>

											<div class="productDetailSectionHeaderDesc"></div>
										</button>

										<div class="productDetailSectionBody" style="display: none;"
											id="answer5">
											<div
												class="productDetailSectionFooter col-sm-12 col-md-7 col-lg-9">

												<div class="productDetailPropertyDesc">Upon the
													receipt of all relevant information from the applicant, an
													assessment will be made to determine which products are
													most suited and available to the applicant.</div>
											</div>

											<div class="col-sm-12 col-md-5 col-lg-3"></div>
										</div>
									</div>
									<div class="productDetailSection">
										<button id="button6">
											<div class="productDetailSectionHeader">
												<span class="iconField productDetailSectionHeaderIcon"><i
													class="fa fa-angle-down"></i></span>
												<div class="productDetailSectionHeaderName">Availability</div>
												<div class="productDetailSectionHeaderDesc"></div>
											</div>
										</button>
										<div class="productDetailSectionBody" style="display: none;"
											id="answer6">
											<div
												class="productDetailSectionFooter col-sm-12 col-md-7 col-lg-9">
												<div class="productDetailPropertyDesc">The loan
													purposes permissible for this loan product.</div>
											</div>
											<div class="col-sm-12 col-md-5 col-lg-3"></div>
										</div>
									</div>
									<div class="productDetailSection">

										<button id="button7">
											<div class="productDetailSectionHeader">
												<span class="iconField productDetailSectionHeaderIcon"><i
													class="fa fa-angle-down"></i></span>
												<div class="productDetailSectionHeaderName">About
													Commonwealth Bank</div>
												<div class="productDetailSectionHeaderDesc"></div>
											</div>
										</button>

										<div class="productDetailSectionBody" style="display: none;"
											id="answer7">
											<div class="productDetailSectionFooter" aria-hidden="true"
												style="display: none;">
												<div class="productDetailPropertyDesc"></div>
											</div>
											<div>
												<div class="productDetailPropertyCard collectionCard odd">
													<div class="productDetailPropertyDesc">The
														Commonwealth Bank is Australia’s leading provider of
														integrated financial services including retail banking,
														premium banking, business banking, institutional banking,
														funds management, superannuation, insurance, investment
														and share-broking products and services. The Group is one
														of the largest listed companies on the Australian
														Securities Exchange and is included in the Morgan Stanley
														Capital Global Index</div>
												</div>
											</div>
										</div>
									</div>
									<div class="productDetailSummaryContainer">
										<div class="productDetailSummary">
											<div class="productDetailProperty">
												<div class="col-xs-12 col-md-8">
													<div class="col-xs-12 col-md-12">
														<div class="col-xs-5 col-md-5">
															<h3 class="productPropertyHeader">
																<?php print $row['advertised_rate']; ?>
																%
															</h3>
															<div class="productPropertyInfo">Variable interest
																rate p.a.</div>
															<div class="productPropertyFooter productDiscountInfo">-0.46%
																included off standard rate of 4.45%</div>
														</div>
														<div class="productIcon col-xs-2 col-md-2">+</div>
														<div class="col-xs-5 col-md-5">
															<h3 class="productPropertyHeader"><?php print $row['ongoing_costs']; ?>$</h3>
															<div class="productPropertyInfo">Ongoing fees per
																month</div>
														</div>
													</div>
												</div>
												<div class="col-xs-12 col-md-4">
													<span></span>
													<div class="col-xs-6 col-md-12">
														<h3 class="productPropertyHeader">
															<?php print $row['comparison_rate']; ?>
															%
														</h3>
														<div class="productPropertyInfo">Comparison rate:
															ASIC standard for comparing loans of $150K over 25 years</div>
													</div>
												</div>
											</div>
										</div>
										<div class="productDetailButtonGrid">
											<div class="container-fluid">
												<div class="buttonRow">
													<div>
														<a
															class="button simpleButton productDetailButtonGridItem applyButton"
															href="javascript:;"><span>Apply</span></a>
														<div class="creditScoreDisclaimer">
															<span>This will not affect your credit score</span>
														</div>
													</div>
													<a
														class="button simpleButton productDetailButtonGridItem expertReviewButton"
														href="javascript:;"><span>Let us find a deal
															for you</span></a>
												</div>
											</div>
										</div>
									</div>
									<div class="productShortlistCard">
										<div class="productShortlistCardHeader">
											<h4 aria-hidden="true" style="display: none;"></h4>
											<div class="productShortlistCardHeaderContent">
												<div class="col-xs-2 col-md-2 lenderLogo">
													<span class="lenderLogo"><img width="40"
														src="https://cdn.unohomeloans.com.au/lenders/logo/CBA.svg"
														onerror="this.onerror=null;this.src='https://cdn.unohomeloans.com.au/lenders/logo/DEFAULT.svg'"></span>
												</div>
												<div class="col-xs-8 col-md-8 lenderName">
													<span class="productName"><span class="lenderName">Commonwealth
															Bank</span> Extra Variable Rate - Variable Rate</span>
												</div>
												<div class="col-xs-2 col-md-2 shortListButton">
													<img
														src="//cdn.unohomeloans.com.au/icons/icon-star-off.svg"
														class="gwt-Image">
												</div>
											</div>
										</div>
										<div class="productShortlistCardBody">
											<div class="productInfo">
												<div class="col-xs-6 primaryResult">
													<span class="repayment">
														<?php print $row['advertised_rate']; ?>%
													</span><span class="repaymentDescription">Variable interest
														p.a.</span>
												</div>
												<div class="col-xs-6 primaryResult">
													<span class="repayment">$2,384</span><span
														class="repaymentDescription">Payments per month</span>
												</div>
											</div>
										</div>
									</div>
								</div>



								<div class="productPageFootNote">
									<div>
										<sup>1</sup> WARNING: This comparison rate is true only for
										the examples given and may not include all fees and charges.
										Different terms, fees or other loan amounts might result in a
										different comparison rate. The comparison rate is calculated
										on the basis of a loan of $150,000 over a term of 25 years.
									</div>
								</div>

								<div style="width: 100%;">
									<footer class="footer footer-sm"
										style="padding-top: 40px; padding-bottom: 90px; margin-top: 40px;">
										<div class="container">

											<div class="col-xs-12 col-sm-8 col-sm-offset-2"
												style="text-align: center;">
												<ul class="list-inline"
													style="padding-left: 0; list-style: none; margin-left: -5px;">
													<li
														style="display: inline-block; padding-left: 5px; padding-right: 5px;">
														<a href="https://unohomeloans.com.au/about-us"
														style="font-size: 14px; color: #939fa9; font-family: 'avenir-book'; display: block;"
														target="_blank">About us</a>
													</li>
													<li
														style="display: inline-block; padding-left: 5px; padding-right: 5px; border-left: 1px solid #dfe0e1;">
														<a href="https://unohomeloans.com.au/terms-and-conditions"
														style="font-size: 14px; color: #939fa9; font-family: 'avenir-book'; display: block;"
														target="_blank">Terms and conditions</a>
													</li>
													<li
														style="display: inline-block; padding-left: 5px; padding-right: 5px; border-left: 1px solid #dfe0e1;">
														<a href="https://unohomeloans.com.au/bdtc"
														style="font-size: 14px; color: #939fa9; font-family: 'avenir-book'; display: block;"
														target="_blank">Better Deal Terms &amp; conditions</a>
													</li>
													<li
														style="display: inline-block; padding-left: 5px; padding-right: 5px; border-left: 1px solid #dfe0e1;">
														<a href="https://unohomeloans.com.au/privacy-policy"
														style="font-size: 14px; color: #939fa9; font-family: 'avenir-book'; display: block;"
														target="_blank">Privacy policy</a>
													</li>
													<li
														style="display: inline-block; padding-left: 5px; padding-right: 5px; border-left: 1px solid #dfe0e1;">
														<a
														href="https://cdn.unohomeloans.com.au/docs/UnoCreditGuide.pdf"
														style="font-size: 14px; color: #939fa9; font-family: 'avenir-book'; display: block;"
														target="_blank">Credit Guide</a>
													</li>
													<li
														style="display: inline-block; padding-left: 5px; padding-right: 5px; border-left: 1px solid #dfe0e1;">
														<a href="https://unohomeloans.com.au/home-loans/#feedback"
														style="font-size: 14px; color: #939fa9; font-family: 'avenir-book'; display: block;"
														target="_blank">Feedback</a>
													</li>
													<li
														style="display: inline-block; padding-left: 5px; padding-right: 5px; border-left: 1px solid #dfe0e1;"><a
														href="https://unohomeloans.com.au/site-map"
														style="font-size: 14px; color: #939fa9; font-family: 'avenir-book'; display: block;"
														target="_blank">Site map</a></li>
												</ul>
												<cite
													style="font-style: normal; font-size: 14px; color: #939fa9; font-family: 'avenir-book';">
													© 2017 uno. <em
													style="display: inline-block; font-style: normal">ABN
														81 609 882 804 Australian Credit License Number 483595</em>
												</cite>
											</div>
										</div>
									</footer>
								</div>

								<div class="productDetailsApplyButton">
									<a class="button" href="javascript:;"><span>Apply</span></a><a
										class="button inverse" href="javascript:;"><span>Get
											advice</span></a><span class="creditScoreDisclaimer">This will
										not affect your credit score</span>
								</div>



								<div id="glassPart"></div>





								<script>
									$(document).ready(function() {
										$(".answer").hide();
										$("#button1").click(function() {
											$("#answer1").toggle(700);
										});
										$("#button2").click(function() {
											$("#answer2").toggle(700);
										});
										$("#button3").click(function() {
											$("#answer3").toggle(700);
										});
										$("#button4").click(function() {
											$("#answer4").toggle(700);
										});
										$("#button5").click(function() {
											$("#answer5").toggle(700);
										});
										$("#button6").click(function() {
											$("#answer6").toggle(700);
										});
										$("#button7").click(function() {
											$("#answer7").toggle(700);
										});
									});

									var $div1 = $('.navDrawer')
									var $div2 = $('.mobile')

									$('#openNavDraw')
											.click(
													function() {

														$('.navDrawer').css(
																'left', '0px');

														$('#glassPart')
																.append(
																		' <div glass="1"  id="removeGlass" class="glass shaded" style="z-index: 109;"></div>');

													});

									$('#glassPart').click(function() {

										$($div1).css("left", "-100%");

										$('#removeGlass').remove();
									});

									$("#expandAll")
											.click(
													function() {

														$(
																'.productDetailSectionBody')
																.attr('style',
																		'display: block');
														$("#expandAll").attr(
																'style',
																'display:none');
														$("#collapse")
																.attr('style',
																		'display:block');

													});

									$("#collapse")
											.click(
													function() {
														$(
																'.productDetailSectionBody')
																.attr('style',
																		'display: none');
														$("#expandAll")
																.attr('style',
																		'display:block');
														$("#collapse").attr(
																'style',
																'display:none');
													});
								</script>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
</html>
<?php
}

?>