<?php
  require_once('includes/header.php');

  spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
  });    

    
  if(
    !isset($_SESSION['id']) ||
    !isset($_SESSION['room_type']) ||
    !isset($_SESSION['price']) ||
    !isset($_SESSION['photo'])
){
    header("location:rooms.php");
}

$id = $_SESSION['id'];
$room_type = $_SESSION['room_type'];
$price = $_SESSION['price'];
$photo = $_SESSION['photo'];
$description = $_SESSION['description'];

unset($_SESSION['id']);
unset($_SESSION['room_type']);
unset($_SESSION['price']);
unset($_SESSION['photo']);
unset($_SESSION['description']);

$conn = new Room;
$room = $conn->find(1);
?>

<style>
       #profileDisplay { display: block;  width: 80%; margin: 0px auto; }

        .img-placeholder {
        color: white;
        height: 100%;
        background: black;
        opacity: .7;
        height: 80%;
        z-index: 2;
        position: absolute;
        left: 50%;
        display: none;
        }

        .img-placeholder h4 {
        margin-top: 40%;
        color: white;
        }

        .img-div:hover .img-placeholder {
        display: block;
        cursor: pointer;
        }
</style>

    <div class="container-fluid">
      <div class="row">

        <?php include('includes/sidebar.php') ?>
        <?php include('includes/roomsModal.php') ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Rooms</h1>
        </div>

        <div class="container-fluid">
            <form action="queries/roomResources.php" method="post" enctype="multipart/form-data">
                <div class="card shadow py-2">
                    <div class="card-body p-0">
                    <div class="mx-5 pt-5"> <h5>Edit Room</h5> </div>
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="p-5">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="room_type">Room Type</label>
                                        <input  value="<?= $room_type ?>" id="room_type" name="room_type" type="text" class=" form-control" required />
                                    </div>
                                    <div class="col-12">
                                        <label for="price">Price </label>
                                        <input value="<?= $price ?>" id="price" name="price" type="text" class=" form-control" required />
                                    </div>
                                    <div class="col-12">
                                        <label for="description">Description </label>
                                        <textarea id="description" name="description" type="text" class=" form-control" required  ><?= $description ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="mt-2">
                                                <label for="exampleFormControlFile1">Room Image Display: </label>
                                                <input onChange="displayImage(this)" type="file" class="form-control-file" id="image" name="image">
                                                <div class="mt-3">
                                                    <img src="<?= $photo ?>" onClick="triggerClick()" id="profileDisplay">
                                                </div>
                                        </div>
                                    </div>
                                    <input value="<?= $photo ?>" name="old_photo" type="hidden" class="form-control ">
                                    <input value="<?= $id ?>" name="room_id" type="hidden" class="form-control ">
                                    <input value="update" name="resource_type" type="hidden" class="form-control ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" > Update Room </button>
                </div>
            </form>
        </div>

        </main>
      </div>
    </div>

<?php
  include('includes/footer.php');
?>