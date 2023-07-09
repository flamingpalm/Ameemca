<?php include 'inc/nav.php'; ?>
<?php include 'DB.php'; ?>
    <!-- ========================= signup-style-2 start ========================= -->
    
    <style>
 @media only screen and  (max-width: 767px){
.signup-style-2  {
     padding-top:37px
}   
    </style>
    <section class="signup signup-style-2 mb-0" style="padding-bottom: 0;">
        <div class="container">
        <!--<div class="alert alert-danger" role="alert">
  <b>Dear User,</b>
 <br> Please be informed that registration is currently disabled as we are actively carrying out system maintainence 
 to bring you the best user experience. Kindly exercise patience, we'll be done in due time.
<br>
Thank you.-->
</div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="signup-content-wrapper">
                        <div class="section-title">
                            <h3 class="mb-20">Sign Up</h3>
                            <p>Please fill in the required information accordingly as required below</p>
                        </div>
                        <div class="image">
                            <img src="assets/img/signup/signup-2/signup-img.svg" alt="" class="w-100">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="signup-form-wrapper" >
                         <form method="POST" autocomplete="" id="signup-form">
                    
                         <div class="single-input">
                              <label for="signup-package" id="signup-package">Package</label>
                        <select id="signup-package" style="width: 100%; border: 1px solid rgba(88, 89, 120, 0.5); height: 64px; line-height: 1; padding: 0 8px;  border-radius: 10px;  background: transparent; color: #585978" name="package">
                        <?php 
                         if(isset($_GET["package"])){
                             $getPackage = $_GET["package"];
                        } else{ 
                            $getPackage = "";
                        }
                        ?>
                        <option value="" selected disabled>Select Package</option>
                        <option value="1" <?php if($getPackage == "1"){ echo "selected";} ?>>Diamond Package (N<?php echo number_format(getPackagePriceByID(1)); ?>)</option>
                         <!--<option value="2" <?php if($getPackage == "2"){ echo "selected";} ?>>Elite Package (N<?php echo number_format(getPackagePriceByID(2));?>)</option>-->
                        <option value="3" <?php if($getPackage == "3"){ echo "selected";} ?>>Platinum Package (N<?php echo number_format(getPackagePriceByID(3)); ?>)</option>
                        </select>
                        <div id="error_package" style="color: red"> </div>
                        <input type="hidden" value="" id="amt" name="rfee">
                        </div>

                            <div class="single-input">
                                <label for="signup-fname">First Name</label>
                                <input type="text" id="signup-fname" name="first_name" placeholder="First Name" required>
                                <div id="error_firstname" style="color: red"> </div>
                            </div>
                            <div class="single-input">
                                <label for="signup-lname">Last Name</label>
                                <input type="text" id="signup-lname" name="last_name" placeholder="Last Name" required>
                                	<div id="error_lastname" style="color: red"> </div>
                            </div>
                            <div class="single-input">
                                <label for="signup-email">Email  Address </label>
                                <input type="email" id="signup-email" name="user_email" placeholder="Your E-mail address" required>
                                <div id="error_email" style="color: red"> </div>
                            </div>
                            
                            
                             <div class="single-input">
                                <label for="signup-email">Employee ID </label>
                                <input type="email" id="signup-email" name="employee_number" placeholder="Your Employee Number" required>
                                <div id="error_employee_number" style="color: red"></div>
                            </div>
                            
                            <div class="single-input">
                                <label for="signup-email">Agency/Bureau </label>
                                <input type="email" id="signup-email" name="agency_bureau" placeholder="Your Agency/Bureau" required>
                                <div id="error_agency_bureau" style="color: red"></div>
                            </div>
                            
                            <div class="single-input">
                                <label for="signup-email">Employee Post </label>
                               
                                <select id="signup-package" style="width: 100%; border: 1px solid rgba(88, 89, 120, 0.5); height: 64px; line-height: 1; padding: 0 8px;  border-radius: 10px;  background: transparent; color: #585978" name="employee_post">
                        <option value="" selected disabled>Your Employee Post</option>
                        <option value="2">56002-Nigeria-Abuja</option>
                         <option value="1">56002-Nigeria-Lagos</option>
                        </select>
                                <div id="error_employee_post" style="color: red"></div>
                            </div>
                            
                            <style>
                              .signup-style-2 .signup-form-wrapper .single-input textarea{width:100%;border:1px solid rgba(88,89,120,.5);height:64px;line-height:1;padding:11px 30px 0 30px;border-radius:10px;background:0 0;color:#585978}
                         </style>
                            <div class="single-input">
                                <label for="signup-email">Home Address </label>
                                <textarea type="text" id="signup-email" name="home_address" placeholder="Your Home Address" required></textarea>
                                <div id="error_home_address" style="color: red"></div>
                            </div>
                            
                            <div class="single-input">
                                <label for="signup-password">Password</label>
                                <input type="password" id="signup-password" name="password" placeholder="Choose password">
                                <div id="error_password" style="color: red"> </div>
                            </div>
                            <div class="single-input">
                                <label for="signup-cpassword">Confirm Password</label>
                                <input type="password" id="signup-cpassword" name="confirm_password" placeholder="Confirm password">
                                	<div id="error_confirm_password" style="color: red"> </div>
                            </div>
                            <div class="signup-button mb-25">
                                <div class="mb-4">   
                                <input type="checkbox" id="ctaggery">
                              
                                <label for="ctaggery">I Accept the <span data-toggle="modal" data-target="#exampleModal" style="color: #F54768;font-weight: 500;">Terms and Conditions</span></label>
                                </div>
                                
                                
                            	<input type="hidden" name="action" id="swapAction">
                            	<input type="hidden" value="registration" id="transaction-type">
                            	<input type="hidden" id="transaction-token">
                                <button id="regBtn" class="button button-lg radius-10 btn-block btn" type="button" onclick="processRegistrationPayment()" disabled>Register Now</button>
                            </div>
                            <p>Already have an account? <a href="login-user.php">Log In</a> </p>
    
  <script>
    /*!
 * jQuery Password Strength Indicator Plugin v0.1.0
 *
 * https://www.humankode.com
 *
 * Copyright (c) 2016 Carlo van Wyk
 * Released under the MIT license
 */

(function ($) {
    $.fn.passwordStrength = function (options) {

        var defaults = $.extend({
            minimumChars: 8
        }, options);

        var parentContainer = this.parent();
        var progressHtml = "<div class='progress' style='margin-top:5px; height:.5rem'><div id='password-progress' class='progress-bar' role='progressbar' aria-valuenow='1' aria-valuemin='0' aria-valuemax='100' style='width:1%;'></div></div><div id='password-score' class='password-score'></div><div id='password-recommendation' class='password-recommendation'></div><input type='hidden' id='password-strength-score' value='0'>";
        $(progressHtml).insertAfter('input[type=password]:first');
        $('#password-score').text(defaults.defaultMessage);
        $('.progress').hide();
        $('#password-score').hide();

        $(this).keyup(function (event) {
            $('.progress').show();
            $('#password-score').show();

            var element = $(event.target);
            var password = element.val();

            if (password.length == 0) {
                $('#password-score').html('');
                $('#password-recommendation').html('');

                $('.progress').hide();
                $('#password-score').hide();
                $('#password-strength-score').val(0);
            }
            else {
                var score = calculatePasswordScore(password, defaults);
                $('#password-strength-score').val(score);
                $('.progress-bar').css('width', score + '%').attr('aria-valuenow', score);

                $('#password-recommendation').css('margin-top', '10px');

                if (score < 50) {
                    $('#password-score').html('Weak password <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>');
                    $('#password-recommendation').html('<ul><li>Use at least 8 characters</li><li>Use upper and lower case characters</li><li>Use 1 or more numbers</li><li>Optionally use special characters</li></ul>');
                    $('#password-progress').removeClass();
                    $('#password-progress').addClass('progress-bar progress-bar-danger');
                }
                else if (score <= 60) {
                    $('#password-score').html('Normal password <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
                    $('#password-recommendation').html('<div id="password-recommendation-heading">For a stronger password :</div><ul><li>Use upper and lower case characters</li><li>Use 1 or more numbers</li><li>Use special characters for an even stronger password</li></ul>');
                    $('#password-recommendation-heading').css('text-align', 'center');
                    $('#password-progress').removeClass();
                    $('#password-progress').addClass('progress-bar progress-bar-warning');
                }
                else if (score <= 80) {

                    $('#password-score').html('Strong password <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
                    $('#password-recommendation').html('<div id="password-recommendation-heading">For an even stronger password :</div><ul><li>Increase the lenghth of your password to 15-30 characters</li><li>Use 2 or more numbers</li><li>Use 2 or more special characters</li></ul>');
                    $('#password-recommendation-heading').css('text-align', 'center');
                    $('#password-progress').removeClass();
                    $('#password-progress').addClass('progress-bar progress-bar-info');
                }
                else {
                    $('#password-score').html('Very strong password <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
                    $('#password-recommendation').html('');
                    $('#password-progress').removeClass();
                    $('#password-progress').addClass('progress-bar progress-bar-success');
                }
            }
            
        });
    };

    function calculatePasswordScore(password, options) {

        var score = 0;
        var hasNumericChars = false;
        var hasSpecialChars = false;
        var hasMixedCase = false;

        if (password.length < 1)
            return score;

        if (password.length < options.minimumChars)
            return score;

        //match numbers
        if (/\d+/.test(password)) {
            hasNumericChars = true;
            score += 20;

            var count = (password.match(/\d+?/g)).length;
            if (count > 1) {
                //apply extra score if more than 1 numeric character
                score += 10;
            }
        }

        //match special characters including spaces
        if (/[\W]+/.test(password)) {
            hasSpecialChars = true;
            score += 20;

            var count = (password.match(/[\W]+?/g)).length;
            if (count > 1) {
                //apply extra score if more than 1 special character
                score += 10;
            }
        }

        //mixed case
        if ((/[a-z]/.test(password)) && (/[A-Z]/.test(password))) {
            hasMixedCase = true;
            score += 20;
        }

        if (password.length >= options.minimumChars && password.length < 12) {
            score += 10;
        } else if (!hasMixedCase && password.length >= 12) {
            score += 10;
        }

        if ((password.length >= 12 && password.length <= 15) && (hasMixedCase && (hasSpecialChars || hasNumericChars))) {
            score += 20;
        }
        else if (password.length >= 12 && password.length <= 15) {
            score += 10;
        }

        if ((password.length > 15 && password.length <= 20) && (hasMixedCase && (hasSpecialChars || hasNumericChars))) {
            score += 30;
        }
        else if (password.length > 15 && password.length <= 20) {
            score += 10;
        }
            
        if ((password.length > 20) && (hasMixedCase && (hasSpecialChars || hasNumericChars))) {
            score += 40;
        }
        else if (password.length > 20) {
            score += 20;
        }

        if (score > 100)
            score = 100;

        return score;
    }
}(jQuery));
    
</script>      
<script>
$('#signup-password').passwordStrength();
</script>                    

</form>
<script>
 $("#ctaggery").click(function() {
    var checked_status = this.checked;
    if (checked_status == true) {
       $("#regBtn").removeAttr("disabled");
    } else {
       $("#regBtn").attr("disabled", "disabled");
    }
});   
    
    
</script>
          
 <script src="https://js.paystack.co/v1/inline.js"></script> 
<script>
function reset_error()
  {
    $('#error_package').text('');
    $('#error_firstname').text('');
    $('#error_lastname').text('');
    $('#error_email').text('');
    $('#error_password').text('');
    $('#error_confirm_password').text('');
  }
    

function processRegistrationPayment(){
    $('#swapAction').val('getpackageprice');
     $.ajax({
        url: "authController/signup_process.php",
        type: "POST",
        beforeSend:function(){ reset_error();},
        data: $("#signup-form").serialize(),
        dataType: "json",
         success: function (data) {
                if(data.approved){
                    $('#amt').val(data.amount);
                    payWithPaystack();
                }
                if(data.error) {
			if(data.error_package != '')
          {
            $('#error_package').text(data.error_package);
          } 
			else {
            $('#error_package').text('');
          }
          
          if(data.error_firstname != '')
          {
            $('#error_firstname').text(data.error_firstname);
          } 
			else {
            $('#error_firstname').text('');
          }
          
          if(data.error_lastname != '')
          {
            $('#error_lastname').text(data.error_lastname);
          } 
			else {
            $('#error_lastname').text('');
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

          
          if(data.error_employee_post != '')
          {
            $('#error_employee_post').text(data.error_employee_post);
          } 
			else {
            $('#error_employee_post').text('');
          }
          
          if(data.error_home_address != '')
          {
            $('#error_home_address').text(data.error_home_address);
          } 
			else {
            $('#error_home_address').text('');
          }
          
          if(data.error_email != '')
          {
            $('#error_email').text(data.error_email);
          } 
			else {
            $('#error_email').text('');
          }
          
          if(data.error_password != '')
          {
            $('#error_password').text(data.error_password);
          } 
			else {
            $('#error_password').text('');
          }
          
          if(data.error_confirm_password != '')
          {
            $('#error_confirm_password').text(data.error_confirm_password);
          } 
			else {
            $('#error_confirm_password').text('');
          }
 }
 
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
     });
}

function calculatePaymentFee(amount){
    return ((amount * 100)  + ((amount * 0.015)* 100));
}
function payWithPaystack() {
    var amount = calculatePaymentFee(document.getElementById("amt").value);
  let handler = PaystackPop.setup({
    key: '<?php echo $public_key_live; ?>',
    email: document.getElementById("signup-email").value,
    amount: amount,
    ref: 'SIGNUP_'+Math.floor((Math.random() * 1000000000) + 1), 
    metadata: {
        custom_fields: [
          {
            type: document.getElementById("transaction-type").value
          }
        ]
      },
    onClose: function(){
      console.log('Transaction Cancelled.');
    },
    callback: function(response){
        //alert(response.amount);
      $('#transaction-token').val(response.reference);
      userSignUp();
    }
  });
  handler.openIframe();
}
    
</script>                             
                        
                        
                        
                        
<script>

function userSignUp(){
    $('#swapAction').val('signup');
     $.ajax({
        url: "authController/signup_process.php",
        type: "POST",
        beforeSend:function(){
        	reset_error();
       },
        data: $("#signup-form").serialize(),
        dataType: "json",
        success: function (data) {
                if(data.approved){
                    location.href = data.protocol;   
                }
                if(data.failed){
                	console.log("failed");
                }
                if(data.error) {
			if(data.error_package != '')
          {
            $('#error_package').text(data.error_package);
          } 
			else {
            $('#error_package').text('');
          }
          
          if(data.error_firstname != '')
          {
            $('#error_firstname').text(data.error_firstname);
          } 
			else {
            $('#error_firstname').text('');
          }
          
          if(data.error_lastname != '')
          {
            $('#error_lastname').text(data.error_lastname);
          } 
			else {
            $('#error_lastname').text('');
          }

          
          if(data.error_email != '')
          {
            $('#error_email').text(data.error_email);
          } 
			else {
            $('#error_email').text('');
          }
          
          if(data.error_password != '')
          {
            $('#error_password').text(data.error_password);
          } 
			else {
            $('#error_password').text('');
          }
          
          if(data.error_confirm_password != '')
          {
            $('#error_confirm_password').text(data.error_confirm_password);
          } 
			else {
            $('#error_confirm_password').text('');
          }
 }
 
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	} 
	</script>
    
    
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Button trigger modal -->
<style>
    .modal-body{
    height: 250px;
    overflow-y: auto;
}

@media (min-height: 500px) {
    .modal-body { height: 370px; }
}

@media (min-height: 800px) {
    .modal-body { height: 600px; }
}
</style>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size:1.25rem">BYE-LAWS
OF THE AMERICAN EMBASSY EMPLOYEES MULTIPURPOSE COOPERATIVE SOCIETY  LIMITED, ABUJA
(AMEEMCA) </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       1. INTERPRETATIONS
1.1. "Financial Year" means the period of twelve months
beginning on 1ST April and ending on 31st March.<br>
1.2. “The Law” means the Nigerian Co-operative Society Act CAP
N98 Laws of the Federation 2004.<br>
1.3. "Byelaws" means the registered Byelaws made by the
society in exercise of any power conferred by this law and it
includes a registered amendment of the Byelaws.<br>
1.4. “Officer” or “Management Committee” includes President,
Vice President, General Secretary, Assistant General
Secretary, Financial Secretary, Treasurer, Ex-Officio
members of Committee or other persons empowered under
the regulations or bye laws to give directions with regards to
the business of this association. They are also the governing
body to whom the general management of its affairs is
entrusted.<br>
1.5. “Persons" include any company or association or body of
person corporate or incorporate.<br>
1.6. "Regulations" means regulations made under this Byelaw as
amended from time to time.<br>
1.7. "Functional Committee" means an elected body of persons
within the society to whom specific duties are delegated by
the society or the management committee.<br>
1.8. “Supervisory Committee” is a functional committee which
shall examine the affairs of the society as stipulated in
section 7.0 of this byelaw.<br>
1.9. “Members” means Platinum, Diamond and Elite members
who are admitted into the society in accordance with these
Byelaws and regulations.<br>
1.10.“Platinum Members” means members who pay 5% interest
rates annually on varying loans; can access a project loan of
200% of their net savings for a loan tenure not to exceed 60
months and are eligible for bonus/dividends and gifts
provided annually.<br>
1.11.“Diamond Members” means members who pay
administrative and processing fees at 1.5% - 2.5%; can only
access a project loan not in excess of 150% of their net
savings and the loan tenure is not to exceed twenty-four
2
months. These members are eligible for gifts annually only
and are not eligible for bonus/dividends. If these members
want to process loans other than a project loan, they will be
entitled to pay same interest as subsists with a Platinum
member.
1.12.“Elite Members” means a Platinum or Elite member who has
retired, terminated employment or was separated from the
Mission and no longer under the US Chief of Mission. These
does not include employees who were separated or
terminated due to cause such as fraud, gross misconduct or
malfeasance. These members can access a project loan not
in excess of their net savings; pay management and
processing fees at 1.0% - 2.0% for a tenure not to exceed 24
months. If these members want to process loans other than
a project loan, they will be entitled to pay same interest as
subsists with a Platinum member. These members are
eligible for gifts and dividends/bonus annually. An Elite
member will not be entitled to seek any elective office in the
society but can serve as an ad hoc member.
1.13.“Bonus/Dividend" means a share of the profit(s)/surplus of
the society divided among its Platinum and Elite members in
proportion to the volume of business done with the society
by them from which the appropriated surplus of the society
was derived.
1.14.“Society” or "AMEEMCA” means “American Embassy
Employees Multipurpose Co-operative Society Limited,
Abuja.”
1.15."General Meeting" shall mean Meeting of Members of the
society which may be Annual General Meeting, ExtraOrdinary General Meeting or Ordinary General Meeting.
1.16.“Gross misconduct” means an act considered to be
unbecoming of an officer, member, or committee of the
association. It can also mean criminal offences reported to
an officer or committee or with proven conviction in
competent court of jurisdiction.
1.17.If there shall arise any doubt regarding the meaning or
intention of these byelaws, the matter shall be referred to an
Officer or committee and brought up to the house in a
General meeting.
3
2. NAME, ADDRESS AND AREA OF OPERATION
2.1. The society shall be known as “American Embassy
Employees Multipurpose Co-operative Society, Abuja
(AMEEMCA).”
2.2. Its address shall be U.S. Embassy, Plot 1075, Diplomatic
Drive, Central Business District, Abuja, FCT.
2.3. The area of operation of the association shall be within
Nigeria.
3. OBJECTIVES OF THE SOCIETY
3.1. The principal objective of the society will be to promote the
interests of all its members to improve their social and
economic wellbeing through self-help and mutual aid in
accordance with the cooperative principles.
3.2. To provide credit facilities to its members at fair and
reasonable rates of interest for provident and productive
purposes.
3.3. To encourage the culture/habit of savings and investments
by members, through monthly savings and investments,
with a view to building up funds for individual member's use.
3.4. To encourage fixed deposit from members out of which a
fund may be established for giving short- or long-term loans
to members and other rewarding ventures.
3.5. To engage in any other economic or social activity as may be
approved by the general meeting of members.
3.6. To manage financial portfolios carefully by investing in
rewarding ventures and be guided by the decision of
members approved by the General House. In this way, the
society shall become part owners of well-established and
sustainable investments.
3.7. To support and encourage members on real estate options
for the benefit of members.
3.8. To take measures that would promote among the members,
the spirit of thrift, mutual-help, self-help, and investments.
3.9. To partner with other Corporate entities for sourcing of
funds, investments or other financial activities for the
purpose of assisting members to achieve financial objectives
for members and the society.
4
4. MEMBERSHIP AND LIABILITY
4.1. MEMBERSHIP: Membership of the Society shall be
categorized as follows:
4.1.1. Platinum Member
4.1.2. Diamond Member
4.1.3. Elite Member
4.1.4. The membership of the association shall consist of:
4.1.4.1.Any person under the U.S. Chief of Mission to Nigeria’s
Authority who applies to a membership category and is
admitted in accordance with these Byelaws.
4.1.4.2.Any member who is no longer under the authority of the
US Chief of Mission due to retirement, termination or
willful separation. These does not include employees who
were separated or terminated due to cause such as fraud,
gross misconduct or malfeasance.
4.2. QUALIFICATION: Every member of the society must:
4.2.1. Be of good character.
4.2.2. Not be less than 21 years of age.
4.2.3. Be a person of sound mind.
4.2.4. Not have been convicted of a criminal offence, dishonesty,
fraud,
misconduct or other inappropriate or unprofessional acts
reported to an officer or committee or proven by a court or
tribunal of competent jurisdiction.
4.3. ADMISSION:
4.3.1. Application for membership shall be made by obtaining a
Membership/Entrance form, which on completion shall be
submitted to the secretariat office of the society.
4.3.2. Every member shall on admission be required to sign the
membership card
and personal ledger.
4.3.3. No member shall deal directly as an individual or as a group
or business
company with any of the association’s sources of supplies.
5
4.4 RIGHT OF MEMBERS: Every member shall have the
following rights:
4.4.1. One vote per member at general meetings of the society
and no member
shall be permitted to vote by proxy.
4.4.2. To receive notice of all meetings as per byelaws of the
society.
4.4.3. To attend and take active part in the proceedings of the
meetings.
4.4.4. To take part in elections and contest for any post as per
provision of the
byelaws of this society except an Elite member as these
cannot seek any elective office in the society but can serve
as an ad hoc member.
4.4.5. Inspect member's own registers, books of accounts or
any other personal
record(s) and obtain certified copies of the resolutions or
documents for a fee as may be proposed by the
management committee and approved by the General
House.
4.4.6. Every application for membership shall be accompanied
with a nonrefundable entrance fee, which shall be not be less than
N2,000.00 and shall be determined from time to time by the
management committee and approved by the General House. The
applicant shall be required to commence payment of a
determined minimum monthly savings which shall be proposed by
the management committee and approved by the General House.
4.5 LIABILITY OF MEMBERS AND PAST MEMBERS
4.5.1Liability of members shall be limited to the share capital
subscribed by them: (i) In the case of a past member, as at
the date s/he ceased to be a member; (ii) In the case of a
deceased member, on the date of his/her death.
4.5.2Notwithstanding anything contained in sub-section (5.2),
where the association is ordered to be wound up under the
Law, the liability of past member who ceased to be a
member or of the estate of a deceased member who died
within two years immediately preceding the date of the
6
order of winding up, shall continue until the entire liquidation
proceedings are completed, but such liability shall extend
only to the debt of the association as they existed on the
date of cessation of membership or death as the case may
be.
4.5.3Subject to clause on expulsion of this byelaws, the liability of
members shall be limited to their indebtedness for shares in
the society.
4.6 NOMINEES
Every member shall nominate a person or persons through
the membership application form or the nominee/beneficiary
form to whom his/her shares or interests shall be transferred
to in the event of such member’s death or becoming
permanently insane. The member may, at any point in time,
change his/her nominee(s). The contact details of the
nominee(s) shall be entered in the Register of members and
the member shall sign all alterations. In case of death or
permanent insanity of the member, such nominees be paid
the value of his contributions and interest, less any amount
due to the association.
4.7 TERMINATION/ WITHDRAWAL OF MEMBERSHIP
Membership shall be terminated by:
4.7.1. Death
4.7.2. Permanent insanity
4.7.3. Withdrawal after 30 days’ notice conveyed in writing to
Management
Committee provided the withdrawing member is neither
indebted to the society nor surety for an unpaid debt.
4.7.4. Expulsion under byelaw 4.8
4.7.5. Separation from the U.S. Mission, Nigeria other than
retirement,
termination and willful separation.
4.8 EXPULSION
Any member may be expelled from the society on
recommendation by the
7
management committee on or a motion moved by any
member and supported by two-third majority present at
meetings properly convened on any of the following
grounds:
4.8.1. Repeated failure to make thrift savings as laid down in
Byelaw.
4.8.2. Repeated failure to make up for debts due from the
member to the Society
after three (3) months and evidence of three documented
reminders.
4.8.3. Convicted of a criminal offence, dishonesty, fraud, financial
impropriety
reported to an officer, committee, General house or proven
by a court of competent jurisdiction.
4.8.4. Gross misconduct or other inappropriate or unprofessional
acts contrary to
the stated objective of the Society or the interests of the Cooperative Movement.
4.8.5. Failure to exhaust in-house dispute resolution options
before commencing
dispute resolution through the arbitration and finally any
court process against the Society.
4.8.6. On being adjudged bankrupt under the law.
4.8.7. Making false declaration or fraudulent misrepresentation to
the Society
or committing an act that is likely to bring the Society into
disrepute.
4.8.8. Expulsion is without prejudice to the rights of the Society to
seek redress in
respect of any wrong done to it by the expelled person in
accordance with the cooperative laws of the Federation
expulsion shall not discharge any person from accrued
liability to the Society.
4.8.9. An expelled member may appeal his/her expulsion first to
the Supervisory
Committee; and if unsatisfied, at the next General Meeting
of the association and then to a committee constituted by
the General House. Where such an appeal is successful, the
appellant shall be reinstated with effect from the date of
8
his/her expulsion as though such a member was never
expelled.
4.9. DUES TO MEMBERS
Prior to payment of money due to a member or past
member,
management must recover debts owed by such member or
past member.
4.10.MEMBERS REGISTER
Every member, on admission and on payment of the
appropriate entrance
fees shall sign or thumbprint the membership and
attendance register as an evidence of membership. By this,
s/he acquires the right of full participation in the affairs of
the society and assumes all obligations relating thereto.
5.0 GENERAL MEETINGS
5.1 AUTHORITY
The ultimate authority under the law in all the affairs of this
Society shall be the General body of members who shall
from time to time meet as directed by the Management
Committee, to review and direct the affairs of the Society.
5.2 QUORUM
The presence of at least 60% of the members shall be
necessary for the
disposal of any business at the general meeting. If no
quorum is formed at a meeting, an adjournment may be
made for a period not less than 7 days or more than 15 days.
Thereafter, the number of members present at any such
adjournment shall form a quorum.
5.3 TYPES OF MEETING
There shall be three types of meeting of the Association as
follows:
5.3.1. THE ANNUAL GENERAL MEETING (AGM)
9
The Annual General Meeting shall be held within the first and
second
quarters of the succeeding year after the Annual Statements
of Accounts have been prepared and reviewed by the
Management Committee.
5.3.1.1. Notice of Meeting: The notice for Annual General
Meeting shall be issued
to every member entitled to attend, 30 days prior to the
date of meeting, stating the date, time, and venue of the
meeting. A reminder shall be circulated to members not
more than 15 days and not less than 7 days to the meeting
date.
5.3.1.2. Purpose of the Annual General Meeting: The annual
General Meeting shall discharge the following duties:
5.3.1.2a. To consider the audited financial reports of the
preceding year’s
operations of the association with the auditor’s comments
as presented by the Management Committee with
remedial actions effected on the result of the audit.
5.3.1.2b. Deal with any communication received by Management
Committee.
5.3.1.2c. Elect the Management Committee members for the
ensuing year, in the
 case of terminal year of committee members.
5.3.1.2d. Disposal of net profit.
5.3.1.2e. Create specific reserves and other funds.
5.3.1.2f. Approve annual budget.
5.3.1.2g. Review actual utilization of reserve and other funds.
5.3.1.2h. Approve long-term strategic plan and annual operational
plan.
5.3.1.2i. Consider, and if found, pass resolution(s) presented at
the Annual
 General Meeting in accordance with the byelaws.
5.3.1.2j. Any other duty(ies) that may be properly carried out at
the Annual
 General Meeting.
5.3.1.2k. To adopt any amendments to this Byelaw.
10
5.3.2. THE ORDINARY GENERAL MEETING (OGM)
There shall be an Ordinary General Meeting of members at
least once in a financial year or as may be deemed
necessary, to deal with any emerging issues from member(s)
which could not be delayed to AGM.
The notice of Ordinary General Meeting shall be issued to
every member entitled to attend 15 days prior the date of
the meeting, stating the date, time and venue and purpose
of the meeting.
5.3.2.1 PURPOSE OF THE ORDINARY GENERAL MEETING
The ordinary general meeting shall discharge the following:
5.3.2.1a. Suspend or remove from office, any Officer or Member
of the
 Committee in accordance with these Byelaws.
5.3.2.1b. Confirm the expulsion of member(s).
5.3.2.1c. Amend or repeal any existing Byelaws or enact a new
Byelaw in
 accordance with this Byelaw.
5.3.2.1d. Dispose of any other business duly brought before it.
5.3.2.1e. Elect persons to fill any vacancies arising in the
management
 committee.
5.3.2.1f. Consider, amend and approve any lending, investment
and operational
policies and procedures developed by the management
committee under these byelaws
5.3.2.1g. Decide upon the association's strategic plans and
investments.
5.3.2.1h. Deal with complaints by members.
5.3.3. THE EXTRA-ORDINARY GENERAL MEETING (EGM)
The EGM shall be convened to discuss/address emergency
issues that are
pertinent to the smooth operations of the cooperative. Extraordinary General meeting of the society can be convened at
any time by the Management Committee, at the request of
25% of members of the society.
11
5.3.3.1. Failure of the Management Committee to convene an
Annual General
meeting within the second quarter of the succeeding year,
the supervisory committee shall compel the Management
Committee, through writing, to convene an EGM to address
the issues leading to such failures.
5.3.3.2. In the event the Management Committee fails to convene
an EGM as
 required in the section above, the Supervisory Committee
can, in such
 circumstance assume the power to convene an EGM.
5.3.3.3. PURPOSE OF EXTRA-ORDINARY GENERAL MEETING
The notice of Extra-ordinary General meeting shall be
issued to every member entitled to attend 21 days prior to
the date of the meeting, stating the date, time and venue
of the meeting and express purpose for which the meeting
has been called, issue(s) to be discussed and containing
the draft of the resolution to be proposed for passage.
5.4. RESOLUTION OF MEMBERS
5.4.1. ORDINARY RESOLUTION
A resolution shall be an ordinary resolution when it has been
passed by simple majority of votes cast by members present
and voting at such general meeting.
5.4.2. SPECIAL RESOLUTION
A resolution shall be a special resolution when it has been
passed at a general meeting by not less than 75% of votes
cast by members present, provided that 15 days’ notice of
the special resolution was given prior to the date of the
meeting.
5.4.3. DECISION REQUIRING SPECIAL RESOLUTIONS
No decision on the following shall be taken except upon
special resolution duly passed by the society:
12
5.4.3.1. Passing a vote of no confidence on the management
Committee.
5.4.3.2. Amendment of the Byelaws.
5.4.3.3. Commitment of an amount in excess of 5% of the net
assets of the
 association on any project.
5.5. USE OF ELECTRONIC, VOICE OR VIDEO CONFERENCING
AT MEETINGS
Electronic meetings such as through Tele/Audio and
videoconferencing platforms could be used for Annual
General Meeting, Ordinary General Meetings, Extra-Ordinary
General meetings and Management Committee meetings to
allow participation of all members. Minutes of such meeting
shall be promptly produced and circulated to members for
adoption.
5.6. VOTING
Voting at general meetings shall be shown by hands or voice
vote (in case of online participation), unless a secret ballot
on any special or sensitive matter is demanded by, at least,
five members present. And in voting, each member shall
vote once only. At all meetings, if there is a tie, a second
vote shall be passed. If still a tie, then the Chairman shall
have a casting vote.
5.6.1. VOTING FOR ELECTION OF MANAGEMENT
COMMITTEE MEMBERS
For the purpose of electing members into the management
committee of the association, balloting or electronic voting
may be adopted.
5.6.2ELECTION/NOMINATION FOR ELECTION
For any member to vie to be elected for a seat on the
Management Committee, the member shall complete and
submit show-of-interest form for a position with a detailed
statement of interest. Experience will be an added
advantage. The member shall be supported by at least one
(1) other active member of the Cooperative and this support
13
shall be stated clearly in a letter to the Electoral Committee.
A member shall only show an interest in one position per
election season.
5.6.3. SUBMISSION OF SHOW-OF-INTEREST FORM
The completed show-of-Interest form with a detailed
statement of interest shall be submitted to the Electoral
Committee within the time frame provided by the Committee
or General House and in accordance with its published
electoral guidelines as contained in this Byelaw.
6.0. THE MANAGEMENT COMMITTEE
6.1. COMPOSITION /POWER OF MANAGEMENT COMMITTEE
The society shall have a management committee consisting
of a minimum of seven (7) members and not to exceed nine
(9) members who shall be duly elected by members of the
association in accordance with this Bye laws.
6.1.1. QUALIFICATION
To be a management Committee member, the person must:
6.1.1.1. Be of sound mind.
6.1.1.2. Have been a member of the association for at least ten
(10) years for the
positions of president and vice president; eight (8) years for
the positions of a general secretary, treasurer, and financial
secretary; and five (5) years for other positions. All
aspirants should have substantial savings of at least N5
million (Five Million Naira Only).
If the age of the association is less than the above
stipulated years, the management committee shall
determine and approved by the General house, both year
of membership and least savings balance requirements for
all positions.
6.1.1.3. For the positions of a TREASURER and FINANCIAL
SECRETARY, the persons
must have a minimum of a bachelor’s degree or its
equivalent with accounting knowledge, experience and
skills. For the office of the President, Vice President and
General Secretary, the persons should have a minimum of
14
a bachelor’s degree or its equivalent in any field of study
with good working knowledge of cooperative activities, as
well as possess the skill and experience required for
persons seeking to perform the functions of these
respectable offices. There shall also be vote of confidence
from the general house.
6.1.2. Subject to the Law, the Regulations and these Byelaws,
the administration
of this association shall be vested in the Management
Committee. It shall also have the power to create subcommittees/functional committees to which it may delegate
parts of its functions provided that a member of the
management committee shall head such functional
committees. The management committee members shall be
represented by a group of sections or agencies across the
Mission.
6.1.3. It shall consist of active members over the age of thirty
(30) years and shall
be elected at the General Meeting or the Annual General
Meeting.
6.1.4. The Management Committee shall consist of a minimum of
seven (7)
members including the President, Vice President, General
Secretary, Assistant General Secretary, Financial Secretary,
Treasurer, any two Ex- official members and one ad-hoc
member, who shall be any of the immediate past trustees of
the society. Where such members decline, are ineligible or
are rejected by the members of the society, the position(s)
shall be open to any qualified member of the society.
6.1.5. The management committee shall have the power to
lay down
administrative rules and procedures for the smooth running
of the society provided such rules and procedures do not
violate or contravene the spirit and letters of the law,
regulations and these byelaws. Such administrative rules
should be referred to the General House for approval.
6.1.6. The Management Committee shall have the power to
appoint new
15
Management Committee members to fill any casual vacancy
arising out of death, resignation, retirement or removal of a
member of the committee.
6.1.7. Where the Management committee fills a casual
vacancy, the person may be approved by the members at
the next General Meeting of society or at the next annual
general meeting and if not so approved, he shall forthwith
cease to be a Management Committee member.
6.1.8. The members at Annual General Meeting shall have the
power to increase
or reduce the number of Management Committee members
generally and may determine in what rotation the
management committee members shall retire provided that
such reduction shall not bring the number below seven (7).
6.1.9. TENURE
The tenure of office of a member elected to the Management
Committee shall be for a period of two (2) years after which
the member shall be required to retire with an option to be
nominated for re-election for a second term of two (2) years.
No member shall be eligible to hold office for more than two
(2) terms or a total period of four (4) years. NO Management
Committee Member shall occupy a management committee
position for more than two terms or a total of four (4) years.
6.2. REMOVAL OF MANAGEMENT COMMITTEE MEMBERS
6.2.1. The association may by a Special Resolution passed at
the Annual General Meeting remove Management
Committee member(s) before the expiration of their tenure
of office.
6.2.2. Where notice is given of an intended resolution to
remove a member of the
Management Committee under this section and such
member(s) makes written representations to the association
requesting notification of the said intended resolution of
removal to members of the society, the society shall send a
copy of the representations to every member of the society
to whom notice of the meeting is ordinarily given.
16
6.2.3. Where such representations are unable to be sent out
as required in this Section as a result of it being received too
late or due to the associations default, the aggrieved
Management Committee Member may (without prejudice to
his right to be heard orally) require that the representations
be read out at the meeting. The foregoing provisions need
not be compiled with if it is found and proven that the rights
conferred by the section are being or about to be abused.
Upon proof of such abuse, these would be considered by the
General house and the decision reached shall be adhered to
by the Management Committee member(s).
6.2.4. A vacancy created by the removal of a member of the
Management Committee under this section shall be filled at
the meeting at which s/he is removed or subsequently as a
casual vacancy.
6.3. PROCEEDING OF THE MANAGEMENT COMMITTEE
6.3.1. The Management Committee members may meet for
the dispatch of business and generally regulate their
meeting as they deem fit.
6.3.2. Any question arising at any meeting shall be decided by
a majority of votes, and in the event of a tie, there shall be a
second votes and if there is still a tie, the President shall
have a casting vote.
6.3.3. A member of the Management Committee may, at any
time, summon a meeting of the committee so long as such
request is supported by a majority of members of the
committee.
6.3.4. A resolution in writing, signed by all the members of the
committee shall be as valid and effectual as if it had been
passed at a meeting of the Management Committee duly
convened and held.
6.3.5. Each member of the committee shall be entitled to a
vote each at the Management Committee meetings.
6.3.6. The quorum necessary for the transaction of the
business of the Management Committee shall be 60% of the
committee member. In the absence of the president of the
management committee, the Vice president of the society
shall chair the meeting, and if both are absent, any member
17
of the management committee presents at a particular
meeting, provided a quorum has been formed may be
elected to act as Pro-Tem President for the meeting only.
Subject to the provision of these Byelaws, every act of the
Pro-Tem President shall be deemed to be valid and binding
on the substantive President.
6.3.7. Where the Management Committee is unable to act
because a quorum cannot be formed, the General Meeting
may act in place of the Committee.
6.4. HONORARIUM AND OTHER PAYMENTS
6.4.1. The honorarium of the Management Committee
members shall be performance based and shall from time to
time be determined by the general house at its general
meeting and such honorarium shall not be more than 3% of
the net surplus (before charging the honorarium, but after
charging interest on members' savings) of the society for
any particular financial year. The amount will be shared by
all the Management Committee members in proportions to
be agreed within them.
6.4.2. The Management Committee members may also be
paid transport, hotel and other expenses, at a cost to be
agreed upon by the committee, properly incurred by them in
attending and returning from meetings of the Management
Committee or any Functional Committee of the Management
Committee or the general meeting of the society or in
connection with the business of the Society or attending any
course or training.
6.4.3. The honorarium payment to Management Committee
members shall be part of the appropriation from its surplus.
6.4.4. The Management Committee shall have the power to
authorize reasonable honorarium for any
member/committees of the Society who carried out any
special assignment on behalf of the Society. These honoraria
would however be subject to ratification and / or amendment
by the General Meeting.
6.5. DUTIES OF MANAGEMENT COMMITTEE
18
6.5.1. FIDUCIARY DUTY: The members of the management
committee Members of the society stand in a fiduciary
relationship towards the society and shall observe in the
utmost good faith toward the society in any transaction with
it or its behalf.
6.5.2. DUTY OF CARE AND SKILL: The management
committee member shall act at all times in the best interest
of the society as a whole so as to preserve its assets, further
its business, and promote the purpose for which it was
formed. The committee shall exercise the powers and
discharge the duties of his office reasonably, honestly, in
good faith to that degree of care, diligence and skill which a
reasonable prudent management committee would exercise
in comparable circumstance.
6.5.3. Failure to take reasonable care in accordance with the
provisions of section 6.5.2 of these byelaws shall be ground
for removal of such Management Committee member(s)
from office.
6.5.4. Management Committee members shall be individually
and collectively responsible for the actions of the
Management Committee in which s/he participated, and the
absence from the Management Committee's deliberations,
unless justified, shall not relieve a Management Committee
member of such responsibility.
6.5.5. A Management Committee member shall not misuse
his/her voting powers.
6.5.6. Management Committee members are jointly and
severally responsible for the Society’s monies and properties
in their care and as such, account for the funds over which
they exercise control and shall refund any monies
improperly paid away.
6.5.7. Any duty imposed on a Management Committee
member under this byelaw shall be enforceable against the
Management Committee member by the society.
6.5.8. Management Committee members are expected:
6.5.8.1. To admit new members in line with section 4 of this
byelaw and to keep a
 register of members correctly and up to date.
19
6.5.8.2. To prepare and lay before the general meeting an
audited Trading, profit
and loss account, audited Income & Expenditure account,
audited balance sheets and the budgets
6.5.8.3. To consider the audit and inspections reports of the
auditor.
6.5.8.4. To ensure safe custody of the association's property.
6.5.8.5 To pay all such expenses, including traveling expenses, as
are properly
incurred by any committee member or person(s) coopted
to the committee or sub-committee in the execution of
his/her duties. These expenses must be approved in
writing and signed by a minimum of five (5) of the
Management Committee members Including the Trustees.
6.5.8.6. To ensure the maintenance of true and accurate
accounts of all monies
received and expended and all the assets and liabilities of
the society.
6.5.9. A Management Committee member shall exercise
his/her powers as specified in these byelaws and such
exercise shall not constitute a breach of duty, if it affects a
member or paid employees of the society adversely.
6.5.10. A Management Committee member shall not delegate the
power vested
upon him/her under any provisions of these byelaws in such
a way and manner as to constitute an abdication of
duty.
6.5.11. No provision, whether contained in these byelaws or in
any contract, shall
relieve any Management Committee member from the duty
to act in accordance with this section or relieve him from
any liability incurred as a result of any breach of the duties
conferred upon him under this section.
6.5.12. Members of the management committee shall, conduct
the affairs of the
 association in line with the law, regulations and these
byelaws.
20
6.5.13. The Management Committee shall examine the account,
sanction the
 contingent expenditure and ensure the maintenance of the
prescribed
 registers.
6.5.14. The Management Committee shall consider the inspection
report of the
 Government co-operative staff and take corrective actions.
6.5.15. The Management Committee shall summon general
meetings.
6.5.16. The Management Committee shall assist in the
inspections of the books
 by any person authorized to do so.
6.5.17. Engagement of paid officers: - The Management
Committee may engage
 the services of paid officers to assist it carry out its duties.
6.5.18. The management Committee shall be in sole charge of
legal proceedings
by or against the society or Committee or its officers or
employees in all matters concerning the affairs of the
association.
6.6. CONFLICTS OF DUTIES AND INTERESTS
6.6.1. A Management Committee member shall not allow his
personal interests
conflicts with official duties as a committee member under
these byelaws.
6.6.2. A Management Committee member shall not, either in
the course of the
management of the affairs of the society or in the utilization
of the society’s resources/properties, make any secret profit
or other unexplained benefits.
6.6.3A Management Committee member shall be accountable to
the society for
any secret or unexplained benefit derived contrary to the
provision of subsection 6.6.2 above.
6.6.4. Any Management Committee member or an officer
having resigned from
21
the society shall be accountable and can be lawfully
restrained from misusing corporate information about the
society, which he was privy to by virtue of his previous
position.
6.6.5. Where, prior to the transaction and profits are made, a
Management
Committee member discloses his/her interest to the General
Meeting, s/he may escape liability; but he shall not escape
liability if s/he discloses only after the profits are made. In
this case, s/he shall account for the profits.
6.7 LEGAL POSITION OF MANAGEMENT COMMITTEE
MEMBERS
Management Committee members are jointly and severally
responsible for the Society’s monies and investments in their
care and must account for the monies/investments over
which they exercise control and shall refund any
monies/investments improperly paid away; and shall
exercise their powers honestly in the interest of the Society
as a whole and not in their own or sectional interests.
6.7.1TRUSTEES
The President, General Secretary, Treasurer and Financial
Secretary shall be
the Trustees of the society. It shall be their duty to sign on
behalf of the society all cheques and legal documents
including those concerned with the transfer of funds. They
shall act in accordance with their specified duties as outlined
in this byelaw. All actions will be guided by Management
Committee resolutions.
6.7.1.1. At any General Election of the association, and at all
times, the
position/members of the Trustees shall be represented by a
group of sections or agencies across the Mission, to ensure
fair and equal participation, and balance of powers among
the Trustees.
6.8. DUTIES OF OFFICERS OF THE SOCIETY
22
Unless otherwise stated or directed by the General Meeting,
the following officers of the Society shall have the following
duties assigned to their offices:
6.8.1. PRESIDENT
6.8.1.1. S/he shall preside at all meetings and committee
Meetings of the society.
6.8.1.2 S/he shall have powers to convene meetings.
6.8.1.3. S/he shall ensure the proper management of society’s
activities
6.8.1.4. S/he shall have a casting vote in case of a tie-vote
6.8.1.5. S/he shall chair the meetings of the credit committee
6.8.2. VICE PRESIDENT
6.8.2.1. Shall in the absence of the President, chair the meetings
of the society.
6.8.2.2. In the absence of the President and Vice President, a
member of the
 Management Committee shall be elected chairman of the
meeting.
6.8.2.3. Shall provide support to the President in all meetings,
activities and
 operations of the committees and cooperative.
6.8.2.4. Shall perform other functions as directed by the President
and/or
 management committee.
6.8.3. TREASURER
6.8.3.1. Shall keep the records of income and expenditure of the
society
6.8.3.2. Shall keep the records of payment on loans and
membership forms
 accruing to the society.
6.8.3.3. Shall be a member of the credit committee.
6.8.3.4. Shall perform other functions as directed by the
Management
 Committee.
6.8.3.5. Shall prepare and submit to the management committee
the annual
23
accounts and statement and certify copies of entries in the
books in accordance with the law.
6.8.4. GENERAL SECRETARY
6.8.4.1. Shall keep and maintain correctly and up to date the
prescribed books
 and register.
6.8.4.2. Shall procure from borrowers the due execution of bonds
with security.
6.8.4.3. Shall be the head of the Secretariat of the society.
6.8.4.4. Shall prepare all receipts, vouchers and documents
required by the
 regulations or byelaws or called for the management
committee.
6.8.4.5. S/he shall sign on behalf of the association and conduct
all its
 correspondences as directed by the Management
Committee.
6.8.4.6. Shall be a member of the credit committee.
6.8.4.7. Shall summon and attend all General and Management
Committee
meetings and prepare the Secretary’s report for the Annual
General Meeting.
6.8.4.8. Shall perform other functions as directed by the
Management
 Committee.
6.8.5. ASSISTANT GENERAL SECRETARY
6.8.5.1. Shall in the absence of the General Secretary perform the
functions of the
 General Secretary.
6.8.5.2. Shall attend and assist in recording all the proceedings of
the meetings of
 the Management Committee.
6.8.5.3. Shall support the general Secretary in the preparation of
the Secretary’s
 report to the general meetings.
24
6.8.5.4. Shall support the General Secretary in the running of the
Society’s
 secretariat.
6.8.5.5. Shall perform other functions as directed by the General
Secretary and
 the Management Committee.
6.8.6. FINANCIAL SECRETARY
6.8.6.1. Shall support the Treasurer in keeping records of income
and expenditure
 of the society.
6.8.6.2. Shall support the Treasurer in keeping records of
payments on loans and
 membership forms accruing to the society.
6.8.6.3. Shall be a member of the credit committee.
6.8.6.4. Shall perform other duties as directed by the
Management Committee.
6.8.7. THE SECRETARIAT
6.8.7.1. The association shall have a secretariat where its
activities shall be
 Coordinated.
6.8.7.2. As may be determined by the Management Committee
and approved by
the General House, a branch of the secretariat may be
opened in an environment with more than 35% of its
members for ease of doing business.
6.8.7.3. The secretariat shall be supervised by the General
Secretary and other
 Management Committee members.
6.8.7.4. The secretariat shall employ officers who will work in the
secretariat on
 the day-to-day running of the activities of the association.
6.8.7.5. Appropriate entry point conditions of service for any
employed staff shall
be determined by the Management Committee from time
to time and approved by the General House.
6.8.7.6. Every year, performance rating will be carried out on
staff. A staff with
25
exceptional performance for a 3-year period, shall be
entitled for a wage increase at a percentage to be decided
by the Management Committee and approved by the
General house.
6.8.7.7. Staff shall be entitled to remuneration, allowances and
incentives as
agreed to by the Management Committee and approved by
the General House.
6.8.7.8. Staff shall be considered for confirmation as a full staff
after one year of
 exceptional service.
6.8.7.9. The management committee shall put in place
comprehensive staff policy
to spell out in clear and unambiguous terms, the
understated codes such as:
6.8.7.9.1. Procedure of employment
6.8.7.9.2. Staff strength
6.8.7.9.3. Entitlement like: (i)Remuneration (ii) Annual Leave: (i)
Maternity Leave
 (ii) Sick leave (iv) Direct Loan and repayment terms.
6.8.7.9.4. Order of hierarchy of line staff
6.8.7.9.5. Reporting lines of authority
6.8.7.9.6. Disciplinary measures for erring staff
6.8.7.9.7. Procedure for disengagement of staff
6.8.7.9.8. Business Culture
6.8.7.9.9. Other policies such as customer service policy,
harassment policy,
punctuality policy, training policy, use of association
property policy, cyber security policy, procurement policy,
staff appraisal/evaluation policy, travel/visitor policy etc.
6.8.7.10 The management committee shall put in place society’s
vision,
mission, core-values, branding for the association, SOPs,
staff handbook and official forms.
6.9. BONDING OF OFFICERS AND EMPLOYEES
Every officer or employee of the association who receives or
pays out money on behalf of the society shall before
assuming his duties furnish a bond with sureties and in an
26
amount to be determined by the Management Committee. In
addition, the association may also take Fidelity Insurance for
its paid employees who handle cash or stocks on behalf of
the society.
6.10.REMOVAL OF MEMBERS TO THE MANAGEMENT
COMMITTEE
A member to the management committee shall be removed
based on any or combination of the following:
6.10.1. Ceases to be a member of the society/embassy.
6.10.2. Becomes of unsound mind.
6.10.3. Becomes a paid servant of the society.
6.10.4. Is convicted of any criminal offence, and
6.10.5. Acts in a manner prejudicial to the interest of the society
and s/he is
removed by a majority vote of 75% of its members present
and voting at a special general meeting. The association
may fill any vacancy arising from death, resignation and
any incapacity or any removal or if officially declared
bankrupt.
6.10.6. Supervisory Committee can recommend removal of a
Management
Committee member based on proven misconduct. This shall
be approved by the General House.
6.10.7. PUNITIVE MEASURES
6.10.7.1. An ad hoc Disciplinary Committee shall be set up by the
General
 Meeting, on the recommendation of the Management
Committee,
 Supervisory Committee, or by a motion of the General
Meeting; to
 review/investigate cases of gross misconduct, fraud,
embezzlement, or
 abuse of office by any member of the Management
Committee and
 recommend appropriate disciplinary actions as
necessary.
27
6.10.7.2. Such disciplinary actions shall include but not limited to
official
reprimand, with-holding of honorarium, removal from
office, expulsion from the association, baring from holding
office in the future, freezing of accounts and suspension
from office during investigations, and reporting to the U.S.
Mission through the Management office, for
disengagement from service and/or institution of legal
action, depending on the gravity of the offence, and the
confiscation of and sale of individual assets to recover
embezzled funds where savings are insufficient for this
purpose.
6.11 MANAGEMENT COMMITTEE MEMBERS' BUSINESS
TRANSACTION WITH THE SOCIETY:
6.11.1. The society shall not enter into an arrangement. (i)
Whereby a
committee member of the society, or a person connected
with such member, acquires or is to acquire one or more
non-cash assets of the requisite value from the Society, or
(ii.) Whereby the Society acquires or is to acquire or is to
acquire one or more noncash assets of the requisite value
from such a member or person so connected; unless the
arrangement is first approved by a resolution of the Society
and such connection expressly disclosed.
6.11.2. For the purpose of sub-section (6.11.1) of this section, a
non-cash asset is
of the requisite value if at the time the arrangement in
question is entered into, its value is not less than N100,000
or 10% of the Society’s total assets value. The total assets
value shall be based on accounts prepared and approved by
the General House in respect of the last preceding year of
the association's operations.
6.12.LIABILITIES ARISING FROM CONTRAVENTION OF
SUBSECTION 6.11
6.12.1. An arrangement entered into by the Society in
contravention of
28
Section 6.11 of this byelaw and any transaction entered into
in pursuance of the arrangement (whether by the Society or
any other person), shall be voidable at the instance of the
Society unless one or more of the conditions specified in
Subsection 6.12.1 hereunder are satisfied. The conditions
shall include the following: -
6.12.1.1. Where restitution of any of the moneys or other assets
which are the
subject-matter of the arrangement or transaction is no
longer possible or where the society has been indemnified
in pursuance of this Section by any other person for the
loss or damage suffered by it; or (recommend further
discussion to build consensus).
6.12.1.2. Any rights acquired bona fide for the value and without
actual notice of
the contravention by any person who is party to the
arrangement or transaction would be affected by its
avoidance; or
6.12.1.3. The arrangement is, within a reasonable period,
affirmed by the
 society at a General Meeting.
6.12.2. Where a member of the Management Committee or any
person
connected with him enters into an arrangement with the
Society in contravention of Section 6.11 of these byelaws,
that Management Committee member and the person so
connected, and any other Management Committee member
who authorizes the arrangement or any transaction entered
into in pursuance of such an arrangement, shall be guilty of
an offence and liable: -
6.12.2.1. To account to the Society for any gain which he has
made directly or
 indirectly by the arrangement or transaction; and
6.12.2.2. Jointly and severally with any other person liable under
this subsection,
to indemnify the Society for any loss or damage resulting
from the arrangement or transaction.
29
6.12.3. Subsection 6.12.2 shall be without prejudice to any
liability imposed
otherwise than by that Subsection and is subject to the
following two subsections; and the liability under subsection
6.12.2 arises whether or not the arrangement or transaction
entered into has been avoided in pursuance of subsection
6.12.1.
6.12.4. If an arrangement is entered into by the Society and a
person connected
with a member of the Management Committee in
contravention of Subsection 6.11 of this byelaw, that
member shall not be liable under subsection 6.12.2 if he
shows enough grounds that he took all reasonable steps to
secure the Society’s interest.
6.12.5. This section shall have effect with regard to references in
sections 6.11, of
this byelaw to a person being” connected” with a
Management committee member, and to a Management
Committee member being “associated with” or
“controlling” a Body corporate.
6.12.6. A person is connected with a Management Committee
member-if he (not
 being himself a Management Committee member) is6.12.6.1. A Management Committee member’s spouse, child,
stepchild or
 adopted child.
6.12.6.2. Except where the context otherwise requires a body
cooperate with
 which the Management Committee Member is
associated; or
6.12.6.3. A person acting as a trustee of any trust, the
beneficiaries of which
 include –
6.12.6.3.1. The Management committee Member, his spouse, any
children,
 adopted children or stepchildren; or
6.12.6.3.2. Body corporation with which s/he is associated, or of a
trust whose
30
terms confer powers on the trustees that may be
exercised for the benefit of the Management Committee
member, his spouse, any children or stepchildren of his,
or any such body corporate; or
6.12.6.3.3. A person acting as partner of that Management
Committee Member
or any person who, by virtue of paragraphs (1) (2) or (3)
of this subsection, is connected with that Management of
Committee member.
7.0. SUPERVISORY COMMITTEE
Supervisory Committee, which shall comprise of seven (7)
members shall be selected from various sections and
agencies at the Annual General Meeting.
7.1. DUTIES OF SUPEVISORY COMMITTEE
7.1.1. The Supervisory Committee Members shall meet at least
once every three
months to make or cause to be made an examination of the
affairs of the society, which shall include an audit of its
books and an inspection of the securities, cash account,
loans and stock of goods.
7.1.2. To ascertain that all actions of the Management Committee
are in
conformity with the law, regulations and these byelaws.
7.1.3. To make a written report to the Management Committee of
its findings
following each examination.
7.1.4. Make an Annual Audit and a written financial statement and
submit same
to the Annual General Meeting.
7.1.5. To verify the passbook of the members with the accounts of
the treasurer
annually.
7.1.6. The duties shall be performed consistent with the Standard
Operating
Procedures (SOP) and checklist below: ‘Management
Committee may constitute a committee to review the below
31
check-list when necessary which shall be approved by the
General House.’
7.1.6.1. Is a receipt issued for every item of cash received?
7.1.6.2. Is there a payment voucher for every amount paid out?
7.1.6.3. Is the cash on hand high above the amount stipulated by
the
 management committee?
7.1.6.4. Are any unused cheques on hand signed blank?
7.1.6.5. Is the cash book balanced regularly (Daily, Weekly or
monthly)?
7.1.6.6. Are all expenses approved by the Management
Committee and vouchers
 signed by the approving officers?
7.1.6.7. Are the members' account balance compiled monthly?
7.1.6.8. Do these balances agree with the general control
account?
7.1.6.9. How many loans are delinquent?
7.1.6.10. How many loans are overdue (i) within a month(ii) over
three months?
7.1.6.11. What actions are being taking to recover the delinquent
loans?
7.1.6.12. Any other inquiry that may be useful for the purpose of
performing its
 oversight functions.
7.1.6.13. The Supervisory Committee shall have power to
recommend the
suspension of any officer, any or all of the Management
Committee or to call a special meeting of the society to
consider any violation of the ordinance of the byelaws of
the society.
7.2. CREDIT COMMITTEE
7.2.1. COMPOSITION OF CREDIT COMMITTEE
The credit committee shall consist of at least 5 members
appointed by the management committee under the
leadership of the President and Treasurer.
7.2.2. DUTIES OF CREDIT COMMITTEE
32
7.2.2.1. To process applications for loans against the background
of the financial
conditions, previous record of borrowing, purpose of loans,
ability to repay fully and promptly, and the character and
financial standing of the sureties and thereafter
recommend for the approval of the Management
Committee.
7.2.2.2. To decide on the terms of payments of loans granted.
7.2.2.3. To call for at regular intervals, comparative statement of
delinquent loans
 and reasons for them in order to evaluate the quality of
their worth.
7.2.2.4. The committee may at its discretion waive a member’s
contribution
towards the ordinary savings during the currency of a loan,
the repayment of which may impose more hardship on
such member if it were to continue to make his normal
savings along with the repayment of his loan. Alternatively,
the committee may adopt a level plan payment which
enables a borrower to continue a proportion of his total
payments to his/her ordinary savings while repaying his/her
loan.
8.0. CREATION OF FUND
8.1. SOURCES OF FUNDS
The fund of the society shall comprise:
8.1.1. Savings from members as defined in the Byelaw 8.7
8.1.2. Entrance fee as stipulated by Management Committee
and approved by
general house.
8.1.3. Surplus arising out of the business of the society.
8.1.4. Miscellaneous sources as suggested by the
Management Committee and
approved by general house.
8.1.5. Interests receivable on loans and return on
investments.
8.2. EMPLOYMENT OF FUNDS
33
The fund of the society shall be devoted only to the
promotion of the stated objectives of the society, to any
other objective permitted in these byelaws and to any other
purpose approved by the General Meeting.
8.3. ENTRANCE FEE/RE-ENTRY FEES
Every member, on joining the association shall pay an
entrance fee of N2,000.00 or as may be proposed by the
Management Committee and approved by the General
House from time to time. Any member who had earlier
resigned/withdrawn his/her membership can be re-admitted
after 180 days and payment of “Re-entry fee” of N2,000.00
or as may be proposed by the Management Committee and
approved by the General House from time to time.
8.4. COMPULSORY SAVINGS
Platinum and Diamond members shall make monthly thrift
savings of a minimum of N6,000.00 (Six thousand naira only)
while Elite members shall make a monthly thrift savings of a
minimum of N2,000.00 (Two Thousand Naira only). This
amount may be reviewed by the Management Committee
and ratified by the General House from time to time.
8.4.1. Savings shall be governed by rules to be framed by the
society.
8.4.2. The rate of dividend payable on the regular ordinary
savings shall be
determined after the surplus has been ascertained and the
necessary reserves created.
8.4.3. No member can withdraw part or whole of his savings
except on withdrawal of membership.
8.4.4. Interest paid on Platinum Members savings shall be
calculated on a pro-rata monthly basis but payable annually
at a time to be determined by the management committee,
except in the case of a disengaged member. - need
clarification
9.0. USE AND CUSTODY OF FUNDS
34
9.1 INTERNAL FUNDS
The Funds of the association may be held in the form of: -
9.1.1. A reserve fund.
9.1.2. Current or saving bank account, cash, term deposit or
Federal Government
Treasury Bill
9.2. USE OF FUNDS
The funds of the association shall be applied only for the
furtherance of its stated objectives in accordance with these
Byelaws.
9.3. INVESTMENT
Such funds of the Society as are not required for current use
may be invested as permitted by law and regulations,
recommended by the Management Committee and approved
by the General House.
9.4. OPERATION OF BANK ACCOUNT
The Society shall operate a trustee bank account. Before
money is withdrawn from the bank, the Cheques or
withdrawal slips shall be signed by at least three of the
Trustees.
10.0.LOAN
Loans may be granted to members subject only to
availability of funds and shall be for purposes, for which, in
the opinion of the Management Committee are productive or
necessary, and in the best interest of the borrower. This shall
be in accordance with section 10.1 and other sections of this
byelaws.
10.1.CONDITION GOVERNING LOANS
No loan shall be granted:
10.1.1. To any individual who is not a member of the Society.
10.1.2. To any member who has not made thrift savings under
Byelaw 8.0. Elite
members shall not be allowed to guarantee loans more than
their savings or borrow more than their savings.
35
10.1.3. For a period exceeding the time limit fixed by the
Management
 Committee.
10.1.4. If it would bring a Platinum Member’s total indebtedness
at the time of
the loan to an amount exceeding twice (200%) his/her
maximum credit limit at a time.
10.1.5. If it would bring a Diamond Member’s total indebtedness
at the time of
the loan to an amount exceeding 150% his/her maximum
credit limit at a time.
10.1.6. To a member earlier than one (1) year of becoming a
member of the
Society, however, members can take 50% of their savings
after 180 days of joining the society.
10.2.Members in Service
The maximum credit limit of each applicant for a loan shall
be determined as 200% of the total savings of platinum
member applicant and 150% of the total savings of diamond
member applicant as at the time of the application. This
however is subject to maximum credit approved at the
General Meeting for each category of membership,
availability of funds, the principle of making credit available
to as many members as are qualified, and the securities
offered.
10.3.APPLICATIONS FOR LOANS
Application for loans shall be on the forms prepared and
furnished by the Management Committee and shall set out
the purpose for which the loan is requested, the security (if
any) and such other data as may be desired. These shall be
made to and disposed of by the Management Committee.
10.4.LOAN TO MEMBERS
No loans shall be made to a member earlier than one year of
becoming a member of the Society and loan condition shall
be according to subsection 10.1 of this byelaw, however,
36
members can take 50% of their savings as loans after 180
days of joining the Society.
10.5.INTEREST ON LOAN TO MEMBERS
10.5.1. Platinum members shall be charged interest rates
approved at the General
Meeting but shall not exceed 5% annually. In case of default
in repayment, penal interest shall be charged at twice the
nominal rate.
10.5.2. Diamond members shall be charged administrative and
processing fees of
1.5% - 2.5% during the loan tenure not to exceed 24
months. This shall be reviewed, if required, at the General
meeting.
10.5.3. Elite members shall be charged administrative and
processing fees of 1.0%
- 2.0% during the loan tenure not to exceed 24 months. This
shall be reviewed, if required, at the General meeting.
10.6.BOND, SURETIES AND GUARANTORS
Every borrower shall execute a bond, and a borrower
exceeding 100% of his/her savings balance at the time
borrowing, shall furnish at least three sureties who must be
members of the Society. No extension of the period of
repayment shall be granted without the consent of the
sureties/guarantors.
10.7.DUTIES OF A SURETY
10.7.1. A surety must be a reputable member of the Society and
shall
 personally, guarantee the loans being sought.
10.7.2. Repayment of the loans if the borrower defaults.
10.7.3. Ensure correctness of the particulars on which the value of
the borrower’s
 securities are based.
10.8.APPROPRIATION OF DEBIT PAYMENT
When a member from whom money is due pays any sum to
the Society, it shall be appropriated in the following order:
37
10.8.1. Interest/Processing fees & Management fees
10.8.2. Principal Loan
10.8.3. Penalty and other miscellaneous charges due to him.
11.0.DISPOSAL OF SURPLUS
11.1 APPROPRIATION
At the end of each financial year, the excess of the Society's
income over expenses including the interest and fees
payable on qualified members (as defined in subsection 1.15
of this byelaw) saving or deposit, loans and audit and
supervision fees due shall be appropriated to the following
funds:
11.1.1 Reserve Fund: This shall not be more than 5%, in each
financial year.
11.1.2. Meetings, Conferences and Training funds: This shall not
be more than
 2.0% in each financial year.
11.1.3. Honoraria: This shall not exceed 3% in any financial year
and must be
 approved by the General house.
11.1.4. Dividends for Platinum and Elite members shall not be less
than 65% of
 the net surplus in a financial year.
11..1.5. Gifts for qualified members shall not exceed 10% of the
net surplus in a
 financial year.
11.1.6. Others: Not more than 5% shall be appropriated in a
financial year for
bank charges, office supplies and maintenance, staff
salaries, medical emergencies of staff and auditor’s fees.
11.2.DIVIDEND
The committee shall determine the dividend payable to
qualified members (as defined in subsection 1.15 of this
byelaw), provided that the appropriated net surplus for
dividend shall not be less than 65% in a financial year. No
dividend shall be declared and paid if any overdue claim to a
depositor or lender remains unsatisfied or interest on
members saving or other bona fide expenditures are unpaid
38
or transfer to approved reserve funds have not been met. A
lien shall be placed on such dividend and applied to service
such outstanding loan, expenditure and or reserve.
11.3.RESERVE FUND
The Reserve Fund is indivisible, and no member is entitled to
claim a specific share in it. Except as approved by the
general house, it shall be utilized for the business of the
association.
11.4.AUDIT AND SUPERVISION FEES
The Management Committee shall engage the services of
external auditors to audit of association's accounts and
operations at the end of each financial year. The
Management Committee shall present three names of
desired firms of auditors to the general house and the
General House shall approve an auditor to be used. Auditor’s
fees shall be payable at an amount approved by the
members in a general meeting.
12.0.BOOK OF ACCOUNT
12.1.PRESCRIBED BOOKS OF INSPECTION
Computerized account and records (either in manual or
electronic forms shall be maintained in the form prescribed
by the law and shall include the following:
12.1.1. A Membership and Attendance Register, showing the
name, address
specimen signature and occupation of every member, the
date of admission to membership, the Nominee appointed
under Byelaw 4.6, and the member’s attendance at general
meeting.
12.1.1.1. Only Licensed bookkeepers shall be allowed to review
the books of
accounts of the association and append their signature
and seal at the appropriate places in the Annual Accounts
and Returns Form.
12.1.2. A computerized cash book showing the receipts,
expenditure, and balance
 on each day on which business is done.
39
12.1.3. A Computerized General Leger: - Leger accounts that
supports the value
item shown in the financial statement. It should include
accounts for all current’s assets, fixed assets liabilities,
revenue and expenses items, gains and losses.
12.1.4. Computerized Personal Ledger: - A computerized
subsidiary records of
 each member’s savings account, loan account, depositor
and creditor.
12.1.5. Monthly bank reconciliation statements for all the
Society's bank
 accounts, (current and fixed deposit account).
12.1.6. Loan register showing installment for repayment of loans.
12.1.7. Minutes of meeting book for proceedings of General and
Management
 Committee Meetings.
12.1.8. Loan bond book showing particulars of and containing
bonds for all loans
 issued.
12.1.9. Monthly Members statement of accounts, showing
members savings and
loan positions shall be generated from the computerized
accounting system and sent to members monthly.
12.1.10. Special Project or Venture accounts should be
maintained to record
 transactions relating to any project or venture of the
association.
12.1.11. Such other records as may be prescribed by the
Management Committee
 or/and General House.
12.1.12. As determined by the management committee and
approved by general
house, if the cost of implementing the computerized
systems as prescribed in section 12.0 is weighty on the
Society, data processing software/manual method(s) may
be used such as excel, access etc. until the Society can
afford sophisticated and robust computer systems.
12.2.INSPECTION OF BOOKS
40
The books, accounts, register and papers of the Society shall
be open at all reasonable times for the inspection of
members and of any accredited Co-operative Official
provided that no person other than an Officer or Committee
member of the Society or a Co-operative Official shall be
allowed to see the personal account of any member without
that member’s consent. Copies of the Law, the Regulations
and of these byelaws shall be available for inspection at the
Registered Address of the association at all reasonable
hours.
12.3.ANNUAL STATEMENT
12.3.1. The society shall prepare an annual statement at the end
of each financial year and shall include:
12.3.1.1. An account showing the income and expenditure for the
financial year.
12.3.1.2. A balance sheet.
12.3.2. The account shall be due for submission not later than 90
days after the
end of a financial year and a copy of the account shall be
presented to the General house for approval.
12.4.RECEIPTS
It shall be the duty of every member: -
12.4.1. To insist upon obtaining a separate printed receipt from
the proper receipt
book, or such other form of receipt as may be approved by
the Chief Registrar, for every sum of money paid to the
Society.
12.4.2. To sign, or make his thumb print in the proper book in
token of receipt
 whenever any sum of money is paid or repaid to him by the
Society.
13.0.LIQUIDATION
13.1. The Society shall not be liquidated except in
accordance with the Act.
13.2. On the dissolution of the Society, the reserve fund and
other funds of the
41
association shall be applied, first to the cost of liquidation
and secondly to discharging the liabilities of the Society. In
case there is any surplus after meeting all liabilities, such
surplus shall be disposed of /distributed among members in
proportion to their savings balance in the Society or as
decided at the general meeting.
14.0.MISCELLANEOUS PROVISIONS
14.1.AFFILIATION TO SECONDARY COOPERATIVE BODY
Unless there are reasons to the contrary accepted by the
General house, the Society shall affiliate itself at the earliest
possible moment to any secondary co-operative body
formed in its area of operations.
14.2.DISPUTES
Any dispute arising in or concerning the Society and its
members or past members shall be brought before the
General house.
14.3.SEAL
The Secretary shall hold in safe custody the seal of the
Society on behalf of the trustees. The seal shall be of a
pattern approved by the Director of Co-operatives.
Documents shall be sealed by at least three of the trustees,
one of whom must be the Secretary.
14.4.SURCHARGE
The General Meeting of the Society may impose surcharge
on members, not exceeding Five Thousand Naira
(N5,000.00) in case of anyone, who is flagrant or repeatedly
contravenes any of the byelaws.
15.0.AMENDMENT OF BYE-LAWS
Any amendment of or addition to these Byelaws shall be
made and approved at the General Meeting of the Society in
accordance with the Act, and such amendments shall be
passed to the Cooperative corporation for final approval.
42
16.0.CERTIFICATION
I hereby certify that the foregoing Byelaws of the American
Embassy Employees
Multipurpose Co-operative Society Limited (AMEEMCA):
No: ……………………………...of ………………………. Has been
registered under Section ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Proceed</button>
       
      </div>
    </div>
  </div>
</div>
    <!-- ========================= signup-style-2 end ========================= -->

          <?php include 'inc/footer.php'; ?>