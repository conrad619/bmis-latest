
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
                        Request Form
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
                    { //here zone leader
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
                                             
                                            </tbody>
                                        </table>


                                    </form>

<?php 
//here

$request_id = $_GET['ID'];



$squery_new = mysqli_query($con, "SELECT form_table1.*,form_table2.*,form_table3.*,form_table4.*, form_table5.f_name as fname_acc_own, form_table5.l_name as lname_acc_own,form_table5.m_name as mname_acc_own 
FROM request_form_type as form_table1 
inner join request_form_information as form_table2 on form_table1.req_form_information_id = form_table2.req_form_information_id 
inner join form_type as form_table3 on form_table1.req_id = form_table3.req_id 
inner join tbl_resident_house_member as form_table4 on form_table2.house_member_id = form_table4.household_id
inner join tbl_resident_new as form_table5 on form_table2.user_id = form_table5.resident_id
WHERE form_table1.req_form_type_id  = '$request_id'
") or die('Error: ' . mysqli_error($con));

 if(mysqli_num_rows($squery_new) > 0)
        {


            


            $x = 1;
           
            while($row = mysqli_fetch_array($squery_new))
            {

                 $request_info_id = $row['req_form_information_id'];

                if ($row['status'] == 'Pending') {
                    $information_insert = mysqli_query($con,"UPDATE request_form_information set status = 'Process' WHERE req_form_information_id  = '$request_info_id'") or die('Error: ' . mysqli_error($con));
                }
                

                
                $timestamp = strtotime($row['created_at']);
                $new_date_format = date('F j, Y g:i:a', $timestamp);

                ?>

                <form>

                <?php 
                
                if (isset($_SESSION['pop_upmsg'])) {
                
                    echo $_SESSION['pop_upmsg'];

                    unset($_SESSION['pop_upmsg']);


                }
                
                
                
                ?>

                <h3>Credentials Information</h3>
                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="fname">First name</label>
                    <input type="text" name ="fname" value = "<?= $row['f_name'] ?>" class="form-control" id="fname" readonly>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="lname">Last name</label>
                    <input type="text" name ="lname"  value = "<?= $row['l_name'] ?>" class="form-control" id="lname" readonly>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="mname">Middle name</label>
                    <input type="text" name = "mname" value = "<?= $row['m_name'] ?>" class="form-control" id="mname" readonly>
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                    <label for="Address">Address</label>
                    <input type="text" name = "u_address" value = "<?= $row['address'] ?>" class="form-control" id="Address" readonly>
                    </div>
                
                    <div class="form-group col-md-4">
                    <label for="Birthdate">Birthdate</label>
                    <input type="text" name = "birthdate" value = "<?= $row['hmemberb_date'] ?>" class="form-control" id="Birthdate" readonly>
                    </div>

                    
                    <div class="form-group col-md-4">
                    <label for="hmember_occupation">Occupation</label>
                    <input type="text" name = "hmember_occupation" value = "<?= $row['hmember_occupation'] ?>" class="form-control" id="hmember_occupation" readonly>
                    </div>

                </div>

                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    <label for="acc_owner">Relationship</label>
                    <textarea name="" class="form-control" id="" cols="30" rows="2" readonly><?= $row['hmember_relationship'] ?> with <?= $row['fname_acc_own'].' '.$row['lname_acc_own'].' '.$row['mname_acc_own'] ?></textarea>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="request_status">Request status</label>
                  
                  
                  <?php 
                                                              
                                                              
                                                                
                                                              if ($row['status'] == 'Pending') {
                                                              
                                                                  echo '<h4><span class="label label-info">Pending...</span></h3>';


                                                              }
                                                              if ($row['status'] == 'Process') {
                                                              
                                                                  echo '<h4><span class="label label-primary">Processing...</span></h3>';


                                                              }

                                                              if ($row['status'] == 'ready_pick_up') {
                                                              
                                                                  echo '<h4><span class="label label-warning">Ready to pick up</span> On: <span style = "text-decoration:underline;">'.$row['schedule_pickup'].'</span></h3>';
                                                                  
                                                                  //with schedule

                                                              }

                                                              if ($row['status'] == 'completed') {

                                                                echo '<h4><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Completed</span></h3>';

                                                                }

                                                              if ($row['status'] == 'declined') {
                                                              
                                                                  echo '<h4><span class="label label-danger">Declined</span></h3>';


                                                              }

                                                              ?>
                                                              <br>
                    
                    </div>



                </div>

                
  <h3>Request Form Information</h3>

                <?php
              
                if ($row['req_id'] == 1) {
                    
                    ?>
               <!-- for Transportation of animal and slaughter -->
               <div class="form-group col-md-6">
                    <label for="Request_type">Request type</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                    </div>

                
                    <div class="form-group col-md-6">
                    <label for="Date_request">Date request</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                    </div>

                    <div class="form-group col-md-3">
                    <label for="Terms_of_living">Animal name</label>
                    <input type="text" name = "animal_name" value = "<?= $row['animal_name'] ?>" class="form-control" id="Terms_of_living" readonly>
                    </div>
                    <div class="form-group col-md-3">
                    <label for="Terms_of_living">Number of animal</label>
                    <input type="text" name = "num_animal" value = "<?= $row['num_animal'] ?>" class="form-control" id="Terms_of_living" readonly>
                    </div>
                    <div class="form-group col-md-3">
                    <label for="Terms_of_living">To:</label>
                    <input type="text" name = "sell_to" value = "<?= $row['sell_to'] ?>" class="form-control" id="Terms_of_living" readonly>
                    </div>
                    <div class="form-group col-md-3">
                    <label for="Terms_of_living">Address of Person</label>
                    <input type="text" name = "address_person" value = "<?= $row['address_person'] ?>" class="form-control" id="Terms_of_living" readonly>
                    </div>
                <!-- for Transportation of animal and slaughter end-->



                    <?php
                }

                if ($row['req_id'] == 2) {
                   ?>
                <!-- for Birth Certificate -->
                <div class="form-group col-md-6">
                <label for="inputZip">Request type:</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                </div>

                <div class="form-group col-md-6">
                <label for="inputZip">Date request:</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                </div>

                <div class="form-group col-md-6">
                <label for="father_name">Father's name:</label>
                <input type="text" value = "<?= $row['father_name'] ?>" name = "father_name" class="form-control" id="father_name" readonly>
                </div>

                <div class="form-group col-md-6">
                <label for="father_name">Father's Age:</label>
                <input type="text" value = "<?= $row['father_age'] ?>" name = "father_name" class="form-control" id="father_name" readonly>
                </div>

                
                <div class="form-group col-md-6">
                <label for="mother_name">Mother's name:</label>
                <input type="text" value = "<?= $row['mother_name'] ?>" name = "mother_name" class="form-control" id="mother_name" readonly>
                </div>

                <div class="form-group col-md-6">
                <label for="mother_name">Mother's Age:</label>
                <input type="text" value = "<?= $row['mother_age'] ?>" name = "mother_name" class="form-control" id="mother_name" readonly>
                </div>
            <!-- for birth certificate end-->
                   <?php
                }

                if ($row['req_id'] == 3) {
                   ?>
                 <!-- for Live-in Certificate -->
                 <div class="form-group col-md-6">
                    <label for="inputZip">Request type:</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                    </div>

                
                    <div class="form-group col-md-6">
                    <label for="inputZip">Date request:</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="Cedula">Full name of partner:</label>
                    <input type="text" value = "<?= $row['name_partner'] ?>" name = "dedula" class="form-control" id="Cedula" readonly>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="Cedula">Birth date:</label>
                    <input type="text" value = "<?= $row['bdate_partner'] ?>" name = "dedula" class="form-control" id="Cedula" readonly>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="Cedula">Living together:</label>
                    <input type="text" value = "<?= $row['num_living_together'].' '.$row['living_together'] ?>" name = "dedula" class="form-control" id="Cedula" readonly>
                    </div>

                <!-- for Live-in Certificate end-->
                   <?php
                }

                if ($row['req_id'] == 4) {
                    ?>
                    <!-- for Death Certificate -->
                    <div class="form-group col-md-6">
                    <label for="inputZip">Request type:</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="inputZip">Date request:</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="Place_of_Death">Place of Death:</label>
                    <input type="text"  value = "<?= $row['place_of_death'] ?>" name = "place_of_death" class="form-control" id="Place_of_Death" readonly>
                    </div>

                    
                    <div class="form-group col-md-6">
                    <label for="Day_of_the_deceased">Day of the deceased:</label>
                    <input type="text" value = "<?= $row['date_deceased'] ?>" name = "day_of_the_deceased" class="form-control" id="Day_of_the_deceased" readonly>
                    </div>
                <!-- for death certificate end-->
                    <?php
                }

                  // <!-- for Indigency -->
                  if ($row['req_id'] == 5) {
                    ?>
                     <div class="form-group col-md-6">
                     <label for="inputZip">Request type</label>
                     <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                     </div>
 
                 
                     <div class="form-group col-md-6">
                     <label for="inputZip">Date request</label>
                     <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                     </div>
                    <?php
                    
                 }
                 // <!-- for Indigency end-->
                // Certificate of low income 
                if ($row['req_id'] == 6) {
                    ?>

                    <!-- for Certificate of low income -->
                        <div class="form-group col-md-6">
                        <label for="inputZip">Request type:</label>
                        <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                        </div>

                    
                        <div class="form-group col-md-6">
                        <label for="inputZip">Date request:</label>
                        <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                        </div>

                    <!-- for Certificate of low income end-->

                    <?php
                    }
                    // Certificate of residency
                    if ($row['req_id'] == 7) {
                    ?>

                        <!-- for Certificate of residency -->
                        <div class="form-group col-md-4">
                        <label for="inputZip">Request type:</label>
                        <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                        </div>

                    
                        <div class="form-group col-md-4">
                        <label for="inputZip">Date request:</label>
                        <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                        </div>

                        <div class="form-group col-md-4">
                        <label for="inputZip">Term of Living:</label>
                        <input type="text" value = "<?=  $row['terms_of_living'] ?>" name = "terms_of_living" class="form-control" id="Date_request" readonly>
                        </div>

                    <!-- for Certificate of residency end-->


            <?php
            }
              if ($row['req_id'] == 8) {
                
            ?>
           
              <!-- for bBarangay Clearance -->
                    <div class="form-group col-md-4">
                    <label for="inputZip">Request type:</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                    </div>

                
                    <div class="form-group col-md-4">
                    <label for="inputZip">Date request:</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                    </div>

                    <div class="form-group col-md-4">
                    <label for="Cedula">Cedula No:</label>
                    <input type="text" value = "<?= $row['cedula_number'] ?>" name = "dedula" class="form-control" id="Cedula" readonly>
                    </div>
                <!-- for barangay clearance end-->
                   <?php
                }
                ?>  



           <div class="form-group col-md-12">
            <label for="Purpose">Purpose</label>
            <textarea name="" class="form-control" name = "purpose" id="Purpose" cols="10" rows="3" readonly><?= $row['purpose'] ?></textarea>
            </div>

           <!-- modal button -->

            <?php 


            if ($row['status'] == 'Pending') {
                                                                        
                echo ' <div class="form-group col-md-12">
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-block btn-primary">Approve</button>
    
                </div>';


            }
            if ($row['status'] == 'Process') {

                echo '<div class="form-group col-md-6">
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-block btn-primary">Approve</button>
    
                </div>
                <div class="form-group col-md-6">
                <button type="button" data-toggle="modal" data-target="#myModal_decline" class="btn btn-block btn-danger">Declined</button>
    
                </div>';


            }

            if ($row['status'] == 'ready_pick_up') {

                echo '<div class="form-group col-md-6">
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-block btn-warning">Reschedule</button>
                </div>
                <div class="form-group col-md-6">
                <button type="button" onclick="popuponclick()" class="btn btn-block btn-success">Complete and Print Request</button>
                </div>';
                
                //with schedule

            }

            if ($row['status'] == 'completed') {

                echo '
                <div class="form-group col-md-12">
                <button type="button" onclick="popuponclick()" class="btn btn-block btn-success">Print Again</button>
                </div>';
                
              

            }

            if ($row['status'] == 'declined') {

                // echo '<div class="form-group col-md-12">
                // <button type="button" class="btn btn-block btn-danger">Declined</button>
    
                // </div>';


            }

            
            
            ?>




        </form>

        <script type="text/javascript">

        function popuponclick() {
        newwindow=window.open('print_form.php?ID=<?= $request_id ?>','name','width=1500,height=1000');
        if (window.focus) {newwindow.focus()}
        return false;
        }
        </script>

<!-- Modal -->
<form action = "set_schedule.php" method="post">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Set schedule for pick up</h4>
      </div>
      <div class="modal-body">
     

      <input type="hidden" name = "request_id" class="form-control" value = "<?= $request_id ?>">
      <input type="hidden" name = "ready_pick_up" class="form-control" value = "ready_pick_up">

      <div class="input-group">
      <input type="hidden" name = "id_request_form" class="form-control" value = "<?= $row['req_form_information_id'] ?>">
        <span class="input-group-addon" id="basic-addon1">Month and Day</span>
        <input type="date" name = "date_schedule" class="form-control" placeholder="Date" aria-describedby="basic-addon1" required>
      </div>

     <br>
     <div class="input-group">
     <span class="input-group-addon" id="basic-addon2">Time</span>
        <input type="time" name = "time_schedule" class="form-control" placeholder="Time" aria-describedby="basic-addon2" required>
     </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" name = "set_now" class="btn btn-primary">Set now</button>
      </div>
    </div>
  </div>
</div>

</form>


<form action = "set_schedule.php" method="post">
<div class="modal fade" id="myModal_decline" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Declined</h4>
      </div>
      <div class="modal-body">
     

    
            <h3 style = "text-align:center;">Are you sure you want to Declined this request?</h3>
            <input type="hidden" name = "id_request_form" class="form-control" value = "<?= $row['req_form_information_id'] ?>">
            <input type="hidden" name = "request_id" class="form-control" value = "<?= $request_id ?>">

           

                 <div class = "row">   

                    <div class="form-group col-md-6">
                    <button type="button" class="btn btn-block btn-default" data-dismiss="modal">Cancel</button>
                    </div>

                    <div class="form-group col-md-6">
                    <button type="submit" name = "decline_now" class="btn btn-block btn-danger">Decline now</button>
                    </div>

                </div>
    
                <!-- <div class="btn-group" role="group" aria-label="...">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" name = "set_now" class="btn btn-primary">Set now</button>
                </div> -->

      </div>
     
    </div>
  </div>
</div>

</form>

        <!-- here -->
        
                <?php





               

            }


        }






?>




<!-- for indigency -->
<!-- purpose only -->
<!-- for indigency end-->




                                    <form method="post" style = "display:none">
                                 <div class="tab-content" style = "padding-top:30px;">
                                    <div id="new" class="tab-pane active in">
                                        <table id="table_request" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                            <thead>
                                            <tr>
                                            <th class = "text-center" >#</th>
                                            <th>Full name</th>
                                            <th>Form Type</th>
                                            <th>Date Request</th>
                                            <th>Action</th>
                                            </tr>
                                            </thead>


                                                <tbody>
                                                    
                                                    <?php 






                                                    $squery = mysqli_query($con, "SELECT * FROM request_form_type as form_table1 
                                                    inner join request_form_information as form_table2 on form_table1.req_form_information_id = form_table2.req_form_information_id 
                                                    inner join form_type as form_table3 on form_table1.req_id = form_table3.req_id
                                                    ") or die('Error: ' . mysqli_error($con));

                                                     if(mysqli_num_rows($squery) > 0)
                                                            {
                                                                $x = 1;
                                                                
                                                                while($row = mysqli_fetch_array($squery))
                                                                {

                                                                    
                                                                    $timestamp = strtotime($row['created_at']);
                                                                    $new_date_format = date('F j, Y g:i:a', $timestamp);
                                                    
                                                    ?>
                                                
                                                        <tr>
                                                
                                                            <td class = "text-center" ><?= $x++ ?></td>               
                                                            <td><?php echo $row['first_name'].' '. $row['last_name']; ?></td>     
                                                            <td><?php echo $row['request_type']; ?></td>
                                                            <td><?php echo $new_date_format; ?></td>
                                                            <td>
                                                                <a href="view_request.php?ID=<?= $row['req_form_type_id']; ?>" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> View details</a>
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
                                   
                                <div class="box-body table-responsive">
                              

                                <?php 
//here

$request_id = $_GET['ID'];



$squery_new = mysqli_query($con, "SELECT form_table1.*,form_table2.*,form_table3.*,form_table4.*, form_table5.f_name as fname_acc_own, form_table5.l_name as lname_acc_own,form_table5.m_name as mname_acc_own 
FROM request_form_type as form_table1 
inner join request_form_information as form_table2 on form_table1.req_form_information_id = form_table2.req_form_information_id 
inner join form_type as form_table3 on form_table1.req_id = form_table3.req_id 
inner join tbl_resident_house_member as form_table4 on form_table2.house_member_id = form_table4.household_id
inner join tbl_resident_new as form_table5 on form_table2.user_id = form_table5.resident_id
WHERE form_table1.req_form_type_id  = '$request_id'
") or die('Error: ' . mysqli_error($con));

 if(mysqli_num_rows($squery_new) > 0)
        {


            


            $x = 1;
           
            while($row = mysqli_fetch_array($squery_new))
            {

                //  $request_info_id = $row['req_form_information_id'];
                //  $information_insert = mysqli_query($con,"UPDATE request_form_information set status = 'Process' WHERE req_form_information_id  = '$request_info_id'") or die('Error: ' . mysqli_error($con));

                
                $timestamp = strtotime($row['created_at']);
                $new_date_format = date('F j, Y g:i:a', $timestamp);

                ?>

                <form>
                <h3>Credentials Information</h3>
                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="fname">First name</label>
                    <input type="text" name ="fname" value = "<?= $row['f_name'] ?>" class="form-control" id="fname" readonly>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="lname">Last name</label>
                    <input type="text" name ="lname"  value = "<?= $row['l_name'] ?>" class="form-control" id="lname" readonly>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="mname">Middle name</label>
                    <input type="text" name = "mname" value = "<?= $row['m_name'] ?>" class="form-control" id="mname" readonly>
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                    <label for="Address">Address</label>
                    <input type="text" name = "u_address" value = "<?= $row['address'] ?>" class="form-control" id="Address" readonly>
                    </div>
                
                    <div class="form-group col-md-4">
                    <label for="Birthdate">Birthdate</label>
                    <input type="text" name = "birthdate" value = "<?= $row['hmemberb_date'] ?>" class="form-control" id="Birthdate" readonly>
                    </div>

                    
                    <div class="form-group col-md-4">
                    <label for="hmember_occupation">Occupation</label>
                    <input type="text" name = "hmember_occupation" value = "<?= $row['hmember_occupation'] ?>" class="form-control" id="hmember_occupation" readonly>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="acc_owner">Relationship</label>
                        <input type="text" name = "relationship_with" value = "<?= $row['hmember_relationship'] ?>" class="form-control" id="acc_owner" readonly>


                    </div>

                    <div class="form-group col-md-6">
                    <label for="request_status">Request status</label>
                  
                  
                    <?php 
                                                                
                                                                
                                                                  
                                                                if ($row['status'] == 'Pending') {
                                                                
                                                                    echo '<h4><span class="label label-info">Pending...</span></h3>';


                                                                }
                                                                if ($row['status'] == 'Process') {
                                                                
                                                                    echo '<h4><span class="label label-primary">Processing...</span></h3>';


                                                                }

                                                                if ($row['status'] == 'ready_pick_up') {
                                                                
                                                                    echo '<h4><span class="label label-warning">Ready to pick up</span>  On: <span style = "text-decoration:underline;">'.$row['schedule_pickup'].'</span></h3>';
                                                                    //with schedule

                                                                }

                                                                if ($row['status'] == 'completed') {

                                                                    echo '<h4><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Completed</span></h3>';
    
                                                                    }

                                                                if ($row['status'] == 'declined') {
                                                                
                                                                    echo '<h4><span class="label label-danger">Declined</span></h3>';


                                                                }

                                                                ?>

                    </div>


                </div>
  <h3>Request Form Information</h3>

                <?php
              
                if ($row['req_id'] == 1) {
                    
                    ?>
                <!-- for Transportation of animal and slaughter -->
                    <div class="form-group col-md-6">
                    <label for="Request_type">Request type</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                    </div>

                
                    <div class="form-group col-md-6">
                    <label for="Date_request">Date request</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                    </div>

                    <div class="form-group col-md-3">
                    <label for="Terms_of_living">Animal name</label>
                    <input type="text" name = "animal_name" value = "<?= $row['animal_name'] ?>" class="form-control" id="Terms_of_living" readonly>
                    </div>
                    <div class="form-group col-md-3">
                    <label for="Terms_of_living">Number of animal</label>
                    <input type="text" name = "num_animal" value = "<?= $row['num_animal'] ?>" class="form-control" id="Terms_of_living" readonly>
                    </div>
                    <div class="form-group col-md-3">
                    <label for="Terms_of_living">To:</label>
                    <input type="text" name = "sell_to" value = "<?= $row['sell_to'] ?>" class="form-control" id="Terms_of_living" readonly>
                    </div>
                    <div class="form-group col-md-3">
                    <label for="Terms_of_living">Address of Person</label>
                    <input type="text" name = "address_person" value = "<?= $row['address_person'] ?>" class="form-control" id="Terms_of_living" readonly>
                    </div>
                <!-- for Transportation of animal and slaughter end-->


                    <?php
                }


                // <!-- for Indigency -->
                if ($row['req_id'] == 5) {
                   ?>
                    <div class="form-group col-md-6">
                    <label for="inputZip">Request type</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                    </div>

                
                    <div class="form-group col-md-6">
                    <label for="inputZip">Date request</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                    </div>
                   <?php
                   
                }
                // <!-- for Indigency end-->

                if ($row['req_id'] == 4) {
                   ?>
                <!-- for Death Certificate -->
                    <div class="form-group col-md-6">
                    <label for="inputZip">Request type:</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="inputZip">Date request:</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="Place_of_Death">Place of Death:</label>
                    <input type="text"  value = "<?= $row['place_of_death'] ?>" name = "place_of_death" class="form-control" id="Place_of_Death" readonly>
                    </div>

                    
                    <div class="form-group col-md-6">
                    <label for="Day_of_the_deceased">Day of the deceased:</label>
                    <input type="text" value = "<?= $row['date_deceased'] ?>" name = "day_of_the_deceased" class="form-control" id="Day_of_the_deceased" readonly>
                    </div>
                <!-- for death certificate end-->
                   <?php
                }

                if ($row['req_id'] == 2) {
                    ?>
            <!-- for Birth Certificate -->
                <div class="form-group col-md-6">
                <label for="inputZip">Request type:</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                </div>

                <div class="form-group col-md-6">
                <label for="inputZip">Date request:</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                </div>

                <div class="form-group col-md-6">
                <label for="father_name">Father's name:</label>
                <input type="text" value = "<?= $row['father_name'] ?>" name = "father_name" class="form-control" id="father_name" readonly>
                </div>

                <div class="form-group col-md-6">
                <label for="father_name">Father's Age:</label>
                <input type="text" value = "<?= $row['father_age'] ?>" name = "father_name" class="form-control" id="father_name" readonly>
                </div>

                
                <div class="form-group col-md-6">
                <label for="mother_name">Mother's name:</label>
                <input type="text" value = "<?= $row['mother_name'] ?>" name = "mother_name" class="form-control" id="mother_name" readonly>
                </div>

                <div class="form-group col-md-6">
                <label for="mother_name">Mother's Age:</label>
                <input type="text" value = "<?= $row['mother_age'] ?>" name = "mother_name" class="form-control" id="mother_name" readonly>
                </div>
            <!-- for birth certificate end-->
                    <?php
                }

                if ($row['req_id'] == 8) {
                   ?>
                <!-- for bBarangay Clearance -->
                    <div class="form-group col-md-4">
                    <label for="inputZip">Request type:</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                    </div>

                
                    <div class="form-group col-md-4">
                    <label for="inputZip">Date request:</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                    </div>

                    <div class="form-group col-md-4">
                    <label for="Cedula">Cedula No:</label>
                    <input type="text" value = "<?= $row['cedula_number'] ?>" name = "dedula" class="form-control" id="Cedula" readonly>
                    </div>
                <!-- for barangay clearance end-->
                   <?php
                }


              
                // Live-in Certificate 
                if ($row['req_id'] == 3) {
                ?>

                 <!-- for Live-in Certificate -->
                    <div class="form-group col-md-6">
                    <label for="inputZip">Request type:</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                    </div>

                
                    <div class="form-group col-md-6">
                    <label for="inputZip">Date request:</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="Cedula">Full name of partner:</label>
                    <input type="text" value = "<?= $row['name_partner'] ?>" name = "dedula" class="form-control" id="Cedula" readonly>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="Cedula">Birth date:</label>
                    <input type="text" value = "<?= $row['bdate_partner'] ?>" name = "dedula" class="form-control" id="Cedula" readonly>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="Cedula">Living together:</label>
                    <input type="text" value = "<?= $row['num_living_together'].' '.$row['living_together'] ?>" name = "dedula" class="form-control" id="Cedula" readonly>
                    </div>

                <!-- for Live-in Certificate end-->

                <?php
                }
             
                // Certificate of low income 
                 if ($row['req_id'] == 6) {
                ?>

                 <!-- for Certificate of low income -->
                     <div class="form-group col-md-6">
                    <label for="inputZip">Request type:</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                    </div>

                
                    <div class="form-group col-md-6">
                    <label for="inputZip">Date request:</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                    </div>

                <!-- for Certificate of low income end-->

                <?php
                }
                // Certificate of residency
                if ($row['req_id'] == 7) {
                ?>

                    <!-- for Certificate of residency -->
                    <div class="form-group col-md-4">
                    <label for="inputZip">Request type:</label>
                    <input type="text" value = "<?= $row['request_type'] ?>" name = "request_type" class="form-control" id="Request_type" readonly>
                    </div>

                
                    <div class="form-group col-md-4">
                    <label for="inputZip">Date request:</label>
                    <input type="text" value = "<?=  $new_date_format ?>" name = "date_request" class="form-control" id="Date_request" readonly>
                    </div>

                    <div class="form-group col-md-4">
                    <label for="inputZip">Term of Living:</label>
                    <input type="text" value = "<?=  $row['terms_of_living'] ?>" name = "terms_of_living" class="form-control" id="Date_request" readonly>
                    </div>

                <!-- for Certificate of residency end-->


                <?php
                }
                ?>

        <div class="form-group col-md-12">
            <label for="Purpose">Purpose</label>
            <textarea name="" class="form-control" name = "purpose" id="Purpose" cols="10" rows="3" readonly><?= $row['purpose'] ?></textarea>
            </div>

          

        </form>

        <!-- here -->
                <?php





               

            }


        }






?>
                                  


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