<?php
ob_start();
?>

<?php
// ---------------------------------------------------------------
// quotes.php
// ---------------------------------------------------------------
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");     // Date in the past 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified 
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); header("Pragma: no-cache");   // HTTP/1.0
?>


<!DOCTYPE html>
  <html>
    <head>
	    
      <link type="text/css" rel="stylesheet" href="style.css" />
      <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Megrim' rel='stylesheet'>
      <link href='https://fonts.googleapis.com/css?family=Advent Pro' rel='stylesheet'>
      <title>Stock Overflow - Quotes Page</title>
    </head>
    <body>
        <header>
	        
			<h1 align="center">Stock Overflow</h1>
        </header>
        
        <form action="hsample.php" method="get">
	        	<br>
	        	<br>
				<div style="text-align:center;"><input type="text" name="search" value="<?php echo $_GET["search"]; ?>" placeholder="Search..."></div>
				<br>
				<div class="wrapper" >
					<button class="button button1">History</button>
					<button class="button button1">Quote</button>
					<!--<button class="button button1">Lookup</button>-->
					<a class="button button1" href="default.php">Home</a>
					
				</div>
			</form> 
		<br> <br><br> <br>
        
        
	    		<!--<h3><?php echo $_GET["search"]; ?></h3>
				<h4>2017-00-00 00:00:00 - NASDAQ</h4>!-->
				
				<?php
					require "dbUtil.inc"; 
					$objDBUtil = new DbUtil;
					
					function myformat($amount)
					{
						if ($amount == null)
						{
							$amount= 'N/A';
						}
						else
						{
						$amount = number_format($amount, 2);
						}
						echo $amount;
					}

					$strSymbol = @$_REQUEST["search"];

					if(! empty($strSymbol)) 
						{ // process the form DB Connection Parameters
							
							$db = $objDBUtil->Open();
							
							/*$host = "cs.spu.edu";
							$user = "quotesdb"; // or individual MySQL user name with quotesdb permissions 
							$pwd = "quotesdb";

							// Establish dbserver connection
							$db = @new mysqli($host, $user, $pwd, 'quotesdb');
							if($db->connect_errno)
							die("Could not connect to database. Error[{$db->connect_errno}]");

							// To change from default database to other specific database
							// if( ! $db->select_db("someotherdatabase") )
							// die("Error: Could not select database 'someotherdatabase'.");
							// MySQLi1.php*/
  
							// Run a Query to get company name
							$query = "SELECT symSymbol , symName , symMarketCap FROM symbols " . "WHERE symSymbol='" . $strSymbol . "'";

							//print "Query: {$query}<br/>\n";

							$result = @$db->query($query);
							if(! $result)
							{
								print "Invalid query result<br/>\n";
							}
							else {
								//print "Number of rows in result = " . $result->num_rows . "<br/>\n";
								// Process row
								
								$row = @$result->fetch_assoc(); // fetch_row - $row[0], $row[1], etc.
								//print "<h3>Symbol: " . $row['symSymbol'] ."</h3>" ;
								//print "<h3>Company Name: " . $row['symName'] . "</h3>";
								print "<h3>" . $row['symName'] . " (" . $row['symSymbol'] .")" . "</h3>";
								$MC = $row['symMarketCap'];
								$result->free();
							}
							print "
							<div class='twrap'>
									<div class='fcenter'>";

							print "<br/>\n";
							// Run a Query to get some recent quote data
								
							$query = "select * from quotes" ." where qSymbol='{$strSymbol}'"
							." order by qQuoteDateTime desc";

							//print "Query: {$query}<br/>\n";

							$result = @$db->query($query);

							if(! $result)
							{
								print "Invalid query result<br/>\n"; 
							}

							//print "Number of rows in result = " . @$result->num_rows . "<br/>\n";
							$row = @$result->fetch_assoc();
							
							extract($row);
							print "<br/>\n";
							
							print "<table>\n";
							print "<thead><tr><th> Fundamentals</th></tr></thead>\n";
							print "<tbody>\n";
							print"
							<tr>
				    			<td>PE Ratio</td>
								<td>";print myformat($qCurrentPERatio);print"</td>
							</tr>
							<tr>
				    			<td>Earnings / Share</td>
								<td>";print myformat($qEarningsPerShare);print "</td>
							</tr>
							<tr>
				    			<td>Div / Share</td>
								<td>";print myformat($qCashDividendAmount);print "</td>
							</tr>
							<tr>
				    			<td>Market Cap</td>
								<td>";print myformat($MC);print"</td>
							</tr>
							<tr>
				    			<td># Shares Out</td>
								<td>";print myformat($qTotalOutstandingSharesQty);print"</td>
							</tr>
							<tr>
				    			<td>Div Yield</td>
								<td>";print myformat($qCurrentYieldPct);print "</td>
							</tr>\n";
							print"</tbody>\n";
							print"</table>\n";
							
							print "<br/>\n";
							print "<table>\n";
							print "<thead><tr><th>Quote</th></tr></thead>\n";
							print "<tbody>\n";
							print "
							<tr>
				    			<td>Last</td>
								<td>";print myformat($qLastSalePrice);print"</td>
				    		</tr>
				    		<tr>
					    		<td>Change</td>
					    		<td>";print myformat($qNetChangePrice);print"</td>
				    		</tr>
							<tr>
					    		<td>% Change</td>
					    		<td>";print myformat($qNetChangePct);print "</td>
				    		</tr>
							<tr>
					    		<td>High</td>
					    		<td>";print myformat($qTodaysHigh);print "</td>
				    		</tr>
							<tr>
					    		<td>Low</td>
					    		<td>";print myformat($qTodaysLow);print "</td>
				    		</tr>
							<tr>
					    		<td>Daily Volume</td>
					    		<td>";print myformat($qShareVolumeQty);print"</td>
				    		</tr>
							<tr>
					    		<td>Previous Close</td>
					    		<td>";print myformat($qPreviousClosePrice);print "</td>
				    		</tr>
							<tr>
					    		<td>Bid</td>
					    		<td>"; print myformat($qBidPrice);print"</td>
				    		</tr>
							<tr>
					    		<td>Ask</td>
					    		<td>"; print myformat($qAskPrice);print"</td>
				    		</tr>
							<tr>
					    		<td>52 Wk High</td>
					    		<td>";print myformat($q52WeekHigh);print "</td>
				    		</tr>
							<tr>
					    		<td>52 Wk Low</td>
					    		<td>";print myformat($q52WeekLow);print "</td>
				    		</tr>\n";
							print "</tbody>\n";
							print "</table>\n";
							print "<br/>\n";
							// Always Close connection and free resultsets
							@$result->free();    // Release memory for resultset
							$objDBUtil->Close(); // Close connection
							//@$db->close();       // Close the database connection
					} 
				?>
    		</div>
        </div>
    </body>
    <br><br>
    
    <footer>
		<p>&copy Pablo Bautista - Seattle Pacific University 2017 &copy </p>
	</footer>
    
</html>

<?php
ob_end_flush();
?>