
<?php
session_start();
include "../connection.php";

if (isset($_POST['register_now'])) {

    // step 1
    $txt_lname = $_POST['txt_lname'];
    $txt_fname = $_POST['txt_fname'];
    $txt_mname = $_POST['txt_mname'];
    $email = $_POST['email'];
    $phone_num = $_POST['phone_num'];
    $address = $_POST['address'];
    $u_name = $_POST['u_name'];
    $password = $_POST['password'];

    // step 2

    $fullname_hhead = $_POST['fullname_hhead'];
    $headb_date = $_POST['headb_date'];
    $head_occupation = $_POST['head_occupation'];

    $u_status = $_POST['u_status'];

    if ($u_status == 'Married' || $u_status == 'Live-in Partner') {

        $spouse_fullname = $_POST['spouse_fullname'];
        $spouseb_date = $_POST['spouseb_date'];
        $spouse_occupation = $_POST['spouse_occupation'];
    } else {

        $spouse_fullname = 'none';
        $spouseb_date = 'none';
        $spouse_occupation = 'none';
    }

    $spouse_fullname;
    $spouseb_date;
    $spouse_occupation;

    $belong_indigi = $_POST['belong_indigi'];

    if ($belong_indigi == 'Yes') {

        $specify_belong = $_POST['specify_belong'];
    } else {

        $specify_belong = 'none';
    }

    $specify_belong;



    //step 3

    $hm_f_name =  $_POST['f_name'];
    $hm_l_name =  $_POST['l_name'];
    $hm_m_name =  $_POST['m_name'];
    $hmemberb_date =  $_POST['hmemberb_date'];
    $hmember_relationship = $_POST['hmember_relationship'];
    $hmember_occupation = $_POST['hmember_occupation'];
    $household_member_uk = rand(1, 100) . time();

    foreach ($hm_f_name as $index => $hm_f_names) {


        $s_hm_f_name = $hm_f_names;
        $s_hm_l_name = $hm_l_name[$index];
        $s_hm_m_name = $hm_m_name[$index];
        $s_hmemberb_date = $hmemberb_date[$index];
        $s_hmember_relationship = $hmember_relationship[$index];
        $s_hmember_occupation = $hmember_occupation[$index];


        $query = "INSERT INTO tbl_resident_house_member (
            f_name,
            l_name,
            m_name,
            hmemberb_date,
            hmember_relationship,
            hmember_occupation,
            household_uk) 
            VALUES 
            (
            '$s_hm_f_name',
            '$s_hm_l_name',
            '$s_hm_m_name',
            '$s_hmemberb_date',
            '$s_hmember_relationship',
            '$s_hmember_occupation',
            '$household_member_uk'
            )";
        $query_run = mysqli_query($con, $query) or die(mysqli_error($con));
    }
    $last_id = $con->insert_id;
    if(isset($_SESSION['role'])){
        $action = 'Added new house member '.$s_hm_f_name.' with id '.$last_id;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }
    




    //loop


    //step 4
    $residence_status = $_POST['residence_status'];
    if ($residence_status == 'Other') {

        $other_status = $_POST['other_status'];
    } else {

        $other_status = 'none';
    }

    $other_status;



    $live_with_disa = $_POST['live_with_disa'];
    $register_voter = $_POST['register_voter'];

    $benificiary = $_POST['benificiary'];
    if ($benificiary == 'Yes') {
        $specify_benificiary = $_POST['specify_benificiary'];
    } else {
        $specify_benificiary = 'none';
    }
    $specify_benificiary;

    $pensioner = $_POST['pensioner'];

    if ($pensioner == 'Yes') {
        $specify_pensioner = $_POST['specify_pensioner'];
    } else {
        $specify_pensioner = 'none';
    }

    $specify_pensioner;
    $estd_mon_income = $_POST['estd_mon_income'];



    function image_resize($image_type_id, $img_width, $img_height)
    {

        $target_width = 500;
        $target_height = 500;
        $target_layer = imagecreatetruecolor($target_width, $target_height);
        imagecopyresampled($target_layer, $image_type_id, 0, 0, 0, 0, $target_width, $target_height, $img_width, $img_height);
        return $target_layer;
    }


    if (is_array($_FILES)) {

        $uploaded_file = $_FILES['uploadimage']['tmp_name'];
        $upl_img_properties = getimagesize($uploaded_file);
        $file_name_id = rand(10, 100);
        $new_file_name = time() . "_" . $file_name_id;
        $folder_path = "image/";
        $img_exts = pathinfo($_FILES['uploadimage']['name'], PATHINFO_EXTENSION);
        $img_ext = 'png';
        $image_type = $upl_img_properties[2];

        switch ($image_type) {
                //for PNG Image
            case IMAGETYPE_PNG:
                $image_type_id = imagecreatefrompng($uploaded_file);
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagepng($target_layer, $folder_path . $new_file_name . "." . $img_ext);
                break;
                //for GIF Image
            case IMAGETYPE_GIF:
                $image_type_id = imagecreatefromgif($uploaded_file);
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagepng($target_layer, $folder_path . $new_file_name . "." . $img_ext);
                break;
                //for JPEG Image
            case IMAGETYPE_JPEG:
                $image_type_id = imagecreatefromjpeg($uploaded_file);
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1]);
                imagepng($target_layer, $folder_path . $new_file_name . "." . $img_ext);
                break;

            default:
                exit;
                break;
        }


        $user_imgas = $new_file_name . "." . $img_ext; //store in database



    }


    $created_at = date('F j, Y g:ia');
    $remarks = $_POST['remarks'];


    // $query_2 = "INSERT INTO tbl_resident_new (`l_name`, `f_name`, `m_name`, `email`, `contact_no`, `address`, `username`, `password`, `fullname_hhead`, `bday_hhead`, `occu_hhead`, `status`, `fullname_spouse`, `bday_spouse`, `occu_spouse`, `belongings`, `specify_belongings`, `household_member_uk`, `residence_status`, `specify_resident_stat`, `pwd`, `register_voter`, `benificiary`, `specify_benificiary`, `pensioner`, `specify_pensioner`, `income_month`, `profile_photo`, `remarks`, `create_at`) 

    $query_2 = "INSERT INTO tbl_resident_new (
                l_name, 
                f_name,
                m_name, 
                email, 
                contact_no, 
                address, 
                username, 
                password, 
                fullname_hhead, 
                bday_hhead, 
                occu_hhead, 
                status, 
                fullname_spouse, 
                bday_spouse, 
                occu_spouse, 
                belongings, 
                specify_belongings, 
                household_member_uk, 
                residence_status, 
                specify_resident_stat, 
                pwd, 
                register_voter, 
                benificiary, 
                specify_benificiary, 
                pensioner, 
                specify_pensioner, 
                income_month, 
                profile_photo, 
                remarks, 
                create_at) 
                VALUES 
                (
                    '$txt_lname',
                    '$txt_fname',
                    '$txt_mname',
                    '$email',
                    '$phone_num',
                    '$address',
                    '$u_name',
                    '$password',
                    '$fullname_hhead',
                    '$headb_date',
                    '$head_occupation',
                    '$u_status',
                    '$spouse_fullname',
                    '$spouseb_date',
                    '$spouse_occupation',
                    '$belong_indigi',
                    '$specify_belong', 
                    '$household_member_uk',
                    '$residence_status',
                    '$other_status',
                    '$live_with_disa',
                    '$register_voter',
                    '$benificiary',
                    '$specify_benificiary',
                    '$pensioner',
                    '$specify_pensioner',
                    '$estd_mon_income',
                    '$user_imgas',
                    '$remarks',
                    '$created_at'
                )";
    $query_run_2 = mysqli_query($con, $query_2) or die(mysqli_error($con));

    $last_id = $con->insert_id;
    if(isset($_SESSION['role'])){
        $action = 'Added new resident '.$s_hm_f_name.' with id '.$last_id;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    //here
    if ($query_run_2) {

        //here
        $owner_relationship = 'Owner account';
        $query_foruser = "INSERT INTO tbl_resident_house_member (
    f_name,
    l_name,
    m_name,
    hmemberb_date,
    hmember_relationship,
    hmember_occupation,
    household_uk) 
    VALUES 
    (
    '$txt_fname',
    '$txt_lname',
    '$txt_mname',
    '$headb_date',
    '$owner_relationship',
    '$head_occupation',
    '$household_member_uk'
    )";
        $query_run_query_foruser = mysqli_query($con, $query_foruser) or die(mysqli_error($con));
        //here


        $_SESSION['message-alert'] = '<div class="alert alert-success alert-dismissible" style = "border-radius:20px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Account created successfully!</strong> You can now login.
                    </div>';


        echo '<script>window.location = "login.php"</script>';
    } else {


        echo '<script type="text/javascript">alert("Failed to insert");</script>';
    }
    $last_id = $con->insert_id;
    if(isset($_SESSION['role'])){
        $action = 'Added new resident house member '.$s_hm_f_name.' with id '.$last_id;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }
    
}


// if (isset($_POST['awdawd'])) {


//                    $_SESSION['message-alert'] = '<div class="alert alert-success alert-dismissible" style = "border-radius:20px;">
//                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
//                     <strong>Account created successfully!</strong> You can now login.
//                     </div>';


//                     echo '<script>window.location = "login.php"</script>';
// }
?>