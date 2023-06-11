<?php
session_start();
date_default_timezone_set('Asia/Manila');

spl_autoload_register(function ($class) {
    include 'models/' . $class . '.php';
});

$status= '';
$msg= '';
if(isset($_SESSION['error'])){
    $status = 'error';
    $msg = $_SESSION['error'];
    unset($_SESSION['error']);
}


  if (!isset($_GET['forgot_pass_code'])) {
      echo "Validation Invalid";
      exit();

  } 

  $forgot_pass_code = $_GET['forgot_pass_code'];
  $guest = new Guest;
  $client = $guest->setQuery("SELECT * FROM `guest` WHERE `forgot_pass_code` = '$forgot_pass_code'")->getFirst();

  if(!isset($client->id)){
    echo "Validation Invalid";
    exit();
  }else{
    echo "Hello";
  }

?>

<!DOCTYPE html>
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
  </head>

  <body class="text-center">
    <div class="container marketing">
    <?php 
          if($status == 'error'){
              echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>Login Failed!</strong> '.$msg .'
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                      </div>';
          }
      ?>
    <div class="row justify-content-center" style="padding-top: 120px">
      <div class="col-lg-6 mt-8">
        <div class="card mt-5">
          <main role="main" class="inner cover">
            <div class="card-body">
                  <div class="row justify-content-center">
                    <div class="col-md-6 mt-5">
                         <h4 style="color: #0000008a">Reset Password</h4>
                        <form action="client/queries/confirmResetPassword.php" method="post">
                          <input type="hidden" name="id" value="<?= $client->id ?>">
                            <div class="form-group">
                                <label for="password" style="color: #0000008a">New Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" style="color: #0000008a">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </form>
                    </div>
                  </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

