<?php
	include("./includes/sql_login.php");

	//Creates the variables that hold the database login info

	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordconfirm = $_POST['passwordconfirm'];

	//Sets flags initially to 0 (false)

	$exists = 0;
	$mismatch = 0;

	//Creates the query and runs it

	$sql = $conn->prepare('SELECT * FROM Users WHERE Username = :username');
	$sql->execute(array('username' => $username));

	//Starts to check to see if the passwords match or not

	if($password !== $passwordconfirm) //If the passwords don't match...
	{
		$mismatch = 1;	//Sets this flag
		if($row = $sql->fetch(PDO::FETCH_ASSOC))
		{
			$exists = 1;
		}

		include("register.php");
	}

	elseif($row = $sql->fetch(PDO::FETCH_ASSOC)) //If the username already exists...
        {
		$exists = 1; //Sets this flag
		if($password !== $passwordconfirm)
		{
			$mismatch = 1;
		}

		include("register.php");
	}

	else //If it passes the tests then it inserts the new user into the table of users
	{
		$sql = $conn->prepare('INSERT INTO Users VALUES(:username, SHA1(:password), 0)');
		$sql->execute(array('username' => $username, 'password' => $password));
		header("location:login.php");
	}
?>
