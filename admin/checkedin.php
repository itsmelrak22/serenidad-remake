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
                    <th>Check In</th>
                    <th>Days</th>
                    <th>Check Out</th>
                    <th>Status</th>
                    <th>Extra Bed</th>
                    <th>Bill</th>
                    <th>Action</th>
                </tr>
			</thead>
			<tbody>
                <?php
                    foreach ($checkedin as $key => $value) {
                ?>

                <tr>
                    <td><?= $value['firstname']." ".$value['lastname']?></td>
                    <td><?= $value['room_type']?></td>
                    <td><?= $value['checkin']?></td>
                    <td><?= $value['days']?></td>
                    <td><?= $value['checkin']?></td>
                    <td><?= $value['status']?></td>
                    <td><?php if($value['extra_bed'] == "0"){ echo "None";}else{echo $value['extra_bed'];}?></td>
                    <td><?= "Php. ".$value['bill'].".00"?></td>
                    <td>
                        <form action="queries/checkoutResources.php" method="post">
                            <input type="hidden" value="confirm" name="resource_type">
                            <input type="hidden" value="<?= $value['id'] ?>" name="transaction_id">
                            <button class="btn btn-primary"  data-toggle="tooltip" data-placement="top" title="Confirm" >
                                <i data-feather="check-square"></i>
                            </button>
                        </form>
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