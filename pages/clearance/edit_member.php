

<?php
 include "../connection.php";
 session_start();
 if(isset($_POST["updatemember"])){


    $household_id = $_POST["household_id"];
    $f_name = $_POST["f_name"];
    $m_name = $_POST["m_name"];
    $l_name = $_POST["l_name"];
    $hmemberb_date = $_POST["hmemberb_date"];
    $hmember_relationship = $_POST["hmember_relationship"];
    $hmember_occupation = $_POST["hmember_occupation"];

    $hmember_occupation = $_POST["hmember_occupation"];
 
    $household_uk = $_POST["household_uk"];


    $update_profile = mysqli_query($con,"UPDATE tbl_resident_house_member 
    set f_name = '".$f_name."',
    l_name = '".$l_name."',
    m_name = '".$m_name."',
    hmemberb_date = '".$hmemberb_date."',
    hmember_relationship = '".$hmember_relationship."',
    hmember_occupation = '".$hmember_occupation."'
    WHERE household_id  = '".$household_id."' 
     ");
     
     if ($update_profile) {
    

   

    $_SESSION['popup_msg_member'] = '<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>'.$f_name.' '.$l_name.' '.$m_name.' successfully updated!</strong>
    </div>';


    header('Location: view_householdmember.php?ID='.$household_uk.'');


  }else{

     echo '<script>alert("Please try again!")</script>';
    
     header('Location: view_householdmember.php?ID='.$household_uk.'');

  }



 } 


 

 if(isset($_POST["deletemember"])){

    $household_id = $_POST["household_id"];
    $f_name = $_POST["f_name"];
    $m_name = $_POST["m_name"];
    $l_name = $_POST["l_name"];
    $household_uk = $_POST["household_uk"];

    $delete_query = mysqli_query($con,"DELETE from tbl_resident_house_member where household_id = '$household_id' ") or die('Error: ' . mysqli_error($con));
                    

    if ($delete_query) {
              
         

        
        $_SESSION['popup_msg_member'] = '<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>'.$_POST['f_name'].' '.$_POST['m_name'].' '.$_POST['l_name'].' has been deleted successfully!</strong>
        </div>';

     header('Location: view_householdmember.php?ID='.$household_uk.'');
     

    }else{


        $_SESSION['popup_msg_member'] = '<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Please try again!</strong>
        </div>';

     header('Location: view_householdmember.php?ID='.$household_uk.'');

    }



 }

?>