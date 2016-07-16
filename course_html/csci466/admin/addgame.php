<?php
	include("../includes/sql_login.php");

	$Date = $_POST['Date'];
	$Time = $_POST['Time'];
	$Team_home = $_POST['Team_home'];
	$Team_away = $_POST['Team_away'];

	if(!($Date == NULL || $Time == NULL || $Team_home == NULL || $Team_away == NULL))
	{
		if($Team_home == $Team_away)
		{
			echo "Error: Home and Away team are the same.";
			echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
		}

		else
		{
			$teamidquery1 = $conn->prepare('SELECT ID FROM Team WHERE Team.Name = :Team_home');
			$teamidquery2 = $conn->prepare('SELECT ID FROM Team WHERE Team.Name = :Team_away');
			$teamidquery1->execute(array('Team_home' => $Team_home));
			$teamidquery2->execute(array('Team_away' => $Team_away));

			$row = $teamidquery1->fetch(PDO::FETCH_ASSOC);
			$TID_home = $row['ID'];
			$row = $teamidquery2->fetch(PDO::FETCH_ASSOC);
			$TID_away = $row['ID'];

			$insertquery = $conn->prepare('INSERT INTO Game (Team_home, Team_away, Start_time, Date, Points_home, Points_away) VALUES (:TID_home, :TID_away, :Time, :Date, 0, 0)');
			$insertquery->execute(array('TID_home' => $TID_home, 'TID_away' => $TID_away, 'Time' => $Time, 'Date' => $Date));

			echo "Add Game Successful";

			echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
		}
	}

	else
	{
		echo "Error: All fields were not filled in";
		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}
?>
