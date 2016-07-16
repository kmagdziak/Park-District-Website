<html>
	<head>
		<?php $name="Teams"; include("./includes/menu.php"); ?>
	</head>

	<body>
		<div id="left">
			<center> Current Team Standings </center>
			<hr>
				<?PHP
					include("./includes/sql_login.php");

		//Creates and runs the query

					$sql = "SELECT * FROM Team Order by Record DESC, Name ASC";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

		//Createas a table to store the results (on the page)

					echo '<table align="center" cellspacing="3" cellpadding="3" width="90%" border="1">';

		//Fills the table up

					while($row=$q->fetch(PDO::FETCH_ASSOC))
					{
						echo '<tr> <td align="center"> ' . $row["Name"] . '</td> <td align="center">' . $row["Record"] . '</td> </tr>';
					}

					echo '</table>';
				?>
			</div>

		<div id="right">
			<center> Name and Team </center>
			<hr>

			<?PHP
		//Creates and runs the query

                                $sql = "SELECT Player.Name AS player_name, Team.Name AS team_name, Player.Name, Team.Name FROM Team, Player WHERE Team.ID = Player.TeamID GROUP BY Player.Name ASC";
                                $q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

		//Creates the table to store the results (on the page)

				echo '<table align="center" cellspacing="3" cellpadding="3" width="90%" border="1">';

		//Fills the table up

                                while($row=$q->fetch(PDO::FETCH_ASSOC))
                                {
					echo '<tr> <td align="center"> ' . $row["player_name"] . '</td> <td align="center">' . $row["team_name"] . '</td> </tr>';
                                }

				echo '</table>';
                        ?>
		</div>

		<?php include("./includes/footer.php"); ?>
	</body>

</html>
