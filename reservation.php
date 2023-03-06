<?php
    session_start();

	spl_autoload_register(function ($class) {
		include 'models/' . $class . '.php';
	});    
	date_default_timezone_set('Asia/Manila');

	include('admin/queries/checkReservationValidity.php');
	$msg = '';
	$status = '';
    $clientHasLoggedIn = false;
	if(isset($_SESSION['client-reserve'])){
		$status = 'client-reserve';
		$msg = $_SESSION['client-reserve'];
		unset($_SESSION['client-reserve']);
		
	}

    if(isset($_SESSION['client-username'])){
        $clientHasLoggedIn = true;
    }

	$conn = new Room();
	$roomDatas = $conn->roomsWithImages();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Serennidad Suites Online Reservation</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/album.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">
    <link href="vendor/datepicker/css/bootstrap-datepicker.min.css"  rel="stylesheet">
    <link  href="vendor/datepicker/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <div class="container marketing">
        <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
                <div class="inner">
                    <h3 class="masthead-brand">Serenidad Suites Online</h3>
                    <nav class="nav nav-masthead justify-content-center">
                        <a class="nav-link " href="index.php">Home</a>
                        <a class="nav-link active" href="reservation.php">Rooms</a>
                        <a class="nav-link" href="aboutUs.php">About Us</a>
                        
                        <?php 
                            if($clientHasLoggedIn){
                                echo '
                                <a class="nav-link" href="client-login.php">'.$_SESSION['client-username'].' </a>
                                ';
                            }else{
                                echo 
                                ' 
                                <a class="nav-link" href="client-login.php">Login</a>
                                ';
                            }
                        ?>
                    </nav>
                </div>
            </header>

            <!-- <main role="main"  class="inner cover"> -->
                <div class="album">
                    <div class="row">

                            <?php
                                foreach ($roomDatas as $key => $room) {
                            ?>      
                               <div class="col-md-6 col-sm-12">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-top" src="admin/<?=$room['photo'] ?>" alt="Card image cap">
                                        <div class="card-body">
                                        <h4 class="display-5 accordion-title"> <?= $room['room_type'] ?> </h4>
                                        <p class="accordion-text"><?=$room['description'] ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <?php 
                                                        if($clientHasLoggedIn){
                                                            echo '
                                                            <span data-toggle="modal" data-target="#reserveModal" onClick="handleReserve('.$room['id'].')">
                                                                <button class="btn btn-sm btn-outline-secondary">
                                                                        <span class="mx-2 appsLand-text-custom">RESERVE THIS ROOM</span>
                                                                </button>
                                                            </span>
                                                            ';
                                                        }else{
                                                            echo 
                                                            '<a href="client-login.php">
                                                                <button type="button" class="btn btn-sm btn-outline-secondary">Login to Reserve</button>
                                                            </a>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                    </div>
                </div>
            <!-- </main> -->

            <footer class="mastfoot mt-auto">
                <div class="inner row">
                    <div class="col-6">
                        <p class="">©Serenidad Suites @ 2023</p>
                    </div>
                    <div class="col-6">
                        <a href="https://www.facebook.com/ss.matabungkay.batangas" target="_blank"><i data-feather="facebook"></i></a>
                        <a href="https://www.instagram.com/ss.matabungkay.batangas" target="_blank"><i data-feather="instagram"></i></a>
                    </div>
                </div>
            </footer>
        </div>
    </div>




<?php include_once('footer.php');?>
