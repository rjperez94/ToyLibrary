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
		<title>Validate Login</title>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
	</head>

	<body>
    	<noscript>
        	<div id="nojava">This webpage needs JavaScript. Pukerua Bay Toy Library works best with JavaScript enabled.</div>
        </noscript>
            <?php
					include 'base/header.php';
               		include 'base/menu-nopersist.php';
					//Validate login...
					if (($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager')) {
						echo '<h2>Authentication Successful</h2>';
						$_SESSION['Pass'] = md5 (rand());
						echo '<a href="/toylib/secure.php?'. SID .'">Go to Exclusive Area</a>';
					} else {
						echo '<h2>Insufficient Privileges</h2>';
						echo 'You are not authorised to view this page';
					}
				include 'base/copyright.php';	
			?>
	</body>
</html>