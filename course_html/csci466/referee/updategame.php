<?php
	include("../includes/sql_login.php");

	$ID = $_POST['ID'];
	$Points_home = $_POST['Points_home'];
	$Points_away = $_POST['Points_away'];
	$edited = $_POST['edited'];

	$sql1 = $conn->prepare('SELECT Game.ID AS ID, H.Name AS HName, A.Name AS AName, Start_time, Date, Points_home, Points_away FROM Game, Team H, Team A WHERE Game.ID = :ID AND H.ID = Team_home AND A.ID = Team_away');
	$sql1->execute(array('ID' => $ID));

	if($edited != 'yes')
	{
		echo '<table align="center" cellspacing="3" cellpadding="3" width="900px" border="1">';
			echo '<tr> <td align="center"> ID </td> <td align="center"> Home Team </td> <td align="center"> Away Team </td> <td align="center"> Start Time  </td> <td align="center"> Date </td> <td align="center"> Home Score </td> <td align="center"> Away Score </td> <td align="center"> </td></tr>';
			$row = $sql1->fetch(PDO::FETCH_ASSOC);
			echo '<tr> <td align="center">' . $row['ID'] . '</td> <td align="center">' . $row['HName'] . '</td> <td align="center">' . $row['AName'] . '</td> <td align="center">' . $row['Start_time'] . '</td> <td align="center">' . $row['Date'] . '</td> <form name="select" action="updategame.php" method="POST"> <input name="ID" type="hidden" value="' . $row['ID'] . '"> <td align="center"> <input type="text" value="' . $row['Points_home'] . '" name="Points_home"> </td> <td align="center"> <input type="text" value="' . $row['Points_away'] . '" name="Points_away"> </td> <td align="center"> <input name="ID" type="hidden" value="' . $row['ID'] . '"> <input name="edited" type="hidden" value="yes"> <input type="submit" value="Update"> </form> </td> </tr>';
		echo '</table>';
	}

	else
	{
		$sql2 = $conn->prepare('UPDATE Game SET Points_home = :Points_home, Points_away = :Points_away WHERE ID = :ID');
		$sql2->execute(array('Points_home' => $Points_home, 'Points_away' => $Points_away, 'ID' => $ID));
		echo 'Edit Game successful';

		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}
?>