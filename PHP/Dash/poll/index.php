<?php
  session_start();
  if(!isset($_SESSION["userName"])){
    header("Location: http://localhost/CineCarnival-master\PHP\Admin\login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width-device-width, initial-scale=1"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

		<style>
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
</style>


	</head>
<body>

<header>
	<div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section container">
		<div class="p-2 mr-2">
			<a href="..\movie/index.php"><img src="CineCarnival.png" alt="No Image..."></a>
		</div>
		
		<div class="p-2 align-self-center d-sm-none d-md-block d-none d-sm-block mr-0 pr-0">
		
		</div>
		<div class="p-2 align-self-center  mr-auto d-sm-none d-md-block d-none d-sm-block ml-0 pl-0">

		</div>
		<div class="p-2 align-self-center header-anchor">
		<div class="dropdown">
				<button class="dropbtn">Manage</button>
				<div class="dropdown-content">
						<a href="..\offers/index.php">Manage Offers</a>
						<a href="..\notice/index.php">Manage Notice</a>					
						<a href="..\..\Admin/update.php">Manage Account</a>
				</div>
				</div>
		</div>

		<div class="p-2 align-self-center">
			<a href="..\..\Admin/logout.php" style="text-decoration: none;"><i class="fas fa-sign-out-alt"></i>  Sign Out</a>
		</div>
	</div>
</header>





<!--################################################## DASH START ##########################################################-->

	<div class="container">
		
	
		<button type="button" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#form_modal"> Add Poll </button>
		<br /><br />
		<table class="table table-bordered">
			<thead class="thead-light">
				<tr>
					<th>Poll Title </th>
					<th>Content 1/th>
					<th>Content 2</th>
					<th>Content 3/th>
					<th>Content 4</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody style="background-color:#fff;">
				<?php
					require 'conn.php';
					$query = mysqli_query($conn, "SELECT * FROM `poll`") or die(mysqli_error());
					while($fetch = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $fetch['poll_title']?></td>
					<td><?php echo $fetch['content1']?></td>
					<td><?php echo $fetch['content2']?></td>
					<td><?php echo $fetch['content3']?></td>
					<td><?php echo $fetch['content4']?></td>
					
					
					<td><button class="btn btn-warning" data-toggle="modal" type="button" data-target="#update_modal<?php echo $fetch['p_id']?>"> Edit</button>
					<a href="delete.php?delete=<?php echo $fetch['p_id']; ?>" class="btn btn-danger">delete</a>
					</td>
				</tr>
				<?php
					
					include 'update_movie.php';
					
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="modal fade" id="form_modal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="save_movie.php">
					<div class="modal-header">
						<h3 class="modal-title">Add poll</h3>
					</div>
					<div class="modal-body">
						

					<div class="row">
                          <div class="col-lg-12 pt-4">
                          
                            <div class="taboptions">
                                <input type="text" class="form-control form-control-sm" placeholder="poll name*" name="pollTitle" value="" required>
                            </div>

                            <div class="taboptions">
                                <input type="text" class="form-control form-control-sm" placeholder="content1" name="content1" value="" required> 
                            </div>
  
                            <div class="taboptions">
                                <input type="text" class="form-control form-control-sm" placeholder="content2" name="content2" value="" required> 
							</div>
							
                            <div class="taboptions">
                                <input type="text" class="form-control form-control-sm" placeholder="content3" name="content3" value="" required> 
							</div>
							
							<div class="taboptions">
                                <input type="text" class="form-control form-control-sm" placeholder="content4" name="content4" value="" required> 
                            </div>

    
                             
                          </div>

					<!--###################-->
				
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button name="save" class="btn btn-primary"> Save</button>
						<button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>	
</html>