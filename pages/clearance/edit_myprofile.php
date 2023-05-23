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
                        MY PERSONAL INFORMATION
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
                                
                                <form method="post">                                        
                                        <table id="table" class="table table-bordered table-striped">
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
                                                $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'New'") or die('Error: ' . mysqli_error($con));
                                                while($row = mysqli_fetch_array($squery))
                                                {
                                                    echo '
                                                    <tr>
                                                        <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['pid'].'" /></td>
                                                        <td>'.$row['residentname'].'</td>
                                                        <td>'.$row['purpose'].'</td>
                                                        <td>
                                                            <button class="btn btn-success btn-sm" data-target="#approveModal'.$row['pid'].'" data-toggle="modal"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Approve</button>
                                                            <button class="btn btn-danger btn-sm" data-target="#disapproveModal'.$row['pid'].'" data-toggle="modal"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Disapprove</button>
                                                        </td>
                                                    </tr>
                                                    ';
                                                    include "approve_modal.php";
                                                    include "disapprove_modal.php";
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




<?php




    $user = mysqli_query($con,"SELECT * from tbl_resident_new where resident_id  = '".$_SESSION['userid']."' ");

    if(mysqli_num_rows($user) > 0)
       {
           $row_user = $user->fetch_assoc();

       
?>


<form action="edit_personalinfo.php" method="post">

                        <div class="row" style = "margin:10px;">
                            <div class="box">

                        <div class="row">

                            <div class="form-group col-md-4">
                            <label for="f_name_mainuser">First name</label>
                            <input type="text" name = "f_name_mainuser"  class="form-control" id="f_name_mainuser" value = "<?= $row_user['f_name']?>">
                            </div>


                            <div class="form-group col-md-4">
                            <label for="m_name_mainuser">Middle name</label>
                            <input type="text" name = "m_name_mainuser" class="form-control" id="m_name_mainuser" value = "<?= $row_user['m_name']?>">
                            </div>


                            <div class="form-group col-md-4">
                            <label for="l_name_mainuser">Last name</label>
                            <input type="text" name = "l_name_mainuser" class="form-control" id="l_name_mainuser" value = "<?= $row_user['l_name']?>">
                            </div>


                        </div>

                        <div class="row">

                            <div class="form-group col-md-4">
                            <label for="email_mainuser">Email</label>
                            <input type="email" name = "email_mainuser"  class="form-control" id="email_mainuser" value = "<?= $row_user['email']?>">
                            </div>

                            
                            <div class="form-group col-md-4">
                            <label for="contactno_mainuser">Contact NO</label>
                            <input type="number" name = "contactno_mainuser" class="form-control" id="contactno_mainuser" value = "<?= $row_user['contact_no']?>">
                            </div>


                            <div class="form-group col-md-4">
                            <label for="address_mainuser">Address</label>
                            <input type="text" name = "address_mainuser" class="form-control" id="address_mainuser" value = "<?= $row_user['address']?>">
                            </div>
                            

                        </div>


                        <div class="row">

                    
                            <div class="form-group col-md-4">
                            <!-- <input type="text" name = "birthdate" class="form-control" id="Birthdate" value = "<?//= $row_user['status']?>"> -->
                                   
                            <label class="control-label" >Status</label>
                                                    <select  class="form-control upper" name = "status_mainuser" id= "status_signup"required>
                                                    <?php
                                            $all_status = array("Single", "Married", "Live-in Partner", "Widow", "Solo Parent");
                                                foreach ($all_status as $value_status) { 

                                                    if ($value_status == $row_user['status']) {
                                                       echo '<option value = "'.$row_user['status'].'" selected>'.$row_user['status'].'</option>
                                                       ';
                                                    }else{
                                                        echo '                                                    <option value = "'.$value_status.'">'.$value_status.'</option>
                                                        ';
                                                    }

                                                }
                                                ?>
                                                    
                                    

                                                    </select>
                            
                            </div>

                            <div class="form-group col-md-4">
                            <label for="culturalcom_mainuser">Cultural Community <span style = "color:red">(Please specify)</span></label>
                            <input type="text" name = "culturalcom_mainuser" class="form-control" id="culturalcom_mainuser" value = "<?= $row_user['specify_belongings']?>">
                            </div>

                           
                        </div>
                        

                        <div class="row">

                            <div class="form-group col-md-4">
                            <label for="full_name_spouse">Full name Spouse</label> 
                            <input type="text" name = "full_name_spouse"  class="form-control" id="full_name_spouse" value = "<?= $row_user['fullname_spouse']?>" required>
                            </div>

                            <div class="form-group col-md-4">
                            <label for="bday_spouse">Spouse birthdate</label>
                            <input type="date" name = "bday_spouse" class="form-control" id="bday_spouse" value = "<?= $row_user['bday_spouse']?>" required>
                            </div>

                            <div class="form-group col-md-4">
                            <label for="occu_spouse">Spouse Occupation</label>
                            <input type="text" name = "occu_spouse" class="form-control" id="occu_spouse" value = "<?= $row_user['occu_spouse']?>" required>
                            </div>

                        </div>

                        
                        <div class="row">


                        <?php if ($row_user['residence_status'] == 'Other') { ?>

                            <div class="form-group col-md-4">
                            <label for="residence_mainuser">Residence status</label> 
                            <input type="text" name = "residence_mainuser"  class="form-control" id="residence_mainuser" value = "<?= $row_user['specify_resident_stat']?>">
                            </div>

                           
                        <?php }else{?>

                            <div class="form-group col-md-4">
                            <label for="residence_mainuser">Residence status</label> 
                            <input type="text" name = "residence_mainuser"  class="form-control" id="residence_mainuser" value = "<?= $row_user['residence_status']?>">
                            </div>

                        <?php }?>

                            <div class="form-group col-md-4">
                            <label for="pwd_mainuser">Living with person with disability (PWD)</label>
                            <!-- <input type="text" name = "birthdate" class="form-control" id="Birthdate" value = "<?= $row_user['pwd']?>"> -->

                            <select   class="form-control" name="pwd_mainuser" id="pwd_mainuser">
                                <?php    $PWD = array("Yes", "No");
                                        foreach ($PWD as $value_PWD) { 


                                            if ($value_PWD == $row_user['pwd']) {
                                                echo '<option value="'.$row_user['pwd'].'" selected>'.$row_user['pwd'].'</option>';
                                            }else{
                                                echo '<option value="'.$value_PWD.'">'.$value_PWD.'</option>';
                                            }

                                        }?>
                               
                            </select>



                            </div>

                            <div class="form-group col-md-4">
                            <label for="registervoter_mainuser">Register voter</label>
                            <!-- <input type="text" name = "hmember_occupation" class="form-control" id="hmember_occupation" value = "<?= $row_user['register_voter']?>"> -->
                            <select   class="form-control" name="registervoter_mainuser" id="registervoter_mainuser">
                            <?php    $voter = array("Yes", "No");
                                        foreach ($voter as $value_voter) { 


                                            if ($value_voter == $row_user['pwd']) {
                                                echo '<option value="'.$row_user['register_voter'].'" selected>'.$row_user['register_voter'].'</option>';
                                            }else{
                                                echo '<option value="'.$value_voter.'">'.$value_voter.'</option>';
                                            }

                                        }?>
                            </select>


                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group col-md-4">
                            <label for="benificiary_mainuser">4p's/ IP's Benificiary <span style = "color:red">(Please specify)</span></label> 
                            <input type="text" name = "benificiary_mainuser"  class="form-control" id="benificiary_mainuser" value = "<?= $row_user['specify_benificiary']?>">
                            </div>

                            <div class="form-group col-md-4">
                            <label for="pensioner_mainuser">Pensioner <span style = "color:red">(Please specify)</span></label>
                            <input type="text" name = "pensioner_mainuser" class="form-control" id="pensioner_mainuser" value = "<?= $row_user['specify_pensioner']?>">
                            </div>

                            <div class="form-group col-md-4">
                            <label for="income_mainuser">Estimated Monthly Income</label>
                            <input type="number" name = "income_mainuser" class="form-control" id="income_mainuser" value = "<?= $row_user['income_month'] ?>">
                            </div>

                        </div>

                        <div class="row">

                        <div class="form-group col-md-4">
                        <label for="fullname_hholdhead">Full name Household head</label> 
                        <input type="text" name = "fullname_hholdhead"  class="form-control" id="fullname_hholdhead" value = "<?= $row_user['fullname_hhead']?>">
                        </div>

                        <div class="form-group col-md-4">
                        <label for="Birthdate">Birthdate Household head</label>
                        <input type="text" name = "birthdate_hholdhead" class="form-control" id="Birthdate" value = "<?= $row_user['bday_hhead']?>">
                        </div>

                        <div class="form-group col-md-4">
                        <label for="occupation_hholdhead">Occupation Household head</label>
                        <input type="text" name = "occupation_hholdhead" class="form-control" id="occupation_hholdhead" value = "<?= $row_user['occu_hhead']?>">
                        </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">

                                <button  onclick="popuponclick()" type = "button" class = "btn btn-primary btn-block">Cancel</button>

                            </div>

                            <input type="hidden" name = "resident_id" class="form-control" id="occupation_hholdhead" value = "<?= $row_user['resident_id']?>">

                            <div class="form-group col-md-6">

                                <button type = "submit" name = "update_save" class = "btn btn-success btn-block">Update & Save</button>

                            </div>
                        </div>



                            </div>                                
                        </div><!-- /. my personal information -->

                        <script type='text/javascript'>
        
        function popuponclick() {
        location.href = 'myprofile.php?ID=<?= $row_user["resident_id"] ?>';
        }



//         full_name_spouse
// bday_spouse
// occu_spouse
$('#status_signup').on('change', function() {
    //alert( $(this).find(":selected").val() );
    var selected = $(this).find(":selected").val();
    if (selected == 'Married' || selected == 'Live-in Partner') {

      //$("#append-status").removeClass('d-none');

      $("#full_name_spouse").val("");
      $("#bday_spouse").val("2022-01-01");
      $("#occu_spouse").val("");
     



    }else if(selected == 'Single' || selected == 'Widow' || selected == 'Solo Parent'){

       

      $("#full_name_spouse").val("none");
      $("#bday_spouse").val("none");
      $("#occu_spouse").val("none");
      document.getElementById("full_name_spouse").disabled = true;
      document.getElementById("bday_spouse").disabled = true;
      document.getElementById("occu_spouse").disabled = true;
    

    }

  });        


        
        </script>

</form>
                        

                        
                        <section class="content-header" style = "display:none" >
                            <h3>
                            MY HOUSEHOLD PROFILE
                            </h3>   
                        </section>

                     
                            <div class="box" style = "padding-top:10px; display:none" >


                            <?php
    $user = mysqli_query($con,"SELECT * from tbl_resident_house_member where household_uk  = '".$row_user['household_member_uk']."' ");

    if(mysqli_num_rows($user) > 0)
       {
           //$row_user = $user->fetch_assoc();

           while($row_member = mysqli_fetch_array($user)){
           
?>
                                <div class="row" style = "padding-top:10px; margin:10px; border: 2px solid gray; border-radius:10px;">
                                        <div class="col-md-3">
                                        <label for="Address">Full name</label> 
                                        <input type="text" name = "u_address"  class="form-control" id="Address" value = "<?= $row_member['f_name']?> <?= $row_member['m_name']?> <?= $row_member['l_name']?>" readonly>
                                        </div>

                                        <div class="form-group col-md-3">
                                        <label for="Birthdate">Birthdate</label>
                                        <input type="text" name = "birthdate" class="form-control" id="Birthdate" value = "<?= $row_member['hmemberb_date']?>" readonly>
                                        </div>

                                        <div class="form-group col-md-3">
                                        <label for="hmember_occupation">Relationship</label>
                                        <input type="text" name = "hmember_occupation" class="form-control" id="hmember_occupation" value = "<?= $row_member['hmember_relationship']?>" readonly>
                                        </div>

                                        <div class="form-group col-md-3">
                                        <label for="hmember_occupation">Occupation</label>
                                        <input type="text" name = "hmember_occupation"  value = "<?= $row_member['hmember_occupation']?>" class="form-control" id="hmember_occupation" readonly>
                                        </div>
                                </div>

                                <?php 
                                
                            }

                        }else{

                            echo ' <h3>
                               Living alone
                            </h3>  ';
                            
                        }
                                ?>

                            </div>                                
                      

<?php } ?>

                    <div class="row" style = "display:none;">
                        <!-- left column -->
                            <div class="box">
                                    <div class="box-header">
                                    <div style="padding:10px;">
                                        
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal1"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Request</button>  

                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <ul class="nav nav-tabs" id="myTab">
                                      <li class="active"><a data-target="#all" data-toggle="tab">All</a></li>
                                      <!-- <li><a data-target="#Pending" data-toggle="tab">Pending</a></li>
                                      <li><a data-target="#Processing" data-toggle="tab">Processing</a></li>
                                      <li><a data-target="#Ready_for_pickup" data-toggle="tab">Ready for pickup</a></li>
                                      <li><a data-target="#Completed" data-toggle="tab">Completed</a></li>
                                      <li><a data-target="#Declined" data-toggle="tab">Declined</a></li> -->
                                </ul>
                                <style>
                                    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {

                                    color:none;
                                    border: none;
                                    background-color: none;
                                    background: none;
                                    background: none;
                                    background: none;
                                    background: none;
                                    background: none;
                                    background: none;


                                    }
                                </style>
                                <form method="post">
                                 <div class="tab-content" style = "padding-top:30px;">
                                    <div id="all" class="tab-pane active in">
                                        <table id="table_request1" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                            <thead>
                                            <tr>
                                            <th class = "text-center" >#</th>
                                            <th>Full name</th>
                                            <th>Request Form</th>
                                            <th>Date Request</th>
                                            <th>Request status</th>
                                            <th>Action</th>
                                            </tr>
                                            </thead>


                                                <tbody>
                                                    
                                                    <?php 






                                                    $squery = mysqli_query($con, "SELECT * FROM request_form_type as form_table1 
                                                    inner join request_form_information as form_table2 on form_table1.req_form_information_id = form_table2.req_form_information_id 
                                                    inner join form_type as form_table3 on form_table1.req_id = form_table3.req_id
                                                    inner join tbl_resident_house_member as form_table4 on form_table2.house_member_id = form_table4.household_id
                                                    where form_table2.user_id = ".$_SESSION['userid']."") or die('Error: ' . mysqli_error($con));

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
                                                            <td><?php echo $row['f_name'].' '.$row['l_name']; ?></td>                     
                                                            <td><?php echo $row['request_type']; ?></td>
                                                            <td><?php echo $new_date_format; ?></td>
                                                            <td>
                                                                <?php 
                                                                
                                                                
                                                                  
                                                                if ($row['status'] == 'Pending') {
                                                                
                                                                    echo '<h4><span class="label label-info">Pending...</span></h3>';


                                                                }
                                                                if ($row['status'] == 'Process') {
                                                                
                                                                    echo '<h4><span class="label label-primary">Processing...</span></h3>';


                                                                }

                                                                if ($row['status'] == 'ready_pick_up') {
                                                                
                                                                    echo '<h4><span class="label label-warning">Ready to pick up</span></h3>';
                                                                    //with schedule

                                                                }

                                                                if ($row['status'] == 'completed') {

                                                                    echo '<h4><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Completed</span></h3>';

                                                                }

                                                                if ($row['status'] == 'declined') {
                                                                
                                                                    echo '<h4><span class="label label-danger">Declined</span></h3>';


                                                                }

                                                                ?>
                                                             </td>
                                                            <td>
                                                                <a href="view_request.php?ID=<?= $row['req_form_type_id'] ?>" class="btn btn-primary"><i class="fa fa-search"></i> View details</a>
                                                            </td>
                                                          
                                                        
                                                        </tr>

                                                    <?php 

                                                                    }

                                                                }
                                                                
                                                    
                                                    ?>



                                                    
                                                    </tbody>
                                        </table>

                                    <!-- <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            
                                                <th>Purpose</th>
                                               

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // $squery = mysqli_query($con, "SELECT * FROM tblclearance p left join tblresident r on r.id = p.residentid where r.id = ".$_SESSION['userid']." and status = 'New' ") or die('Error: ' . mysqli_error($con));
                                            // if(mysqli_num_rows($squery) > 0)
                                            // {
                                            //     while($row = mysqli_fetch_array($squery))
                                            //     {
                                            //         echo '
                                            //         <tr>
                                            //             <td>'.$row['purpose'].'</td>

                                            //         </tr>
                                            //         ';

                                            //     }
                                            // }
                                            // else{
                                            //     echo '
                                            //     <tr>
                                            //     <td colspan="5" style="text-align: center;">No record found diri</td>
                                            //     </tr>
                                            //     ';
                                             
                                            // }
                                            // Pending
                                            // Processing
                                            // Ready_for_pickup
                                            // Completed
                                            // Declined

                                            //table 
                                            // table_request_pending
                                            // table_request_process
                                            // table_request_completed
                                            // table_request_declined
                                                    
                                            ?>
                                            
                                        </tbody>
                                    </table> -->
                                    </div>
                                    <div id="Pending" class="tab-pane ">
                                    <table id="table_request_pending" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class = "text-center" >#</th>
                                                    <th>Full name</th>
                                                    <th>Request Form</th>
                                                    <th>Date Request</th>
                                                    <th>Request status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>

                                             <?php

                                            $squery_2 = mysqli_query($con, "SELECT * FROM request_form_type as form_table1 
                                            inner join request_form_information as form_table2 on form_table1.req_form_information_id = form_table2.req_form_information_id 
                                            inner join form_type as form_table3 on form_table1.req_id = form_table3.req_id
                                            inner join tbl_resident_house_member as form_table4 on form_table2.house_member_id = form_table4.household_id
                                            where form_table2.user_id = ".$_SESSION['userid']." AND status = 'Pending'") or die('Error: ' . mysqli_error($con));


                                             if(mysqli_num_rows($squery_2) > 0)
                                             {
                                                 $x = 1;
                                                 
                                                 while($row = mysqli_fetch_array($squery_2))
                                                 {

                                                     
                                                     $timestamp = strtotime($row['created_at']);
                                                     $new_date_format = date('F j, Y g:i:a', $timestamp);
                                     
                                     ?>
                                 
                                         <tr>
                                 
                                             <td class = "text-center" ><?= $x++ ?></td> 
                                             <td><?php echo $row['f_name'].' '.$row['l_name']; ?></td>                     
                                             <td><?php echo $row['request_type']; ?></td>
                                             <td><?php echo $new_date_format; ?></td>
                                             <td>
                                                 <?php 
                                                 
                                                 
                                                   
                                                 if ($row['status'] == 'Pending') {
                                                 
                                                     echo '<h4><span class="label label-info">Pending...</span></h3>';


                                                 }
                                                 if ($row['status'] == 'Process') {
                                                 
                                                     echo '<h4><span class="label label-primary">Processing...</span></h3>';


                                                 }

                                                 if ($row['status'] == 'ready_pick_up') {
                                                 
                                                     echo '<h4><span class="label label-warning">Ready to pick up</span></h3>';
                                                     //with schedule

                                                 }

                                                 if ($row['status'] == 'declined') {
                                                 
                                                     echo '<h4><span class="label label-danger">Declined</span></h3>';


                                                 }

                                                 ?>
                                              </td>
                                             <td>
                                                 <a href="view_request.php?ID=<?= $row['req_form_type_id'] ?>" class="btn btn-primary"><i class="fa fa-search"></i> View details</a>
                                             </td>
                                           
                                         
                                         </tr>

                                     <?php 

                                                     }

                                                 }
                                                 
                                     
                                     ?>
                                            
                                            </tbody>
                                                    
                                    </table>

                                    </div>

                                    <div id="Processing" class="tab-pane ">
                                    <table id="table_request_process" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class = "text-center" >#</th>
                                                    <th>Full name</th>
                                                    <th>Request Form</th>
                                                    <th>Date Request</th>
                                                    <th>Request status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>

                                             <?php

                                            $squery_3 = mysqli_query($con, "SELECT * FROM request_form_type as form_table1 
                                            inner join request_form_information as form_table2 on form_table1.req_form_information_id = form_table2.req_form_information_id 
                                            inner join form_type as form_table3 on form_table1.req_id = form_table3.req_id
                                            inner join tbl_resident_house_member as form_table4 on form_table2.house_member_id = form_table4.household_id
                                            where form_table2.user_id = ".$_SESSION['userid']." AND status = 'Process'") or die('Error: ' . mysqli_error($con));


                                             if(mysqli_num_rows($squery_3) > 0)
                                             {
                                                 $x = 1;
                                                 
                                                 while($row = mysqli_fetch_array($squery_3))
                                                 {

                                                     
                                                     $timestamp = strtotime($row['created_at']);
                                                     $new_date_format = date('F j, Y g:i:a', $timestamp);
                                     
                                     ?>
                                 
                                         <tr>
                                 
                                             <td class = "text-center" ><?= $x++ ?></td> 
                                             <td><?php echo $row['f_name'].' '.$row['l_name']; ?></td>                     
                                             <td><?php echo $row['request_type']; ?></td>
                                             <td><?php echo $new_date_format; ?></td>
                                             <td>
                                                 <?php 
                                                 
                                                 
                                                   
                                                 if ($row['status'] == 'Pending') {
                                                 
                                                     echo '<h4><span class="label label-info">Pending...</span></h3>';


                                                 }
                                                 if ($row['status'] == 'Process') {
                                                 
                                                     echo '<h4><span class="label label-primary">Processing...</span></h3>';


                                                 }

                                                 if ($row['status'] == 'ready_pick_up') {
                                                 
                                                     echo '<h4><span class="label label-warning">Ready to pick up</span></h3>';
                                                     //with schedule

                                                 }

                                                 if ($row['status'] == 'declined') {
                                                 
                                                     echo '<h4><span class="label label-danger">Declined</span></h3>';


                                                 }

                                                 ?>
                                              </td>
                                             <td>
                                                 <a href="view_request.php?ID=<?= $row['req_form_type_id'] ?>" class="btn btn-primary"><i class="fa fa-search"></i> View details</a>
                                             </td>
                                           
                                         
                                         </tr>

                                     <?php 

                                                     }

                                                 }
                                                 
                                     
                                     ?>
                                            
                                            </tbody>
                                                    
                                    </table>

                                    </div>

                                    <div id="Ready_for_pickup" class="tab-pane ">

                                    <table id="table_request_rdpickup1" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class = "text-center" >#</th>
                                                    <th>Full name</th>
                                                    <th>Request Form</th>
                                                    <th>Date Request</th>
                                                    <th>Request status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>

                                             <?php

                                            $squery_4 = mysqli_query($con, "SELECT * FROM request_form_type as form_table1 
                                            inner join request_form_information as form_table2 on form_table1.req_form_information_id = form_table2.req_form_information_id 
                                            inner join form_type as form_table3 on form_table1.req_id = form_table3.req_id
                                            inner join tbl_resident_house_member as form_table4 on form_table2.house_member_id = form_table4.household_id
                                            where form_table2.user_id = ".$_SESSION['userid']." AND status = 'ready_pick_up'") or die('Error: ' . mysqli_error($con));


                                             if(mysqli_num_rows($squery_4) > 0)
                                             {
                                                 $x = 1;
                                                 
                                                 while($row = mysqli_fetch_array($squery_4))
                                                 {

                                                     
                                                     $timestamp = strtotime($row['created_at']);
                                                     $new_date_format = date('F j, Y g:i:a', $timestamp);
                                     
                                     ?>
                                 
                                         <tr>
                                 
                                             <td class = "text-center" ><?= $x++ ?></td> 
                                             <td><?php echo $row['f_name'].' '.$row['l_name']; ?></td>                     
                                             <td><?php echo $row['request_type']; ?></td>
                                             <td><?php echo $new_date_format; ?></td>
                                             <td>
                                                 <?php 
                                                 
                                                 
                                                   
                                                 if ($row['status'] == 'Pending') {
                                                 
                                                     echo '<h4><span class="label label-info">Pending...</span></h3>';


                                                 }
                                                 if ($row['status'] == 'Process') {
                                                 
                                                     echo '<h4><span class="label label-primary">Processing...</span></h3>';


                                                 }

                                                 if ($row['status'] == 'ready_pick_up') {
                                                 
                                                     echo '<h4><span class="label label-warning">Ready to pick up</span></h3>';
                                                     //with schedule

                                                 }

                                                 if ($row['status'] == 'declined') {
                                                 
                                                     echo '<h4><span class="label label-danger">Declined</span></h3>';


                                                 }

                                                 ?>
                                              </td>
                                             <td>
                                                 <a href="view_request.php?ID=<?= $row['req_form_type_id'] ?>" class="btn btn-primary"><i class="fa fa-search"></i> View details</a>
                                             </td>
                                           
                                         
                                         </tr>

                                     <?php 

                                                     }

                                                 }
                                                 
                                     
                                     ?>
                                            
                                            </tbody>
                                                    
                                    </table>

                                    </div>

                                    <div id="Completed" class="tab-pane ">
                                    <table id="table_request_completed" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class = "text-center" >#</th>
                                                    <th>Full name</th>
                                                    <th>Request Form</th>
                                                    <th>Date Request</th>
                                                    <th>Request status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>

                                             <?php

                                            $squery_5 = mysqli_query($con, "SELECT * FROM request_form_type as form_table1 
                                            inner join request_form_information as form_table2 on form_table1.req_form_information_id = form_table2.req_form_information_id 
                                            inner join form_type as form_table3 on form_table1.req_id = form_table3.req_id
                                            inner join tbl_resident_house_member as form_table4 on form_table2.house_member_id = form_table4.household_id
                                            where form_table2.user_id = ".$_SESSION['userid']." AND status = 'completed'") or die('Error: ' . mysqli_error($con));


                                             if(mysqli_num_rows($squery_5) > 0)
                                             {
                                                 $x = 1;
                                                 
                                                 while($row = mysqli_fetch_array($squery_5))
                                                 {

                                                     
                                                     $timestamp = strtotime($row['created_at']);
                                                     $new_date_format = date('F j, Y g:i:a', $timestamp);
                                     
                                     ?>
                                 
                                         <tr>
                                 
                                             <td class = "text-center" ><?= $x++ ?></td> 
                                             <td><?php echo $row['f_name'].' '.$row['l_name']; ?></td>                     
                                             <td><?php echo $row['request_type']; ?></td>
                                             <td><?php echo $new_date_format; ?></td>
                                             <td>
                                                 <?php 
                                                 
                                                 
                                                   
                                                 if ($row['status'] == 'Pending') {
                                                 
                                                     echo '<h4><span class="label label-info">Pending...</span></h3>';


                                                 }
                                                 if ($row['status'] == 'Process') {
                                                 
                                                     echo '<h4><span class="label label-primary">Processing...</span></h3>';


                                                 }

                                                 if ($row['status'] == 'ready_pick_up') {
                                                 
                                                     echo '<h4><span class="label label-warning">Ready to pick up</span></h3>';
                                                     //with schedule

                                                 }

                                                 if ($row['status'] == 'completed') {
                                                 
                                                    echo '<h4><span class="label label-success">Completed</span></h3>';
                                                    //with schedule

                                                }


                                                 if ($row['status'] == 'declined') {
                                                 
                                                     echo '<h4><span class="label label-danger">Declined</span></h3>';


                                                 }

                                                 ?>
                                              </td>
                                             <td>
                                                 <a href="view_request.php?ID=<?= $row['req_form_type_id'] ?>" class="btn btn-primary"><i class="fa fa-search"></i> View details</a>
                                             </td>
                                           
                                         
                                         </tr>

                                     <?php 

                                                     }

                                                 }
                                                 
                                     
                                     ?>
                                            
                                            </tbody>
                                                    
                                    </table>
                                    </div>

                                    <div id="Declined" class="tab-pane ">
                                    <table id="table_request_declined" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class = "text-center" >#</th>
                                                    <th>Full name</th>
                                                    <th>Request Form</th>
                                                    <th>Date Request</th>
                                                    <th>Request status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>

                                             <?php

                                            $squery_6 = mysqli_query($con, "SELECT * FROM request_form_type as form_table1 
                                            inner join request_form_information as form_table2 on form_table1.req_form_information_id = form_table2.req_form_information_id 
                                            inner join form_type as form_table3 on form_table1.req_id = form_table3.req_id
                                            inner join tbl_resident_house_member as form_table4 on form_table2.house_member_id = form_table4.household_id
                                            where form_table2.user_id = ".$_SESSION['userid']." AND status = 'declined'") or die('Error: ' . mysqli_error($con));


                                             if(mysqli_num_rows($squery_6) > 0)
                                             {
                                                 $x = 1;
                                                 
                                                 while($row = mysqli_fetch_array($squery_6))
                                                 {

                                                     
                                                     $timestamp = strtotime($row['created_at']);
                                                     $new_date_format = date('F j, Y g:i:a', $timestamp);
                                     
                                     ?>
                                 
                                         <tr>
                                 
                                             <td class = "text-center" ><?= $x++ ?></td> 
                                             <td><?php echo $row['f_name'].' '.$row['l_name']; ?></td>                     
                                             <td><?php echo $row['request_type']; ?></td>
                                             <td><?php echo $new_date_format; ?></td>
                                             <td>
                                                 <?php 
                                                 
                                                 
                                                   
                                                 if ($row['status'] == 'Pending') {
                                                 
                                                     echo '<h4><span class="label label-info">Pending...</span></h3>';


                                                 }
                                                 if ($row['status'] == 'Process') {
                                                 
                                                     echo '<h4><span class="label label-primary">Processing...</span></h3>';


                                                 }

                                                 if ($row['status'] == 'ready_pick_up') {
                                                 
                                                     echo '<h4><span class="label label-warning">Ready to pick up</span></h3>';
                                                     //with schedule

                                                 }

                                                 if ($row['status'] == 'completed') {
                                                 
                                                    echo '<h4><span class="label label-success">Completed</span></h3>';
                                                    //with schedule

                                                }


                                                 if ($row['status'] == 'declined') {
                                                 
                                                     echo '<h4><span class="label label-danger">Declined</span></h3>';


                                                 }

                                                 ?>
                                              </td>
                                             <td>
                                                 <a href="view_request.php?ID=<?= $row['req_form_type_id'] ?>" class="btn btn-primary"><i class="fa fa-search"></i> View details</a>
                                             </td>
                                           
                                         
                                         </tr>

                                     <?php 

                                                     }

                                                 }
                                                 
                                     
                                     ?>
                                            
                                            </tbody>
                                                    
                                    </table>
                                    </div>


                                    <div id="approved" class="tab-pane ">
                                    <table id="table_approved" class="table table-striped table-bordered display responsive nowrap" width="100%">
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
                                           

                                                    
                                            ?>
                                            
                                        </tbody>
                                    </table>

                                    <table id="table_approved" class="table table-striped table-bordered display responsive nowrap" style = "visibility: hidden;" width="100%">
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
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    
                                    </div>

                                    <div id="disapproved" class="tab-pane">
                                    <table id="table_disapproved" class="table table-striped table-bordered display responsive nowrap" width="100%">
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
                                           

                                                    
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                    </div>

                                    </div>

                                    </form>
                                    <?php
                                    include "../duplicate_error.php";
                                    include "lengthstay_error.php";
                                    include "request_form_modal.php";
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
// $('#example').DataTable( {
//  responsive: true
// } );


$(document).ready(function() {


    $('#table_request1').DataTable({
    
        "columns":[
            {"data": "#"},
            {"data": "Full name"},
            {"data": "Request Form"},
            {"data": "Date Request"},
            {"data": "Request status"},
            {"data": "Action"}
        ]
    });

});

$(document).ready(function() {

    $('#table_request_pending').DataTable({
    
    "columns":[
        {"data": "#"},
        {"data": "Full name"},
        {"data": "Request Form"},
        {"data": "Date Request"},
        {"data": "Request status"},
        {"data": "Action"}
    ]
});

});


$(document).ready(function() {
    
    $('#table_request_process').DataTable({
    
    "columns":[
        {"data": "#"},
        {"data": "Full name"},
        {"data": "Request Form"},
        {"data": "Date Request"},
        {"data": "Request status"},
        {"data": "Action"}
    ]
});

});

$(document).ready(function() {
    
    $('#table_request_rdpickup1').DataTable({
    "columns":[
        {"data": "#"},
        {"data": "Full name"},
        {"data": "Request Form"},
        {"data": "Date Request"},
        {"data": "Request status"},
        {"data": "Action"}
    ]
});

});

$(document).ready(function() {
$('#table_request_completed').DataTable({
    
    "columns":[
        {"data": "#"},
        {"data": "Full name"},
        {"data": "Request Form"},
        {"data": "Date Request"},
        {"data": "Request status"},
        {"data": "Action"}
    ]
});
});

$(document).ready(function() {
$('#table_request_declined').DataTable({
    
    "columns":[
        {"data": "#"},
        {"data": "Full name"},
        {"data": "Request Form"},
        {"data": "Date Request"},
        {"data": "Request status"},
        {"data": "Action"}
    ]
});
});
// $(document).ready(function() {

// $('#table_request_process').DataTable({
    
//     "columns":[
//         {"data": "#"},
//         {"data": "Full name"},
//         {"data": "Request Form"},
//         {"data": "Date Request"},
//         {"data": "Request status"},
//         {"data": "Action"}
//     ]
// });

// });

// $(document).ready(function() {

// $('#table_request_rdpickup').DataTable({
    
//     "columns":[
//         {"data": "#"},
//         {"data": "Full name"},
//         {"data": "Request Form"},
//         {"data": "Date Request"},
//         {"data": "Request status"},
//         {"data": "Action"}
//     ]
// });

// });
// $(document).ready(function() {
// $('#table_request_completed').DataTable({
    
//     "columns":[
//         {"data": "#"},
//         {"data": "Full name"},
//         {"data": "Request Form"},
//         {"data": "Date Request"},
//         {"data": "Request status"},
//         {"data": "Action"}
//     ]
// });
// });

// $(document).ready(function() {

// $('#table_request_declined').DataTable({
    
//     "columns":[
//         {"data": "#"},
//         {"data": "Full name"},
//         {"data": "Request Form"},
//         {"data": "Date Request"},
//         {"data": "Request status"},
//         {"data": "Action"}
//     ]
// });


// });

$(document).ready(function() {
    $('#table_approved').DataTable({
    
    "columns":[
        {"data": "Clearance#"},
        {"data": "Findings"},
        {"data": "Purpose"},
        {"data": "OR Number"},
        {"data": "Amount"}
    ]
    });
});

$(document).ready(function() {
    $('#table_disapproved').DataTable({
    
    "columns":[
        {"data": "Findings"},
        {"data": "Purpose"}
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