<?php
include "includes/db_connect.inc.php";

session_start();
$uPass = $uName = $message = "";

/* mysqli_real_escape_string() helps prevent sql injection */
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(!empty($_POST['u_name'])){
		$uName = mysqli_real_escape_string($conn, $_POST['u_name']);
	}
	if(!empty($_POST['u_pass'])){
		$uPass = mysqli_real_escape_string($conn, $_POST['u_pass']);
	}

	$sqlUserCheck = "SELECT user_name, password FROM manager WHERE user_name = '$uName'";
	$result = mysqli_query($conn, $sqlUserCheck);
	$rowCount = mysqli_num_rows($result);

	if($rowCount < 1){
		$message = "User does not exist!";
	}
	else{
		while($row = mysqli_fetch_assoc($result)){
			$uPassInDB = $row['password'];

			if(password_verify($uPass, $uPassInDB)){
				$_SESSION['userName'] = $uName;
				header("Location: http://localhost/CineCarnival-master\PHP\Dash\movie");
			}
			else{
				$message = "Wrong Password!";
			}
		}
	}
}

?>



<!doctype html>
<html lang="en">
  <head>
	<title>Title</title>
	<!-- Required meta tags -->
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		.wrapper{
			padding-top:50px;
			width: 20%;
		}
	</style>

</head>
  <body>

  <header>
	<div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section container">
		<div class="p-2 mr-2">
			<a href="..\SignInPage.php"><img src="CineCarnival.png" alt="No Image..."></a>
		</div>
		
		<div class="p-2 align-self-center d-sm-none d-md-block d-none d-sm-block mr-0 pr-0">
		
		</div>
		<div class="p-2 align-self-center  mr-auto d-sm-none d-md-block d-none d-sm-block ml-0 pl-0">

		</div>
		<div class="p-2 align-self-center header-anchor">
			
		</div>


	</div>
</header>

	<div class="container wrapper form-group">

	<div class="text-center">
        <h4>Login</h4>
       
      </div>
        

	<form action="login.php" method="post">
    
        
	<label for="u_name">Username: </label>
	<input type="text" class="form-control form-control-sm" name="u_name" value="" required><br>
	<label for="u_pass">Password: </label>
	<input type="password" class="form-control form-control-sm" name="u_pass" value="" required><br>
	<button type="submit" class="btn btn-primary center-block" name="login">Login</button>
			<span style="color:red"><?php echo $message; ?></span>
			<span><b>Or<a href="registration.php"> Register </a></b></span>
  
	</form>
	</div>



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>


