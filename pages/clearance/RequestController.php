<?php
    
    // echo json_encode(array('success' => 0));
    if(isset($_POST["user_id"])){
        include "../connection.php";
        $status = "Pending";
        
        $information_insert = mysqli_query($con,"INSERT INTO request_form_information (user_id,house_member_id,address,status) 
        values (".$_POST['user_id'].", '".$_POST['household_member_id']."', '".$_POST["resident_address"]."','".$status."')");
        $req_form_information_id = mysqli_insert_id($con);
        $date_deceased = $_POST['day_of_deceased'] == '' ? "null" : $_POST['day_of_deceased'];

      
        // $request_form_type_insert = mysqli_query($con,"INSERT INTO request_form_type (req_form_information_id,req_id,purpose,
        // terms_of_living,
        // cedula_number,
        // date_deceased,place_of_death,
        // father_name,mother_name,father_age,mother_age,
        // animal_name,num_animal,sell_to,address_person,
        // name_partner,bdate_partner,living_together,num_living_together) 
        // values ('".$req_form_information_id."', '".$_POST["req_type"]."', '".$_POST["purpose"]."',
        // '".$_POST["terms_of_living"]."',
        // '".$_POST["cedula_number"]."',
        // '".$date_deceased."','".$_POST["place_of_death"]."',
        // '".$_POST["father_name"]."','".$_POST["mother_name"]."','".$_POST["father_age"]."','".$_POST["mother_age"].",
        // '".$_POST["animal_name"]."','".$_POST["num_animal"]."','".$_POST["sell_to"]."','".$_POST["address_person"].",
        // '".$_POST["name_partner"]."','".$_POST["bdate_partner"]."','".$_POST["living_together"]."','".$_POST["num_living_together"]."')");

        $request_form_type_insert = mysqli_query($con,"INSERT INTO request_form_type (req_form_information_id,req_id,purpose,
        terms_of_living,
        cedula_number,
        date_deceased,place_of_death,
        father_name,mother_name,father_age,mother_age,
        animal_name,num_animal,sell_to,address_person,
        name_partner,bdate_partner,living_together,num_living_together) 
        values ('".$req_form_information_id."', '".$_POST['req_type']."', '".$_POST['purpose']."',
        '".$_POST['terms_of_living']."',
        '".$_POST['cedula_number']."',
        '".$date_deceased."','".$_POST['place_of_death']."',
        '".$_POST['father_name']."','".$_POST['mother_name']."','".$_POST['father_age']."','".$_POST['mother_age']."',
        '".$_POST['animal_name']."','".$_POST['num_animal']."','".$_POST['sell_to']."','".$_POST['address_person']."',
        '".$_POST['name_partner']."','".$_POST['bdate_partner']."','".$_POST['living_together']."','".$_POST['num_living_together']."')");

        // $request_form_type_insert = mysqli_query($con,"INSERT INTO request_form_type (

        // req_form_information_id,
        // req_id,
        // purpose,
        // terms_of_living

        // ) 
        // values (
        
        // '".$req_form_information_id."', 
        // '".$_POST['req_type']."',
        // '".$_POST['purpose']."',
        // '".$_POST['terms_of_living']."',
        // '".$_POST['cedula_number']."',
        // '".$date_deceased."', '".$_POST['place_of_death']."',
        // '".$_POST['father_name']."','".$_POST['mother_name']."','".$_POST['father_age']."','".$_POST['mother_age']."',
       

        // )");
        
        $req_form_type_id = mysqli_insert_id($con);
        $get_fee = mysqli_query($con,"select * from form_type where req_id = ".$_POST['req_type']." limit 1 ");
        $form_amount = mysqlI_fetch_array($get_fee);
        $amount = 0;
        $pay_method_result = mysqli_query($con,"select * from payment_method where pay_id = 1 limit 1 ");
        $pay_restult = mysqlI_fetch_array($pay_method_result);
        $shiping_fee = 0;
        $tax = 0;
        $total_amount = 0;
        $request_form_type_insert_2 = mysqli_query($con,"INSERT INTO receipt_transaction (req_form_information_id,req_id,req_form_type_id,pay_id,contact_no,total_amount,delivery_address,`status`) 
        values (".$req_form_information_id.", ".$_POST['req_type'].", ".$req_form_type_id.",".$pay_restult["pay_id"].",'".$_POST["contact_no"]."', '".$total_amount."',
        '".$_POST["address_to_deliver"]."',0)");
        $reciept_id = mysqli_insert_id($con);

        // $squery = mysqli_query($con, "SELECT * FROM tbl_resident_house_member where household_id = ".$_POST["household_member_id"]."") or die('Error: ' . mysqli_error($con));

        $sql = "SELECT * FROM tbl_resident_house_member WHERE household_id = ".$_POST["household_member_id"]."";
        $user_member = $con->query($sql) or die ($con->error);
        $row = $user_member->fetch_assoc();
    

        $data = array(
            "success" => 0,
            "data" => array(
            "household_member_id" => $row['f_name'].' '.$row['l_name'].' '.$row['m_name'],
            "resident_address" => $_POST["resident_address"],
            "request_type" => $form_amount["request_type"],
            "purpose" => $_POST["purpose"],
            "amount_form" => $amount,
            "shiping_fee" => $shiping_fee,
            "tax" => $tax,
            "total_amount" => $total_amount,
            "contact_no" => 0,
            "address_to_deliver" => 0,
            "reciept_id" => $reciept_id
            )
        );
        echo json_encode($data);
    }

    if(isset($_POST["value"])) {
        include "../connection.php";
        $information_insert = mysqli_query($con,"UPDATE receipt_transaction set status = ".$_POST["status"]." WHERE recep_id = ".$_POST["value"]." ");
    }
    // header ('location: ../../main');
?>