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
    <title>KP8</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.jss"></script>

    <style>
        div.statement span {
            line-height: 2;
        }

        div.statement u {
            font-weight: bold;
            font-size: large;
            color: red;
        }
    </style>

</head>



<body id="print">


    <div class="container">
        <div class="row text-center">
            <img src="images/kp-8-header.png" alt="">
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

        <div class="row mx-5">
            <div class="statement mx-3">
                <p>
                    <span class="ms-5">
                        You are hereby required to appear before me on the
                    </span>
                    <span> <u><?php echo $day ?></u>

                    </span>
                    <span>day of</span> <u><?php echo $month_year ?></u>
                    <span>at</span>
                    <span> <u><?php echo $formatted_time ?></u>
                    </span>
                    <span>in the</span>
                    <span> <u><?php echo $time_period ?></u>

                    </span>
                    <span>for the hearing of your complaint</span>

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
            <div class="col">
            </div>
            <div class="col text-end">
                <div class="text-center">
                    <span class="fw-bold fs-6">
                        <u>ROBERTO A. BALLARTA</u>
                    </span><br>
                    <span class="fs-6">Punong Barangay</span>
                </div>
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

        <div class="row mx-5">
            <div class="col">
            </div>
            <div class="col ms-5">
                <div class="ms-4">
                    <span class="fs-6">Complainant/s</span><br>
                    <span class="fw-bold fs-6">
                        <u><?php
                            echo $row["complainant"]
                            ?></u>
                    </span><br>

                </div>
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