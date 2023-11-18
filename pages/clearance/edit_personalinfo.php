<?php
 include "../connection.php";
session_start();

 if(isset($_POST["update_save"])){




    $f_name_mainuser = $_POST['f_name_mainuser'];
    $m_name_mainuser = $_POST['m_name_mainuser'];
    $l_name_mainuser = $_POST['l_name_mainuser'];
    
    $email_mainuser = $_POST['email_mainuser'];
    $contactno_mainuser = $_POST['contactno_mainuser'];
    $address_mainuser = $_POST['address_mainuser'];
    
    $culturalcom_mainuser = $_POST['culturalcom_mainuser'];

    $status_mainuser = $_POST['status_mainuser'];
    if ($_POST["status_mainuser"] == 'Single' || $_POST["status_mainuser"] == 'Widow' || $_POST["status_mainuser"] == 'Solo Parent') {

        $full_name_spouse = 'none';
        $bday_spouse = 'none';
        $occu_spouse = 'none';


    }else{

        $full_name_spouse = $_POST['full_name_spouse'];
        $bday_spouse = $_POST['bday_spouse'];
        $occu_spouse = $_POST['occu_spouse'];

    }


    $residence_mainuser = $_POST['residence_mainuser'];
    $pwd_mainuser = $_POST['pwd_mainuser'];

    $registervoter_mainuser = $_POST['registervoter_mainuser'];
    $benificiary_mainuser = $_POST['benificiary_mainuser'];
    $pensioner_mainuser = $_POST['pensioner_mainuser'];
    $income_mainuser = $_POST['income_mainuser'];

    $fullname_hholdhead = $_POST['fullname_hholdhead'];
    $birthdate_hholdhead = $_POST['birthdate_hholdhead'];
    $occupation_hholdhead = $_POST['occupation_hholdhead'];

    $resident_id = $_POST['resident_id'];



    $update_profile = mysqli_query($con,"UPDATE tbl_resident_new 
    set f_name = '".$_POST["f_name_mainuser"]."',
    m_name = '".$_POST["m_name_mainuser"]."',
    l_name = '".$_POST["l_name_mainuser"]."',
    email = '".$_POST["email_mainuser"]."',
    contact_no = '".$_POST["contactno_mainuser"]."',
    address = '".$_POST["address_mainuser"]."',
    fullname_hhead = '".$_POST["fullname_hholdhead"]."',
    bday_hhead = '".$_POST["birthdate_hholdhead"]."',
    occu_hhead = '".$_POST["occupation_hholdhead"]."',
    status = '".$_POST["status_mainuser"]."',
    fullname_spouse = '".$full_name_spouse."',
    bday_spouse = '".$bday_spouse."',
    occu_spouse = '".$occu_spouse."',
    specify_belongings = '".$_POST["culturalcom_mainuser"]."',
    residence_status = '".$_POST["residence_mainuser"]."',
    specify_resident_stat = '".$_POST["residence_mainuser"]."',
    pwd = '".$_POST["pwd_mainuser"]."',
    register_voter = '".$_POST["registervoter_mainuser"]."',
    specify_benificiary = '".$_POST["benificiary_mainuser"]."',
    specify_pensioner = '".$_POST["pensioner_mainuser"]."',
    income_month = '".$_POST["income_mainuser"]."'
    WHERE resident_id = '".$_POST["resident_id"]."' 
    ");



    if ($update_profile) {
      

        $_SESSION['message_userupdate'] = '<div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Personal Information</strong> has been successfully updated!
      </div>';

      header('Location: myprofile.php?ID='.$_POST['resident_id'].'');


    }else{

        $_SESSION['message_userupdate'] = '<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Please try again!</strong>
      </div>';

      header('Location: myprofile.php?ID='.$_POST['resident_id'].'');

    }
    
 }


 if (isset($_POST['update_profileimg'])) {

  function image_resize($image_type_id, $img_width, $img_height) {
            
    $target_width = 800;
    $target_height = 800;
    $target_layer= imagecreatetruecolor($target_width, $target_height);
    imagecopyresampled($target_layer, $image_type_id,0,0,0,0, $target_width, $target_height, $img_width, $img_height);
    return $target_layer;
}

    if(is_array($_FILES)) {



        $uploaded_file = $_FILES['change_profile']['tmp_name']; 
        $upl_img_properties = getimagesize($uploaded_file);
        $file_name_id= rand(10,100);
        $new_file_name = time()."_".$file_name_id;
        $folder_path = "../../pages/resident/image/";
        $img_exts = pathinfo($_FILES['change_profile']['name'], PATHINFO_EXTENSION);
        $img_ext = 'png';
        $image_type = $upl_img_properties[2];

        switch ($image_type) {
            //for PNG Image
            case IMAGETYPE_PNG:
                $image_type_id = imagecreatefrompng($uploaded_file); 
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagepng($target_layer, $folder_path. $new_file_name. ".". $img_ext);
                break;
            //for GIF Image
            case IMAGETYPE_GIF:
                $image_type_id = imagecreatefromgif($uploaded_file); 
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagepng($target_layer, $folder_path. $new_file_name.".". $img_ext);
                break;
            //for JPEG Image
            case IMAGETYPE_JPEG:
                $image_type_id = imagecreatefromjpeg($uploaded_file); 
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagepng($target_layer, $folder_path. $new_file_name.".". $img_ext);
                break;

            default:
                // echo "Please select a 'PNG', 'GIF'or JPEG image";
                exit;
                break;

        }


        $user_imgas = $new_file_name.".".$img_ext; //store in database

      }




      $update_profile = mysqli_query($con,"UPDATE tbl_resident_new 
      set profile_photo = '".$user_imgas."'
       WHERE resident_id = '".$_POST["resident_id"]."' 
       ");
       
       if ($update_profile) {
      
        unlink('../../pages/resident/image/'.$_POST['existing_photo']);

     
      header('Location: myprofile.php?ID='.$_POST['resident_id'].'');


    }else{

       echo '<script>alert("Please try again!")</script>';
      
       header('Location: myprofile.php?ID='.$_POST['resident_id'].'');

    }


 }
?>