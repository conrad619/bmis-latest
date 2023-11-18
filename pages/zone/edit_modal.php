<?php echo '<div id="editModal'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Zone Leader</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Zone #:</label>
                    <input name="txt_edit_zone" class="form-control input-sm" type="number"  value="'.$row['zone'].'"/>
                </div>
                <div class="form-group">
                    <label>Username:</label>
                    <input name="txt_edit_uname" class="form-control input-sm" type="text" value="'.$row['username'].'"/>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input name="txt_edit_pass" class="form-control input-sm" type="password" value="'.$row['password'].'"/>
                </div>
                <div class="form-group">
                    <label>Name:</label>
                    <input name="txt_edit_fullname" class="form-control input-sm" type="text" value="'.$row['zone_name'].'"/>
                </div>
                <div class="form-group">
                    <label>Birthday:</label>
                    <input name="txt_edit_bday" class="form-control input-sm" type="date" value="'.$row['zone_birthday'].'"/>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <input name="txt_edit_addr" class="form-control input-sm" type="text" value="'.$row['zone_address'].'"/>
                </div>
                <div class="form-group">
                    <label>Contact Number:</label>
                    <input name="txt_edit_bcontactno" class="form-control input-sm" type="text" value="'.$row['bcontactno'].'"/>
                </div>
                <div class="form-group">
                    <label>Position:</label>
                    <input name="txt_edit_position" class="form-control input-sm" type="text" value="'.$row['position'].'"/>
                </div>
                <div class="form-group">
                    <label>Emergency Contact Number:</label>
                    <input name="txt_edit_emcontactno" class="form-control input-sm" type="text" value="'.$row['emcontactno'].'"/>
                </div>
                
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_save" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>

<!-- 

                
                <div class="form-group">
                    <label>Additional Notes (Allergies/Medical Condition(s):</label>
                    <input name="txt_edit_addnotes" class="form-control input-sm" type="text" value="'.$row['addnotes'].'"/>
                </div>

-->