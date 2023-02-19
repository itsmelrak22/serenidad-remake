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
                    <th>Days</th>
                    <th>Bill</th>
                    <th>Payment</th>
                    <th>Balance</th>
                    <th>Check in</th>
                    <th>Check out Date</th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
			</thead>
			<tbody>
                <?php foreach ($reserved as $key => $value) { ?>
                    <tr>
                        <td><?= $value['firstname']." ".$value['lastname']?></td>
                        <td><?= $value['room_type']?></td>
                        <td><?= $value['days']?></td>
                        <td><?= $value['bill']?></td>
                        <td><?= $value['payment']?></td>
                        <td><?= $value['balance']?></td>
                        <td><?= $value['checkin']?></td>
                        <td><?= $value['checkout']?></td>
                        <td><?= $value['remarks']?></td>
                        <td><?= $value['status']?></td>
                        <td>
                            <div class="form-inline">
                            <?php   
                                $datetime = new DateTime($value['checkin']);
                                $datetime->modify('-3 day');
                                $valid_cancellation_date =  $datetime->format('m/d/Y');

                                $date1 = new DateTime();
                                $date2 = new DateTime($valid_cancellation_date);
                                if($date1 < $date2){
                                    $interval = $date1->diff($date2);
                                    if($interval->days >= 3){
                                        $cannot_cancel = false;
                                    }
                                }

                                if($value['status'] != 'Cancelled' ){
                            ?>
                                        <span data-toggle="modal" data-target="#confirmCheckinModal">
                                            <button class="btn btn-primary"  data-toggle="tooltip" data-placement="top" title="Accept Reservation" >
                                                <i data-feather="check-circle"></i>
                                            </button>
                                        </span>

                                        <?php
                                            if($cannot_cancel){
                                        ?>
                                            <button class="btn btn-disabled disabled" data-toggle="tooltip" data-placement="top" title="Cancel" disabled>
                                                <i data-feather="x-square"></i>
                                            </button>
                                        <?php
                                            }else{
                                        ?>
                                            <form action="queries/reservedResources.php" method="post">
                                                <input type="hidden" value="edit" name="resource_type">
                                                <input type="hidden" value="<?= $value['id'] ?>" name="transaction_id">
                                                <button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Cancel">
                                                    <i data-feather="x-square"></i>
                                                </button>
                                            </form>
                                        <?php
                                            }
                                        ?>

                            <?php
                                } else {
                            ?>

                                <button class="btn btn-disabled" disabled data-toggle="tooltip" data-placement="top" title="Accept Reservation" >
                                    <i data-feather="check-circle"></i>
                                </button>

                                <button class="btn btn-disabled" disabled data-toggle="tooltip" data-placement="top" title="Cancel" >
                                    <i data-feather="x-square"></i>
                                </button>
                                
                            <?php
                                }
                                if($_SESSION['login-restriction'] == 'admin'){
                            ?>

                                <form action="queries/reservedResources.php" method="post">
                                    <input type="hidden" value="delete" name="resource_type">
                                    <input type="hidden" value="<?= $value['id'] ?>" name="transaction_id">
                                    <button class="btn btn-danger"  data-toggle="tooltip" data-placement="top" title="Delete" >
                                        <i data-feather="trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php
                                }
                        $cannot_cancel = true;

                        }
                    ?>
			</tbody>
		</table>
        </main>
      </div>
    </div>

<?php
  require_once('includes/footer.php');
  require_once('includes/reservedModal.php');
?>