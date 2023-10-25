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
$schedule_date = new DateTime($schedule_str);
$schedule_formatted = $schedule_date->format('F j, Y \a\t g:i A');
$formatted_time = $schedule_date->format('g:i A');
$day = $schedule_date->format('jS');
$dayMDY = $schedule_date->format('F j, Y');
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
    <title>KP21</title>

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
            font-weight: bold;
        }

        div.statement {
            text-align: justify;
        }
    </style>

</head>



<body id="print">


    <div class="container">
        <span class="fw-bold"> <i>KP FORM # 21: CERTIFICATION TO BAR ACTION </i> </span>
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
            <p class="mb-0 fw-bold">CERTIFICATION TO BAR ACTION
            </p>
        </div>

        <div class="row mx-5 mb-0">
            <div class="statement mx-3">
                <p>
                    <span>
                        This is to certify that the above-captioned case was dismissed pursuant to the Order dated <u><?php echo $dayMDY ?></u>, for complainant/s <u><?php echo $row['complainant'] ?></u> willful failure or refusal to appear for hearing before the Punong Barangay/Pangkat ng Tagapagkasundo and therefore complainant/s is/are barred from filing an action in court/government office. <p>
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
            <div class="mx-3" style="text-align: justify;">
                <span class="fs-6">_____________________________ <br>
                    Lupon Secretary/Pangkat Secretary <br>
                </span>

                <span><br>
                    Attested:<br>
                </span>

                <span class="fs-6">_____________________________ <br>
                    Lupon Chairman/Pangkat Chairman <br>
                </span>

                <span>
                    <br>
                    IMPORTANT: If Lupon Secretary makes the certification, the Lupon Chairman attests. If the Pangkat Secretary makes the certification, the Pangkat Chairman attests.
                </span>
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