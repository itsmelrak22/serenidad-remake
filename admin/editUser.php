

<?php
  require_once('includes/header.php');

  spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
  });    

    
  if(
        !isset($_SESSION['id']) ||
        !isset($_SESSION['name']) ||
        !isset($_SESSION['username']) ||
        !isset($_SESSION['password']) ||
        !isset($_SESSION['restriction'])
    ){
        header("location:users.php");
    }

    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $restriction = $_SESSION['restriction'];

    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
unset($_SESSION['restriction']);

  
?>

    <div class="container-fluid">
      <div class="row">

      <?php include('includes/sidebar.php') ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

        <?php include('includes/restrictionsInfo.php') ?>
        <?php include('includes/usersModal.php') ?>


        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Users</h1>
        </div>

        <div class="container-fluid">
            <form action="queries/userResource.php" method="POST" class="user" id="" >
                <div class="card shadow py-2">
                    <div class="card-body p-0">
                    <div class="mx-5 pt-5"> <h5>Edit USer</h5> </div>
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="p-5">
                                    <div class="form-group row">
                                            <input value="<?= $id ?>" name="user_id" type="hidden" class="form-control ">
                                            <input value="update" name="resource_type" type="hidden" class="form-control ">
                                        <div class="col-12 form-group">
                                            <label for="name">Name :</label>
                                            <input value="<?= $name ?>" name="name" id="name" type="text" class="form-control "  placeholder="Name" >
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="username">Username :</label>
                                            <input value="<?= $username ?>" name="username" id="username" type="text" class="form-control "  placeholder="Username" >
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="restriction">Restriction</label>
                                            <select name="restriction" id="restriction" class=" form-control" required value="<?= $restriction ?>">
                                                <?php 
                                                    if($restriction == 'admin'){
                                                        echo '
                                                            <option value="user">User</option>
                                                            <option value="admin" selected>Admin</option>
                                                        ';
                                                    }else{
                                                        echo '
                                                            <option value="user" selected>User</option>
                                                            <option value="admin" >Admin</option>
                                                        ';
                                                    }
                                                ?>
                                                
                                            </select>
                                        </div>
                                        <!-- <div class="col-12 form-group">
                                            <label for="password">Password :</label>
                                            <input value=" //$password " name="password" id="password" type="password" class="form-control "  placeholder="Password" >
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input  value=" //$password " name="confirm_password" id="confirm_password" type="password" class="form-control "  placeholder="Confirm Password" >
                                        </div> -->
                                    </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" > Save Transaction </button>
                </div>
            </form>
        </div>
        </main>
      </div>
    </div>

<?php
  require_once('includes/footer.php');
?>