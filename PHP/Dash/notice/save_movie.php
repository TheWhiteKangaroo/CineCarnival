<?php
	include 'conn.php';

	
	if(ISSET($_POST['save'])){
			$address = "../Images/";
			if(!empty($_POST['title'])){
				$title = mysqli_real_escape_string($conn, $_POST['title']);
			}


			if(!empty($_POST['datePosted'])){
				$datePosted = mysqli_real_escape_string($conn, $_POST['datePosted']);
				}

			if(!empty($_POST['links'])){
				$links = mysqli_real_escape_string($conn, $_POST['links']);
				}

			if(!empty($_POST['message'])){
				$message = mysqli_real_escape_string($conn, $_POST['message']);
				}

			if(!empty($_POST['pic'])){
				$pic = mysqli_real_escape_string($conn, $_POST['pic']);
				$image = $address . $pic;
				} 





						$insert = "INSERT INTO notice (pic, title, date_posted, links, message)
						VALUES ('$image', '$title', '$datePosted', '$links', '$message');";
		

					
						mysqli_query($conn,$insert);
	


			
		header("location: index.php");
	         

}
?>