<?php
	include("../includes/sql_login.php");

	$Name = $_POST['Name'];

	if(!($Name == NULL))
	{
		$checksql = $conn->prepare('SELECT Name FROM Team WHERE Name = :Name AND Year = YEAR(NOW())');
		$checksql->execute(array('Name' => $Name));
		$row = $checksql->fetch(PDO::FETCH_ASSOC);

		if($row['Name'] != $Name)
		{
			$insertquery = $conn->prepare('INSERT INTO Team (Name, Record, Year) VALUES (:Name, \'0-0\', YEAR(NOW()))');
			$insertquery->execute(array('Name' => $Name));

			echo "Add Team Successful";

			echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
		}
		else
		{
			echo 'Team already exists!';

			echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
		}
	}

	else
	{
		echo "Error: All fields were not filled in";
		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}
?>
