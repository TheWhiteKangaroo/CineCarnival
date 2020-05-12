<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
			
				$sName = $_POST['sName'];
				$movieName = $_POST['movieName'];
				$theatreID= $_POST['theatreID'];
				$showDate = $_POST["showDate"];			
				$showType = $_POST['showType'];
				$showStatus = $_POST['showStatus'];
				$showTime = $_POST['showTime'];
				$movieID="";
				$query = "SELECT mv_id FROM movie WHERE name='$movieName';";
				$result = mysqli_query($conn, $query);
				while($row= mysqli_fetch_assoc($result)){
					$movieID = $row['mv_id'];
				}
				
				$sql = "INSERT INTO shows VALUES ('0','$movieID','$theatreID', '$showDate', '$showTime','$showStatus','$showType');";
		
			
				mysqli_query($conn, $sql);
			
		header("location: index.php");
	         }


?>