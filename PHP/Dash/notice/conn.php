<?php
	$conn = mysqli_connect("localhost", "root", "", "cinecarnival");
	$conn2 = new mysqli("localhost", "root", "", "cinecarnival");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>