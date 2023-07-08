<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['announcement_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Edit Announcement</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="container-fluid">

			<form method="post" action="announce_update.php">
				<input type="hidden" class="form-control" name="announcement_id" value="<?php echo $row['announcement_id']; ?>">
				<div class="form-group">
					<div class="">
						<label class="control-label modal-label">Announcement</label>
					</div>
					<div class="">
						<textarea class="form-control" rows="5" name="content"><?php echo $row['content']; ?></textarea>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button type="submit" name="submit" value="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Update</button>
			</form>

            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['announcement_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Delete Announcement</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">	
            	<p class="text-center text-danger">Are you sure you want to delete?</p>
                <h4 class="text-center text-secondary">Announcement ID: <span class="text-danger">#<?php echo $row['announcement_id']; ?></span></h4>
				<h6 class="text-center text-secondary"><span class="text-danger"><?php echo $row['content']; ?></span></h6>		
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <a href="announce_delete.php?announcement_id=<?php echo $row['announcement_id']; ?>" class="btn btn-danger"><i class="fa fa-trash m-1"></i>Yes</a>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="email_<?php echo $row['announcement_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel">Email Announcement</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">    
                <p class="text-center text-success">Are you sure you want to email this announcement to all users?</p>
                <h4 class="text-center text-secondary">Announcement ID: <span class="text-primary">#<?php echo $row['announcement_id']; ?></span></h4>
                <h6 class="text-center text-secondary"><span class="text-primary"><?php echo $row['content']; ?></span></h6>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <a href="announce_email.php?announcement_id=<?php echo $row['announcement_id']; ?>" class="btn btn-success"><i class="fa fa-check m-1"></i>Delete</a>
            </div>

        </div>
    </div>
</div>