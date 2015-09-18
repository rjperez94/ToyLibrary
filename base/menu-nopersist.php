<?php
	echo '<br><br><br><br><br><br>';
	echo'<div id="menu">';
	echo '<ul class="menu">';				
	echo '<li class="current"><a href="/toylib" class="parent"><span>Home</span></a>';
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
	echo '<li><a href="/toylib/borrow.php?'. SID .'" class="parent"><span>Borrowing</span></a>';
		echo '<div><ul>';
			//Allow only members to reserve a toy
			if (!(($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'Guest'))) {
				echo '<li><a href="/toylib/notspam.php?'. SID .'"><span>Reserve a Toy</span></a></li>';
			}
			echo '<li><a href="/toylib/toycare.php?'. SID .'"><span>Caring for Toys</span></a></li>
			</ul></div>';
	echo '</li>';
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
	echo '</div> <br><br>';
?>