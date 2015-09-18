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
        <title>About Us</title>
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
					echo '<li class="current"><a href="/toylib/about.php?'. SID .'" class="parent"><span>About Us</span></a></li>';
					echo '<li><a href="/toylib/toystatus.php?'. SID .'" class="parent"><span>Toys</span></a>
						<div><ul>
							<li><a href="/toylib/category.php?'. SID .'"><span>Toy Categories</span></a></li>
						</ul></div>
					</li>';							
					echo '<li><a href="/toylib/membership.php?'. SID .'" class="parent"><span>Membership</span></a></li>';
					echo '<li><a href="/toylib/borrow.php?'. SID .'" class="parent"><span>Borrowing</span></a>';
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

		<h2>About Us</h2>
        
        <p>The Pukerua Bay Toy Library is a sub branch of Pukerua Bay Plunket. We are a non profit organisation which provides quality toys and puzzles for families to borrow (catering for children up to 7 years of age). We belong to the Toy Library Federation of New Zealand. We are run by parents for parents! We are based in Pukerua Bay.</p>
        <p>Our aim is to provide families with access to a wide range of entertaining and educational toys, puzzles, games, story and music tapes, CDs and CD-ROMs.</p>

        <h3>Our Librarians</h3>
        	<p>Our library is very fortunate to have a team experienced librarians who have a wealth of knowledge that they are only too happy to share with our members.<p>

			<p>If you have any questions or suggestions about the toy library, please feel free to speak to one of them.</p>
            
            <ul>
                <li>Mona Lisa - Principal Librarian (Thursday)</li>
                <li>Leo Connor - Librarian (Saturday)</li>
        	</ul>
		<?php include 'base/copyright.php';?>
	</body>
</html>