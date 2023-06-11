<?php
session_start();
date_default_timezone_set('Asia/Manila');

spl_autoload_register(function ($class) {
    include '../../models/' . $class . '.php';
});

header('Content-Type: application/json; charset=utf-8');
$id = $_POST['id'];
$today = date('Y-m-d H:i:s');

$conn = new Guest;
try {
    $conn->setQuery("UPDATE `guest` SET `is_verified`= 1 , `updated_at` = '$today'")->getFirst();
    $client = $conn->setQuery("SELECT * FROM `guest` WHERE `id` = '$id' AND `is_verified` = 1")->getFirst();
    $_SESSION['client-id'] = $client->id;
    $_SESSION['client-name'] = "$client->firstname $client->middlename $client->lastname";
    $_SESSION['client-username'] = $client->username;
    $_SESSION['client-contactno'] = $client->contactno;
    $_SESSION['client-token'] = base64_encode($username).$token;
    $_SESSION['login-success'] = ' Welcome '. $_SESSION['name'];
    $_SESSION['welcome-message'] = ' Welcome '. $_SESSION['name']. ', you have succefully verified your account!';
    header('Location: ../index.php');
    exit();
} catch (\PDOException $e) {
    echo "Error 500: Server Error";
    exit();
    echo $e->getMessage();
}

// echo "done!";
    
// if(!isset($client->id)){
//     $_SESSION['login-failed'] = ' Username or Password does not match our records or your account is not verified yet!';
//     header('Location: ../../client-login.php');
//     exit();
// }else{

//     $_SESSION['client-id'] = $client->id;
//     $_SESSION['client-name'] = "$client->firstname $client->middlename $client->lastname";
//     $_SESSION['client-username'] = $client->username;
//     $_SESSION['client-contactno'] = $client->contactno;
//     $_SESSION['client-token'] = base64_encode($username).$token;

//     $_SESSION['login-success'] = ' Welcome '. $_SESSION['name'];
//     header('Location: ../index.php');
//     exit(0);
// }
