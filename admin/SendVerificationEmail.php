<?php
require("../PHPMailer/src/PHPMailer.php");
require("../PHPMailer/src/SMTP.php");

Class SendVerificationEmail{

    private $receiverEmail;
    private $receiverFullname;
    private $verificationCode;


    public function __construct($receiverEmail, $receiverFullname, $verificationCode){
        $this->receiverEmail = $receiverEmail;
        $this->receiverFullname =  $receiverFullname;
        $this->verificationCode =  $verificationCode;

        $this->sendEmail();
    }

    public function sendEmail(){

        $mailTo = $this->receiverEmail;
        $body = "<strong>[DO NOT REPLY, THIS IS SYSTEM GENERATED MESSAGE]</strong> <p>This is an email sent confirming your reservation in Serenidad Suites for the date $this->receiverCheckin to $this->receiverCheckout .</p>";
        
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->SMTPDebug = 3;
        $mail->isSMTP();
        $mail->Host = "mail.smtp2go.com";
        $mail->SMTPAuth = true;
        
        $mail->Username = "admin.serenidadsuites";
        $mail->Password = "password";
        $mail->SMTPSecure = "tls";
        
        $mail->Port = "2525";
        $mail->From = "admin@serenidadsuites2023.online";
        $mail->FromName = "Serenidad Suites";
        $mail->addAddress($mailTo, $this->receiverFullname );
        
        $mail->isHTML('true');
        $mail->Subject = "Serenidad Suites";
        $mail->Body = $body;
        $mail->AltBody = "Serenidad suites body message";
        
        if(!$mail->send()){
            echo "Mailer Error :". $mail->ErrorInfo;
        }else{
            echo "Message Sent";
        }

    }
}
    
// $sendEmail = new SendEmail( 'itsmelrak22@gmail.com', 'test', 'checking time', 'checkout time' );
