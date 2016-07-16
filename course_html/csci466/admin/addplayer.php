<?php
	include("../includes/sql_login.php");

	$Name = $_POST['Name'];
	$Grade = $_POST['Grade'];
	$Phone = $_POST['Phone'];
	$ECName = $_POST['ECName'];
	$ECPhone = $_POST['ECPhone'];
	$TeamName = $_POST['TeamName'];

	if(!($Name == NULL || $Grade == NULL || $Phone == NULL || $ECName == NULL || $ECPhone == NULL))
	{
		if($TeamName == '')
		{
			$TeamName = NULL;
		}

		$teamidquery = $conn->prepare('SELECT ID FROM Team WHERE Name = :TeamName AND Year = YEAR(NOW())');
		$teamidquery->execute(array('TeamName' => $TeamName));
		$row = $teamidquery->fetch(PDO::FETCH_ASSOC);
		$TeamID = $row['ID'];

		if($TeamID != NULL)
		{
			$insertquery = $conn->prepare('INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES (:Name, :Grade, :Phone, :ECName, :ECPhone, :TeamID)');
			$insertquery->execute(array('Name' => $Name, 'Grade' => $Grade, 'Phone' => $Phone, 'ECName' => $ECName, 'ECPhone' => $ECPhone, 'TeamID' => $TeamID));
		}
		else
		{
			$insertquery = $conn->prepare('INSERT INTO Player (Name, Grade, Phone, ECName, ECPhone, TeamID) VALUES (:Name, :Grade, :Phone, :ECName, :ECPhone, NULL)');
			$insertquery->execute(array('Name' => $Name, 'Grade' => $Grade, 'Phone' => $Phone, 'ECName' => $ECName, 'ECPhone' => $ECPhone));
		}

		echo "Add Player Successful";

		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}

	else
	{
		echo "Error: All fields were not filled in";
		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}
?>
