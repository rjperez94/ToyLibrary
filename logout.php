<!DOCTYPE HTML>
<html>
	<head>
    	<!--[if lte IE 6]>
        	<meta http-equiv="refresh" content="0; URL=http://windows.microsoft.com/en-nz/windows/upgrade-your-browser">
        <![endif]-->
		<link rel="shortcut icon" href="favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Logout</title>
        <link type="text/css" href="css/styles.css" rel="stylesheet"/>
	</head>
	
	<body>
		<?php
            //Regenerate same session
            session_start();
            
            //Destroy session by user
            session_destroy(); 
            
            //Output this...
            echo '<p>Log-out successful!!!</p>';
            
            //Redirect here
            echo '<meta http-equiv="refresh" content="0; URL=/toylib/index.php">';
        ?>
    </body>
    </html>