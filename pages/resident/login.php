<!DOCTYPE html>
<html>
<?php
session_start();
?>
    <head>
        <meta charset="UTF-8">
        <title>Resident || Barangay Information System</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
  .form-control{
  border-radius: 15px !important;
}
.btn{
  border-radius: 15px !important;

}
.panel-heading{
  border-radius: 15px !important;

}
.wrapper{
  margin:10px;
}
</style>
    </head>
    <body class="skin-black">
      
        <div class="container" style="margin-top:50px">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel-default">
            <div class="panel-heading" style="text-align:center;">
                <img src="../../img/logo-removebg-preview.png" style="height:100px;"/>
              <h3 class="panel-title" style ="padding-top:10px;">
                <strong>
                    Welcome Resident!
                </strong>
              </h3>
              <a href="register.php">No account yet? Register</a>
             
            </div>
            <div class="panel-body">
              <?php if (isset($_SESSION['message-alert'])) {
              

              echo $_SESSION['message-alert'];

              unset($_SESSION['message-alert']);

              }?>
              <form role="form" method="post">
                <div class="form-group">
                  <label for="txt_username" style = "color:white">Username</label>
                  <input type="text" class="form-control" style="border-radius:0px" name="txt_username" placeholder="Enter Username">
                </div>
                <div class="form-group">
                  <label for="txt_password" style = "color:white">Password</label>
                  <input type="password" id = "myInput" class="form-control" style="border-radius:0px" name="txt_password" placeholder="Enter Password">
                  <br>
                <input type="checkbox" onclick="myFunction_show()"> <label style = "color:white">Show Password</label>
                </div>
                <label id="error" class="label label-danger pull-right"></label> 

                <button type="submit" class="btn btn-sm btn-primary btn-block" name="btn_login">Log in</button>

              </form>
              <form action="action.php" method="post" style = "display:none;">
              <button type="submit" class="btn btn-sm btn-primary btn-block" name="awdawd">awdawd</button>
              </form>

            </div>
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



            $user = mysqli_query($con, "SELECT * from tbl_resident_new where username = '$username' AND password = '$password'");
            $numrow_user = mysqli_num_rows($user);

            if($numrow_user > 0)
            {
                while($row = mysqli_fetch_array($user)){

                  $_SESSION['role'] = $row['f_name'].' '.$row['l_name'];
                  $_SESSION['resident'] = 1;
                  $_SESSION['userid'] = $row['resident_id'];
                  $_SESSION['username'] = $row['username'];
                  // $_SESSION['profile_image'] = $row['username'];
                  $_SESSION['role_user'] = 'resident';


                }    
                header ('location: ../clearance/request_form.php');
            }
            else
            {
              echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Invalid Account";</script>';
               
            }
             
        }
        
      ?>

    </body>
</html>