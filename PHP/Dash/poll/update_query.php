<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['update'])){
			$p_id = $_POST['p_id'];
			if(!empty($_POST['pollTitle'])){
				$pollTitle = mysqli_real_escape_string($conn, $_POST['pollTitle']);
			}
			if(!empty($_POST['content1'])){
				$content1 = mysqli_real_escape_string($conn, $_POST['content1']);
				}

			if(!empty($_POST['content2'])){
					$content2 = mysqli_real_escape_string($conn, $_POST['content2']);
					}

			if(!empty($_POST['content3'])){
					$content3 = mysqli_real_escape_string($conn, $_POST['content3']);
					}
						
			if(!empty($_POST['content4'])){
				$content4 = mysqli_real_escape_string($conn, $_POST['content4']);
				}
	

			mysqli_query($conn, "UPDATE `poll` SET `poll_title` = '$pollTitle',
			`content1`='$content1',`content2`='$content2',`content3`='$content3',
			`content4`='$content4' WHERE `p_id` = '$p_id'") or die(mysqli_error());
				header("location: index.php");
	         

}
?>

