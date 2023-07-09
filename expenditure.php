<?php include 'inc/navb.php'; ?>
         
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Expenditures</h5>
    </div>
</div>


        <div class="container">
      <div class="card card-box mb-5">
          <div class="card-header">
         <div style="display: flex;justify-content: space-between;">
                                              <div class=" mb-2">
                                                  <b>Expenditure History</b>
                                              </div>
                                          <div class=" mb-2">
                                                  <button type="button" action="save" id="add_button"  class="btn btn-pill btn-primary btn-sm">Add New</button>
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
  						<th>Title</th>
  						<th>Amount(N)</th>
  						  <th>Payee</th>
  						<th>View</th>
  						  <th>Date</th>
  				</thead>
  				<tbody></tbody>
  			</table>
  		</div>
  		
  
  		
 	
  		
  		
     
       
       

    </div>
</div>


            


                    


                </div>
            </div>
       
          <?php include 'inc/footerb.php'; ?>



<div id="updateModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="update_form" enctype="multipart/form-data">
   <div class="modal-content" id="expenditure-card-body">
    </div>
  </form>
 </div> </div>
 
<div class="modal" id="viewModal">
    <div class="modal-dialog modal-md"><div class="modal-content"></div>
</div></div>

 	


 
      <script>
      $(document).ready(function(){
	        
var dataTable = $('#user_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[], 
		"ajax":{
			url:"authController/expenditure_process.php",
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
	
var id ='';
$(document).on('click', '.view-member', function(){
     id = $(this).data('id');
    $.ajax({
      url:"authController/expenditure_process.php",
      method:"POST",
      data:{action:'single_fetch',  id:id},
      success:function(data)
      { 
        $('#viewModal').modal('show');
        $('#viewModal .modal-content').html(data);
      }
    });
  });
  

  
  
  
  $(document).on('click', '#refresh_button', function(){	
            $('#user_table').DataTable().ajax.reload();
  });
  
  
  $(document).on('click', '#add_button', function(){	
        var form = '<div class="modal-header d-block"><div class="row mb-2"><div class="col"><div class="form-floating"><h4 class="modal-title">Add Expenditure</h4></div></div><div class="col"><div class="form-floating"> <button type="button" class="close" data-dismiss="modal">&times;</button></div></div></div></div><div class="modal-body"><div class="form-group col-md-12"> <label>Transaction Title:</label> <input type="text" name="title" id="title" class="form-control" placeholder="Title:"/><div id="error_title" style="color: red"></div></div><div class="form-group col-md-12"> <label>Recipient Name:</label> <input type="text" name="recipient_name" id="recipient_name" class="form-control" placeholder="Mr/Mrs: "/><div id="error_recipient_name" style="color: red"></div></div><div class="form-group col-md-12"> <label>Recipient Account No:</label> <input type="text" name="recipient_account" id="recipient_account" class="form-control" placeholder="Account Number:"/><div id="error_recipient_account" style="color: red"></div></div><div class="form-group col-md-12"> <label>Recipient Bank:</label> <select class="custom-select w-100" id="recipient_bank" name="recipient_bank"> <?php echo getBankList(); ?> </select><div id="error_recipient_bank" style="color: red"></div></div><div id="display_info"></div></div>';
         $("#expenditure-card-body").html(form);
         $('#updateModal').modal('show');
  });
  
 function clear_field()
  {
    $('#update_form')[0].reset();
    $('#error_title').text('');
    $('#error_amount').text('');
    $('#error_reason').text('');
    $('#error_recipient_name').text('');
    $('#error_recipient_bank').text('');
    $('#error_recipient_account').text('');
  }

  $('#update_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"authController/expenditure_process.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
      beforeSend:function()
      {
        $('#save_btn').attr('disabled', 'disabled').text('Processing...');
         $('#close_btn').attr('disabled', 'disabled');
      },
      success:function(data)
      {
        $('#save_btn').attr('disabled', false).text('Proceed');
        $('#close_btn').attr('disabled', false);
        if(data.success)
     	  {
     	    $("#expenditure-card-body").html(data.html);
            $('#user_table').DataTable().ajax.reload();
              clear_field();
          }
        
        if(data.error)
        {    
         if(data.error_title != '')
          {
            $('#error_title').text(data.error_title);
          }
          else
          {
            $('#error_title').text('');
          }
           if(data.error_amount != '')
          {
            $('#error_amount').text(data.error_amount);
          }
          else
          {
            $('#error_amount').text('');
          }
          
          if(data.error_reason != '')
          {
            $('#error_reason').text(data.error_reason);
          }
          else
          {
            $('#error_reason').text('');
          }
          
          if(data.error_recipient_name != '')
          {
            $('#error_recipient_name').text(data.error_recipient_name);
          }
          else
          {
            $('#error_recipient_name').text('');
          }
          
          if(data.error_recipient_account != '')
          {
            $('#error_recipient_account').text(data.error_recipient_account);
          }
          else
          {
            $('#error_recipient_account').text('');
          }
          
          if(data.error_recipient_bank != '')
          {
            $('#error_recipient_bank').text(data.error_recipient_bank);
          }
          else
          {
            $('#error_recipient_bank').text('');
          }
          
          
          
        }
      }
    })
  }); 

  
  
  
  
  
    //here
    $(document).on('keyup', '#recipient_account', function(e) {     
         retrieveInfo();
	});
    $(document).on('change', '#recipient_bank', function(e) {
        retrieveInfo();
	});
	
	
	function retrieveInfo(){
	    $("#display_info").empty();
		var recipient_bank = $("#recipient_bank option:selected").data('code');
		var recipient_account =  $("#recipient_account").val();
		var recipient_name =  $("#recipient_name").val();
		if(recipient_bank != '' && recipient_account.length > 8){
		    $.ajax({
              url:"authController/expenditure_process.php",
              type:"POST",
              data: {recipient_bank: recipient_bank, recipient_account: recipient_account, recipient_name: recipient_name, action:'fetch_info'},
              dataType: "json",
              success:function(r){ 
                var len = r.length;
                $("body #display_info").empty();
                $("body #display_info").append(r);
              }
	    });
		}
    }
  
  
  
});
</script> 