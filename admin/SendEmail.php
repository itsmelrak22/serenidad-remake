<?php
require '../../vendor/autoload.php';

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

Class SendEmail{

    private $receiverEmail;
    private $receiverFullname;
    private $receiverCheckin;
    private $receiverCheckout;
    private $MailTrapUsername = '9554eca1f50d83';
    private $MailTrapPassword = 'dd76811ec77313';


    public function __construct($receiverEmail, $receiverFullname, $receiverCheckin, $receiverCheckout){
        $this->receiverEmail = $receiverEmail;
        $this->receiverFullname =  $receiverFullname;
        $this->receiverCheckin =  $receiverCheckin;
        $this->receiverCheckout =  $receiverCheckout;

        $this->sendEmail();
    }

    public function sendEmail(){
        // Create a new email message
        $email = new Email();
        $email->from(new Address('serenidadsuites@example.com', 'Serenidad Suites'));
        $email->to(new Address( $this->receiverEmail , $this->receiverFullname));
        $email->subject('Hello Good Day!');
        $email->text("[DO NOT REPLY, THIS IS SYSTEM GENERATED MESSAGE] This is an email sent confirming your reservation in Serenidad Suites for the date $this->receiverCheckin to $this->receiverCheckout .");

        // Create the SMTP transport
        $transport = new EsmtpTransport('smtp.mailtrap.io', 2525);
        $transport->setUsername( '9554eca1f50d83' );
        $transport->setPassword( 'dd76811ec77313' );

        // Create the mailer and send the email
        $mailer = new Mailer($transport);
        $mailer->send($email);
    }
}
    
// $sendEmail = new SendEmail( 'itsmelrak22@gmail.com', 'test' );
