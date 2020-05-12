<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      

  <div class="modal fade" id="update_modal<?php echo $fetch['mv_id']?>" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form method="POST" action="update_query.php">
				<div class="modal-header">
					<h3 class="modal-title">Update Movie</h3>
				</div>
				<div class="modal-body">
					<div class="row">
                        <div class="col-lg-6 pt-4">
                            <div class="taboptions">
        
                                <input type="hidden" name="mv_id" value="<?php echo $fetch['mv_id']?>"/>
                                <input type="text" name="movieName" value="<?php echo $fetch['name']?>" class="form-control" required="required"/>
                            </div>
                            <div class="taboptions">
                                <input type="date" class="form-control form-control-sm" placeholder="Release Date*" name="releaseDate" value="<?php echo $fetch['release_date']?>" required>
                            </div>
  
                            <div class="taboptions">
                                <input type="int" class="form-control form-control-sm" placeholder="Runtime*" name="runTime" value="<?php echo $fetch['runtime']?>" required> 
                            </div>
  
                            <div class="taboptions custom-file mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="coverArt">
                                <label class="custom-file-label" for="customFile"><?php echo $fetch['cover_pic']?></label>
                            </div>
                            <div class="taboptions">
                                  <textarea name="plot" rows="4" cols="70"  placeholder="plot....." required> <?php echo $fetch['plot']?> </textarea>
                            </div>

                            <div class="taboptions">
                                <select name="language" required>
                                  <option value="" disabled>Language</option>
                                  <option value="<?php echo $fetch['language']?>" selected><?php echo $fetch['language']?></option>\
                                  <option value="English">English</option>
                                  <option value="Bangla">Bangla</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 pt-4">
                            
                                    
                            <div class="taboptions">
                              <textarea name="cast" rows="4" cols="70"  placeholder="cast....." required><?php echo $fetch['cast']?></textarea>
                            </div>
                            <div class="taboptions">
                               <input type="text" class="form-control form-control-sm" placeholder="director*" name="director" value="<?php echo $fetch['director']?>" required>
                            </div>
                            <div class="taboptions">
                              <input type="text" class="form-control form-control-sm" placeholder="trailer link*" name="trailerLink" value="<?php echo $fetch['trailer_link']?>" required>
                            </div>
                            <div class="taboptions">
                              <input type="text" class="form-control form-control-sm" placeholder="genre*" name="genre" value="<?php echo $fetch['genre']?>" required>
                            </div>
                          

                            <div class="taboptions">
                            <select name="status"  required>
                              <option value="" disabled>Status</option>                              
                              <option value="<?php echo $fetch['status'] ?>"
                                  selected><?php echo $fetch['status'] ?></option>
                              <option value="Now Showing">Now Showing</option>
                              <option value="Coming Soon">Coming Soon</option>
                              <option value="Finished">Finished</option>
                            </select>
                            </div>

                            <div class="taboptions">
                             <select name="format" value="<?php echo $fetch['format']?>" required>                             
                              <option value="" disabled>format</option>
                              <option value="<?php echo $fetch['format'] ?>"
                                  selected><?php echo $fetch['format'] ?></option>
                              <option value="2D">2D</option>
                              <option value="3D">3D</option>
                             </select>
                            </div>
                         
                      </div>

                    </div>
					
				</div>
				<div style="clear:both;"></div>
				<div class="modal-footer">
					<button name="update" class="btn btn-warning"><span class=""></span> Update</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class=""></span> Close</button>
				</div>
				</div>
			</form>
		</div>
  </div>

</div>

  
<script>
$(".custom-file-input").on("change", function() {
  var coverArt = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(coverArt);
});
</script>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>







