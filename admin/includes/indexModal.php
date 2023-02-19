<!-- Modal -->
<div class="modal fade" id="newTransaction" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Serenidad Suites - Add New Transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="queries/addReservation.php" method="POST" class="user" id="CheckDate">
                <div class="modal-body card shadow py-2">
                    <div class=" p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="">
                                        <div class="form-group row">
                                            <div class="col-12 mb-3" >
                                                <label for="select-rooms">Room</label>
                                                <select name="room_id" style="border-radius: 10rem !important;" class="custom-select form-control" id="select-rooms"  placeholder="Select Room" onchange="checkRoomAvailability()" required></select>
                                            </div>
                                            
                                            <div class="col-sm-6 mb-3">
                                                <label for="check_in">Check In Date</label>
                                                <input name="check_in" id="datepicker-checkin" type="text" class="datepicker-checkin form-control form-control-user "  placeholder="Check in" onkeyup="clearFields('datepicker-checkin')" onchange="modifyCheckoutDate()" required/>
                                            </div>

                                            <div class="col-sm-6 mb-3" >
                                                <label for="check_out">Check Out Date</label>
                                                <input name="check_out" id="datepicker-checkout" type="text" class="datepicker-checkout form-control form-control-user"  placeholder="Check out" onkeyup="clearFields('datepicker-checkout')" onchange="differenceDates()" required/>
                                            </div>

                                            <div class="col-sm-6 mb-3">
                                                <label for="additional_bed">Additional Bed</label>
                                                <input type="number" name="additional_bed" id="additional_bed" required value="0" class="form-control form-control-user" oninput="differenceDates()">
                                            </div>

                                            <div class="col-sm-6 mb-3">
                                                <label for="additinal_pax">Additional Pax</label>
                                                <input type="number" name="additinal_pax" id="additinal_pax" required value="0" class="form-control form-control-user" oninput="differenceDates()">
                                            </div>

                                            <!-- <div class="col-12 mb-3" >
                                                <select style="border-radius: 10rem !important;" class="custom-select form-control"  id="select-tour" name="tour" placeholder="Select Tour" onchange="differenceDates()">
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

                                        <div class="form-group">
                                            <input name="username" type="text" class="form-control form-control-user"  placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user"  placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <input name="confirm-password" type="password" class="form-control form-control-user"  placeholder="Confirm Password" required>
                                        </div>
                                        <div class="form-group">
                                            <input name="firstname" type="text" class="form-control form-control-user"  placeholder="Fistname" required>
                                        </div>
                                        <div class="form-group">
                                            <input name="middlename" type="text" class="form-control form-control-user"  placeholder="Middlename" required>
                                        </div>
                                        <div class="form-group">
                                            <input name="lastname" type="text" class="form-control form-control-user"  placeholder="Lastname" required>
                                        </div>
                                        <div class="form-group">
                                            <input name="contact" type="number" class="form-control form-control-user" id="contact" placeholder="Contact#" required oninput="checkContactLength()">
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save changes</button>
                </div>
            </form>
        </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>