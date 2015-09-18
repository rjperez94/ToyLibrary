<?php
	echo '<br><br><br><br><br><br>';
	echo '<div id="menu">';
	echo '<ul class="menu">';
	echo '<li><a href="/toylib" class="parent"><span>Home</span></a>';
		echo '<div><ul>';
			//if toyMnager or Volunteer looged in, display link to exclusive area
			if (($_SESSION['Login'] == 'ToyManager') || ($_SESSION['Login'] == 'Volunteers') || ($_SESSION['Login'] == 'DBManager')) {
				//Displays link to validation page --> exclusive area
				echo '<li><a href="/toylib/validate.php?'. SID .'"><span>Go to Exclusive Area</span></a></li>';
			}
		echo '</ul></div>
	</li>';				
	echo '<li><a href="/toylib/toystatus.php" target="_blank" class="parent"><span>Toys</span></a></li>';				
	echo '<li><a href="#" class="parent"><span>Add</span></a>
		<div><ul>
			<li><a href="/toylib/addloans.php?'. SID .'"><span>Loans</span></a></li>
			<li><a href="/toylib/addmember.php?'. SID .'" target="_blank"><span>Members</span></a></li>
		</ul></div>
	</li>';				
	echo '<li class="last"><a href="#" class="parent"><span>View OR Edit</span></a>
		<div><ul>
			<li><a href="/toylib/loaned.php?'. SID .'" class="parent"><span>Loans</span></a>
				<div><ul>
					<li><a href="/toylib/overdue.php?'. SID .'"><span>Overdue/Due</span></a></li>
				</ul></div>
			</li>
			<li><a href="/toylib/members.php?'. SID .'"><span>Members</span></a></li>
		</ul></div>
	</li>';
	echo '</ul>';
	echo '</div>';
	echo '</div><br><br>';
?>