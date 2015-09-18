<!DOCTYPE HTML>
<html>
	<head>
    	<!--[if lte IE 6]>
        	<meta http-equiv="refresh" content="0; URL=http://windows.microsoft.com/en-nz/windows/upgrade-your-browser">
        <![endif]-->
		<link rel="shortcut icon" href="favicon.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link type="text/css" href="css/styles.css" rel="stylesheet"/>
        <link type="text/css" href="css/menu.css" rel="stylesheet"/>
        <link type="text/css" href="css/navbar.css" rel="stylesheet"/>
		<title>Borrowing</title>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/navbar.js"></script>
        <script type="text/javascript" src="js/html5shiv.js"></script>
	</head>

	<body>
    	<noscript>
        	<div id="nojava">This webpage needs JavaScript. Pukerua Bay Toy Library works best with JavaScript enabled.</div>
        </noscript>
            	<?php
					include 'base/header.php';
					echo '<br><br><br><br><br><br>';
					echo '<div id="floatingbar">';
					echo '<div id="menu">';
					echo '<ul class="menu">';
					echo '<li><a href="/toylib" class="parent"><span>Home</span></a>';
					// If toyMnager or Volunteer looged in, display link to exclusive area
					if (($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager')) {
						//Displays link to validation page --> exclusive area
						echo '<div><ul>';
						echo '<li><a href="/toylib/validate.php?'. SID .'"><span>Go to Exclusive Area</span></a></li>';
						echo '</ul></div>';
					}
					echo '</li>';
					echo '<li><a href="/toylib/about.php?'. SID .'" class="parent"><span>About Us</span></a></li>';
					echo '<li><a href="/toylib/toystatus.php?'. SID .'" class="parent"><span>Toys</span></a>
						<div><ul>
							<li><a href="/toylib/category.php?'. SID .'"><span>Toy Categories</span></a></li>
						</ul></div>
					</li>';							
					echo '<li><a href="/toylib/membership.php?'. SID .'" class="parent"><span>Membership</span></a></li>';
					echo '<li class="current"><a href="/toylib/borrow.php?'. SID .'" class="parent"><span>Borrowing</span></a>';
						echo '<div><ul>';
						//Allow only members to reserve a toy
						if (!(($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'Guest'))) {
							echo '<li><a href="/toylib/notspam.php?'. SID .'"><span>Reserve a Toy</span></a></li>';
						}
						echo '<li><a href="/toylib/toycare.php?'. SID .'"><span>Caring for Toys</span></a></li>
						</ul></div>
					</li>';
					echo '<li class="last"><a href="/toylib/contact.php?'. SID .'"><span>Contact Us</span></a></li>';							
				echo '</ul>';
				echo '<div id="search">
					<ul>
						<li>
							<form action="results.php" method="get" name="fmSearch">
							<input type="text" name="search" placeholder="Search for a Toy"/>
							<input type="submit" value="Search" name="submit"/>
							</form>
						</li>
						
						<li class = "social"><a href="https://facebook.com/" target="_blank"><span><img title = "Facebook" alt="facebook link" src="images/btn_images/facebook.gif"></span></a></li>
					<li class = "social"><a href="https://twitter.com/" target="_blank"><span><img title = "Twitter" alt="twitter link" src="images/btn_images/twitter.gif"></span></a></li>
					</ul>';
				echo '</div>';
				echo '</div>';
				echo '</div> <br><br>';
			?>
            
	<h2>Borrowing</h2>
    <!--Video about toy library-->
    <video width="320" height="240" controls>
		<source src="video/borrow.webm" type="video/webm">
    	<source src="video/borrow.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    
    <h3>Loan Conditions</h3>
    <ul>
        	<li>The loan period is for a maximum of two weeks.</li>
            <li>There is no renewal of toys.</li>
			<li>Toys can be returned and new toys selected earlier than two weeks.</li>
            <li>Members may not swap toys between each other.</li>
	</ul>
        
	<h3>Return</h3>
        <ol>
        	<li>Present your issue receipt showing the items borrowed to the duty volunteers at the Returns Desk</li>
            <li>Have the toys ready for checking.</li>
            <li>Pay any fees owing to the librarian at the Issue Desk (including any additional penalty fees).</li>
		</ol>
	
    <h3>Penalty Fees</h3>
    <p>We try to recover the costs of repairs and replacements by imposing the following fees:</p>
    <table class="global" border-spacing="0">
        <tr>
        <th><strong>Item</strong></th>
        <th><strong>Fine</strong></th>
        </tr>
        
        <tr>
        <td>Missing Piece</td>
        <td>$5 - (a full refund will be given if   the missing piece is returned within a 3 month period)</td>
        </tr>
        
        <tr>
        <td>Lost, broken or badly damaged item</td>
        <td>Usually $5 - (if an item is lost or broken   beyond repair, a higher amount maybe charged depending on   age/replacement costs etc)</td>
        </tr>
        
        <tr>
        <td>Broken container</td>
        <td>$5    (small) / $10 (medium) / $20 (large) / $30 (extra large)</td>
        </tr>
        
        <tr>
        <td>Broken CD case/cassette case/plastic envelope</td>
        <td>50c</td>
        </tr>
        <tr>
          <td>Lost/damaged CD-ROM envelope/puzzle bag cover</td>
          <td>$2</td>
        </tr>
        <tr>
          <td>Lost/damaged drawstring plastic bag</td>
          <td>$5</td>
        </tr>
        <tr>
          <td>Overdue item</td>
          <td>$2 per item per week</td>
        </tr>
    </table>
    	            
	<?php include 'base/copyright.php'; ?>
	</body>
</html>