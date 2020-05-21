<?php
	include 'conn.php';


	
	if(ISSET($_POST['save'])){
			if(!empty($_POST['offerTitle'])){
				$offerTitle = mysqli_real_escape_string($conn, $_POST['offerTitle']);
			}


			if(!empty($_POST['dateInserted'])){
				$dateInserted = mysqli_real_escape_string($conn, $_POST['dateInserted']);
				}

			if(!empty($_POST['dateValid'])){
				$dateValid = mysqli_real_escape_string($conn, $_POST['dateValid']);
				}

			if(!empty($_POST['pic'])){
				$address = "../Images/";
				$pic = mysqli_real_escape_string($conn, $_POST['pic']);
				$image = $address.$pic;
				} 


				$insert = "INSERT INTO offer (pic, title, date_inserted, date_valid)
				VALUES ('$image', '$offerTitle', '$dateInserted', '$dateValid');";


			
				mysqli_query($conn,$insert);

					


			
		header("location: index.php");
	         

}
?>