<?php
ob_start();
?>

<?php
// ---------------------------------------------------------------
// history.php
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
      <title>Stock Overflow - History Page</title>
    </head>

    <body>
	    
        <header>
	        
			<h1 align="center">Stock Overflow</h1>
                
        </header>
        
        <form action="Lookup.php" method="get">
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
		<br><br><br>
		
		<!--<h2 align="center"><?php echo $_GET["search"];?></h2>
		<br>!-->
        
        
					
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
						$amount = number_format($amount);
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
							$query = "SELECT symSymbol, symName FROM symbols " . "WHERE symSymbol='" . $strSymbol . "'";

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
								print "<h3>" . $row['symName'] . " (" . $row['symSymbol'] .")" . "</h3>"; 
								$result->free();
							}
							print"
								<div class='twrap'>
								<div class='fcenter' align='center'>";

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

							//@$result->data_seek(0); // Restart $row iterations
							print "<table align='center'>\n";
							print "<tr><th>Date</th><th>Last</th><th>Change</th><th>% Change</th><th>Volume</th></tr>\n";
							print "<tbody>\n";
							while($row = @$result->fetch_assoc())
							{
								extract($row); //create$varsfromallfieldsintherow
								print "<tr>";
								print "<td>{$qQuoteDateTime}</td>";
								print "<td align='right'>\${$qLastSalePrice}</td>";
								print "<td align='center'>{$qNetChangePrice}</td>";
								print "<td align='center'>{$qNetChangePct}</td>";
								print "<td align='center'>";print myformat($qShareVolumeQty);print"</td>";
								print "</tr>\n";
							}
							print "</tbody>\n";
							print "</table>\n";
						}
						@$result->free();    // Release memory for resultset
						$objDBUtil->Close(); // Close connection
				?>
    		</div>
        </div>
	</body>
    
    <footer>
		<p>&copy Pablo Bautista - Seattle Pacific University 2017 &copy </p>
	</footer>
    
</html>

<?php
ob_end_flush();
?>