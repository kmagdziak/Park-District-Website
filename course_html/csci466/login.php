<?php
//check of session is not registered then redirect back to main page
	session_start();

	if(isset($_SESSION["username"]))
	{
		if($_SESSION["admin"] == 2) //If an referee is logging in...
		{
			header("location:referee.php"); //Call the referee.php page
		}
		if($_SESSION["admin"] == 1) //If an admin is logging in...
		{
			header("location:admin.php"); //Call the admin.php page
		}
		if($_SESSION["admin"] == 0) //Otherwise...
		{
			header("location:member.php"); //Call the member.php page
		}
	}
?>

<html>
	<head>
		<?php $name="Login"; include("./includes/menu.php"); ?>
	</head>

	<body>
		<center>
			<h2> Login </h2>

		<!--Creates a table to login-->

			<table width="300" border="0" align="center" cellpadding="0" cellspacing="1">
				<tr>
					<form action="checklogin.php" method="POST">
		<!--Authenticates the attempted login-->
						<td>
							<table width="100%" border="0" cellspacing="0">
								<tr>
									<td align="right">Username:</td>
									<td><input type="text" name="username"></td>
								</tr>
								<tr>
									<td align="right">Password:</td>
									<td><input type="password" name="password"></td>
								</tr>
							</table>

							<br>

							<center>
								<input type="submit" value="Submit" name="Submit">
								<input type="reset" value="Reset">
							</center>
						</td>
					</form>
				</tr>
			</table>

		<!--If they use the wrong login/password they are told that they have messed up-->

			<?php
				if($invalid == "1")
				{
					echo "<br>" . "Invalid Username or Password";
				}
			?>
		</center>

		<!--Link to a registration page-->

		New User? Click <a href="./register.php">here</a> to register.

		<?php include("./includes/footer.php"); ?>
	</body>
</html>
