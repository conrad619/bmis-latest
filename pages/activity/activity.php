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
                    <i class="fa fa-bullhorn" aria-hidden="true"></i> Announcement
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">
                                     
                                
                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <form method="post">
                                    <table id="table_all_annouce" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              
                                                <th class = "text-center">#</th>
                                                <th class = "text-center">&nbsp; &nbsp;</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Date Posted</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($_SESSION['role'] == "Administrator")
                                            {   
                                                $x = 1;
                                                $squery = mysqli_query($con, "select * from tbl_announcement");
                                                while($row = mysqli_fetch_array($squery))
                                                {
                                                    echo '
                                                 
                                                    <tr>
                                                        
                                                        <td class = "text-center">'.$x++.'</td>
                                                        <td class = "text-center"><img id = "myImg" src="../clearance/'.$row['ann_images'].'" width="70" alt=""></td>
                                                        <td>'.$row['ann_title'].'</td>
                                                        <td>'.$row['ann_description'].'</td>
                                                        <td>'.$row['ann_date_posted'].'</td>
                                                      
                                                    </tr>
                                                    ';

                                                    // include "edit_modal.php";
                                                    // include "view_modal.php";
                                                }

                                            }
                                            elseif(isset($_SESSION['resident'])){
                                                $squery = mysqli_query($con, "select * from tblactivity");
                                                while($row = mysqli_fetch_array($squery))
                                                {
                                                    echo '
                                                    <tr>
                                                        <td>'.$row['dateofactivity'].'</td>
                                                        <td>'.$row['activity'].'</td>
                                                        <td>'.$row['description'].'</td>
                                                        <td><button class="btn btn-primary btn-sm" data-target="#viewModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-search" aria-hidden="true"></i> Photo</button></td>
                                                    </tr>
                                                    ';

                                                    include "view_modal.php";
                                                }
                                            }
                                            else{
                                                $squery = mysqli_query($con, "select * from tblactivity");
                                                while($row = mysqli_fetch_array($squery))
                                                {
                                                    echo '
                                                    <tr>
                                                        <td>'.$row['dateofactivity'].'</td>
                                                        <td>'.$row['activity'].'</td>
                                                        <td>'.$row['description'].'</td>
                                                        <td>
                                                            <button class="btn btn-primary btn-sm" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                            <button class="btn btn-primary btn-sm" data-target="#viewModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-search" aria-hidden="true"></i> Photo</button>
                                                        </td>
                                                    </tr>
                                                    ';

                                                    include "edit_modal.php";
                                                    include "view_modal.php";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

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
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php }
        include "../footer.php"; ?>
<script type="text/javascript">

$(document).ready(function() {
    $('#table_all_annouce').DataTable({
    
        "columns":[
            {"data": "#"},
            {"data": " "},
            {"data": "Title"},
            {"data": "Description"},
            {"data": "Date Posted"}
        ]
    });
});

var select_all = document.getElementById("cbxMainphoto"); //select all checkbox
var checkboxes = document.getElementsByClassName("chk_deletephoto"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
    for (i = 0; i < checkboxes.length; i++) { 
        checkboxes[i].checked = select_all.checked;
    }
});


for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){
            select_all.checked = false;
        }
        //check "select all" if all checkbox items are checked
        if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
            select_all.checked = true;
        }
    });
}

    <?php
    if($_SESSION['role'] == "Administrator")
    {
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,4 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    elseif(isset($_SESSION['resident']))
    {
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    else{
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 4 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    ?>
</script>
    </body>
</html>