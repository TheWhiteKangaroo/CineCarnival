<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['update'])){
			$s_id = $_POST['s_id'];
			$movieName = $_POST['movieName'];
			$theatreID= $_POST['theatreID'];
			$showDate = $_POST["showDate"];
			$showTime = $_POST["showTime"];
			$showType = $_POST['showType'];
			$showStatus = $_POST['showStatus'];
			$mv_id="";

			$sql = "SELECT mv_id FROM movie WHERE name='$movieName';";
			$result = mysqli_query($conn,$sql);
			while($row=mysqli_fetch_assoc($result)){
				$mv_id = $row['mv_id'];
			}

			mysqli_query($conn, "UPDATE `shows` SET `movie_id` = '$mv_id',`theatre_id` = '$theatreID',
			`show_date` = '$showDate',`show_time`='$showTime',`show_type` = '$showType',
			`show_status`='$showStatus' WHERE `s_id` = '$s_id'") or die(mysqli_error());
			header("location: index.php");
	         

}
?>

