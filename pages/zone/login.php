<!DOCTYPE html>
<html>
<?php
session_start();
?>
    <head>
        <meta charset="UTF-8">
        <title>Barangay Information System</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

    </head>
    <body class="skin-black">
        <div class="container" style="margin-top:30px">
          <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default">
            <div class="panel-heading" style="text-align:center;">
                <img src="../../img/logo-removebg-preview.png" style="height:110px;"/>
              <h3 class="panel-title">
                <strong>
                    Barangay Zone Leader
                </strong>
              </h3>
            </div>
            <div class="panel-body">
              <form role="form" method="post">
                <div class="form-group">
                  <label for="txt_username" style = "color:white">Username</label>
                  <input type="text" class="form-control" style="border-radius:0px" name="txt_username" placeholder="Enter Username">
                </div>
                <div class="form-group">
                  <label for="txt_password" style = "color:white">Password</label>
                  <input type="password" id = "myInput" class="form-control" style="border-radius:0px" name="txt_password" placeholder="Enter Password">
                                  <input type="checkbox" onclick="myFunction_show()"> <label style = "color:white">Show Password</label>

                </div>
                <button type="submit" class="btn btn-sm btn-primary" name="btn_login">Log in</button>
                <label id="error" class="label label-danger pull-right"></label> 
              </form>
            </div>
          </div>
          </div>
        </div>
            <script>
function myFunction_show() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

      <?php
        include "../connection.php";
        if(isset($_POST['btn_login']))
        { 
            $username = $_POST['txt_username'];
            $password = $_POST['txt_password'];

            $user = mysqli_query($con, "SELECT * from tblzone where username = '$username' and password = '$password' ");
            $numrow_user = mysqli_num_rows($user);

            if($numrow_user > 0)
            {
                while($row = mysqli_fetch_array($user)){
                  $_SESSION['role'] = "Zone Leader";
                  $_SESSION['userid'] = $row['id'];
                  $_SESSION['username'] = $row['username'];
                }    
                header ('location: ../clearance/clearance.php');
            }
            else
            {
              echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Invalid Account";</script>';
               
            }

            if(isset($_SESSION['role'])){
              $action = 'logged in';
              $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
            }
             
        }
        
      ?>

    </body>
</html>