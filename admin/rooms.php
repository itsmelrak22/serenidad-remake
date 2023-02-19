<?php
  require_once('includes/header.php');

  spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
  });    

    

  $connection = new Room();
  $rooms = $connection->all();
  
?>
    <style>
       #profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; }

        .img-placeholder {
        width: 60%;
        color: white;
        height: 100%;
        background: black;
        opacity: .7;
        height: 210px;
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


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Rooms</h1>
          </div>

        <table id="datatable" class="display">
			<thead>
                <tr>
                    <th>Room Type</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
			</thead>
			<tbody>
                <?php
                    foreach ($rooms as $key => $value) {
                ?>
                    <tr>
                        <td><?= $value['room_type']?></td>
                        <td><?= $value['price']?></td>
                        <td><?= $value['description']?></td>
                        <td>
                            <center>
                                <img src = "<?= $value['photo']?>" height = "150" width = "150"/>
                            </center>
                        </td>
                        <td>
                        <?php
                            if($_SESSION['login-restriction'] == 'admin'){
                                echo '
                                    <div class="form-inline">
                                            <form action="queries/rooms_resource.php" method="post">
                                                <input type="hidden" value="edit" name="resource_type">
                                                <input type="hidden" value="'.$value['id'].'"  name="room_id">
                                                <button type="submit" class="btn btn-warning"  data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i data-feather="edit"></i>
                                                </button>
                                                
                                            </form>

                                            <form action="queries/rooms_resource.php" method="post" class="ml-1">
                                                <input type="hidden" value="add-other-images" name="resource_type">
                                                <input type="hidden" value="'.$value['id'].'"  name="room_id">

                                                <button type="submit" class="btn btn-info"  data-toggle="tooltip" data-placement="top" title="Add Other Images">
                                                    <i data-feather="image"></i>
                                                </button>
                                            </form>

                                            <form action="queries/rooms_resource.php" method="post" class="ml-1">
                                                    <input type="hidden" value="delete" name="resource_type">
                                                    <input type="hidden" value="'.$value['id'].'" name="room_id">
                                                    <input value="'.$value['photo'].'" name="old_photo" type="hidden" class="form-control ">

                                                    <button type="submit" class="btn btn-danger"  data-toggle="tooltip" data-placement="top" title="Add Other Delete">
                                                        <i data-feather="trash"></i>
                                                    </button>
                                            </form>
                                    </div>
                                ';
                            } 
                            ?>
                            
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
		</table>
        </main>
      </div>
    </div>

<?php
  require_once('includes/footer.php');
?>