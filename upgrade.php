<?php include 'inc/navb.php'; ?>
         
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Account Upgrade</h5>
    </div>
</div>


        <div class="container">
      <div class="card card-box mb-5">
          <div class="card-header">
         <div style="display: flex;justify-content: space-between;">
                                              <div class=" mb-2">
                                                  <b>Members List</b>
                                              </div>
                                         <div class=" mb-2">
                                        <!--<span class="badge badge-pill badge-primary" style="padding: 12px;height: 0;line-height: 0;"></span>-->
                                            </div>
                                            </div>
        
    </div>
    <div class="divider"></div>
    <div class="card-body">
       
      <div class="table-responsive">
        <span id="message_operation"></span>
  			<table class="table table-striped table-bordered" id="user_table">
  				<thead>
  					<tr>
						<th>S/N</th>
  						<th>Name</th>
  						<th>Member ID</th>
  						<th>Membership</th>
  						<th>modify</th>
  				</thead>
  				<tbody></tbody>
  			</table>
  		</div>
  		
  
  		
 	
  		
  		
     
       
       

    </div>
</div>


            


                    


                </div>
            </div>
       
          <?php include 'inc/footerb.php'; ?>


<div class="modal" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 align="center">Are you sure you want to remove this user?</h3>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="button" name="ok_button" id="ok_button" class="btn btn-primary btn-sm">OK</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


	
	<div class="modal" id="viewModal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
         
</div>
  </div>
</div>

<script>
  $(document).on("submit", "#update_allotment_form", function(e){
    e.preventDefault();
    $('#error_allotment_desc').text('');
    $('#error_allotment_amount').text('');
   $.ajax({
      url:"authController/upgrade_process.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
      beforeSend:function()
      {
        $('#save_btn').attr('disabled', 'disabled').val('Saving...');
      },
      success:function(data)
      {
        $('#save_btn').attr('disabled', false).val('Save');
        if(data.saved)
     	  {
  			$('#message_operation').html('<div class="alert alert-success">'+data.notice+'</div>');
            $('#user_table').DataTable().ajax.reload();
            $('#viewModal').modal('hide');
            $('#update_allotment_form')[0].reset();
                $('#error_allotment_desc').text('');
                $('#error_allotment_amount').text('');
          }
        
        if(data.error)
        {
           if(data.error_allotment_desc != '')
          {
            $('#error_allotment_desc').text(data.error_allotment_desc);
          }
          else
          {
            $('#error_allotment_desc').text('');
          }
          
           if(data.error_allotment_amount != '')
          {
            $('#error_allotment_amount').text(data.error_allotment_amount);
          }
          else
          {
            $('#error_allotment_amount').text('');
          }
        }
      }
    })
});
 </script> 	



<div id="updateModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="update_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header d-block">
       
     
                                         <div class="row mb-2">
                                              <div class="col">
                                                <div class="form-floating">
                                                 <h4 class="modal-title">Upgrade User</h4> 
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
     <div class="form-group col-md-12"> 
     <label>Package:</label>
     <select class="custom-select w-100" id="change_pkg" name="change_pkg" />
  <option selected disabled>Select Package</option>
  <option value="1">Diamond</option>
  <option value="3">Platinum</option>
  <option value="2">Elite</option>
   </select>
   <div id="error_change_pkg" style="color: red"> </div>
    </div>
    <div class="form-group col-md-12" id="elite_mail" style="display: none">   
     <label>Email Address:</label>
     <input type="text" name="email_address" id="email_address" class="form-control"/>
     <div id="error_user_email" style="color: red"> </div>
      </div>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="action" value="update_member" />
     <input type="hidden" name="sid" id="sid"/>
     <button type="submit" class="btn btn-pill btn-primary btn-sm" id="save_btn">Save</button>
     <button type="button" class="btn btn-default btn btn-pill btn-sm" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div> </div>
 
 
 
 
 
      <script>
      $(document).ready(function(){
var dataTable = $('#user_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[], 
		"ajax":{
			url:"authController/upgrade_process.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[0, 1],
				"orderable":false,
			},
		],
	});
	
	
var staffid ='';

  $(document).on('click', '.account-upgrade', function(){	
  	$('#sid').val($(this).data('sid'));
  	$('#updateModal').modal('show');
  });
  
  
  
   $(document).on('change', '#change_pkg', function(){	
  	var pkg = $(this).val();
  	if(pkg == 2){
  	    $('#elite_mail').show();
  	    $('#elite_mail input').attr('disabled', false);
  	} else {
  	    $('#elite_mail').hide();
  	    $('#elite_mail input').attr('disabled', 'disabled');
  	}
  });
  
 function clear_field()
  {
    $('#update_form')[0].reset();
    $('#error_change_pkg').text('');
  }

  $('#update_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"authController/upgrade_process.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
      beforeSend:function()
      {
        $('#save_btn').attr('disabled', 'disabled').val('Saving...');
      },
      success:function(data)
      {
        $('#save_btn').attr('disabled', false).val('Save');
        if(data.saved)
     	  {
  			$('#message_operation').html('<div class="alert alert-success">'+data.notice+'</div>');
            $('#user_table').DataTable().ajax.reload();
            $('#updateModal').modal('hide');
            clear_field();
          }
        
        if(data.error)
        {    
           if(data.error_change_pkg != '')
          {
            $('#error_change_pkg').text(data.error_change_pkg);
          }
          else
          {
            $('#error_change_pkg').text('');
          }
        
        }
      }
    })
  }); 


  
  
  
});
</script> 