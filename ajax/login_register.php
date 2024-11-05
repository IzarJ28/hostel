<?php

require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
require '../inc/PHPMailer/src/Exception.php';
require '../inc/PHPMailer/src/PHPMailer.php';
require '../inc/PHPMailer/src/SMTP.php';

date_default_timezone_set("Asia/Manila");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//sending email
function send_mail($uemail, $token,$type) {

    if ($type == "email_confirmation"){
        $page = 'email_confirm.php';
        $subject = "Accoun Verification Link";
        $content = "confirm your email";
    }
    else{
        $page = 'index.php';
        $subject = "Account Reset Link";
        $content = "reset your account";
    }
   
    require '../vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                      // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username = 'erllaparan06@gmail.com'; // Your Gmail address
        $mail->Password = 'toqo ozcq shdq zxxo'; // App-specific password if 2FA is enabled
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption
        $mail->Port       = 465;                                    // TCP port to connect to
        
        // $mail->SMTPDebug = 2; 

        // Recipients
        $mail->setFrom('erllaparan06@gmail.com', 'BATANGAS STATE UNIVERSITY-ASASOF HOSTEL');
        $mail->addAddress($uemail);                          // Add a recipient

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "Click the link to  $content: <br>
                          <a href='" . SITE_URL . "$page?$type&email=$uemail&token=$token'"."> CLICK ME </a>";

        $mail->send();
        return 1;
    } catch (Exception $e) {
        error_log($mail->ErrorInfo); // Log the specific error message
        return 0;
    }
}



//register

if (isset($_POST['register'])) {
    $data = filteration($_POST);

    // Match password and confirm password
    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    // Check if the user already exists (based on email or phone number)
    $u_exist = select("SELECT * FROM `user_reg` WHERE `email`=? OR `phonenum`=? LIMIT 1", 
        [$data['email'], $data['phonenum']], "ss");
    
    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // Upload user image
    $img = uploadUserImage($_FILES['profile']);
    
    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    }

    // Send confirmation link to user's email
    $token = bin2hex(random_bytes(16));
    if (!send_mail($data['email'],  $token,"email_confirmation")) {
        echo 'mail_failed';
        exit;
    }

    // Hash the password
    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    // Insert user data including client type
    $query = "INSERT INTO `user_reg`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `token`, `client_type`) 
              VALUES (?,?,?,?,?,?,?,?,?,?)";
    
    $values = [
        $data['name'], 
        $data['email'], 
        $data['address'], 
        $data['phonenum'], 
        $data['pincode'], 
        $data['dob'], 
        $img, 
        $enc_pass, 
        $token, 
        $data['clientType'] // Inserting client type
    ];

    if (insert($query, $values, 'ssssssssss')) {
        echo 1;
    } else {
        echo 'ims_failed';
    }
}


///log in
if (isset($_POST['login'])) 
{
  
    $data = filteration($_POST);

        // Check if the user already exists (based on email or phone number)
        $u_exist = select("SELECT * FROM `user_reg` WHERE `email`=? OR `phonenum`=? LIMIT 1", 
        [$data['email_mob'], $data['email_mob']], "ss");
    
    if (mysqli_num_rows($u_exist)==0) {
        echo  'inv_email_mob';
    }
    else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_fetch['is_verified']==0){
            echo 'not_verified';
        }
        else if ($u_fetch['status']==0){
            echo 'inactive';
        }
        else{
            if(!password_verify($data['pass'],$u_fetch['password'])){
                echo  'invalid_pass';
            }
            else {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['uId'] = $u_fetch['id'];
                $_SESSION['uName'] = $u_fetch['name'];
                $_SESSION['uPic'] = $u_fetch['profile'];
                $_SESSION['uPhone'] = $u_fetch['phonenum'];
                
                // Add user type (internal or external) to the session
                $_SESSION['user_type'] = $u_fetch['client_type']; 
                
                echo 1;
            }
            
        }

    }

}


///forgot password

if (isset($_POST['forgot_pass'])) 

{
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_reg` WHERE `email`=? LIMIT 1", [$data['email']], "s");

    if (mysqli_num_rows($u_exist)==0) {
        echo  'inv_email';
    }
    else
    {
      $u_fetch = mysqli_fetch_assoc($u_exist);
     if ($u_fetch['is_verified']==0){
          echo 'not_verified';
     }
     else if ($u_fetch['status']==0){
       echo 'inactive';
     }
     else{
        //send reset link to email
        
        $token = bin2hex(random_bytes(16));
        if (!send_mail($data['email'],$token,'account_recovery')){
            echo 'mail_failed';
        }
        else
        {
            $date = date("Y-m-d");

            $query = mysqli_query($con, "UPDATE `user_reg` SET `token`='$token', `t_expired`='$date' 
            WHERE `id`='{$u_fetch['id']}'");


            if($query){
                echo 1;
            }
            else{
                echo 'upd_failed';
            }
        }
     }
    }

}

///reset password

if (isset($_POST['recover_user'])) 
{
    $data = filteration($_POST);
    
    $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

    $query = "UPDATE `user_reg` SET `password`=?, `token`=?, `t_expired`=? 
            WHERE `email`=? AND `token`=? ";

    $values = [$enc_pass,null,null,$data['email'],$data['token']];

    if (update($query,$values,'sssss'))
    {
        echo 1;
    }
    else{
        echo 'failed';
    }

}





?>