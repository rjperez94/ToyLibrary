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
        <link type="text/css" href="css/navbar.css" rel="stylesheet"/>
		<title>Contact Us</title>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/navbar.js"></script>
        <script type="text/javascript" src="js/html5shiv.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBelHrd4LZ2_PwrIYrZItvyQSDYzNW5pII&sensor=false"></script>
        <script>		  
			var map;
			function initialize() {
			  var mapOptions = {
				zoom: 16,
				center: new google.maps.LatLng(-41.035021, 174.884786),
				panControl: true,
    			zoomControl: true,
				zoomControlOptions: {
        			style: google.maps.ZoomControlStyle.LARGE,
    			},
    			scaleControl: true,
				streetViewControl: false,
				mapTypeId: google.maps.MapTypeId.HYBRID
			  };
			  map = new google.maps.Map(document.getElementById('map_canvas'),
				  mapOptions);
			  
			  var marker = new google.maps.Marker({
				position: map.getCenter(),
				map: map,
				title: 'Rawhiti Road'
			  });

			}
			
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
	</head>

	<body>
    	<noscript>
        	<div id="nojava">This webpage needs JavaScript. Pukerua Bay Toy Library works best with JavaScript enabled.</div>
        </noscript>
            	<?php
					include 'base/header.php';
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
					echo '<li><a href="/toylib/borrow.php?'. SID .'" class="parent"><span>Borrowing</span></a>';
						echo '<div><ul>';
						//Allow only members to reserve a toy
						if (!(($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'Guest'))) {
							echo '<li><a href="/toylib/notspam.php?'. SID .'"><span>Reserve a Toy</span></a></li>';
						}
						echo '<li><a href="/toylib/toycare.php?'. SID .'"><span>Caring for Toys</span></a></li>
						</ul></div>
					</li>';
					echo '<li class="last current"><a href="/toylib/contact.php?'. SID .'"><span>Contact Us</span></a></li>';							
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
			?>
            
	<h2>Contact Us</h2>
    	<div id="loc">
            <p>
                <strong>Address:</strong><br>
                Pukerua Bay Tennis Club Rooms, Rawhiti Road, Pukerua Bay
                <br><br>
                <strong>Opening Hours:</strong><br>
                Thursday 930 - 1130am
                Saturday 930- 1130am
			</p>
            
			<div id="map_canvas"></div>
        </div>
        
    	<?php include 'base/copyright.php'; ?>
	</body>
</html>