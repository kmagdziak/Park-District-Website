<?php
	include("../includes/sql_login.php");

	$Name = $_POST['Name'];

	$namesql = $conn->prepare('SELECT ID FROM Team WHERE Name = :Name AND Year = YEAR(NOW())');
	$namesql->execute(array('Name' => $Name));
	$row = $namesql->fetch(PDO::FETCH_ASSOC);
	$ID = $row['ID'];
	$sql = $conn->prepare('SELECT Game.ID AS GameID,  H.Name AS HName, A.Name AS AName, Start_time, Date, Points_home, Points_away FROM Game, Team H, Team A WHERE Game.Team_home = H.ID AND Game.Team_away = A.ID AND (Game.Team_home = :ID OR Game.Team_away = :ID) GROUP BY Game.ID ASC');
	$sql->execute(array('ID' => $ID));

	echo '<table align="center" cellspacing="3" cellpadding="3" width="900px" border="1">';
	echo '<tr> <td align="center"> ID </td> <td align="center"> Home Team </td> <td align="center"> Away Team </td> <td align="center"> Start Time </td> <td align="center"> Date </td> <td align="center"> Home Score </td> <td align="center"> Away Score </td> <td align="center"> </td></tr>';
	while($row = $sql->fetch(PDO::FETCH_ASSOC))
	{
		echo '<tr> <td align="center">' . $row['GameID'] . '</td> <td align="center">' . $row['HName'] . '</td> <td align="center">' . $row['AName'] . '</td> <td align="center">' . $row['Start_time'] . '</td> <td align="center">' . $row['Date'] . '</td> <td align="center">' . $row['Points_home'] . '</td> <td align="center">' . $row['Points_away'] . '</td> <td align="center"> <form name="select" action="editgame.php" method="POST"> <input name="ID" type="hidden" value="' . $row['GameID'] . '"> <input name="HName" type="hidden" value="' . $row['HName'] . '"> <input name="AName" type="hidden" value="' . $row['AName'] . '"> <input type="submit" value="Select"> </form> </td> </tr>';
	}
	echo '</table>';
?>
