<div class="modal fade" id="update_modal<?php echo $fetch['p_id']?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="update_query.php">
				<div class="modal-header">
					<h3 class="modal-title">Update Theatre</h3>
				</div>
				<div class="modal-body">
					<div class="row">
                        <div class="col-lg-12 pt-4">


                            <div class="taboptions">
                                <input type="hidden" name="p_id" value="<?php echo $fetch['p_id']?>">   
                                <input type="text" class="form-control form-control-sm" placeholder="poll name*" name="pollTitle" value="<?php echo $fetch['poll_title']?>" required>
                            </div>

                            <div class="taboptions">
                                <input type="text" class="form-control form-control-sm" placeholder="content1" name="content1" value="<?php echo $fetch['content1']?>" required> 
                            </div>
  
                            <div class="taboptions">
                                <input type="text" class="form-control form-control-sm" placeholder="content2" name="content2" value="<?php echo $fetch['content2']?>" required> 
							</div>
							
                            <div class="taboptions">
                                <input type="text" class="form-control form-control-sm" placeholder="content3" name="content3" value="<?php echo $fetch['content3']?>" required> 
							</div>
							
							<div class="taboptions">
                                <input type="text" class="form-control form-control-sm" placeholder="content4" name="content4" value="<?php echo $fetch['content4']?>" required> 
                            </div>

    
                      </div>

                    </div>
					
				</div>
				<div style="clear:both;"></div>
				<div class="modal-footer">
					<button name="update" class="btn btn-warning"> Update</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"> Close</button>
				</div>
				</div>
			</form>
		</div>
	</div>
</div>