<?php
session_start();
date_default_timezone_set('Asia/Manila');

spl_autoload_register(function ($class) {
    include 'models/' . $class . '.php';
});

  if (!isset($_GET['ver_code'])) {
      echo "Validation Invalid";
      exit();

  } 

  $verCode = $_GET['ver_code'];
  $guest = new Guest;
  $client = $guest->setQuery("SELECT * FROM `guest` WHERE `verification_code` = '$verCode'")->getFirst();

  if(!isset($client->id)){
    echo "Validation Invalid";
    exit();
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
    <div class="row justify-content-center" style="padding-top: 120px">
      <div class="col-lg-6 mt-8">
        <div class="card mt-5">
          <?php if($client->is_verified == 0){ ?>
          <main role="main" class="inner cover">
            <div class="card-body">
              <h3 class="cover-heading" style="color: #0000008a">Serenidad Suites Email Verification</h3>  
              <form action="client/queries/confirmVerifyUser.php" method="POST">
                <div class="mb-3">
                  <h4 style="color: #0000008a">Verification Email: <?= $client->email ?> </h4>
                </div>
                <input type="hidden" name="id" value="<?= $client->id?>" >
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Verify</button>
                </div>
              </form>
            </div>
          </main>
          <?php } else { ?>
            <main role="main" class="inner cover">
            <div class="card-body">
              <h3 class="cover-heading" style="color: #0000008a">Serenidad Suites Email Verification</h3>  
                <div class="mb-3">
                  <h4 style="color: #0000008a">You are already verified user </h4>
                </div>
            </div>
          </main>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

