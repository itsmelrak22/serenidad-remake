<?php
spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
});    
date_default_timezone_set('Asia/Manila');
session_start();
$url_path = $_SERVER['REQUEST_URI'];
$segments = explode('/', $url_path);

include_once('queries/validateClientLogin.php');

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Serenidad Suites</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <link rel="stylesheet" href="../vendor/datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../vendor/datepicker/css/bootstrap-datepicker.standalone.min.css">

    <style>
        .clickTo {cursor: pointer;}
    </style>
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php">Serenidad Suites</a>
      <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
      <ul class="navbar-nav px-3">
        <li>
          <?= '<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"> 
                <p class="accordion-title">'.$_SESSION['client-username'] .' | Sign out</p>
              </a>' ?>
        </li>
      </ul>
    </nav>

    <?php include('includes/logoutModal.php')  ?>