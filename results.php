<!DOCTYPE HTML>
<html>
	<head>
    	<!--[if lte IE 6]>
        	<meta http-equiv="refresh" content="0; URL=http://windows.microsoft.com/en-nz/windows/upgrade-your-browser">
        <![endif]-->
		<link rel="shortcut icon" href="favicon.ico"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link type="text/css" href="css/styles.css" rel="stylesheet"/>
        <link type="text/css" href="css/menu.css" rel="stylesheet"/>
        <link type="text/css" href="css/navbar.css" rel="stylesheet"/>
		<title>Search Results</title>
        <script type="text/javascript" src="js/highlight.min.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/tablesort.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/navbar.js"></script>
        <script type="text/javascript" src="js/html5shiv.js"></script>
        <script>
            // For Demo Purposes
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
			echo '<h2>Search Results</h2>';
		
		/*username and password details*/
		$dbc = mysqli_connect('localhost', $_SESSION['Login'], $_SESSION['Password'], 'toylib');
		
		/* checks to see if any data has been posted to the search page via the post method*/
		if (!$_GET['search']) {
			/* Displays error message if true*/
			echo 'Please enter a search query';
			include 'base/copyright.php';
			exit;
					
		} else {
			/*if false the variable is set for later use*/
			$search= mysqli_real_escape_string($dbc, $_GET['search']);
		}
		
		/*if the connection is unsuccessful the error message will be displayed*/
		if(!$dbc) {
			echo 'PHP could not connect to the database server';
			include 'base/copyright.php';
			exit;
		}
		
		/*running a query*/
		$sql="SELECT DISTINCT Toys.ToyID, Toys.Toy, Toys.Brand, Toys.Dimensions, Toys.Category, Toys.Age, Toys.Price, Toys.ArriveDate, Toys.Gender, Toys.Status, Toys.Image, MAX(Loaned.Due)
		FROM Toys
		LEFT JOIN Loaned 
		ON Toys.ToyID = Loaned.ToyID
		WHERE (Toys.ToyID LIKE'%".$search."%' OR Toys.Toy LIKE'%".$search."%' OR Toys.Category LIKE '%".$search."%' OR Toys.Brand LIKE'%".$search."%' OR Toys.Status LIKE'%".$search."%')
		GROUP BY Toys.ToyID
		ORDER BY Toy;";
		   
		$result=mysqli_query($dbc, $sql);
		
		$num_rows=mysqli_num_rows($result);
		
		/*checking for records, if no records found, error displayed and then exit the script*/
		if ($num_rows ==0) {
			echo 'No results were found';
			include 'base/copyright.php';
			exit;
		}
	?>    	
        <!-- results page
        Also includes a while loop
        While a row of data exists in the recordset $sql
        put that row into the variable $row as an associative array-->
			<?php
				//Begin table
				echo '<table class="table-sort global">';
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
				echo '<th>Gender</th>';
				echo '<th>Status</th>';
				echo '<th>Will be Available On</th>';
                echo '</tr>';
				echo '</thead>';
				
				echo '<tbody>';
				//While there are rows to convert
        		while ($row = mysqli_fetch_assoc($result)) {
					//Output a row
					echo '<tr>';
					echo '<td>'.$row['ToyID'].'</td>';
					echo '<td>'.$row['Toy'].'</td>';
					echo '<td><img title="'.$row['Image'].'" alt="'.$row['Toy'].'" src="images/thumbs/'.$row['Image'].'" height="100em" width="100em"/></td>';
					echo '<td>'.$row['Brand'].'</td>';
					echo '<td>'.$row['Category'].'</td>';
					echo '<td>'.$row['Age'].'</td>';
					echo '<td>'.$row['Price'].'</td>';
					echo '<td>'.$row['Gender'].'</td>';
					echo '<td>'.$row['Status'].'</td>';
					if (!($row['Status'] == 'IN')) {
						echo '<td>'.$row['MAX(Loaned.Due)'].'</td>';
					} else {
						echo '<td>AVAILABLE</td>';
					}
                	echo '</tr>';
 				}
				echo '</tbody>';
				
				//End table
        		echo '</table>';
        	?>
		
        <?php include 'base/copyright.php'; ?>
	</body>
</html>

<?php		
	mysqli_free_result($result); //free up memory
	mysqli_close($dbc); //close the connection
?>