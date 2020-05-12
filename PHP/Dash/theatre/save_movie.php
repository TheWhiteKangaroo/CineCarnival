<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
			if(!empty($_POST['theatreName'])){
				$theatreName = mysqli_real_escape_string($conn, $_POST['theatreName']);
			}
			if(!empty($_POST['totalSeat'])){
				$totalSeat = mysqli_real_escape_string($conn, $_POST['totalSeat']);
				}

			if(!empty($_POST['theatreType'])){
				$theatreType = mysqli_real_escape_string($conn, $_POST['theatreType']);
				}

				if(!empty($_POST['ShowID'])){
					$showID = mysqli_real_escape_string($conn, $_POST['ShowID']);
					}

			if(!empty($_POST['soldSeat'])){
				$soldSeat = mysqli_real_escape_string($conn, $_POST['soldSeat']);
				}
			$availableSeat="";

			$availableSeat=$totalSeat-$soldSeat;
			
			$sqlTheatreCheck = "SELECT theatre_name FROM theatre WHERE theatre_name = '$theatreName'";
			$result = mysqli_query($conn, $sqlTheatreCheck);
		
			while($row = mysqli_fetch_assoc($result)){
				$dbname = $row['theatre_name'];
			}
		
			if($dbname == $theatreName){
				$err = "Theatre already exists!";
				echo $err;			
				echo "<a href='index.php'>go back to home page</a>";
			}
			else{
				$sql = "INSERT INTO theatre VALUES ('0','$showID','$theatreName', '$totalSeat','$totalSeat' ,'0','$theatreType');";
		
			
				mysqli_query($conn, $sql);
			
		header("location: index.php");
	         }

}
?>