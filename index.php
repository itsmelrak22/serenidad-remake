<?php
session_start();
$clientHasLoggedIn = false;
  
  if(isset($_SESSION['client-username'])){
    $clientHasLoggedIn = true;
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
  </head>

  <body class="text-center">
    <div class="container marketing">
        <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
          <header class="masthead mb-auto">
            <div class="inner">
              <h3 class="masthead-brand">Serenidad Suites Online</h3>
              <nav class="nav nav-masthead justify-content-center">
                  <a class="nav-link active" href="index.php">Home</a>
                  <a class="nav-link" href="reservation.php">Rooms</a>
                  <a class="nav-link" href="aboutUs.php">About Us</a>

                  <?php 
                      if($clientHasLoggedIn){
                          echo ' <a class="nav-link" href="client-login.php">'.$_SESSION['client-username'].' </a> ';
                      }else{
                          echo  '  <a class="nav-link" href="client-login.php">Login</a> ';
                      }
                  ?>
                  
              </nav>
            </div>
          </header>
          <main role="main" class="inner cover">
              <h1 class="cover-heading">SERENIDAD SUITES @MATABUNGKAY BEACH</h1>  
              <p class="lead">A home away from home, a “10 minute walk” to the beach.</p>
              <p class="lead">
              <a href="reservation.php" class="btn btn-lg btn-secondary">BOOK NOW !</a>
              </p>
          </main>

          <footer class="mastfoot mt-auto">
              <div class="inner">
                <a href="https://www.facebook.com/ss.matabungkay.batangas" target="_blank"><i data-feather="facebook"></i></a>
                <a href="https://www.instagram.com/ss.matabungkay.batangas" target="_blank"><i data-feather="instagram"></i></a>
              </div>
          </footer>
        </div>

        <div>
          <!-- Three columns of text below the carousel -->
          <div class="row mt-4">
            <div class="col-lg-4">
              <img class="" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
              <h2>Great Location</h2>
            </div><!-- /.col-lg-4 -->

            <div class="col-lg-4">
              <img class="" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
              <h2>Great Experience</h2>
            </div><!-- /.col-lg-4 -->

            <div class="col-lg-4">
              <img class="" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
              <h2>Dive Right In</h2>
            </div><!-- /.col-lg-4 -->

            </div><!-- /.row -->


            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <div class="row featurette">
            <div class="col-md-7">
              <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
              <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>
            <div class="col-md-5">
              <img class="featurette-image img-fluid mx-auto" src="images/main.jpg" alt="Generic placeholder image">
            </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
            <div class="col-md-7 order-md-2">
              <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
              <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>
            <div class="col-md-5 order-md-1">
              <img class="featurette-image img-fluid mx-auto" src="images/main2.jpg" alt="Generic placeholder image">
            </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
            <div class="col-md-7">
              <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
              <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>
            <div class="col-md-5">
              <img class="featurette-image img-fluid mx-auto" src="images/main3.jpg" alt="Generic placeholder image">
            </div>
          </div>
          <hr class="featurette-divider">

          <!-- /END THE FEATURETTES -->
        </div>

    </div><!-- /.container -->






    <?php include_once('footer.php');?>
