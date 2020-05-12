<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['update'])){
		$mv_id = $_POST['mv_id'];
		if(!empty($_POST['movieName'])){
			$movieName = mysqli_real_escape_string($conn, $_POST['movieName']);
		  }
		  if(!empty($_POST['releaseDate'])){
			  $releaseDate = mysqli_real_escape_string($conn, $_POST['releaseDate']);
			}
		  if(!empty($_POST['runTime'])){
			$runTime = mysqli_real_escape_string($conn, $_POST['runTime']);
			}
		  if(!empty($_POST['coverArt'])){
			  $coverArt = mysqli_real_escape_string($conn, $_POST['coverArt']);
			  mysqli_query($conn, "UPDATE `movie` SET
			 `cover_pic`='$coverArt' WHERE `mv_id` = '$mv_id'") or die(mysqli_error());
			  } 
		  if(!empty($_POST['cast'])){
			  $cast = mysqli_real_escape_string($conn, $_POST['cast']);
			  }    
		  if(!empty($_POST['director'])){
			  $director = mysqli_real_escape_string($conn, $_POST['director']);
			}
		  
		  if(!empty($_POST['trailerLink'])){
			  $trailerLink = mysqli_real_escape_string($conn, $_POST['trailerLink']);
			  }
	  
	  
		  if(!empty($_POST['status'])){
			  $status = mysqli_real_escape_string($conn, $_POST['status']);
			  }
		  
		  if(!empty($_POST['genre'])){
				$genre = mysqli_real_escape_string($conn, $_POST['genre']);
				}
		  
		  if(!empty($_POST['plot'])){
				$plot = mysqli_real_escape_string($conn, $_POST['plot']);
				}
				
		  if(!empty($_POST['language'])){
			$language = mysqli_real_escape_string($conn, $_POST['language']);
			}
			
		  if(!empty($_POST['format'])){
			$format = mysqli_real_escape_string($conn, $_POST['format']);
			}
		
	  
	  
	  

			mysqli_query($conn, "UPDATE `movie` SET `name` = '$movieName', `cast` = '$cast', `genre` = '$genre', `director` = '$director',
			`release_date` = '$releaseDate', `trailer_link`='$trailerLink', `runtime`='$runTime', `status`='$status',
			`plot`='$plot', `language`='$language', `format`='$format' WHERE `mv_id` = '$mv_id'") or die(mysqli_error());
		header("location: index.php");
	         

}
?>

