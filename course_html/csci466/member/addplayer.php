<?php
	session_start();

	include("../includes/sql_login.php");

	$ID = $_POST['ID'];
	$CoachUsername = $_SESSION['username'];

	$sql1 = "SELECT TeamID FROM Coach WHERE Username = '$CoachUsername'";
	$q1 = $conn->query($sql1) or die("ERROR: " . implode(":", $conn->errorIndo()));
	$row = $q1->fetch(PDO::FETCH_ASSOC);
	$TeamID = $row['TeamID'];

	$sql2 = "UPDATE Player SET TeamID = '$TeamID' WHERE ID = '$ID'";
	$conn->query($sql2) or die("ERROR: " . implode(":", $conn->errorIndo()));
	echo 'Player added successful';

	echo '<meta http-equiv="refresh" content="1; URL=../member.php">';
?>
