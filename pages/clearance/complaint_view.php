<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else {
    ob_start();
    include('../head_css.php'); ?>

    <head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
    </head>

    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php
        include "../connection.php";

        $complaint_id = $_GET['ID'];
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
                        Complain Information
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">

                    <?php
                    if ($_SESSION['role'] == "Administrator" || isset($_SESSION['staff'])) {
                    ?>
                        <!-- Admin Role -->

                    <?php
                    } elseif ($_SESSION['role'] == "Zone Leader") {
                    ?>
                        <!-- Zone Leader Role -->

                        <?php

                        $sql = "SELECT * FROM complaints WHERE complaint_id='$complaint_id'";
                        $result = $con->query($sql);
                        $row = $result->fetch_assoc()

                        ?>

                        <div class="form-group">
                            <label for="#name">Complainant:</label>
                            <input id="name" type="text" value="<?php echo $row['complainant']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="#against">Against:</label>
                            <input id="against" type="text" value="<?php echo $row['against']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="#date">Date:</label>
                            <input id="date" type="text" value="<?php echo $row['date']; ?>" disabled>

                            <label for="#time">Time:</label>
                            <input id="time" type="text" value="<?php echo $row['time']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="#against">Purpose:</label>
                            <input id="against" type="text" value="<?php echo $row['purpose']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label>Description of Complain:</label>
                            <textarea rows="5" class="form-control" id="test" type="text" value="" readonly><?php echo $row['complain_description']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" class="control-label">Response:</label>
                            <textarea name="response" class="form-control" id="exampleTextarea" disabled><?php echo $row['response']; ?></textarea>
                            <br>
                        </div>

                        

                        <?php if ($row['status'] === "pending") { ?>

                            <!-- Button to open the modal -->
                            <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#scheduleModal">ACKNOWLEDGE</button>

                            <!-- Modal -->
                            <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="scheduleModalLabel">Select Schedule</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="complaint_respond.php?ID=<?= $complaint_id ?>">
                                                <div class="form-group">
                                                    <label for="scheduleInput">Schedule:</label>
                                                    <input type="datetime-local" id="schedule_datetime" name="new_schedule">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        <?php } else if ($row['status'] === 'acknowledged') { ?>

                            <!-- Display the current schedule information -->
                            <div class="form-group">
                                <label for="schedule">Complaint Trial Schedule:</label>
                                <input id="schedule" type="text" value="<?php

                                                                        $sched_display =  $row['new_schedule'];
                                                                        echo $sched_display_formatted =  date('F j, Y, g:i A', strtotime($sched_display));

                                                                        ?>" disabled>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editScheduleModal">Edit Schedule</button>
                            </div>

                            <!-- Create a modal to edit the schedule -->
                            <div class="modal fade" id="editScheduleModal" tabindex="-1" role="dialog" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editScheduleModalLabel">Edit Schedule</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST">
                                                <div class="form-group">
                                                    <label for="new_schedule_datetime">New Schedule:</label>
                                                    <input type="datetime-local" id="new_schedule_datetime" name="new_schedule_datetime" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="save_schedule" class="btn btn-primary">Save Schedule</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <?php
                            // Check if the form to save the new schedule has been submitted
                            if (isset($_POST['save_schedule'])) {
                                // Get the new schedule date and time from the form
                                $new_schedule = $_POST['new_schedule_datetime'];

                                // Save the new schedule to new_schedule column and old schedule to old_schedule column in the database
                                $query = "UPDATE complaints SET old_schedule = new_schedule, new_schedule = '$new_schedule' WHERE complaint_id = $complaint_id";
                                $result = mysqli_query($con, $query);

                                // Check if the query was successful
                                if ($result) {
                                    header("Location: {$_SERVER['REQUEST_URI']}");
                                    exit();
                                } else {
                                    echo 'Error updating schedule.';
                                }
                            }
                            ?>

                            <form method="POST" action="complaint_respond.php?ID=<?= $complaint_id ?>" enctype="multipart/form-data">
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

                            <div class="form-group">
                                <button class="btn btn-block btn-success" type="button" data-toggle="modal" data-target="#printModal"> PRINT</button>
                            </div>

                        <?php } else { ?>

                            <div class="form-group">
                                <label for="exampleTextarea" class="control-label">Wrote:</label>
                                <textarea name="leader_write" class="form-control" id="exampleTextarea" readonly><?php echo $row['leader_write']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea" class="control-label">Attached Photo:</label>
                                <br>
                                <img src="./uploads/<?php echo $row['attached_photo']; ?>" style="width:100%;max-width:500px">
                            </div>
                            <div class="form-group">
                                <label for="#schedule">Complaint Trial Schedule:</label>
                                <input id="schedule" type="text" value="<?php

                                                                        $sched_display =  $row['new_schedule'];
                                                                        echo $sched_display_formatted =  date('F j, Y, g:i A', strtotime($sched_display));

                                                                        ?>" disabled>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-block btn-success" type="button" data-toggle="modal" data-target="#printModal"> PRINT</button>
                            </div>

                        <?php } ?>





                        <!-- Print Complain Modal -->

                        <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="complaintModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="complaintModalLabel">Choose a document to print</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <button type="button" onclick="popuponclick(7)" class="btn btn-block btn-success">KP-7</button>
                                        <button type="button" onclick="popuponclick(8)" class="btn btn-block btn-success">KP-8</button>
                                        <button type="button" onclick="popuponclick(9)" class="btn btn-block btn-success">KP-9</button>
                                        <button type="button" onclick="popuponclick(12)" class="btn btn-block btn-success">KP-12</button>
                                        <button type="button" onclick="popuponclick(18)" class="btn btn-block btn-success">KP-18</button>
                                        <button type="button" onclick="popuponclick(19)" class="btn btn-block btn-success">KP-19</button>
                                        <button type="button" onclick="popuponclick(20)" class="btn btn-block btn-success">KP-20</button>
                                        <button type="button" onclick="popuponclick('20A')" class="btn btn-block btn-success">KP-20A</button>
                                        <button type="button" onclick="popuponclick('20B')" class="btn btn-block btn-success">KP-20B</button>
                                        <button type="button" onclick="popuponclick(21)" class="btn btn-block btn-success">KP-21</button>
                                        <button type="button" onclick="popuponclick(22)" class="btn btn-block btn-success">KP-22</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Print Complain Modal End -->

                    <?php
                    } else {
                    ?>
                        <!-- Resident Role -->

                        <?php

                        $sql = "SELECT * FROM complaints WHERE complaint_id='$complaint_id'";
                        $result = $con->query($sql);
                        $row = $result->fetch_assoc()

                        ?>

                        <div class="form-group">
                            <label for="#name">Complainant:</label>
                            <input id="name" type="text" value="<?php echo $row['complainant']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="#against">Against:</label>
                            <input id="against" type="text" value="<?php echo $row['against']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="#date">Date:</label>
                            <input id="date" type="text" value="<?php echo $row['date']; ?>" disabled>

                            <label for="#time">Time:</label>
                            <input id="time" type="text" value="<?php echo $row['time']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="#against">Purpose:</label>
                            <input id="against" type="text" value="<?php echo $row['purpose']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label>Description of Complain:</label>
                            <textarea rows="10" class="form-control" id="test" type="text" value="" readonly><?php echo $row['complain_description']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" class="control-label">Response:</label>
                            <textarea name="response" class="form-control" id="exampleTextarea" disabled><?php echo $row['response']; ?></textarea>

                        </div>

                        

                        <div class="form-group">
                            <label for="#schedule">Complaint Trial Schedule:</label>
                            <input id="schedule" type="text" value="<?php echo $row['new_schedule']; ?>" disabled>
                        </div>

                        


                        <!-- Print Complain Modal -->

                        <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="complaintModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="complaintModalLabel">Choose a document to print</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <button type="button" onclick="popuponclick(7)" class="btn btn-block btn-success">KP-7</button>
                                        <button type="button" onclick="popuponclick(8)" class="btn btn-block btn-success">KP-8</button>
                                        <button type="button" onclick="popuponclick(9)" class="btn btn-block btn-success">KP-9</button>
                                        <button type="button" onclick="popuponclick(12)" class="btn btn-block btn-success">KP-12</button>
                                        <button type="button" onclick="popuponclick(18)" class="btn btn-block btn-success">KP-18</button>
                                        <button type="button" onclick="popuponclick(19)" class="btn btn-block btn-success">KP-19</button>
                                        <button type="button" onclick="popuponclick(20)" class="btn btn-block btn-success">KP-20</button>
                                        <button type="button" onclick="popuponclick('20A')" class="btn btn-block btn-success">KP-20A</button>
                                        <button type="button" onclick="popuponclick('20B')" class="btn btn-block btn-success">KP-20B</button>
                                        <button type="button" onclick="popuponclick('21')" class="btn btn-block btn-success">KP-21</button>
                                        <button type="button" onclick="popuponclick('22')" class="btn btn-block btn-success">KP-22</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php
                    }
                    ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->



        <script type="text/javascript">
            // Save ID for kp documents
            function popuponclick(value) {

                if (value === 7) {
                    newwindow = window.open('kp-complain-forms/kp-7.php?ID=<?= $complaint_id ?>', 'name', 'width=1500,height=1000');
                } else if (value === 8) {
                    newwindow = window.open('kp-complain-forms/kp-8.php?ID=<?= $complaint_id ?>', 'name', 'width=1500,height=1000');
                } else if (value === 9) {
                    newwindow = window.open('kp-complain-forms/kp-9.php?ID=<?= $complaint_id ?>', 'name', 'width=1500,height=1000');
                } else if (value === 12) {
                    newwindow = window.open('kp-complain-forms/kp-12.php?ID=<?= $complaint_id ?>', 'name', 'width=1500,height=1000');
                } else if (value === 18) {
                    newwindow = window.open('kp-complain-forms/kp-18.php?ID=<?= $complaint_id ?>', 'name', 'width=1500,height=1000');
                } else if (value === 19) {
                    newwindow = window.open('kp-complain-forms/kp-19.php?ID=<?= $complaint_id ?>', 'name', 'width=1500,height=1000');
                } else if (value === 20) {
                    newwindow = window.open('kp-complain-forms/kp-20.php?ID=<?= $complaint_id ?>', 'name', 'width=1500,height=1000');
                } else if (value === '20A') {
                    newwindow = window.open('kp-complain-forms/kp-20A.php?ID=<?= $complaint_id ?>', 'name', 'width=1500,height=1000');
                } else if (value === '20B') {
                    newwindow = window.open('kp-complain-forms/kp-20B.php?ID=<?= $complaint_id ?>', 'name', 'width=1500,height=1000');
                } else if (value === 21) {
                    newwindow = window.open('kp-complain-forms/kp-21.php?ID=<?= $complaint_id ?>', 'name', 'width=1500,height=1000');
                } else {
                    newwindow = window.open('kp-complain-forms/kp-22.php?ID=<?= $complaint_id ?>', 'name', 'width=1500,height=1000');
                }

                if (window.focus) {
                    newwindow.focus()
                }
                return false;
            }
        </script>

        <script>
            // Calendar for schedule
            $(function() {
                // Initialize the calendar input
                $('#scheduleInput').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: 'yyyy-mm-dd'
                });
            });

            $(function() {
                $('#scheduleTimeInput').timepicker({
                    timeFormat: 'hh:mm:ss TT', // Format of the time value
                    interval: 15, // Interval of the minutes in the time picker
                    dynamic: false, // Allow to set the input value dynamically
                    dropdown: true, // Enable the dropdown for the time picker
                    scrollbar: true // Enable the scrollbar for the time picker
                });
            });
        </script>


        <script>
            $(document).ready(function() {
                $('#table_request').DataTable({

                    "columns": [{
                            "data": "#"
                        },
                        {
                            "data": "Full name"
                        },
                        {
                            "data": "Form Type"
                        },
                        {
                            "data": "Date Request"
                        },
                        {
                            "data": "Action"
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