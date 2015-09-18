<!DOCTYPE HTML>
<html>
	<head>
    	<!--[if lte IE 6]>
        	<meta http-equiv="refresh" content="0; URL=http://windows.microsoft.com/en-nz/windows/upgrade-your-browser">
        <![endif]-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link type="text/css" href="css/styles.css" rel="stylesheet"/>
        <link type="text/css" href="css/menu.css" rel="stylesheet"/>
        <link type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
        <title>Book Out Toys</title>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.ui.core.js"></script>
		<script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/html5shiv.js"></script>
        <script>
			$(function() {
				$("#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
			});
		</script>
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
				echo '<div><ul>';
					//if toyMnager or Volunteer looged in, display link to exclusive area
					if (($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager')) {
						//Displays link to validation page --> exclusive area
						echo '<li><a href="/toylib/validate.php?'. SID .'"><span>Go to Exclusive Area</span></a></li>';
					}
				echo '</ul></div>
			</li>';				
			echo '<li><a href="/toylib/toystatus.php" target="_blank" class="parent"><span>Toys</span></a></li>';				
			echo '<li class="current"><a href="#" class="parent"><span>Add</span></a>
				<div><ul>
					<li><a href="/toylib/addloans.php?'. SID .'"><span>Loans</span></a></li>
					<li><a href="/toylib/addmember.php?'. SID .'" target="_blank"><span>Members</span></a></li>
				</ul></div>
			</li>';				
			echo '<li class="last"><a href="#" class="parent"><span>View OR Edit</span></a>
				<div><ul>
					<li><a href="/toylib/loaned.php?'. SID .'" class="parent"><span>Loans</span></a>
						<div><ul>
							<li><a href="/toylib/overdue.php?'. SID .'"><span>Overdue/Due</span></a></li>
						</ul></div>
					</li>
					<li><a href="/toylib/members.php?'. SID .'"><span>Members</span></a></li>
				</ul></div>
			</li>';
			echo '</ul>';
			echo '</div>';
			echo '</div><br><br>';
			echo '<h2>Book Out Toys</h2>';
		
			//connect to the database
			$dbc = mysqli_connect('localhost', $_SESSION['Login'], $_SESSION['Password'], 'toylib');
			
			//was connection successful?
			if(!$dbc) {
				//kill the script
				echo ('Could not connect to the database!');
				include 'base/copyright.php';
				exit;
			}
			
			//if the form has been submitted
			if(!empty($_GET)){
			
				//Check for errors		
				extract($_GET);
				
				//create an empty array to store errors
				$errors = array();
				
				
				//check the toy ID
				if(!$ToyID){
					$errors [] = 'Please enter a ToyID';
				} else if(strlen($ToyID) > 8) {
					$errors[] = 'Please enter a shorter ToyID. 8 characters maximum. This ID should match the product code engraved on the toy';
				}
				
				//Check if ToyID correct/exist?
				$CheckToy = mysqli_query($dbc, "SELECT ToyID FROM Toys WHERE ToyID = '".$ToyID."';");
				if(mysqli_num_rows($CheckToy) == 0) {
					$errors [] = 'ToyID not found in database. Check your ToyID';
				}
				
				//check the customer ID
				if(!$CustomerID){
					$errors [] = 'Please enter a CustomerID';
				} else if(strlen($CustomerID) > 6) {
					$errors[] = 'Please enter a shorter CustomerID. 6 characters maximum. This ID should match the ID on the customer card';
				}
				
				//Check if Customer ID correct/exist?
				$CheckCustomer = mysqli_query($dbc, "SELECT CustomerID FROM Members WHERE CustomerID = '".$CustomerID."';");
				if(mysqli_num_rows($CheckCustomer) == 0) {
					$errors [] = 'Customer not found in database. Check your CustomerID';
				}
				
				//check the due date
				if(!$Due){
					$errors [] = 'Please enter a Due Date';
				}
				
				//were there any errors
				if (empty ($errors)){
					//was connection successful?
					if(!$dbc) {
						//kill the script
						echo ('Could not connect to the database!');
						include 'base/copyright.php';
						exit;
					}
					
					//prepare INSERT Loan and UPDATE Toys query			
					$sql = "INSERT INTO Loaned VALUES (NULL,'$ToyID','$CustomerID','$Due','0000-00-00 00:00:00','NOW()');
							UPDATE Toys SET Status = '$Status' WHERE ToyID = '$ToyID';";
					
					//execute the query
					$result = mysqli_multi_query($dbc, $sql);
					
					//was the insert successful
					if($result && mysqli_affected_rows($dbc) >  0) {
						echo 'Adding loan record successful!';
						include 'base/copyright.php';
						exit;
					} else {
						echo 'Could not add loan record to database';
						include 'base/copyright.php';
						exit;
					}
				} else {
					//there were errors
					echo 'Please fix the following errors:';
					echo'<ul>';
					foreach($errors as $error){
						echo '<li>';
						echo $error;
						echo '</li>';
					}
				}
			echo '</ul>';
		}
		?>
		
			
		<form method="get" action="addloans.php">
            <fieldset><br>
    		<legend>Toy and Customer Information</legend>
            ToyID:	<input type="text" name="ToyID"><br>
        	CustomerID: <input type="text" name="CustomerID"><br>
			</fieldset>
            
            <br>
            <fieldset><br>
    		<legend>Loan Information</legend>            
            Due: <input type="date" name="Due" id="datepicker"><br>
        	Status:
            <select name="Status">
            <option value="Out" selected>Out</option>
            <option value="Reserved">Reserved</option>
          	</select><br>
            </fieldset>
            
            <br>
            <input type="submit" name="submit" value="Book Out Toy"><br>
		</form>
		
		<?php include 'base/copyright.php';?>
	</body>
</html>