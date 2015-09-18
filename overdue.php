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
        <link type="text/css" href="css/navbar.css" rel="stylesheet"/>
        <title>Due/Overdue Loans</title>
		<script type="text/javascript" src="js/highlight.min.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/tablesort.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/navbar.js"></script>
        <script>
            // For Demo Purposes
            $(function () {
                $('.table-sort').tablesort();
            });
        </script>
	</head>
	
	<body>
			<?php
				include 'base/header.php';
				if (!(($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager'))) {
						include 'base/menu-nopersist.php';
						echo '<h2>Exclusive Area</h2>';
						echo 'You are not authorised to view this page';
						include 'base/copyright.php';
						exit;
				}

				echo '<br><br><br><br><br><br>';
				echo '<div id="floatingbar">';
				echo '<div id="menu">';
				echo '<ul class="menu">';
				echo'<li><a href="/toylib" class="parent"><span>Home</span></a>
					<div><ul>
						<li><a href="/toylib/validate.php?'. SID .'"><span>Go to Exclusive Area</span></a></li>
					</ul></div>
				</li>';
				echo '<li><a href="/toylib/toystatus.php" class="parent" target="_blank"><span>Toys</span></a></li>';
				echo '<li><a href="#" class="parent"><span>Add</span></a>
					<div><ul>
						<li><a href="/toylib/addloans.php?'. SID .'"><span>Loans</span></a></li>
						<li><a href="/toylib/addmember.php?'. SID .'" target="_blank"><span>Members</span></a></li>
					</ul></div>
				</li>';
				echo '<li class="current"><a href="#" class="parent"><span>View OR Edit</span></a>
					<div><ul>
						<li><a href="/toylib/loaned.php?'. SID .'" class="parent"><span>Loans</span></a>
							<div><ul>
								<li><a href="/toylib/overdue.php?'. SID .'"><span>Overdue/Due</span></a></li>
							</ul></div>
							</li>
						<li><a href="/toylib/members.php?'. SID .'"><span>Members</span></a></li>
					</ul></div>
				</li>';
				echo'</ul>';
				echo'</div>';
				echo'</div><br><br>';
				echo '<h2>Due/Overdue Loans</h2>';
				
				//Establish a database connection
				$dbc = mysqli_connect("localhost",$_SESSION['Login'], $_SESSION['Password'],"toylib");
				
				//Exit if there is connection error
				if (mysqli_connect_error()) {
					echo mysqli_connect_error();
					include 'base/copyright.php';
					exit;
				}
				
				//Prepare the query
				$sql = "SELECT Loaned.LoanID, Toys.ToyID, Toys.Toy, Toys.Image, Members.FName, Members.LName, Members.Email, Members.Telephone, Members.Mobile, Loaned.Due , Loaned.ReturnDay, Toys.Status FROM Toys,Loaned,Members WHERE Loaned.Due <= CURRENT_DATE() AND Toys.ToyID = Loaned.ToyID AND Members.CustomerID = Loaned.CustomerID AND (Toys.Status = 'OUT' OR Toys.Status = 'OVERDUE');";
				
				//Execute the query
				$result = mysqli_query($dbc, $sql);
				
				if (!$result) {
					echo 'There is an error in your query!';
					
				} else {
					//Find out how many rows were returned
					$num_rows = mysqli_num_rows($result);
				
				//If there are no rows returned
				if ($num_rows == 0) {
					echo 'There are no due/overdue loans.';
					
				} else {
					//Begin table
					echo '<table class="table-sort table-sort-search table-sort-show-search-count global">';
					//Headings
					echo '<thead>';
					echo '<tr>';
					echo '<th class="table-sort">Loan ID</th>';
					echo '<th>Toy ID</th>';
					echo '<th>Toy</th>';
					echo '<th>Image</th>';
					echo '<th>Name</th>';
					echo '<th>Email</th>';
					echo '<th>Telephone</th>';
					echo '<th>Mobile</th>';
					echo '<th>Due</th>';
					echo '<th>Status</th>';
					echo '<th>Update</th>';
					echo '</tr>';
					echo '</thead>';
					
					echo '<tbody>';
					//While there are rows to convert
					while ($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
						//Output a row
						echo '<tr>';
						echo '<td>'.$row['LoanID'].'</td>';
						echo '<td>'.$row['ToyID'].'</td>';
						echo '<td>'.$row['Toy'].'</td>';
						echo '<td><img title="'.$row['Image'].'"alt="'.$row['Toy'].'" src="images/thumbs/'.$row['Image'].'" height="100em" width="100em"/></td>';
						echo '<td>'.$row['FName'].' '.$row['LName'].'</td>';
						echo '<td>'.$row['Email'].'</td>';
						echo '<td>'.$row['Telephone'].'</td>';
						echo '<td>'.$row['Mobile'].'</td>';
						echo '<td>'.$row['Due'].'</td>';
						echo '<td>'.$row['Status'].'</td>';
						echo '<td>'.'<a href="inchange.php?id='.$row['LoanID'].'&'.'id2='.$row['ToyID'].'">Set Loan Status to IN</a>'.'<br>'.'<a href="overchange.php?id='.$row['LoanID'].'">Set Loan Status to OVERDUE</a>'.'</td>'; //Adds link to update fields
						echo '</tr>';
					}
					echo '</tbody>';
					
					//End table
					echo '</table>';
				}
			}
			?>
            <br>
            
            <?php include 'base/copyright.php'; ?>
	</body>
</html>