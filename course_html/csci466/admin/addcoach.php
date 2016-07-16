<?php
	include("../includes/sql_login.php");

	$Name = $_POST['Name'];
	$Email = $_POST['Email'];
	$Phone = $_POST['Phone'];
	$Team = $_POST['Team'];
	$Username = $_POST['Username'];

	if($Username == '')
	{
		$Username = NULL;
	}

	if(!($Name == NULL || $Email == NULL || $Phone == NULL || $Team == NULL || $Username == NULL))
	{
		$teamidquery = $conn->prepare('SELECT ID FROM Team WHERE Name = :Team');
		$teamidquery->execute(array('Team' => $Team));
		$row = $teamidquery->fetch(PDO::FETCH_ASSOC);
		$TeamID = $row['ID'];

		$insertquery = $conn->prepare('INSERT INTO Coach (Name, Email, Phone, TeamID, Username) VALUES (:Name, :Email, :Phone, :TeamID, :Username)');
		$insertquery->execute(array('Name' => $Name, 'Email' => $Email, 'Phone' => $Phone, 'TeamID' => $TeamID, 'Username' => $Username));

		echo "Add Coach Successful";

		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}

	else
	{
		echo "Error: All fields were not filled in";
		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}
?>
