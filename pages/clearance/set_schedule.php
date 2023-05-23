<?php 
        
        include "../connection.php";
        session_start();


        if(isset($_POST['set_now'])){


        
         $id_request_form = $_POST['id_request_form'];
         $schedule_pickup = $_POST['date_schedule'].' '.$_POST['time_schedule'];
         $date=date_create($schedule_pickup);
         $store_database = date_format($date,"F j, Y g:ia");

         //redirect
         $request_id = $_POST['request_id'];
         $ready_pick_up = $_POST['ready_pick_up'];


        $set_schedule = mysqli_query($con,"UPDATE request_form_information
        set status = 'ready_pick_up', schedule_pickup = '".$store_database."' 
        WHERE req_form_information_id  = '".$id_request_form."'") or die('Error: ' . mysqli_error($con));

       

            if ($set_schedule) {




                    echo '<script>
                    window.location.href = "view_request.php?ID='.$request_id.'";
                    </script>';


                    $_SESSION['pop_upmsg'] = '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Request is ready for pick-up!</strong> on '.$store_database.'.
                     </div>';


                 
                
            }else{


                $_SESSION['pop_upmsg'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Failed please try again!</strong>
                 </div>';


                 echo '<script>
                 window.location.href = "view_request.php?ID='.$request_id.'";
                 </script>';


            }


        }

        // decline_now

        if(isset($_POST['decline_now'])){

            $id_request_form = $_POST['id_request_form'];
            $request_id = $_POST['request_id'];
            
            $set_schedule = mysqli_query($con,"UPDATE request_form_information
            set status = 'declined' 
            WHERE req_form_information_id  = '".$id_request_form."'") or die('Error: ' . mysqli_error($con));
    
           
    
                if ($set_schedule) {
    
    
    
    
                        echo '<script>
                        window.location.href = "view_request.php?ID='.$request_id.'";
                        </script>';
    
    
                        $_SESSION['pop_upmsg'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Request has been declined!</strong>
                         </div>';
    
    
                     
                    
                }else{
    
    
                    $_SESSION['pop_upmsg'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Failed please try again!</strong>
                     </div>';
    
    
                     echo '<script>
                     window.location.href = "view_request.php?ID='.$request_id.'";
                     </script>';
    
    
                }
        }
        ?>