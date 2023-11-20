<?php
session_start();
date_default_timezone_set('Asia/Manila');

include "../connection.php";

if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body onload="window.print()" onafterprint="self.close()">

    <style>
        body {
            font-family: Tahoma, Verdana, Segoe, sans-serif;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .main {
            padding-left: 50px;
            padding-right: 50px;
        }

        .text-center {
            text-align: center;
        }

        .title_form {

            font-size: 60px;

        }

        p {
            font-size: 20px;
        }

        .thick {
            font-weight: bold;
        }

        .text-underline {
            text-decoration: underline;
        }

        .upper-case {
            text-transform: uppercase;
        }

        section {

            line-height: 1.5;
            text-align: justify;
            text-justify: inter-word;

        }
    </style>




    <img src="../../img/header_bg.jpg" alt="" class="center">

    <?php

    $date_now = date("Y-m-d");

    // $bday = new DateTime('2000-11-28');
    // // $today = new DateTime('00:00:00'); - use this for the current date
    // $today = new DateTime($date_now); // for testing purposes

    // $diff = $today->diff($bday);
    // $diff->y;
    // //printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);


    //form type
    //Transporation of animal and slaughter
    // $two_form = 2; //Birth certificate
    // $three_form = 3; //Live-in certificate
    // $four_form = 4; //Death certificate
    // $five_form = 5; //Indigency-(purpose: billing)
    // $six_form = 6; //Cert of low income
    // $seven_form = 7; //Cert of residency
    // $eight_form = 8; //Barangay clearance
    //$value['req_id'] = 1; 
    $request_id = $_GET['ID'];

    $squery_new = mysqli_query($con, "SELECT form_table1.*,form_table2.*,form_table3.*,form_table4.*, form_table5.f_name as fname_acc_own, form_table5.l_name as lname_acc_own,form_table5.m_name as mname_acc_own 
FROM request_form_type as form_table1 
inner join request_form_information as form_table2 on form_table1.req_form_information_id = form_table2.req_form_information_id 
inner join form_type as form_table3 on form_table1.req_id = form_table3.req_id 
inner join tbl_resident_house_member as form_table4 on form_table2.house_member_id = form_table4.household_id
inner join tbl_resident_new as form_table5 on form_table2.user_id = form_table5.resident_id
WHERE form_table1.req_form_type_id  = '$request_id'
") or die('Error: ' . mysqli_error($con));

    if (mysqli_num_rows($squery_new) > 0) {

        $value = $squery_new->fetch_assoc();

        $id_request_form = $value['req_form_information_id'];

        $set_schedule = mysqli_query($con, "UPDATE request_form_information
    set status = 'completed' WHERE req_form_information_id  = '" . $id_request_form . "'") or die('Error: ' . mysqli_error($con));

        if(isset($_SESSION['role'])){
            $action = 'Updated request form status to completed with  id '. $row['req_form_information_id '];
            $iquery = mysqli_query($con,"INSERT INTO tbllogs (userid,user,username,logdate,action) values ('".$_SESSION['userid']."', '".$_SESSION['role']."','".$_SESSION['username']."',  NOW(), '".$action."')");
        }



        $animal_numssss = 3;
        $animal_namessss = 'pigs';


        $day =  date('j');
        $month = date('F');
        $year = date('Y');


    ?>

        <?php

        if ($value['req_id'] == 1) { //Transporation of animal and slaughter


            if ($value['num_animal'] > 1) {

                $animal_name = $value['animal_name'] . 's';
                $heads = 'heads';
            } else {

                $animal_name = $value['animal_name'];
                $heads = 'head';
            }
        ?>
            <section class="main">
                <h1 class="text-center title_form">BARANGAY CERTIFICATION</h1>
                <p>To Whom It May Concern: </p>
                <p> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;This is to certify that <span class="text-underline thick upper-case"><?= $value['f_name'] . ' ' . $value['l_name'] ?></span>, of legal age, is a bona fide resident of <?= $value['address'] ?>, Los Amigos, Tugbok District, Davao City.</p>

                <p>
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;This further certifies that the abovementioned sell <span class="thick"><?= strtolower(numberTowords($value['num_animal'])) ?> (<?= $value['num_animal'] ?>) <?= $heads ?></span> of live <?= $animal_name ?> to <span class="text-underline thick upper-case"><?= $value['sell_to'] ?></span>, a resident of <?= $value['address_person'] ?>.
                </p>

                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    This certification is issued upon the request of the aforementioned for <span class="text-underline thick upper-case"><?= $value['purpose'] ?></span> or for whatever legal purposes that serves her/him best.
                </p>

                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    Done this <?= addOrdinalNumberSuffix($day); ?> day of <?= $month . ' ' . $year ?> at Barangay Los Amigos, Tugbok District, Davao City.
                </p>

                <br>
                <br>

                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <span class="text-underline thick upper-case">ROBERTO A. BALLARTA</span></p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Punong Barangay</p>
            </section>
        <?php } //Transporation of animal and slaughter 
        ?>


        <?php
        if ($value['req_id'] == 2) {  //Birth certificate


            $bday = new DateTime($value['hmemberb_date']); //birthday
            // $today = new DateTime('00:00:00'); - use this for the current date
            $today = new DateTime($date_now); // for testing purposes

            $diff = $today->diff($bday);
            $diff->y;
            // //printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
        ?>

            <section class="main">
                <h1 class="text-center title_form">BARANGAY CERTIFICATION</h1>
                <p>To Whom It May Concern: </p>
                <p> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;This is to certify that <span class="text-underline thick upper-case"><?= $value['f_name'] . ' ' . $value['l_name'] ?></span>, <?= $diff->y ?> years old was born on <?= date_format($bday, "F j, Y"); ?> and a bona fide resident of Purok <?= $value['address'] ?>, Los Amigos, Tugbok District, Davao City.</p>

                <p>
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This further certifies that the abovementioned is the daughter of <span class="text-underline thick upper-case"><?= $value['mother_name'] ?> (Mother)</span>, <?= $value['mother_age'] ?> years old and <span class="text-underline thick upper-case"><?= $value['father_name'] ?> (Father)</span>, <?= $value['father_age'] ?> years old.

                </p>

                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    This certification is issued upon the request of the abovementioned for <span class="text-underline thick upper-case"><?= $value['purpose'] ?></span> or for whatever purposes that may serve him/her best.
                </p>

                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    Done this <?= addOrdinalNumberSuffix($day); ?> day of <?= $month . ' ' . $year ?> at Barangay Los Amigos, Tugbok District, Davao City.
                </p>

                <br>
                <br>


                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <span class="text-underline thick upper-case">ROBERTO A. BALLARTA</span></p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Punong Barangay</p>
            </section>

        <?php }  //Birth certificate 
        ?>

        <?php
        if ($value['req_id'] == 3) {  //Live-in certificate

            $bday = new DateTime($value['hmemberb_date']); //birthday
            $bday_partner = new DateTime($value['bdate_partner']); //birthday

            // $today = new DateTime('00:00:00'); - use this for the current date
            $today = new DateTime($date_now); // for testing purposes

            $diff = $today->diff($bday);
            $partner_age = $today->diff($bday_partner);
            $diff->y;
            $partner_age->y;
            // //printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
        ?>
            <section class="main">
                <h1 class="text-center title_form">BARANGAY CERTIFICATION</h1>
                <p>To Whom It May Concern: </p>
                <p> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;This is to certify that <span class="text-underline thick upper-case"><?= $value['f_name'] . ' ' . $value['l_name'] ?> </span>, <?= $diff->y ?> years old and <span class="text-underline thick upper-case"><?= $value['name_partner'] ?></span> <?= $partner_age->y ?> years old both bona fide residents of <?= $value['address'] ?>, Los Amigos, Tugbok District, Davao City.</p>

                <p>
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This further certifies that the abovementioned is living together as common law partner for <span class="text-underline thick upper-case"><?= strtolower(numberTowords($value['num_living_together'])) ?> (<?= $value['num_living_together'] ?>) <?= $value['living_together'] ?>/s </span>.

                </p>

                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    This certification is issued upon the request of the aforementioned for whatever legal purposes that serves her/him best.
                </p>

                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    Done this <?= addOrdinalNumberSuffix($day); ?> day of <?= $month . ' ' . $year ?> at Barangay Los Amigos, Tugbok District, Davao City.
                </p>

                <br>
                <br>


                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <span class="text-underline thick upper-case">ROBERTO A. BALLARTA</span></p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Punong Barangay</p>
            </section>
        <?php }  //Live-in certificate 
        ?>


        <?php
        if ($value['req_id'] == 4) {  //Death certificate

            $bday = new DateTime($value['hmemberb_date']); //birthday
            $date_deceased = new DateTime($value['date_deceased']); //birthday

            // $today = new DateTime('00:00:00'); - use this for the current date
            $today = new DateTime($date_now); // for testing purposes

            $diff = $today->diff($bday);
            $diff->y;
        ?>
            <section class="main">
                <h1 class="text-center title_form">BARANGAY CERTIFICATION</h1>
                <p>To Whom It May Concern: </p>
                <p> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This is to certify that <span class="text-underline thick upper-case"><?= $value['f_name'] . ' ' . $value['l_name'] ?></span>, <?= $diff->y ?> years old, was born on <span class="thick"><?= date_format($bday, "F j, Y"); ?></span> and was a bona fide resident of <?= $value['address']  ?>, Barangay Los Amigos, Tugbok District, Davao City.

                </p>

                <p>
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This further certifies that the abovementioned died, <span class="thick"><?= date_format($date_deceased, "F j, Y"); ?></span> , at his/ her residence at <span class="thick"><?= $value['place_of_death']  ?></span> and is not a Person Under Monitoring (PUM) nor a Person Under Investigation (PUI) in this barangay.

                </p>

                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This certification is issued upon the request of the immediate family for whatever legal purpose/s that may serve her/him best.
                </p>

                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    Done this <?= addOrdinalNumberSuffix($day); ?> day of <?= $month . ' ' . $year ?> at Barangay Los Amigos, Tugbok District, Davao City.
                </p>

                <br>
                <br>


                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <span class="text-underline thick upper-case">ROBERTO A. BALLARTA</span></p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Punong Barangay</p>
            </section>
        <?php }  //Death certificate 
        ?>


        <?php
        if ($value['req_id'] == 5) {  //Indigency-(purpose: billing)
        ?>
            <section class="main">
                <h1 class="text-center title_form">BARANGAY CERTIFICATION</h1>
                <p>To Whom It May Concern: </p>
                <p> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This is to certify that <span class="text-underline thick upper-case"><?= $value['f_name'] . ' ' . $value['l_name'] ?></span>, of legal age and a bona fide resident of <?= $value['address']  ?>, Barangay Los Amigos, Tugbok District, Davao City.

                </p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    This further certifies that the abovementioned belongs to an indigent family in this Barangay.
                </p>
                <p>
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This certification is issued upon the request of the aforementioned for <span class="text-underline thick upper-case"><?= $value['purpose']  ?></span> or for whatever legal purpose/s that may serve her/him best.

                </p>

                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    Done this <?= addOrdinalNumberSuffix($day); ?> day of <?= $month . ' ' . $year ?> at Barangay Los Amigos, Tugbok District, Davao City.
                </p>

                <br>
                <br>


                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <span class="text-underline thick upper-case">ROBERTO A. BALLARTA</span></p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Punong Barangay</p>
            </section>
        <?php }  //Indigency-(purpose: billing) 
        ?>


        <?php
        if ($value['req_id'] == 6) {  //Cert of low income
        ?>
            <section class="main">
                <h1 class="text-center title_form">CERTIFICATE OF LOW INCOME</h1>
                <p>To Whom It May Concern: </p>
                <p> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This is to certify that <span class="text-underline thick upper-case"><?= $value['f_name'] . ' ' . $value['l_name'] ?></span>, legal age and a bona fide resident of <?= $value['address']  ?>, Barangay Los Amigos, Tugbok District, Davao City.

                </p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    This further certifies that the abovementioned belongs to a family with low income.
                </p>
                <p>
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This certification is issued upon the request of the aforementioned for <span class="text-underline thick upper-case"><?= $value['purpose']  ?></span> or for whatever legal purpose/s that may serve her/him best.

                </p>

                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    Done this <?= addOrdinalNumberSuffix($day); ?> day of <?= $month . ' ' . $year ?> at Barangay Los Amigos, Tugbok District, Davao City.
                </p>

                <br>
                <br>


                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <span class="text-underline thick upper-case">ROBERTO A. BALLARTA</span></p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Punong Barangay</p>
            </section>
        <?php }  //Cert of low income 
        ?>

        <?php
        if ($value['req_id'] == 7) {  //Cert of residency
        ?>
            <section class="main">
                <h1 class="text-center title_form">CERTIFICATE OF RESIDENCY</h1>
                <p>To Whom It May Concern: </p>
                <p> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This is to certify that <span class="text-underline thick upper-case"><?= $value['f_name'] . ' ' . $value['l_name'] ?></span>, of legal age, a bona fide resident of <?= $value['address']  ?>, Barangay Los Amigos, Tugbok District, Davao City.

                </p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    This certification is issued upon the request of the aforementioned for whatever legal purposes that serves her/him best. </p>


                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    Done this <?= addOrdinalNumberSuffix($day); ?> day of <?= $month . ' ' . $year ?> at Barangay Los Amigos, Tugbok District, Davao City.
                </p>

                <br>
                <br>


                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <span class="text-underline thick upper-case">ROBERTO A. BALLARTA</span></p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Punong Barangay</p>
            </section>
        <?php }  //Cert of residency 
        ?>


        <?php
        if ($value['req_id'] == 8) {  //Barangay clearance 

            $day =  date('j');
            $month = date('F');
            $year = date('Y');
        ?>
            <section class="main">
                <h1 class="text-center title_form">BARANGAY CLEARANCE</h1>
                <p>To Whom It May Concern: </p>
                <p> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This is to certify that as per records now existing in this office <span class="text-underline thick upper-case"><?= $value['f_name'] . ' ' . $value['l_name'] ?></span>, of legal age and a resident of <?= $value['address']  ?>, Barangay Los Amigos, Tugbok District, Davao City, Philippines with Community Tax Certificate No. <span class="text-underline thick upper-case"><?= $value['cedula_number']  ?></span> issued on <span class="text-underline thick"><?= $month . ', ' . $day . ' ' . $year  ?></span> at Davao City has not been convicted of any Crime, Criminal, Civil nor there is any pending case filed against him/her.

                </p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                    This certification is issued upon the request of the aforementioned for <span class="text-underline thick upper-case"><?= $value['purpose']  ?></span> or for whatever legal purposes that serves her/him best.

                </p>


                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    Done this <?= addOrdinalNumberSuffix($day); ?> day of <?= $month . ' ' . $year ?> at Barangay Los Amigos, Tugbok District, Davao City.
                </p>

                <br>
                <br>


                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <span class="text-underline thick upper-case">ROBERTO A. BALLARTA</span></p>
                <p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Punong Barangay</p>
            </section>
        <?php }  //Barangay clearance 
        ?>

        <br>
        <br>
        <img src="../../img/footer_bg.jpg" alt="" class="center">

    <?php } ?>
</body>

</html>

<?php
function numberTowords($num)
{

    $ones = array(
        0 => "ZERO",
        1 => "ONE",
        2 => "TWO",
        3 => "THREE",
        4 => "FOUR",
        5 => "FIVE",
        6 => "SIX",
        7 => "SEVEN",
        8 => "EIGHT",
        9 => "NINE",
        10 => "TEN",
        11 => "ELEVEN",
        12 => "TWELVE",
        13 => "THIRTEEN",
        14 => "FOURTEEN",
        15 => "FIFTEEN",
        16 => "SIXTEEN",
        17 => "SEVENTEEN",
        18 => "EIGHTEEN",
        19 => "NINETEEN",
        "014" => "FOURTEEN"
    );
    $tens = array(
        0 => "ZERO",
        1 => "TEN",
        2 => "TWENTY",
        3 => "THIRTY",
        4 => "FORTY",
        5 => "FIFTY",
        6 => "SIXTY",
        7 => "SEVENTY",
        8 => "EIGHTY",
        9 => "NINETY"
    );
    $hundreds = array(
        "HUNDRED",
        "THOUSAND",
        "MILLION",
        "BILLION",
        "TRILLION",
        "QUARDRILLION"
    ); /*limit t quadrillion */
    $num = number_format($num, 2, ".", ",");
    $num_arr = explode(".", $num);
    $wholenum = $num_arr[0];
    $decnum = $num_arr[1];
    $whole_arr = array_reverse(explode(",", $wholenum));
    krsort($whole_arr, 1);
    $rettxt = "";
    foreach ($whole_arr as $key => $i) {

        while (substr($i, 0, 1) == "0")
            $i = substr($i, 1, 5);
        if ($i < 20) {
            /* echo "getting:".$i; */
            $rettxt .= $ones[$i];
        } elseif ($i < 100) {
            if (substr($i, 0, 1) != "0")  $rettxt .= $tens[substr($i, 0, 1)];
            if (substr($i, 1, 1) != "0") $rettxt .= " " . $ones[substr($i, 1, 1)];
        } else {
            if (substr($i, 0, 1) != "0") $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
            if (substr($i, 1, 1) != "0") $rettxt .= " " . $tens[substr($i, 1, 1)];
            if (substr($i, 2, 1) != "0") $rettxt .= " " . $ones[substr($i, 2, 1)];
        }
        if ($key > 0) {
            $rettxt .= " " . $hundreds[$key] . " ";
        }
    }
    if ($decnum > 0) {
        $rettxt .= " and ";
        if ($decnum < 20) {
            $rettxt .= $ones[$decnum];
        } elseif ($decnum < 100) {
            $rettxt .= $tens[substr($decnum, 0, 1)];
            $rettxt .= " " . $ones[substr($decnum, 1, 1)];
        }
    }
    return $rettxt;
}

function addOrdinalNumberSuffix($num)
{
    if (!in_array(($num % 100), array(11, 12, 13))) {
        switch ($num % 10) {
                // Handle 1st, 2nd, 3rd
            case 1:
                return $num . 'st';
            case 2:
                return $num . 'nd';
            case 3:
                return $num . 'rd';
        }
    }
    return $num . 'th';
}
?>