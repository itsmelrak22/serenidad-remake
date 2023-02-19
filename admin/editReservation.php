
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

  
?>

    <div class="container-fluid">
      <div class="row">

      <?php include('includes/sidebar.php') ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <div class="container-fluid">
            <form action="queries/reservationResource.php" method="POST" class="user" id="">
                <div class="card shadow py-2">
                    <div class="card-body p-0">
                    <div class="mx-5 pt-5"> <h5>Serenidad Suites - Edit Reservation</h5> </div>
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="p-5">
                                    <div class="form-group row">
                                            <input value="<?= $transaction->id ?>" name="transaction_id" type="hidden" class="form-control ">
                                            <input value="update" name="resource_type" type="hidden" class="form-control ">
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
                                            <select name="room_id" style="border-radius: 10rem !important;" class="custom-select form-control" id="select-rooms"  placeholder="Select Room" onchange="checkRoomAvailability()" required></select>
                                        </div>
                                        
                                        <div class="col-sm-6 mb-3">
                                            <input value="<?= $transaction->checkin ?>" name="check_in" id="datepicker-checkin" type="text" class="datepicker-checkin form-control form-control-user "  placeholder="Check in" readonly onchange="modifyCheckoutDateEdit()"/>
                                        </div>

                                        <div class="col-sm-6 mb-3" >
                                            <input value="<?= $transaction->checkout ?>" name="check_out" id="datepicker-checkout" type="text" class="datepicker-checkout form-control form-control-user"  placeholder="Check out" readonly onchange="differenceDatesEdit()" />
                                        </div>

                                        <!-- <div class="col-12 mb-3" >
                                            <select style="border-radius: 10rem !important;" class="custom-select form-control"  id="select-tour" name="tour" placeholder="Select Tour" onchange="differenceDatesEdit()">
                                                <option value="day" selected>Day</option>
                                                <option value="night">Night</option>
                                            </select>
                                        </div> -->
                                        
                                        <div class="col-12 mb-3" >
                                            <!-- Basic Card Example -->
                                                <div class="card shadow mb-4" id="priceBreakdownContainer">

                                                </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" > Update Transaction </button>
                </div>
            </form>
        </div>

        </main>
      </div>
    </div>

<?php
  require_once('includes/footer.php');
?>

<script>
    function setPriceBreakdownContainerEdit(){
        $('#priceBreakdownContainer').empty();  
        const rows = `
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">You won't be charged yet</h6>
            </div>
            <div class="card-body container-fluid" >
                <div>
                    <input name="days" type="hidden" class="form-control form-control-user" value="${ daysOfCheckin }">
                    <span > ${selectedRoom.price} x ${daysOfCheckin} Day(s)/Nights(s) </span> <span class="float-right"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                </div>
                <!-- <div>
                    <span > ₱500 x 1 Additional Bed </span> <span class="float-right"> ₱500 </span> 
                </div> -->
                <hr>
                <div>
                    <input name="bill" type="hidden" class="form-control form-control-user" value="${ eval(selectedRoom.price * daysOfCheckin) }">
                    
                    <span > Total before taxes:  </span> <span class="float-right"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                </div>
            </div>
            `;  
        $('#priceBreakdownContainer').append(rows);  
    }

    function modifyCheckoutDateEdit(){
        daysOfCheckin = 0;

        const checkinInput = document.getElementById('datepicker-checkin');
        const checkoutInput = document.getElementById('datepicker-checkout');

        roomCheckinDates.splice(0);
        tempRoomCheckinDates.map(res => roomCheckinDates.push(res))

        roomCheckinDates.push(checkinInput.value)
        checkoutInput.value = ''
        refreshDatePicker()

        $(".datepicker-checkout").datepicker("destroy");
        $('.datepicker-checkout').datepicker({
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            startDate: checkinInput.value,
            datesDisabled: roomCheckinDates
        })
        setPriceBreakdownContainerEdit()
    }

    function differenceDatesEdit(){
        const checkinInput = document.getElementById('datepicker-checkin');
        const checkoutInput = document.getElementById('datepicker-checkout');

        if(!checkinInput.value || !checkoutInput.value) return;

        const Date1 = checkinInput.value
        const Date2 = checkoutInput.value
        const date1 = new Date(Date1);
        const date2 = new Date(Date2);
        const diffTime = Math.abs(date2 - date1);

        daysOfCheckin = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
        console.log(daysOfCheckin + " days");
        setPriceBreakdownContainerEdit()
    }

</script>