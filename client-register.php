<?php
session_start();
if( isset($_SESSION['client-token'])) {
    header('Location: client/index.php');
}

$status= '';
$msg= '';
if(isset($_SESSION['error'])){
    $status = 'error';
    $msg = $_SESSION['error'];
    unset($_SESSION['error']);
}
if(isset($_SESSION['username-taken'])){
    $status = 'username-taken';
    $msg = $_SESSION['username-taken'];
    unset($_SESSION['username-taken']);
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
                <?php
                    if($status == 'error'){
                        echo    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Something Went Wrong!' .$msg.'</strong> .
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }
                    if($status == 'username-taken'){
                        echo    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>' .$msg.'</strong> 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                    }
                ?>
                <form class="form-signin" method="post" action="client/queries/handleClientRegister.php">
                    <h1 class="h3 mb-3 font-weight-normal">Register Your Info</h1>
                    <input name="token" type="hidden" value="<?= base64_encode('Serenidad Suites') ?>">

                    <label for="inputUsername" class="sr-only">Username</label>
                    <input type="text" id="inputUsername" class="form-control mb-2" placeholder="Username" name="username" required autofocus>

                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control mb-2" placeholder="Password" name="password" required>

                    <label for="confirmPassword" class="sr-only">Confirm Password</label>
                    <input type="password" id="confirmPassword" class="form-control mb-2" placeholder="Password" name="confirm-password" required>

                    <label for="inputFirstname" class="sr-only">Firstname</label>
                    <input type="text" id="inputFirstname" class="form-control mb-2" placeholder="Firstname" name="firstname" required>

                    <label for="inputMiddlename" class="sr-only">Middlename</label>
                    <input type="text" id="inputMiddlename" class="form-control mb-2" placeholder="Middlename" name="middlename" required>

                    <label for="inputLastname" class="sr-only">Lastname</label>
                    <input type="text" id="inputLastname" class="form-control mb-2" placeholder="Lastname" name="lastname" required>

                    <label for="inputContactNo" class="sr-only">Contact No.</label>
                    <input type="text" id="inputContactNo" class="form-control mb-2" placeholder="Contact No." name="contact_no" required>

                    <div class="checkbox mb-3"> </div>
                    <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">Register Now</button>
                    <a href="client-login.php">
                        <button class="btn btn-lg btn-primary btn-block" type="button">Back to Login</button>
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
