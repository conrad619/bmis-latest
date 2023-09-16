
  
  $(document).ready(function(){

$('#next').click(function() {

  // var last_name = $("#last_name").val();  
  // var first_name = $("#first_name").val();
  // var middle_name = $("#middle_name").val();
  // var email = $("#email").val();
  // var tel_num = $("#tel_num").val();
  // var u_address = $("#u_address").val();
  // var u_name = $("#u_name").val();
  // var password = $("#password").val();

  //   if (last_name === '' || first_name === '' || middle_name === '' || email === '' || tel_num === '' || u_address === '' || u_name === '' || password === '') {

  //     $("#warning-step1").html('<div class="alert alert-danger pop-up-step1 alert-dismissible" role="alert">\
  //     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
  //     <strong>All input is mandatory!</strong> Before to proceed next step\
  //     </div>');

      
  //   }else{

    
    // $(".pop-up-step1").remove();

    $('.current').removeClass('current').hide()
      .next().show().addClass('current');  
      $('.current1').removeClass('current1').removeClass('active').next().addClass('active').addClass('current1');
  
      $( "span.current1" ).prevAll().find('span').addClass('active1');
  
    if ($('.current').hasClass('last')) {
      $('#next').css('display', 'none');
      $('#submit').css('display', 'block');

    }

    $('#prev').css('display', 'block');

  // }



  });
  
  $('#prev').click(function() {
    $('.current').removeClass('current').hide()
      .prev().show().addClass('current');
    $('.current1').removeClass('current1').removeClass('active').prev().addClass('active').addClass('current1');
    
    $("span.current1").find('span').removeClass('active1'); 
    
    if ($('.current').hasClass('first')) {
      $('#prev').css('display', 'none');
      $('#submit').css('display', 'none');


    }
    $('#submit').css('display', 'none');

    $('#next').css('display', 'block');
  });



  $('#status_signup').on('change', function() {
    //alert( $(this).find(":selected").val() );
    var selected = $(this).find(":selected").val();
    if (selected == 'Married' || selected == 'Live-in Partner') {

      //$("#append-status").removeClass('d-none');

            $("#append-status").html('<div class="col-md-12 pop-status">\
            <div class="form-group">\
                <div class="col-sm-4 padding-for-all">\
                <label class="control-label" >Spouse name</label><br>\
                    <input name="spouse_fullname" class="form-control"  type="text" placeholder="Spouse name" required/>\
                </div>\
                <div class="col-sm-4 padding-for-all">\
                    <label class="control-label" >Birth Date</label>\
                    <input name="spouseb_date"  class="form-control" type="date" placeholder="Birth Date" required/>\
                </div>\
                <div class="col-sm-4 padding-for-all">\
                    <label class="control-label" >Occupation</label>\
                    <input name="spouse_occupation" class="form-control" type="text" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" placeholder="Occupation" required/>\
                </div>\
            </div>\
        </div>');


    }else if(selected == 'Single' || selected == 'Widow' || selected == 'Solo Parent'){

       $('.pop-status').remove();
    

    }

  });


  $('#belongings').on('change', function() {
    //alert( $(this).find(":selected").val() );
    var belongings = $(this).find(":selected").val();
    if (belongings == 'Yes') {

      // $("#popup_belongings").removeClass('d-none');
      $("#popup_belongings").html('<input name="specify_belong" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" class="form-control belongings_input" type="text" placeholder="Please specify your community" required/>');

    }else if(belongings == 'No'){

       $('.belongings_input').remove();
    

    }

  });



  //here for household information

  $('#household_status').on('change', function() {
    //alert( $(this).find(":selected").val() );
    var household_status = $(this).find(":selected").val();
    if (household_status == 'No') {

      // $("#popup_belongings").removeClass('d-none');
     $(".dispaly_household").removeClass('d-none');
     $(".household-show").addClass('household-info');

      $(".household-show").html('\
      <div id = "hide_show_houseinfo">\
              <div class="col-sm-4 padding-for-all">\
                  <label class="control-label" >First name</label><br>\
                  <input name="f_name[]" id = "dont_allow_char" class="form-control upper" type="text" placeholder="First name" required/>\
              </div>\
\
              <div class="col-sm-4 padding-for-all">\
                  <label class="control-label" >Last name</label><br>\
                  <input name="l_name[]" id = "dont_allow_char" class="form-control upper" type="text" placeholder="Last name" required/>\
              </div>\
\
              <div class="col-sm-4 padding-for-all">\
                  <label class="control-label" >Middle name</label><br>\
                  <input name="m_name[]" id = "dont_allow_char" class="form-control upper" type="text" placeholder="Middle name" required/>\
              </div>\
\
              <div class="col-sm-4 padding-for-all">\
                  <label class="control-label" >Birth Date</label>\
                  <input name="hmemberb_date[]"  id = "dont_allow_char" class="form-control upper" type="date" placeholder="Birth Date" required/>\
              </div>\
\
              <div class="col-sm-4 padding-for-all">\
                  <label class="control-label" >Relationship</label>\
                  <input name="hmember_relationship[]"  id = "dont_allow_char" class="form-control upper" type="text" placeholder="ex. Brother" required/>\
              </div>\
\
              <div class="col-sm-4 padding-for-all">\
                  <label class="control-label" >Occupation</label>\
                  <input name="hmember_occupation[]" id = "dont_allow_char" class="form-control upper" type="text" placeholder="Occupation" required/>\
              </div>\
              </div>\
        ');

    }else if(household_status == 'Yes'){

       //$('.belongings_input').remove();
       $("#hide_show_houseinfo").remove();
       $(".show-mem").remove();
       $(".dispaly_household").addClass('d-none');
       $(".household-show").removeClass('household-info');


    }

  });



  //here for household information

  $("#add_more_member").click(function(){
    $("#show_more_member").append('<div class="row show-mem" style = "padding-bottom:5px;">\
    <div class="col-md-12">\
        <div class="form-group row household-info">\
                <div class="col-sm-4 padding-for-all">\
                    <label class="control-label" >First name</label><br>\
                    <input name="f_name[]" id = "dont_allow_char" class="form-control upper" type="text" placeholder="First name" required/>\
                </div>\
                \
                <div class="col-sm-4 padding-for-all">\
                    <label class="control-label" >Last name</label><br>\
                    <input name="l_name[]" id = "dont_allow_char" class="form-control upper" type="text" placeholder="Last name" required/>\
                </div>\
                \
                <div class="col-sm-4 padding-for-all">\
                    <label class="control-label" >Middle name</label><br>\
                    <input name="m_name[]" id = "dont_allow_char" class="form-control upper" type="text" placeholder="Middle name" required/>\
                </div>\
                \
                <div class="col-sm-4 padding-for-all">\
                    <label class="control-label" >Birth Date</label>\
                    <input name="hmemberb_date[]"  class="form-control" type="date" placeholder="Birth Date" required/>\
                </div>\
                \
                <div class="col-sm-4 padding-for-all">\
                    <label class="control-label" >Relationship</label>\
                    <input name="hmember_relationship[]"  onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" class="form-control" type="text" placeholder="ex. Brother" required/>\
                </div>\
                \
                <div class="col-sm-4 padding-for-all">\
                    <label class="control-label" >Occupation</label>\
                    <input name="hmember_occupation[]" class="form-control upper" type="text"  placeholder="Occupation" required/>\
                </div>\
        </div>\
    </div>\
</div>');
  });

  $("#remove_member").click( function() {
    $(".show-mem:last").remove();
 });


 $('#show-other-resi-stat').on('change', function() {
  //alert( $(this).find(":selected").val() );
  var other = $(this).find(":selected").val();
  if (other == 'Other') {

    $(".show-other-resi-stat").html('<label class="control-label resi_stat" >Please specify</label><br>\
    <input name="other_status" class="form-control resi_stat" type="text" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" placeholder="Specify your resident status" required/>');

  }else{

     $('.resi_stat').remove();
  

  }

});

//here 
//specify-benificiary
//specify-pensioner
$('#specify-benificiary').on('change', function() {
  //alert( $(this).find(":selected").val() );
  var benificiary = $(this).find(":selected").val();
  if (benificiary == 'Yes') {

    $(".specify-benificiary").html('<label class="control-label spe_beni" >Please specify</label><br>\
    <input name="specify_benificiary" class="form-control spe_beni" type="text" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" placeholder="Specify your benificiary" required/>');

  }else{

     $('.spe_beni').remove();
  

  }

});

$('#specify-pensioner').on('change', function() {
  //alert( $(this).find(":selected").val() );
  var pensioner = $(this).find(":selected").val();
  if (pensioner == 'Yes') {

    $(".specify-pensioner").html('<label class="control-label spe_pen" >Please specify</label><br>\
    <input name="specify_pensioner" class="form-control spe_pen" type="text" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" placeholder="Specify your pensioner" required/>');

  }else{

     $('.spe_pen').remove();
  

  }

});



   
  });



  //here
  $(document).ready(function() {

      
 
    var timeOut = null; // this used for hold few seconds to made ajax request

    var loading_html = '<img src="../../img/ajax-loader.gif" style="height: 20px; width: 20px;"/>'; // just an loading image or we can put any texts here

    //when button is clicked
    $('#username').keyup(function(e){

        // when press the following key we need not to make any ajax request, you can customize it with your own way
        switch(e.keyCode)
        {
            //case 8:   //backspace
            case 9:     //tab
            case 13:    //enter
            case 16:    //shift
            case 17:    //ctrl
            case 18:    //alt
            case 19:    //pause/break
            case 20:    //caps lock
            case 27:    //escape
            case 33:    //page up
            case 34:    //page down
            case 35:    //end
            case 36:    //home
            case 37:    //left arrow
            case 38:    //up arrow
            case 39:    //right arrow
            case 40:    //down arrow
            case 45:    //insert
            //case 46:  //delete
                return;
        }
        if (timeOut != null)
            clearTimeout(timeOut);
        timeOut = setTimeout(is_available, 500);  // delay delay ajax request for 1000 milliseconds
        $('#user_msg').html(loading_html); // adding the loading text or image
    });
});


function is_available(){
//get the username
var username = $('#username').val();

//make the ajax request to check is username available or not
if (username === '') {


        $('#user_msg').html('<span>Empty</span>');
        document.getElementById("next").disabled = true;

}else{

$.post("./check_username.php", { username: username },
function(result)
{
    console.log(result);
    if(result != 0)
    {
        $('#user_msg').html('<i class="bi bi-x-circle"></i> Not Available');
        document.getElementById("next").disabled = true;
    }
    else
    {
        $('#user_msg').html('<span style="color:#d1ded4;"><i class="bi bi-check-circle"></i> Available</span>');
        document.getElementById("next").disabled = false;
    }
});

}

}