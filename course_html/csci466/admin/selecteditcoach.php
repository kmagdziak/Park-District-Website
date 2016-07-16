<?php
	include("../includes/sql_login.php");

	$Name = $_POST['Name'];

	$sql2 = $conn->prepare('SELECT TeamID FROM Coach WHERE Name = :Name');
	$sql2->execute(array('Name' => $Name));
	$row = $sql2->fetch(PDO::FETCH_ASSOC);

	if($row['TeamID'] != NULL)
	{
		$sql1 = $conn->prepare('SELECT Coach.*, Team.Name AS TName FROM Coach, Team WHERE Team.ID = Coach.TeamID AND Coach.Name = :Name');
		$sql1->execute(array('Name' => $Name));
	}
	else
	{
		$sql1 = $conn->prepare('SELECT * FROM Coach WHERE Coach.Name = :Name');
		$sql1->execute(array('Name' => $Name));
	}

	echo '<table align="center" cellspacing="3" cellpadding="3" width="900px" border="1">';
	echo '<tr> <td align="center"> ID  </td> <td align="center"> Name </td> <td align="center"> Email </td> <td align="center"> Phone </td> <td align="center"> Team Name </td> <td align="center"> Username </td> <td align="center"> </td></tr>';
	while($row = $sql1->fetch(PDO::FETCH_ASSOC))
	{
		echo '<tr> <td align="center">' . $row['ID'] . '</td> <td align="center">' . $row['Name'] . '</td> <td align="center">' . $row['Email'] . '</td> <td align="center">' . $row['Phone'] . '</td> <td align="center">' . $row['TName'] . '</td> <td align="center">' . $row['Username'] . '</td> <td align="center"> <form name="select" action="editcoach.php" method="POST"> <input name="TeamID" type="hidden" value="' . $row['TeamID'] . '"> <input name="ID" type="hidden" value="' . $row['ID'] . '"> <input name="Username" type="hidden" value="' . $row['Username'] . '"> <input type="submit" value="Select"> </form> </td> </tr>';
	}
	echo '</table>';
?>
