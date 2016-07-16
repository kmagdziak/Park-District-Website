<html>
	<body>
		<?php
			include("../includes/sql_login.php");

			$ID = $_POST['ID'];
			$Name = $_POST['Name'];

			if($ID != NULL)
			{
				$deletequery = $conn->prepare('DELETE FROM Player WHERE ID = :ID');
				$deletequery->execute(array('ID' => $ID));
				echo 'Successfully deleted Player ID ' . $ID . "<br>";
			}

			$sql1 = $conn->prepare('SELECT Player.ID AS ID, Player.Name AS Name, Grade, Phone, ECName, ECPhone, Team.Name AS TeamName FROM Player, Team WHERE Player.Name = :Name AND Team.ID = Player.TeamID');
			$sql1->execute(array('Name' => $Name));
			$sql2 = $conn->prepare('SELECT Player.ID AS ID, Player.Name AS Name, Grade, Phone, ECName, ECPhone FROM Player WHERE Player.Name = :Name AND Player.TeamID IS NULL');
			$sql2->execute(array('Name' => $Name));

			echo '<table align="center" cellspacing="3" cellpadding="3" width="900px" border="1">';
			echo '<tr> <td align="center"> ID </td> <td align="center"> Name </td> <td align="center"> Grade </td> <td align="center"> Phone </td> <td align="center"> Emergency Contact Name </td> <td align="center"> Emergency Contact Phone </td> <td align="center"> Team Name </td> <td align="center"> </td></tr>';

			while($row = $sql1->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr> <td align="center">' . $row['ID'] . '</td> <td align="center">' . $row['Name'] . '</td> <td align="center">' . $row['Grade'] . '</td> <td align="center">' . $row['Phone'] . '</td> <td align="center">' . $row['ECName'] . '</td> <td align="center">' . $row['ECPhone'] . '</td> <td align="center">' . $row['TeamName'] . '</td> <td align="center"> <form name="delete" action="removeplayer.php" method="POST"> <input name="ID" type="hidden" value="' . $row['ID'] . '"> <input name="Name" type="hidden" value="' . $row['Name'] . '"> <input type="submit" value="Delete"> </form> </td> </tr>';
			}
			while($row = $sql2->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr> <td align="center">' . $row['ID'] . '</td> <td align="center">' . $row['Name'] . '</td> <td align="center">' . $row['Grade'] . '</td> <td align="center">' . $row['Phone'] . '</td> <td align="center">' . $row['ECName'] . '</td> <td align="center">' . $row['ECPhone'] . '</td> <td align="center"> </td> <td align="center"> <form name="delete" action="removeplayer.php" method="POST"> <input name="ID" type="hidden" value="' . $row['ID'] . '"> <input name="Name" type="hidden" value="' . $row['Name'] . '"> <input type="submit" value="Delete"> </form> </td> </tr>';
			}
			echo '</table>';
		?>

		<center><a href="../admin.php"> Return to admin page </a></center>
	</body>
</html>
