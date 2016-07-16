<?php
	include("../includes/sql_login.php");

	$ID = $_POST['ID'];
	$Name = $_POST['Name'];
	$Email = $_POST['Email'];
	$Phone = $_POST['Phone'];
	$TeamID = $_POST['TeamID'];
	$Username = $_POST['Username'];
	$Team = $_POST['Team'];
	$edited = $_POST['edited'];

	$sql1 = $conn->prepare('SELECT * FROM Coach WHERE ID = :ID');
	$sql1->execute(array('ID' => $ID));
	$sql2 = "SELECT ID, Name FROM Team";
	$q2 = $conn->query($sql2) or die("ERROR: " . implode(":", $conn->errorIndo()));
	$sql3 = $conn->prepare('SELECT Users.Username FROM Users, Coach WHERE (Users.Username NOT IN (SELECT Users.Username FROM Coach, Users WHERE Coach.Username = Users.Username) AND Users.Admin = 0) OR Users.Username = :Username GROUP BY Username ASC');
	$sql3->execute(array('Username' => $Username));

	$row = $sql1->fetch(PDO::FETCH_ASSOC);

	if($edited != 'yes')
	{
		echo '<form action="./editcoach.php" method="POST">';
			echo '<center>';
			echo '<table align="center" width="500px" border="0" cellspacing="0">';
				echo '<tr>';
					echo '<td align="right">Name:</td>';
					echo '<td><input type="text" value="' . $row['Name'] . '" name="Name"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Email:</td>';
					echo '<td><input type="text" value="' . $row['Email'] . '" name="Email"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Phone:</td>';
					echo '<td><input type="text" value="' . $row['Phone'] . '" name="Phone"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Team:</td>';
					echo '<td><select name="Team">';
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
				echo '<tr>';
					echo '<td align="right">Username:</td>';
					echo '<td><select name="Username">';
						echo '<option></option>';
						while($row = $sql3->fetch(PDO::FETCH_ASSOC))
						{
							if($row['Username'] == $Username)
							{
								echo '<option selected="true">' . $row['Username'] . '</option>';
							}
							else
							{
								echo '<option>' . $row['Username'] . '</option>';
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
		$sql4 = $conn->prepare('SELECT ID FROM Team WHERE Name = :Team');
		$sql4->execute(array('Team' => $Team));
		$row = $sql4->fetch(PDO::FETCH_ASSOC);
		$TeamID = $row['ID'];

		if($TeamID == '')
		{
			$TeamID = NULL;
		}
		if($Username == '')
		{
			$Username = NULL;
		}

		if($Username == NULL)
		{
			if($TeamID == NULL)
			{
				$sql2 = $conn->prepare('UPDATE Coach SET Name = :Name, Email = :Email, Phone = :Phone, TeamID = NULL, Username = NULL WHERE ID = :ID');
				$sql2->execute(array('Name' => $Name, 'Email' => $Email, 'Phone' => $Phone, 'ID' => $ID));
				echo 'Edit Coach successful';
			}
			else
			{
				$sql2 = $conn->prepare('UPDATE Coach SET Name = :Name, Email = :Email, Phone = :Phone, TeamID = :TeamID, Username = NULL WHERE ID = :ID');
				$sql2->execute(array('Name' => $Name, 'Email' => $Email, 'Phone' => $Phone, 'TeamID' => $TeamID, 'ID' => $ID));
				echo 'Edit Coach successful';
			}
		}
		elseif($TeamID == NULL)
		{
			if($Username == NULL)
			{
				$sql2 = $conn->prepare('UPDATE Coach SET Name = :Name, Email = :Email, Phone = :Phone, TeamID = NULL, Username = NULL WHERE ID = :ID');
				$sql2->execute(array('Name' => $Name, 'Email' => $Email, 'Phone' => $Phone, 'ID' => $ID));
				echo 'Edit Coach successful';
			}
			else
			{
				$sql2 = $conn->prepare('UPDATE Coach SET Name = :Name, Email = :Email, Phone = :Phone, TeamID = NULL, Username = :Username WHERE ID = :ID');
				$sql2->execute(array('Name' => $Name, 'Email' => $Email, 'Phone' => $Phone, 'Username' => $Username, 'ID' => $ID));
				echo 'Edit Coach successful';
			}
		}
		else
		{
			$sql2 = $conn->prepare('UPDATE Coach SET Name = :Name, Email = :Email, Phone = :Phone, TeamID = :TeamID, Username = :Username WHERE ID = :ID');
			$sql2->execute(array('Name' => $Name, 'Email' => $Email, 'Phone' => $Phone, 'TeamID' => $TeamID, 'Username' => $Username, 'ID' => $ID));
			echo 'Edit Coach successful';
		}

		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}
?>
