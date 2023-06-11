<?php
session_start();
if( isset($_SESSION['client-token'])) {
    header('Location: client/index.php');
}

$status= '';
$msg= '';
if(isset($_SESSION['login-failed'])){
    $status = 'login-failed';
    $msg = $_SESSION['login-failed'];
    unset($_SESSION['login-failed']);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Serenidad Suites Online Reservation System</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

    <style>
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

    </style>
  </head>

  <body class="text-center">
    <div class="container marketing">
        <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
                <div class="inner">
                <h3 class="masthead-brand">Serenidad Suites Online</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link " href="index.php">Home</a>
                    <a class="nav-link" href="reservation.php">Rooms</a>
                    <a class="nav-link" href="aboutUs.php">About Us</a>
                    <a class="nav-link active" href="client-login.php">Login</a>

                </nav>
                </div>
            </header>
            <main role="main" class="inner cover">
                <div class="mb-1">
                    <?php 
                        if($status == 'login-failed'){
                            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Login Failed!</strong> '.$msg .'
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                        }
                    ?>
                </div>
                <form class="form-signin" method="post" action="client/queries/handleLogin.php">
                    <h1 class="h3 mb-3 font-weight-normal">Client Login</h1>

                    <label for="inputUsername" class="sr-only">Username</label>
                    <input type="text" id="inputUsername" class="form-control mb-2" placeholder="Username" name="username" required autofocus>

                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control mb-2" placeholder="Password" name="password" required>
                    <input name="token" type="hidden" value="<?= base64_encode('Serenidad Suites') ?>">

                    <div class="checkbox mb-3"> </div>
                    <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">Sign in</button>
                    <a href="client-register.php">
                        <button class="btn btn-lg btn-primary btn-block" type="button">Create an Account</button>
                    </a>
                    <div class="checkbox mb-3"> </div>
                    <a href="client-forgot-password.php">
                        <span>Forgot Password?</span>
                    </a>
                </form>
          </main>

          <footer class="mastfoot mt-auto">
              <div class="inner">
              </div>
          </footer>
        </div>
    </div><!-- /.container -->
    <?php include_once('footer.php');?>
