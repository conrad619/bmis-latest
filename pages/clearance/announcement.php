<!DOCTYPE html>
<html>

    <?php
    session_start();
    if(!isset($_SESSION['role']))
    {
        header("Location: ../../login.php"); 
    }
    else
    {
    ob_start();
    include('../head_css.php'); ?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Announcement
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">

                    <?php
                    if($_SESSION['role'] == "Administrator" || isset($_SESSION['staff']))
                    {
                    ?>

                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">
                                        
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Clearance</button>  

                                        <?php 
                                            if(!isset($_SESSION['staff']))
                                            {
                                        ?>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
                                        <?php
                                            }
                                        ?>
                                
                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <ul class="nav nav-tabs" id="myTab">
                                      <li class="active"><a data-target="#approved" data-toggle="tab">Approved</a></li>
                                      <li><a data-target="#disapproved" data-toggle="tab">Disapproved</a></li>
                                </ul>

                                

                                <form method="post">
                                    <div class="tab-content">
                                    <div id="approved" class="tab-pane active in">
                                        <table id="table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <?php 
                                                        if(!isset($_SESSION['staff']))
                                                        {
                                                    ?>
                                                    <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)"/></th>
                                                    <?php
                                                        }
                                                    ?>
                                                    <th>Clearance #</th>
                                                    <th>Resident Name</th>
                                                    <th>Findings</th>
                                                    <th>Purpose</th>
                                                    <th>OR Number</th>
                                                    <th>Amount</th>
                                                    <th style="width: 15% !important;">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                if(!isset($_SESSION['staff']))
                                                {

                                                    $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'Approved'") or die('Error: ' . mysqli_error($con));
                                                    while($row = mysqli_fetch_array($squery))
                                                    {
                                                        echo '
                                                        <tr>
                                                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['pid'].'" /></td>
                                                            <td>'.$row['clearanceNo'].'</td>
                                                            <td>'.$row['residentname'].'</td>
                                                            <td>'.$row['findings'].'</td>
                                                            <td>'.$row['purpose'].'</td>
                                                            <td>'.$row['orNo'].'</td>
                                                            <td>₱ '.number_format($row['samount'],2).'</td>
                                                            <td><button class="btn btn-primary btn-sm" data-target="#editModal'.$row['pid'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                            <a target="_blank" href="clearance_form.php?resident='.$row['residentid'].'&clearance='.$row['clearanceNo'].'&val='.base64_encode($row['clearanceNo'].'|'.$row['residentname'].'|'.$row['dateRecorded']).'" onclick="location.reload();" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Generate</a></td>
                                                        </tr>
                                                        ';

                                                        include "edit_modal.php";
                                                    }
                                                }
                                                else{
                                                    $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'Approved'") or die('Error: ' . mysqli_error($con));
                                                    while($row = mysqli_fetch_array($squery))
                                                    {
                                                        echo '
                                                        <tr>
                                                            <td>'.$row['clearanceNo'].'</td>
                                                            <td>'.$row['residentname'].'</td>
                                                            <td>'.$row['findings'].'</td>
                                                            <td>'.$row['purpose'].'</td>
                                                            <td>'.$row['orNo'].'</td>
                                                            <td>₱ '.number_format($row['samount'],2).'</td>
                                                            <td><button class="btn btn-primary btn-sm" data-target="#editModal'.$row['pid'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                            <a target="_blank" href="clearance_form.php?resident='.$row['residentid'].'&clearance='.$row['clearanceNo'].'&val='.sha1($row['clearanceNo'].'|'.$row['residentname'].'|'.$row['dateRecorded']).'" onclick="location.reload();" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Generate</a></td>
                                                        </tr>
                                                        ';

                                                        include "edit_modal.php";
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        </div>

                                        <div id="disapproved" class="tab-pane">
                                        <table id="table1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <?php 
                                                        if(!isset($_SESSION['staff']))
                                                        {
                                                    ?>
                                                    <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)"/></th>
                                                    <?php
                                                        }
                                                    ?>
                                                    <th>Resident Name</th>
                                                    <th>Findings</th>
                                                    <th>Purpose</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!isset($_SESSION['staff']))
                                                {

                                                    $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid where status = 'Disapproved' ") or die('Error: ' . mysqli_error($con));
                                                    while($row = mysqli_fetch_array($squery))
                                                    {
                                                        echo '
                                                        <tr>
                                                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['pid'].'" /></td>
                                                            <td>'.$row['residentname'].'</td>
                                                            <td>'.$row['findings'].'</td>
                                                            <td>'.$row['purpose'].'</td>
                                                        </tr>
                                                        ';

                                                        include "edit_modal.php";
                                                    }
                                                }
                                                else{
                                                    $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid where status = 'Disapproved' ") or die('Error: ' . mysqli_error($con));
                                                    while($row = mysqli_fetch_array($squery))
                                                    {
                                                        echo '
                                                        <tr>
                                                            <td>'.$row['residentname'].'</td>
                                                            <td>'.$row['findings'].'</td>
                                                            <td>'.$row['purpose'].'</td>
                                                        </tr>
                                                        ';

                                                        include "edit_modal.php";
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        </div>


                                        </div>
                                    <?php include "../deleteModal.php"; ?>

                                    </form>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <?php include "../edit_notif.php"; ?>

                            <?php include "../added_notif.php"; ?>

                            <?php include "../delete_notif.php"; ?>

                            <?php include "../duplicate_error.php"; ?>

            <?php include "add_modal.php"; ?>

            <?php include "function.php"; ?>


                    </div>   <!-- /.row -->
                    <?php
                    }
                    elseif($_SESSION['role'] == "Zone Leader")
                    {
                    ?>
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                
                                <div class="box-body table-responsive">
                                
                                <form method="post"  style = "display:none;">                                        
                                        <table id="table" style = "display:none;" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)"/></th>
                                                    <th>Resident Name</th>
                                                    <th>Purpose</th>
                                                    <th style="width: 25% !important;">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'New'") or die('Error: ' . mysqli_error($con));
                                                // while($row = mysqli_fetch_array($squery))
                                                // {
                                                //     echo '
                                                //     <tr>
                                                //         <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['pid'].'" /></td>
                                                //         <td>'.$row['residentname'].'</td>
                                                //         <td>'.$row['purpose'].'</td>
                                                //         <td>
                                                //             <button class="btn btn-success btn-sm" data-target="#approveModal'.$row['pid'].'" data-toggle="modal"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Approve</button>
                                                //             <button class="btn btn-danger btn-sm" data-target="#disapproveModal'.$row['pid'].'" data-toggle="modal"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Disapprove</button>
                                                //         </td>
                                                //     </tr>
                                                //     ';
                                                //     include "approve_modal.php";
                                                //     include "disapprove_modal.php";
                                                // }
                                                ?>
                                            </tbody>
                                        </table>


                                    </form>
                                <!-- <form method="post"> -->

                               <?php 

                               if (isset($_SESSION['pop_messega_ann'])) {

                                echo $_SESSION['pop_messega_ann'];

                                unset($_SESSION['pop_messega_ann']);

                               }
                               
                               
                               ?>

                                <button type = "button" class = "btn btn-primary" data-toggle="modal" data-target="#myModal_announcement"><i class="fa fa-bullhorn" aria-hidden="true"></i> Add announcement</button>
                                 <div class="tab-content" style = "padding-top:30px;">
                                    <div id="new" class="tab-pane active in">
                                        <table id="table_announce_for_zone" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                            <thead>
                                            <tr>
                                            <th class = "text-center" >#</th>
                                            <th>&nbsp;</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Date posted</th>
                                            <th>Action</th>
                                            </tr>
                                            </thead>


                                                <tbody>
                                                    
                                                    <?php 






                                                    $squery = mysqli_query($con, "SELECT * FROM tbl_announcement  ORDER BY announce_id DESC") or die('Error: ' . mysqli_error($con));

                                                     if(mysqli_num_rows($squery) > 0)
                                                            {
                                                                $x = 1;
                                                                
                                                                while($row = mysqli_fetch_array($squery))
                                                                {

                                                                    
                                                                    // $timestamp = strtotime($row['created_at']);
                                                                    // $new_date_format = date('F j, Y g:i:a', $timestamp);
                                                    
                                                    ?>
                                                
                                                        <tr>
                                                
                                                            <td class = "text-center" ><?= $x++ ?></td> 
                                                            <td class = "text-center">
                                                            <img id = "myImg" data-toggle="modal" data-target="#mymodal_img<?php echo $row['announce_id']; ?>" src="<?php echo $row['ann_images']; ?>" width="70" alt="">
<!-- Modal -->
<div class="modal fade" id="mymodal_img<?php echo $row['announce_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Announcement</h4>
      </div>
      <div class="modal-body">
      <img src="<?php echo $row['ann_images']; ?>" style = "width: 100%; max-width: 400px; height: auto;" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<form  action = "add_new_announcement.php" method = "post" enctype="multipart/form-data">

<div class="modal fade" id="mymodal_edit<?php echo $row['announce_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Announcement</h4>
      </div>
      <div class="modal-body">
          
  
  <div class="form-group text-left">
    <label for="exampleInputEmail1">Title</label>
    <input type="hidden" name = "announce_id" value = "<?php echo $row['announce_id']; ?>" >

    <input type="hidden" name = "existing_photo" value = "<?php echo $row['ann_images']; ?>" >

    <input type="text" class="form-control"  name = "ann_title" id="exampleInputEmail1" value = "<?php echo $row['ann_title']; ?>" required>
  </div>
  <div class="form-group text-left">
    <label for="exampleInputPassword1">Description</label>
        <textarea class="form-control"  name = "ann_description" id="" cols="30" rows="3"  required>
<?php echo $row['ann_description']; ?></textarea>
    </div>


  <div class="form-group text-left">
    <label for="exampleInputFile">Photo</label>
    <br>
    <img src="<?php echo $row['ann_images']; ?>" width ="100" alt="">
     <br>
    <label for="exampleInputFile">Change photo</label>
    <input type="file" name = "new_photo" class="custom-file-input" id="exampleInputFile" accept="image/*">
  </div>
 


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" name = "update_announcement" class="btn btn-primary">Save and Change</button>
                              

      </div>
    </div>
  </div>
</div>

</form>

<!-- delete -->

<form  action = "add_new_announcement.php" method = "post" enctype="multipart/form-data">

<div class="modal fade" id="mymodals_delete<?php echo $row['announce_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
          
  
  <div class="form-group text-center">

    <input type="hidden" name = "announce_id" value = "<?php echo $row['announce_id']; ?>" >

    <input type="hidden" name = "existing_photo" value = "<?php echo $row['ann_images']; ?>" >

    <input type="hidden" class="form-control"  name = "ann_title" id="exampleInputEmail1" value = "<?php echo $row['ann_title']; ?>" required>



<h4>Are you sure you want to delete <?= $row['ann_title'] ?>?</h4>

<button type="button" class="btn btn-default" style = "width:200px" data-dismiss="modal">No</button>
<button type="submit" name = "delete_announcement" style = "width:200px" class="btn btn-danger">Yes</button>

  </div>




 


      </div>
     
    </div>
  </div>
</div>

</form>

                                                                
                                                                
                                                            </td>              
                                                            <td><?php echo $row['ann_title']; ?></td>     
                                                            <td><?php echo $row['ann_description']; ?></td>
                                                            <td><?php echo $row['ann_date_posted']; ?></td>                                                     
                                                            <td>
                                                              

                                                                <div class="btn-group" role="group" aria-label="...">
                                                                <button data-toggle="modal" data-target="#mymodal_edit<?php echo $row['announce_id']; ?>" type="button" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                                <button type="button" data-toggle="modal" data-target="#mymodals_delete<?php echo $row['announce_id']; ?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                                </div>





                                                                
                                                            </td>
                                                          
                                                        
                                                        </tr>

                                                    <?php 

                                                                    }

                                                                }
                                                    
                                                    ?>
                                                    
                                                    </tbody>
                                        </table>

                                        <!-- </form> -->


                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                            <!-- Modal -->
                            <div class="modal fade" id="myModal_announcement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Add announcement</h4>
                                </div>
                                <div class="modal-body">

                                <form action = "add_new_announcement.php" method = "post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Title:</label>
                                    <input type="text" name = "ann_title" class="form-control" id="recipient-name" required>
                                </div>
                               

                                <div class="form-group">
                                    <label for="message-text" class="control-label">Photo:</label>
                                    <input type="file" name = "uploadimage" class="form-control" id="recipient-name"  accept="image/*" required>

                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="control-label">Description:</label>
                                    <textarea name = "ann_description" class="form-control" id="message-text" required></textarea>
                                </div>
                                

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" name = "submit_ann" class="btn btn-primary">Submit</button>
                                </div>

                                </form>
                                </div>
                            </div>
                            </div>

                        <!-- Modal -->


                    <?php include "function.php"; ?>


                    </div>   <!-- /.row -->

                    <?php
                    }
                    else
                    {
                    ?>

                    <div class="row">
                        <!-- left column -->
                            <div class="box">


                        <div class="tab-content" style = "padding:30px;">
                                    <div class="tab-pane active in">

                            <table id="table_announce" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                            <thead>
                                            <tr>
                                            <th class = "text-center" >#</th>
                                            <th>&nbsp;</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Date posted</th>
                                            <!-- <th>Action</th> -->
                                            </tr>
                                            </thead>


                                                <tbody>
                                                    
                                                    <?php 






                                                    $squery = mysqli_query($con, "SELECT * FROM tbl_announcement  ORDER BY announce_id DESC") or die('Error: ' . mysqli_error($con));

                                                     if(mysqli_num_rows($squery) > 0)
                                                            {
                                                                $x = 1;
                                                                
                                                                while($row = mysqli_fetch_array($squery))
                                                                {

                                                                    
                                                                    // $timestamp = strtotime($row['created_at']);
                                                                    // $new_date_format = date('F j, Y g:i:a', $timestamp);
                                                    
                                                    ?>
                                                
                                                        <tr>
                                                
                                                            <td class = "text-center" ><?= $x++ ?></td> 
                                                            <td class = "text-center">
                                                                <img id = "myImg" data-toggle="modal" data-target="#mymodal_img<?php echo $row['announce_id']; ?>" src="<?php echo $row['ann_images']; ?>" width="100" alt="">
<!-- Modal -->
<div class="modal fade" id="mymodal_img<?php echo $row['announce_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Announcement</h4>
      </div>
      <div class="modal-body">
      <img src="<?php echo $row['ann_images']; ?>" style = "width: 100%; max-width: 400px; height: auto;" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






   
                                                            </td>              
                                                            <td><?php echo $row['ann_title']; ?></td>     
                                                            <td><?php echo $row['ann_description']; ?></td>
                                                            <td><?php echo $row['ann_date_posted']; ?></td>                                                     
                                                            <!-- <td>
                                                              
                                                            <button type="button" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> View full details</button>
                                                               

                                                                
                                                            </td> -->
                                                          
                                                        
                                                        </tr>

                                                    <?php 

                                                                    }

                                                                }
                                                    
                                                    ?>
                                                    
                                                    </tbody>
                                        </table>

                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->

                         

                            
                                    <div class="box-header">
                                    <div style="padding:10px;">
                                        
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reqModal" style = "display:none"><i class="fa fa-user-plus" aria-hidden="true"></i> Request Clearance</button>  

                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    
                                <!-- <ul class="nav nav-tabs" id="myTab">
                                      <li class="active"><a data-target="#new" data-toggle="tab">New</a></li>
                                      <li><a data-target="#approved" data-toggle="tab">Approved</a></li>
                                      <li><a data-target="#disapproved" data-toggle="tab">Disapproved</a></li>
                                </ul> -->
                                <form method="post" style = "display:none">
                                 <div class="tab-content">
                                    <div id="new" class="tab-pane active in">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            
                                                <th>Purpose</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $squery = mysqli_query($con, "SELECT * FROM tblclearance p left join tblresident r on r.id = p.residentid where r.id = ".$_SESSION['userid']." and status = 'New' ") or die('Error: ' . mysqli_error($con));
                                            if(mysqli_num_rows($squery) > 0)
                                            {
                                                while($row = mysqli_fetch_array($squery))
                                                {
                                                    echo '
                                                    <tr>
                                                        <td>'.$row['purpose'].'</td>

                                                    </tr>
                                                    ';

                                                }
                                            }
                                            else{
                                                echo '
                                                <tr>
                                                <td colspan="5" style="text-align: center;">No record found</td>
                                                </tr>
                                                ';
                                            }

                                                    
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                    </div>

                                    <div id="approved" class="tab-pane ">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Clearance #</th>
                                                <th>Findings</th>
                                                <th>Purpose</th>
                                                <th>OR Number</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $squery = mysqli_query($con, "SELECT * FROM tblclearance p left join tblresident r on r.id = p.residentid where r.id = ".$_SESSION['userid']." and status = 'Approved' ") or die('Error: ' . mysqli_error($con));
                                            if(mysqli_num_rows($squery) > 0)
                                            {
                                                while($row = mysqli_fetch_array($squery))
                                                {
                                                    echo '
                                                    <tr>
                                                        <td>'.$row['clearanceNo'].'</td>
                                                        <td>'.$row['findings'].'</td>
                                                        <td>'.$row['purpose'].'</td>
                                                        <td>'.$row['orNo'].'</td>
                                                        <td>₱ '.number_format($row['samount'],2).'</td>
                                                    </tr>
                                                    ';

                                                }
                                            }
                                            else{
                                                echo '
                                                <tr>
                                                <td colspan="5" style="text-align: center;">No record found</td>
                                                </tr>
                                                ';
                                            }

                                                    
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                    </div>

                                    <div id="disapproved" class="tab-pane">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Findings</th>
                                                <th>Purpose</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $squery = mysqli_query($con, "SELECT * FROM tblclearance p left join tblresident r on r.id = p.residentid where r.id = ".$_SESSION['userid']." and status = 'Disapproved' ") or die('Error: ' . mysqli_error($con));
                                            if(mysqli_num_rows($squery) > 0)
                                            {
                                                while($row = mysqli_fetch_array($squery))
                                                {
                                                    echo '
                                                    <tr>
                                                        <td>'.$row['findings'].'</td>
                                                        <td>'.$row['purpose'].'</td>
                                                    </tr>
                                                    ';

                                                }
                                            }
                                            else{
                                                echo '
                                                <tr>
                                                <td colspan="5" style="text-align: center;">No record found</td>
                                                </tr>
                                                ';
                                            }

                                                    
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                    </div>

                                    </div>

                                    </form>
                                    <?php
                                    include "../duplicate_error.php";
                                    include "lengthstay_error.php";
                                    include "req_modal.php";
                                     include "function.php";
                                      ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                    </div>   <!-- /.row -->

                    <?php
                    }
                    ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
<script>
    $(document).ready(function() {
    $('#table_announce').DataTable({
    
        "columns":[
            {"data": "#"},
            {"data": "Full name"},
            {"data": "Form Type"},
            {"data": "Date Request"},
            {"data": "Status"}
          
        ]
    });
});


$(document).ready(function() {
    $('#table_announce_for_zone').DataTable({
    
        "columns":[
            {"data": "#"},
            {"data": "Full name"},
            {"data": "Form Type"},
            {"data": "Date Request"},
            {"data": "Status"},
            {"data": "Action"}
            
          
        ]
    });
});
</script>
        
        <?php }
        include "../footer.php"; ?>
<script type="text/javascript">

    <?php 
    if(!isset($_SESSION['staff']))
    {
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,7 ] } ],"aaSorting": []
            });
            $("#table1").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,3 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    else{
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 6 ] } ],"aaSorting": []
            });
            $("#table1").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 2 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    ?>

</script>

<style>
    #myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}


</style>
    </body>
</html>