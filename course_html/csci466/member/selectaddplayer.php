<?php
	include("../includes/sql_login.php");

	$Name = $_POST['Name'];

	$sql2 = $conn->prepare('SELECT Player.ID, Player.Name, Grade, Phone, ECName, ECPhone FROM Player WHERE Player.Name = :Name AND Player.TeamID IS NULL');
	$sql2->execute(array('Name' => $Name));

	echo '<table align="center" cellspacing="3" cellpadding="3" width="900px" border="1">';
	echo '<tr> <td align="center"> ID  </td> <td align="center"> Name </td> <td align="center"> Grade </td> <td align="center"> Phone </td> <td align="center"> Emergency Contact Name </td> <td align="center"> Emergency Contact Phone </td> <td align="center"> </td></tr>';

	while($row = $sql2->fetch(PDO::FETCH_ASSOC))
	{
		echo '<tr> <td align="center">' . $row['ID'] . '</td> <td align="center">' . $row['Name'] . '</td> <td align="center">' . $row['Grade'] . '</td> <td align="center">' . $row['Phone'] . '</td> <td align="center">' . $row['ECName'] . '</td> <td align="center">' . $row['ECPhone'] . '</td> <td align="center"> <form name="select" action="addplayer.php" method="POST"> <input name="ID" type="hidden" value="' . $row['ID'] . '"> <input name="Name" type="hidden" value="' . $row['Name'] . '"> <input type="submit" value="Select"> </form> </td> </tr>';
	}
	echo '</table>';
?>