<?php
require_once("PH.php");



if($admin_id != false){
    $data = array(':id'=> $admin_id);
    $query = "SELECT * FROM admin WHERE id = :id";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $result = $statement->rowCount();
    if($result == 0){
       header('Location: login-user.php');
       exit();
    }
} else {
     header('Location: login-user.php');
       exit();
}
?>
<!doctype html>
<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ameemca Backend</title>
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
    $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
</script>

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
                        
                        
                         <li <?php if($currentpage=="expenditure.php") { ?>  class="mm-active"   <?php   }  ?>> 
                            <a href="expenditure.php" aria-expanded="true">
                                <span>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Expenditure</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        
                         <li <?php if($currentpage=="upgrade.php") { ?>  class="mm-active"   <?php   }  ?>> 
                            <a href="upgrade.php" aria-expanded="true">
                                <span>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Account Upgrade</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                       
                        
                       
                         <li <?php if($currentpage=="members.php") { ?>  class="mm-active"   <?php   }  ?>> 
                            <a href="members.php" aria-expanded="true">
                                <span>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Members Account</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        
                        <li <?php if($currentpage=="loans.php") { ?>  class="mm-active"   <?php   }  ?>> 
                            <a href="loans.php" aria-expanded="true">
                                <span>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Loans</span>
                                </span>
<?php
    $data = array(':status'=> 'pending');
    $query = "SELECT id FROM loan_request WHERE status = :status";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $result = $statement->rowCount();
    if($result > 0){
       echo '<div style="background: #ca2129;color:#fff;font-weight:bold;padding: 0;min-width: 35px;min-height: 35px;text-align: center;margin: 0 auto;line-height: 35px;border-radius: 100%;">'.$result.'</div>';
} else {
      echo '';
}
?> 
            <i class="fas fa-chevron-right"></i>
                            </a>
                        </li> 
                        
                        <li <?php if($currentpage=="allotmentrecords.php") { ?>  class="mm-active"   <?php   }  ?>> 
                            <a href="allotmentrecords.php" aria-expanded="true">
                                <span>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Allotment Records</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li> 
                        
                         <li <?php if($currentpage=="membersallotment.php") { ?>  class="mm-active"   <?php   }  ?>> 
                            <a href="membersallotment.php" aria-expanded="true">
                                <span>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Members Allotment</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li> 
                        
                        <li <?php if($currentpage=="payment.php") { ?>  class="mm-active"   <?php   }  ?>> 
                            <a href="payment.php" aria-expanded="true">
                                <span>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Payment</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li> 
                        
                        <li <?php if($currentpage=="contributions.php") { ?>  class="mm-active"   <?php   }  ?>> 
                            <a href="contributions.php" aria-expanded="true">
                                <span>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Contributions</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li> 
                        
                        <!--   <li <?php if($currentpage=="statsboard.php") { ?>  class="mm-active"   <?php   }  ?>> 
                            <a href="statsboard.php" aria-expanded="true">
                                <span>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Stats Board</span>
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li> -->
                        
                        
                           <li <?php if($currentpage=="conversion.php") { ?>  class="mm-active"   <?php   }  ?>> 
                            <a href="conversion.php" aria-expanded="true">
                                <span>
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Wallet Deduction</span>
                                </span>
                               <?php
    $data = array(':status'=> 'notapproved');
    $query = "SELECT id FROM conversion WHERE status = :status";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $result = $statement->rowCount();
    if($result > 0){
       echo '<div style="background: #ca2129;color:#fff;font-weight:bold;padding: 0;min-width: 35px;min-height: 35px;text-align: center;margin: 0 auto;line-height: 35px;border-radius: 100%;">'.$result.'</div>';
} else {
      echo '';
}
?> 
<i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        
                        
                          <!--<li <?php if($_SERVER['SCRIPT_NAME']=="/settings.php") { ?>  class="mm-active"   <?php   }  ?>>
                         <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                                <span>
                <i class="fas fa-cog"></i>
                <span></span>
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
                            <a href="">Upload</a>
                        </li>
                    </ul>

                        </li>-->
                        
                        
                
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
                            
                            
                            
                            
                            
                            <span class="pl-3"><i class="fas fa-angle-down opacity-5"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            
                            <a class="dropdown-item" href="logout-user">Log out</a>
                        </div>
                    </div>
                </div>
            </div>