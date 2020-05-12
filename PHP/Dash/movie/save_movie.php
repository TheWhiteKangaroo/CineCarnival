<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
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
		
	  
	  
	  
		  $sqlMovieCheck = "SELECT name FROM movie WHERE name = '$movieName'";
		  $result = mysqli_query($conn, $sqlMovieCheck);
	  
		  while($row = mysqli_fetch_assoc($result)){
			$dbname = $row['name'];
		  }
	  
		  if($dbname == $movieName){
			$err = "Movie already exists!";
			echo $err;			
			echo "<a href='index.php'>go back to home page</a>";

		  }
		  else{
			$sql = "INSERT INTO movie (name, director, cast, release_date, trailer_link, cover_pic, runtime, status, genre, plot, language, format)
					VALUES ('$movieName', '$director' , '$cast', '$releaseDate' , '$trailerLink', '$coverArt', '$runTime', '$status', '$genre', '$plot', '$language', '$format');";
	  
		
			mysqli_query($conn, $sql);
		
		header("location: index.php");
	         }

}
?>