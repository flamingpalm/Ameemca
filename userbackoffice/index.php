 <?php include 'inc/navb.php'; ?>
          
            <div class="app-content">
                <div class="app-content--inner">
                    
         
                      <div class="page-title">             
                      <div class="row" style="display:block">       
     

                    <div class="courses-container">
	<div class="course">
		<div class="course-preview">
			<h6>Profile</h6>

			  
       <div class="" style="display: block; margin: 10px 0 8px 0; padding: 0;">
        <img class="" src="<?php echo getUserInfo("photo"); ?>" alt="My Image" style="max-width:100%: 100%;width: 100px;height: 100px; border-radius: 50%;">
                            </div>

			<center><a href="profile.php" class="proflink"  style="margin-bottom: 4px">My Profile<i class="fas fa-chevron-right"></i></a></center>
			<center><a href="objectives.php" class="proflink">Objectives<i class="fas fa-chevron-right"></i></a></center>
		</div>
		<div class="course-info">
			<h6 style="margin-bottom: 10px;font-weight: 900;">Information</h6>
<h6><b>Name:</b> <?php echo ucwords(getUserInfo("fname").' '.getUserInfo("lname")); ?></h6>
<h6><b>Member ID:</b> <?php echo getUserInfo("staffid"); ?></h6>
<h6><b>Employee ID:</b> <?php echo getUserInfo("employee_number"); ?></h6>
<h6><b>Agency/Bureau:</b> <?php echo getUserInfo("agency_bureau"); ?></h6>
<h6><b>Employee Post:</b> <?php echo getUserInfo("employee_post"); ?></h6>
<h6><b>Home Address:</b> <?php echo getUserInfo("address"); ?></h6>
<h6>
                            <b>Package: </b><?php 
                            if (getUserInfo("package")==1) {
                              echo "Diamond";
                            } 
                             elseif (getUserInfo("package")==2) {
                              echo "Elite";
                            }elseif (getUserInfo("package")==3) {
                              echo "Platinium";
                            } 
                            else {
                              echo "Hey! Choose a plan";
                            }?>
                            </h6>
<h6><b>Allotment:</b> N<?php echo getUserInfo("allotment_amount"); ?></h6>
	
		</div>
	</div>
</div>



                    </div>

<style>

.courses-container {
	margin: 0 auto;
}

.course {
	background-color: #fff;
	border-radius: 10px;
	box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
	display: flex;
	max-width: 100%;
	margin: 20px;
	overflow: hidden;
	width: 90%;
	text-align: left;
}

.course h6 {
    opacity: 0.6;
    margin: 0;
    margin: 0 0 3px 0;
    letter-spacing: 1px;
    text-transform: uppercase;
}



.course h2 {
	margin: 10px 0;
}

.course-preview {
	background-color: #2A265F;
	color: #fff;
	padding: 20px;
	max-width: 250px;
}

.course-preview a.proflink {
    color: #3c44b1;    font-weight: 600;
    display: block;
    background: #fff;
    border-radius: 25px;
    padding: 2px;
    font-size: 12px;
    opacity: 0.6;
    text-decoration: none;
}

.course-info {
	padding: 20px;
	position: relative;
	width: 100%;
}



.btn {
	background-color: #2A265F;
	border: 0;
	border-radius: 50px;
	box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
	color: #fff;
	font-size: 16px;
	padding: 12px 25px;
	position: absolute;
	bottom: 30px;
	right: 30px;
	letter-spacing: 1px;
}

    
</style>
            
                        
                        
                        
                        
                      
                         
                          


                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
            
                        
                        
                        
                        
                      
 
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-box bg-premium-dark border-0 text-light mb-5">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="font-weight-bold">
                                            <small class="text-white-50 d-block mb-1 text-uppercase">Wallet Balance</small>
                                            <span class="font-size-xxl mt-1">N <?php if(getAccountBalance($staffid) == "0"){ echo "0.00"; }else{ echo number_format(getAccountBalance($staffid));} ?></span>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="bg-white text-center text-success font-size-xl d-50 rounded-circle">
                                                <i class="far fa-lightbulb"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-box bg-midnight-bloom text-light mb-5">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="font-weight-bold">
                                            <small class="text-white-50 d-block mb-1 text-uppercase">Contributions </small>
                                            <span class="font-size-xxl mt-1">N <?php if(getContributionBalance($staffid) == "0"){ echo "0.00"; }else{ echo number_format(getContributionBalance($staffid));} ?></span>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="bg-white text-center text-primary font-size-xl d-50 rounded-circle">
                                                <i class="far fa-snowflake"></i>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-box bg-plum-plate text-light mb-5">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="font-weight-bold">
                                            <small class="text-white-50 d-block mb-1 text-uppercase"> Loan Balance</small>
                                            <span class="font-size-xxl mt-1">N <?php if(getLoanBalance($staffid) == "0"){ echo "0.00"; }else{ echo number_format(getLoanBalance($staffid));} ?></span>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="bg-white text-center text-primary font-size-xl d-50 rounded-circle">
                                                <i class="fas fa-battery-three-quarters"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-box mb-5">
                        <div class="card-header">
                            <div class="card-header--title">
                                <b>Transaction History</b>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
        <span id="message_operation"></span>
  			<table class="table table-striped table-bordered" id="user_table">
  				<thead>
  					<tr>
						  <th>S/N</th>
  						<th>Name</th>
  						<th>Transaction Type</th>
  						<th>Amount</th>
              			<th>Currency</th>
  						<th>Reference</th>
  						<th>Status</th>
  						<th>Date</th>
  					</tr>
  				</thead>
  				<tbody>

  				</tbody>
  			</table>
  		</div>
                         </div>
                                <script>
      $(document).ready(function(){
	        var dataTable = $('#user_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[], 
		"ajax":{
			url:"authController/transaction_process",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2, 3, 4, 5],
				"orderable":false,
			},
		],
	});
});
</script>    
                    </div>
       
       </div>
          <?php include 'inc/footerb.php'; ?>
