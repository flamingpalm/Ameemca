<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'transport/Exception.php';
require 'transport/PHPMailer.php';
require 'transport/SMTP.php';
//require 'smtp-config.php';






 
$smtphost = "smtp.gmail.com";
//$smtpuser = "";
//$smtppass = "";
$smtpuser = 'info@ameemca.ng';
$smtppass = 'jCVv0mwxOho3';
$smtpsecure= "tls";
$smtpport = 587;

//Mail Setup
$mailname = "Ameemca";
$mailemail = "noreply@ameemca.ng";
$mailreply = "";

//ContactUs
$contactSubject= "Contact Notification";
$moderator= "support@ameemca.ng";




class Mail {
        public static function sendMail($subject, $body, $address) {
        	
global $smtphost, $smtpsecure, $smtpport, $smtpuser, $smtppass;

// Instantiation
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host  = $smtphost; 
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtpuser;
    $mail->Password   = $smtppass;
    $mail->SMTPSecure = $smtpsecure;
    $mail->Port       = $smtpport;    
    $mail->SMTPKeepAlive = true;   
    $mail->Mailer = “smtp”; // don't change the quotes!
//Recipients
    $mail->setFrom($username, 'STK');
    $mail->addAddress($address);
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;

			 if(!$mail->send()){
				 // echo 'Message not sent';
 				 return false;
				  } else {
 						 // echo 'Message has been sent';
  				 return true;
   				}
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
  }
        
  
  
  
  
  
  
  
        

  //ContactUs Form
public static function notifyUser($subject, $receiver, $body) {

//globals     	
global $smtphost, $smtpsecure, $smtpport, $smtpuser, $smtppass, $moderator, $mailemail, $mailname;

// Instantiation
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host  = $smtphost; 
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtpuser;
    $mail->Password   = $smtppass;
    $mail->SMTPSecure = $smtpsecure;
    $mail->Port       = $smtpport;                                   
    
	/*$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
   	 		)
	);*/

//Recipients
    $mail->setFrom($mailemail, $mailname);
    $mail->addAddress($receiver);
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;

			 if(!$mail->send()){
				 // echo 'Message not sent';
 				 return false;
				  } else {
 		         // echo 'Message has been sent';
  				 return true;
   				}
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
  }




 //ContactUs Form
public static function cpanelMailer($subject, $receiver, $body) {

//globals     	
global $smtphost, $smtpsecure, $smtpport, $smtpuser, $smtppass, $moderator, $mailemail, $mailname;

// Instantiation
$mail = new PHPMailer(true);

try {
 $mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = gethostname();
$mail->SMTPAuth = true;
    $mail->Username   = $smtpuser;
    $mail->Password   = $smtppass;
// $mail->Username = 'info@ameemca.ng';
// $mail->Password = 'jCVv0mwxOho3';
 $mail->setFrom($mailemail, $mailname);
    $mail->addAddress($receiver);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;



			 if(!$mail->send()){
				 // echo 'Message not sent';
 				 return false;
				  } else {
 		         // echo 'Message has been sent';
  				 return true;
   				}
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
  }


}













//Templates

function guarantorNotify($email, $name,  $borrower, $acceptlink, $declinelink, $loanAmount){
	
	$mailbody ='
	<div style="margin:0;padding:0;background-color:#FFFFFF;">
	<table width="100%" height="100%" style="min-width:348px" border="0" cellspacing="0" cellpadding="0" lang="en">
	<tbody>
	<tr height="32" style="height:32px">
	<td></td>
</tr>
	<tr align="center">
	<td>
	<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:20px;max-width:516px;min-width:220px">
	<tbody>
	<tr>
<td width="10" style="width:10px"><td>
	<div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center">
	<p style="margin:0;padding:0; max-width: 1137px;font-size:18px;font-weight:400;">
Guarantor Request Notification
</p>
	<div style="font-family:Roboto,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;padding-top:24px;text-align:center;word-break:break-word">
	<div style="text-align:center;padding-bottom:16px;line-height:0">
	<img height="60" src="https://ameemca.ng/assets/images/logo.svg" style="max-width: 1137px;">
</div>
	<div style="font-size:24px">
	Ameemca
</div>
	<table align="center" style="margin-top:8px">
	<tbody>
	<tr style="line-height:normal">
	<td align="right" style="padding-right:8px">
	</td>
	<td>
	<a style="font-family:Roboto,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.87);font-size:14px;line-height:20px">
	'.$email.'</a></td></tr></tbody></table></div>
	<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:left">
	Dear '.$name.':<br>
	'.$borrower.':, has requested for you to be a guarantor to this loan.
<br>
Here is the loan details:
	<div style="margin:0;padding:0;text-align: center;">
		<p style="background-color: #e1e1e1; border-radius:8px;padding:10px;margin:15px 0 20px 0;">
<strong>Name:</strong> '.$borrower.'
<br>
<strong>Loan Amount:</strong> N'.$loanAmount.'
</p>
By accepting to be a guarantor to this loan request, you agree to act as a referee / guarantor for this user.
<br>
Please ensure that you read our guarantors <a href="#">policy</a> to avoid violations of our rules.
<strong>
</div>
<div style="padding-top:32px;text-align:center">
	<a href="'.$acceptlink.'" style="font-family:Roboto,Helvetica,Arial,sans-serif;line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#00ad5f;border-radius:5px;min-width:90px" target="_blank">
	Accept</a>
	<a href="'.$declinelink.'" style="font-family:Roboto,Helvetica,Arial,sans-serif;line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#ca2129;border-radius:5px;min-width:90px" target="_blank">
	Decline</a>
</div>
</div>
<br>
For further enquiries, Kindly contact us at info@ameemca.ng
<br>Best Regards.</div>
	<div style="text-align:left">
	<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
	<div>
	You received this email because you where refrenced in a loan request on Ameemca.
</div>
	<div style="direction:ltr">
	© '.date("Y").'.
<a style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
	Ameemca.ng
</a></div></div></div></td>
	<td width="10" style="width:10px"></td></tr></tbody></table></td></tr>
	<tr height="32" style="height:32px">
	<td></td></tr></tbody></table></div>
	';
	return $mailbody;
	}




function adminLoanNotify($email, $name,  $borrower, $acceptlink, $declinelink, $loanAmount, $loanBalance, $contributionBalance ,$walletBalance){
	
	$mailbody ='
	<div style="margin:0;padding:0;background-color:#FFFFFF;">
	<table width="100%" height="100%" style="min-width:348px" border="0" cellspacing="0" cellpadding="0" lang="en">
	<tbody>
	<tr height="32" style="height:32px">
	<td></td>
</tr>
	<tr align="center">
	<td>
	<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:20px;max-width:516px;min-width:220px">
	<tbody>
	<tr>
<td width="10" style="width:10px"><td>
	<div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center">
	<p style="margin:0;padding:0; max-width: 1137px;font-size:18px;font-weight:400;">
Loan Request Notification
</p>
	<div style="font-family:Roboto,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;padding-top:24px;text-align:center;word-break:break-word">
	<div style="text-align:center;padding-bottom:16px;line-height:0">
	<img height="60" src="https://ameemca.ng/assets/images/logo.svg" style="max-width: 1137px;">
</div>
	<div style="font-size:24px">
	Ameemca
</div>
	<table align="center" style="margin-top:8px">
	<tbody>
	<tr style="line-height:normal">
	<td align="right" style="padding-right:8px">
	</td>
	<td>
	<a style="font-family:Roboto,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.87);font-size:14px;line-height:20px">
	'.$email.'</a></td></tr></tbody></table></div>
	<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:left">
	Dear '.$name.':<br>
	'.$borrower.':, has requested for a loan.
<br>
Here is the loan details:
	<div style="margin:0;padding:0;text-align: center;">
		<p style="background-color: #e1e1e1; border-radius:8px;padding:10px;margin:15px 0 20px 0;">
<strong>Name:</strong> '.$borrower.'
<br>
<strong>Loan Amount:</strong> N'.$loanAmount.'
<br>
<strong>Outstanding Loan Balance:</strong> N'.$loanBalance.'
<br>
<strong>Contribution Balance:</strong> N'.$contributionBalance.'
<br>
<strong>Wallet Balance:</strong> N'.$walletBalance.'
</p>
Kindly login to properly review this loan.
<br>
Please ensure that you review this loan with integrity.
<strong>
</div>
<div style="padding-top:32px;text-align:center">
	<a href="'.$acceptlink.'" style="font-family:Roboto,Helvetica,Arial,sans-serif;line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#00ad5f;border-radius:5px;min-width:90px" target="_blank">
	Accept</a>
	<a href="'.$declinelink.'" style="font-family:Roboto,Helvetica,Arial,sans-serif;line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#ca2129;border-radius:5px;min-width:90px" target="_blank">
	Decline</a>
</div>
</div>
<br>
For further enquiries, Kindly contact us at info@ameemca.ng
<br>Best Regards.</div>
	<div style="text-align:left">
	<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
	<div>
	You received this email because you where refrenced in a loan request on Ameemca.
</div>
	<div style="direction:ltr">
	© '.date("Y").'.
<a style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
	Ameemca.ng
</a></div></div></div></td>
	<td width="10" style="width:10px"></td></tr></tbody></table></td></tr>
	<tr height="32" style="height:32px">
	<td></td></tr></tbody></table></div>
	';
	return $mailbody;
	}





//Signup 



function signupNotify($useremail, $username, $code, $staffid){
$body = '<html>
<head>
    <title>
Email Notify
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass * {
            line-height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        p {
            display: block;
            margin: 13px 0;
        }
    </style>
    <style type="text/css">
        @media only screen and (max-width:480px) {
            @-ms-viewport {
                width: 320px;
            }
            @viewport {
                width: 320px;
            }
        }
    </style>
    <style type="text/css">
        @media only screen and (min-width:480px) {
            .mj-column-per-100 {
                width: 100% !important;
            }
        }
    </style>
    <style type="text/css">
    </style>

</head>
<body style="background-color:#f9f9f9;">


    <div style="background-color:#f9f9f9;">


        


        <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:600px;">

            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;">
                <tbody>
                    <tr>
                        <td style="border-bottom: #ca2129 solid 5px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
              
                  </table>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>


        


        <div style="background:#fff;background-color:#fff;Margin:0px auto;max-width:600px;">

            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;">
                <tbody>
                    <tr>
                        <td style="border:#dddddd solid 1px;border-top:0px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                            

                            <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">

                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:bottom;" width="100%">

                                    <tbody><tr>
                                        <td align="center" style="padding:10px 25px;word-break:break-word;">

                                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                <tbody>
                                                    <tr>
                                                        <td>

                                                            <img height="auto" src="https://ameemca.ng/assets/images/logo.svg" style="border:0;display:block;outline:none;text-decoration:none;width:100%;" width="100">

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center" style="padding:10px 25px;padding-bottom:40px;word-break:break-word;">

                                            <div style="font-size:28px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                Welcome to Ameemca
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="left" style="padding:10px 25px;word-break:break-word;">

                                            <div style="font-family:font-size:16px;line-height:22px;text-align:left;color:#555;">
Hello <b>'.ucfirst($username).'</b> ('.$useremail.')<br><br>
Welcome to Ameemca. We are delighted to have you with us. <br>
<br>Before we proceed to setting up your account, we need to verify your identity.
<br><br>
Below is the verification code and your membership identity code. Kindly adhere to the instruction stated under them.</div>
  </td>
                                    </tr>

                                    <tr>
                                        <td align="left"><br>
<div align="left" style="border-radius: 10px;background:#e1e1e1;padding: 20px;margin: 0 40px;word-break:break-word;">

 <p style="color: #000000;font-size:15px;font-weight:normal;line-height:120%;Margin:0;margin-bottom: 13px;text-decoration:none;text-transform:none;">
     <b>VERIFICATION CODE:</b> '.$code.'
    <br>
    (Copy this code, return to your browser and paste it. Expires after usage)
</p>
<p style="color: #000000;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;">
    <b>MEMBERSHIP ID:</b> '.$staffid.'
    <br>
    (This is your unique membership id, we request for it and your password when signing you in)
</p>
</div>
</td>
                                    </tr>

                                    <tr>
                                        <td align="left" style="padding:10px 25px;word-break:break-word;">
<br><br>
                                            <div style="font-family:font-size:14px;line-height:20px;text-align:left;color:#525252;">
                                                <b>Best regards,<br>Ameemca President.<br></b>
                                                <a href="https://www.ameemca.ng" style="color:#2F67F6">ameemca.ng</a>
                                            </div>

                                        </td>
                                    </tr>

                                </tbody></table>

                            </div>

                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
 </div>
</body></html>';

return $body;
}











?>
