<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else {
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
                        Complaints
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">

                    <?php
                    if ($_SESSION['role'] == "Administrator" || isset($_SESSION['staff'])) {
                    ?>


                        <!-- ADMIN ROLE -->

                        <div class="row">
                            <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">

                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Clearance</button>

                                        <?php
                                        if (!isset($_SESSION['staff'])) {
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
                                                            if (!isset($_SESSION['staff'])) {
                                                            ?>
                                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
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

                                                        if (!isset($_SESSION['staff'])) {

                                                            $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'Approved'") or die('Error: ' . mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($squery)) {
                                                                echo '
                                                        <tr>
                                                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['pid'] . '" /></td>
                                                            <td>' . $row['clearanceNo'] . '</td>
                                                            <td>' . $row['residentname'] . '</td>
                                                            <td>' . $row['findings'] . '</td>
                                                            <td>' . $row['purpose'] . '</td>
                                                            <td>' . $row['orNo'] . '</td>
                                                            <td>₱ ' . number_format($row['samount'], 2) . '</td>
                                                            <td><button class="btn btn-primary btn-sm" data-target="#editModal' . $row['pid'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                            <a target="_blank" href="clearance_form.php?resident=' . $row['residentid'] . '&clearance=' . $row['clearanceNo'] . '&val=' . base64_encode($row['clearanceNo'] . '|' . $row['residentname'] . '|' . $row['dateRecorded']) . '" onclick="location.reload();" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Generate</a></td>
                                                        </tr>
                                                        ';

                                                                include "edit_modal.php";
                                                            }
                                                        } else {
                                                            $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'Approved'") or die('Error: ' . mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($squery)) {
                                                                echo '
                                                        <tr>
                                                            <td>' . $row['clearanceNo'] . '</td>
                                                            <td>' . $row['residentname'] . '</td>
                                                            <td>' . $row['findings'] . '</td>
                                                            <td>' . $row['purpose'] . '</td>
                                                            <td>' . $row['orNo'] . '</td>
                                                            <td>₱ ' . number_format($row['samount'], 2) . '</td>
                                                            <td><button class="btn btn-primary btn-sm" data-target="#editModal' . $row['pid'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                            <a target="_blank" href="clearance_form.php?resident=' . $row['residentid'] . '&clearance=' . $row['clearanceNo'] . '&val=' . sha1($row['clearanceNo'] . '|' . $row['residentname'] . '|' . $row['dateRecorded']) . '" onclick="location.reload();" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Generate</a></td>
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
                                                            if (!isset($_SESSION['staff'])) {
                                                            ?>
                                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
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
                                                        if (!isset($_SESSION['staff'])) {

                                                            $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid where status = 'Disapproved' ") or die('Error: ' . mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($squery)) {
                                                                echo '
                                                        <tr>
                                                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['pid'] . '" /></td>
                                                            <td>' . $row['residentname'] . '</td>
                                                            <td>' . $row['findings'] . '</td>
                                                            <td>' . $row['purpose'] . '</td>
                                                        </tr>
                                                        ';

                                                                include "edit_modal.php";
                                                            }
                                                        } else {
                                                            $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid where status = 'Disapproved' ") or die('Error: ' . mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($squery)) {
                                                                echo '
                                                        <tr>
                                                            <td>' . $row['residentname'] . '</td>
                                                            <td>' . $row['findings'] . '</td>
                                                            <td>' . $row['purpose'] . '</td>
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


                        </div> <!-- /.row -->
                    <?php
                    } elseif ($_SESSION['role'] == "Zone Leader") {
                    ?>

                        <!-- Zone Leader Role -->

                        <div class="row">
                            <!-- left column -->
                            <div class="box">
                                <div class="box-header">

                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-target="#pending" data-toggle="tab">To Acknowledge</a></li>
                                        <li><a data-target="#acknowledged" data-toggle="tab">To Settle/Dismiss</a></li>
                                        <li><a data-target="#closed" data-toggle="tab">Closed</a></li>
                                    </ul>
                                    <style>
                                        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {

                                            color: none;
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
                                    <div class="tab-content" style="padding-top:30px;">
                                        <div id="pending" class="tab-pane active in">
                                            <table id="table_request1" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Complainant</th>
                                                        <th>Purpose</th>
                                                        <th>Date Filed</th>
                                                        <th>Request status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>


                                                <tbody>

                                                    <?php

                                                    $resident_id = $_SESSION['userid'];
                                                    $sql = "SELECT * FROM complaints WHERE status = 'pending'";
                                                    $result = $con->query($sql);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        $x = 1;

                                                        while ($row = $result->fetch_assoc()) {

                                                    ?>

                                                            <tr>

                                                                <td class="text-center"><?= $x++ ?></td>
                                                                <td><?php echo $row["complainant"]; ?></td>
                                                                <td><?php echo $row["purpose"] ?></td>
                                                                <td><?php echo $row["date"] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($row['status'] == 'pending') {

                                                                        echo '<h4><span class="label label-info">Pending...</span></h3>';
                                                                    }
                                                                    if ($row['status'] == 'acknowledged') {

                                                                        echo '<h4><span class="label label-primary">Acknowledged</span></h3>';
                                                                    }

                                                                    if ($row['status'] == 'dismissed') {

                                                                        echo '<h4><span class="label label-default">Dismissed</span></h3>';
                                                                    }
                                                                    if ($row['status'] == 'settled') {

                                                                        echo '<h4><span class="label label-warning">Settled</span></h3>';
                                                                    }

                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <!-- href="view_request.php?ID=<?= $row['req_form_type_id'] ?>" -->
                                                                    <a href="complaint_view.php?ID=<?= $row['complaint_id'] ?>" class="btn btn-primary"><i class="fa fa-search"></i> View details</a>

                                                                </td>


                                                            </tr>

                                                    <?php

                                                        }
                                                    }

                                                    ?>


                                                </tbody>
                                            </table>

                                        </div>

                                        <div id="acknowledged" class="tab-pane">
                                            <table id="table_request_pending" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Complainant</th>
                                                        <th>Purpose</th>
                                                        <th>Date Filed</th>
                                                        <th>Request status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>


                                                <tbody>

                                                    <?php

                                                    $resident_id = $_SESSION['userid'];
                                                    $sql = "SELECT * FROM complaints WHERE status = 'acknowledged'";
                                                    $result = $con->query($sql);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        $x = 1;

                                                        while ($row = $result->fetch_assoc()) {

                                                    ?>

                                                            <tr>

                                                                <td class="text-center"><?= $x++ ?></td>
                                                                <td><?php echo $row["complainant"]; ?></td>
                                                                <td><?php echo $row["purpose"] ?></td>
                                                                <td><?php echo $row["date"] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($row['status'] == 'pending') {

                                                                        echo '<h4><span class="label label-info">Pending...</span></h3>';
                                                                    }
                                                                    if ($row['status'] == 'acknowledged') {

                                                                        echo '<h4><span class="label label-primary">Acknowledged</span></h3>';
                                                                    }

                                                                    if ($row['status'] == 'dismissed') {

                                                                        echo '<h4><span class="label label-default">Dismissed</span></h3>';
                                                                    }
                                                                    if ($row['status'] == 'settled') {

                                                                        echo '<h4><span class="label label-warning">Settled</span></h3>';
                                                                    }

                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <!-- href="view_request.php?ID=<?= $row['req_form_type_id'] ?>" -->
                                                                    <a href="complaint_view.php?ID=<?= $row['complaint_id'] ?>" class="btn btn-primary"><i class="fa fa-search"></i> View details</a>

                                                                </td>


                                                            </tr>

                                                    <?php

                                                        }
                                                    }

                                                    ?>


                                                </tbody>

                                            </table>

                                        </div>

                                        <div id="closed" class="tab-pane">
                                            <table id="table_request_process" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Complainant</th>
                                                        <th>Purpose</th>
                                                        <th>Date Filed</th>
                                                        <th>Request status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>


                                                <tbody>

                                                    <?php

                                                    $resident_id = $_SESSION['userid'];
                                                    $sql = "SELECT * FROM complaints WHERE status = 'settled' OR status = 'dismissed'";
                                                    $result = $con->query($sql);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        $x = 1;

                                                        while ($row = $result->fetch_assoc()) {

                                                    ?>

                                                            <tr>

                                                                <td class="text-center"><?= $x++ ?></td>
                                                                <td><?php echo $row["complainant"]; ?></td>
                                                                <td><?php echo $row["purpose"] ?></td>
                                                                <td><?php echo $row["date"] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($row['status'] == 'pending') {

                                                                        echo '<h4><span class="label label-info">Pending...</span></h3>';
                                                                    }
                                                                    if ($row['status'] == 'acknowledged') {

                                                                        echo '<h4><span class="label label-primary">Acknowledged</span></h3>';
                                                                    }

                                                                    if ($row['status'] == 'dismissed') {

                                                                        echo '<h4><span class="label label-default">Dismissed</span></h3>';
                                                                    }
                                                                    if ($row['status'] == 'settled') {

                                                                        echo '<h4><span class="label label-warning">Settled</span></h3>';
                                                                    }

                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <!-- href="view_request.php?ID=<?= $row['req_form_type_id'] ?>" -->
                                                                    <a href="complaint_view.php?ID=<?= $row['complaint_id'] ?>" class="btn btn-primary"><i class="fa fa-search"></i> View details</a>

                                                                </td>


                                                            </tr>

                                                    <?php

                                                        }
                                                    }

                                                    ?>


                                                </tbody>

                                            </table>

                                        </div>




                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->


                                <?php include "function.php"; ?>


                            </div> <!-- /.row -->

                        <?php
                    } else {
                        ?>


                            <!-- Resident Role -->

                            <div class="row">
                                <!-- left column -->
                                <div class="box">
                                    <div class="box-header">
                                        <div style="padding:10px;">

                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#complaintModal"><i class="fa fa-plus" aria-hidden="true"></i> Create Complain</button>

                                        </div>
                                    </div><!-- /.box-header -->

                                    <!-- Resident Complaints Modal -->

                                    <div class="modal fade" id="complaintModal" tabindex="-1" role="dialog" aria-labelledby="complaintModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="complaintModalLabel">Submit a Complaint</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="complaint_submit.php">
                                                        <input type="hidden" class="form-control" id="resident_id" name="resident_id" value=" <?php echo $_SESSION['userid']; ?>">
                                                        <?php

                                                            $user = mysqli_query($con, "SELECT * from tbl_resident_new where resident_id  = '" . $_SESSION['userid'] . "' ");
                                                            $f_name = "";
                                                            $l_name = "";
                                                            if (mysqli_num_rows($user) > 0) {
                                                                $row_user = $user->fetch_assoc();
                                                                $f_name = $row_user['f_name'];
                                                                $l_name = $row_user['l_name'];
                                                            }
                                                        ?>
                                                        
                                                        <div class="form-group">
                                                            <label for="complainant">Complainant Name:</label>
                                                            <input type="text" class="form-control" id="complainant" name="complainant" value="<?php echo $f_name . ' ' . $l_name; ?>" required readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="against">Against:</label>
                                                            <!-- <input type="text" class="form-control" id="against" name="against" required> -->
                                                            <select name="against" id="against" class="form-control">
                                                                <?php

                                                                    $user = mysqli_query($con, "SELECT * from tbl_resident_new where not resident_id  = '" . $_SESSION['userid'] . "' ");
                                                                    if (mysqli_num_rows($user) > 0) {
        
                                                                        while ($row_user = $user->fetch_assoc()) {
                                                                        echo '<option value="'. $row_user["f_name"].' '.$row_user["m_name"].' '.$row_user['l_name'].'">'. $row_user["f_name"].' '.$row_user["m_name"].' '.$row_user['l_name'].'</option>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="purpose">Purpose:</label>
                                                            <input type="text" class="form-control" id="purpose" name="purpose" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="complain_description">Description:</label>
                                                            <textarea class="form-control" id="complain_description" name="complain_description" rows="3" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="response">Response:</label>
                                                            <textarea class="form-control" id="response" name="response" rows="3" required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Resident Complaints Modal End -->


                                    <div class="box-body table-responsive">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <li class="active"><a data-target="#all" data-toggle="tab">
                                                    All
                                                </a></li>

                                        </ul>
                                        <style>
                                            .dataTables_wrapper .dataTables_paginate .paginate_button:hover {

                                                color: none;
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
                                            <div class="tab-content" style="padding-top:30px;">
                                                <div id="all" class="tab-pane active in">
                                                    <table id="table_request1" class="table table-striped table-bordered display responsive nowrap" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th>Full name</th>
                                                                <th>Purpose</th>
                                                                <th>Date Filed</th>
                                                                <th>Request status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>


                                                        <tbody>

                                                            <?php

                                                            $resident_id = $_SESSION['userid'];

                                                            $sql = "SELECT * FROM complaints WHERE resident_id='$resident_id'";
                                                            $result = $con->query($sql);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                $x = 1;

                                                                while ($row = $result->fetch_assoc()) {

                                                            ?>

                                                                    <tr>

                                                                        <td class="text-center"><?= $x++ ?></td>
                                                                        <td><?php echo $row["complainant"]; ?></td>
                                                                        <td><?php echo $row["purpose"] ?></td>
                                                                        <td><?php echo $row["date"] ?></td>
                                                                        <td>
                                                                            <?php
                                                                            if ($row['status'] == 'pending') {

                                                                                echo '<h4><span class="label label-info">Pending...</span></h3>';
                                                                            }
                                                                            if ($row['status'] == 'acknowledged') {

                                                                                echo '<h4><span class="label label-primary">Acknowledged</span></h3>';
                                                                            }

                                                                            if ($row['status'] == 'dismissed') {

                                                                                echo '<h4><span class="label label-default">Dismissed</span></h3>';
                                                                            }
                                                                            if ($row['status'] == 'settled') {

                                                                                echo '<h4><span class="label label-warning">Settled</span></h3>';
                                                                            }

                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <!-- href="view_request.php?ID=<?= $row['req_form_type_id'] ?>" -->
                                                                            <a href="complaint_view.php?ID=<?= $row['complaint_id'] ?>" class="btn btn-primary"><i class="fa fa-search"></i> View details</a>

                                                                        </td>


                                                                    </tr>

                                                            <?php

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


                            </div> <!-- /.row -->

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

                    "columns": [{
                            "data": "#"
                        },
                        {
                            "data": "Full name"
                        },
                        {
                            "data": "Request Form"
                        },
                        {
                            "data": "Date Request"
                        },
                        {
                            "data": "Request status"
                        },
                        {
                            "data": "Action"
                        }
                    ]
                });

            });

            $(document).ready(function() {

                $('#table_request_pending').DataTable({

                    "columns": [{
                            "data": "#"
                        },
                        {
                            "data": "Full name"
                        },
                        {
                            "data": "Request Form"
                        },
                        {
                            "data": "Date Request"
                        },
                        {
                            "data": "Request status"
                        },
                        {
                            "data": "Action"
                        }
                    ]
                });

            });


            $(document).ready(function() {

                $('#table_request_process').DataTable({

                    "columns": [{
                            "data": "#"
                        },
                        {
                            "data": "Full name"
                        },
                        {
                            "data": "Request Form"
                        },
                        {
                            "data": "Date Request"
                        },
                        {
                            "data": "Request status"
                        },
                        {
                            "data": "Action"
                        }
                    ]
                });

            });

            $(document).ready(function() {

                $('#table_request_rdpickup1').DataTable({
                    "columns": [{
                            "data": "#"
                        },
                        {
                            "data": "Full name"
                        },
                        {
                            "data": "Request Form"
                        },
                        {
                            "data": "Date Request"
                        },
                        {
                            "data": "Request status"
                        },
                        {
                            "data": "Action"
                        }
                    ]
                });

            });

            $(document).ready(function() {
                $('#table_request_completed').DataTable({

                    "columns": [{
                            "data": "#"
                        },
                        {
                            "data": "Full name"
                        },
                        {
                            "data": "Request Form"
                        },
                        {
                            "data": "Date Request"
                        },
                        {
                            "data": "Request status"
                        },
                        {
                            "data": "Action"
                        }
                    ]
                });
            });

            $(document).ready(function() {
                $('#table_request_declined').DataTable({

                    "columns": [{
                            "data": "#"
                        },
                        {
                            "data": "Full name"
                        },
                        {
                            "data": "Request Form"
                        },
                        {
                            "data": "Date Request"
                        },
                        {
                            "data": "Request status"
                        },
                        {
                            "data": "Action"
                        }
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

                    "columns": [{
                            "data": "Clearance#"
                        },
                        {
                            "data": "Findings"
                        },
                        {
                            "data": "Purpose"
                        },
                        {
                            "data": "OR Number"
                        },
                        {
                            "data": "Amount"
                        }
                    ]
                });
            });

            $(document).ready(function() {
                $('#table_disapproved').DataTable({

                    "columns": [{
                            "data": "Findings"
                        },
                        {
                            "data": "Purpose"
                        }
                    ]
                });
            });
        </script>

    <?php }

include "../footer.php"; ?>
    <script type="text/javascript">
        <?php
        if (!isset($_SESSION['staff'])) {
        ?>
            $(function() {
                $("#table").dataTable({
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [0, 7]
                    }],
                    "aaSorting": []
                });
                $("#table1").dataTable({
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [0, 3]
                    }],
                    "aaSorting": []
                });
                $(".select2").select2();
            });
        <?php
        } else {
        ?>
            $(function() {
                $("#table").dataTable({
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [6]
                    }],
                    "aaSorting": []
                });
                $("#table1").dataTable({
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [2]
                    }],
                    "aaSorting": []
                });
                $(".select2").select2();
            });
        <?php
        }
        ?>
    </script>




    </body>

</html>