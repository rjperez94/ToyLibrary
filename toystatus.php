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
        <title>Toys</title>
        <script type="text/javascript" src="js/highlight.min.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/tablesort.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/navbar.js"></script>
        <script>
            $(function () {
                $('.table-sort').tablesort();
            });
        </script>
	</head>
	
	<body>
    	<noscript>
        	<div id="nojava">This webpage needs JavaScript. Pukerua Bay Toy Library works best with JavaScript enabled.</div>
        </noscript>
    	<?php
				include 'base/header.php';
				include 'base/menu-persist.php';
				echo '<h2>Toys List</h2>';
				
				//Establish a database connection
				$dbc = mysqli_connect("localhost",$_SESSION['Login'], $_SESSION['Password'],"toylib");
				
				//Exit if there is connection error
				if (mysqli_connect_error()) {
					echo mysqli_connect_error();
					include 'base/copyright.php';
					exit;
				}
				
				//Prepare the query
				$sql = "SELECT DISTINCT Toys.ToyID, Toys.Toy, Toys.Brand, Toys.Dimensions, Toys.Category, Toys.Age, Toys.Price, Toys.ArriveDate, Toys.Gender, Toys.Status, Toys.Image, MAX(Loaned.Due) 
				FROM Toys 
				LEFT JOIN Loaned 
				ON Toys.ToyID = Loaned.ToyID
				GROUP BY Toys.ToyID
				ORDER BY Toy;";
				
				//Execute the query
				$result = mysqli_query($dbc, $sql);
				
				if (!$result) {
					echo 'There is an error in your query!';
					
				} else {
					//Find out how many rows were returned
					$num_rows = mysqli_num_rows($result);
				
					//If there are no rows returned
					if ($num_rows == 0) {
						echo 'No records matched your query';
						
					} else {
						//Begin table
						echo '<table class="table-sort table-sort-search table-sort-show-search-count global">';
						//Headings					
						echo '<thead>';
						echo '<tr>';
						echo '<th class="table-sort">ToyID</th>';
						echo '<th class="table-sort">Toy</th>';
						echo '<th>Image</th>';
						echo '<th>Brand</th>';
						echo '<th>Category</th>';
						echo '<th>Age</th>';
						echo '<th>Price</th>';
						if ($_SESSION['Login'] == 'ToyManager') {
							echo '<th>Arrive Date</th>';
						}
						echo '<th>Gender</th>';
						echo '<th>Status</th>';
						echo '<th>Will be Available On</th>';
						if ($_SESSION['Login'] == 'ToyManager') {
							echo '<th>'.'Delete Toys'.'</th>';
						}
						echo '</tr>';
						echo '</thead>';
						
						echo '<tbody>';
						//While there are rows to convert
						while ($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
							//Output a row
							echo '<tr>';
							echo '<td>'.$row['ToyID'].'</td>';
							echo '<td>'.$row['Toy'].'</td>';
							echo '<td><img title="'.$row['Image'].'" alt="'.$row['Toy'].'" src="images/thumbs/'.$row['Image'].'" height="100em" width="100em"/></td>';
							echo '<td>'.$row['Brand'].'</td>';
							echo '<td>'.$row['Category'].'</td>';
							echo '<td>'.$row['Age'].'</td>';
							echo '<td>'.$row['Price'].'</td>';
							if ($_SESSION['Login'] == 'ToyManager') {
								echo '<td>'.$row['ArriveDate'].'</td>';
							}
							echo '<td>'.$row['Gender'].'</td>';
							echo '<td>'.$row['Status'].'</td>';
							
							if (!($row['Status'] == 'IN')) {
								echo '<td>'.$row['MAX(Loaned.Due)'].'</td>';
							} else {
								echo '<td>AVAILABLE</td>';
							}
							if ($_SESSION['Login'] == 'ToyManager') {
								echo '<td>'.'<a href="toydelete.php?id='.$row['ToyID'].'">Delete toy</a>'.'</td>'; //Adds link to update fields
							}
							echo '</tr>';
						}
						echo '</tbody>';
						
						//End table
						echo '</table>';
					}
				}
				mysqli_free_result($result); //free up memory
				mysqli_close($dbc); //close the connection
			?>
            
            <?php include 'base/copyright.php'; ?>
	</body>
</html>