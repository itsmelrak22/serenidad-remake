<?php
  require_once('includes/header.php');

  spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
  });    

    

    $valid_cancellation_date;
    $cannot_cancel = true;
  
?>

    <div class="container-fluid">
      <div class="row">

      <?php include('includes/sidebar.php') ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <!-- <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button> -->
            </div>
          </div>

        <?php include('includes/counts.php') ?>

        <table id="datatable" class="display">
			<thead>
                <tr>
                    <th>Name</th>
                    <th>Room Type</th>
                    <th>Room no</th>
                    <th>Check In</th>
                    <th>Days</th>
                    <th>Check Out</th>
                    <th>Status</th>
                    <th>Extra Bed</th>
                    <th>Bill</th>
                    <th></th>
                    <th>Actions</th>
                </tr>
			</thead>
			<tbody>
                <?php
                    foreach ($checkedout as $key => $value) {
                ?>

                    <tr>
                        <td><?= $value['firstname']." ".$value['lastname']?></td>
                        <td><?= $value['room_type']?></td>
                        <td><?= $value['room_no']?></td>
                        <td><?= $value['checkin']?></td>
                        <td><?= $value['days']?></td>
                        <td><?= $value['checkout']?></td>
                        <td><?= $value['status']?></td>
                        <td>
                            <?= $value['extra_bed'] == "0" 
                                ? "None"
                                : $value['extra_bed']
                            ?>
                        </td>
                        <td><?= "Php. ".$value['bill'].".00"?></td>
                        <td><label class = "">Paid</label></td>
                        <td>
                            <?php
                                if($_SESSION['login-restriction'] == 'admin'){
                            ?>
                            <div class="form-inline">
                                <form action="queries/checkout_resource.php" method="post">
                                    <input type="hidden" value="edit" name="resource_type">
                                    <input type="hidden" value="<?= $value['id'] ?>" name="transaction_id">
                                    <button class="btn btn-warning"  data-toggle="tooltip" data-placement="top" title="Edit" >
                                        <i data-feather="edit"></i>
                                    </button>
                                </form>

                                <form class="ml-2" action="queries/checkout_resource.php" method="post">
                                    <input type="hidden" value="delete" name="resource_type">
                                    <input type="hidden" value="<?= $value['id'] ?>" name="transaction_id">
                                    <button class="btn btn-danger"  data-toggle="tooltip" data-placement="top" title="Delete" >
                                        <i data-feather="trash"></i>
                                    </button>
                                </form>
                            </div>
                                
                            <?php
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