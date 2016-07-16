<?php
	session_start(); //this must be the first line

	include ("./includes/sql_login.php");

	//username and password sent from the form
	$username = $_POST['username'];
	$password = $_POST['password'];

	//Creates the query

	$sql = $conn->prepare('SELECT * FROM Users WHERE Username = :username AND Password = SHA1(:password)');
	$sql->execute(array('username' => $username, 'password' => $password));

	if($row = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$_SESSION["username"] = $username; //username session variable
		$_SESSION["admin"] = $row["Admin"];

		if($_SESSION["admin"] == 2) //If the session will be run by a referee
		{
			header("location:referee.php"); //Call referee.php
		}

		elseif($_SESSION["admin"] == 1) //If the session will be run by an admin
		{
			header("location:admin.php"); //Call admin.php
		}

		else //Otherwise call the member.php
		{
			header("location:member.php");//sends a raw http
		}
	}

	else //If something fails then you redirect back to the login.php
	{
		$invalid = 1;
		include("login.php");
	}
?>
