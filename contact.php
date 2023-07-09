
<?php include 'head.php'; ?>
<section id="contact" class="contact-area pt-120 pb-120">
    <div class="contact-image d-flex align-items-center wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="0.5s">
        <div class="image">
            <img src="assets/images/111.jpg" width="100%"  alt="contact">
        </div>
    </div>
    <div class="container">
        
        <div class="row">
            <div class="col-lg-7">
                <div class="contact-content wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.3s">
                    <div class="section-title">
                        
                        <h3 class="title">  <span> </span></h3>
                    </div>
                    <p class="text"> Complete the form below and submit</p>
                </div>

          

                <div class="contact-form wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.6s">
                    <form action="assets/php/contact.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="single-form">
                                    <input type="text" name="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-form">
                                    <input type="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-form">
                                    <input type="text" name="subject" placeholder="subject">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-form">
                                    <textarea name="message" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <p class="form-message"></p>
                            <div class="col-md-12">
                                <div class="single-form">
                                    <button class="main-btn" name="" type="submit" >Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
    
</section>

<?php include 'footer.php'; ?>   
                               