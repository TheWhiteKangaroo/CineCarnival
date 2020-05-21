<?php

  include "includes/db_connect.inc.php";

  $fName = $lName = $uName = $uPass = $uEmail = $err = $uNameInDB = "" ;
	
	
	/* mysqli_real_escape_string() helps prevent sql injection */
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_POST['first_name'])){
      $fName = mysqli_real_escape_string($conn, $_POST['first_name']);
    }
    if(!empty($_POST['last_name'])){
      $lName = mysqli_real_escape_string($conn, $_POST['last_name']);
    }
    if(!empty($_POST['user_name'])){
      $uName = mysqli_real_escape_string($conn, $_POST['user_name']);
    }
    if(!empty($_POST['user_pass'])){
      $uPass = mysqli_real_escape_string($conn, $_POST['user_pass']);
      $uPassToDB = password_hash($uPass, PASSWORD_DEFAULT);
    }
    if(!empty($_POST['user_email'])){
      $uEmail = mysqli_real_escape_string($conn, $_POST['user_email']);
    }

    $sqlUserCheck = "SELECT user_name FROM manager WHERE user_name = '$uName'";
    $result = mysqli_query($conn, $sqlUserCheck);

    while($row = mysqli_fetch_assoc($result)){
      $uNameInDB = $row['user_name'];
    }

    if($uNameInDB == $uName){
      $err = "UserName already exists!";
    }
    else{
      $sql = "INSERT INTO manager (first_name, last_name, user_name, email, password)
              VALUES ('$fName','$lName','$uName','$uEmail', '$uPassToDB');";

      mysqli_query($conn, $sql);
      header("location: login.php");
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

		<div class="p-2 align-self-center">
			<a href="#" style="text-decoration: none;"><i class="fas fa-sign-out-alt"></i>  Sign Out</a>
		</div>
	</div>
</header>


    <div class="wrapper container">
    <form action="registration.php" method="post">
        
      <div class="text-center">
        <h4>Register</h4>
        <p>Please fill in this form to create an account.</p>  
      </div>
        
      <label for="first_name">First name: </label>
      <input type="text" class="form-control form-control-sm" name="first_name" value="" required><br>
      <label for="last_name">Last name: </label>
      <input type="text" class="form-control form-control-sm" name="last_name" value="" required><br>
      <label for="user_name">User name: </label>
      <input type="text" class="form-control form-control-sm" name="user_name" value="" required><br>
      <label for="user_pass">Password: </label>
      <input type="password" class="form-control form-control-sm" name="user_pass" value="" required><br>
      <label for="user_email">E-mail: </label>
      <input type="email" class="form-control form-control-sm" name="user_email" value="" required><br>
      <button type="submit" class="btn btn-primary" name="button">Register</button><br>
      <span style="color:red;"><?php echo $err; ?></span>
      <span><b>Or <a href="login.php">Log In </a></b></span>
    
    </form>
    </div>    



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>