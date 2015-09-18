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
		<title>Edit Loans</title>
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
				echo '<div id="floatingbar">';
				echo '<div id="menu">';
				echo '<ul class="menu">';
				echo'<li><a href="/toylib" class="parent"><span>Home</span></a>
					<div><ul>
						<li><a href="/toylib/validate.php?'. SID .'"><span>Go to Exclusive Area</span></a></li>
					</ul></div>
				</li>';
				echo '<li><a href="/toylib/toystatus.php" class="parent" target="_blank"><span>Toys</span></a></li>';
				echo '<li><a href="#" class="parent"><span>Add</span></a>
					<div><ul>
						<li><a href="/toylib/addloans.php?'. SID .'"><span>Loans</span></a></li>
						<li><a href="/toylib/addmember.php?'. SID .'" target="_blank"><span>Members</span></a></li>
					</ul></div>
				</li>';
				echo '<li class="current"><a href="#" class="parent"><span>View OR Edit</span></a>
					<div><ul>
						<li><a href="/toylib/loaned.php?'. SID .'" class="parent"><span>Loans</span></a>
							<div><ul>
								<li><a href="/toylib/overdue.php?'. SID .'"><span>Overdue/Due</span></a></li>
							</ul></div>
							</li>
						<li><a href="/toylib/members.php?'. SID .'"><span>Members</span></a></li>
					</ul></div>
				</li>';
				echo'</ul>';
				echo'</div>';
				echo'</div><br><br>';
				echo '<h2>Edit Loan Status</h2>';
										
					//Get the ID
					$id = $_GET['id2'];
					
					//Establish a database connection
					$dbc = mysqli_connect("localhost",$_SESSION['Login'], $_SESSION['Password'],"toylib");
				
					//Exit if there is connection error
					if ($error = mysqli_connect_error()) {
						die('Database connection error.'.$error);
						include 'base/copyright.php';
					}
					
					//Update database
					$sql = "UPDATE Toys SET Status = 'Overdue' WHERE ToyID = '$id';";
					
					//Execute the query
					$result = mysqli_query($dbc, $sql);
									
					//Was it successfull?
					if(mysqli_affected_rows($dbc) > 0) {
						echo '<p>Loan status was successfully updated</p>';
					} else {
						echo '<p>Loan status could not be updated</p>';
					}
				?>
                
        <?php include 'base/copyright.php'; ?>
	</body>
</html>