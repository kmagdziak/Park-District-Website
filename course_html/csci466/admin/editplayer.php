<?php
	include("../includes/sql_login.php");

	$ID = $_POST['ID'];
	$Name = $_POST['Name'];
	$Grade = $_POST['Grade'];
	$Phone = $_POST['Phone'];
	$ECName = $_POST['ECName'];
	$ECPhone = $_POST['ECPhone'];
	$TeamID = $_POST['TeamID'];
	$TeamName = $_POST['TeamName'];
	$edited = $_POST['edited'];

	$sql1 = $conn->prepare('SELECT * FROM Player WHERE ID = :ID');
	$sql1->execute(array('ID' => $ID));
	$row = $sql1->fetch(PDO::FETCH_ASSOC);

	$sql2 = "SELECT Name, ID FROM Team GROUP BY Name ASC";
	$q2 = $conn->query($sql2) or die("ERROR: " . implode(":", $conn->errorIndo()));

	if($edited != 'yes')
	{
		echo '<form action="./editplayer.php" method="POST">';
			echo '<center>';
			echo '<table width="500px" border="0" cellspacing="0">';
				echo '<tr>';
					echo '<td align="right">Name:</td>';
					echo '<td><input type="text" value="' . $row['Name'] . '" name="Name"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Grade:</td>';
					echo '<td><input type="text" value="' . $row['Grade'] . '" name="Grade"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Phone:</td>';
					echo '<td><input type="text" value="' . $row['Phone'] . '" name="Phone"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Emergency Contact Name:</td>';
					echo '<td><input type="text" value="' . $row['ECName'] . '" name="ECName"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Emergency Contact Phone:</td>';
					echo '<td><input type="text" value="' . $row['ECPhone'] . '" name="ECPhone"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Team:</td>';
					echo '<td><select name="TeamName">';
						echo '<option></option>';
						while($row = $q2->fetch(PDO::FETCH_ASSOC))
						{
							if($row['ID'] == $TeamID)
							{
								echo '<option selected="true">' . $row['Name'] . '</option>';
							}
							else
							{
								echo '<option>' . $row['Name'] . '</option>';
							}
						}
					echo '</select></td>';
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
		$sql1 = $conn->prepare('SELECT ID FROM Team WHERE Name = :TeamName');
		$sql1->execute(array('TeamName' => $TeamName));
		$row = $sql1->fetch(PDO::FETCH_ASSOC);
		$TeamID = $row['ID'];
		$sql2 = $conn->prepare('UPDATE Player SET Name = :Name, Grade = :Grade, Phone = :Phone, ECName = :ECName, ECPhone = :ECPhone, TeamID = :TeamID WHERE ID = :ID');
		$sql2->execute(array('Name' => $Name, 'Grade' => $Grade, 'Phone' => $Phone, 'ECName' => $ECName, 'ECPhone' => $ECPhone, 'TeamID' => $TeamID, 'ID' => $ID));
		echo 'Edit Player successful';

		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}
?>
