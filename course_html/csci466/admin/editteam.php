<?php
	include("../includes/sql_login.php");

	$ID = $_POST['ID'];
	$Name = $_POST['Name'];
	$Record = $_POST['Record'];
	$edited = $_POST['edited'];

	$sql1 = $conn->prepare('SELECT * FROM Team WHERE ID = :ID');
	$sql1->execute(array('ID' => $ID));
	$row = $sql1->fetch(PDO::FETCH_ASSOC);

	if($edited != 'yes')
	{
		echo '<form action="./editteam.php" method="POST">';
			echo '<center>';
			echo '<table width="500px" border="0" cellspacing="0">';
				echo '<tr>';
					echo '<td align="right">Name:</td>';
					echo '<td><input type="text" value="' . $row['Name'] . '" name="Name"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Record:</td>';
					echo '<td><input type="text" value="' . $row['Record'] . '" name="Record"></td>';
				echo '</tr>';
			echo '</table>';
			echo '</center>';

			echo '<input type="hidden" name="edited" value="yes">';
			echo '<input type="hidden" name="ID" value="' . $ID . '">';

			echo '<center>';
				echo '<input type="submit" value="Submit" name="Submit">';
				echo '<input type="reset" value="Reset">';
			echo '</center>';
		echo '</form>';
	}

	else
	{
		$sql2 = $conn->prepare('UPDATE Team SET Name = :Name, Record = :Record WHERE ID = :ID');
		$sql2->execute(array('Name' => $Name, 'Record' => $Record, 'ID' => $ID));
		echo 'Edit Team successful';

		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}
?>
