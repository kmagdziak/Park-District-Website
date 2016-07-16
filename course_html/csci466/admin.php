<?php
//check of session is not registered then redirect back to main page
//session_start() needs to be called first
	session_start();

	include("./includes/sql_login.php");

	if(!isset($_SESSION["username"]))
	{
		header("location:login.php");
	}
	if($_SESSION["admin"] == 0) //Checks to see if the user is just a user and not an admin
	{
		header("location:login.php");
	}
	if($_SESSION["admin"] == 2) //Checks to see if the user is just a user and not an admin
	{
		header("location:login.php");
	}
?>

<html>
	<head>
		<?php $name="Administrator Page"; include("./includes/menu.php"); ?>
	</head>

	<body>
		<div align="right";><a href="logout.php">Logout</a></div>

		<?php
//retrieve and display session data just to show
			echo "<center> Welcome, ".$_SESSION["username"] . "</center><br>";
		?>

		<div id="left">
			<center> Utilities </center>
			<hr>
					<!--Drop-down list of actions that can be taken-->
			<form action="admin.php" method="POST">
				<select name="utilities">
					<option></option>
					<option> Add Player </option>
					<option> Remove Player </option>
					<option> Add User </option>
					<option> Remove User </option>
					<option> Add Team </option>
					<option> Remove Team </option>
					<option> Add Game </option>
					<option> Remove Game </option>
					<option> Add Coach </option>
					<option> Remove Coach </option>
					<option> Edit Player </option>
					<option> Edit User </option>
					<option> Edit Team </option>
					<option> Edit Game </option>
					<option> Edit Coach </option>
				</select>

				<input type="submit" value="Submit">
			</form>
		</div>
		<div id ="right">

			<?php
				$option = $_POST["utilities"];

				if($option == "Add Player")//Brings up a form to add a player if this option is selected
				{
					$sql = "SELECT Name FROM Team WHERE Year = YEAR(NOW()) ORDER BY Name ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/addplayer.php" method="POST">';
						echo '<table width="100%" border="0" cellspacing="0">';
							echo '<tr>';
								echo '<td align="right">Name:</td>';
								echo '<td><input type="text" name="Name"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Grade:</td>';
								echo '<td><input type="text" name="Grade"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Phone:</td>';
								echo '<td><input type="text" name="Phone"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Emergency Contact Name:</td>';
								echo '<td><input type="text" name="ECName"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Emergency Contact Phone:</td>';
								echo '<td><input type="text" name="ECPhone"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Team:</td>';
								echo '<td><select name="TeamName">';
									echo '<option></option>';
									while($row = $q->fetch(PDO::FETCH_ASSOC))
									{
										echo '<option>' . $row['Name'] . '</option>';
									}
								echo '</select></td>';
							echo '</tr>';
						echo '</table>';

						echo '<center>';
							echo '<input type="submit" value="Submit" name="Submit">';
							echo '<input type="reset" value="Reset">';
						echo '</center>';

					echo '</form>';
				}
				elseif($option == "Remove Player") //Brings up a form to fill out if this option is selected
				{
					$sql = "SELECT Name FROM Player GROUP BY Name ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/removeplayer.php" method="POST">';
						echo 'Remove Player ';

						echo '<select name="Name">';
							echo '<option></option>';
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option>' . $row['Name'] . '</option>';
							}
						echo '</select>';

						echo '<center>';
							echo '<input type="submit" value="Submit">';
						echo '</center>';
					echo '</form>';
				}
				elseif($option == "Add User") //Brings up a form to fill in and submit if a new player is to be added
				{
					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/adduser.php" method="POST">';
						echo '<table width="100%" border="0" cellspacing="0">';
							echo '<tr>';
								echo '<td align="right">Username:</td>';
								echo '<td><input type="text" name="Username"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Password:</td>';
								echo '<td><input type="password" name="Password"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Confirm Password:</td>';
								echo '<td><input type="password" name="ConfirmPassword"></td>';
							echo '</tr>';
						echo '</table>';

						echo '<center>';
							echo '<input type="submit" value="Submit" name="Submit">';
							echo '<input type="reset" value="Reset">';
						echo '</center>';
					echo '</form>';
				}
				elseif($option == "Remove User") //Brings up a form to submit if this option is chosen
				{
					$sql = "SELECT Username FROM Users GROUP BY Username ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/removeuser.php" method="POST">';
						echo 'Remove User ';

						echo '<select name="Username">';
							echo '<option></option>';
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option>' . $row['Username'] . '</option>';
							}
						echo '</select>';

						echo '<center>';
							echo '<input type="submit" value="Submit">';
						echo '</center>';
					echo '</form>';
				}
				elseif($option == "Add Team") //Brigns up a form to fill out and submit if this option is selected
				{
					$sql = "SELECT Name FROM Team ORDER BY Name ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/addteam.php" method="POST">';
						echo '<table width="100%" border="0" cellspacing="0">';
							echo '<tr>';
								echo '<td align="right">Name:</td>';
								echo '<td><input type="text" name="Name"></td>';
							echo '</tr>';
						echo '</table>';

						echo '<center>';
							echo '<input type="submit" value="Submit" name="Submit">';
							echo '<input type="reset" value="Reset">';
						echo '</center>';

					echo '</form>';
				}
				elseif($option == "Remove Team") //Brigns up a form to submit if this option is selected
				{
					$sql = "SELECT Name FROM Team GROUP BY Name ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/removeteam.php" method="POST">';
						echo 'Remove Team ';

						echo '<select name="Name">';
							echo '<option></option>';
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option>' . $row['Name'] . '</option>';
							}
						echo '</select>';

						echo '<center>';
							echo '<input type="submit" value="Submit">';
						echo '</center>';
					echo '</form>';
				}
				elseif($option == "Add Game") //Brings up a form if this option is selected
				{
					$sql = "SELECT Name FROM Team Group BY Name ASC";

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/addgame.php" method="POST">';
						echo '<table width="100%" border="0" cellspacing="0">';
							echo '<tr>';
								echo '<td align="right">Date(YYYY/MM/DD):</td>';
								echo '<td><input type="text" name="Date"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Time(HH:MM):</td>';
								echo '<td><input type="text" name="Time"></td>';
							echo '</tr>';

							$q1 = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

							echo '<tr>';
								echo '<td align="right">Home Team:</td>';
								echo '<td><select name="Team_home">';
									echo '<option></option>';
									while($row = $q1->fetch(PDO::FETCH_ASSOC))
									{
										echo '<option>' . $row['Name'] . '</option>';
									}
								echo '</select></td>';
							echo '</tr>';

							$q2 = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

							echo '<tr>';
								echo '<td align="right">Away Team:</td>';
								echo '<td><select name="Team_away">';
									echo '<option></option>';
									while($row = $q2->fetch(PDO::FETCH_ASSOC))
									{
										echo '<option>' . $row['Name'] . '</option>';
									}
								echo '</select></td>';
							echo '</tr>';
						echo '</table>';

						echo '<center>';
							echo '<input type="submit" value="Submit" name="Submit">';
							echo '<input type="reset" value="Reset">';
						echo '</center>';

					echo '</form>';
				}
				elseif($option == "Remove Game") //Conjures up a form to be submited if this is selected
				{
					$sql = "SELECT Date FROM Game GROUP BY Date ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/removegame.php" method="POST">';
						echo 'Select Game\'s Date: ';

						echo '<select name="Date">';
							echo '<option></option>';
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option>' . $row['Date'] . '</option>';
							}
						echo '</select>';

						echo '<center>';
							echo '<input type="submit" value="Submit">';
						echo '</center>';
					echo '</form>';

				}
				elseif($option == "Add Coach") //Summons a form to be submited if this option is selected
				{
					$sql1 = "SELECT Name FROM Team WHERE Year = YEAR(NOW()) ORDER BY Name ASC";
					$q1 = $conn->query($sql1) or die("ERROR: " . implode(":", $conn->errorIndo()));
					$sql2 = "SELECT Users.Username FROM Users, Coach WHERE Users.Username NOT IN (SELECT Users.Username FROM Coach, Users WHERE Coach.Username = Users.Username) AND Users.Admin = 0 GROUP BY Username ASC";
					$q2 = $conn->query($sql2) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/addcoach.php" method="POST">';
						echo '<table width="100%" border="0" cellspacing="0">';
							echo '<tr>';
								echo '<td align="right">Name:</td>';
								echo '<td><input type="text" name="Name"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Email:</td>';
								echo '<td><input type="text" name="Email"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Phone:</td>';
								echo '<td><input type="text" name="Phone"></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Team:</td>';
								echo '<td><select name="Team">';
									echo '<option></option>';
									while($row = $q1->fetch(PDO::FETCH_ASSOC))
									{
										echo '<option>' . $row['Name'] . '</option>';
									}
								echo '</select></td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="right">Username:</td>';
								echo '<td><select name="Username">';
									echo '<option></option>';
									while($row = $q2->fetch(PDO::FETCH_ASSOC))
									{
										echo '<option>' . $row['Username'] . '</option>';
									}
								echo '</select></td>';
							echo '</tr>';
						echo '</table>';

						echo '<center>';
							echo '<input type="submit" value="Submit" name="Submit">';
							echo '<input type="reset" value="Reset">';
						echo '</center>';

					echo '</form>';

				}
				elseif($option == "Remove Coach") //Brings up a form to fill in and submit if this option is chosen
				{
					$sql = "SELECT Name FROM Coach GROUP BY Name ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/removecoach.php" method="POST">';
						echo 'Remove Coach ';

						echo '<select name="Name">';
							echo '<option></option>';
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option>' . $row['Name'] . '</option>';
							}
						echo '</select>';

						echo '<center>';
							echo '<input type="submit" value="Submit">';
						echo '</center>';
					echo '</form>';
				}
				elseif($option == "Edit Player") //A form that lets you edit a player if this option is chosen
				{
					$sql = "SELECT Name FROM Player GROUP BY Name ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/selecteditplayer.php" method="POST">';
						echo 'Edit Player ';

						echo '<select name="Name">';
							echo '<option></option>';
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option>' . $row['Name'] . '</option>';
							}
						echo '</select>';

						echo '<center>';
							echo '<input type="submit" value="Submit">';
						echo '</center>';
					echo '</form>';
				}
				elseif($option == "Edit User") //Edits the user with information submitted in the form created here
				{
					$sql = "SELECT Username FROM Users GROUP BY Username ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/edituser.php" method="POST">';
						echo 'Edit User ';

						echo '<select name="Username">';
							echo '<option></option>';
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option>' . $row['Username'] . '</option>';
							}
						echo '</select>';

						echo '<center>';
							echo '<input type="submit" value="Submit">';
						echo '</center>';
					echo '</form>';
				}
				elseif($option == "Edit Team") //Creates a form you can use to edit a team if this is selected
				{
					$sql = "SELECT Name FROM Team WHERE Year = YEAR(NOW()) GROUP BY Name ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/selecteditteam.php" method="POST">';
						echo 'Edit Team ';

						echo '<select name="Name">';
							echo '<option></option>';
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option>' . $row['Name'] . '</option>';
							}
						echo '</select>';

						echo '<center>';
							echo '<input type="submit" value="Submit">';
						echo '</center>';
					echo '</form>';
				}
				elseif($option == "Edit Game") //Can edit a game if you wish to and submit the form
				{
					$sql = "SELECT Name FROM Team GROUP BY Name ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/selecteditgame.php" method="POST">';
						echo 'Edit Team\'s Game:';

						echo '<select name="Name">';
							echo '<option></option>';
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option>' . $row['Name'] . '</option>';
							}
						echo '</select>';

						echo '<center>';
							echo '<input type="submit" value="Submit">';
						echo '</center>';
					echo '</form>';
				}
				elseif($option == "Edit Coach") //Lets you edit the coach if you submit the form and this is selected
				{
					$sql = "SELECT Name FROM Coach GROUP BY Name ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./admin/selecteditcoach.php" method="POST">';
						echo 'Edit Coach:';

						echo '<select name="Name">';
							echo '<option></option>';
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option>' . $row['Name'] . '</option>';
							}
						echo '</select>';

						echo '<center>';
							echo '<input type="submit" value="Submit">';
						echo '</center>';
					echo '</form>';
				}
				else //If none of the above choices have been made, print out an error
				{
					echo "Please select an option from the left and press the Submit button";
				}
			?>
		</div>

		<?php include("./includes/footer.php"); ?>
	</body>
</html>

