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
		<title>Sign Up for Membership</title>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/checklogin.js"></script>
        <script type="text/javascript" src="js/html5shiv.js"></script>
	</head>
    
	<body>
    	<noscript>
        	<div id="nojava">This webpage needs JavaScript. Pukerua Bay Toy Library works best with JavaScript enabled.</div>
        </noscript>
		<?php
			include 'base/header.php';
			include 'base/menu-nopersist.php';				
			echo '<h2>Sign Up With The Pukerua Bay Toy Library NOW!!!</h2>';
			
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
			if(!empty($_POST)){
				
				//Prevents SQL injection
				$Login = mysqli_real_escape_string($dbc, $_POST['Login']);
				$FName = mysqli_real_escape_string($dbc, $_POST['FName']);
				$LName = mysqli_real_escape_string($dbc, $_POST['LName']);
				$EMail = mysqli_real_escape_string($dbc, $_POST['EMail']);
				$Password = md5(mysqli_real_escape_string($dbc, $_POST['Password']));
				$HouseNo = mysqli_real_escape_string($dbc, $_POST['HouseNo']);
				$Street = mysqli_real_escape_string($dbc, $_POST['Street']);
				$Suburb = mysqli_real_escape_string($dbc, $_POST['Suburb']);
				$Telephone = mysqli_real_escape_string($dbc, $_POST['Telephone']);
				$Mobile = mysqli_real_escape_string($dbc, $_POST['Mobile']);
				
				//Check for errors		
				extract($_POST);
				
				//create an empty array to store errors
				$errors = array();
				
				//Check if login exist?
				$CheckLogin = mysqli_query($dbc, "SELECT Login FROM Members WHERE Login = '".$Login."';");
				if(mysqli_num_rows($CheckLogin) == 1) {
					$errors [] = 'The user name you entered is already taken. Please enter another user name';
				}
				
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
				
				//check the username
				if(!$Login){
					$errors [] = 'Please enter a username';
				} else if(strlen($Login) > 16) {
					$errors[] = 'Please enter a shorter username. 16 characters maximum';
				}
				
				//check the password
				if(!$Password){
					$errors [] = 'Please enter a password';
				} else if(strlen($Password) < 6) {
					$errors[] = 'Please enter a longer password. 6 characters minimum';
				} else if(strlen($Password) > 16) {
					$errors[] = 'Please enter a longer password. 16 characters maximum';
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
				} else if (!ctype_alpha (str_replace(' ', '', $Street))) {
					$errors [] = 'Please enter a valid street name. No symbols, punctuations or numbers';
				}
				
				//check the suburb
				if(!$Suburb){
					$errors [] = 'Please enter a suburb';
				} else if(strlen($Suburb) > 15) {
					$errors[] = 'Please enter a shorter suburb nmae. 15 characters maximum';
				} else if (!ctype_alpha (str_replace(' ', '', $Suburb))) {
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
				
				//were there any errors?
				if (empty ($errors)){
					//$Salt ='daRdAoao29293863';
					//$Hash = $Salt.$_POST['Password'];
					//$Password = hash ('sha256' , $Hash);
					
					//prepare quesry, create user and give priviledges			
					$sql = "INSERT INTO Members VALUES (NULL,'$FName','$LName','$Gender','$EMail','$HouseNo','$Street','$Suburb','$City','$Telephone','$Mobile','0.00','0000-00-00','$Login','$Password');
					
					CREATE USER '$Login'@'localhost';
					GRANT USAGE ON *.* TO '$Login'@'localhost';
					GRANT SELECT, UPDATE ON `toylib`.`members` TO '$Login'@'localhost';
					GRANT SELECT ON `toylib`.`toys` TO '$Login'@'localhost';
					GRANT SELECT ON `toylib`.`loaned` TO '$Login'@'localhost';
					SET PASSWORD FOR '$Login'@'localhost' = PASSWORD('$Password');";
					
					//execute the query
					$result = mysqli_multi_query($dbc, $sql);
					
					//was the insert successful
					if($result && mysqli_affected_rows($dbc) >  0) {
						echo 'Sign-up successful!';
						//Redirect here
						echo '<meta http-equiv="refresh" content="0; URL=/toylib/index.php">';
						include 'base/copyright.php';
						exit;
					} else {
						echo 'Could not sign-up for membership';
						echo '<br><br>';
						echo '<button onclick="history.go(-1);">Back </button>';
					}
			} else {
				//if there were errors
				echo 'Please fix the following errors:';
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
		
		<form method="post" action="addmember.php">
        	<fieldset><br>
    		<legend>Personal Information</legend>
            First Name:	<input type="text" name="FName"><br>
        	Last Name: <input type="text" name="LName"><br>
            Gender:
            	<label for="male">Male</label>
            		<input type="radio" name="Gender" value="m">
				<label for="female">Female</label>
					<input type="radio" name="Gender" value="f">
        	<br> 
			</fieldset>
            
            <br>
            <fieldset><br>
    		<legend>Login Information</legend>
            Chosen UserName: <input type="text" name="Login"><br>
            Password: <input type="password" name="Password"><br>
			</fieldset>            
        	
            <br>
            <fieldset><br>
    		<legend>Home Address</legend>
            House Number: <input type="text" name="HouseNo"><br>
        	Street: <input type="text" name="Street"><br>
        	Suburb: <input type="text" name="Suburb"><br>
        	City:
            <select name="City">
            <option value="Wellington" selected>Wellington</option>
            <option value="Porirua" >Porirua</option>
			<option value="Upper Hutt">Upper Hutt</option>
            <option value="Lower Hutt">Lower Hutt</option>
			<option value="Kapiti">Kapiti</option>
          	</select><br>
			</fieldset>
            
            <br>
            <fieldset><br>
    		<legend>Contact Information</legend>
            Email: <input type="text" name="EMail"><br>
        	Telephone: <input type="text" name="Telephone"><br>
        	Mobile: <input type="text" name="Mobile"><br>
			</fieldset>
            
            <br>
            <input type="submit" value="Sign-Up">
		</form>
        
        <br>
        <strong>Intentional misuse of this form is prohibited by law. We can track your activity on this website</strong>
        
        <?php include 'base/copyright.php';?>
	</body>
</html>