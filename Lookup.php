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
      <title>Stock Overflow - Lookup Page </title>
    </head>

    <body>
	    
        <header>
	        
			<h1 align="center">Stock Overflow</h1>
                
        </header>
        
        <form action="Lookup.php" method="get">
	        	<br>
	        	<br>
				<div style="text-align:center;"><input type="text" name="search" placeholder="Search..."></div>
				<br>
				<div class="wrapper" >
					<button class="button button1">Lookup</button>
					<a class="button button1" href="default.php">Home</a>
				</div>
			</form> 
		<br><br><br>
		
		<h2 align="center">Quote Lookup</h2>
		<br>

		<?php
					
					require "dbUtil.inc"; 
					$objDBUtil = new DbUtil;

					$strSymbol = @$_REQUEST["search"];

					if(! empty($strSymbol)) 
						{ // process the form DB Connection Parameters
							
							$db = $objDBUtil->Open();
							  
							
							print"
								<div class='twrap'>
								<div class='fcenter' align='center'>";

							print "<br/>\n";
							// Run a Query to get some recent quote data
								
							$query = "select * from symbols" ." where symSymbol or symName like'{$strSymbol}%'";
							//." order by symName asc";

							//print "Query: {$query}<br/>\n";

							$result = @$db->query($query);

							if(! $result)
							{
								print "Invalid query result\n"; 
							}

							//@$result->data_seek(0); // Restart $row iterations
							print "<table align='center'>\n";
							print "<thead><tr><th>Company Name</th><th>Symbol</th><th>Quote</th><th>History</th></tr></thead>\n";
							print "<tbody>\n";
							while($row = @$result->fetch_assoc())
							{
								extract($row); //create$varsfromallfieldsintherow
								print "<tr>";
								print "<td>{$symName}</td>";
								print "<td>{$symSymbol}</td>";
								print "<td><a href='sampleq.php?search=$symSymbol'>Quote</a></td>";
								print "<td><a href='hsample.php?search=$symSymbol'>History</a></td>";
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
        <!--<div class="twrap">
    		<div class="fcenter" align="center">
	    		<table align="center">
		    		<thead>
			    		<tr>
				    		<th>Company Name</th>
				    		<th>Symbol</th>
				    		<th>Quote</th>
				    		<th>History</th>
			    		</tr>
		    		</thead>
					<tbody>
						<tr>
							<td>Apple Inc.</td>
							<td>AAPL</td>
							<td><a class="link" href="sampleq.php" onclick= 'document.getElementById('search').action = "sampleq.php"';>Quote</a></td>
							<td><a href="hsample.php">History</a></td>
						</tr>!-->
        <br> <br>
    </body>
    
    <footer>
		<p>&copy Pablo Bautista - Seattle Pacific University 2017 &copy </p>
	</footer>
    
</html>

<?php
ob_end_flush();
?>