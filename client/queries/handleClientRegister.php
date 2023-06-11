<?php
require("../../PHPMailer/src/PHPMailer.php");
require("../../PHPMailer/src/SMTP.php");

session_start();
date_default_timezone_set('Asia/Manila');

spl_autoload_register(function ($class) {
    include '../../models/' . $class . '.php';
});

header('Content-Type: application/json; charset=utf-8');
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$baseUrl = $protocol == 'http://' ? "http://localhost/serenidad" : "https://amf.serenidadsuites2023.online";
// print_r($baseUrl);
// exit();
$username = htmlspecialchars($_POST['username'], ENT_QUOTES) ?? '';
$password = htmlspecialchars($_POST['password'], ENT_QUOTES) ?? '';
$confirm_password = htmlspecialchars($_POST['confirm-password'], ENT_QUOTES) ?? '';

if($password != $confirm_password){
    $_SESSION['error'] = 'Password and Confirm Password Did not Match';
    header('Location: ../../client-register.php');
    exit(0);
}

$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$contact_no = $_POST['contact_no'];
$email = $_POST['email'];
$uuid = uuid4();
$verification_code = uuid4();


$token = $_POST['token'];

if(base64_decode($token) != 'Serenidad Suites'){
    $_SESSION['error'] = 'Server Error';
    header('Location: ../../client-register.php');
    exit(0);
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
$today = date('Y-m-d H:i:s');


$guest = new Guest;

$checkUsername = $guest->setQuery("SELECT * FROM `guest` WHERE `username` LIKE '$username'")->getAll();
if(count($checkUsername) > 0){
    $_SESSION["username-taken"] = "Username Already Taken!";
    header('Location: ../../client-register.php');
    exit(0);
}

$checkEmail = $guest->setQuery("SELECT * FROM `guest` WHERE `email` LIKE '$email'")->getAll();
if(count($checkEmail) > 0){
    $_SESSION["username-taken"] = "Email Already Taken!";
    header('Location: ../../client-register.php');
    exit(0);
}

try {
    $guest->setQuery("INSERT INTO `guest` (`uuid`, `firstname`, `username`, `password`, `email`, `middlename`, `lastname`, `contactno`, `verification_code`,  `created_at`, `updated_at`) VALUES ('$uuid', '$firstname', '$username', '$password', '$email', '$middlename', '$lastname', '$contact_no', '$verification_code', '$today', '$today' )");

    $client = $guest->setQuery("SELECT * FROM `guest` WHERE `username` = '$username' AND `password` = '$password'")->getFirst();
    sendEmail( 
        $client->email, 
        "$client->firstname $client->middlename $client->lastname",
        "$baseUrl/verification.php?ver_code=$verification_code"
    );

    // header('Location: ../../client-register.php');

} catch (\PDOException $e) {
    echo $e->getMessage();
    exit(0);
}

function sendEmail($receiverEmail, $receiverFullname, $verificationLink){

    $mailTo = $receiverEmail;
    $body = "<strong>[DO NOT REPLY, THIS IS SYSTEM GENERATED MESSAGE]</strong> <p>This is an email sent confirming your registration in Serenidad Suites, click the link to verify your email $verificationLink.</p>";
    
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