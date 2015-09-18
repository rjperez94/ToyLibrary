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
        <title>Login</title>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
	</head>
	
	<body>
    	<noscript>
        	<div id="nojava">This webpage needs JavaScript. Pukerua Bay Toy Library works best with JavaScript enabled.</div>
        </noscript>
        <header>
        	<br>
        	<section id = "login">
            <div class="buttonwrapper">
                <a href="/toylib/login.php" class="squarebutton blue"><span>Login</span></a>
                <br><br>
                <a href="/toylib/addmember.php" class="squarebutton orange"><span>Sign-up for Membership</span></a>
            </div>
            </section>
        	<img alt="toylibrary logo" id="toylib" src="images/PlayIsTheWay_logo.gif" title="Pukerua Bay Toy Library">
			<h1>Pukerua Bay Toy Library</h1>
    	</header>
			
        <br><br><br><br><br><br>
					<div id="menu">
						<ul class="menu">
						
							<li><a href="/toylib" class="parent"><span>Home</span></a></li>
							
							<li><a href="/toylib/about.php?" class="parent"><span>About Us</span></a></li>
							
							<li><a href="/toylib/toystatus.php?" class="parent"><span>Toys</span></a>
								<div><ul>
									<li><a href="/toylib/category.php?"><span>Toy Categories</span></a></li>
								</ul></div>
							</li>
							
							<li><a href="/toylib/membership.php?" class="parent"><span>Membership</span></a></li>
							
							<li><a href="/toylib/borrow.php?" class="parent"><span>Borrowing</span></a>
                            	<div><ul>
									<li><a href="/toylib/toycare.php?"><span>Caring for Toys</span></a></li>
								</ul></div>
                            </li>
							
							<li><a href="/toylib/contact.php?"><span>Contact Us</span></a></li>
						</ul>
						
						<div id="search">
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
						</div>
					</div> <br><br>
		
        <h2>Log In with Your Pukerua Toy Library Username</h2>
			
        <?php
			if(!empty($_POST)) {
				//Connect to toylib db
				$dbc = mysqli_connect('localhost',$_POST['username'],$_POST['password'], 'toylib');
									
				//Was the connection successfull. If not, dbc will be false
				if (!$dbc) {
					//Output the error from MySQL
					echo 'This is not a valid login'. mysqli_connect_error();
				
				} else {		//Connection successfull
					
					//Start a user session
					session_id($_POST['username']);
					session_start();
					$_SESSION['Login'] = mysqli_real_escape_string($dbc, $_POST['username']);
					$_SESSION['Password'] = mysqli_real_escape_string ($dbc, $_POST['password']);
					
					
					//Tell user that login is success
					echo '<p>Login Successful</p>';
					
					echo '<p>You are logged in as: '.$_SESSION['Login'].'</p>';
					echo '<br>';
					
					//Redirect here
					echo '<meta http-equiv="refresh" content="1; URL=/toylib/index.php">';
				}
			}
		?>
        
        <form method='post' action='login.php'>
        	<p>
            	<label for="username">Username</label>
                <input type="text" name="username"/>
            </p>
            
            <p>
            	<label for="password">Password</label>
                <input type="password" name="password"/>
            </p>
            
            <input type="submit" name="login" value="Login"/>
        </form>	
        
        <?php include 'base/copyright.php'; ?>
	</body>
</html>