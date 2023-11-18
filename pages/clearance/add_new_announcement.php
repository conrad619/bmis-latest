<?php
date_default_timezone_set('Asia/Manila');

include "../connection.php";

session_start();



if (isset($_POST['submit_ann'])) {
    # code...

function image_resize($image_type_id, $img_width, $img_height) {
            
    $target_width = 800;
    $target_height = 800;
    $target_layer= imagecreatetruecolor($target_width, $target_height);
    imagecopyresampled($target_layer, $image_type_id,0,0,0,0, $target_width, $target_height, $img_width, $img_height);
    return $target_layer;
}

    if(is_array($_FILES)) {



        $uploaded_file = $_FILES['uploadimage']['tmp_name']; 
        $upl_img_properties = getimagesize($uploaded_file);
        $file_name_id= rand(10,100);
        $new_file_name = time()."_".$file_name_id;
        $folder_path = "image_ann/";
        $img_exts = pathinfo($_FILES['uploadimage']['name'], PATHINFO_EXTENSION);
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


        $ann_images = $folder_path. $new_file_name. ".".$img_ext; //store in database
        $date_now = date('F j, Y g:ia');

        $information_insert = mysqli_query($con,"INSERT INTO tbl_announcement (ann_title,ann_description,ann_images,ann_date_posted) 
        values ('".$_POST['ann_title']."', '".$_POST['ann_description']."', '".$ann_images."', '".$date_now."')");
        //$req_form_information_id = mysqli_insert_id($con);

        if ($information_insert) {
          
            
            $_SESSION['pop_messega_ann'] = '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Announcement post successfully!</strong>
            </div>';

            header('Location: announcement.php');
         

        }else{


            $_SESSION['pop_messega_ann'] = '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Please try again!</strong>
            </div>';

            header('Location: announcement.php');

        }
    }

}


if (isset($_POST['update_announcement'])) {


    function image_resize($image_type_id, $img_width, $img_height) {
            
        $target_width = 800;
        $target_height = 800;
        $target_layer= imagecreatetruecolor($target_width, $target_height);
        imagecopyresampled($target_layer, $image_type_id,0,0,0,0, $target_width, $target_height, $img_width, $img_height);
        return $target_layer;
    }
    


    $ann_title = $_POST['ann_title'];
    $ann_description = $_POST['ann_description'];

    if (empty($_FILES['new_photo']['name'])) { //if exist

       

        $ann_images = $_POST['existing_photo']; //if exist

       

    }else{


        if(is_array($_FILES)) {
    
    
            unlink($_POST['existing_photo']);

            $uploaded_file = $_FILES['new_photo']['tmp_name']; 
            $upl_img_properties = getimagesize($uploaded_file);
            $file_name_id= rand(10,100);
            $new_file_name = time()."_".$file_name_id;
            $folder_path = "image_ann/";
            $img_exts = pathinfo($_FILES['new_photo']['name'], PATHINFO_EXTENSION);
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
    
    
            $ann_images = $folder_path. $new_file_name. ".".$img_ext; //store in database
            $date_now = date('F j, Y g:ia');
    
            
        }

    }



    //update here ann_title ann_description
    $tbl_announcement = mysqli_query($con,"UPDATE tbl_announcement set ann_title = '".$_POST["ann_title"]."', ann_description = '".$_POST["ann_description"]."', ann_images = '".$ann_images."'  WHERE announce_id = '".$_POST["announce_id"]."' ");

    
            if ($tbl_announcement) {
              
                
                $_SESSION['pop_messega_ann'] = '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>'.$_POST['ann_title'].' announcement has been updated successfully!</strong>
                </div>';
    
                header('Location: announcement.php');
             
    
            }else{
    
    
                $_SESSION['pop_messega_ann'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Please try again!</strong>
                </div>';
    
                header('Location: announcement.php');
    
            }

}

// delete_announcement
if (isset($_POST['delete_announcement'])) {

    $ann_title = $_POST['ann_title'];
    $announce_id = $_POST['announce_id'];
    $existing_photo = $_POST['existing_photo'];

    $delete_query = mysqli_query($con,"DELETE from tbl_announcement where announce_id = '$announce_id' ") or die('Error: ' . mysqli_error($con));
                    

    if ($delete_query) {
              
         
        unlink($_POST['existing_photo']);

        
        $_SESSION['pop_messega_ann'] = '<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>'.$_POST['ann_title'].' announcement has been deleted successfully!</strong>
        </div>';

        header('Location: announcement.php');
     

    }else{


        $_SESSION['pop_messega_ann'] = '<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Please try again!</strong>
        </div>';

        header('Location: announcement.php');

    }

}

?>