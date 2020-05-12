<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['update'])){
		$soldSeat=$availableSeat="";
			$theatre_id = $_POST['theatre_id'];
			if(!empty($_POST['theatreName'])){
				$theatreName = mysqli_real_escape_string($conn, $_POST['theatreName']);
			}
			if(!empty($_POST['totalSeat'])){
				$totalSeat = mysqli_real_escape_string($conn, $_POST['totalSeat']);
				}

			if(!empty($_POST['theatreType'])){
				$theatreType = mysqli_real_escape_string($conn, $_POST['theatreType']);
				}

				if(!empty($_POST['showID'])){
					$showID = mysqli_real_escape_string($conn, $_POST['showID']);
					}
	
			if(!empty($_POST['soldSeat'])){
				$soldSeat = mysqli_real_escape_string($conn, $_POST['soldSeat']);
				}
			$availableSeat="";

			$availableSeat=$totalSeat-$soldSeat;
			

			mysqli_query($conn, "UPDATE `theatre` SET `theatre_name` = '$theatreName',`s_id`='$showID',
			`total_seat`='$totalSeat',`available_seat`='$availableSeat',`sold_seat`='$soldSeat',
			`theatre_type`='$theatreType' WHERE `theatre_id` = '$theatre_id'") or die(mysqli_error());
				header("location: index.php");
	         

}
?>

