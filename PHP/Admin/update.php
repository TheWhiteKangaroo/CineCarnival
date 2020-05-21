<?php
  session_start();

  if(!isset($_SESSION["userName"])){
    header("Location: login.php");
  }
  $user=$_SESSION["userName"];
?>

<?php

  include "includes/db_connect.inc.php";

  $fName = $lName = $uName = $uPass = $uEmail = $err = $uNameInDB = "" ;
	
	
	/* mysqli_real_escape_string() helps prevent sql injection */
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id = $_POST['id'];
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
      $query = "UPDATE manager SET `password` = '$uPassToDB' WHERE `id` = '$id'";
      mysqli_query($conn, $query);

    }
    if(!empty($_POST['user_email'])){
      $uEmail = mysqli_real_escape_string($conn, $_POST['user_email']);
    }

  
        $sql = "INSERT INTO manager (first_name, last_name, user_name, email, password)
              VALUES ('$fName','$lName','$uName','$uEmail', '$uPassToDB');";

        $sql = "UPDATE manager SET `first_name` = '$fName', `last_name` = '$lName', `user_name` = '$uName',
                `email` = '$uEmail' WHERE `id` = '$id'";     

      mysqli_query($conn, $sql);
      header("location: logout.php");
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
			<a href="..\dash\movie/index.php"><img src="CineCarnival.png" alt="No Image..."></a>
		</div>
		
		<div class="p-2 align-self-center d-sm-none d-md-block d-none d-sm-block mr-0 pr-0">
		
		</div>
		<div class="p-2 align-self-center  mr-auto d-sm-none d-md-block d-none d-sm-block ml-0 pl-0">

		</div>
		<div class="p-2 align-self-center header-anchor">
			<div class="btn-group-vertical">
				<div class="btn-group">
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					Manage
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="..\dash\offers/index.php">Manage Offers</a>
					<a class="dropdown-item" href="..\dash\notice/index.php">Manage Notice</a>
				</div>
				</div>
  			</div>
		</div>

		<div class="p-2 align-self-center">
			<a href="logout.php" style="text-decoration: none;"><i class="fas fa-sign-out-alt"></i>  Sign Out</a>
		</div>
	</div>
</header>



    <div class="wrapper container">


        <?php
					
					$query = mysqli_query($conn, "SELECT * FROM `manager`  WHERE `user_name` = '$user'") or die(mysqli_error());
					while($fetch = mysqli_fetch_array($query)){
				?>


    <form action="update.php" method="post">
        

      <div class="text-center">
        <h4>Manage Profile</h4>
       
      </div>
        
      <label for="first_name">First name: </label>
      <input type="hidden" name="id" value="<?php echo $fetch['id']?>">
      <input type="text" class="form-control form-control-sm" name="first_name" value="<?php echo $fetch['first_name']?>" required><br>
      <label for="last_name">Last name: </label>
      <input type="text" class="form-control form-control-sm" name="last_name" value="<?php echo $fetch['last_name']?>" required><br>
      <label for="user_name">User name: </label>
      <input type="text" class="form-control form-control-sm" name="user_name" value="<?php echo $fetch['user_name']?>" required><br>
      <label for="user_pass">New Password: </label>
      <input type="password" class="form-control form-control-sm" name="user_pass" value="" required><br>
      <label for="user_email">E-mail: </label>
      <input type="email" class="form-control form-control-sm" name="user_email" value="<?php echo $fetch['email']?>" required><br>
      <button type="submit" class="btn btn-primary" name="button">Update</button><br>
      
      <b> <a href="..\dash\movie/index.php">Close</a></b>
      <span style="color:red;"><?php echo $err; ?></span>    
    </form>

    <?php
					
					}
				?>




    </div>    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>





