<?php
 require_once("DB.php");
$admin_id = $_SESSION['admin_id'];
// function getUserInfo($field){
//      global $connect, $staffid;
//      $output = '';
// 	 $data = array(':staffid'=> $staffid);
//     $query = "SELECT $field FROM usertable WHERE staffid = :staffid LIMIT 1";
//                 $statement = $connect->prepare($query);
//             if($statement->execute($data)){
//                 $result = $statement->fetchAll();
//                 foreach($result as $row)
// 		          {
// 		             $output = $row[$field];
// 	              }
//             } else {
//                     $output = 'Error';
//             }
// 	   return $output;
// }
      
      
      
      
//       //get user ip
//  function getUserIpAddr(){
//     if(!empty($_SERVER['HTTP_CLIENT_IP'])){
//         //ip from share internet
//         $ip = $_SERVER['HTTP_CLIENT_IP'];
//     }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
//         //ip pass from proxy
//         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//     }else{
//         $ip = $_SERVER['REMOTE_ADDR'];
//     }
//     return $ip;
// }



 function getBankList(){
                    global $connect;
                $query = "SELECT * FROM banks";
                $statement = $connect->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                $output = '<option value="" selected disabled>-Select Bank-</option>';
                foreach($result as $row)
		          {
		             $output .= '<option value="'.$row["bankcode"].'" data-code="'.$row["bankcode"].'" data-id="'.$row["bankcode"].'">'.$row["bankname"].'</option>';
	              }
	              return $output;
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
      
function getTotalSignUpBalance(){
        global $connect;
	    $query = "SELECT SUM(reg_fee) AS net_balance FROM usertable";
		$statement = $connect->prepare($query);
		$balance = 0.00;
        if($statement->execute()){
            $result = $statement->fetchAll();
            foreach($result as $row)
		       {
	                $balance = $row["net_balance"];
    	       }
        }
        return $balance;
	   }      
	   
function getTotalExpenditureBalance(){
        global $connect;
	    $query = "SELECT SUM(amount) AS net_balance FROM expenditure";
		$statement = $connect->prepare($query);
		$balance = 0.00;
        if($statement->execute()){
            $result = $statement->fetchAll();
            foreach($result as $row)
		       {
	                $balance = $row["net_balance"];
    	       }
        }
        return $balance;
	   }      


function getTotalBalance(){
		$balance = (getTotalContribution() + getTotalSignUpBalance() - getTotalExpenditureBalance() - getTotalLoan());
		return 	$balance;
	   }  



function getTotalWalletBalance(){
        global $connect;
	    $query = "SELECT SUM(balance) AS net_balance FROM account_balance";
		$statement = $connect->prepare($query);
		$balance = 0.00;
        if($statement->execute()){
            $result = $statement->fetchAll();
            foreach($result as $row)
		       {
	                $balance = $row["net_balance"];
    	       }
        }
        return $balance;
	   }  
    
       function getTotalLoan(){
             global $connect;
	    $query = "
		SELECT SUM(balance) AS net_balance FROM loan_balance
		";
		$statement = $connect->prepare($query);
		$balance = 0.00;
        if($statement->execute()){
            $result = $statement->fetchAll();
            foreach($result as $row)
		       {
	                $balance = $row["net_balance"];
    	       }
        }
        return $balance;
	   }  
	   
	   
	   function getTotalContribution(){
                global $connect;
	    $query = "
		SELECT SUM(amount) AS net_balance FROM contributions
		";
		$statement = $connect->prepare($query);
		$balance = 0.00;
        if($statement->execute()){
            $result = $statement->fetchAll();
            foreach($result as $row)
		       {
	                $balance = $row["net_balance"];
    	       }
        }
        return $balance;
	   }  
	   
?>

            