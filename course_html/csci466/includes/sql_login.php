<?php

//  replace with credentials
	$host = NULL;
	$user = NULL;
	$password = NULL;
	$db = NULL;

	
	$conn = new PDO("mysql:host=$host;dbname=$db",$user,$password);
	try
	{
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo 'Error: ' . $e->getMessage();
	}
?>
