<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else {
    ob_start();
    include('../head_css.php'); ?>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php

        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Map
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">
                    <h2>I am a map</h2>
                    <!-- start map box -->
                    <div id='map' style='width: 100%; height: 70vh;'></div>
                    <script>
                    mapboxgl.accessToken = 'pk.eyJ1IjoiY29ucmFkNjE5IiwiYSI6ImNsbDU5bG5vODBneHczZmxvdnR1N21kdHEifQ.nb9wheVK-HBsz01DifodWg';
                    var map = new mapboxgl.Map({
                        container: 'map',
                        style: 'mapbox://styles/mapbox/streets-v11'
                    });
                    </script>

                    <!-- end map box -->

                    <?php ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->

        <script>
        </script>

    <?php }

include "../footer.php"; ?>
    




    </body>

</html>