<?php
		session_start();
		echo '<header>';
		echo '<br>';
		
			//If user not logged in...?
			if (empty($_SESSION['Login'])) {
				$_SESSION['Login'] = 'Guest';
				$_SESSION['Password'] = 'tQrUF2ddyL5t9ppt';
			}
			
			echo '<section id = "login">';
			echo '<div class="buttonwrapper">';
					//Show who is logged in
					if (!($_SESSION['Login'] == 'Guest')) {
						echo 'Welcome! ' .($_SESSION['Login']);
						echo '<br>';
					}
					
					//If user not logged in...? You need to be guest to allow 'sign-up'
					if ($_SESSION['Login'] == 'Guest') {
						echo '<a href="/toylib/login.php" class="squarebutton blue"><span>Login</span></a>';
						echo '<br><br>';
						echo '<a href="/toylib/addmember.php" class="squarebutton orange"><span>Sign-up for Membership</span></a>';
					}
					
					//If ToyManager OR Volunteers if logged in, don't allow 'Edit Member' directly --> go to exclusive area
					if (!(($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'Guest') || ($_SESSION['Login'] == 'DBManager'))) {
						echo '<a href="/toylib/editmember.php?'. SID .'" class="squarebutton blue"><span>Edit Your Details</span></a>';
					}
					
					//If user not logged in...? = Guest, DONT allow logout. what's the point?
					if (!($_SESSION['Login'] == 'Guest')) {
						echo '<br><br>';
						echo '<a href="/toylib/logout.php?'. SID .'" class="squarebutton orange"><span>Logout</span></a>';
					}
			echo '</div>';
			echo '</section>';
		
			echo '<img alt="toylibrary logo" id="toylib" src="images/PlayIsTheWay_logo.gif" title="Pukerua Bay Toy Library">';
            echo '<h1>Pukerua Bay Toy Library</h1>';
    	echo '</header>';
				
?>