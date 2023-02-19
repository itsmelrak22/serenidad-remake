<?php
  require_once('includes/header.php');
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

            <?php include('includes/counts.php') ?>

            <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newTransaction">
                    New Transaction
                </button>
            </div>

            <div>
                <hr>
            </div>

		    <table id="datatable" class="display">
                <thead>
                    <tr>
                        <th>Guest Code</th>
                        <th>Name</th>
                        <th>Contact No</th>
                        <th>Room Type</th>
                        <th>Reserved Date</th>
                        <th>Check Out Date</th>
                        <th>Status</th>
                        <th>Reservation Created</th>
                        <th>Reservation Valid Until</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendings as $key => $value) { ?>
                    <tr>
                        <td><?= $value['uuid']?></td>
                        <td><?= $value['firstname']." ".$value['lastname']?></td>
                        <td><?= $value['contactno']?></td>
                        <td><?= $value['room_type']?></td>
                        <td>
                            <strong>
                                <?= $value['checkin'] <= date("Y-m-d", strtotime("+8 HOURS")) 
                                    ?  "<label style = 'color:#ff0000;'>".date("M d, Y", strtotime($value['checkin']))."</label>" 
                                    :  "<label style = 'color:#00ff00;'>".date("M d, Y", strtotime($value['checkin']))."</label>" 
                                ?>
                            </strong>
                        </td>
                        <td><?= "<label style = 'color:#00ff00;'>".date("M d, Y", strtotime($value['checkout']))."</label>";?></td>
                        <td><?= $value['status']?></td>
                        <td><?= $value['created_at']?></td>
                        <td> 
                            <div>
                                <?= $value['valid_until']  
                                    ? '<span class="label label-danger">'. $value['valid_until']. '</span>'
                                    : '';
                                ?>
                            </div>
                            
                        </td>
                        <td>
                            <div class="form-inline">
                                <form method="post" action="queries/reservationResource.php" class="mx-1">
                                    <?=
                                        new DateTime($value['valid_until']) < new DateTime()
                                        ?
                                            ' <button type="button"  class="btn btn-disabled disabled" data-toggle="tooltip" data-placement="top" title="Reservation Expired" disabled>
                                                <i data-feather="check-circle"></i>
                                                </button>'
                                        :
                                        
                                            ' 
                                                <input type="hidden" value="accept" name="resource_type">
                                                <input type="hidden" value="'. $value['id'] .'" name="transaction_id">
                                                <button type="submit"  class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Accept Reservation" >
                                                    <i data-feather="check-circle"></i>
                                                </button>
                                            '
                                    ?>
                                </form>
                                

                                <form  method="post" action="queries/reservationResource.php" >
                                    <?=
                                        new DateTime($value['valid_until']) < new DateTime()
                                        ?
                                            '
                                                <button type="button"  class="btn btn-disabled disabled" data-toggle="tooltip" data-placement="top" title="Reservation Expired" disabled>
                                                <i data-feather="edit"></i>
                                                </button>
                                            '
                                            
                                        :
                                        
                                            ' 
                                                <input type="hidden" value="edit" name="resource_type">
                                                <input type="hidden" value="'.$value['id'].'" name="transaction_id">
                                                <button type="submit"  class="btn btn-warning " data-toggle="tooltip" data-placement="top" title="Edit" >
                                                    <i data-feather="edit"></i>
                                                </button>
                                            '
                                    ?>
                                    
                                </form>
                                <form  method="post" action="queries/reservationResource.php"  class="mx-1">
                                    <input type="hidden" value="delete" name="resource_type">
                                    <input type="hidden" value="'. $value['id'].'" name="transaction_id">
                                    <button type="button"  class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Delete" >
                                        <i data-feather="trash"></i>
                                    </button>
                                </form>
                            </div>
                            
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
		    </table>
        </main>
      </div>
    </div>

<?php
  require_once('includes/indexModal.php');
  require_once('includes/footer.php');
?>