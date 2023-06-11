<?php
session_start();
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json; charset=utf-8');

spl_autoload_register(function ($class) {
    include '../../models/' . $class . '.php';
});

require("../../PHPMailer/src/PHPMailer.php");
require("../../PHPMailer/src/SMTP.php");

$conn = new Transaction();
$id = $_POST['transaction_id'];
$today = date('Y-m-d H:i:s');

switch ($_POST['resource_type']) {
    case 'accept':
        $transaction = $conn->setQuery("SELECT
                                            A.*,
                                            B.firstname,
                                            B.middlename,
                                            B.lastname,
                                            B.address,
                                            B.contactno,
                                            C.room_type,
                                            C.price,
                                            C.photo
                                            FROM `transactions` as A
                                            LEFT JOIN `guest` as B
                                            ON A.guest_id = B.id
                                            LEFT JOIN `room` as C
                                            ON A.room_id = C.id
                                            WHERE A.id = $id
                                        ")
                                        ->getFirst();

        $_SESSION['resource_type'] = $_POST['resource_type'];
        $_SESSION['transaction'] = $transaction;

		header("location:../acceptReservation.php");
    break;

    case 'save-accept':
        // print_r($_POST);
        $balance = (int) $_POST['bill'] - (int)$_POST['payment'];
        $is_payment_full = $balance == 0 ? 1 : 0;
        $payment = $_POST['payment'];

        try {
            $conn->setQuery("UPDATE `transactions` SET `balance`= $balance, `payment`= $payment, `is_payment_full` = $is_payment_full, `payment_at` = '$today' , `updated_at` = '$today', `status` = 'Reserved' WHERE `id` = $id");

        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit(0);
        }
        
        $_SESSION["success"] = " Transaction Successfuly Reseved!";
        header("Location: ../reserved.php");

        
    break;

    case 'checkin-confirm':


            try {
                $conn->setQuery("UPDATE `transactions` SET `status`= 'Check In', `updated_at`= '$today' WHERE `id` = $id");
                $emailReceiver = $conn->getUserTransaction($id);

                    $mailTo = $emailReceiver->email;
                    $body = "<strong>[DO NOT REPLY, THIS IS SYSTEM GENERATED MESSAGE]</strong> <p>This is an email sent confirming your reservation in Serenidad Suites for the date $emailReceiver->checkin to $emailReceiver->checkout, reference_no [ $emailReceiver->reference_no ] .</p>";
                    
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
                    $mail->addAddress($mailTo, "$emailReceiver->firstname $emailReceiver->middlename $emailReceiver->lastname" );
                    
                    $mail->isHTML('true');
                    $mail->Subject = "Serenidad Suites";
                    $mail->Body = $body;
                    $mail->AltBody = "Serenidad suites body message";
                    
                    if(!$mail->send()){
                        echo "Mailer Error :". $mail->ErrorInfo;
                    }else{
                        $_SESSION["success"] = " Transaction Successfuly Checkin!";
                        header("Location: ../checkedin.php");
                    }

            } catch (\PDOException $e) {
                echo $e->getMessage();
                exit(0);
            }



            
           
    break;
        
    case 'checkout-confirm':
        

            try {
                $conn->setQuery("UPDATE `transactions` SET `status`= 'Check Out', `balance`= 0, `updated_at`= '$today' WHERE `id` = $id");
            } catch (\PDOException $e) {
                echo $e->getMessage();
                exit(0);
            }
            
            $_SESSION["success"] = " Transaction Successfuly Checkout!";
            header("Location: ../checkedout.php");
    break;

    case 'edit' :

        try {
            $transaction = $conn->setQuery("SELECT
                        A.*,
                        B.firstname,
                        B.middlename,
                        B.lastname,
                        B.address,
                        B.contactno,
                        C.room_type,
                        C.price,
                        C.photo
                        FROM `transactions` as A
                        LEFT JOIN `guest` as B
                        ON A.guest_id = B.id
                        LEFT JOIN `room` as C
                        ON A.room_id = C.id
                        WHERE A.id = $id
                    ")
                    ->getFirst();

            $_SESSION['resource_type'] = $_POST['resource_type'];
            $_SESSION['transaction'] = $transaction;

            header("location:../editReservation.php");

        } catch (\PDOException $e) {
            // $_SESSION['error'] = $e->getMessage();
            $_SESSION['error'] = 'Server Error!';
            header("location:../");
            exit(0);
        }
        
    break;

    case 'update' :
        try {
            $room_id = $_POST['room_id'];
            $check_in = $_POST['check_in'];
            $check_out = $_POST['check_out'];
            $days = $_POST['days'];
            $bill = $_POST['bill'];
    
            $conn->setQuery("UPDATE `transactions` SET `room_id`= '$room_id', `checkin`= '$check_in', `checkout`= '$check_out', `days`= '$days', `bill`= '$bill', `updated_at`= '$today' WHERE `id` = $id");
            $lastid = $conn->getLastInsertedId();
            $transaction = $conn->find($lastid);
            $new_balance = ($transaction->bill - $transaction->balance);
            $conn->setQuery("UPDATE `transactions` SET `balance`= '$new_balance', `updated_at`= '$today' WHERE `id` = $id");
    
            $_SESSION["success"] = " Transaction Updated Successfuly!";
            header("location:../");
        } catch (\PDOException $e) {
            $_SESSION['error'] = 'Server Error!';
            // $_SESSION['error'] = $e->getMessage();
            header("location:../");
            exit(0);
        }

    break;

    case 'delete' :
  
        try {
            $conn->setQuery(" DELETE FROM `transactions` WHERE `id` = $id");
            $_SESSION['success'] = ' Transaction Deleted!';
            
            header("location:../");

        } catch (\PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            exit(0);
        }
    break;


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
 