 <?php include 'inc/navb.php'; ?>
          
            <div class="app-content">
                <div class="app-content--inner">

                      <div class="container">
                        <div class="card card-box mb-5">
                            <div class="card-header">
                                <h5 class="my-3">
                                    My Profile
                                </h5>
                            </div>
                            <div class="divider"></div>
                           
                                   
                                        <div style=" margin: 10px;  background: #f4f5fd!important;  padding: 18px; border-radius: 8px; border: 1px solid rgba(7,9,25,.125);text-align: center;">
                                     <div class="d-block p-0" style="margin-bottom: 19px;text-align: center;">
                                        <img class="d-44 rounded" src="<?php echo getUserInfo("photo"); ?>" style="width: 50%;text-align: center;">
                                    </div>
                                        <p>
                                            Name: <b><?php echo ucfirst(getUserInfo("fname")).' '.ucfirst(getUserInfo("lname")); ?></b>
                                        </p>
                                            
                                        <p>
                                            Email: <b><?php echo getUserInfo("email"); ?></b>
                                        </p>
                                                   
                                        <p>
                                            Phone No.: <b><?php echo getUserInfo("phone"); ?></b>
                                        </p>
                                                
                                        <p>
                                            Member ID: <b><?php echo getUserInfo("staffid"); ?></b>
                                        </p>
                        <p>
                                            Employee ID: <b><?php echo getUserInfo("employee_number"); ?></b>
                                        </p>
                                        <p>
                                            Agency/Bureau: <b><?php echo getUserInfo("agency_bureau"); ?></b>
                                        </p>
                        
                                        <p>
                                            Post: <b><?php echo getUserInfo("employee_post"); ?></b>
                                        </p>
                                        <p>
                                            Home Address: <b><?php echo getUserInfo("address"); ?></b>
                                        </p>

                                        </div>
                                         <a class="btn btn-danger" href="update-bio.php"> Update Information </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
       
          <?php include 'inc/footerb.php'; ?>
