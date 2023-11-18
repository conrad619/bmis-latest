<!DOCTYPE html>
<html>
<?php
session_start();
?>
    <head>
        <meta charset="UTF-8">
        <title>Resident || Barangay Information System</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>
    <body class="skin-black">

<form action="action.php" method="post">
    <div class="container-fluid wrapper">
        <div class="row">

            <div class="panel-default">
                <div class="panel-heading" style="text-align:center;">
                    <img src="../../img/logo-removebg-preview.png" style="height:100px;"/>                
                <h3 class="panel-title" style ="padding-top:10px;">
                    <strong>
                       Household Profile
                    </strong>
                </h3>
                <a href="login.php">Already have account? Login</a>
                </div>
                <div class="panel-body">
                    <!-- partial:index.partial.html -->
                    <ul style="text-align:center;">

                        <!-- <li class="active current1"> 
                            <span class="span"> Step 1 </span>  
                        </li>

                        <li>  
                            <span class="span"> Step 2 </span>  
                        </li>

                        <li>  
                            <span class="span"> Step 3 </span>  
                        </li>

                        <li>  
                            <span class="span"> Step 4 </span>  
                        </li> -->
                       
                        <span class="active current1"> 
                            <li><span class="span"> Step 1 </span></li>
                        </span>
                        <span>  
                            <li><span class="span"> Step 2 </span></li>   
                        </span>

                        <span>  
                            <li><span class="span"> Step 3 </span></li>   
                        </span>

                        <span>  
                            <li><span class="span"> Step 4 </span></li>   
                        </span>

                        


                    
                    </ul>

                    <div id="main">  

                        <div id="div1" class="first current">       
                            
                                <div class="panel-body">

                                    <div class="row" style = "padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" >Full name:</label><br>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="txt_lname" class="form-control" type="text" placeholder="Last name" required/>
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="txt_fname" class="form-control" type="text" placeholder="First name" required/>
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="txt_mname" class="form-control" type="text" placeholder="Middle name" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   

                                    <div class="row" style = "padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" >Contact Address:</label><br>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="email" class="form-control" type="email" placeholder="Email" required/>
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="phone_num" pattern="[0-9]{11}" class="form-control" type="tel" placeholder="Contact no." required/>
                                                    <small style ="color:white;">Format: 09123456789</small>
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="address" class="form-control" type="text" placeholder="Address" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" >Account:</label><br>
                                                <div class="col-sm-6 padding-for-all">
                                                    <input name="u_name" class="form-control" type="text" placeholder="Username" required/>
                                                </div>
                                                <div class="col-sm-6 padding-for-all">
                                                    <input name="password" class="form-control" type="password" placeholder="Password" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            
                        </div>

                        <div id="div2">

                                <div class="panel-body">

                                    <div class="row" style = "padding-bottom:5px;">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                                <div class="col-sm-4 padding-for-all">
                                                <label class="control-label" >Household Head</label><br>
                                                    <input name="household_head" class="form-control" type="text" placeholder="Household head" required/>
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label" >Birth Date</label>
                                                    <input name="b_date"  class="form-control" type="date" placeholder="Birth Date" required/>
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label" >Occupation</label>
                                                    <input name="occupation" class="form-control" type="text" placeholder="Occupation" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row" style = "padding-bottom:5px;">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                                <div class="col-sm-4 padding-for-all">
                                                <label class="control-label" >Status</label>
                                                    <select class="form-control" id= "status_signup"required>
                                                    <option disabled selected>Choose status</option>
                                                    <option>Single</option>
                                                    <option>Married</option>
                                                    <option>Live-in Partner</option>
                                                    <option>Widow</option>
                                                    <option>Solo Parent</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-8 padding-for-all">
                                                <label class="control-label" >Belong to indigenous People/Cultural Community:</label><br>
                                                    <div class="row">
                                                        <div class="col-sm-3 padding-for-all">
                                                            <select class="form-control" id = "belongings" required>
                                                            <option disabled selected>Choose</option>       
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-9 padding-for-all" id = "popup_belongings">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="row append-status" style = "padding-bottom:5px;" id = "append-status">
                                        <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-sm-4 padding-for-all">
                                                <label class="control-label" >Spouse name</label><br>
                                                    <input name="household_head" class="form-control" type="text" placeholder="Spouse name" required/>
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label" >Birth Date</label>
                                                    <input name="b_date"  class="form-control" type="date" placeholder="Birth Date" required/>
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label" >Occupation</label>
                                                    <input name="occupation" class="form-control" type="text" placeholder="Occupation" required/>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    

                                </div>

                        </div>


                        <div id="div3">
                                <div class="panel-body">
                                   
                                    <div class="row" style = "padding-bottom:5px;">
                                        <div class="col-md-12">
                                           <label class="control-label">
                                            Household Member 
                                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                            <button type="button" class="btn btn-info" id ="add_more_member" >Add more <i class="bi bi-person-plus-fill"></i></button>
                                            <button type="button" class="btn btn-danger" id = "remove_member">Remove <i class="bi bi-trash"></i></button>
                                            </div>

                                           </label>
                                           <div class="form-group household-info">
                                                <div class="col-sm-3 padding-for-all">
                                                <label class="control-label" >Full name</label><br>
                                                    <input name="household_head" class="form-control" type="text" placeholder="Full name" required/>
                                                </div>
                                                <div class="col-sm-3 padding-for-all">
                                                    <label class="control-label" >Birth Date</label>
                                                    <input name="b_date"  class="form-control" type="date" placeholder="Birth Date" required/>
                                                </div>
                                                <div class="col-sm-3 padding-for-all">
                                                    <label class="control-label" >Relationship</label>
                                                    <input name="b_date"  class="form-control" type="text" placeholder="ex. Brother" required/>
                                                </div>
                                                <div class="col-sm-3 padding-for-all">
                                                    <label class="control-label" >Occupation</label>
                                                    <input name="occupation" class="form-control" type="text" placeholder="Occupation" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id = "show_more_member"></div>



                                </div>
                        </div> 


                        <div id="div4" class="last">
                                <div class="panel-body">
                                   
                                    <div class="row" style = "padding-bottom:5px;">
                                        <div class="col-md-12">
                                           <label class="control-label">
                                            Personal Information 
                                           </label>
                                           <div class="form-group">
                                                <div class="col-sm-6 padding-for-all">
                                                <label class="control-label" >Residence Status:</label>
                                                    <select class="form-control" id = "show-other-resi-stat" required>
                                                    <option disabled selected>Choose residence status</option>
                                                    <option>Permanent / Owned</option>
                                                    <option>Renter</option>
                                                    <option>Caretaker</option>
                                                    <option>Infomation Settlers</option>
                                                    <option>Other</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-6 padding-for-all show-other-resi-stat">
                                                <!-- <label class="control-label" >Please specify</label><br>
                                                    <input name="household_head" class="form-control" type="text" placeholder="Specify your resident status" required/> -->
                                                </div>
                                             
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style = "padding-bottom:5px;">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                                <div class="col-sm-6 padding-for-all">
                                                <label class="control-label" >Living with person with disability (PWD):</label>
                                                    <select class="form-control" required>
                                                    <option disabled selected>Choose</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-6 padding-for-all">
                                                <label class="control-label" >Register voter:</label>
                                                    <select class="form-control" required>
                                                    <option disabled selected>Choose</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                    </select>
                                                </div>
                                             
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style = "padding-bottom:5px;">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                                <div class="col-sm-3 padding-for-all">
                                                <label class="control-label">4p's/ IP's Benificiary:</label>
                                                    <select class="form-control" id = "specify-benificiary" required>
                                                    <option disabled selected>Choose</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-3 padding-for-all specify-benificiary">
                                                <!-- <label class="control-label" >Please specify</label><br>
                                                    <input name="household_head" class="form-control" type="text" placeholder="Specify your benificiary" required/> -->
                                                </div>

                                                <div class="col-sm-3 padding-for-all">
                                                <label class="control-label" >Pensioner:</label>
                                                    <select class="form-control" id = "specify-pensioner" required>
                                                    <option disabled selected>Choose</option>
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-3 padding-for-all specify-pensioner">
                                                <!-- <label class="control-label" >Please specify</label><br>
                                                    <input name="household_head" class="form-control" type="text" placeholder="Specify your pensioner" required/> -->
                                                </div>

                                                <div class="col-sm-6 padding-for-all">
                                                <label class="control-label" >Estimated Monthly Income</label><br>
                                                    <input name="household_head" class="form-control" min = "1" type="number" placeholder="Estimated Monthly Income" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style = "padding-bottom:5px;">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                                <div class="col-sm-12 padding-for-all">
                                                <label class="control-label" >Remarks:</label>
                                                    <textarea name="" class="form-control" id="" cols="90" rows="3" required></textarea>
                                                </div>                                   
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        </div>    

                    </div>

                   
                        <button type = "button" class = "btn btn-radius btn-warning" id="prev"><i class="bi bi-arrow-left"></i> Prev</button>
                        <button type = "button" style = "float:right;" class = "btn btn-radius btn-primary" id="next">Next <i class="bi bi-arrow-right"></i></button>

                        <button type = "submit" name = "register_now" class = "btn btn-radius btn-primary btn-success" id="submit">Register now</button>
                       
                    <!-- partial -->                                          
                </div>
            </div>

        </div>
    </div>
            
   
        
</form> 


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src="js/main.js"></script>

    </body>
</html>