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
                       RESIDENT AND HOUSEHOLD PROFILE
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


                
                    <div class="box"> 
                        
                    <h3>Profile</h3>

<?php
if (isset($_SESSION['popup_msg_member'])) {
   echo $_SESSION['popup_msg_member'];
   unset($_SESSION['popup_msg_member']);
}
$household_uk = $_GET['ID'];
$squery = mysqli_query($con, "SELECT * FROM tbl_resident_house_member WHERE household_uk = '$household_uk'") or die('Error: ' . mysqli_error($con));

// $squery = mysqli_query($con, "SELECT * FROM tbl_resident_new as table1  
// inner join tbl_resident_house_member as table2 on table1.household_member_uk = table2.household_uk  
// ") or die('Error: ' . mysqli_error($con));

 if(mysqli_num_rows($squery) > 0)
        {
            echo '<h4>Found household member: '.mysqli_num_rows($squery).'</h4>';

            $x = 1;
            
            while($row = mysqli_fetch_array($squery))
            {
?>
                                 <div class="row" style = "padding-top:10px; margin:10px; border: 2px solid gray; border-radius:10px;">
                                        <div class="col-md-4">
                                        <label for="Address">First name</label> 
                                        <input type="text" name = "u_address"  value = "<?= $row['f_name'] ?>" class="form-control" id="Address" readonly>
                                        </div>

                                        <div class="col-md-4">
                                        <label for="Address">Middle name</label> 
                                        <input type="text" name = "u_address"  value = "<?= $row['m_name'] ?>"  class="form-control" id="Address" readonly>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="Address">Last name</label> 
                                        <input type="text" name = "u_address"  value = "<?= $row['l_name'] ?>"  class="form-control" id="Address" readonly>
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label for="Birthdate">Birthdate</label>
                                        <input type="text" name = "birthdate"  value = "<?= $row['hmemberb_date'] ?>"  class="form-control" id="Birthdate" readonly>
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label for="hmember_occupation">Relationship</label>
                                        <input type="text" name = "hmember_occupation" class="form-control"  value = "<?= $row['hmember_relationship'] ?>"id="hmember_occupation" readonly>
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label for="hmember_occupation">Occupation</label>
                                        <input type="text" name = "hmember_occupation"   value = "<?= $row['hmember_occupation'] ?>" class="form-control" id="hmember_occupation"readonly>
                                        </div>

                                        <div class="form-group col-md-6">

                                            <button type="button" data-toggle="modal" data-target="#myModal_editmember<?= $row['household_id'] ?>" class = "btn btn-block btn-primary">EDIT</button>

                                        </div>

                                        <div class="form-group col-md-6">

                                        <button type="button" data-toggle="modal" data-target="#myModa_deletemember<?= $row['household_id'] ?>" class = "btn btn-block btn-danger">DELETE</button>

                                        </div>
                                 </div>


<!-- modal -->


<form action="edit_member.php" method="post">
<div class="modal fade" id="myModal_editmember<?= $row['household_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Member</h4>
      </div>
      <div class="modal-body">
        
                        <div class="row">
                        <input type="hidden" name = "household_id"  value = "<?= $row['household_id'] ?>" class="form-control" id="Address" readonly>
                        <input type="hidden" name = "household_uk"  value = "<?= $household_uk ?>" class="form-control" id="Address" readonly>

                        


                                        <div class="col-md-4">
                                        <label for="f_name">First name</label> 
                                        <input type="text" name = "f_name"  value = "<?= $row['f_name'] ?>" class="form-control" id="f_name" >
                                        </div>

                                        <div class="col-md-4">
                                        <label for="m_name">Middle name</label> 
                                        <input type="text" name = "m_name"  value = "<?= $row['m_name'] ?>"  class="form-control" id="m_name" >
                                        </div>
                                        <div class="col-md-4">
                                        <label for="l_name">Last name</label> 
                                        <input type="text" name = "l_name"  value = "<?= $row['l_name'] ?>"  class="form-control" id="l_name" >
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label for="hmemberb_date">Birthdate</label>
                                        <input type="date" name = "hmemberb_date"  value = "<?= $row['hmemberb_date'] ?>"  class="form-control" id="hmemberb_date" >
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label for="hmember_relationship">Relationship</label>
                                        <input type="text" name = "hmember_relationship" class="form-control"  value = "<?= $row['hmember_relationship'] ?>"id="hmember_relationship" >
                                        </div>

                                        <div class="form-group col-md-4">
                                        <label for="hmember_occupation">Occupation</label>
                                        <input type="text" name = "hmember_occupation"   value = "<?= $row['hmember_occupation'] ?>" class="form-control" id="hmember_occupation">
                                        </div>
                
                    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" name  ="updatemember" class="btn btn-primary">Save changes and Update</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- modal end -->



<!-- Modal -->
<form action="edit_member.php" method="post">

<div class="modal fade" id="myModa_deletemember<?= $row['household_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-body">

                    <h3 class = "text-center"> Are you sure you want to delete <?= $row['f_name'] ?> <?= $row['m_name'] ?> <?= $row['l_name'] ?>?</h3>

                        <div class="row">
                        <input type="hidden" name = "household_id"  value = "<?= $row['household_id'] ?>" class="form-control" id="Address" readonly>
                        <input type="hidden" name = "household_uk"  value = "<?= $household_uk ?>" class="form-control" id="Address" readonly>

                        


                                        <div class="col-md-4">
                                        <input type="hidden" name = "f_name"  value = "<?= $row['f_name'] ?>" class="form-control" id="f_name" >
                                        </div>

                                        <div class="col-md-4">
                                        <input type="hidden" name = "m_name"  value = "<?= $row['m_name'] ?>"  class="form-control" id="m_name" >
                                        </div>
                                        <div class="col-md-4">
                                        <input type="hidden" name = "l_name"  value = "<?= $row['l_name'] ?>"  class="form-control" id="l_name" >
                                        </div>


                                         <div class="col-md-6">
                                        <button type="button" class="btn btn-block btn-default" data-dismiss="modal">No</button>
                                        </div>
                                         <div class="col-md-6">
                                         <button type="submit" name  ="deletemember" class="btn btn-block btn-danger">Yes</button>
                                         </div>
                    </div>

      </div>
     
    </div>
  </div>
</div>

</form>





                                 <?php
            }

        }else{

            echo '<h3 class = "text-center">No household member found!</h3>';

        }

?>

                    </div> 
                

                    <div class="row" style ="display:none;">
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



                                   




                                    <form method="post" style = "display:none">
                                 <div class="tab-content" style = "padding-top:30px;">
                                    <div id="new" class="tab-pane active in">
                                        <table id="table_alluser" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                            <thead>
                                            <tr>
                                            <th class = "text-center" >#</th>
                                            <th>&nbsp;</th>
                                            <th>Account owner</th>
                                            <th>Username</th>
                                         
                                            <th>Action</th>
                                            </tr>
                                            </thead>


                                                <tbody>
                                                    
                                                    <?php 






                                                    $squery = mysqli_query($con, "SELECT * FROM tbl_resident_new
                                                     
                                                    ") or die('Error: ' . mysqli_error($con));

                                                    // $squery = mysqli_query($con, "SELECT * FROM tbl_resident_new as table1  
                                                    // inner join tbl_resident_house_member as table2 on table1.household_member_uk = table2.household_uk  
                                                    // ") or die('Error: ' . mysqli_error($con));

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
                                                            <td class = "text-center" >
                                                                <img src="../../pages/resident/image/<?= $row['profile_photo'] ?>" width = "80" alt="">
                                                            </td>             
                                                            <td>
                                                            <?php 
                                                            echo $row['f_name'].' '.$row['m_name'].' '.$row['l_name']; 
                                                            ?>
                                                            </td>     
                                                            <td><?php echo $row['username']; ?></td>

                                                            <td>
                                                                <a href="view_householdmember.php?ID=<?= $row['household_member_uk']; ?>" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> View member</a>
                                                            </td>
                                                          
                                                        
                                                        </tr>

                                                    <?php 

                                                                    }

                                                                }
                                                    
                                                    ?>
                                                    
                                                    </tbody>
                                        </table>

                                        </form>


                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


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
                                    <div class="box-header">
                                    <div style="padding:10px;">
                                        
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reqModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Request Clearance</button>  

                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <ul class="nav nav-tabs" id="myTab">
                                      <li class="active"><a data-target="#new" data-toggle="tab">New</a></li>
                                      <li><a data-target="#approved" data-toggle="tab">Approved</a></li>
                                      <li><a data-target="#disapproved" data-toggle="tab">Disapproved</a></li>
                                </ul>
                                <form method="post">
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
    $('#table_request').DataTable({
    
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


$(document).ready(function() {
    $('#table_alluser').DataTable({
    
        "columns":[
            {"data": "#"},
            {"data": " "},
            {"data": "Account owner"},
            {"data": "Username"},
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
    </body>
</html>