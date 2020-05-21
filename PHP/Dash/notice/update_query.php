
<?php
	include 'conn.php';


	
	if(ISSET($_POST['update'])){
		$n_id = $_POST['n_id'];
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
			mysqli_query($conn, "UPDATE `notice` SET
			`pic`='$image' WHERE `n_id` = '$n_id'") or die(mysqli_error());
			} 

				$sql = "UPDATE `notice` SET `title`='$title',
				`date_posted`='$datePosted', `links`='$links', `message`='$message' WHERE `n_id` = '$n_id'";
			   


		   
			   mysqli_query($conn,$sql);




				} 


			
		header("location: index.php");
	         


?>