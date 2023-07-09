<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Guarantor Response</title>
<link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/4.1.3/css/bootstrap.min.css">
 <style>
    html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
    </style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
  </head>

  <body class="text-center">
    <form class="form-signin">
      <img class="mb-4" src="https://ameemca.ng/assets/images/shape-1.svg" alt="logo" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Provide your password to verify response.</h1>

        <div id="operation-response"></div>

      <label for="inputPassword" class="sr-only">Password</label>
     <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required="">
      <input type="hidden" name="lid" value="<?= trim($_GET['lid']); ?>">
      <input type="hidden" name="sid" value="<?= trim($_GET['uid']); ?>"> 
      <input type="hidden" name="res" value="<?= trim($_GET['res']); ?>">
      <input type="hidden" name="action" value="save">
      <button class="btn btn-lg btn-primary btn-block" type="button" onclick="loginUser()">Confirm</button>
      <p class="mt-5 mb-3 text-muted"><?= date('Y'); ?></p>
    </form>
  
<script>
function reset_error()
  {
   $('#operation-response').html('<div class="alert alert-primary text-center">Authenticating...</div>');
  }
   function redirectUser(url){
       location.href = url; 
   }
function loginUser(){
     $.ajax({
        url: "authController/guarantor-approval_process.php",
        type: "POST",
        beforeSend:function(){
        	reset_error();
       },
        data: $(".form-signin").serialize(),
        dataType: "json",
        success: function (data) {
                if(data.saved){
                     $('#operation-response').html('<div class="alert alert-success text-center">'+data.notice+'</div>');
                    setTimeout(redirectUser(data.protocol), 1000);   
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
	</script>

</body></html>