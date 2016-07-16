<?php
//check of session is not registered then redirect back to main page
//session_start() needs to be called first
	session_start();

	include("./includes/sql_login.php");

	if(!isset($_SESSION["username"]))
	{
		header("location:login.php");
	}
	if($_SESSION["admin"] == 1)
	{
		header("location:login.php");
	}
	if($_SESSION["admin"] == 0)
	{
		header("location:login.php");
	}
?>

<html>
	<head>
		<?php $name="Referee Page"; include("./includes/menu.php"); ?>
	</head>

	<body>
		<div align="right";><a href="logout.php">Logout</a></div>

		<?php
			//retrieve and display session data just to show
			echo "<center> Welcome, ".$_SESSION["username"] . "</center><br>";
		?>

		<div id ="left">
		  <center> Utilities </center>
                        <hr>

                        <form action="referee.php" method="POST">
                                <select name="utilities">
                                        <option></option>
                                        <option> View Past Games </option>
					<option> Update Game Scores </option>
				</select>

				<input type = "submit" value="Submit">
			</form>
		</div>

		<div id="right">

			<?php
				$option = $_POST["utilities"];

				if($option == "View Past Games")
				{
					$sql = 'SELECT DATE_FORMAT(Date, "%m/%d/%y") AS Date, DATE_FORMAT(Start_time, "%l:%i %p") AS Start_time, H.Name AS HName, A.Name AS AName, Points_home, Points_away FROM Game, Team H, Team A Where H.ID = Game.Team_home AND A.ID = Game.Team_away AND Date < NOW() AND YEAR(Date) = YEAR(NOW()) Order by Date, Start_time';
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<table align="center" cellspacing="3" cellpadding="3" width="90%" border="1">';
					echo '<tr> <td align="center"> Date </td> <td align="center"> Start Time </td> <td align="center"> Home Team </td> <td align="center"> </td> <td align="center"> Away Team </td> <td align="center"> Home Score </td> <td align="center"> Away Score </td> </tr>';

					while($row=$q->fetch(PDO::FETCH_ASSOC))
					{
						echo '<tr> <td align="center"> ' . $row["Date"] . '</td> <td align="center">' . $row["Start_time"] . '</td> <td align="center">' . $row["HName"] . '</td> <td align="center"> vs ' . '</td> <td align="center">' . $row["AName"] . '</td> <td align="center">' . $row["Points_home"] . '</td> <td align="center">' . $row["Points_away"] . '</td> </tr>';
					}

					echo '</table>';
				}

				elseif($option == "Update Game Scores")
				{
					$sql = 'SELECT Name FROM Team';
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo "<center>" . $option . "</center><hr>";

					echo '<form action="./referee/selectupdategame.php" method="POST">';
						echo '<table width="100%" border="0" cellspacing="0">';
                                        	        echo '<tr>';
								echo '<td align="right"> Select Team\'s Game to edit scores: </td>';
								echo '<td><select name="Team">';
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

				else
                                {
                                        echo "Please select an option from the left and press the Submit button";
                                }


			?>
		</div>

		<?php include("./includes/footer.php"); ?>
	</body>
</html>

