<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width-device-width, initial-scale=1"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

	</head>
<body>

<header>
	<div class="d-flex flex-row flex-nowrap sm-flex-wrap  header-section container">
		<div class="p-2 mr-2">
			<a href="#"><img src="CineCarnival.png" alt="No Image..."></a>
		</div>
		
		<div class="p-2 align-self-center d-sm-none d-md-block d-none d-sm-block mr-0 pr-0">
		
		</div>
		<div class="p-2 align-self-center  mr-auto d-sm-none d-md-block d-none d-sm-block ml-0 pl-0">

		</div>
		<div class="p-2 align-self-center header-anchor">
			
		</div>

		<div class="p-2 align-self-center">
			<a href="..\..\SignInPage.php" style="text-decoration: none;"><i class="fas fa-sign-out-alt"></i>  Sign Out</a>
		</div>
	</div>
</header>

<!--########################################################### TAB OPTIONS ###################################-->

	<div class="container">
		<div class="row">
			<div class="col-lg-4 sidebar p-0">
			<a href="..\movie/index.php">Manage Movies</a>
			</div>			
			<div class="col-lg-4 sidebar p-0">
			<a class="active" href="index.php">Manage Shows</a>	
			</div>
			<div class="col-lg-4 sidebar p-0">
			<a href="..\theatre/index.php">Manage Theatres</a>	
			</div>
		</div>
		
	</div>




 


<!--################################################## DASH START ##########################################################-->

	<div class="container">
		
	
		<button type="button" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#form_modal"> Add Shows</button>
		<br /><br />
		<table class="table table-bordered">
			<thead class="thead-light">
				<tr>
					<th>Show ID</th>
					<th>Theatre ID</th>
					<th>Movie Name</th>
					<th>Theatre</th>
					<th>Date</th>
					<th>Time</th>					
					<th>Format</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody style="background-color:#fff;">
				<?php
					require 'conn.php';
					$query = mysqli_query($conn, "SELECT s.s_id,s.show_status,s.show_date,s.show_time,s.show_type, t.theatre_name,t.theatre_id, t.theatre_type, m.name FROM shows AS s LEFT JOIN theatre AS t ON t.theatre_id=s.theatre_id LEFT join movie AS m on s.movie_id=m.mv_id") or die(mysqli_error());
					while($fetch = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo "SID - ".$fetch['s_id']?></td>	
					<td><?php echo "TID - ".$fetch['theatre_id']?></td>						
					<td><?php echo $fetch['name']?></td>
					<td><?php echo $fetch['theatre_name']." - ".$fetch['theatre_type']?></td>
					<td><?php echo $fetch['show_date']?></td>					
					<td><?php echo substr($fetch['show_time'],0,5)?></td>
					<td><?php echo $fetch['show_type']?></td>
					
					<td><button class="btn btn-warning" data-toggle="modal" type="button" data-target="#update_modal<?php echo $fetch['s_id']?>"> Edit</button>
					<a href="delete.php?delete=<?php echo $fetch['s_id']; ?>" class="btn btn-danger">
                        Remove                     
                    </a>
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
						<h3 class="modal-title">Add Show</h3>
					</div>
					<div class="modal-body">
						

					<div class="row">
                          <div class="col-lg-6 pt-4">
                          

						    <div class="taboptions">
								<select name="movieName" required>
										<option value="" disabled selected>Movie Name</option>
										<?php

										$editSql = "SELECT name from movie";
										$editResult = $conn-> query($editSql);
										while ($fetch = $editResult-> fetch_assoc()) {

										?>

										<option value="<?php echo $fetch["name"]?>"><?php echo $fetch["name"]?></option>

										<?php
										}
										?>
								</select>
							</div>  
							
											
							<div class="taboptions">
								
                                 <select name="theatreID" required>
									<option value="" disabled selected>Theatre ID</option>
									<?php 
										$myquery = "SELECT theatre_id FROM theatre;";
										$result  = mysqli_query($conn, $myquery);
										while($row = mysqli_fetch_assoc($result)){
											?>
												<option value="<?php echo $row['theatre_id'];?>"><?php echo "TID - ".$row['theatre_id'];?></option>
											<?php
										}
									?>
                                 </select><br><span>(if no theatres found then create add a theatre first.)</span>
                                </div> 
							<div class="taboptions">
								<input type="text" name="showTime" maxlength="15" placeholder="Show Time*" required>
                        	</div>  
  

<!===================end o f left ===============================>
                          </div>

                          <div class="col-lg-6 pt-4">
							
								<div class="taboptions">
									<input type="date" class="form-control form-control-sm" placeholder="Date*" name="showDate" value="" required> 
								</div>
											
                                <div class="taboptions">
                                 <select name="showType" required>
									<option value="" disabled selected>Show Type</option>
									<option value="2D">2D</option>
									<option value="3D">3D</option>
                                 </select>
                                </div>
                             	
                                <div class="taboptions">
                                 <select name="showStatus" required>
									<option value="" disabled selected>Show Status</option>
									<option value="Now Showing">Now Showing</option>
                                 </select>
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