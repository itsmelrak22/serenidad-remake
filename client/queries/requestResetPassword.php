<?php
require("../../PHPMailer/src/PHPMailer.php");
require("../../PHPMailer/src/SMTP.php");

session_start();
date_default_timezone_set('Asia/Manila');

spl_autoload_register(function ($class) {
    include '../../models/' . $class . '.php';
});

if(!isset($_POST['email'])){
    echo "Error 500, Server Error!";
    exit();
}

header('Content-Type: application/json; charset=utf-8');
$email = $_POST['email'];

$today = date('Y-m-d H:i:s');
$forgot_pass_code = uuid4();
$conn = new Guest;
$conn->setQuery("UPDATE `guest` SET `forgot_pass_code`= '$forgot_pass_code' , `updated_at` = '$today' WHERE `email` = '$email'");
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$baseUrl = $protocol == 'http://' ? "http://localhost/serenidad" : "https://amf.serenidadsuites2023.online";

try {

    $client = $conn->setQuery("SELECT * FROM `guest` WHERE `email` LIKE '$email'")->getFirst();
    sendEmail( 
        $client->email, 
        "$client->firstname $client->middlename $client->lastname",
        "$baseUrl/reset_password.php?forgot_pass_code=$forgot_pass_code"
    );

    // header('Location: ../../client-register.php');

} catch (\PDOException $e) {
    echo $e->getMessage();
    exit(0);
}

function sendEmail($receiverEmail, $receiverFullname, $verificationLink){

    $mailTo = $receiverEmail;
    $body = "<strong>[DO NOT REPLY, THIS IS SYSTEM GENERATED MESSAGE]</strong> <p>This is an email sent confirming your Password Reset Request , click the link to reset your password $verificationLink.</p>";
    
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    // $mail->SMTPDebug = 3;
    $mail->isSMTP();
    $mail->Host = "mail.smtp2go.com";
    $mail->SMTPAuth = true;
    
    $mail->Username = "admin.serenidadsuites";
    $mail->Password = "password";
    $mail->SMTPSecure = "tls";
    
    $mail->Port = "2525";
    $mail->From = "admin@serenidadsuites2023.online";
    $mail->FromName = "Serenidad Suites";
    $mail->addAddress($mailTo, $receiverFullname );
    
    $mail->isHTML('true');
    $mail->Subject = "Serenidad Suites";
    $mail->Body = $body;
    $mail->AltBody = "Serenidad suites body message";
    
    if(!$mail->send()){
        echo "Mailer Error :". $mail->ErrorInfo;
    }else{
        echo "Message Sent";
        $_SESSION["register-success"] = "An email Verification is sent to your registered email ( $receiverEmail ). please confirm!";
        header('Location: ../../client-register.php');
    }

}

function uuid4() {
    /* 32 random HEX + space for 4 hyphens */
    $out = bin2hex(random_bytes(18));

    $out[8]  = "-";
    $out[13] = "-";
    $out[18] = "-";
    $out[23] = "-";

    /* UUID v4 */
    $out[14] = "4";
    
    /* variant 1 - 10xx */
    $out[19] = ["8", "9", "a", "b"][random_int(0, 3)];

    return $out;
}
 