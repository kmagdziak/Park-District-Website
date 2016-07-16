<?php
	session_start(); //must be first statement or you'll 
	$admin = 0;
	session_destroy();//get an error
?>

<html>
	<head>
		<meta http-equiv="refresh" content="1; URL=login.php"> <!--Goes to login.php-->
	</head>

	<body> <!--Tells the user the logut was successful-->
		Logout successful!
	</body>
</html>
