<?php
	include("../includes/sql_login.php");

	$Name = $_POST['Name'];

	$sql = $conn->prepare('SELECT * FROM Team WHERE Name = :Name');
	$sql->execute(array('Name' => $Name));

	echo '<table align="center" cellspacing="3" cellpadding="3" width="900px" border="1">';
	echo '<tr> <td align="center"> ID  </td> <td align="center"> Name </td> <td align="center"> Record </td> <td align="center"> Year </td> <td align="center"> </td></tr>';
	while($row = $sql->fetch(PDO::FETCH_ASSOC))
	{
		echo '<tr> <td align="center">' . $row['ID'] . '</td> <td align="center">' . $row['Name'] . '</td> <td align="center">' . $row['Record'] . '</td> <td align="center">' . $row['Year'] . '</td> <td align="center"> <form name="select" action="editteam.php" method="POST"> <input name="ID" type="hidden" value="' . $row['ID'] . '"> <input type="submit" value="Select"> </form> </td> </tr>';
	}
	echo '</table>';
?>
