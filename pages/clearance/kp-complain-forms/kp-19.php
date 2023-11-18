<?php
date_default_timezone_set('Asia/Manila');

include "../../connection.php";
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: ../../../login.php");
}

$complaint_id = $_GET['ID'];
$random_number = mt_rand(3001, 3523);

$sql = "SELECT * FROM complaints WHERE complaint_id='$complaint_id'";
$result = $con->query($sql);
$row = $result->fetch_assoc();

$schedule_str = $row['new_schedule'];
$old_schedule_str = $row['old_schedule'];
$schedule_date = new DateTime($schedule_str);
$old_schedule_date = new DateTime($old_schedule_str);

$schedule_formatted = $schedule_date->format('F j, Y \a\t g:i A');
$old_schedule_formatted = $schedule_date->format('F j, Y \a\t g:i A');

$old_day = $old_schedule_date->format('F j, Y');

$formatted_time = $schedule_date->format('g:i A');
$day = $schedule_date->format('jS');
$month_year = $schedule_date->format('F Y');

if ($schedule_date->format('H:i') < '12:00') {
    $time_period = 'morning';
} elseif ($schedule_date->format('H:i') < '18:00') {
    $time_period = 'afternoon';
} else {
    $time_period = 'evening';
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KP19</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.jss"></script>

    <style>
        div.header {
            line-height: 1.2;
        }

        div.statement span {
            line-height: 2;
        }

        div.statement u {
            color: black;
        }

        div.statement {
            text-align: justify;
        }
    </style>

</head>



<body id="print">


    <div class="container">
        <span class="fw-bold"> <i>KP FORM # 19: NOTICE OF HEARING FOR RESPONDENT </i> </span>
        <div class="header row mx-5 mt-2 text-center">
            <b>Republic of the Philippines</b>
            <b>Province of Davao Del Sur</b>
            <b>Davao City</b>
            <b>Baranggay Los Amigos</b>
        </div>

        <div class="header row mx-5 mt-4 text-center">
            <b>OFFICE OF THE LUPONG TAGAPAMAYAPA</b>
        </div>

        <div class="row mx-5">
            <div class="col mx-3">
                <p class="fw-bold mb-1 fs-6">
                    <?php
                    echo $row["complainant"]
                    ?>
                </p>
                <p class="fs-6">Complainant/s</p>


                <p class="ms-3 fs-6">-AGAINST-</p>

                <p class="fw-bold mb-1 fs-6">
                    <?php
                    echo $row["against"]
                    ?>
                </p>
                <p class="fs-6">Respondent/s</p>

            </div>
            <div class="col ms-3">Barangay Case No: <span class="fw-bold"><?php echo $random_number ?></span><br>
                For: <span class="fw-bold"><?php echo $row['purpose'] ?></span>
            </div>
        </div>

        <div class="header row mx-5 mt-1 text-center">
            <p class="mb-0 fw-bold">NOTICE OF HEARING
            </p>
            <p class="fw-bold">
                (RE: FAILURE TO APPEAR)
            </p>
        </div>

        <div class="row mx-5 mt-1">

            <div class="col mx-3">
                <p class="fw-bold mb-1 fs-6">
                    <span class="fw-normal">TO:</span>
                    <span class="ms-2"><?php
                                        echo $row["complainant"]
                                        ?></span>
                </p>
                <p class="ms-4 fs-6">Complainant/s</p>

            </div>
        </div>

        <div class="row mx-5 mb-0">
            <div class="statement mx-3">
                <p>
                    <span class="ms-5">
                        You are hereby required to appear me/the Pangkat on the <?php echo "<u><strong>" . $day . "</strong></u>" ?> day of <?php echo "<u><strong>" . $month_year . "</strong></u>" ?> at <?php echo "<u><strong>" . $formatted_time . "</strong></u>" ?> o’clock in the morning/ afternoon to explain why you failed to appear for mediation/
                        conciliation scheduled on <?php echo "<u><strong>" . $old_day . "</strong></u>" ?> and why your counterclaim (if any) arising from the complaint should not be dismissed, a certificate to bar the filing of said counterclaim in court/
                        government office should not be issued, and contempt proceedings should not be initiated in court for willful failure or refusal to appear before the Punong Barangay/Pangkat ng Tagapagkasundo.
                    </span>
                <p>
                    <span class="ms-5">
                        This <span> <?php
                                    echo date('jS');
                                    ?></span> day of <span><?php
                                                            echo date('F Y');
                                                            ?></span>.
                    </span>
                </p>
                </p>
            </div>
        </div>

        <div class="row mx-5">
            <div class="mx-3">
                <span class="fs-6">_____________________________ <br>
                    Punong Barangay/Pangkat Chairman <br>
                    (Cross out whichever is not applicable.)
                </span>
            </div>
        </div>

        <div class="row mx-5">
            <div class="statement mx-3">
                <p>
                <p>
                    <span class="ms-5">
                        Notified this <span> <?php
                                                echo date('jS');
                                                ?></span> day of <span><?php
                                                                        echo date('F Y');
                                                                        ?></span>.
                    </span>
                </p>
                </p>
            </div>
        </div>

        <div class="row mx-5 mt-4">
            <div class="col mx-3">
                <p class="fw-bold mb-1 fs-6">
                    <?php
                    echo $row["complainant"]
                    ?>
                </p>
                <p class="fs-6">Complainant/s</p>

            </div>
            <div class="col ms-3">
                <p class="fw-bold mb-1 fs-6">
                    <?php
                    echo $row["against"]
                    ?>
                </p>
                <p class="fs-6">Respondent/s</p>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.onload = function () {
            var element = document.getElementById('print');
            html2pdf(element);
        }
    </script>

</body>

</html>