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
        <title>Edit Member Details</title>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/html5shiv.js"></script>
	</head>

	<body>
    	<noscript>
        	<div id="nojava">This webpage needs JavaScript. Pukerua Bay Toy Library works best with JavaScript enabled.</div>
        </noscript>            	
		<?php
			//If either any of $id or $id2 is not present, error = undefined variable
			error_reporting(0);
    		include 'base/header.php';
            include 'base/menu-nopersist.php';
			echo '<h2>Update Details</h2>';
									
				//Get the IDs
				$id = $_GET['id'];
				$id2 = $_SESSION['Login'];
				
				//Establish a database connection
				$dbc = mysqli_connect("localhost",$_SESSION['Login'], $_SESSION['Password'],"toylib");
			
				//Exit if there is connection error
				if ($error = mysqli_connect_error()) {
					echo('Database connection error.'.$error);
					include 'base/copyright.php';
					exit;
				}
				
				//Prepare the query
				$sql = "SELECT CustomerID, FName, LName, Gender, EMail, HouseNo, Street, Suburb, City, Telephone, Mobile, Credit, Paid, Login, Password FROM `Members` WHERE ((Login= '$id2') OR (CustomerID= '$id'));";
				
				//Execute the query
				$result = mysqli_query($dbc, $sql);
				
				//If there are records selected
				if ($result && mysqli_num_rows($result) > 0) {
					$element = mysqli_fetch_array($result,MYSQL_ASSOC);
				} else {
					echo '<p>No member was selected</p>';
					echo '<br><br>';
					echo '<button onclick="history.go(-1);">Back </button>';
					include 'base/copyright.php';
					exit;
				}
				
				//Has the form been submitted?
				if (!empty($_POST)) {
						//Make the form sticky...
						$element = ($_POST);
						
						//Prevents SQL injection
						$FName = mysqli_real_escape_string($dbc, $_POST['FName']);
						$LName = mysqli_real_escape_string($dbc, $_POST['LName']);
						$EMail = mysqli_real_escape_string($dbc, $_POST['EMail']);
						$Password = md5(mysqli_real_escape_string($dbc, $_POST['Password']));
						$OldPassword = md5(mysqli_real_escape_string($dbc, $_POST['OldPassword']));
						$HouseNo = mysqli_real_escape_string($dbc, $_POST['HouseNo']);
						$Street = mysqli_real_escape_string($dbc, $_POST['Street']);
						$Suburb = mysqli_real_escape_string($dbc, $_POST['Suburb']);
						$Telephone = mysqli_real_escape_string($dbc, $_POST['Telephone']);
						$Mobile = mysqli_real_escape_string($dbc, $_POST['Mobile']);
						
						extract($_POST);
					
						$errors = array();
						
						//check the first name
						if(!$FName){
							$errors [] = 'Please enter a first name';
						} else if(strlen($FName) > 20) {
							$errors[] = 'Please enter a shorter first name. 20 characters maximum';
						} else if (!ctype_alpha (str_replace(' ', '', $FName))) {
							$errors [] = 'Please enter a valid first name. No symbols, punctuations or numbers';
						}
					
						//check the last name
						if(!$LName){
							$errors [] = 'Please enter a last name';
						} else if(strlen($LName) > 20) {
							$errors[] = 'Please enter a shorter last name. 20 characters maximum';
						} else if (!ctype_alpha (str_replace (' ', '', $LName))) {
							$errors [] = 'Please enter a valid last name. No symbols, punctuations or numbers';
						}
						
						//check the email
						if(!$EMail){
							$errors [] = 'Please enter an email address';
						} else if(strlen($EMail) > 32) {
							$errors[] = 'Please enter a shorter email. 20 characters maximum';
						} else if (!filter_var($EMail, FILTER_VALIDATE_EMAIL)) {
    						$errors[] = 'The email address you entered is invalid. Enter a valid email address';
						}
						
						//If a member is logged in...
						if (!(($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager'))) {
							//check the CURRENT password
							$CheckPass = mysqli_query($dbc, "SELECT Password FROM Members WHERE ((Login= '$id2') OR (CustomerID= '$id'));");
							if(!$OldPassword == $CheckPass){
								$errors [] = 'The password you have entered in the CURRENT PASSWORD field does not match your current password';
							}
						}
						
						//If a member is logged in...
						if (!(($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager'))) {
							//If 'NEW Password' field not filled in, current password stays the same
							if(!$Password){
								$Password = $OldPassword;
							}
						}
						//check the NEW password - not a required field
						if ((!empty($Password)) && (strlen($Password) < 6)) {
							$errors[] = 'Please enter a longer password. 6 characters minimum';
						} else if((!empty($Password)) && (strlen($Password) > 16)) {
							$errors[] = 'Please enter a shorter password. 16 characters maximum';
						}
							
						//check the house number
						if(!$HouseNo){
							$errors [] = 'Please enter a house number';
						} else if(strlen($HouseNo) > 7) {
							$errors[] = 'Please enter a shorter house number. 7 characters maximum';
						}
						
						//check the street
						if(!$Street){
							$errors [] = 'Please enter a street name';
						} else if(strlen($Street) > 30) {
							$errors[] = 'Please enter a shorter street name. 30 characters maximum';
						} else if (!ctype_alpha($Street)) {
							$errors [] = 'Please enter a valid street name. No symbols, punctuations or numbers';
						}
						
						//check the suburb
						if(!$Suburb){
							$errors [] = 'Please enter a suburb';
						} else if(strlen($Suburb) > 15) {
							$errors[] = 'Please enter a shorter suburb nmae. 15 characters maximum';
						} else if (!ctype_alpha($Suburb)) {
							$errors [] = 'Please enter a valid suburb name. No symbols, punctuations or numbers';
						}
						
						//check the telephone - not a required field in itself
						if(strlen($Telephone) > 7) {
							$errors[] = 'Home phone too long. 7 characters maximum';
						} else if (($Telephone !='') && (!is_numeric($Telephone))) {
							$errors [] = 'Please enter a valid home phone. No letters';
						}
							
						//check the mobile - not a required field in itself
						if(strlen($Mobile) > 10) {
							$errors[] = 'Mobile phone too long. 10 characters maximum';
						} else if (($Mobile !='') && (!is_numeric($Mobile))) {
							$errors [] = 'Please enter a valid mobile phone. No letters';
						}
							
						//ONE of telephone or mobile is required
						if((!$Telephone) || (!$Mobile)) {
							$errors [] = 'Please enter EITHER ONE OF: Telephone or Mobile';
						}
						
						//After form validation... for each and every input firld
						if (empty($errors)) {
							extract($_POST);
						
						//If a member is logged in...
						if (!(($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager'))) {
							//Update database and password
							$sql = "UPDATE Members SET FName = '$FName', LName = '$LName', Gender = '$Gender', EMail = '$EMail', HouseNo = '$HouseNo', Street = '$Street', Suburb = '$Suburb', City = '$City', Telephone = '$Telephone', Mobile = '$Mobile', Login = '$Login', Password = '$Password' WHERE ((Login= '$id2') OR (CustomerID= '$id'));
							SET PASSWORD FOR '$Login'@'localhost' = PASSWORD('$Password');";
						} else {
							//Update database and password
							$sql = "UPDATE Members SET FName = '$FName', LName = '$LName', Gender = '$Gender', EMail = '$EMail', HouseNo = '$HouseNo', Street = '$Street', Suburb = '$Suburb', City = '$City', Telephone = '$Telephone', Mobile = '$Mobile', Login = '$Login' WHERE ((Login= '$id2') OR (CustomerID= '$id'));
							SET PASSWORD FOR '$Login'@'localhost' = PASSWORD('$Password');";
						}
						
						//If a member is logged in...
						if (!(($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager'))) {
							$_SESSION['Password'] = $Password;
						}
						
						//Run the query
						$result = mysqli_multi_query($dbc, $sql);
							
						//Was it successfull?
						if ($result) {
							if(mysqli_affected_rows($dbc) > 0) {
								echo 'Information updated successfully!';
								//Redirect here
								echo '<meta http-equiv="refresh" content="0; URL=/toylib/index.php">';
								include 'base/copyright.php';
								exit;
							} else {
								echo '<p>Member details could not be updated</p>';
								echo '<br><br>';
								echo '<button onclick="history.go(-1);">Back </button>';
							}
						}
						} else {
							echo '<p>You have filled in the form incorrectly</p>';
							
							//Display error messsages
							echo '<p>Please fix the following errors:</p>';
							echo'<ul>';
				
							foreach($errors as $error){
								echo '<li>';
								echo $error;
								echo '</li>';
							}
							echo '<br><br>';
							echo '<button onclick="history.go(-1);">Back </button>';
						}
						echo '</ul>';
					}
            	?>
				
                <?php
                	if (!isset($_POST['submit'])) {
				?>
				<!--Create a form where the fields are prepopulated with the current values from the database EXCEPT password-->
				
				<form method="post" action="editmember.php?id=<?php echo $id;?>">
                
                <fieldset><br>
    			<legend>Personal Information</legend>
				First Name:	<input type="text" name="FName" value="<?php echo $element['FName'];?>"><br>
				Last Name: <input type="text" name="LName" value="<?php echo $element['LName'];?>"><br>
				Gender:
					<label for="male">Male</label>
						<input <?php if (!(strcmp($element['Gender'],"M"))) {echo "checked=\"checked\"";} ?> name="Gender" type="radio" value="M" />
					<label for="female">Female</label>
						<input <?php if (!(strcmp($element['Gender'],"F"))) {echo "checked=\"checked\"";} ?> name="Gender" type="radio" value="F" />
                <br> 
				</fieldset>
				
                <br>
            	<fieldset><br>
    			<legend>Login Information</legend>
                Chosen UserName: <input name="Login" value="<?php echo $element['Login'];?>" readonly><br>
				<?php if (!(($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager'))) { ?>
				Enter Current Password: <input type="password" name="OldPassword"><br> <?php echo $CheckPass;?>
                Enter New Password: <input type="password" name="Password"><br>
				<?php } ?>
                </fieldset>
                
				<br>
            	<fieldset><br>
    			<legend>Home Address</legend>
				House Number: <input type="text" name="HouseNo" id="HouseNo" value="<?php echo $element['HouseNo'];?>"><br>
				Street: <input type="text" name="Street" value="<?php echo $element['Street'];?>"><br>
				Suburb: <input type="text" name="Suburb" value="<?php echo $element['Suburb'];?>"><br>
				City:
				<select name="City">
				<option value="Wellington" <?php if ($element['City']=='Wellington') echo 'selected="selected"';?>>Wellington</option>
                <option value="Porirua" <?php if ($element['City']=='Porirua') echo 'selected="selected"';?>>Porirua</option>
				<option value="Upper Hutt"<?php if ($element['City']=='Upper Hutt') echo 'selected="selected"';?>>Upper Hutt</option>
                <option value="Lower Hutt"<?php if ($element['City']=='Lower Hutt') echo 'selected="selected"';?>>Lower Hutt</option>
				<option value="Kapiti"<?php if ($element['City']=='Kapiti') echo 'selected="selected"';?>>Kapiti</option>
				</select><br>
				</fieldset>
            
            	<br>
            	<fieldset><br>
    			<legend>Contact Information</legend>
                Email: <input type="text" name="EMail" value="<?php echo $element['EMail'];?>"><br>
				Telephone: <input type="text" name="Telephone" value="<?php echo $element['Telephone'];?>"><br>
				Mobile: <input type="text" name="Mobile" value="<?php echo $element['Mobile'];?>"><br>
				</fieldset>
                
                <br>
                <input type="submit" name="submit" value="Done"/>
				
                <?php
					}
				?>
				</form>
                
                <br>
        		<strong>Intentional misuse of this form is prohibited by law. We can track your activity on this website</strong>
                
    			<?php include 'base/copyright.php';?>
	</body>
</html>

<?php		
	mysqli_free_result($result); //free up memory
	mysqli_close($dbc); //close the connection
?>