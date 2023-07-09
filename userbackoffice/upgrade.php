
     <?php include 'inc/navb.php'; ?>
     
            <div class="app-content">
                <div class="app-content--inner">
                    <div class="page-title">
                        <div>
                            <h5 class="display-4 mt-1 mb-4 font-weight-bold">Upgrade Package</h5>
                            <div id="operation-response"> </div>
                            <div class="container" style="padding-left: 0;padding-right: 0;">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-bodyDisable">
                                         
<style>
/*===========================
       06.PRICING css 
===========================*/


.single-pricing {
  border: 2px solid rgba(100, 111, 135, 0.2);
  border-radius: 5px;
  padding: 50px 30px;
  -webkit-transition: all 0.3s ease-out 0s;
  -moz-transition: all 0.3s ease-out 0s;
  -ms-transition: all 0.3s ease-out 0s;
  -o-transition: all 0.3s ease-out 0s;
  transition: all 0.3s ease-out 0s;
  }
  
  @media (max-width: 767px) {
    .single-pricing {
      padding: 40px 20px; }
      }
  .single-pricing .pricing-package {
    position: relative; 
      
  }
    .single-pricing .pricing-package img {
      opacity: 0.13; }
    .single-pricing .pricing-package .pricing-title {
      position: absolute;
      top: 50%;
      left: 0;
      width: 100%;
      -webkit-transform: translateY(-50%);
      -moz-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      -o-transform: translateY(-50%);
      transform: translateY(-50%);
      font-size: 30px;
      font-weight: 600; 
        
    }
      @media (max-width: 767px) {
        .single-pricing .pricing-package .pricing-title {
          font-size: 24px; } 
          
      }
  .single-pricing .pricing-price {
    margin-top: 10px;
    }
    .single-pricing .pricing-price .price {
      font-size: 40px;
      font-weight: 700;
      color: #3c44b1;
      }
      @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .single-pricing .pricing-price .price {
          font-size: 36px; } 
          
      }
      @media (max-width: 767px) {
        .single-pricing .pricing-price .price {
          font-size: 34px; } 
          
      }
      .single-pricing .pricing-price .price span {
        font-size: 20px;
        font-weight: 500; 
          
      }
        @media only screen and (min-width: 992px) and (max-width: 1199px) {
          .single-pricing .pricing-price .price span {
            font-size: 18px; }
            }
        @media (max-width: 767px) {
          .single-pricing .pricing-price .price span {
            font-size: 18px; } 
            
        }
    .single-pricing .pricing-price .line {
      width: 135px;
      height: 2px;
      background-color: #646F87;
      margin: 30px auto 0;
      }
  .single-pricing .pricing-text {
    margin-top: 35px;
    }
  .single-pricing .pricing-btn {
    margin-top: 35px; 
      
  }
  .single-pricing.active, .single-pricing:hover {
    -webkit-box-shadow: 0px 5px 26px 0px rgba(100, 111, 135, 0.3);
    -moz-box-shadow: 0px 5px 26px 0px rgba(100, 111, 135, 0.3);
    box-shadow: 0px 5px 26px 0px rgba(100, 111, 135, 0.3);
    border-color: transparent;
    background-color: #fff;
    }
</style>
                                          <section id="pricing" class="pricing-area pt-115">
    <div class="container" style="padding-left: 0;padding-right: 0;">
      
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-7">
                <div class="single-pricing text-center mt-30 wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.2s; animation-name: fadeInUpBig;">
                    
                            <div id="active-package1">
                            <?php if (getUserInfo("package")==1) {?>
                                    <div class="active-package" style="background: #3c44b1;color: #fff;padding: 2px;border-radius: 25px;">Currrent Package</div>
                            <?php }?> 
                            </div>
     
                    <div class="pricing-package">
                        <img src="../assets/images/pricing-icon-1.svg" alt="pricing">
                        <h5 class="pricing-title">Diamond</h5>
                    </div>
                    <div class="pricing-price">
                        <h3 class="price">N2,000 <br><span>Registration Fee</span></h3>
                        <div class="line"></div>
                    </div>
                    <div class="pricing-text">
                        <ul class="text-left">
                            <li> <i class=" fa fa-check-circle "></i> 1.5 - 2.5% Management Fees</li>
                            <li> <i class="fa fa-check-circle "></i> Access project loan up to 150% of net savings</li>
                            <li> <i class="fa fa-check-circle "></i> Loan tenure up to 24 months</li>
                            <li> <i class="fa fa-check-circle "></i> Gifts provided annually</li>
                        </ul>
                    </div>
                    <div class="pricing-btn" id="pricingBtn1">
                        <button class="btn btn-pill btn-primary choose-payment-btn choose-payment-btn1" data-package-id="1" <?php if (getUserInfo("package")==1) {?> disabled <?php } else {?><?php } ?>><?php if (getUserInfo("package")==1) {?> Paid <?php } else {?> Select Package <?php } ?></button> 
                   
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-7 ">
                <div class="single-pricing text-center active mt-30 wow fadeInUpBig" data-wow-duration="2s " data-wow-delay="0.5s " style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeInUpBig;">
                    
                            <div id="active-package2">
                            <?php if (getUserInfo("package")==2) {?>
                                    <div class="active-package" style="background: #3c44b1;color: #fff;padding: 2px;border-radius: 25px;">Currrent Package</div>
                            <?php }?> 
                            </div>
                            
                    <div class="pricing-package ">
                        <img src="../assets/images/pricing-icon-2.svg " alt="pricing ">
                        <h5 class="pricing-title ">Elite</h5>
                    </div>
                    <div class="pricing-price ">
                        <h3 class="price ">N2,000 <br><span>Registration Fee</span></h3>
                        <div class="line "></div>
                    </div>
                    <div class="pricing-text ">
                        <ul class="text-left">
                            <li> <i class="fa fa-check-circle"></i> 1.0 - 2.0% Management Fees</li>
                            <li> <i class="fa fa-check-circle"></i> Access project loan up to 100% of net savings </li>
                            <li> <i class="fa fa-check-circle"></i> Loan tenure up to 24 months</li>
                            <li> <i class="fa fa-check-circle"></i> Gifts provided annually</li>
                        </ul>
                    </div>
                    <div class="pricing-btn" id="pricingBtn2">
                        <button class="btn btn-pill btn-primary choose-payment-btn choose-payment-btn2" data-package-id="2" <?php if (getUserInfo("package")==2) {?> disabled <?php } else {?><?php } ?>><?php if (getUserInfo("package")==2) {?> Paid <?php } else {?> Select Package <?php } ?></button> 
                   
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-7 ">
                <div class="single-pricing text-center mt-30 wow fadeInUpBig" data-wow-duration="2s " data-wow-delay="0.7s " style="visibility: visible; animation-duration: 2s; animation-delay: 0.7s; animation-name: fadeInUpBig;">
                    <div id="active-package3">
                            <?php if (getUserInfo("package")==3) {?>
                                    <div class="active-package" style="background: #3c44b1;color: #fff;padding: 2px;border-radius: 25px;">Currrent Package</div>
                            <?php }?> 
                            </div>
                    <div class="pricing-package ">
                        <img src="../assets/images/pricing-icon-3.svg " alt="pricing ">
                        <h5 class="pricing-title">Platinium</h5>
                    </div>
                    <div class="pricing-price ">
                        <h3 class="price ">N2,000 <br><span>Registration Fee</span></h3>
                        <div class="line "></div>
                    </div>
                    <div class="pricing-text ">
                        <ul class="text-left ">
                            <li> <i class="fa fa-check-circle "></i> 5% interest rates annually</li>
                            <li> <i class="fa fa-check-circle "></i> Access project loan up to 200% of net savings </li>
                            <li> <i class="fa fa-check-circle "></i> Loan tenure up to 60 months</li>
                            <li> <i class="fa fa-check-circle "></i> Bonus &amp; gifts provided annually</li>
                        </ul>
                    </div>
                    <div class="pricing-btn" id="pricingBtn3">
                            <button class="btn btn-pill btn-primary choose-payment-btn choose-payment-btn3" data-package-id="3" <?php if (getUserInfo("package")==3) {?> disabled <?php } else {?><?php } ?>><?php if (getUserInfo("package")==3) {?> Paid <?php } else {?> Select Package <?php } ?></button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="Upgrade Package" id="transaction-type">
</section>
                                          
                                          
                                          
                                          
                                       </div>
                                        </div>
                                    </div>



                                </div>
                            </div></div>
                            </div> </div> </div> </div>
                            
  <script src="https://js.paystack.co/v1/inline.js"></script> 
                    

<script>
function payWithPaystack(email, price, package, package_id) {
  let handler = PaystackPop.setup({
    key: 'pk_test_017339973125c877c7ddb9fae77f14e6ad607269', // Replace with your public key
    email: email,
    amount: price * 100,
    ref: 'AMEEMCA'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    metadata: {
        custom_fields: [
          {
            type: document.getElementById("transaction-type").value,
            package : package
          }
        ]
      },
    onClose: function(){
      alert('Transaction Cancelled.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
     
       $.ajax({
                url: "authController/upgrade_process.php",
                type: "POST",
                beforeSend:function(){$('.choose-payment-btn').text('Choose Package');},
                data: {pkgid: package_id, action: 'upgrade'},
                dataType: "json",
                success: function (data) {
                        if(data.upgraded){
                             $('.choose-payment-btn').prop("disabled", false).text('Select Package');
                             $('.choose-payment-btn'+package_id).prop("disabled", true).text('Paid');
                             $('.active-package').remove();
                             $('#active-package'+package_id).append('<div class="active-package" style="background: #3c44b1;color: #fff;padding: 2px;border-radius: 25px;">Currrent Package</div>');
                             $('#operation-response').html('<div class="alert alert-success text-center">'+data.notice+'</div>');
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
  });
  handler.openIframe();
}
    
</script>                             
                            
 <script>
 function errorReload() {     
        window.location.reload(true);
    }
 
 
 
 
 $(document).on( "click", ".choose-payment-btn", function() {
  var pkgid = $(this).data('package-id');
   $.ajax({
        url: "authController/upgrade_process.php",
        type: "POST",
        beforeSend:function(){
            
            $('.choose-payment-btn').prop('disabled', true);
            $('.choose-payment-btn'+pkgid).text('Processing...');
            
            
        },
        data: {pkgid: pkgid, action: 'fetch'},
        dataType: "json",
        success: function (data) {
                if(data.approved){
                    payWithPaystack(data.email, data.price, data.name, pkgid);   
                }
                if(data.error) {
                     $(window).scrollTop(0);
                      setTimeout(errorReload, 3000);
                     $('#operation-response').html('<div class="alert alert-danger text-center">'+data.notice+'</div>');
                 } 
            	
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
  
  
});
	</script>
                            
                            
                            
                            
                            
 <?php include 'inc/footerb.php'; ?>                          