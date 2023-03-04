<?php
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
                        <a class="nav-link" href="client-login.php">Login</a>
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
                                        <h4 class="card-title"> <?= $room['room_type']?> </h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
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
                <div class="inner">
                </div>
            </footer>
        </div>
    </div>


<?php include_once('footer.php');?>
