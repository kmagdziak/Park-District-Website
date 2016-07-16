<html>
	<head>
		<?php $name="Games"; include("./includes/menu.php"); ?>
	</head>

	<body>

<div id="left">
		<center> Upcoming Game Schedule </center>
		<hr>

		<?PHP
			include("./includes/sql_login.php");

		//This creates the variables necessary for a SQL query for the game info

			$sql = 'SELECT DATE_FORMAT(Date, "%m/%d/%y") AS Date, DATE_FORMAT(Start_time, "%l:%i %p") AS Start_time, H.Name AS HName, A.Name AS AName FROM Game, Team H, Team A Where H.ID = Game.Team_home AND A.ID = Game.Team_away AND Date > NOW() Order by Date, Start_time;';
			$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

		//Creates a table to display the query results

			echo '<table align="center" cellspacing="3" cellpadding="3" width="90%" border="1">';

			echo '<tr> <td align="center"> Date </td> <td align="center"> Start Time </td> <td align="center"> Home Team </td> <td align="center"> </td> <td align="center"> Away Team </td> </tr>';

		//Fills the table with the query results

			while($row=$q->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr> <td align="center"> ' . $row["Date"] . '</td> <td align="center">' . $row["Start_time"] . '</td> <td align="center">' . $row["HName"] . '</td> <td align="center"> vs ' . '</td> <td align="center">' . $row["AName"] . '</td> </tr>';
			}

			echo '</table>';
		?>

		 </div>

		<div id="right">
		<center> Game Results </center>
		<hr>

			<?PHP
		//Again sets up a SQL query
				$sql = 'SELECT DATE_FORMAT(Date, "%m/%d/%y") AS Date, DATE_FORMAT(Start_time, "%l:%i %p") AS Start_time, H.Name AS HName, Points_home, A.Name AS AName, Points_away FROM Game, Team H, Team A Where H.ID = Game.Team_home AND A.ID = Game.Team_away AND Date < NOW() AND YEAR(Date) = YEAR(NOW()) Order by Date, Start_time;';
				$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

		//Makes a table for the results

				echo '<table align="center" cellspacing="3" cellpadding="3" width="90%" border="1">';

				echo '<tr> <td align="center"> Date </td> <td align="center"> Time </td> <td align="center"> Winning Team </td> <td align="center"> Losing Team </td> <td align="center"> Score </td> </tr>';

		//Fills the table with the results

				while($row=$q->fetch(PDO::FETCH_ASSOC))
				{
					echo '<tr> <td align="center"> ' . $row["Date"] . '</td> <td align="center">' . $row["Start_time"] . '</td>';
					if($row["Points_home"] > $row["Points_away"])
					{
						echo '<td align="center">' . $row["HName"] . '</td> <td align="center">' . $row["AName"] . '</td> <td align="center">' . $row["Points_home"] . " - " . $row["Points_away"] . '</td>';
					}
					elseif($row["Points_home"] < $row["Points_away"])
					{
						echo '<td align="center">' . $row["AName"] . '</td> <td align="center">' . $row["HName"] . '</td> <td align="center">' . $row["Points_away"] . " - " . $row["Points_home"] . '</td>';
					}
					else
					{
						echo '<td align="center">' . '-- Draw --' . '</td> <td align="center">' . $row["Points_away"] . " - " . $row["Points_home"] . '</td>';
					}

					echo '</tr>';

				}

				echo '</table>';
			?>
		</div>

		<?php include("./includes/footer.php"); ?>
	</body>
</html>
