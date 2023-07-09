<?php include 'inc/navb.php'; ?>
          
          <div class="app-content">
              <div class="app-content--inner">
                  <div class="page-title">
                      <div>
                          <h5 class="display-4 mt-1 mb-2 font-weight-bold"> Bank Manager</h5>

                      </div>
   </div>
  
  


         <div class="card card-box mb-5">
                        <div class="card-body">
                        <div class="table-responsive">
                                         
                                        <div class="" style="display: flex;justify-content: space-between;">
                                              <div class=" mb-2">
                                                  <b>My Banks</b>
                                              </div>
                                              <div class=" mb-2">
                                                  <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-pill btn-primary btn-sm">Add New</button>
                                            </div>
                                            </div>
                                            
<div class="divider"></div>
        <br>
        
        <span id="message_operation"></span>
  			<table class="table table-striped table-bordered" id="user_table">
  				<thead>
  					<tr>
						  <th>S/N</th>
  						<th>Acc No.</th>
  						<th>Bank</th>
  						<th>Remove</th>
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
			url:"authController/banklist_process.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2],
				"orderable":false,
			},
		],
	});
});
</script>    
                    </div>

         
                      </div>
                  </div>
                 
     
        <?php include 'inc/footerb.php'; ?>
        
        
        
        
        
        <div id="userModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header d-block">
       
     
                                         <div class="row mb-2">
                                              <div class="col">
                                                <div class="form-floating">
                                                 <h4 class="modal-title">Add Bank</h4> 
                                                </div>
                                              </div>
                                              <div class="col">
                                                <div class="form-floating">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                              </div>
                                            </div>
     
     
     
     
    </div>
    <div class="modal-body">
     <label>Account Number:</label>
     <input type="text" name="account_no" id="account_no" class="form-control" required="" />
     <br />
     <label>Bank Name:</label>
     <select class="custom-select w-100" id="banklist" name="bank_id" required="">
                
                
                
                <?php
                echo getBankList();
                ?>
                
                
                
                
            </select>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="operation" id="operation" />
     <button type="button" name="action" onclick="saveBank()" class="btn btn-pill btn-primary btn-sm" value="Add">Save</button>
     <button type="button" class="btn btn-default btn btn-pill btn-sm" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
 <script>
 
 
 
 
 
 
     function saveBank(){
		var a = $("#account_no").val();
		var b = $("#banklist").val();
if(a != '' && b != '')
  {
	$.ajax({
              url:"authController/banklist_process.php",
              type:"POST",
              data: {account: a, bank: b, action:'insert'},
              dataType: "json",
              success:function(r){
                  $("#message_operation").html(r);
                  $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                   $('#user_table').DataTable().ajax.reload();
              }
	    });
  }
  else
  {
   alert("Kindly fill the fields");
  }
  
 }
 
 
$(document).on('click', '.delete-bank', function(){
  var bank_id = $(this).data("bank");
  if(confirm("Are you sure you want to remove this bank?"))
  {
   $.ajax({
    url:"authController/banklist_process.php",
    type:"POST",
     dataType: "json",
    data:{bank_id:bank_id, action: "delete"},
    success:function(r)
    {
     $("#message_operation").html(r);
                  $('#user_form')[0].reset();
                  $('#userModal').modal('hide');
$('#user_table').DataTable().ajax.reload();
    }
   });
  }
  else
  {
   return false; 
  }
 });
 
     
 </script>
 
 
 <!--
 
 <div id="runloadercontainer" style="width: 705px;height: 751px;/* display: none; */"><div id="runloader" style="width: 141px; height: 141px; top: 305px;"></div></div>
 #runloadercontainer {
    display: none;
    position: absolute;
    z-index: 9;
}
 #runloader {
    margin: auto;
    border: 10px solid #F1F1F1;
    border-top: 10px solid #04AA6D;
    border-radius: 50%;
    max-width: 150px;
    max-height: 150px;
    animation: spin 2s linear infinite;
    position: relative;
}
 
 
 -->