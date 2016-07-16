<?php
	include("../includes/sql_login.php");

	$username = $_POST['Username'];
	$password = $_POST['Password'];
	$passwordconfirm = $_POST['ConfirmPassword'];

	$sql = $conn->prepare('SELECT * FROM Users WHERE Username = :username');
	$sql->execute(array('username' => $username));

	if($password !== $passwordconfirm)
	{
		echo "Password fields do not match";
		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}

	elseif($row = $sql->fetch(PDO::FETCH_ASSOC))
        {
		echo "Username already exists";
		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}


	else
	{
		echo 'Add user successful';

		$sql = $conn->prepare('INSERT INTO Users VALUES(:username, SHA1(:password), 0)');
		$sql->execute(array('username' => $username, 'password' => $password));
		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';

	}
?>
