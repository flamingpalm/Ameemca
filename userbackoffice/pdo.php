<?php
 require_once("DB.php");

$staffid = $_SESSION['staffid'];
  


function getUserInfo($field){
     global $connect, $staffid;
     $output = '';
	 $data = array(':staffid'=> $staffid);
    $query = "SELECT $field FROM usertable WHERE staffid = :staffid LIMIT 1";
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
 
      
      //get user ip
 function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


function getUserInfoByStaffID($field, $staffid){
     global $connect;
     $output = '';
	 $data = array(':staffid'=> $staffid);
    $query = "SELECT $field FROM usertable WHERE staffid = :staffid LIMIT 1";
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
      
      
                
         function getUserList(){
                   global $connect, $staffid;
	                $data = array(':staffid'=> $staffid, ':status'=> "verified");
                    
                $query = "SELECT * FROM usertable
                WHERE status = :status
                AND staffid NOT IN (:staffid)";
                $statement = $connect->prepare($query);
                $statement->execute($data);
                $result = $statement->fetchAll();
                $output = '<option value="" selected="" disabled="">-Select Staff-</option>';
                foreach($result as $row)
		          {
		             $output .= '<option value="'.$row["staffid"].'">'.ucwords($row["fname"].' '.$row["lname"]).'</option>';
	              }
	              return $output;
                }
                                

            function getUserBankList(){
                   global $connect, $staffid;
	                $data = array(':staffid'=> $staffid);
                    
                $query = "SELECT * FROM userbank
                INNER JOIN banks
                ON userbank.bank_id = banks.id
                WHERE userbank.staffid = :staffid";
                $statement = $connect->prepare($query);
                $statement->execute($data);
                $result = $statement->fetchAll();
                $output = '<option value="" selected="" disabled="">-Select Bank-</option>';
                foreach($result as $row)
		          {
		             $output .= '<option value="'.$row["bank_id"].'" data-code="'.$row["bankcode"].'">'.$row["bankname"].'</option>';
	              }
	              return $output;
                }
?>

            