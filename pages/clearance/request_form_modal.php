<!-- Modal -->
<?php
$resident_id = $_SESSION['userid'];
$resident_new = mysqli_query($con, "SELECT * from tbl_resident_new WHERE resident_id = '$resident_id'");
$purok_list = mysqli_query($con, "SELECT * from brgy_purok");
while ($row = mysqli_fetch_array($resident_new)) {

   $household_uk = $row['household_member_uk'];
   $full_name_owner_account = $row['f_name'] . ' ' . $row['l_name'] . ' ' . $row['m_name'];
}
while ($row = mysqli_fetch_array($purok_list)){
    $purok_n = $row['purok_name'];
}


?>
<form method="POST" id="save_and_review">
   <input name="user_id" id="form-first-name" type="hidden" value="<?php echo $_SESSION['userid']; ?>">
   <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title" id="myModalLabel">Request Form</h4>
            </div>
            <div class="modal-body">
               <fieldset style="display: block;">
                  <div class="form-top">
                     <div class="form-top-left">
                        <h3>Step 1 / 2</h3>
                        <p>Resident Information:</p>
                     </div>
                  </div>
                  <div class="form-bottom">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Select Household member</label>
                        <select name="household_member_id" id="household_member" class="form-control" required>

                           <?php
                           $house_member = mysqli_query($con, "SELECT * from tbl_resident_house_member WHERE household_uk = '$household_uk'");
                           while ($row_hmember = mysqli_fetch_array($house_member)) {

                              echo '  <option value="' . $row_hmember['household_id'] . '">' . $row_hmember['f_name'] . ' ' . $row_hmember['l_name'] . ' ' . $row_hmember['m_name'] . '</option>';
                           }


                           ?>
                        </select>
                     </div>
                     <!-- <div class="form-group">
                        <label class="col-form-label" for="form-first-name">First name</label>
                        <input name="first_name" placeholder="First name..." class="form-first-name form-control input-error" id="form-first-name" type="text">
                     </div>
                     <div class="form-group">
                        <label class="col-form-label" for="form-last-name">Last name</label>
                        <input name="last_name" placeholder="Last name..." class="form-last-name form-control input-error" id="form-last-name" type="text">
                     </div>
                     <div class="form-group">
                        <label class="col-form-label" for="form-middle-name">Middle name</label>
                        <input name="middle_name" placeholder="Middle name..." class="form-last-name form-control input-error" id="form-middle-name" type="text">
                     </div> -->

                     <div class="form-group">

                        <label class="col-form-label" for="form-address">Purok</label>
                        <!--<input name="resident_address" placeholder="Specify your prk... ex: Prk1" class="form-last-name form-control input-error" id="resident_address" type="text" required>-->
                        <select name="resident_address" id="purok_brgy" class="form-control" required>

                           <?php
                           $brgy_purok_list = mysqli_query($con, "SELECT * from brgy_purok");
                           while ($row_hmember = mysqli_fetch_array($brgy_purok_list)) {

                              echo '  <option value="' . $row_hmember['purok_id'] . '">' . $row_hmember['purok_name']  . '</option>';
                           }


                           ?> 
                        </select> 

                     </div>
                  </div>
               </fieldset>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default btn-next">Next</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal -->
   <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title" id="myModalLabel">Request Form</h4>
            </div>
            <div class="modal-body">
               <fieldset>
                  <div class="form-top">
                     <div class="form-top-left">
                        <h3>Step 2 / 2</h3>
                     </div>
                  </div>
                  <div class="form-bottom">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Request Type:</label>
                        <select name="req_type" id="req_type" placeholder="Type" class="form-control" required>
                           <option value=""></option>
                           <?php
                           $form_type = mysqli_query($con, "SELECT * from form_type");
                           while ($row_form = mysqli_fetch_array($form_type)) {

                              echo ' <option value="' . $row_form['req_id'] . '">' . $row_form['request_type'] . '</option>';
                           }

                           ?>
                        </select>
                     </div>
                     <!-- Transporation of animal and slaughter -->
                     <div id="TAS" data-spy="scroll" class="form-row">

                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Animal name:</label>
                           <input type="text" class="form-control" id="animal_name" name="animal_name" placeholder="Ex: pig">
                        </div>

                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Number of animal:</label>
                           <input type="number" class="form-control" id="num_animal" name="num_animal">
                        </div>

                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">To:</label>
                           <input type="text" class="form-control" id="sell_to" name="sell_to">
                        </div>

                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Address of person:</label>
                           <input type="text" class="form-control" id="address_person" name="address_person">
                        </div>

                     </div>

                     <!-- birth certificate  -->
                     <div id="Birth_Certificate">
                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Father's name:</label>
                           <input type="text" class="form-control" id="father_name" name="father_name">
                        </div>

                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Father's Age:</label>
                           <input type="number" class="form-control" id="father_age" name="father_age">
                        </div>

                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Mother's Name:</label>
                           <input type="text" class="form-control" id="mother_name" name="mother_name">
                        </div>

                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Mother's Age:</label>
                           <input type="number" class="form-control" id="mother_age" name="mother_age">
                        </div>
                     </div>

                     <!-- Live-in cert -->
                     <div id="Live_in_cert">
                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Full name of Partner:</label>
                           <input type="text" class="form-control" id="father_name" name="name_partner">
                        </div>

                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Birth date:</label>
                           <input type="date" class="form-control" id="father_age" name="bdate_partner">
                        </div>

                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Living together:</label>
                           <select name="living_together" class="form-control" id="">
                              <option value="" selected></option>
                              <option value="months">Months</option>
                              <option value="years">Years</option>
                           </select>
                        </div>

                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Number of Years/months</label>
                           <input type="number" class="form-control" id="mother_age" name="num_living_together">
                        </div>
                     </div>
                     <!-- Death cert -->
                     <div id="Death">
                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Place of Death:</label>
                           <input type="text" class="form-control" id="place_of_death" name="place_of_death" placeholder="Please specify address">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="recipient-name" class="col-form-label">Day of the deceased:</label>
                           <input type="date" class="form-control" id="day_of_deceased" name="day_of_deceased">
                        </div>
                     </div>
                     <!-- Indigency -->
                     <div id="Indigency">
                     </div>
                     <!-- Cert of low income -->
                     <div id="Cert_of_low_income">

                     </div>
                     <!-- Residency -->
                     <div id="Residency">
                        <div class="form-group col-md-12">
                           <label for="recipient-name" class="col-form-label">Terms of living:</label>
                           <input type="number" class="form-control" id="total_lived" name="terms_of_living">
                        </div>
                     </div>

                     <div id="Clearance">
                        <div class="form-group col-md-12">
                           <label for="recipient-name" class="col-form-label">Cedula number:</label>
                           <input type="number" class="form-control" id="cedula_number" name="cedula_number" placeholder="cedula number...">
                        </div>
                     </div>




                     <div class="residency_details">
                        <div class="form-group col-md-12">
                           <label for="recipient-name" class="col-form-label">Purpose:</label>
                           <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Purpose...">
                        </div>
                        <div class="form-group col-md-12">
                           <label for="attached_photo" class="col-form-label">Attach Photo:</label>
                           <input type="file" name="attached_photo" accept="image/*">
                        </div>
                        <div class="form-group col-md-12">
                           <label for="attached_file" class="col-form-label">Attach File:</label>
                           <input type="file" name="attached_file" accept=".doc, .pdf, .png, .jpg, .jpeg, .docx, .txt, .rar, .zip">
                        </div>
                        
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default btn-prev">Prev</button>
               <button type="button" class="btn btn-default" id="review_and_save">Review and Save</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal -->
   <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title" id="myModalLabel">Request Form</h4>
            </div>
            <div class="modal-body">
               <fieldset>
                  <div class="form-top">
                     <div class="form-top-left">
                        <h3>Step 3 / 3</h3>
                        <p>Payment method:</p>
                     </div>

                  </div>
                  <div class="form-bottom">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Type:</label>
                        <select name="method_type_payment" id="method_type_payment" placeholder="Type" class="form-control" required>
                           <option value="">--SELECT PAYMENT METHOD--</option>
                           <option value="GCASH">GCASH -- N/A</option>
                           <option value="COD" selected>Cash on Delivery</option>
                           <option value="ONSITE">Onsite -- N/A</option>
                        </select>
                     </div>
                     <div id="receipt_details">
                        <div class="form-group">
                           <label for="recipient-name" class="sr-only">Address to Deliver:</label>
                           <input type="text" class="form-control" id="address_to_deliver" name="address_to_deliver" placeholder="Address to Deliver..">
                        </div>
                        <div class="form-group">
                           <label for="recipient-name" class="sr-only">Contact #:</label>
                           <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact #..">
                        </div>
                        <div class="form-group">
                           <label for="recipient-name" class="sr-only">Amount:</label>
                           <input type="number" class="form-control" placeholder="Amount.." readonly>
                        </div>
                        <div class="form-group">
                           <label for="recipient-name" class="sr-only">Shipping Fee:</label>
                           <input type="number" class="form-control" placeholder="Shipping Fee.." readonly>
                        </div>
                        <div class="form-group">
                           <label for="recipient-name" class="sr-only">Tax:</label>
                           <input type="number" class="form-control" placeholder="VAT.." readonly>
                        </div>
                        <div class="form-group">
                           <label for="recipient-name" class="sr-only">Total Amount:</label>
                           <input type="number" class="form-control" placeholder="Total Amount.." readonly>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default btn-prev">Prev</button>
               <button type="button" class="btn btn-default" id="review_and_save">Review and Save</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
</form>
<!-- Modal -->
<div class="modal fade" id="mySuccessModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Review Details</h4>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <input name="reciept_id" type="hidden" id="reciept_id" value="">
               <label for="recipient-name" class="col-form-label">Full Name: <span id="sp_first_name">, </span> <span id="sp_last_name"> </span></label>
            </div>
            <!-- <div class="form-group">
               <label for="recipient-name" class="col-form-label">Birthdate: <span id="sp_birthdate_name"></span></label>
            </div> -->
            <div class="form-group">
               <label for="recipient-name" class="col-form-label">Resident Address: <span id="sp_resident_address_name"></span></label>
            </div>
            <div class="form-group">
               <label for="recipient-name" class="col-form-label">Request Type: <span id="sp_req_type_name"></span></label>
            </div>
            <div class="form-group">
               <label for="recipient-name" class="col-form-label">Purpose: <span id="sp_purpose_name"></span></label>
            </div>
            <div class="form-group">
               <label for="recipient-name" class="col-form-label">Attached Photo: <img src="" id="sp_attached_photo" width="100%"></label>
            </div>
            <div class="form-group">
               <label for="recipient-name" class="col-form-label">Attached File: <a href="#" id="sp_attached_file" width="100%">File Attached</a></label>
            </div>
            <!-- <div class="form-group">
               <label for="recipient-name" class="col-form-label">Amount Form: <span id="sp_amount_form_name"></span></label>
            </div>
            <div class="form-group">
               <label for="recipient-name" class="col-form-label">Shipping Fee: <span id="sp_shipping_fee_name"></span></label>
            </div>
            <div class="form-group">
               <label for="recipient-name" class="col-form-label">VAT: <span id="sp_vat_name"></span></label>
            </div>
            <div class="form-group">
               <label for="recipient-name" class="col-form-label">Total Amount: <span id="sp_total_name"></span></label>
            </div>
            <div class="form-group">
               <label for="recipient-name" class="col-form-label">Contact #: <span id="sp_conctact_name"></span></label>
            </div>
            <div class="form-group">
               <label for="recipient-name" class="col-form-label">Delivery Address: <span id="sp_delivery_name"></span></label>
            </div> -->
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="confirm(this.value);" value="8">Cancel</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="confirm(this.value);" value="2">Save</button>
         </div>
      </div>
   </div>
</div>

<script>
   $("#TAS").hide();
   $("#Birth_Certificate").hide();
   $("#Live_in_cert").hide();
   $("#Cert_of_low_income").hide();



   $("#Residency").hide();
   $("#Clearance").hide();
   $("#Indigency").hide();
   $("#Death").hide();
   $("#Birth").hide();
   $(".residency_details").hide();
   $("#req_type")
      .change(function() {
         var str = "";
         var str = $('#req_type :selected').val();
         switch (str) {
            case "1":
               $(".residency_details").show();
               $("#TAS").show();
               $("#Birth_Certificate").hide();
               $("#Live_in_cert").hide();
               $("#Cert_of_low_income").hide();

               $("#Clearance").hide();
               $("#Indigency").hide();
               $("#Death").hide();
               $("#Birth").hide();
               break;

            case "2":
               $(".residency_details").show();
               $("#Birth_Certificate").show();
               $("#TAS").hide();
               $("#Live_in_cert").hide();
               $("#Cert_of_low_income").hide();

               $("#Clearance").hide();
               $("#Residency").hide();
               $("#Indigency").hide();
               $("#Death").hide();
               $("#TAS").hide();
               break;
            case "3":
               $(".residency_details").show();
               $("#Live_in_cert").show();
               $("#TAS").hide();
               $("#Birth_Certificate").hide();
               $("#Cert_of_low_income").hide();

               $("#Clearance").hide();
               $("#Residency").hide();
               $("#Indigency").hide();
               $("#Death").hide();
               $("#Birth").hide();

               break;
            case "4":
               $(".residency_details").show();
               $("#Death").show();
               $("#TAS").hide();
               $("#Live_in_cert").hide();
               $("#Birth_Certificate").hide();
               $("#Cert_of_low_income").hide();

               $("#Indigency").hide();
               $("#Residency").hide();
               $("#Clearance").hide();
               $("#Birth").hide();
               break;
            case "5":
               $(".residency_details").show();
               $("#Indigency").show();
               $("#TAS").hide();
               $("#Death").hide();
               $("#Live_in_cert").hide();
               $("#Birth_Certificate").hide();
               $("#Cert_of_low_income").hide();

               $("#Residency").hide();
               $("#Clearance").hide();
               $("#Birth").hide();

               break;
            case "6":
               $(".residency_details").show();
               $("#Birth").hide();
               $("#Birth_Certificate").hide();
               $("#Cert_of_low_income").show();
               $("#Residency").hide();
               $("#Clearance").hide();
               $("#Indigency").hide();
               $("#Death").hide();
               $("#TAS").hide();
               $("#Live_in_cert").hide();

               break;

            case "7":
               $(".residency_details").show();
               $("#Birth").hide();
               $("#Birth_Certificate").hide();
               $("#Cert_of_low_income").hide();
               $("#Residency").show();
               $("#Clearance").hide();
               $("#Indigency").hide();
               $("#Death").hide();
               $("#TAS").hide();
               $("#Live_in_cert").hide();

               break;

            case "8":
               $(".residency_details").show();
               $("#Birth").hide();
               $("#Birth_Certificate").hide();
               $("#Cert_of_low_income").hide();
               $("#Residency").hide();
               $("#Clearance").show();
               $("#Indigency").hide();
               $("#Death").hide();
               $("#TAS").hide();
               $("#Live_in_cert").hide();
               break;
            default:
               $("#TAS").hide();
               $("#Birth_Certificate").hide();
               $("#Live_in_cert").hide();
               $("#Residency").hide();
               $("#Clearance").hide();
               $("#Indigency").hide();
               $("#Death").hide();
               $("#Birth").hide();
               $("#Cert_of_low_income").hide();
               $(".residency_details").hide();
               break;
         }
      });

   $("div[id^='myModal']").each(function() {

      var currentModal = $(this);

      //click next
      currentModal.find('.btn-next').click(function() {
         currentModal.modal('hide');
         currentModal.closest("div[id^='myModal']").nextAll("div[id^='myModal']").first().modal('show');
      });

      //click prev
      currentModal.find('.btn-prev').click(function() {
         currentModal.modal('hide');
         currentModal.closest("div[id^='myModal']").prevAll("div[id^='myModal']").first().modal('show');
      });

   });

   $(document).ready(function() {
      $("#review_and_save").click(function() {
         var data = new FormData();

         //Form data
         var form_data = $("#save_and_review").serializeArray();
         $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
         });

         //File image
         var file_image = $('input[name="attached_photo"]')[0].files;
         data.append("attached_photo", file_image[0]);

         //File data
         var file_data = $('input[name="attached_file"]')[0].files;
         data.append("attached_file", file_data[0]);

         $.ajax({
            type: "POST",
            url: 'RequestController.php',
            data: data,
            processData: false,
            contentType: false,
            success: function(response) {
               // var jsonData = JSON.parse(response);
               console.log(response);
               var jsonData = JSON.parse(response);
               if (jsonData.success == 0) {
                  $("div[id^='myModal']").each(function() {
                     var currentModal = $(this);
                     currentModal.modal('hide');
                  });

                  $('#mySuccessModal').modal({
                     show: 'true'
                  });

                  $("#sp_first_name").text(jsonData.data.household_member_id);
                  $("#sp_resident_address_name").text(jsonData.data.resident_address);
                  $("#sp_req_type_name").text(jsonData.data.request_type);
                  $("#sp_purpose_name").text(jsonData.data.purpose);
                  $("#sp_amount_form_name").text(jsonData.data.amount_form);
                  $("#sp_shipping_fee_name").text(jsonData.data.shiping_fee);
                  $("#sp_vat_name").text(jsonData.data.tax);
                  $("#sp_total_name").text(jsonData.data.total_amount);
                  $("#sp_conctact_name").text(jsonData.data.contact_no);
                  $("#sp_delivery_name").text(jsonData.data.address_to_deliver);
                  $("#sp_attached_photo").attr("src", "./uploads/"+jsonData.data.attached_photo);
                  $("#sp_attached_file").attr("href", "./uploads/"+jsonData.data.attached_file);
                  $("#reciept_id").attr("value", jsonData.data.reciept_id);
               }
            }

         });
      });
   });

   function confirm(x) {
      var value = $("#reciept_id").val();
      var status = x;
      $.ajax({
         type: "POST",
         url: 'RequestController.php',
         data: {
            value: value,
            status: status
         },
         success: function(response) {
            // var jsonData = JSON.parse(response);
            // console.log(response);
            // var jsonData = JSON.parse(response);
            location.reload(true);
         }

      });
   }
</script>