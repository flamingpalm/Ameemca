<?php
$servername = "localhost";
$dbname = "ameemcan_lo";
$username = "ameemcan_bliss";
$password = "fpEOn{x)t3in";


try {
  $connect = new PDO("mysql:host=$host;dbname=$dbname" ,$username, $password);
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
     // die("Connect Error: " . $e->getMessage());
}


$base_url = 'https://ameemca.ng/';
$adminFolder = $base_url.'a/';
$userFolder = $base_url.'userbackoffice/';

//Paystack Keys
$public_key_live = getSystemSetting('paystack_live_publickey');
$secket_key_live = getSystemSetting('paystack_live_secretkey');

$public_key_test = getSystemSetting('paystack_test_publickey');
$secket_key_test = getSystemSetting('paystack_test_secretkey');




session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
date_default_timezone_set('Africa/Lagos');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(1);



//include_once '../../libraries/modules/sanitizeForm.php';
 
 function getSystemSetting($field){
     global $connect;
     $output = '';
	 $data = array(':id'=> 1);
     $query = "SELECT $field FROM settings WHERE id = :id LIMIT 1";
            $statement = $connect->prepare($query);
            if($statement->execute($data)){
                $result = $statement->fetchAll();
                foreach($result as $row)
		          {
		             $output = $row[$field];
	              }
            } else {
                    $output = 'Error';
            }
	   return $output;
}


 //*****FOR REGISTRATION OF NEW USER*******//
function initAccountBalance($sid){
       global $connect;
            $data = array(
                        ':staffid'=> $sid,
                        ':balance'=> 0,
                        ':time'=> time()
                        );
             $query = "INSERT INTO account_balance (staffid, balance, time)
                     VALUES (:staffid, :balance, :time)";
                    $statement = $connect->prepare($query);
                    if($statement->execute($data)){
                      return true;
                     }else{
                     return false;
                    }
}
                                    

function initContributionBalance($sid){
       global $connect;
            $data = array(
                        ':staffid'=> $sid,
                        ':amount'=> 0,
                        ':date'=> date('Y-m-d')
                        );
             $query = "INSERT INTO contributions (staffid, amount, date)
                     VALUES (:staffid, :amount, :date)";
                    $statement = $connect->prepare($query);
                    if($statement->execute($data)){
                      return true;
                     }else{
                     return false;
                    }
}


function initLoanBalance($sid){
       global $connect;
            $data = array(
                        ':staffid'=> $sid,
                        ':balance'=> 0,
                        ':time'=> time()
                        );
             $query = "INSERT INTO loan_balance (staffid, balance, time)
                     VALUES (:staffid, :balance, :time)";
                    $statement = $connect->prepare($query);
                    if($statement->execute($data)){
                      return true;
                     }else{
                     return false;
                    }
} 
      
      
//for reg
function getPackagePriceByID($id){
    global $connect;
	 $data = array(':id'=> $id);
     $query = "SELECT * FROM package WHERE id = :id";
     $statement = $connect->prepare($query);
     $statement->execute($data);
     $result = $statement->fetchAll();
      $output = '';
      foreach($result as $row)
		   {
		      $output .= $row["package_price"];
	        }
	   return $output;
 }


//FOR IMAGE PROCESSING
function uploadUserImage($file, $path) {
if(move_uploaded_file($file, $path)){
$height = 413;  $width = 531; $quality = 60;
Resize_Crop_Image($height, $width, $path, $path, $quality);
     return true;
} else {
	return false;
}
}

function Resize_Crop_Image($max_width, $max_height, $sourceFilePath, $destinationPath, $quality = 80) {
    $imgsize = @getimagesize($sourceFilePath);
    $width   = $imgsize[0];
    $height  = $imgsize[1];
    $mime    = $imgsize['mime'];
    $image   = "imagejpeg";
    switch ($mime) {
        case 'image/gif':
            $image_create = "imagecreatefromgif";
            break;
        case 'image/png':
            $image_create = "imagecreatefrompng";
            break;
        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            break;
        default:
            return false;
            break;
    }
    $dst_img = @imagecreatetruecolor($max_width, $max_height);
    $src_img = @$image_create($sourceFilePath);
    if (function_exists('exif_read_data')) {
        $exif          = @exif_read_data($sourceFilePath);
        $another_image = false;
        if (!empty($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 3:
                    $src_img = @imagerotate($src_img, 180, 0);
                    @imagejpeg($src_img, $destinationPath, $quality);
                    $another_image = true;
                    break;
                case 6:
                    $src_img = @imagerotate($src_img, -90, 0);
                    @imagejpeg($src_img, $destinationPath, $quality);
                    $another_image = true;
                    break;
                case 8:
                    $src_img = @imagerotate($src_img, 90, 0);
                    @imagejpeg($src_img, $destinationPath, $quality);
                    $another_image = true;
                    break;
            }
        }
        if ($another_image == true) {
            $imgsize = @getimagesize($destinationPath);
            if ($width > 0 && $height > 0) {
                $width  = $imgsize[0];
                $height = $imgsize[1];
            }
        }
    }
    
    @$width_new = $height * $max_width / $max_height;
    @$height_new = $width * $max_height / $max_width;
    if ($width_new > $width) {
        $h_point = (($height - $height_new) / 2);
        @imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    } else {
        $w_point = (($width - $width_new) / 2);
        @imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    }
    
    @imagejpeg($dst_img, $destinationPath, $quality);
    if ($dst_img)
        @imagedestroy($dst_img);
    if ($src_img)
        @imagedestroy($src_img);
    return true;
}



function getLoanBalance($sid){
            global $connect;
        $data = array(':staffid'=> $sid);
	    $query = "
	    SELECT balance FROM loan_balance
	    INNER JOIN usertable 
		ON loan_balance.staffid = usertable.staffid
		WHERE loan_balance.staffid = :staffid
		GROUP BY loan_balance.staffid
		ORDER BY loan_balance.id DESC
		LIMIT 1
		";
		$statement = $connect->prepare($query);
		$balance = 0;
        if($statement->execute($data)){
            $result = $statement->fetchAll();
            foreach($result as $row)
		       {
	                $balance = $row["balance"];
    	       }
        }

        return $balance;
	   }  
	   
	   
function getAccountBalance($sid){
            global $connect;
		 $data = array(':staffid'=> $sid);
	    $query = "
	    SELECT balance FROM account_balance
	    INNER JOIN usertable 
		ON account_balance.staffid = usertable.staffid
		WHERE account_balance.staffid = :staffid
		GROUP BY account_balance.staffid
		ORDER BY account_balance.id DESC
		LIMIT 1
		";
		$statement = $connect->prepare($query);
		$balance = 0;
        if($statement->execute($data)){
            $result = $statement->fetchAll();
            foreach($result as $row)
		       {
	                $balance = $row["balance"];
    	       }
        }

        return $balance;
	   }  
    
       
	   
 function getContributionBalance($sid){
                global $connect;
        $data = array(':staffid'=> $sid);
	    $query = "
        	SELECT SUM(b.amount) AS total_contribution
            FROM usertable a
            INNER JOIN contributions b
            ON a.staffid = b.staffid
            WHERE a.staffid = :staffid 
            GROUP by a.staffid
		";
		$statement = $connect->prepare($query);
		$balance = 0;
        if($statement->execute($data)){
            $result = $statement->fetchAll();
            foreach($result as $row)
		       {
	                $balance = $row["total_contribution"];
    	       }
        }
        return $balance;
	   }  
	   	   
	   	   
function generateStaffid(){
    global $connect;
$prefixNo = 210001;
$query ="SELECT staffid FROM usertable";
 $statement = $connect->prepare($query);
$statement->execute();
$count = $statement->rowCount();
return  $prefixNo+$count;
}   	   
	   	   
	   	   
function getBankList(){
    global $connect;
$query = "SELECT * FROM banks";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$output = '<option value="" selected disabled>-Select Bank-</option>';
foreach($result as $row)
  {
     $output .= '<option value="'.$row["id"].'" data-code="'.$row["bankcode"].'">'.$row["bankname"].'</option>';
  }
  return $output;
}
                
                
                
                
                
                //sanitize email
function sanitizeEmail($value){
$value = strip_tags($value);
$value = stripslashes($value);
$value = htmlspecialchars($value, ENT_QUOTES);
$value = filter_var($value, FILTER_SANITIZE_EMAIL);
$value = preg_replace('/[\r\n|\n\r|\r|\n|\t|\0|\x0B|\s\s]+/', " ", $value);
$value = trim($value);
$value = strtolower($value);  
//Injection Sanitization
$splitOne = explode('@', $value);
$value = preg_replace('/[\+]+/', '+', $splitOne[0]);
$value = explode('+', $value);
$value = $value[0].'@'.$splitOne[1];
return $value;
 } 
//sanitize text
function sanitizeText($value){
$value = strip_tags($value);
$value = stripslashes($value);
$value = preg_replace('/[^A-Za-z0-9\-]/', ' ', $value);
$value = filter_var($value, FILTER_SANITIZE_STRING);
$value = trim($value);
return $value;
}
//sanitize phone
function sanitizeNumber($value){
$value = strip_tags($value);
$value = stripslashes($value);
$value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
$value = trim($value);
return $value;
 }  
//sanitize password
function sanitizePassword($value){ 
$value = strip_tags($value);
$value = preg_replace('/[\r\n|\n\r|\r|\n|\t|\0|\x0B|\s\s]+/', " ", $value);
$value = trim($value);
return $value;
} 
 
 function sanitizeUrl($value){
$value = strip_tags($value);
$value = stripslashes($value);
$value = preg_replace('/[^A-Za-z0-9\-]/', ' ', $value);
$value = filter_var($value, FILTER_SANITIZE_URL);
$value = trim($value);
return $value;
}
	   