<?php
	include("../includes/sql_login.php");

	$Username = $_POST['Username'];
	$OldUsername = $_POST['Username'];
	$Admin = $_POST['Admin'];
	$edited = $_POST['edited'];
	$password = $_POST['Password'];
	$confirmpassword = $_POST['ConfirmPassword'];

	$sql = $conn->prepare('SELECT * FROM Users WHERE Username = :Username');
	$sql->execute(array('Username' => $Username));
	$row = $sql->fetch(PDO::FETCH_ASSOC);

	if($edited != 'yes' || $password != $confirmpassword)
	{
		if($password != $confirmpassword)
		{
			echo "Passwords do not match!<br>";
		}

		echo '<form action="./edituser.php" method="POST">';
			echo '<center>';
			echo '<table width="500px" border="0" cellspacing="0">';
				echo '<tr>';
					echo '<td align="right"> Username: </td>';
					echo '<td><input type="text" value="' . $row['Username'] . '" name="Username"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right"> Password: </td>';
					echo '<td><input type="password" name="Password"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right"> Confirm Password: </td>';
					echo '<td><input type="password" name="ConfirmPassword"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td align="right"> User Type: </td>';
					echo '<td><select name="Admin">';
						echo '<option selected="true"> Coach </option>';
						echo '<option> Admin </option>';
						echo '<option> Referee </option>';
					echo '</select></td>';
					echo '</tr>';
			echo '</table>';
			echo '</center>';

			echo '<input type="hidden" name="edited" value="yes">';
			echo '<input type="hidden" name="OldUsername" value="' . $OldUsername . '">';

			echo '<center>';
				echo '<input type="submit" value="Submit" name="Submit">';
				echo '<input type="reset" value="Reset">';
			echo '</center>';
		echo '</form>';
	}

	else
	{
		if($Admin == "Coach")
		{
			$Admin = 0;
		}
		if($Admin == "Admin")
		{
			$Admin = 1;
		}
		if($Admin == "Referee")
		{
			$Admin = 2;
		}

		$sql = $conn->prepare('UPDATE Users SET Username = :Username, Password = SHA1(:Password), Admin = :Admin WHERE Username = :OldUsername');
		$sql->execute(array('Username' => $Username, 'Password' => $Password, 'Admin' => $Admin, 'OldUsername' => $OldUsername));
		echo 'Edit User successful';

		echo '<meta http-equiv="refresh" content="1; URL=../admin.php">';
	}
?>
