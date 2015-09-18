<!DOCTYPE HTML>
<html>
	<head>
    	<!--[if lte IE 6]>
        	<meta http-equiv="refresh" content="0; URL=http://windows.microsoft.com/en-nz/windows/upgrade-your-browser">
        <![endif]-->
		<link rel="shortcut icon" href="favicon.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link type="text/css" href="css/styles.css" rel="stylesheet"/>
        <link type="text/css" href="css/menu.css" rel="stylesheet"/>
        <link type="text/css" href="css/navbar.css" rel="stylesheet"/>
		<title>Caring for Toys</title>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/navbar.js"></script>
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
						
						<li class = "social"><a href="https://facebook.com/" target="_blank"><span><img title = "Facebook" alt="FB.jpg" src="images/btn_images/facebook.gif"></span></a></li>
			<li class = "social"><a href="https://twitter.com/" target="_blank"><span><img title = "Twitter" alt="Tweet.jpg" src="images/btn_images/twitter.gif"></span></a></li>
					</ul>';
				echo '</div>';
				echo '</div>';
				echo '</div> <br><br>';
			?>
            
        <h2>Caring for Toys</h2>
            
        <p>All toys have a contents list. To avoid misunderstandings when you   return toys, check the contents of each borrowed item against its list as soon as you get home. Let the library know immediately by email or phone if there are missing or broken pieces.</p>
        <p>Please look after the toys that you borrow to ensure their longevity. If any toys are not up to the standard that you expect, please inform one of the librarians.</p>
        <p>Put toys away if young visitors arrive, unless they are closely supervised.   Try restricting use of inside toys to one place or one room to make it   easier to find parts when toys are due back.</p>
        
        <h3>Repairs</h3>
        <p>Please make minor repairs to toys or packaging if you can. Toys should   not be issued if they are broken. If a toy that you have borrowed has   broken, please inform the librarian who will arrange to either get it   fixed or be replaced. </p>
        
        <h3>Packaging</h3>
        <p>If possible, remove toys from their packaging (plastic bags should not   be given to the children) and store the containers in a safe place at   home. It is helpful if small pieces are kept in small bags. Please use   elastic bands if you see fit. Please return puzzles completed so it is   easier for our volunteers to see all the pieces are there. Please return   toys in the correct packaging.</p>
        
        <h3>Cleaning of Toys</h3>
        <p>Please clean toys before returning them and make sure they are dry   (especially water toys). If you return toys that are dirty, you will be   asked to take them home to clean.</p>
        <p><strong>Recommended cleaning items: </strong></p>
        <ul>
          <li>Ammonia-based spray cleaner (such as &ldquo;Spray &amp; Wipe&rdquo;) </li>
          <li>Antibacterial wipes </li>
          <li>Disinfectant (such as &ldquo;Dettol&rdquo;) </li>
          <li>Sponge cloth </li>
          <li>Toothpicks </li>
          <li>Old toothbrush </li>
        </ul>
        
        <h3>Rattles and Baby Toys</h3>
        <p>Must not be immersed in water as it can get inside, rendering the toy   useless. Wipe thoroughly with hot water, a sponge cloth with a small   amount of cleaner as recommended above. We recommend for the safety of   your child that you do this prior to giving the toy to your child and   again before you return it.</p>
        
        <h3>Ride-on Vehicles and Outdoor Toys</h3>
        <p>These must be returned clean. Please protect outside toys from the   weather. If possible store indoors at night and keep them secure if you   are away from the property.</p>
        
        <h3>Puzzles and Games</h3>
        <p>Wooden puzzles can be wiped over, or if necessary washed gently. Cardboard should be wiped over with a slightly damp sponge cloth.</p>
        
    	<?php include 'base/copyright.php'; ?>
	</body>
</html>