<?php
include('includes/header.php');

    spl_autoload_register(function ($class) {
        include '../models/' . $class . '.php';
    });

    // header('Content-Type: application/json; charset=utf-8');
    $msg = '';
    $status = '';
    if(isset($_SESSION['success'])){
        $status = 'success';
        $msg = $_SESSION['success'];
        unset($_SESSION['success']);
        
    }
    $id = $_SESSION['client-id'];
    $conn = new Transaction;
    $transactions = $conn->getAllUserTransactions($id);

?>

    <div class="container-fluid">
      <div class="row">

      <?php include('includes/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                </div>
            </div>

            <div>
                <hr>
            </div>

		    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th> Transaction ID </th>
                                            <th> Reserved Room </th>
                                            <th> Status </th>
                                            <th> Check in </th>
                                            <th> Check out </th>
                                            <th> Extra Bed </th>
                                            <th> Extra Pax </th>
                                            <th> Bill </th>
                                            <th> Payment </th>
                                            <th> Balance </th>
                                            <th> Valid until </th>
                                            <th> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transactions as $key => $value) {  
                                            $value = (object) $value;?>
                                            <tr>
                                                <td> <?=$value->id ?> </td>
                                                <td> <?=$value->room_type ?> </td>
                                                <td> <?=$value->status ?> </td>
                                                <td> <?=$value->checkin ?> </td>
                                                <td> <?=$value->checkout ?> </td>
                                                <td> <?=$value->extra_bed ?> </td>
                                                <td> <?=$value->extra_pax ?> </td>
                                                <td> <?=$value->bill ?> </td>
                                                <td> <?=$value->payment ?> </td>
                                                <td> <?=$value->balance ?> </td>
                                                <td> <?=$value->valid_until ?> </td>
                                                <td>
                                                    <?php if($value->status == 'Pending'){ ?>
                                                        <span data-toggle="tooltip" data-placement="top" title="Process Downpayment">
                                                            <button class="btn btn-info btn-circle" data-toggle="modal" data-target="#paymentModal" onClick="getUserTransaction(<?= $value->id ?>)">
                                                                <i data-feather="check-circle"></i>
                                                            </button> 
                                                        </span>
                                                    <?php }else if($value->status == 'Reserved' || $value->status == 'Check In'){?>
                                                        <span>
                                                            Transaction Reserved/Checkin
                                                        </span>
                                                    <?php }else if($value->status == 'Check Out'){?>
                                                        <span>
                                                            Transaction Completed
                                                        </span>
                                                    <?php }else{?>
                                                        <span>
                                                            Transaction Expired / Failed
                                                        </span>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
        </main>
      </div>
    </div>

<?php
  require_once('includes/footer.php');
  require_once('includes/indexModal.php');

?>