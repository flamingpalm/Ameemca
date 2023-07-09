

          <?php include 'inc/navb.php'; ?>
         
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Members Allotment</h5>
        <li><span>Manage members allotment records</span></li>
        <li><span>You can Upload/Download members allotments.</span></li>
    </div>
</div>

        <div class="container">
      <div class="card card-box mb-5">
          <div class="card-header">
         <div style="display: flex;justify-content: space-between;">
                                              <div class=" mb-2">
                                                  <b>Allotment Records</b>
                                              </div>
                                        
                            <div class=" mb-2">
                            
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
						<th>Allotment</th>
						<th>Upload</th>
  					</tr>
  				</thead>
  				<tbody>

  				</tbody>
  			</table>
  		</div>
  		
  
  		
  		
  		
  		
       <script>
      $(document).ready(function(){
	        var dataTable = $('#user_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[], 
		"ajax":{
			url:"authController/membersallotment_process.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[0],
				"orderable":false,
			},
		],
	});
});
</script>    
    </div>
</div>


            

<div id="userModal" class="modal fade" style="display: none;" aria-hidden="true">
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header d-block">
        <div class="row mb-2">
            <div class="col">
                <div class="form-floating">
                 <h4 class="modal-title">Upload  <span class="modal-user-title"></span >Allotment</h4> 
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
            </div>
            </div>
    </div>
    <div class="modal-body">
     <label for="allotment_file">Upload File:</label>
     <fieldset class="mb-5">
            <div class="custom-file w-100">
                <input type="file" class="custom-file-input" name="allotment_file" id="allotment_file" required="">
                <label class="custom-file-label" for="allotment_file" id="allotment-upload-label">Upload file...</label>
            </div>
        </fieldset>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="action" value="upload">
     <input type="hidden" name="sid" value="" id="sid">
     <button type="submit" id="uploadAllotment" class="btn btn-pill btn-primary btn-sm">Upload</button>
     <button type="button" class="btn btn-default btn btn-pill btn-sm" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
 
 <script>
 $(document).ready(function(){
     $('#allotment_file[type=file]').change(function () {
      var filename = this.files.length ? this.files[0].name : "Upload file...";
         $('#allotment-upload-label').text(filename);
    });
  
         $(document).on("click","#add_button",function(e) {
          $('#userModal').modal('hide');
          $('.modal-user-title').text($(this).data('name')+"'s ");
           $('#sid').val($(this).data('sid'));
            $('#allotment_file[type=file]').val("");
           $('#allotment-upload-label').text("Upload file...");
            $('#userModal').modal('show');
      });
     
     
     
  $('#user_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"authController/membersallotment_process.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      dataType: "json",
      processData:false,
      beforeSend:function(){
        $('#uploadAllotment').attr('disabled', 'disabled');
        $('#uploadAllotment').text('Importing...');
      },
      success:function(data)
      {
                  $('#message_operation').html('<div class="alert alert-success text-center">'+data.notice+'</div>');
                  $('#user_form')[0].reset();
                  $('#userModal').modal('hide');
                  $('#user_table').DataTable().ajax.reload();
                  $('#uploadAllotment').attr('disabled', false);
                  $('#uploadAllotment').text('Import');
      }
    })
  });
});
/*
var a = $("#account_no").val();
var b = $("#banklist").val();
if(a != '' && b != ''){}else{alert("Kindly fill the fields");}
*/
 </script>
 
</div>

                    


                </div>
            </div>
       
          <?php include 'inc/footerb.php'; ?>
           
</div>






