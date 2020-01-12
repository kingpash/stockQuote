<?php
ob_start();
?>

<?php
// ---------------------------------------------------------------
// thesite.php
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
      <title>Stock Overflow - Quotes Page Sample</title>
    </head>

    <body>
	    
        <header>
	        
			<h1 align="center">Stock Overflow</h1>
        </header>
        
        <form action="hsample.php" method="get">
	        	<br>
	        	<br>
				<div style="text-align:center;"><input type="text" name="search" placeholder="Search..."></div>
				<br>
				<div class="wrapper" >
					<button class="button button1">History</button>
					<button class="button button1">Quote</button>
					<a class="button button1" href="default.php">Home</a>
				</div>
			</form> 
		<br> <br><br> <br>
    </body>
</html>

<?php
ob_end_flush();
?>