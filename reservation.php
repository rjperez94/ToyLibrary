<!DOCTYPE HTML>
<html>
	<head>
    	<!--[if lte IE 6]>
        	<meta http-equiv="refresh" content="0; URL=http://windows.microsoft.com/en-nz/windows/upgrade-your-browser">
        <![endif]-->
		<link rel="shortcut icon" href="favicon.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link type="text/css" href="css/styles.css" rel="stylesheet"/>
        <link type="text/css" href="css/menu.css" rel="stylesheet"/>
        <link type="text/css" href="css/navbar.css" rel="stylesheet"/>
        <title>Reserve a Toy</title>
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
            if (($_SESSION['Login'] == 'Guest') || (!($_SESSION['Token']))) {
                include 'base/menu-nopersist.php';
                echo '<h2>Request for Toy Reservation</h2>';
                echo 'You are not authorised to view this page';
                include 'base/copyright.php';
                exit;
            }

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
            echo '<h2>Request for Toy Reservation</h2>';
            
            //Get the IDs
            $id = $_SESSION['Login'];;
            
            //Establish a database connection
            $dbc = mysqli_connect("localhost",$_SESSION['Login'], $_SESSION['Password'],"toylib");
            
            //Exit if there is connection error
            if ($error = mysqli_connect_error()) {
                die('Database connection error.'.$error);
               	include 'base/copyright.php';
				exit;
            }
            
            //Prepare the query
            $sql = "SELECT CustomerID, EMail, FName, LName FROM `Members` WHERE Login = '$id';";
                        
            //Execute the query
            $result = mysqli_query($dbc, $sql);
            
            //If there are records selected
            if ($result && mysqli_num_rows($result) > 0) {
                $element = mysqli_fetch_array($result,MYSQL_ASSOC);
            }
            
            //Has the form been submitted?
            if (!empty($_POST)) {
                //Make the form sticky...
                extract($_POST);
				
				//If Message is not filled in
				if(!$_POST['Message']){
					echo 'Please enter a message. Do not forget the following: 
						<ul>
						<li>the ToyID</li>
						<li>time/day of pickup</li>
						<li>the intended day of toy return</li>
						</ul>';
					echo '<button onclick="history.go(-1);">Back </button>';
					include 'base/copyright.php';
					exit;
				}
				
                //Recieving Data From Form and Sending Them - using prepared statements for security
                require('PHPMailer/class.phpmailer.php');
                
                $mail = new PHPMailer();
                
                $mail->SMTPAuth = true; 	// turn on SMTP authentication
                $mail->IsSMTP(); 			// send via SMTP
                $mail->SMTPKeepAlive = true; 	//Keep connection alive throughout this script
                $mail->Host = 'smtp.gmail.com'; 	//SMTP host address >>>> change this if neccessary
                $mail->Port = 587; 			//SMTP port number
                $mail->SMTPSecure = 'tls'; 	//Use tls
                
                //Must use Google's SMTP service to work - ToyLibrary Google Mail
                $mail->Username = 'pukeruabay.toylib@gmail.com'; 		// SMTP username.......Change this to Toy Lib Email
                $mail->Password = 'iamaliveandwell'; 		// SMTP password.......Change this to Toy Lib Password
    
                $customer_email = $element['EMail']; 	//Reply to this email ID
                $email='pukeruabay.toylib@gmail.com';		// Recipients email ID.......Change this to Toy Lib Email
                $name='Pukerua Bay Toy Library - Reservation'; // Recipient's name
                $mail->From = $customer_email;
                $mail->FromName = $element['FName'].' '.$element['LName'];
                $mail->AddAddress($email,$name);
                $mail->AddReplyTo($customer_email, 'Customer ' . $element['CustomerID']);
                
                $mail->WordWrap = 50; 				// set word wrap
                $mail->IsHTML(true); 				// send as HTML
                $mail->Subject = 'Toy Reservation for Customer '. $element['CustomerID'];
                $mail->Body = '<pre>'.$_POST['Message'].'</pre>'; //HTML Body
                $mail->AltBody = $_POST['Message']; //Text Body
                
                if (!$mail->Send()) {
                    echo '<p>Message not sent</p>';
                    echo '<p>Mailer Error: ' . $mail->ErrorInfo . '</p>';
                	include 'base/copyright.php';
					exit;
				} else {
                    echo 'Message Sent to '.$email.'';
                    sleep(1);
					include 'base/copyright.php';
					exit;
                }
            } else {
        ?>
        
        <table width="360" border="0">
            <form name="emailform" action="reservation.php" method="post">
            <tr>
            <td width="93">From:</td>
            <td colspan="2"><input name="From" type="text" value="<?php echo $element['EMail'];?>" readonly /> <?php echo ' --- ' . $element['FName'] . ' ' . $element['LName'];?></td>
            </tr>
            
            <tr>
            <td>To:</td>
            <td colspan="2">pukeruabay.toylib@gmail.com</td>
            </tr>
            
            <tr>
            <td>Subject:</td>
            <td colspan="2">Toy Reservation for CustomerID <?php echo $element['CustomerID'];?></td>
            </tr>
            
            <tr>
            <td>Message:</td>
            <td colspan="2"><textarea name="Message" cols="45" rows="5" placeholder="Enter the ToyID, time/day of pickup and the intended day of toy return"></textarea></td>
            </tr>
            
            <tr>
            <td></td>
            <td align="center">
                <input type="submit" name="btnSend" id="btnSend" value="Send" />
                <input type="reset" name="btnClr" id="btnClr" value="Clear" />
            </td>
            </tr>
            </form>
        </table>
        <br>
        
        <?php } ?>
        
        <strong>Intentional misuse of this form is prohibited by law. We can track your activity on this website</strong>
        
        <?php include 'base/copyright.php'; ?>
	</body>
</html>
