<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
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
	


				$sql = "INSERT INTO poll (poll_title, content1, content2, content3, content4)
						VALUES ('$pollTitle', '$content1', '$content2', '$content3', '$content4');";
		
			
				mysqli_query($conn, $sql);
			
		header("location: index.php");
	         

}
?>