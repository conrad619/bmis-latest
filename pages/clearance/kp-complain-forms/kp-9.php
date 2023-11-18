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
    <title>KP9</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.jss"></script>

    <style>
        .header {
            height: 10em;
            width: auto;

        }

        div.statement {
            line-height: 18px;
        }

        div.footer {
            line-height: 18px;
        }

        div.header-zone {
            line-height: 18px;
        }

        div.statement {
            text-align: justify;
        }

        div.statement u {
            color: red;
        }
    </style>

</head>

<body id="print">

    <div class="container">
        <div class="row d-flex justify-content-center">
            <img class="header" src="images/kp-9-header.png" alt="">
        </div>

        <div class="header-zone row mx-5">
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
                <p class="fs-6 mb-1">Respondent/s</p>

            </div>
            <div class="col ms-3">Barangay Case No: <span class="fw-bold"><?php echo $random_number ?></span><br>
                For: <span class="fw-bold"><?php echo $row['purpose'] ?></span>
            </div>
        </div>

        <div class="row mx-5">
            <p class="text-center fw-bold mb-1">SUMMONS</p>
            <div class="statement mx-3">
                <p class="">
                    <span class="ms-5">
                        You are hereby summoned to appear before me in person, together with your witnesses, on the
                    </span>
                    <span>
                        <u><?php echo $day ?></u>
                    </span>
                    <span>day of</span>
                    <u><?php echo $month_year ?></u>

                    <span>at</span>
                    <span>
                        <u><?php echo $formatted_time ?></u>

                    </span>
                    <span>in the</span>
                    <span>
                        <u><?php echo $time_period ?></u>
                    </span>
                    <span>, then and there to answer to a complaint made before me, copy of which is attached hereto, for mediation/conciliation of your dispute with complainant/s.</span> <br>
                    <span class="ms-5">
                        You are hereby warned that if you refuse or willfully fail to appear in obedience to this summons, you may be barred from filing any counterclaim arising from said complaint.
                    </span>

                <p class="ms-5 mb-1">
                    FAIL NOT or else face punishment as for contempt of court.
                </p>
                <p class="mb-1"></p>
                <span class="ms-5">
                    This <span> <?php
                                echo date('jS');
                                ?></span> day of <span><?php
                                                        echo date('F Y');
                                                        ?></span>.
                </span>

                <p>

                </p>
                </p>
            </div>
        </div>

        <div class="row mx-5">
            <div class="col">
            </div>
            <div class="col text-end">
                <div style="line-height: 19px;" class="text-center">
                    <span class="fw-bold fs-6">
                        <u>ROBERTO A. BALLARTA</u>
                    </span><br>
                    <span class="fs-6">Punong Barangay/Pangkat Chairman</span>
                </div>
            </div>
        </div>


        <div class="footer row mx-5 mt-2">
            <div class="col-5 ms-3">

                <p class="fw-bold ms-5">
                    RESPONDENTS
                </p>
                <p class="fs-6">___________________________________</p>
                <p class="fs-6 mb-4">___________________________________</p>
                <p class="fs-6 mb-5">___________________________________</p>
                <p class="fs-6 mb-3 hidden">.</p>
                <p class="fs-6">___________________________________</p>
            </div>

            <div class="col-6">
                <p class="fw-bold ms-5">
                    RESPONDENTS
                </p>
                <p class="fs-6 mb-0">1. handing to him/them said summons in
                    person, or
                </p>
                <p class="fs-6 mb-0">2. handing to him/them said summons and
                    he/they refused to receive it; or
                </p>
                <p class="fs-6 mb-0">3. leaving said summons at his/their
                    dwelling with:
                <div class="text-center mt-0 mb-0">
                    _________________________
                    <br>
                    <span>(name)</span><br>
                </div>
                person of suitable age and discretion
                residing therein; or

                </p>
                <p class="fs-6 mb-0">4. leaving said summons at his/their
                    office/place of business with:
                <div class="text-center mt-0 mb-0">
                    _________________________
                    <br>
                    <span>(name)</span><br>
                </div>
                a competent person in charge thereof.

                </p>

                <div style="line-height: 19px;" class="text-center">
                    <span class="fw-bold fs-6">
                        <u>REYNALDO S. CEBALLOS</u>
                    </span><br>
                    <span class="fs-6"> Officer</span>
                </div>

            </div>
        </div>

        <div class="row mx-5 mt-2">
            <span>Received by respondent/s/respondent/s:</span>
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