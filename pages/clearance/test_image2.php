<form method="POST" action="test_back2.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <button name="update_settle" class="btn btn-block btn-success" type="submit">SETTLE</button>
                                    <button name="update_dismiss" class="btn btn-block btn-success" type="submit">DISMISS</button>
                                    <button id="leader_write_button" class="btn btn-block btn-success" type="button">WRITE</button>
                                    <button id="leader_upload_button" class="btn btn-block btn-success" type="button">UPLOAD</button>
                                   
                                    <div class="form-group" id="leader_write_group">
                                        <label for="leader_write" class="control-label">Write:</label>
                                        <textarea name="leader_write" class="form-control" id="leader_write" rows="5"></textarea>
                                    </div>
                                    <div class="form-group  " class="form-control" id="leader_upload_group">
                                        <label for="attached_photo" class="col-form-label">Attach Photo:</label>
                                        <input type="file" name="attached_photo" accept="image/*" id="leader_upload">
                                    </div>
                                    <script>
                                        $(document).ready(function(){
                                            $('#leader_write_group').hide()
                                            $('#leader_write_button').click(function(e){
                                                e.stopPropagation()
                                                $('#leader_write_group').toggle()
                                                $('#leader_upload_group').hide()
                                            })
                                            $('#leader_upload_group').hide()
                                            $('#leader_upload_button').click(function(e){
                                                e.stopPropagation()
                                                $('#leader_write_group').hide()
                                                $('#leader_upload_group').toggle()
                                            })
                                        })
                                    </script>
                                </div>
                            </form>