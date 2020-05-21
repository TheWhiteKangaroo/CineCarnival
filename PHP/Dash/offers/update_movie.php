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
      

  <div class="modal fade" id="update_modal<?php echo $fetch['o_id']?>" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form method="POST" action="update_query.php">
				<div class="modal-header">
					<h3 class="modal-title">Update Offers</h3>
				</div>
				<div class="modal-body">
					<div class="row">
                        <div class="col-lg-6 pt-4">
                            <div class="taboptions"> 
                            <label>Offer Title</label>       
                                <input type="hidden" name="o_id" value="<?php echo $fetch['o_id']?>"/>
                                <input type="text" name="offerTitle" value="<?php echo $fetch['title']?>" class="form-control" required="required"/>
                            </div>

  
                            <div class="taboptions custom-file mb-3">
                            <label>Offer image</label>
                                <input type="file" class="custom-file-input" id="customFile" name="pic">
                                <label class="custom-file-label" for="customFile"><?php echo $fetch['pic']?></label>
                            </div>


                        </div>

                        <div class="col-lg-6 pt-4">


                        <div class="taboptions">
							                	<label>Inserted On</label>
                                <input type="date" class="form-control form-control-sm" name="dateInserted" value="<?php echo $fetch['date_inserted']?>" required> 
                        	</div>	
                            
                        <div class="taboptions">
						                		<label>Valid Till</label>
                                <input type="date" class="form-control form-control-sm" name="dateValid" value="<?php echo $fetch['date_valid']?>" required> 
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
  var file = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(file);
});
</script>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>







