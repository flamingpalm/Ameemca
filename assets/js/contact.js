 
 
 
 (function($) {
	// Email Validation
	$.fn.contactifyEmailValidate     = function () {
		var emailRegexp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return emailRegexp.test(String($(this).val()));
	}
	// Phone Validation
	$.fn.contactifyPhoneValidate     = function () {
		var phoneRegexp = /^[0-9]+$/;
			return phoneRegexp.test(Number($(this).val()));
	}
	$.fn.modalClose = function(){
		let thisModalTarget  = $(this).attr('id'),
			$this            = $(this);
		 
		$(window).on('click', function(event){
			if(event.target.id == thisModalTarget){
				$this.removeClass("active");
			}
		});
	}    
})(jQuery);

 
 
 
 
/* -------------------------------------------------------------------
 [Table of contents]
 * 01.Copyright
 * 02.Contact Form
*/
(function($) {
    "use strict";

    // Call all ready functions
    contactify_copyright(),
    contactify_contactForm();

})(window.jQuery);


/* ------------------------------------------------------------------- */
/* 01.Copyright
/* ------------------------------------------------------------------- */
function contactify_copyright() {
    "use-strict";

    // Variables
    var fullYearCopyright = $('#fullYearCopyright'),
        getFullYearDate = new Date().getFullYear();

    fullYearCopyright.text(getFullYearDate);
}
/* ------------------------------------------------------------------- */
/* 02.Contact Form
/* ------------------------------------------------------------------- */
 function contactify_contactForm() {
    "use-strict";
    //  Validate Input Variables
    var contactEmail    = $("#contactEmail"),
        contactPhone    = $("#contactPhone"),
        formControl     = $('.contact-form-group .form-control');
    
    // Added AutoComplete Attribute Turned Off
    formControl.attr("autocomplete","off");

    // Email Validation
    contactEmail.on("keyup", function() {
        var emailInputValue  = $(this).val().trim();


        if (emailInputValue.length > 0) {
            let validate = $(this).contactifyEmailValidate();

            if (!validate === true) {
                $(this).parent().find("span").removeClass("success").addClass("error");
            } else {
                $(this).parent().find("span").removeClass("error").addClass("success");
            }
        }else{
            $(this).parent().find("span").removeAttr("class");  
        }
    });

    // Phone Validation
    contactPhone.on("keyup", function() {
        var phoneInputValue  = $(this).val().trim();


        if (phoneInputValue.length > 0) {
            let validate = $(this).contactifyPhoneValidate();

            if (!validate === true) {
                $(this).parent().find("span").removeClass("success").addClass("error");
            } else {
                $(this).parent().find("span").removeClass("error").addClass("success");
            }
        }else{
            $(this).parent().find("span").removeAttr("class");
            $(this).parent().find("span").addClass("error");  
        }
    });

    // Form Control Validate
    $(".form-control:not('#contactEmail,#contactPhone')").on("keyup", function() {
        var formInputValue  = $(this).val().trim();

        if (formInputValue.length > 0) {
            $(this).parent().find("span").removeClass("error").addClass("success");
        }else {
            $(this).parent().find("span").removeAttr("class");
            $(this).parent().find("span").addClass("error");
        }
    });

    // Popup Variables
    var termsPopup          = $('#termsPopup'),
        termsToggleBtn      = $('#termsToggle'),
        termsClose          = $('#termsClose'),
        termsAgree          = $('#termsAgree'),
        successToggle       = $('#successToggleBtn'),
        dangerToggle        = $('#dangerToggleBtn'),
        dangerPopup         = $('#dangerPopup'),
        successPopup        = $('#successPopup');

    // When the user clicks on the button, open the modal
    termsToggleBtn.on("click",function(event){
        termsPopup.addClass("active");
        event.preventDefault();
    });

    // Terms Popup Close
    termsClose.on("click",function(event){
        termsPopup.removeClass("active");
        event.preventDefault();
    });

    // Succes Popup Toggle
    successToggle.on("click",function(event){
        successPopup.toggleClass("active");
        event.preventDefault();
    });

    // Danger Popup Toggle
    dangerToggle.on("click",function(event){
        dangerPopup.toggleClass("active");
        event.preventDefault();
    });

    // Terms Agree
    termsAgree.on("click",function(event){
        termsPopup.removeClass("active");
        event.preventDefault();
        $("#termsCheckBox").prop("checked",true);
        $('#contactBtn').attr('disabled', false);
    });

    // When the user clicks anywhere outside of the modal, close it
    termsPopup.modalClose();
    dangerPopup.modalClose();
    successPopup.modalClose();


    //  Captcha Variables    
    let textCaptcha     = $("#txtCaptcha"),
        textCaptchaSpan = $('#txtCaptchaSpan'),
        textInput       = $('#txtInput');

    // Generates the Random number function 
    function randomNumber(){
         
        let a = Math.ceil(Math.random() * 9) + '',
            b = Math.ceil(Math.random() * 9) + '',
            c = Math.ceil(Math.random() * 9) + '',
            d = Math.ceil(Math.random() * 9) + '',
            e = Math.ceil(Math.random() * 9) + '',
            code = a + b + c + d + e;
   
        textCaptcha.val(code);
        textCaptchaSpan.html(code);
    }

    // Called random number function
    randomNumber();

    // Validate the Entered input aganist the generated security code function   
    function validateCaptcha() {
        let str1 = textCaptcha.val();
        let str2 = textInput.val();
        if (str1 == str2) {
            return true;
        } else {
            return false;
        }
    }

    // Form Conttrol Captcha Validate
    textInput.on("keyup", function() {
        if (validateCaptcha() == true) {
            $(this).parent().find("span").removeClass("error").addClass("success");
        }else {
            $(this).parent().find("span").removeAttr("class");
            $(this).parent().find("span").addClass("error");
        }
    });

    // Contact Form Submit
    $("#contactForm").on("submit", function(event) {
        var $this = $(this);

        //  Contact Form Input Value 
      var name = $("#contactName").val().trim(),
            email = $("#contactEmail").val().trim(),
         phone = $("#contactPhone").val().trim(),
        subject = $("#contactSubject").val().trim(),
       identity = $("#contactIdentity").val().trim(),
 message = $("#contactMessage").val().trim(),
            termsCheckBox = $("#termsCheckBox").prop("checked");
            validateEmail = $("#contactEmail").contactifyEmailValidate(),
            validatePhone = $("#contactPhone").contactifyPhoneValidate(),
            subjectNull  = $('#contactSubject').find("option").eq(0).val();
            identityNull  = $('#contactIdentity').find("option").eq(0).val();

        if (name =='' || email =='' || phone == '' || message == '' || textInput == '' ) {
            $(this).parent().find("span").addClass("error");
            if($('.empty-form').css("display") == "none"){
                $('.empty-form').stop().slideDown().delay(3000).slideUp();
            }else {
                return false;
            }
        } else if (subject == subjectNull) {
            if($('.subject-alert').css("display") == "none"){
                $('.subject-alert').stop().slideDown().delay(3000).slideUp();
            }else {
                return false;
            }
        } else if (identity == identityNull) {
            if($('.identity-alert').css("display") == "none"){
                $('.identity-alert').stop().slideDown().delay(3000).slideUp();
            }else {
                return false;
            }
        } else if (termsCheckBox == false) {
            if($('.terms-alert').css("display") == "none"){
                $('.terms-alert').stop().slideDown().delay(3000).slideUp();
            }else {
                return false;
            }
        } else if (!validatePhone === true) {
            $("#contactPhone").parent().find("span").removeClass("success").addClass("error");
            if($('.phone-invalid').css("display") == "none"){
                $('.phone-invalid').stop().slideDown().delay(3000).slideUp();
            }else {
                return false;
            }
        } else if (!validateEmail === true) {
            $("#contactEmail").parent().find("span").removeClass("success").addClass("error");
            if($('.email-invalid').css("display") == "none"){
                $('.email-invalid').stop().slideDown().delay(3000).slideUp();
            }else {
                return false;
            }
        } else if (validateCaptcha() != true){
            $("#textInput").parent().find("span").removeClass("success").addClass("error");
            if($('.security-alert').css("display") == "none"){
                $('.security-alert').stop().slideDown().delay(3000).slideUp();
            }else {
                return false;
            }
        } else {
            $this.find(':submit').append('<span class="fas fa-spinner fa-pulse ml-3"></span>');
            $this.find(':submit').attr('disabled','true');
 				$.ajax({
                url: "authController/contact",
                data: {
                    contact_name: name,
                    contact_email: email,
                    contact_phone: phone,
                    contact_subject: subject,
                    contact_message: message,
                    contact_identity: identity
                },
                type: "POST",
                dataType: "json",
                success: function(response) {
                    $(".form-control").parent().find("span").removeAttr("class");
                    $("#contactForm")[0].reset();
                           $(".identityclass .select-selected").html(identityNull);
                           $(".subjectclass .select-selected").html(subjectNull);
                    if (response.status == "success") {
        $(".success-form-popup").addClass("active");
        $("#contactForm").find(':submit').removeAttr('disabled');
       $this.find(':submit').find("span").fadeOut();
          // Called random number function
                   randomNumber();
                    } else {
       $(".danger-form-popup").addClass("active");
      $("#contactForm").find(':submit').removeAttr('disabled');
	$this.find(':submit').find("span").fadeOut();
      $("#error_message").html(response.msg);
                  // Called random number function
                   randomNumber();
                    }
                }
            });
        }
        event.preventDefault();
    });
    
  //AGREE TO TERMS
    $('#termsCheckBox').change(function() {
      if($(this).is(":checked")) {
          $('#contactBtn').attr('disabled', false);
       } else {
          $('#contactBtn').attr('disabled', true);
       }       
});
}
