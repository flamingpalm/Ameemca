<?php
//ob_start();
require_once "pdo.php";
if($staffid != false){
    $data = array(':staffid'=> $staffid);
    $query = "SELECT status, code FROM usertable WHERE staffid = :staffid";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $result = $statement->rowCount();
    if($result > 0){
        $UserInfo = $statement->fetchAll();
         foreach($UserInfo as $row)
		  {
            $status = $row['status'];
            $code = $row['code'];
		   }
        if($status == "verified"){
            if($code != 0){
               header('Location: reset-code.php');
            }
        }else{
           header('Location: user-otp.php');
        }
    }
}else{
  // header('Location: login-user.php');
  echo '<script>
 
  window.location = "login-user.php";
  
  </script>';
}
  //ob_end_clean();
?>


<!doctype html>
<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ameemca | User </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

    <link rel="shortcut icon" href="./favicon/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <!-- Bamburgh HTML5 Admin Dashboard with Bootstrap Free Stylesheets -->
    <link rel="stylesheet" type="text/css" href="./assets/css/bamburgh.min.css">
 <script type="text/javascript" src="./assets/js/jquery.min.js"></script>

 <link rel="stylesheet" type="text/css" href="./assets/css/dataTables.bootstrap4.min.css"/>
 <script type="text/javascript" src="./assets/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>

<!-- Bamburgh HTML5 Admin Dashboard with Bootstrap Free Javascript Core -->

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    

    <script src="./assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!--Bootstrap init-->

    <script src="./assets/js/demo/bootstrap/bootstrap.min.js"></script>

    <!--Perfect scrollbar-->

    <script src="./assets/vendor/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>

    <!--Perfect scrollbar init-->

    <script src="./assets/js/demo/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!--Layout-->

    <script src="./assets/js/bamburgh.min.js"></script>
<script>
    // hide right mouse click menu
    //document.oncontextmenu = new Function('return false');
    $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
        
         $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>
<style>
    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
-webkit-appearance: none; 
   margin: 0; 
}
</style>
</head>

<body id="app-top">

    <div class="app-wrapper">
        <div class="app-sidebar  app-sidebar--dark ">
            <div class="app-sidebar--header">
                <div class="nav-logo w-100 text-center">
                    <a href="index.php" class="d-block" data-toggle="tooltip" title="My Dashboard">
                        <img src="../assets/images/logowhite.svg" width="160">
                    </a>
                </div>
            </div>
            <?php
$path = $_SERVER['SCRIPT_NAME'];
$filenameExt = basename($path);          // "index.php"
$filename    = basename($path, ".php"); 
$currentpage = $filename.".php";
?>
            <div class="app-sidebar--content scrollbar-container">
                <div class="sidebar-navigation">
                    <ul id="sidebar-nav">
                        <li class="sidebar-header"></li>
                        <li <?php if($currentpage=="index.php") { ?>  class="mm-active"   <?php   }  ?>> 
                            <a href="index.php" aria-expanded="true">
                                <span>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li class="sidebar-header">
                            
                        </li>
                        <li <?php if($currentpage=="account-history.php") { ?>  class="mm-active"   <?php   }  ?>>
                            <a href="account-history.php">
                                <span>
                <i class="fas fa-fill-drip"></i>
                <span>Account Summary</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                         <li <?php if($currentpage=="contribution.php") { ?>  class="mm-active"   <?php   }  ?>>
                            <a href="contribution.php">
                                <span>
                <i class="fas fa-fill-drip"></i>
                <span>Contribution History</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li  <?php if($_SERVER['SCRIPT_NAME']=="/deposit.php") { ?>  class="mm-active "   <?php   }  ?> >
                            <a href="deposit.php">
                                <span>
                <i class="fas fa-university"></i>
                <span>Savings Wallet</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                      
                        <li <?php if($_SERVER['SCRIPT_NAME']=="/loan.php") { ?>  class="mm-active"   <?php   }  ?>>
                            <a href="loan.php">
                                <span>
                <i class="fas fa-space-shuttle"></i>
                <span>Loan Request</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="loan-history.php">
                                <span>
                <i class="fas fa-address-book"></i>
                <span>Loan History</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        
               
                           <li <?php if($_SERVER['SCRIPT_NAME']=="/withdraw.php") { ?>  class="mm-active"   <?php   }  ?>>
                            <a href="withdraw.php">
                                <span>
                <i class="fas fa-shuttle-van"></i>
                <span>Withdraw Funds</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        
                        
                          <li <?php if($_SERVER['SCRIPT_NAME']=="/myallotment.php") { ?>  class="mm-active"   <?php   }  ?>>
                            <a href="myallotment.php">
                                <span>
                <i class="fas fa-shuttle-van"></i>
                <span>My Allotment</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        
                        
                          <li <?php if($_SERVER['SCRIPT_NAME']=="/settings.php") { ?>  class="mm-active"   <?php   }  ?>>
                         <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                                <span>
                <i class="fas fa-cog"></i>
                <span>Settings</span>
                                </span>
                            </a>
                            <style>
    #pageSubmenu.collapse{
        display:none
    }
     #pageSubmenu.collapse.show{
        display:block
    }
</style>
                         <ul class="collapse list-unstyled" id="pageSubmenu" style="border-left: 2px solid hsl(0deg 0% 100% / 50%);margin-left: 15px;color: hsla(0,0%,100%,.5);">
                          
                        <li>
                            <a href="banklist">Bank Manager</a>
                        </li>
                        <li>
                            <a href="update-bio">My Account</a>
                        </li>
                       <!-- <li>
                            <a href="upgrade">Upgrade Account</a>
                        </li>-->
                    </ul>

                        </li>
                        
                        
                          <li <?php if($_SERVER['SCRIPT_NAME']=="/ticket.php") { ?>  class="mm-active"   <?php   }  ?>>
                            <a href="ticket.php">
                                <span>
                <i class="fas fa-comments"></i>
                <span>Support</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        
                        
                         <li <?php if($_SERVER['SCRIPT_NAME']=="/conversion.php") { ?>  class="mm-active"   <?php   }  ?>>
                            <a href="conversion.php">
                                <span>
                <i class="fas fa-comments"></i>
                <span>Wallet Deduction</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        
                
                    </ul>
                </div>

            </div>
            </div>
        <div class="sidebar-mobile-overlay"></div>

        <div class="app-main">
            <div class="app-header">
                <div class="d-flex">
                    <button class="navbar-toggler hamburger hamburger--elastic toggle-sidebar-mobile" type="button">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
                    
                </div>
                <div class="d-flex align-items-center">
                    <div class="user-box dropdown ml-3">
                        <a href="#" class="p-0 d-flex align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                            
                            
                            <div class="d-flex align-items-center" style="background: #d1d2db;padding: 0px 0px;border-radius: 1.66rem 25px 25px 1.66rem !important">
                          
                            <div class="d-block p-0">
                                <img class="d-44 rounded" src="<?php echo getUserInfo("photo"); ?>" style="height: 34px;width: 34px;">
                            </div>
                            <div class="d-none d-md-block pl-2 pr-2">
                                <div class="font-weight-bold">
                                    <?php echo ucfirst(getUserInfo("fname"));?>
                                </div>
                            </div>
                            </div>
                            
                            
                            <span class="pl-3"><i class="fas fa-angle-down opacity-5"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="profile">My Profile</a>
                            <a class="dropdown-item" href="logout-user">Log out</a>
                        </div>
                    </div>
                </div>
            </div>
          
