
<?php
	require_once 'conn.php';


	
	if(ISSET($_POST['update'])){
		$o_id = $_POST['o_id'];
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
				$image = $address . $pic;
				mysqli_query($conn, "UPDATE `offer` SET
				`pic`='$image' WHERE `o_id` = '$o_id'") or die(mysqli_error());
				} 


				$sql = "UPDATE `offer` SET `title`='$offerTitle', `date_inserted`='$dateInserted',
				 `date_valid`='$dateValid' WHERE `o_id` = '$o_id'";
			   


		   
			   mysqli_query($conn,$sql);



	

			
		header("location: index.php");
	         

}
?>