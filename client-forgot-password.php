<?php
session_start();
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
          <main role="main" class="inner cover">
            <div class="card-body">
              <h3 class="cover-heading" style="color: #0000008a">Serenidad Suites</h3>  
              <form action="client/queries/requestResetPassword.php" method="POST">
                <div class="mb-3">
                  <label for="forgot_password" style="color: #0000008a">Your Email: </label>
                    <input class="form-input" type="email" name="email" id="forgot_password" >
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Verify</button>
                </div>
              </form>
            </div>
          </main>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

