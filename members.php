<?php include 'inc/navb.php'; ?>
         
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Members</h5>
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
  						<th>Bio</th>
  						<th>Allotment</th>
  						<th>Info</th>
  						<th>Remove</th>
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
      url:"authController/members_process.php",
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
                                                 <h4 class="modal-title">Edit User</h4> 
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
     <label>First Name:</label>
     <input type="text" name="first_name" id="first_name" class="form-control"/>
     <div id="error_first_name" style="color: red"> </div>
     <br />
     <label>Last Name:</label>
     <input type="text" name="last_name" id="last_name" class="form-control"/>
     <div id="error_last_name" style="color: red"> </div>
     <br />
     <label>Email Address:</label>
     <input type="text" name="email_address" id="email_address" class="form-control"/>
     <div id="error_user_email" style="color: red"> </div>
     <br />
     <label>Phone:</label>
     <input type="text" name="user_phone" id="user_phone" class="form-control"/>
     <div id="error_user_phone" style="color: red"> </div>
     <br />
     <label>Gender:</label>
     <select class="custom-select w-100" id="user_gender" name="user_gender" />
  <option selected disabled>Select Gender</option>
  <option value="male">Male</option>
  <option value="female">Female</option>
   </select>
   <div id="error_user_gender" style="color: red"> </div>
   <br />
     
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
			url:"authController/members_process.php",
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
$(document).on('click', '.allotment-edit', function(){
     staffid = $(this).data('sid');
    $.ajax({
      url:"authController/members_process.php",
      method:"POST",
      data:{action:'allotment_fetch', staffid:staffid},
      success:function(data)
      { 
        $('#viewModal').modal('show');
        $('#viewModal .modal-content').html(data);
        $("#al_sid").val(staffid);
      }
    });
  });	
	
	
$(document).on('click', '.view-member', function(){
     staffid = $(this).data('sid');
    $.ajax({
      url:"authController/members_process.php",
      method:"POST",
      data:{action:'single_fetch', staffid:staffid},
      success:function(data)
      { 
        $('#viewModal').modal('show');
        $('#viewModal .modal-content').html(data);
      }
    });
  });
  

  $(document).on('click', '.update-member', function(){	
  	staffid = $(this).data('sid'); 
  	$.ajax({
  		url:"authController/members_process.php",
  		method:"POST",
  		data:{action:'edit_fetch', staffid:staffid},
  		dataType:"json",
  		success:function(data)
  		{
  			$('#first_name').val(data.first_name);
  			$('#last_name').val(data.last_name);
  			$('#email_address').val(data.email_address);
  			$('#user_phone').val(data.user_phone);
  			$('#allotment_desc').val(data.allotment_desc);
  			$('#allotment_amount').val(data.allotment_amount);
  			$('#sid').val(data.staffid);
  			$('#user_gender').val(data.user_gender);
  			$('#updateModal').modal('show');
  		}
  	});
  });
  
  
 function clear_field()
  {
    $('#update_form')[0].reset();
    $('#error_first_name').text('');
    $('#error_last_name').text('');
    $('#error_user_email').text('');
    $('#error_user_phone').text('');
    $('#error_user_gender').text('');
    $('#error_allotment_desc').text('');
    $('#error_allotment_amount').text('');
  }

  $('#update_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"authController/members_process.php",
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
         if(data.error_first_name != '')
          {
            $('#error_first_name').text(data.error_first_name);
          }
          else
          {
            $('#error_first_name').text('');
          }
           if(data.error_last_name != '')
          {
            $('#error_last_name').text(data.error_last_name);
          }
          else
          {
            $('#error_last_name').text('');
          }
          
          if(data.error_user_email != '')
          {
            $('#error_user_email').text(data.error_user_email);
          }
          else
          {
            $('#error_user_email').text('');
          }
          
          
           if(data.error_user_phone != '')
          {
            $('#error_user_phone').text(data.error_user_phone);
          }
          else
          {
            $('#error_user_phone').text('');
          }
          
          if(data.error_user_gender != '')
          {
            $('#error_user_gender').text(data.error_user_gender);
          }
          else
          {
            $('#error_user_gender').text('');
          }
          
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
  
$(document).on('click', '.delete-member', function(){
  	staffid = $(this).data('sid');
  	$('#deleteModal').modal('show');
  });

  $('#ok_button').click(function(){
  	$.ajax({
  		url:"authController/members_process.php",
  		dataType:"json",
  		method:"POST",
  		data:{staffid:staffid, action:'delete'},
  		success:function(data)
  		{
  		if(data.success)
     	   {
  			$('#message_operation').html('<div class="alert alert-success">'+data.notice+'</div>');
  			$('#deleteModal').modal('hide');
  			$('#user_table').DataTable().ajax.reload();
  		} 
		}
 	})
 });
	
	  
  

  
  
  
  
});
</script> 