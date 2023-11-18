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
$row = $result->fetch_assoc()

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KP7</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.jss"></script>


</head>



<body id="print">
    <div class="container">
        <div class="row">
            <img src="images/kp-7-header.png" alt="">
        </div>

        <div class="row mx-4">
            <div class="col">

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

        <div class="row mx-4">
            <h2 class="fw-bold text-center" style="letter-spacing: 4px;">COMPLAINT</h2>
            <p>
                <span class="fw-bold ms-5">
                    I/WE
                </span>
                <span>hereby complain against above named respondent/s for violating my</span><br>
                <span>rights and interest in the following manner;</span>

            <p>
                <span class="ms-5">
                    <?php echo $row["complain_description"] ?>
                </span>
            </p>
            </p>

            <p>
                <span class="fw-bold ms-5">
                    THEREFORE, I/WE
                </span>
                <span>pray that the following relief/s be granted to me/us in </span><br>
                <span>accordance with the law and/or equity;</span>

            <p>
                <span class="ms-5">
                    <?php echo $row["purpose"] ?>
                </span>
            </p>

            <p class="ms-5">
                <span>Made this</span>
                <span class="fw-bold"> <u> <?php echo date('j'); ?></u> </span>
                <span>day of</span>
                <span class="fw-bold"> <u> <?php echo date('F'); ?></u> </span>
                <span>,</span>
                <span class="fw-bold"> <u> <?php echo date('Y'); ?></u> </span>
            </p>

            </p>

        </div>


        <div class="row mx-4">
            <div class="col">
            </div>
            <div class="col text-end me-5">
                <p class="fw-bold mb-1 fs-6">
                    <?php
                    echo $row["complainant"]
                    ?>
                </p>
                <p class="fs-6">Complainant/s</p>
            </div>

            <p class="ms-5">
                <span>Received and filed this </span>
                <span class="fw-bold"> <u> <?php echo date('j'); ?></u> </span>
                <span>day of</span>
                <span class="fw-bold"> <u> <?php echo date('F'); ?></u> </span>
                <span>,</span>
                <span class="fw-bold"> <u> <?php echo date('Y'); ?></u> </span>
            </p>
        </div>

        <div class="row mx-4">
            <div class="col">
            </div>
            <div class="col text-end">
                <div class="text-center">
                    <span class="fw-bold fs-6">
                        <u>ROBERTO A. BALLARTA</u>
                    </span><br>
                    <span class="fs-6">Punong Barangay/Lupon Chairman</span>
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