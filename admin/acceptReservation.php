<?php
  require_once('includes/header.php');

    spl_autoload_register(function ($class) {
        include '../models/' . $class . '.php';
    });
    if(!ISSET($_SESSION['resource_type'])){
        header("location:index.php");
    }
    $transaction = $_SESSION['transaction'];

    unset($_SESSION['resource_type']);
    unset($_SESSION['transaction']);
    $total = 0;
    $min_payment = 0;
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

            <div class="container-fluid">
                <form action="queries/reservationResource.php" method="POST" class="user" id="">
                    <div class="card shadow py-2">
                        <div class="card-body p-0">
                        <div class="mx-5 pt-5"> <h5>Serenidad Suites - Confirm Reservation</h5> </div>
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="p-5">
                                        <div class="form-group row">

                                                <input value="<?= $transaction->id ?>" name="transaction_id" type="hidden" class="form-control ">
                                                <input value="save-accept" name="resource_type" type="hidden" class="form-control ">
                                            <div class="col-4 form-group">
                                                <label for="firstname">Firstname :</label>
                                                <input value="<?= $transaction->firstname ?>" name="firstname" id="firstname" type="text" class="form-control "  placeholder="Fistname" readonly>
                                            </div>
                                            <div class="col-4 form-group">
                                                <label for="middlename">Middlename :</label>
                                                <input value="<?= $transaction->middlename ?>" name="middlename" id="middlename" type="text" class="form-control "  placeholder="Middlename" readonly>
                                            </div>
                                            <div class="col-4 form-group">
                                                <label for="lastname">Lastname :</label>
                                                <input value="<?= $transaction->lastname ?>" name="lastname" id="lastname" type="text" class="form-control "  placeholder="Lastname" readonly>
                                            </div>
                                            <div class="col-6 form-group">
                                                <label for="contact">Contact :</label>
                                                <input value="<?= $transaction->contactno ?>" name="contact" id="contact" type="number" class="form-control "  placeholder="Contact#" readonly>
                                            </div>

                                            <hr>
                                            <div class="col-12 mb-3" >
                                                <label for="room_type">Room Type :</label>
                                                <input id="room_type" value="<?= $transaction->room_type ?>" name="room_type" type="text" class=" form-control  disabled"   readonly />
                                            </div>
                                            
                                            <div class="col-sm-6 mb-3">
                                                <label for="check_in">Check in :</label>
                                                <input value="<?= $transaction->checkin ?>" name="check_in" id="check_in" type="text" class=" form-control  "  placeholder="Check in" readonly />
                                            </div>

                                            <div class="col-sm-6 mb-3" >
                                                <label for="check_out">Check out :</label>
                                                <input value="<?= $transaction->checkout ?>" name="check_out" id="check_out" type="text" class=" form-control "  placeholder="Check out" readonly />
                                            </div>
                                            
                                            <div class="col-12 mb-3" >
                                                <!-- Basic Card Example -->
                                                    <div class="card shadow mb-4" id="priceBreakdownContainer">
                                                        <div class="card-header py-3">
                                                            <h6 class="m-0 font-weight-bold text-primary">Initial Bill</h6>
                                                        </div>
                                                        <div class="card-body container-fluid" >
                                                            <div>
                                                                <input name="days" type="hidden" class="form-control " value="<?= $transaction->days ?>">
                                                                <div>
                                                                    <span > <?= 'Price (PHP) : '  ?> </span> <span class="float-right"> <?= $transaction->price ?> </span> 
                                                                </div>
                                                                <div>
                                                                    <span > <?= 'Day(s) : '  ?> </span> <span class="float-right"> x <?= $transaction->days ?> </span> 
                                                                </div>
                                                                <hr>
                                                                <div>
                                                                    <span > <?= 'Room Rate : '  ?> </span> <span class="float-right font-weight-bold"> <?= $transaction->days * $transaction->price ?> </span> 
                                                                </div>
                                                                <hr>

                                                                <div>
                                                                    <span > <?= 'Additional Bed (PHP 500): '  ?> </span> <span class="float-right"> 500 x <?= $transaction->extra_bed ?> </span> 
                                                                </div>
                                                                <div>
                                                                    <span > <?= 'Additional Pax (PHP 350): '  ?> </span> <span class="float-right"> 350 x <?= $transaction->extra_pax ?> </span> 
                                                                </div>
                                                                <hr>
                                                                <div>
                                                                    <span > <?= 'Additionals Rate: '  ?> </span> <span class="float-right font-weight-bold">  <?= ($transaction->extra_pax * 350 ) + ($transaction->extra_bed * 500) ?> </span> 
                                                                </div>
                                                            </div>
                                                            <!-- <div>
                                                                <span > ₱500 x 1 Additional Bed </span> <span class="float-right"> ₱500 </span> 
                                                            </div> -->
                                                            <hr>
                                                            <div>
                                                                <?php 
                                                                    $total = ((int) $transaction->price * (int) $transaction->days) + (500 * $transaction->extra_bed) + (350 * $transaction->extra_pax);
                                                                    $min_payment = ($total * .5);
                                                                ?>
                                                                <input name="bill" type="hidden" class="form-control " value="<?=$total?>">
                                                                <span > Total Bill :  </span> <span class="float-right font-weight-bold"> <?= 'PHP '.  $total?>  </span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>

                                            <hr>
                                            <div class="input-group mb-2">
                                                
                                            </div>
                                            
                                            <div class="col-12 mb-3" >
                                                <div class="alert alert-info" role="alert">
                                                    <ul>
                                                        <li>Mininum Downpayment is PHP <?= $min_payment ?> (50%) </li>
                                                    </ul>
                                                </div>
                                                <label for="payment">Payment (PHP): </label>
                                                <input id="payment" name="payment" type="number" class=" form-control" required onInput="checkPayment(<?= $total ?>)"/>
                                            </div>
                                            
                                        </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-primary" disabled> Save Transaction </button>
                    </div>
                </form>
            </div>

        </main>
      </div>
    </div>

    
    <script>
        function checkPayment(total){
            // const submitBTn = document.getElementById('my-input-id').disabled = false;
            const paymentinput = document.getElementById('payment');
            const submitBTn = document.getElementById('submit');

            let min_payment = eval(total * .5);
            if(Number(paymentinput.value) >= min_payment){
                submitBTn.removeAttribute("disabled");
            }else{
                submitBTn.setAttribute("disabled", "disabled");
            }
        }
    </script>

<?php
  require_once('includes/indexModal.php');
  require_once('includes/footer.php');
?>