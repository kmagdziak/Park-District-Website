<?php
//check of session is not registered then redirect back to main page
//session_start() needs to be called first
	session_start();

	include("./includes/sql_login.php");

	if(!isset($_SESSION["username"]))
	{
		header("location:login.php");
	}
	if($_SESSION["admin"] == 1)
	{
		header("location:login.php");
	}
	if($_SESSION["admin"] == 2)
	{
		header("location:login.php");
	}
?>

<html>
	<head>
		<?php $name="Member Page"; include("./includes/menu.php"); ?>
	</head>

	<body>
		<div align="right";><a href="logout.php">Logout</a></div>

		<?php
			//retrieve and display session data just to show
			echo "<center> Welcome, ".$_SESSION["username"] . "</center><br>";
		?>

		<div id ="left">
		  <center> Utilities </center>
                        <hr>

                        <form action="member.php" method="POST">
                                <select name="utilities">
                                        <option></option>
					<option> View Team Roster </option>
                                        <option> Add New Player </option>
                                        <option> View Schedule </option>
				</select>

				<input type = "submit" value="Submit">
			</form>
		</div>

		<div id="right">
		
			<?php
				$option = $_POST["utilities"];

				if($option == "View Team Roster")
				{
					echo '<center> Team Roster </center> ';
                                        echo '<hr>';

					$userName = $_SESSION["username"];

					$sql = "Select Player.Name, Player.Grade, Player.Phone From Player, Coach Where Player.TeamID = Coach.TeamID and Coach.Username = '$userName' ";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo '<table align="center" cellspacing="1" cellpadding="1" width="80%" border="1">';
					echo '<tr> <td align="center"> Player </td> <td align="center"> Grade </td> <td align="center"> Phone </td></tr>';

					while($row = $q->fetch(PDO::FETCH_ASSOC))
					{
						echo '<tr><td align="center">'.$row["Name"].'</td><td align="center">'.$row["Grade"].'</td><td align="center">'.$row["Phone"].'</td></tr>';
					}
					echo '</table>';
				}

				elseif($option == "Add New Player")
				{
					echo '<center> Add New Player  </center>';
					echo '<hr>';

					$sql1  = "Select Name From Player Where TeamID IS NULL";
					$q1    = $conn->query($sql1) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo '<form action="./member/selectaddplayer.php" method="POST">';
					echo '<select name="Name">';
					while($row = $q1->fetch(PDO::FETCH_ASSOC))
					{
                                       		echo '<option>'.$row["Name"].'</option>';
					}
					echo '</select>';

					echo '<input type = "submit" value="Submit">';
				}

				elseif($option == "View Schedule")
				{

					echo '<center> Game Schedule </center> ';
					echo '<hr>';

					$userName = $_SESSION["username"];

					$sql = "Select Date, Start_time From Game, Coach Where (Team_home = Coach.TeamID Or Team_away = Coach.TeamID) and Coach.Username = '$userName' ";
					$q = $conn->query($sql) or die("ERROR: " . implode(":", $conn->errorIndo()));

					echo '<table align="center" cellspacing="1" cellpadding="1" width="80%" border="1">';
					echo '<tr><td align="center"> Date </td> <td align="center"> Start Time </td></tr>';

					while($row = $q->fetch(PDO::FETCH_ASSOC))
					{
						echo '<tr><td align="center"> '. $row["Date"]. '</td><td align="center"> '. $row["Start_time"] . '</td></tr>';
					}
					echo '</table>';
				}

				else
                                {
                                        echo "Please select an option from the left and press the Submit button";
                                }
			?>
		</div>

		<?php include("./includes/footer.php"); ?>
	</body>
</html>

