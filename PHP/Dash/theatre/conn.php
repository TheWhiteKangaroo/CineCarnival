<?php
	$conn = mysqli_connect("localhost", "root", "", "cinecarnival");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>