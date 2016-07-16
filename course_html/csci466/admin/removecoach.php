<html>
	<body>
		<?php
			include("../includes/sql_login.php");

			$ID = $_POST['ID'];
			$Name = $_POST['Name'];

			if($ID != NULL)
			{
				$deletequery = $conn->prepare('DELETE FROM Coach WHERE ID = :ID');
				$deletequery->execute(array('ID' => $ID));
				echo 'Successfully deleted Coach ID ' . $ID . "<br>";
			}

			$sql = $conn->prepare('SELECT Coach.ID, Coach.Name, Email, Phone, Team.Name AS TName, Username FROM Coach, Team WHERE TeamID = Team.ID AND Coach.Name = :Name');
			$sql->execute(array('Name' => $Name));

			echo '<table align="center" cellspacing="3" cellpadding="3" width="900px" border="1">';
			echo '<tr> <td align="center"> ID  </td> <td align="center"> Name </td> <td align="center"> Email </td> <td align="center"> Phone </td> <td align="center"> Team Name </td> <td align="center"> Username </td> <td align="center"> </td></tr>';
			while($row = $sql->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr> <td align="center">' . $row['ID'] . '</td> <td align="center">' . $row['Name'] . '</td> <td align="center">' . $row['Email'] . '</td> <td align="center">' . $row['Phone'] . '</td> <td align="center">' . $row['TName'] . '</td> <td align="center">' . $row['Username'] . '</td> <td align="center"> <form name="delete" action="removecoach.php" method="POST"> <input name="ID" type="hidden" value="' . $row['ID'] . '"> <input name="Name" type="hidden" value="' . $row['Name'] . '"> <input type="submit" value="Delete"> </form> </td> </tr>';
			}
			echo '</table>';
		?>

		<center><a href="../admin.php"> Return to admin page </a></center>
	</body>
</html>
