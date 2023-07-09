<?php 
require_once "pdo.php";
?>

<!doctype html>
<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ameemca Backend</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

    <link rel="shortcut icon" href="./favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <!-- Bamburgh HTML5 Admin Dashboard with Bootstrap Free Stylesheets -->
    <link rel="stylesheet" type="text/css" href="./assets/css/bamburgh.min.css">
<script type="text/javascript" src="./assets/js/jquery.min.js"></script>

</head>

<body>

     
           <div class="app-content" style="padding: 78px 33px;">
                <div class="app-content--inner">
                    <div class="page-title">
                        <div>
                            <h5 class="display-4 mt-1 mb-2 font-weight-bold">Update Next Of Kin</h5>
                            <div id="operation-response"> </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-body">
                                            
 <form class="was-validated mb-50" id="my-nokbio-form">
                                                 <div class="title">
                                                    <h1> Next of Kin's Details </h1>
                                                <div class="row">
                                                    
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">First name</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-first-name" name="nokfname" placeholder="First name" value="<?php echo getUserInfo("nokfname"); ?>" required="">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-last-name">Last name</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-last-name" name="noklname"placeholder="Last name" value="<?php echo getUserInfo("noklname"); ?>" required="">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">Email Address</label>
                                                        <input type="email" class="form-control is-valid" id="form-2-first-name" name="nokemail" placeholder="Email Address" value="<?php echo getUserInfo("nokemail"); ?>" required="">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-last-name">Address</label>
                                                        <input type="text" class="form-control is-valid" id="form-2-last-name" name="nokaddress" placeholder="nokAddress" value="<?php echo getUserInfo("nokaddress"); ?>" required="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="form-2-first-name">Phone Number</label>
                                                        <input type="number" class="form-control is-valid" id="form-2-first-name" name="nokphone" placeholder="Phone Number" value="<?php echo getUserInfo("nokphone"); ?>" required="">
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
<option value="ABUJA FCT" <?php if(getUserInfo("nokstate") == 'ABIA'){echo 'selected';} ?> >ABIA</option>
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
                                                        <select class="custom-select w-100" id="form-3-select" required="" name="nokgender">
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
                                               <input type="hidden" name="can-redirect" value="yes">
                                                <button class="btn radius-10 btn-primary" type="button" onclick="updateNokBio()" id="nokSaveBtn">UPDATE</button>
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
	

	</script>
                            
                            
                            
                            
                            
 <?php include 'inc/footerb.php'; ?>  