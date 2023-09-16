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

    <form method="post" action="action.php" enctype="multipart/form-data">
        <div class="container-fluid wrapper">
            <div class="row">

                <div class="panel-default">
                    <div class="panel-heading" style="text-align:center;">
                        <img src="../../img/logo-removebg-preview.png" style="height:100px;" />
                        <h3 class="panel-title" style="padding-top:10px;">
                            <strong>
                                Household Profile
                            </strong>
                        </h3>
                        <a href="login.php">Already have account? Login</a>
                    </div>
                    <div class="panel-body">
                        <ul style="text-align:center;">
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
                                    <div id="warning-step1"></div>
                                    <div class="row" style="padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Full name:</label><br>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="txt_lname" id="last_name" id="dont_allow_char" class="form-control upper" type="text" placeholder="Last name" required />
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="txt_fname" id="first_name" id="dont_allow_char" class="form-control upper" type="text" placeholder="First name" required />
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="txt_mname" id="middle_name" id="dont_allow_char" class="form-control upper" type="text" placeholder="Middle name" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row" style="padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Contact Address:</label><br>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="email" id="email" class="form-control" type="email" placeholder="Email" required />
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="phone_num" pattern="[0-9]{11}" class="form-control" type="tel" id="tel_num" placeholder="Contact no." required />
                                                    <small style="color:white;">Format: 09123456789</small>
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <input name="address" id="u_address" id="dont_allow_char" class="form-control upper" type="text" placeholder="Address" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Account:</label><br>
                                                <div class="col-sm-6 padding-for-all">
                                                    <input name="u_name" class="form-control" type="text" placeholder="Username" id="username" required />
                                                    <label id="user_msg" style="color:#eb4444;"></label>

                                                </div>
                                                <div class="col-sm-6 padding-for-all">
                                                    <input name="password" id="password" class="form-control" type="password" placeholder="Password" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                            <div id="div2">

                                <div class="panel-body">

                                    <div class="row" style="padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label">Household Head</label><br>
                                                    <input name="fullname_hhead" id="fullname_hhead" id="dont_allow_char" class="form-control upper" type="text" placeholder="Full name" required />
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label">Birth Date</label>
                                                    <input name="headb_date" id="dont_allow_char" class="form-control upper" type="date" placeholder="Birth Date" required />
                                                </div>
                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label">Occupation</label>
                                                    <input name="head_occupation" id="dont_allow_char" class="form-control upper" type="text" placeholder="Occupation" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row" style="padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label">Status</label>
                                                    <select class="form-control upper" name="u_status" id="status_signup" required>
                                                        <option disabled selected>Choose status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Live-in Partner">Live-in Partner</option>
                                                        <option value="Widow">Widow</option>
                                                        <option value="Solo Parent">Solo Parent</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-8 padding-for-all">
                                                    <label class="control-label">Belong to indigenous People/Cultural Community:</label><br>
                                                    <div class="row">
                                                        <div class="col-sm-3 padding-for-all">
                                                            <select class="form-control upper" name="belong_indigi" id="belongings" required>
                                                                <option disabled selected>Choose</option>
                                                                <option>Yes</option>
                                                                <option>No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-9 padding-for-all" id="popup_belongings">

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row append-status" style="padding-bottom:5px;" id="append-status">

                                    </div>


                                </div>

                            </div>


                            <div id="div3">

                                <div class="panel-body">


                                    <div class="row" style="padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <label class="control-label">Household status:</label>
                                            <br>
                                            <div class="col-sm-12 padding-for-all">
                                                <select class="form-control" id="household_status" name="household_status" required>
                                                    <option disabled selected>Choose</option>
                                                    <option value="Yes">Living Alone</option>
                                                    <option value="No">Living with Family / Someone</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row" style="padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <label class="control-label d-none dispaly_household">
                                                Household Member
                                                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                    <button type="button" style=" border-radius: 50px 0px 0px 50px;" class="btn left-radius btn-info" id="add_more_member">Add more <i class="bi bi-person-plus-fill"></i></button>
                                                    <button type="button" style=" border-radius: 0px 50px 50px 0px;" class="btn right-radius btn-danger" id="remove_member">Remove <i class="bi bi-trash"></i></button>
                                                </div>

                                            </label>
                                            <div class="form-group row household-info d-none">


                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label" for="f_name">First name</label><br>
                                                    <input name="f_name[]" id="f_name" class="form-control upper" type="text" placeholder="First name" />
                                                </div>

                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label" for="l_name">Last name</label><br>
                                                    <input name="l_name[]" id="l_name" class="form-control upper" type="text" placeholder="Last name" />
                                                </div>

                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label" for="m_name">Middle name</label><br>
                                                    <input name="m_name[]" id="m_name" class="form-control upper" type="text" placeholder="Middle name" />
                                                </div>

                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label" for="hmemberb_date">Birth Date</label>
                                                    <input name="hmemberb_date[]" id="hmemberb_date" class="form-control upper" type="date" placeholder="Birth Date" />
                                                </div>

                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label" for="hmember_relationship">Relationship</label>
                                                    <input name="hmember_relationship[]" id="hmember_relationship" class="form-control upper" type="text" placeholder="ex. Brother" />
                                                </div>

                                                <div class="col-sm-4 padding-for-all">
                                                    <label class="control-label" for="hmember_occupation">Occupation</label>
                                                    <input name="hmember_occupation[]" id="hmember_occupation" class="form-control upper" type="text" placeholder="Occupation" />
                                                </div>




                                            </div>

                                            <div class="form-group row household-show">
                                            </div>

                                        </div>
                                    </div>

                                    <div id="show_more_member"></div>



                                </div>
                            </div>


                            <div id="div4" class="last">
                                <div class="panel-body">

                                    <div class="row" style="padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <label class="control-label">
                                                Personal Information
                                            </label>
                                            <div class="form-group">
                                                <div class="col-sm-6 padding-for-all">
                                                    <label class="control-label">Residence Status:</label>
                                                    <select class="form-control upper" name="residence_status" id="show-other-resi-stat" required>
                                                        <option disabled selected>Choose residence status</option>
                                                        <option>Permanent / Owned</option>
                                                        <option>Renter</option>
                                                        <option>Caretaker</option>
                                                        <option>Infomation Settlers</option>
                                                        <option>Other</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-6 padding-for-all show-other-resi-stat">

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-sm-6 padding-for-all">
                                                    <label class="control-label">Living with person with disability (PWD):</label>
                                                    <select name="live_with_disa" class="form-control upper" required>
                                                        <option disabled selected>Choose</option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-6 padding-for-all">
                                                    <label class="control-label">Register voter:</label>
                                                    <select name="register_voter" class="form-control upper" required>
                                                        <option disabled selected>Choose</option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-sm-3 padding-for-all">
                                                    <label class="control-label">4p's/ IP's Benificiary:</label>
                                                    <select name="benificiary" class="form-control upper" id="specify-benificiary" required>
                                                        <option disabled selected>Choose</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-3 padding-for-all specify-benificiary">

                                                </div>

                                                <div class="col-sm-3 padding-for-all">
                                                    <label class="control-label">Pensioner:</label>
                                                    <select name="pensioner" class="form-control upper" id="specify-pensioner" required>
                                                        <option disabled selected>Choose</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-3 padding-for-all specify-pensioner">

                                                </div>

                                                <div class="col-sm-6 padding-for-all">
                                                    <label class="control-label">Estimated Monthly Income</label><br>
                                                    <input name="estd_mon_income" id="dont_allow_char" class="form-control upper" min="1" type="number" placeholder="Estimated Monthly Income" required />
                                                </div>

                                                <div class="col-sm-6 padding-for-all">
                                                    <label class="control-label">Profile Photo</label><br>
                                                    <input name="uploadimage" class="form-control upper" type="file" accept="image/*" required />
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="padding-bottom:5px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-sm-12 padding-for-all">
                                                    <label class="control-label">Remarks:</label>
                                                    <textarea name="remarks" id="dont_allow_char" class="form-control upper" id="" cols="90" rows="3" placeholder="Optional..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                        <button type="button" class="btn btn-radius btn-warning" id="prev"><i class="bi bi-arrow-left"></i> Prev</button>
                        <button type="button" style="float:right;" class="btn btn-radius btn-primary" id="next">Next <i class="bi bi-arrow-right"></i></button>
                        <button type="submit" name="register_now" class="btn btn-radius btn-primary btn-success" id="submit">Register now</button>

                        <!-- partial -->
                    </div>
                </div>

            </div>
        </div>



    </form>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('#dont_allow_char').on('keypress', function(event) {
                // var regex = new RegExp("^[a-zA-Z0-9]*$");
                var regex = /^[a-zA-Z\s]*$/;

                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
                //regex expression:

                //Validation to the user_name input field

            });

            $('.upper').keyup(function(event) {
                var textBox = event.target;
                var start = textBox.selectionStart;
                var end = textBox.selectionEnd;
                textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1).toLowerCase();
                textBox.setSelectionRange(start, end);
            });


        });
    </script>
</body>

</html>