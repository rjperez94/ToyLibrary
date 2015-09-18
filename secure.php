<!DOCTYPE HTML>
<html>
	<head>
    	<!--[if lte IE 6]>
        	<meta http-equiv="refresh" content="1; URL=/toylib/ienotice.php">
        <![endif]-->
		<link rel="shortcut icon" href="favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link type="text/css" href="css/styles.css" rel="stylesheet"/>
		<link type="text/css" href="css/menu.css" rel="stylesheet"/>        
		<title>Exclusive Area</title>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
	</head>

	<body>
    	<noscript>
        	<div id="nojava">This webpage needs JavaScript. Pukerua Bay Toy Library works best with JavaScript enabled.</div>
        </noscript>
        <?php
				include 'base/header.php';
				//If Manager/Volunteer grant access
				if (($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager')) {
					$_SESSION['Pass'] = md5 (rand());
					include 'base/menu-special.php';
					echo '<h2>Exclusive Area</h2>';
				} else {			//Disallow access
					include 'base/menu-nopersist.php';
					echo '<h2>Exclusive Area</h2>';
					echo 'You are not authorised to view this page';
				}
				
				include 'base/copyright.php';
		?>
	</body>
</html>