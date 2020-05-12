<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width-device-width, initial-scale=1"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
		<title>Dashboard</title>
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
			<a class="active" href="index.php">Manage Movies</a>
			</div>
			<div class="col-lg-4 sidebar p-0">
			<a href="..\show/index.php">Manage Shows</a>	
			</div>
			<div class="col-lg-4 sidebar p-0">
			<a href="..\theatre/index.php">Manage Theatres</a>
			</div>
		</div>
		
	</div>







<!--################################################## DASH START ##########################################################-->

	<div class="container">
		
	
		<button type="button" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#form_modal"> Add Movie</button>
		<br /><br />
		<table class="table table-bordered">
			<thead class="thead-light">
				<tr>
					<th>Title</th>
					<th>Cast</th>
					<th>Genre</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody style="background-color:#fff;">
				<?php
					require 'conn.php';
					$query = mysqli_query($conn, "SELECT * FROM `movie` ORDER BY mv_id DESC") or die(mysqli_error());
					while($fetch = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $fetch['name']?></td>
					<td><?php echo $fetch['cast']?></td>
					<td><?php echo $fetch['genre']?></td>
					<td><?php echo $fetch['status']?></td>
					
					
					<td><button class="btn btn-warning" data-toggle="modal" type="button" data-target="#update_modal<?php echo $fetch['mv_id']?>">Edit</button>
					<a href="delete.php?delete=<?php echo $fetch['mv_id']; ?>" class="btn btn-danger">
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
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<form method="POST" action="save_movie.php">
					<div class="modal-header">
						<h3 class="modal-title">Add Movie</h3>
					</div>
					<div class="modal-body">
						

					<div class="row">
                          <div class="col-lg-6 pt-4">
                          
                            <div class="taboptions">
                                <input type="text" class="form-control form-control-sm" placeholder="Movie name*" name="movieName" value="" required>
                            </div>
                            <div class="taboptions">
                                <input type="date" class="form-control form-control-sm" placeholder="Release Date*" name="releaseDate" value="" required>
                            </div>
  
                            <div class="taboptions">
                                <input type="int" class="form-control form-control-sm" placeholder="Runtime*" name="runTime" value="" required> 
                            </div>
  
                            <div class="taboptions">
                                <input type="file" class="form-control-sm-file border" placeholder="choose cover art*" name="coverArt" value="" required>
                            </div>
                            <div class="taboptions">
                                  <textarea name="plot" rows="4" cols="70"  placeholder="plot....." required></textarea>
                            </div>

                            <div class="taboptions">
                                <select name="language" required>
                                  <option value="" disabled selected>Language</option>
                                  <option value="English">English</option>
                                  <option value="Bangla">Bangla</option>
                                </select>
                            </div>
  
                          </div>
  
  
                          <div class="col-lg-6 pt-4">
                            
                                    
                                <div class="taboptions">
                                  <textarea name="cast" rows="4" cols="70"  placeholder="cast....." required></textarea>
                                </div>
                                <div class="taboptions">
                                   <input type="text" class="form-control form-control-sm" placeholder="director*" name="director" value="" required>
                                </div>
                                <div class="taboptions">
                                  <input type="text" class="form-control form-control-sm" placeholder="trailer link*" name="trailerLink" value="" required>
                                </div>
                                <div class="taboptions">
                                  <input type="text" class="form-control form-control-sm" placeholder="genre*" name="genre" value="" required>
                                </div>
                              
  
                            	<div class="taboptions">
                                <select name="status" required>
                                  <option value="" disabled selected>Status</option>
                                  <option value="Now Showing">Now Showing</option>
                                  <option value="Coming Soon">Coming Soon</option>
                                </select>
                                </div>

                                <div class="taboptions">
                                 <select name="format" required>
                                  <option value="" disabled selected>format</option>
                                  <option value="2D">2D</option>
                                  <option value="3D">3D</option>
                                 </select>
                                </div>
                             
                          </div>




					<!--###################-->
				
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" type="button" data-dismiss="modal"> Close</button>
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