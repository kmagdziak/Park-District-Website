<html>
	<head>
		<?php $name="Register"; include("./includes/menu.php"); ?>
	</head>

	<body>
		<center>
			<h2> Register </h2>

		<!--Creates a table to input registration info in-->

			<table width="300" border="0" align="center" cellpadding="0" cellspacing="1">
				<tr> <!--Creates a form to submit info-->
					<form action="submit_signup.php" method="POST">
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
								<tr>
									<td align="right">Confirm Password:</td>
									<td><input type="password" name="passwordconfirm"></td>
								</tr>
							</table>

							<br>

							<center> <!--Creates two buttons-->
								<input type="submit" value="Submit" name="Submit">
								<input type="reset" value="Reset">
							</center>
						</td>
					</form>
				</tr>
			</table>


			<?php
				if($exists == "1") //If the username already exists...
				{
					echo "<br>" . "Username already exists"; //Error
				}
				if($mismatch == "1") //If passwords don't match...
				{
					echo "<br>" . "Passwords do not match"; //Error
				}
			?>
		</center>

		<?php include("./includes/footer.php"); ?>
	</body>
</html>
