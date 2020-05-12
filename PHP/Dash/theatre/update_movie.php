<div class="modal fade" id="update_modal<?php echo $fetch['theatre_id']?>" aria-hidden="true">
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
                                <input type="hidden" name="theatre_id" value="<?php echo $fetch['theatre_id']?>"/>
                                <label for="theatreName">Theatre Name</label>                         
                                <input type="text" name="theatreName" value="<?php echo $fetch['theatre_name']?>" class="form-control" required="required"/>
                            </div>

                            <div class="taboptions">
                              <label>Total Seat</label>
                              <input type="int" class="form-control form-control-sm" placeholder="totalSeat*" name="totalSeat" value="<?php echo $fetch['total_seat']?>" required> 
                            </div>

                            <div class="taboptions">
                                <select name="showID" id="">
                                  <option value="" disabled selected>Show ID</option>
                                  <?php
                                    $sql = "SELECT s_id from shows;";
                                    $result = mysqli_query($conn, $sql);
                                    while($row=mysqli_fetch_assoc($result)){
                                      ?>
                                        <option value="<?php echo $row['s_id'];?>"><?php echo "SID - ".$row['s_id'];?></option>
                                      <?php
                                    }
                                  ?>
                                </select>
                            </div>


                            <div class="taboptions">
                                <label>Theatre Type</label>
                             <select name="theatreType" value="<?php echo $fetch['theatre_type']?>" required>
                              <option value="" disabled>theatreType</option>
                              <option value="<?php echo $fetch['theatre_type'] ?>"
                                  selected><?php echo $fetch['theatre_type'] ?></option>
                              <option value="VIP">VIP</option>
                              <option value="PREMIUM">PREMIUM</option>
                              <option value="REGULAR">REGULAR</option>
                             </select>
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