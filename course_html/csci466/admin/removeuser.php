<html>
	<body>
		<?php
			include("../includes/sql_login.php");

			$Username = $_POST['Username'];
			$Admin = $_POST['Admin'];

			if($Admin != NULL)
			{
				$deletequery = $conn->prepare('DELETE FROM Users WHERE Username = :Username');
				$deletequery->execute(array('Username' => $Username));
				echo 'Successfully deleted User ' . $Username . "<br>";
			}

			$sql = $conn->prepare('SELECT * FROM Users WHERE Username = :Username');
			$sql->execute(array('Username' => $Username));

			echo '<table align="center" cellspacing="3" cellpadding="3" width="900px" border="1">';
			echo '<tr> <td align="center"> Username  </td> <td align="center"> Admin </td> <td align="center"></td> </tr>';
			while($row = $sql->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr> <td align="center">' . $row['Username'] . '</td> <td align="center">' . $row['Admin'] . '</td> <td align="center"> <form name="delete" action="removeuser.php" method="POST"> <input name="Username" type="hidden" value="' . $row['Username'] . '"> <input name="Admin" type="hidden" value="' . $row['Admin'] . '"> <input type="submit" value="Delete"> </form> </td> </tr>';
			}
			echo '</table>';
		?>

		<center><a href="../admin.php"> Return to admin page </a></center>
	</body>
</html>
