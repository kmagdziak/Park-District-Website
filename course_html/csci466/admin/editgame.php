<?php
	include("../includes/sql_login.php");

	$ID = $_POST['ID'];
	$HName = $_POST['HName'];
	$AName = $_POST['AName'];
	$Start_time = $_POST['Start_time'];
	$Date = $_POST['Date'];
	$Points_home = $_POST['Points_home'];
	$Points_away = $_POST['Points_away'];
	$edited = $_POST['edited'];

	$sql1 = $conn->prepare('SELECT * FROM Game WHERE ID = :ID');
	$sql1->execute(array('ID' => $ID));
	$row = $sql1->fetch(PDO::FETCH_ASSOC);
	$sql4 = "SELECT Name FROM Team";
	$q4 = $conn->query($sql4) or die("ERROR: " . implode(":", $conn->errorIndo()));
	$q5 = $conn->query($sql4) or die("ERROR: " . implode(":", $conn->errorIndo()));

	if($edited != 'yes')
	{
		echo '<form action="./editgame.php" method="POST">';
			echo '<center>';
			echo '<table width="500px" border="0" cellspacing="0">';
				echo '<tr>';
					echo '<td align="right">Home Team:</td>';
					echo '<td><select name="HName">';
						while($row1 = $q4->fetch(PDO::FETCH_ASSOC))
						{
							if($row1['Name'] == $HName)
							{
								echo '<option selected="true">' . $row1['Name'] . '</option>';
							}
							else
							{
								echo '<option>' . $row1['Name'] . '</option>';
							}
						}
					echo '</select></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Away Team:</td>';
					echo '<td><select name="AName">';
						while($row2 = $q5->fetch(PDO::FETCH_ASSOC))
						{
							if($row2['Name'] == $AName)
							{
								echo '<option selected="true">' . $row2['Name'] . '</option>';
							}
							else
							{
								echo '<option>' . $row2['Name'] . '</option>';
							}
						}
					echo '</select></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Start Time:</td>';
					echo '<td><input type="text" value="' . $row['Start_time'] . '" name="Start_time"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Date:</td>';
					echo '<td><input type="text" value="' . $row['Date'] . '" name="Date"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Home Score:</td>';
					echo '<td><input type="text" value="' . $row['Points_home'] . '" name="Points_home"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right">Away Score:</td>';
					echo '<td><input type="text" value="' . $row['Points_away'] . '" name="Points_away"</td>';
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
		$sql1 = $conn->prepare('SELECT ID FROM Team WHERE Name = :HName');
		$sql1->execute(array('HName' => $HName));
		$row1 = $sql1->fetch(PDO::FETCH_ASSOC);
		$Team_home = $row1['ID'];
		$sql2 = $conn->prepare('SELECT ID FROM Team WHERE Name = :AName');
		$sql2->execute(array('AName' => $AName));
		$row2 = $sql2->fetch(PDO::FETCH_ASSOC);
		$Team_away = $row2['ID'];

		$sql2 = $conn->prepare('UPDATE Game SET Team_home = :Team_home, Team_away = :Team_away, Start_time = :Start_time, Date = :Date, Points_home = :Points_home, Points_away = :Points_away WHERE ID = :ID');
		$sql2->execute(array('Team_home' => $Team_home, 'Team_away' => $Team_away, 'Start_time' => $Start_time, 'Date' => $Date, 'Points_home' => $Points_home, 'Points_away' => $Points_away, 'ID' => $ID));
		echo 'Edit Game successful';

		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}
?>
