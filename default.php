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
	  <link href='https://fonts.googleapis.com/css?family=Megrim' rel='stylesheet'>
      <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
      <title>Stock Overflow</title>
    </head>

    <body>
	    
        <header>
	        
			<h1 align="center">Stock Overflow</h1>
			<br><br>
			
				<div align="center" class="container1">
					<img src="quote.png" alt="Quote" class="image">
					<div class="overlay1">
					<button class ="Qbtn" onclick="myFunction()">Quote</button>
  					</div>
				</div>
				<br>
				<div align="center" class="container2">
					<img src="history.png" alt="History" class="image">
					<div class="overlay">
					<button class ="Hbtn" onclick="myFunction()">History</button>
  					</div>
				</div>
				<br>
				<div align="center" class="container3">
					<img src="search.png" alt="Search" class="image">
					<div class="overlay">
					<a class ="Sbtn" href="Lookup.php">Lookup</button></a>
  					</div>
				</div>
				<br>
				
			<script>
			function myFunction() 
			{
				var x = document.getElementById('SearchDiv');
				if (x.style.display === 'none') {
				x.style.display = 'block';
    			} else {
				x.style.display = 'none';
    			}
			}
			
			</script>
                
        </header>
        <div id="SearchDiv">
        	<form action="sampleq.php" method="get">
	        	<br>
	        	<br>
				<div style="text-align:center;"><input type="text" name="search" placeholder="Search..."></div>
				<br>
				<div class="wrapper" >
					<button class="button button1">Find Stock</button><br><br>
				</div>
			</form>
		</div>
    </body>
    
    <footer>
		<p>&copy Pablo Bautista - Seattle Pacific University 2017 &copy </p>
	</footer>
    
</html>

<?php
ob_end_flush();
?>