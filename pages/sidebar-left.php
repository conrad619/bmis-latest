<style>
    .edit-profile:hover {
        background-color: #969590;
        cursor: pointer;
        font-size: 20px;
    }

    .myProfileImgModal {
        cursor: pointer;
    }
</style>
<?php


if (isset($_SESSION['role_user'])) {

    $user = mysqli_query($con, "SELECT * from tbl_resident_new where resident_id  = '" . $_SESSION['userid'] . "' ");

    if (mysqli_num_rows($user) > 0) {
        $row_user = $user->fetch_assoc();

        $user_side_bar = '<div class="pull-left info">

        <div class="text-center myProfileImgModal" data-toggle="modal" data-target="#myProfileImgModal">
        <img src="../../pages/resident/image/' . $row_user['profile_photo'] . '.png" alt="" width="100">
        </div>

    <h5>Hello, ' . $row_user['f_name'] . ' ' . $row_user['l_name'] . ' <i class="fa fa-pencil-square-o edit-profile" onclick="popuponclick()" aria-hidden="true" title = "View profile"></i></h5>

        </div>';


        echo "
        <script type='text/javascript'>
        
        function popuponclick() {
        location.href = 'myprofile.php?ID=" . $row_user['resident_id'] . "';
        }
        </script>
        ";


        echo '<!-- Modal -->

        <form  action = "edit_personalinfo.php" method = "post" enctype="multipart/form-data">
        <div class="modal fade" id="myProfileImgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change profile photo</h4>
              </div>
              <div class="modal-body">

            
              <input type="file" name = "change_profile" class = "form-control" id="" accept="image/*" required>
              <input type="hidden" name = "resident_id" class = "form-control" value ="' . $row_user['resident_id'] . '" id="" required>
              <input type="hidden" name = "existing_photo" class = "form-control" value ="' . $row_user['profile_photo'] . '" id="" required>
              

             
              

            
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name = "update_profileimg" class="btn btn-primary">Upload & Save changes</button>
              </div>
            </div>
          </div>
        </div>
        
        </form>';
    }
} else {


    $user_side_bar = '<div class="pull-left info">

  

    <h4>Hello, ' . $_SESSION['role'] . '</h4>

    </div>';
}





echo '
	<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">

                       
' . $user_side_bar . '
                        
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    ';
if ($_SESSION['role'] == "Administrator") {
    echo '
                    <ul class="sidebar-menu">
                             <div style = "display:none">
                            <li>
                                <a href="../dashboard/dashboard.php">
                                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                </a>
                            </li>
                          
                            <li>
                                <a href="../officials/officials.php">
                                    <i class="fa fa-user"></i> <span>Barangay Officials</span>
                                </a>
                            </li>
                            <li>
                                <a href="../staff/staff.php">
                                    <i class="fa fa-user"></i> <span>Staff</span>
                                </a>
                            </li>
                            </div>
                            <li>
                                <a href="../zone/zone.php">
                                    <i class="fa fa-user"></i> <span>Zone Leader</span>
                                </a>
                            </li>
                             <div style = "display:none">
                            <li>
                                <a href="../household/household.php">
                                    <i class="fa fa-home"></i> <span>Household</span>
                                </a>
                            </li>
                             </div>
                            <li>
                                <a href="../resident/resident.php">
                                    <i class="fa fa-users"></i> <span>Resident</span>
                                </a>
                            </li>
                             <div style = "display:none">
                            <li>
                                <a href="../permit/permit.php">
                                    <i class="fa fa-file"></i> <span>Permit</span>
                                </a>
                            </li>
                            <li>
                                <a href="../blotter/blotter.php">
                                    <i class="fa fa-users"></i> <span>Blotter</span>
                                </a>
                            </li>
                            <li>
                                <a href="../clearance/clearance.php">
                                    <i class="fa fa-file"></i> <span>Clearance</span>
                                </a>
                            </li>
                             </div>
                            <li>
                                <a href="../activity/activity.php">
                                <i class="fa fa-bullhorn" aria-hidden="true"></i> <span>Announcement</span>
                                </a>
                            </li>
                            <li style="display:none">
                                <a href="../report/report.php">
                                    <i class="fa fa-file"></i> <span>Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="../logs/logs.php">
                                    <i class="fa fa-history"></i> <span>Logs</span>
                                </a>
                            </li>
                            
                    </ul>';
} elseif ($_SESSION['role'] == "Zone Leader") {
    echo '
                        <ul class="sidebar-menu">
                           <!-- <li>
                                <a href="../permit/permit.php">
                                    <i class="fa fa-file"></i> <span>Permit</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="../clearance/clearance.php">
                                    <i class="fa fa-file"></i> <span>Request Form</span>
                                </a>
                            </li>

                            <li>
                                <a href="../clearance/announcement.php">
                                <i class="fa fa-bullhorn" aria-hidden="true"></i> <span>Announcement</span>
                                </a>
                            </li>

                            <li>
                            <a href="../clearance/all_resident.php">
                            <i class="fa fa-users" aria-hidden="true"></i> <span>All resident profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="../clearance/complaints.php">
                            <i class="fa fa-warning" aria-hidden="true"></i> <span>Complaints</span>
                            </a>
                            </li>
                            
                        <li>
                            <a href="../clearance/map.php">
                            <i class="fa fa-map" aria-hidden="true"></i> <span>Map</span>
                            </a>
                        </li>

                        </ul>';
} elseif (isset($_SESSION['staff'])) {
    echo '
                        <ul class="sidebar-menu">
                            <li>
                                <a href="../officials/officials.php">
                                    <i class="fa fa-user"></i> <span>Barangay Officials</span>
                                </a>
                            </li>
                            <li>
                                <a href="../household/household.php">
                                    <i class="fa fa-home"></i> <span>Household</span>
                                </a>
                            </li>
                            <li>
                                <a href="../resident/resident.php">
                                    <i class="fa fa-users"></i> <span>Resident</span>
                                </a>
                            </li>
                            <li>
                                <a href="../zone/zone.php">
                                    <i class="fa fa-user"></i> <span>Zone Leader</span>
                                </a>
                            </li>
                            <li>
                                <a href="../permit/permit.php">
                                    <i class="fa fa-file"></i> <span>Permit</span>
                                </a>
                            </li>
                            <li>
                                <a href="../blotter/blotter.php">
                                    <i class="fa fa-users"></i> <span>Blotter</span>
                                </a>
                            </li>
                            <li>
                                <a href="../clearance/clearance.php">
                                    <i class="fa fa-file"></i> <span>Clearance</span>
                                </a>
                            </li>
                            <li>
                                <a href="../activity/activity.php">
                                    <i class="fa fa-calendar"></i> <span>Activity</span>
                                </a>
                            </li>
                            
                        </ul>';
} else {
    echo '
                        <ul class="sidebar-menu">
                         <!-- <li>
                                <a href="../permit/permit.php">
                                    <i class="fa fa-file"></i> <span>Residency</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="../clearance/request_form.php">
                                    <i class="fa fa-file"></i> <span>Request</span>
                                </a>
                            </li>
                            <li>
                                <a href="../clearance/announcement.php">
                                <i class="fa fa-bullhorn" aria-hidden="true"></i> <span>Announcement</span>
                                </a>
                            </li>
                            <li>
                            <a href="../clearance/complaints.php">
                            <i class="fa fa-warning" aria-hidden="true"></i> <span>Complaints</span>
                            </a>
                            </li>

                          

                        </ul>';
}
echo '
                </section>
                <!-- /.sidebar -->
            </aside>
	';
?>


<!-- awdawd -->