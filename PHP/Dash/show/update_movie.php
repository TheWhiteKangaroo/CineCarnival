<div class="modal fade" id="update_modal<?php echo $fetch['s_id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="update_query.php">
                <div class="modal-header">
                    <h3 class="modal-title">Update Shows</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 pt-4">
                        <input type="hidden" name="s_id" value="<?php echo $fetch['s_id']?>"/>
						<div class="taboptions">
								<select name="movieName" required>
                                    <option value="" disabled>Movie Name</option>
                                    <?php 
                                        $sql = "SELECT m.name FROM movie AS m left join shows as s on s.movie_id=m.mv_id WHERE m.status='Now Showing';";
                                        $result = mysqli_query($conn,$sql);
                                        while($row=mysqli_fetch_assoc($result)){
                                            ?>
                                            <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                                            <?php
                                        }
                                    ?>
								</select>
							</div>

                            <div class="taboptions">
                                <select name="theatreID" required>
                                    <option value="" disabled selected>Theatre ID</option>
                                   <?php
                                        $sql = "SELECT theatre_id FROM theatre;";
                                        $result = mysqli_query($conn,$sql);
                                        while($row=mysqli_fetch_assoc($result)){
                                            ?>
                                            <option value="<?php echo $row['theatre_id'];?>"><?php echo $row['theatre_id'];?></option>
                                            <?php
                                        }
                                   ?>
                                </select>
                            </div>

							<div class="taboptions">
								<input type="text" name="showTime" placeholder="Show Time" required>
                             </div>  

                        </div>

                        <div class="col-lg-6 pt-4">

						<div class="taboptions">
                      <input type="date" class="form-control form-control-sm" name="showDate" value="<?php echo $fetch['show_date']?>" required>
                  </div>

                  <div class="taboptions">
                    <select name="showType" required>
					  <option value="" disabled>Show Type</option>
					  <option value="<?php echo $fetch['show_type'] ?>"
                        selected><?php echo $fetch['show_type'] ?>
                      <option value="2D">2D</option>
                      <option value="3D">3D</option>
                    </select>
				  </div>                  

					<div class="taboptions">
						<select name="showStatus" required>
							<option value="" disabled>Show Status</option>
							<option value="<?php echo $fetch['show_status'] ?>"
							selected><?php echo $fetch['show_status'] ?></option>
							<option value="Now Showing">Now Showing</option>
							<option value="Coming Soon">Coming Soon</option>
							<option value="Finished">Finished</option>
						</select>
					</div>


                        </div>

                    </div>

                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button name="update" class="btn btn-warning"><span class=""></span> Update</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><span class=""></span> Close
                    </button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>