<html>
	<body>
		<?php
			include("../includes/sql_login.php");

			$ID = $_POST['ID'];
			$Date = $_POST['Date'];

			if($ID != NULL)
			{
				$deletequery = $conn->prepare('DELETE FROM Game WHERE ID = :ID');
				$deletequery->execute(array('ID' => $ID));
				echo 'Successfully deleted Game ID ' . $ID . "<br>";
			}

			$sql = $conn->prepare('SELECT Game.ID AS ID, H.Name AS HName, A.NAME AS AName, Start_time, Date, Points_home, Points_away FROM Game, Team H, Team A WHERE H.ID = Team_home AND  A.ID = Team_away AND Date = :Date');
			$sql->execute(array('Date' => $Date));

			echo '<table align="center" cellspacing="3" cellpadding="3" width="900px" border="1">';
			echo '<tr> <td align="center"> ID </td> <td align="center"> Date </td> <td align="center"> Time </td> <td align="center"> Home Team </td> <td align="center"> Away Team </td> <td align="center"> Home Points </td> <td align="center"> Away Points </td> <td align="center"> </td></tr>';
			while($row = $sql->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr> <td align="center">' . $row['ID'] . '</td> <td align="center">' . $row['Date'] . '</td> <td align="center">' . $row['Start_time'] . '</td> <td align="center">' . $row['HName'] . '</td> <td align="center">' . $row['AName'] . '</td> <td align="center">' . $row['Points_home'] . '</td> <td align="center">' . $row['Points_away'] . '</td> <td align="center"> <form name="delete" action="removegame.php" method="POST"> <input name="ID" type="hidden" value="' . $row['ID'] . '"> <input name="Date" type="hidden" value="' . $row['Date'] . '"> <input type="submit" value="Delete"> </form> </td> </tr>';
			}
			echo '</table>';
		?>

		<center><a href="../admin.php"> Return to admin page </a></center>
	</body>
</html>
