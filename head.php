<!doctype html>
<html class="no-js" lang="en">


<head>
    <meta charset="utf-8">

    <title> American Employees</title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">

    <link rel="stylesheet" href="assets/css1/animate.css">

    <link rel="stylesheet" href="assets/css1/slick.css">

    <link rel="stylesheet" href="assets/css1/LineIcons.css">

    <link rel="stylesheet" href="assets/css1/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css1/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css1/default.css">

    <link rel="stylesheet" href="assets/css1/style.css">
    <link rel="stylesheet" href="assets/css1/costom.css">
    
    
    
    
      <script src="assets/js/vendor/jquery.min.js "></script>
        <script src="assets/js/vendor/modernizr-3.7.1.min.js "></script>

        <script src="assets/js/popper.min.js "></script>
        <script src="assets/js/bootstrap.min.js "></script>

        <script src="assets/js/slick.min.js "></script>

        <script src="assets/js/jquery.easing.min.js "></script>
        <script src="assets/js/scrolling-nav.js "></script>

        <script src="assets/js/ajax-contact.js "></script>

        <script src="assets/js/wow.min.js "></script>

        <script src="assets/js/main.js "></script>
</head>

<body>
    <header class="header-area">
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="https://ameemca.ng">
                                <img src="assets/images/logo.svg" alt="Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="toggler-icon"></span>
<span class="toggler-icon"></span>
<span class="toggler-icon"></span>
</button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="about.php">Meet the Team</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="vision.php">Our Vision</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="membership.php">Membership</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="faq.php">Faq</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="page-scroll" href="contact.php">Contact</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="navbar-btn d-none d-sm-inline-block">
                                <a href="userbackoffice/" class="btn btn-danger"> Login in to account</a>
                               <!--
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
  Login to Account
</button>
-->
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>



     <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="sitejob/userbackoffice/login-user.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Staff ID</label>
    <input type="text" name="staffid" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
  </div>
  <button type="submit" name="login" class="btn btn-danger">Login Now</button>
</form>
      </div>
     
    </div>
  </div>
</div>