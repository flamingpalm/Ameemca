
     <?php include 'inc/navb.php'; ?>
     
            <div class="app-content">
                <div class="app-content--inner">
                    <div class="page-title">
                        <div>
                            <h5 class="display-4 mt-1 mb-2 font-weight-bold">Bio Update</h5>
                            <div id="operation-response"> </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-body">
                                            <form class="was-validated mb-50" id="my-bio-form" enctype="multipart/form-data">
                                                 <div class="title">
                                                    <h1> Personal Details </h1>
                                                <div class="row">
                                                    <style>
                                                    .imgThumb {
                                                        max-width: 100%;
                                                        width: 95%;
                                                        max-height: 300px;
                                                        border-radius: 5px;
                                                        overflow: none;
                                                    }
                                                    </style> 
                                                            <div class="col-md-6 mb-3">
                                                            <label for="form-file-4">Passport ID</label>
                                                            <div id="image_preview" style="margin-bottom: 10px;text-align: center;">
                                                                <img src="<?php echo getUserInfo("photo"); ?>" style="width: 130px;border-radius: 50%;height: 130px;text-align: center;">
                                                            </div>
                                        
                                                            <div class="custom-file w-100">
                                                                <input type="file" class="custom-file-input" id="user_image" name="user_image" required="">
                                                                <label class="custom-file-label" for="user_image" style="text-align: left;" id="user_image_label">Choose file...</label>
                                                                <input type="hidden" name="hidden_user_image" id="hidden_user_image" value="<?php echo getUserInfo("photo"); ?>">
                                                                 <div id="error_user_image" style="color: red" class="error_msg_reset"> </div>
                                                            </div>
                                                             </div>
                                                             
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">First name</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-first-name" name="fname" placeholder="First name" value="<?php echo getUserInfo("fname"); ?>"  required="">
                                                    <div id="error_first_name" style="color: red" class="error_msg_reset"> </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-last-name">Last name</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-last-name" name="lname"placeholder="Last name" value="<?php echo getUserInfo("lname"); ?>"  required="">
                                                         <div id="error_last_name" style="color: red" class="error_msg_reset"> </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">Email Address</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-first-name" name="email" placeholder="Email Address" value="<?php echo getUserInfo("email"); ?>"  required="">
                                                     <div id="error_user_email" style="color: red" class="error_msg_reset"> </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-last-name">Address</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-last-name" name="address" placeholder="Address" value="<?php echo getUserInfo("address"); ?>"  required="">
                                                    <div id="error_user_address" style="color: red" class="error_msg_reset"> </div>
                                                    </div>
                                                </div>
                                               <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">1st Phone No.</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-first-name" name="phone" placeholder="Phone Number" value="<?php echo getUserInfo("phone"); ?>"  required="">
                                                    <div id="error_user_phone" style="color: red" class="error_msg_reset"> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">2nd Phone No.</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-first-name" name="sec_phone" placeholder="Phone Number" value="<?php echo getUserInfo("phone"); ?>"  required="">
                                                    <div id="error_user_sec_phone" style="color: red" class="error_msg_reset"> </div>
                                                    </div>
                                                </div>
                                              
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">Agency/Bureau</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-first-name" name="agency_bureau" placeholder="Agency/Bureau" value="<?php echo getUserInfo("agency_bureau"); ?>"  required="">
                                                    <div id="error_agency_bureau" style="color: red" class="error_msg_reset"> </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">Employee Post</label>
                                                         <select class="custom-select w-100" id="form-3-select" name="employee_post"  required="">
                                                          <option value="" disabled>Select Post</option>
                                                          <option value="1"<?php if(getUserInfo("employee_post") == '56002-Nigeria-Lagos'){echo 'selected';} ?> >56002-Nigeria-Lagos</option>
                                                          <option value="2" <?php if(getUserInfo("employee_post") == '56002-Nigeria-Abuja'){echo 'selected';} ?> >56002-Nigeria-Abuja</option>
                                                         </select>  
                                                         <div id="error_employee_post" style="color: red" class="error_msg_reset"> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">Employee Number</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-first-name" name="employee_number" placeholder="Employee Number" value="<?php echo getUserInfo("employee_number"); ?>"  required="">
                                                    <div id="error_employee_number" style="color: red" class="error_msg_reset"> </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                          <label for="form-2-city">Country</label>
                                                         <select class="custom-select w-100" id="form-3-select" name="country" required="">
                                                             <option value="" disabled selected>State</option>
                                                             <option value="NIGERIA" <?php if(getUserInfo("state") == 'NIGERIA'){echo 'selected';} ?> >NIGERIA</option>
                                                            </select>
                                                            <div id="error_user_country" style="color: red" class="error_msg_reset"> </div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label for="form-2-state">State</label>
                                                         <select class="custom-select w-100" id="form-3-select" name="state" required="">
                                                             <option value="" disabled selected>State</option>
<option value="ABUJA FCT" <?php if(getUserInfo("state") == 'ABUJA FCT'){echo 'selected';} ?> >ABUJA FCT</option>
<option value="ABUJA FCT" <?php if(getUserInfo("nokstate") == 'ABIA'){echo 'selected';} ?> >ABIA</option>
<option value="ADAMAWA" <?php if(getUserInfo("state") == 'ADAMAWA'){echo 'selected';} ?> >ADAMAWA</option>
<option value="AKWA IBOM" <?php if(getUserInfo("state") == 'AKWA IBOM'){echo 'selected';} ?> >AKWA IBOM</option>
<option value="ANAMBRA" <?php if(getUserInfo("state") == 'ANAMBRA'){echo 'selected';} ?> >ANAMBRA</option>
<option value="BAUCHI" <?php if(getUserInfo("state") == 'BAUCHI'){echo 'selected';} ?> >BAUCHI</option>
<option value="BAYELSA" <?php if(getUserInfo("state") == 'BAYELSA'){echo 'selected';} ?> >BAYELSA</option>
<option value="BENUE" <?php if(getUserInfo("state") == 'BENUE'){echo 'selected';} ?> >BENUE</option>
<option value="BORNO" <?php if(getUserInfo("state") == 'BORNO'){echo 'selected';} ?> >BORNO</option>
<option value="CROSS RIVER" <?php if(getUserInfo("state") == 'CROSS RIVER'){echo 'selected';} ?> >CROSS RIVER</option>
<option value="DELTA" <?php if(getUserInfo("state") == 'DELTA'){echo 'selected';} ?> >DELTA</option>
<option value="EBONYI" <?php if(getUserInfo("state") == 'EBONYI'){echo 'selected';} ?> >EBONYI</option>
<option value="EDO" <?php if(getUserInfo("state") == 'EDO'){echo 'selected';} ?> >EDO</option>
<option value="EKITI" <?php if(getUserInfo("state") == 'EKITI'){echo 'selected';} ?> >EKITI</option>
<option value="ENUGU" <?php if(getUserInfo("state") == 'ENUGU'){echo 'selected';} ?> >ENUGU</option>
<option value="GOMBE" <?php if(getUserInfo("state") == 'GOMBE'){echo 'selected';} ?> >GOMBE</option>
<option value="IMO" <?php if(getUserInfo("state") == 'IMO'){echo 'selected';} ?> >IMO</option>
<option value="JIGAWA" <?php if(getUserInfo("state") == 'JIGAWA'){echo 'selected';} ?> >JIGAWA</option>
<option value="KADUNA" <?php if(getUserInfo("state") == 'KADUNA'){echo 'selected';} ?> >KADUNA</option>
<option value="KANO" <?php if(getUserInfo("state") == 'KANO'){echo 'selected';} ?> >KANO</option>
<option value="KATSINA" <?php if(getUserInfo("state") == 'KATSINA'){echo 'selected';} ?> >KATSINA</option>
<option value="KEBBI" <?php if(getUserInfo("state") == 'KEBBI'){echo 'selected';} ?> >KEBBI</option>
<option value="KOGI" <?php if(getUserInfo("state") == 'KOGI'){echo 'selected';} ?> >KOGI</option>
<option value="KWARA" <?php if(getUserInfo("state") == 'KWARA'){echo 'selected';} ?> >KWARA</option>
<option value="LAGOS" <?php if(getUserInfo("state") == 'LAGOS'){echo 'selected';} ?> >LAGOS</option>
<option value="NASSARAWA" <?php if(getUserInfo("state") == 'NASSARAWA'){echo 'selected';} ?> >NASSARAWA</option>
<option value="NIGER" <?php if(getUserInfo("state") == 'NIGER'){echo 'selected';} ?> >NIGER</option>
<option value="OGUN" <?php if(getUserInfo("state") == 'OGUN'){echo 'selected';} ?> >OGUN</option>
<option value="ONDO" <?php if(getUserInfo("state") == 'ONDO'){echo 'selected';} ?> >ONDO</option>
<option value="OSUN" <?php if(getUserInfo("state") == 'OSUN'){echo 'selected';} ?> >OSUN</option>
<option value="OYO" <?php if(getUserInfo("state") == 'OYO'){echo 'selected';} ?> >OYO</option>
<option value="PLATEAU" <?php if(getUserInfo("state") == 'PLATEAU'){echo 'selected';} ?> >PLATEAU</option>
<option value="RIVERS" <?php if(getUserInfo("state") == 'RIVERS'){echo 'selected';} ?> >RIVERS</option>
<option value="SOKOTO" <?php if(getUserInfo("state") == 'SOKOTO'){echo 'selected';} ?> >SOKOTO</option>
<option value="TARABA" <?php if(getUserInfo("state") == 'TARABA'){echo 'selected';} ?> >TARABA</option>
<option value="YOBE" <?php if(getUserInfo("state") == 'YOBE'){echo 'selected';} ?> >YOBE</option>
<option value="ZAMFARA" <?php if(getUserInfo("state") == 'ZAMFARA'){echo 'selected';} ?> >ZAMFARA</option>
</select>
<div id="error_user_state" style="color: red" class="error_msg_reset"> </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="d-block" for="form-3-select">Gender</label>
                                                        <select class="custom-select w-100" id="form-3-select" name="gender"  required="">
                                                          <option value="">Select Gender</option>
                                                          <option value="male"<?php if(getUserInfo("gender") == 'male'){echo 'selected';} ?> >Male</option>
                                                          <option value="female" <?php if(getUserInfo("gender") == 'female'){echo 'selected';} ?> >Female</option>
                                                         </select>
                                                        <div id="error_user_gender" style="color: red" class="error_msg_reset"> </div>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-md-6 ">
                                                        <div class="custom-control custom-checkbox mb-3 ">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">

                                                    </div>
                                                </div>
                                                <!-- Submit button -->
                                                <input type="hidden" name="action" value="updatebio">
                                                <button class="btn radius-10 btn-primary" type="submit" id="myBioSaveBtn"><span id="btn_swap">UPDATE BIO</span></button>
                                            </form>
                                            
                                            
                                            
                                            
                                            
                                                <hr><br>
                                                
                                                
                                                

                                             <form class="was-validated mb-50" id="my-nokbio-form">
                                                 <div class="title">
                                                    <h1> Next of Kin's Details </h1>
                                                <div class="row">
                                                    
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">First name</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-first-name" name="nokfname" placeholder="First name" value="<?php echo getUserInfo("nokfname"); ?>"  required="">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-last-name">Last name</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-last-name" name="noklname"placeholder="Last name" value="<?php echo getUserInfo("noklname"); ?>"  required="">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">Email Address</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-first-name" name="nokemail" placeholder="Email Address" value="<?php echo getUserInfo("nokemail"); ?>"  required="">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-last-name">Address</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-last-name" name="nokaddress" placeholder="nokAddress" value="<?php echo getUserInfo("nokaddress"); ?>"  required="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">Phone Number</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-first-name" name="nokphone" placeholder="Phone Number" value="<?php echo getUserInfo("nokphone"); ?>"  required="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                         <label for="form-2-city">Country</label>
                                                         <select class="custom-select w-100" id="form-3-select" name="nokcountry" required="">
                                                             <option value="" disabled selected>Country</option>
                                                             <option value="NIGERIA" <?php if(getUserInfo("nokcountry") == 'NIGERIA'){echo 'selected';} ?> >NIGERIA</option>
                                                            </select>
                                                            <div class="invalid-feedback"></div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label for="form-2-state">State</label>
                                                         <select class="custom-select w-100" id="form-3-select" name="nokstate" required="">
                                                             <option value="" disabled selected>State</option> 
<option value="ABUJA FCT" <?php if(getUserInfo("nokstate") == 'ABUJA FCT'){echo 'selected';} ?> >ABUJA FCT</option>
<option value="ADAMAWA" <?php if(getUserInfo("nokstate") == 'ADAMAWA'){echo 'selected';} ?> >ADAMAWA</option>
<option value="AKWA IBOM" <?php if(getUserInfo("nokstate") == 'AKWA IBOM'){echo 'selected';} ?> >AKWA IBOM</option>
<option value="ANAMBRA" <?php if(getUserInfo("nokstate") == 'ANAMBRA'){echo 'selected';} ?> >ANAMBRA</option>
<option value="BAUCHI" <?php if(getUserInfo("nokstate") == 'BAUCHI'){echo 'selected';} ?> >BAUCHI</option>
<option value="BAYELSA" <?php if(getUserInfo("nokstate") == 'BAYELSA'){echo 'selected';} ?> >BAYELSA</option>
<option value="BENUE" <?php if(getUserInfo("nokstate") == 'BENUE'){echo 'selected';} ?> >BENUE</option>
<option value="BORNO" <?php if(getUserInfo("nokstate") == 'BORNO'){echo 'selected';} ?> >BORNO</option>
<option value="CROSS RIVER" <?php if(getUserInfo("nokstate") == 'CROSS RIVER'){echo 'selected';} ?> >CROSS RIVER</option>
<option value="DELTA" <?php if(getUserInfo("nokstate") == 'DELTA'){echo 'selected';} ?> >DELTA</option>
<option value="EBONYI" <?php if(getUserInfo("nokstate") == 'EBONYI'){echo 'selected';} ?> >EBONYI</option>
<option value="EDO" <?php if(getUserInfo("nokstate") == 'EDO'){echo 'selected';} ?> >EDO</option>
<option value="EKITI" <?php if(getUserInfo("nokstate") == 'EKITI'){echo 'selected';} ?> >EKITI</option>
<option value="ENUGU" <?php if(getUserInfo("nokstate") == 'ENUGU'){echo 'selected';} ?> >ENUGU</option>
<option value="GOMBE" <?php if(getUserInfo("nokstate") == 'GOMBE'){echo 'selected';} ?> >GOMBE</option>
<option value="IMO" <?php if(getUserInfo("nokstate") == 'IMO'){echo 'selected';} ?> >IMO</option>
<option value="JIGAWA" <?php if(getUserInfo("nokstate") == 'JIGAWA'){echo 'selected';} ?> >JIGAWA</option>
<option value="KADUNA" <?php if(getUserInfo("nokstate") == 'KADUNA'){echo 'selected';} ?> >KADUNA</option>
<option value="KANO" <?php if(getUserInfo("nokstate") == 'KANO'){echo 'selected';} ?> >KANO</option>
<option value="KATSINA" <?php if(getUserInfo("nokstate") == 'KATSINA'){echo 'selected';} ?> >KATSINA</option>
<option value="KEBBI" <?php if(getUserInfo("nokstate") == 'KEBBI'){echo 'selected';} ?> >KEBBI</option>
<option value="KOGI" <?php if(getUserInfo("nokstate") == 'KOGI'){echo 'selected';} ?> >KOGI</option>
<option value="KWARA" <?php if(getUserInfo("nokstate") == 'KWARA'){echo 'selected';} ?> >KWARA</option>
<option value="LAGOS" <?php if(getUserInfo("nokstate") == 'LAGOS'){echo 'selected';} ?> >LAGOS</option>
<option value="NASSARAWA" <?php if(getUserInfo("nokstate") == 'NASSARAWA'){echo 'selected';} ?> >NASSARAWA</option>
<option value="NIGER" <?php if(getUserInfo("nokstate") == 'NIGER'){echo 'selected';} ?> >NIGER</option>
<option value="OGUN" <?php if(getUserInfo("nokstate") == 'OGUN'){echo 'selected';} ?> >OGUN</option>
<option value="ONDO" <?php if(getUserInfo("nokstate") == 'ONDO'){echo 'selected';} ?> >ONDO</option>
<option value="OSUN" <?php if(getUserInfo("nokstate") == 'OSUN'){echo 'selected';} ?> >OSUN</option>
<option value="OYO" <?php if(getUserInfo("nokstate") == 'OYO'){echo 'selected';} ?> >OYO</option>
<option value="PLATEAU" <?php if(getUserInfo("nokstate") == 'PLATEAU'){echo 'selected';} ?> >PLATEAU</option>
<option value="RIVERS" <?php if(getUserInfo("nokstate") == 'RIVERS'){echo 'selected';} ?> >RIVERS</option>
<option value="SOKOTO" <?php if(getUserInfo("nokstate") == 'SOKOTO'){echo 'selected';} ?> >SOKOTO</option>
<option value="TARABA" <?php if(getUserInfo("nokstate") == 'TARABA'){echo 'selected';} ?> >TARABA</option>
<option value="YOBE" <?php if(getUserInfo("nokstate") == 'YOBE'){echo 'selected';} ?> >YOBE</option>
<option value="ZAMFARA" <?php if(getUserInfo("nokstate") == 'ZAMFARA'){echo 'selected';} ?> >ZAMFARA</option>
</select>
                                                        <div class="invalid-feedback "></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="d-block" for="form-3-select">Gender</label>
                                                        <select class="custom-select w-100" id="form-3-select" name="nokgender"  required="">
                                                          <option value="">Select Gender</option>
                                                          <option value="male"<?php if(getUserInfo("nokgender") == 'male'){echo 'selected';} ?> >Male</option>
                                                          <option value="female" <?php if(getUserInfo("nokgender") == 'female'){echo 'selected';} ?> >Female</option>                
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-md-6 ">
                                                        <div class="custom-control custom-checkbox mb-3 ">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">

                                                    </div>
                                                </div>
                                                <!-- Submit button -->
                                               <input type="hidden" name="action" value="updatenok">
                                               <input type="hidden" name="can-redirect" value="no">
                                                <button class="btn radius-10 btn-primary" type="button" onclick="updateNokBio()">UPDATE</button>
                                       </form>
                                       </div>
                                        </div>
                                        <div class="col ">

                                        </div>
                                    </div>



                                </div>
                            </div></div>
                            </div> </div> </div> </div>
                            
                            
                            
 <script>
 function reset_error()
  {
   $('#operation-response').html('<div class="alert alert-primary text-center">Processing...</div>');
   $('.error_msg_reset').text('');
  }
  
 function updateNokBio(){
     $.ajax({
        url: "authController/updatebio_process.php",
        type: "POST",
        beforeSend:function(){
        	reset_error();
      },
        data: $("#my-nokbio-form").serialize(),
        dataType: "json",
        success: function (data) {
                if(data.saved){
                     $('#operation-response').html('<div class="alert alert-success text-center">'+data.notice+'</div>');
                     $(window).scrollTop(0);
                    if(data.protocol != ''){
                    location.href = data.protocol;   
                    }
                }
                if(data.error) {
                    $('#operation-response').html('<div class="alert alert-danger text-center">'+data.notice+'</div>');
                 } 
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
    });
	} 
	
$(document).ready(function() {
  
updateUserBio();
function updateUserBio(){
    $('#my-bio-form').on('submit', function(e){
       e.preventDefault();
       $.ajax({
        url: "authController/updatebio_process.php",
        method: "POST",
        data: new FormData(this),
        dataType: "json",
        contentType:false,
        processData:false,
        beforeSend:function(){
        	reset_error();
        	$("#myBioSaveBtn").prop("disabled", true).html('<span id="btn_swap">Saving...<span class="spinner-grow m-2 text-light" role="status" style="height: 13px;width: 13px;"></span></span>');
       },
        success: function (data) {
            $(window).scrollTop(0);
            $("#myBioSaveBtn").prop("disabled", false).html('<span id="btn_swap">UPDATE BIO</span>');
                if(data.saved){
                     $('#operation-response').html('<div class="alert alert-success text-center">'+data.notice+'</div>');
                    //location.href = data.protocol;   
                }
                if(data.error) {
                    $('#operation-response').html('<div class="alert alert-danger text-center">'+data.notice+'</div>');
		if(data.error_first_name != '')
          {
            $('#error_first_name').text(data.error_first_name);
          } 
			else {
            $('#error_first_name').text('');
          }
          
          if(data.error_last_name != '')
          {
            $('#error_last_name').text(data.error_last_name);
          } 
			else {
            $('#error_last_name').text('');
          }
         
         if(data.error_user_image != '')
          {
            $('#error_user_image').text(data.error_user_image);
          } 
			else {
            $('#error_user_image').text('');
          }
          
          if(data.error_user_email != '')
          {
            $('#error_user_email').text(data.error_user_email);
          } 
			else {
            $('#error_user_email').text('');
          }           
           if(data.error_user_address != '')
          {
            $('#error_user_address').text(data.error_user_address);
          } 
			else {
            $('#error_user_address').text('');
          }
          
          if(data.error_user_phone != '')
          {
            $('#error_user_phone').text(data.error_user_phone);
          } 
			else {
            $('#error_user_phone').text('');
          }         
          if(data.error_user_gender != '')
          {
            $('#error_user_gender').text(data.error_user_gender);
          } 
			else {
            $('#error_user_gender').text('');
          }
          
          if(data.error_user_state != '')
          {
            $('#error_user_state').text(data.error_user_state);
          } 
			else {
            $('#error_user_state').text('');
          }
         if(data.error_user_country != '')
          {
            $('#error_user_country').text(data.error_user_country);
          } 
			else {
            $('#error_user_country').text('');
          }     
           if(data.error_employee_number != '')
          {
            $('#error_employee_number').text(data.error_employee_number);
          } 
			else {
            $('#error_employee_number').text('');
          }
          
          if(data.error_agency_bureau != '')
          {
            $('#error_agency_bureau').text(data.error_agency_bureau);
          } 
			else {
            $('#error_agency_bureau').text('');
          }
          
           if(data.error_employee_class != '')
          {
            $('#error_employee_class').text(data.error_employee_class);
          } 
			else {
            $('#error_employee_class').text('');
          }
          
          if(data.error_employee_post != '')
          {
            $('#error_employee_post').text(data.error_employee_post);
          } 
			else {
            $('#error_employee_post').text('');
          }
          
                 } 
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
    });
	}  
   

$(document).on('change', '#user_image', function(event){
	event.preventDefault();
//check File API supported browser
if (window.File && window.FileReader && window.FileList && window.Blob) {
//clear html of output element
$('#image_preview').html(''); 
//this file data
var data = $(this)[0].files;

//loop though each file
$.each(data, function(index, file){ 
//check supported file type
if(/(\.|\/)(jpe?g|png)$/i.test(file.type)){ 
//new filereader
var fRead = new FileReader(); 
//trigger function on successful read
fRead.onload = (function(file){ 
return function(e) {
//create image element 
var img = $('<img/>').addClass('imgThumb').attr('src', e.target.result);
//append image to output element
$('#image_preview').append(img);
$('#user_image_label').text(file.name);
	};
	})(file);
//URL representing the file's data.
fRead.readAsDataURL(file); 
	}
});
}else{
//if File API is absent
console.log("Your browser doesn't support File API! \n Switch Browser.");
}
	});
   
});
	
	
	//on file input change

	</script>
                            
                            
                            
                            
                            
 <?php include 'inc/footerb.php'; ?>                          