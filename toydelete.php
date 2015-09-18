<!DOCTYPE HTML>
<html>
	<head>
    	<!--[if lte IE 6]>
        	<meta http-equiv="refresh" content="0; URL=http://windows.microsoft.com/en-nz/windows/upgrade-your-browser">
        <![endif]-->
		<link rel="shortcut icon" href="favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link type="text/css" href="css/styles.css" rel="stylesheet"/>
        <link type="text/css" href="css/menu.css" rel="stylesheet"/>
		<title>Toy Deleted</title>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
	</head>

	<body>
            	<?php
					include 'base/header.php';
					if (!(($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager'))) {
						include 'base/menu-nopersist.php';
						echo '<h2>Exclusive Area</h2>';
						echo 'You are not authorised to view this page';
						include 'base/copyright.php';
						exit;
					}

					echo '<br><br><br><br><br><br>';
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
						
						<li class = "social"><a href="https://facebook.com/" target="_blank"><span><img alt="facebook link" src="images/btn_images/facebook.gif"></span></a></li>
						<li class = "social"><a href="https://twitter.com/" target="_blank"><span><img alt="twitter link" src="images/btn_images/twitter.gif"></span></a></li>
					</ul>';
				echo '</div>';
				echo '</div> <br><br>';
				echo '<h2>Toys Deleted!!!</h2>';
					
				//Get the ID
				$id = $_GET['id'];
				
				//Establish a database connection
				$dbc = mysqli_connect("localhost",$_SESSION['Login'], $_SESSION['Password'],"toylib");
				
				//Exit if there is connection error
				if ($error = mysqli_connect_error()) {
					die('Database connection error.'.$error);
					include 'copyright.php';
					exit;
				}
				
				//Update database
				$sql = "DELETE FROM Toys WHERE ToyID ='$id';";
				
				//Execute the query
				$result = mysqli_query($dbc, $sql);
								
				//Was it successfull?
				if(mysqli_affected_rows($dbc) > 0) {
					echo '<p>Record was successfully deleted from TOYS database</p>';
				} else {
					echo '<p>Toy record could not be deleted</p>';
				}
				?>
     	
        <?php include 'base/copyright.php'; ?>
	</body>
</html>