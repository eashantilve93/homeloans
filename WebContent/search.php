 <link rel="stylesheet" href="./productCSS.css">

<?php
echo "test";
echo "<br>";
$dbhost = $_SERVER['RDS_HOSTNAME'];
$dbport = $_SERVER['RDS_PORT'];
$dbname = $_SERVER['RDS_DB_NAME'];
$charset = 'utf8' ;

$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = $_SERVER['RDS_USERNAME'];
$password = $_SERVER['RDS_PASSWORD'];
$pdo = new PDO($dsn, $username, $password);

$sql = $_POST["query"];
echo "the query: " . $sql;
echo "<br>";
    foreach ($pdo->query($sql) as $row) {
        print $row['bank_name'] . "\t";
        print $row['product_name'] . "\t";
        print $row['setup_costs'] . "\t";
        print $row['ongoing_costs'] . "\t";
        print $row['comparison_rate'] . "\t";
        print $row['advertised_rate'];
		echo "<br>";

?>
<div class="wrapper">
			<div class="productTable container">
				<div class="productRow productTableHeader collectionCard odd">
				
				<div class="lenderColumn">Lender</div>
				<div class="loanAmountColumn">Total loan amount</div>
				<div class="interestRateColumn">
					<span>Interest rate<sup>2</sup></span>
					<span class="iconField" style="cursor: pointer;">
					<img onload="this.__gwtLastUnhandledEvent=&quot;load&quot;;" src="https://unohomeloans.com.au/home-loans/clear.cache.gif" style="width:16px;height:16px;background:url(https://unohomeloans.com.au/home-loans/E88523BFCEE66BB8CA22ECB17362E8B6.cache.png) no-repeat -32px 0px;" border="0"></span>
					</div>
					<div class="comparisonRateColumn">
						<span>Comparison rate<sup>1</sup></span><span class="iconField" style="cursor: pointer;"><img onload="this.__gwtLastUnhandledEvent=&quot;load&quot;;" src="https://unohomeloans.com.au/home-loans/clear.cache.gif" style="width:16px;height:16px;background:url(https://unohomeloans.com.au/home-loans/E88523BFCEE66BB8CA22ECB17362E8B6.cache.png) no-repeat 0px 0px;" border="0"></span>
					</div>
					<div class="paymentsColumn">
						<span>Monthly payments</span><span class="iconField" style="cursor: pointer;"><img onload="this.__gwtLastUnhandledEvent=&quot;load&quot;;" src="https://unohomeloans.com.au/home-loans/clear.cache.gif" style="width:16px;height:16px;background:url(https://unohomeloans.com.au/home-loans/E88523BFCEE66BB8CA22ECB17362E8B6.cache.png) no-repeat 0px 0px;" border="0"></span>
					</div>
					<div class="borrowingPowerColumn">Borrowing power</div
					><div class="ctaColumn"><div class="compareButton">Compare loans <small>0</small></div></div></div>
	
					<div class="mobileRow">
					<div class="productRow bestMatchProduct collectionCard even"><div class="bestMatchLabel">BEST MATCH</div><div class="popularLender nTooltip">POPULAR LENDER<div class="nTooltipText">Popularity is based on:<ul><li> - Number of times home loans from this lender were added to Compare list</li><li> - Number of applications submitted for home loans from this lender </li></ul></div></div><div class="productSummary"><span class="lenderLogo"><img width="40" src="https://cdn.unohomeloans.com.au/lenders/logo/HLL.svg" onerror="this.onerror=null;this.src='https://cdn.unohomeloans.com.au/lenders/logo/DEFAULT.svg'"></span><div class="interestRateColumn"><h3>3.89%</h3><div class="productDiscount"></div></div><h3 class="comparisonRateColumn">4.04%</h3><h3 class="paymentsColumn">$220,044</h3><span class="iconField" style="cursor: pointer;"><img src="//cdn.unohomeloans.com.au/icons/icon-star-off.svg"></span></div><div class="borrowingPowerIndicator"><div class="levelBar"><div class="levelHigh"></div></div><div class="levelBarInfo"><span class="levelHigh">High</span> borrowing power</div></div><div class="productSummary"><div class="productName"><span><strong>Homeloans Ltd</strong></span><span> - Homeloans Ultra Plus</span><span> - Variable Rate</span></div><a class="button" href="javascript:;"><span>View details</span></a></div></div>
				</div>
				<div class="other">
				<div class="productRow bestMatchProduct collectionCard even"> 
					<div class="lenderColumn">
						<span class="lenderLogo"><img width="40" src="https://cdn.unohomeloans.com.au/lenders/logo/CBA.svg" onerror="this.onerror=null;this.src='https://cdn.unohomeloans.com.au/lenders/logo/DEFAULT.svg'"></span>
						<div class="bestMatchLabel">BEST MATCH</div>
						<div class="productName"><span><strong><?php print $row['bank_name']?></strong></span><span> - Extra Variable Rate</span><span> - Variable Rate</span>
					<div class="productFeatureContainer">
						<p class="featureFalse"><i class="icon-cross"></i><span>Offset</span></p>
						<p class="featureTrue"><i class="icon-tick"></i><span>Redraw</span></p>
						<p class="featureTrue"><i class="icon-tick"></i><span>Extra Repayment</span></p>
						<p class="featureFalse"><i class="icon-cross"></i><span>Package</span></p>
					</div>
				</div>
			</div>

			<div class="loanAmountColumn">
				<h3>$20,230</h3>
				<div class="lmiInfo">
				</div>
			</div>
			<div class="interestRateColumn">
				<h3>3.99%</h3>
				<div class="productDiscount">-0.46% included</div>
			</div>
			<h3 class="comparisonRateColumn"><?php print $row['comparison_rate']?>%</h3>
			<h3 class="paymentsColumn">$246</h3>
			<div class="borrowingPowerColumn">
				<div class="borrowingPowerIndicator">
					<div class="levelBar">
						<div class="levelHigh">High</div>
					</div>
					<div class="levelBarInfo">Loan amount within lender's max borrowing limit</div>
					<a class="callToAction">Get advice</a>
				</div>
			</div>
			<div class="ctaColumn">
				<a class="button" href="javascript:;"><span>View details</span></a>
				<span class="iconField" style="cursor: pointer;"><img src="//cdn.unohomeloans.com.au/icons/icon-star-off.svg"></span>
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