 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../vendor/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

    <script src="../vendor/datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Data Tables -->
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        } );
    </script>
    <!-- Data Tables -->


    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script> -->

    <script>
        let roomCheckinDates = [];
        let tempRoomCheckinDates = [];
        let rooms = [];
        let daysOfCheckin = 0;
        let selectedRoom = {}

        $('.datepicker-checkin').datepicker({
            clearBtn: true,
            todayHighlight: true,
            startDate: new Date(),
            datesDisabled: roomCheckinDates
        })

        $('.datepicker-checkout').datepicker({
            clearBtn: true,
            todayHighlight: true,
            startDate: new Date(),
            datesDisabled: roomCheckinDates
        }); //> date picker
      window.addEventListener ('load', function () {

            let url = window.location.href;
            url = url.split('/');

            const except = [
                    'reserved.php', 
                    'checkedin.php', 
                    'confirmCheckout.php', 
                    'users.php', 
                    'rooms.php', 
                    'checkedout.php',
                    'editReserved.php',
                    'editRoom.php'
                ]
          
          if(!except.includes(url[url.length - 1])){
            getRooms();
            checkRoomAvailability()
          }


          // getTransactions();
          // setInterval (getTransactions, 300000); // 5 mins
          // setInterval (checkReservationValidity, 300000); // 5 mins

          // const notificationElement = document.getElementById('alertsDropdown');
          // notificationElement.addEventListener("click", readNotifications);
      }, false);

      function getTransactions(){
          $.ajax({
              url: "queries/getTransacrtions.php.php",
              type: "get",
              // data: values ,
              success: function (response) {
                  // console.log(response)
                  const data = $.parseJSON(response);
                  $('#notificationContent').empty();  
                  $('#notificationCount').empty();  

                  $('#notificationCount').append(`<span class="badge badge-danger badge-counter "> ${data.notifications} </span>`);  

                  if(data.transactions.length == 0 ){
                      const rows = `
                          <a class="dropdown-item d-flex align-items-center" href="index.php">
                              <div class="mr-3">
                                  <div class="icon-circle bg-primary">
                                      <i class="fas fa-window-close text-white"></i>
                                  </div>
                              </div>
                              <div>
                                  <span class="font-weight-bold"> No Notifications </span>
                              </div>
                          </a>
                          `;  
                      $('#notificationContent').append(rows);  
                  }
                  $.each(data.transactions, function (i, item) {  
                      // console.log(item)
                      if (i == 4) {
                          return false;
                      }
                      const formatDate = new Date(item.created_at);
                      const rows = `
                          <a class="dropdown-item d-flex align-items-center" href="index.php">
                              <div class="mr-3">
                                  <div class="icon-circle bg-primary">
                                      <i class="fas fa-file-alt text-white"></i>
                                  </div>
                              </div>
                              <div>
                                  <div class="small text-gray-500"> 
                                      ${formatDate.toDateString()}
                                  </div>
                                  <span class="font-weight-bold">Reservation for Room Type - ${item.room_type}!</span>
                              </div>
                          </a>
                          `;  
                      $('#notificationContent').append(rows);  
                  });  

                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                  }
          });
      }

      function readNotifications(){
          $.ajax({
              url: "queries/read_notifications.php",
              type: "post",
              data: {},
              success: function (response) {
                  // console.log(response)
                  const data = $.parseJSON(response);
                  $('#notificationCount').empty();  
                  $('#notificationCount').append(`<span class="badge badge-danger badge-counter "> ${data} </span>`);  

                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                  }
          });
      }

      function checkReservationValidity(){
          $.ajax({
              url: "queries/check_reservation_validity.php",
              type: "post",
              data: {},
              success: function (response) {

                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                  }
          });
      }

      $(function () {  //> tooltip
          $('[data-toggle="tooltip"]').tooltip()
      })
      
      function triggerClick(e) {
          document.querySelector('#image').click();
      }

      function triggerClickMultiple(e) {
          document.querySelector('#other_image').click();
      }
            
      function displayImage(e) {
          if (e.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e){
              document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
              }
              reader.readAsDataURL(e.files[0]);
          }
      }

      function displayOtherImage(e) {
          if (e.files.length > 0) {
              document.getElementById('profileDisplay').style.display = "none";
              // document.getElementById(id).style.visibility = "visible";
              for (let i = 0; i < e.files.length; i++) {
                  var reader = new FileReader();
                  reader.onload = function(e){
                      const imageElement = document.createElement("img");
                      imageElement.setAttribute('src', e.target.result);
                      imageElement.classList.add("imageDisplay");
                      document.querySelector('#imageDisplay').appendChild(imageElement)
                  }
                  reader.readAsDataURL(e.files[i]);
              }
          }
      }

 


        function clearFields(id){
            const field = document.getElementById(id)
            field.value = '';
        }
        
        function getRooms(){
            $.ajax({
                url: "queries/getRooms.php",
                type: "post",
                data: {},
                success: function (response) {
                    const select = document.getElementById('select-rooms');
                    const data = $.parseJSON(response);
                    
                    $.each(data, function (i, item) { 
                        rooms.push(item) 
                        var opt = document.createElement('option')
                        opt.value = item.id
                        opt.innerHTML = `${item.room_type} - PHP ${item.price}`
                        if(i == 0) opt.setAttribute('selected', '')
                        select.appendChild(opt)
                    });  

                    select.value = 1;
                   
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function checkRoomAvailability(){
            const select = document.getElementById('select-rooms');
            const checkinInput = document.getElementById('datepicker-checkin');
            const checkoutInput = document.getElementById('datepicker-checkout');

            roomCheckinDates.splice(0); //> Clear array
            tempRoomCheckinDates.splice(0); //> Clear array

            if(checkinInput.value) checkinInput.value = '';
            if(checkoutInput.value) checkoutInput.value = '';

            let room_id = select.value ? select.value : 1

            $.ajax({
                url: "queries/checkRoomAvailDates.php",
                type: "post",
                data: {
                    room_id: room_id
                },
                success: function (response) {
                    refreshDatePicker();
                    $.each(response, function (i, item) {  
                            let data = new Date(item.checkin)
                            let data2 = new Date(item.checkout)
                            data = ((data.getMonth() > 8) ? (data.getMonth() + 1) : ('0' + (data.getMonth() + 1))) + '-' + ((data.getDate() > 9) ? data.getDate() : ('0' + data.getDate())) + '-' + data.getFullYear()
                            data2 = ((data2.getMonth() > 8) ? (data2.getMonth() + 1) : ('0' + (data2.getMonth() + 1))) + '-' + ((data2.getDate() > 9) ? data2.getDate() : ('0' + data2.getDate())) + '-' + data2.getFullYear()
                            
                            let Date1 = data
                            let Date2 = data2
                            let date1 = new Date(Date1);
                            let date2 = new Date(Date2);
                            let diffTime = Math.abs(date2 - date1);
                            let checkinDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

                            if(checkinDays > 1){
                                const inbetween = []
                                for (let i = 1; i <= checkinDays - 1; i++) {
                                    date1.setDate(date1.getDate() + 1);
                                    let formatDate = ((date1.getMonth() > 8) ? (date1.getMonth() + 1) : ('0' + (date1.getMonth() + 1))) + '-' + ((date1.getDate() > 9) ? date1.getDate() : ('0' + date1.getDate())) + '-' + date1.getFullYear()
                                    inbetween.push(formatDate)
                                }
                                roomCheckinDates = [...roomCheckinDates, ...inbetween]
                                tempRoomCheckinDates = [...tempRoomCheckinDates, ...inbetween]
                            }
                            
                            roomCheckinDates.push(data)
                            roomCheckinDates.push(data2)
                            tempRoomCheckinDates.push(data)
                            tempRoomCheckinDates.push(data2)
                        });  


                        refreshDatePicker();

                        selectedRoom = rooms.find(res => res.id == room_id)
                    
                        if(selectedRoom){
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
                        
             
                 },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    alert('Server Error')
                    location.reload();

                }
            });
        }

        function refreshDatePicker(){
            $(".datepicker-checkin").datepicker("destroy");

            $('.datepicker-checkin').datepicker({
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
                startDate: new Date(),
                datesDisabled: roomCheckinDates
            })

            $(".datepicker-checkout").datepicker("destroy");

            $('.datepicker-checkout').datepicker({
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true,
                startDate: new Date(),
                datesDisabled: roomCheckinDates
            })
        }

        function nextAndPrevDateIsDisabled(date){
            let date1 = new Date(date);
            date1.setDate(date1.getDate() + 1);
            let formatDate1 = ((date1.getMonth() > 8) ? (date1.getMonth() + 1) : ('0' + (date1.getMonth() + 1))) + '-' + ((date1.getDate() > 9) ? date1.getDate() : ('0' + date1.getDate())) + '-' + date1.getFullYear()
           
            let date2 = new Date(date);
            date2.setDate(date2.getDate() - 1);
            let formatDate2 = ((date2.getMonth() > 8) ? (date2.getMonth() + 1) : ('0' + (date2.getMonth() + 1))) + '-' + ((date2.getDate() > 9) ? date2.getDate() : ('0' + date2.getDate())) + '-' + date2.getFullYear()
           
            let today = new Date();
            let formatToday = ((today.getMonth() > 8) ? (today.getMonth() + 1) : ('0' + (today.getMonth() + 1))) + '-' + ((today.getDate() > 9) ? today.getDate() : ('0' + today.getDate())) + '-' + today.getFullYear()
            
            return ( roomCheckinDates.includes(formatDate1) && roomCheckinDates.includes(formatDate2) ) || ( formatToday > formatDate2 && roomCheckinDates.includes(formatDate1) )
        }

        function modifyCheckoutDate(){
            daysOfCheckin = 0;

            const checkinInput = document.getElementById('datepicker-checkin');
            const checkoutInput = document.getElementById('datepicker-checkout');

            if(nextAndPrevDateIsDisabled(checkinInput.value)){
                refreshDatePicker();
                checkinInput.value = ''
                alert('Sorry, Previous or next of selected date is unavailable. ')
                return
            }

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
            setPriceBreakdownContainer()
        }

        function differenceDates(){
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
            setPriceBreakdownContainer()
        }

        
        function setPriceBreakdownContainer(){

            const additionalBedInput = document.getElementById('additional_bed');
            const additionalPaxInout = document.getElementById('additinal_pax');
            let rows ;

            $('#priceBreakdownContainer').empty();  
            if(Number(additionalBedInput.value) > 0 && Number(additionalPaxInout.value) == 0){
                rows = `
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">You won't be charged yet</h6>
                    </div>
                    <div class="card-body container-fluid" >
                        <div>
                            <input name="days" type="hidden" class="form-control form-control-user" value="${ daysOfCheckin }">
                            <span > ${selectedRoom.price} x ${daysOfCheckin} Day(s)/Nights(s) </span> <span class="float-right"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                        </div>
                        <div>
                            <span > 500 x ${additionalBedInput.value} Additional Bed </span> <span class="float-right"> ${ eval(additionalBedInput.value * 500) } </span> 
                        </div>
                        <hr>
                        <div>
                            <input name="bill" type="hidden" class="form-control form-control-user" value="${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalBedInput.value * 500)) }">
                            
                            <span > Total before taxes:  </span> <span class="float-right"> ${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalBedInput.value * 500))  } </span> 
                        </div>
                    </div>
                    `;  

            }else if(Number(additionalBedInput.value) > 0 && Number(additionalPaxInout.value) > 0){
                rows = `
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">You won't be charged yet</h6>
                    </div>
                    <div class="card-body container-fluid" >
                        <div>
                            <input name="days" type="hidden" class="form-control form-control-user" value="${ daysOfCheckin }">
                            <span > ${selectedRoom.price} x ${daysOfCheckin} Day(s)/Nights(s) </span> <span class="float-right"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                        </div>
                        <div>
                            <span > 500 x ${additionalBedInput.value} Additional Bed </span> <span class="float-right"> ${ eval(additionalBedInput.value * 500) } </span> 
                        </div>
                        <div>
                            <span > 350 x ${additionalPaxInout.value} Additional Pax </span> <span class="float-right"> ${ eval(additionalPaxInout.value * 350) } </span> 
                        </div>
                        <hr>
                        <div>
                            <input name="bill" type="hidden" class="form-control form-control-user" value="${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalBedInput.value * 500) +  eval(additionalPaxInout.value * 350)) }">
                            
                            <span > Total before taxes:  </span> <span class="float-right"> ${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalBedInput.value * 500) + eval(additionalPaxInout.value * 350)) } </span> 
                        </div>
                    </div>
                    `;  
            }else if(Number(additionalBedInput.value) == 0 && Number(additionalPaxInout.value) > 0){
                rows = `
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">You won't be charged yet</h6>
                    </div>
                    <div class="card-body container-fluid" >
                        <div>
                            <input name="days" type="hidden" class="form-control form-control-user" value="${ daysOfCheckin }">
                            <span > ${selectedRoom.price} x ${daysOfCheckin} Day(s)/Nights(s) </span> <span class="float-right"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                        </div>
                        <div>
                            <span > 350 x ${additionalPaxInout.value} Additional Pax </span> <span class="float-right"> ${ eval(additionalPaxInout.value * 350) } </span> 
                        </div>
                        <hr>
                        <div>
                            <input name="bill" type="hidden" class="form-control form-control-user" value="${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalPaxInout.value * 350)) }">
                            
                            <span > Total before taxes:  </span> <span class="float-right"> ${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalPaxInout.value * 350))  } </span> 
                        </div>
                    </div>
                    `;  
            }else{
                rows = `
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
            }
            
            $('#priceBreakdownContainer').append(rows);  
        }

        function checkContactLength(){
            const contactInput = document.getElementById('contact');
            if(contactInput.value.length > 11){
                alert('Input only 11 digits in Contact Form, Thankyou');
                contactInput.value = '';
                contactInput.value = '09';
            }
        }

   
    </script>
  </body>
</html>
