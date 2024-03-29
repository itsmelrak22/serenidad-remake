  <?php
    include_once('modals.php');
  ?>
  
  <!-- Floating Action Button -->
  <span  data-toggle="modal" data-target="#chatBotModal" >
    <a href="#" class="float" data-toggle="tooltip" data-placement="left" title="Chat with us!">
      <i class="my-float" data-feather="message-square"></i>
    </a>
  </span>
  <!-- Floating Action Button -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="vendor/datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="vendor/holder.min.js"></script>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>


<script>
        const roomsForOtherImages = <?php echo json_encode($roomDatas) ?>;
        let roomCheckinDates = [];
        let tempRoomCheckinDates = [];
        let rooms = [];
        let daysOfCheckin = 0;
        let selectedRoom = {}
        let room_id = 1;

        function clearFields(id){
            const field = document.getElementById(id)
            field.value = '';
        }
        

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
            getRooms();
            checkRoomAvailability()
        }, false);

        function getOtherImage(id){
            const roomOtherImage = roomsForOtherImages.find(res => res.id == id).other_images;
            const indicator = document.getElementById('carousel-indicators');
            const inner = document.getElementById('carousel-inner');

            indicator.innerHTML = '';
            inner.innerHTML = '';

            roomOtherImage.forEach((el, key) => {
                console.log(el)
                let node = document.createElement("li");
                let att1 = document.createAttribute("data-target");
                let att2 = document.createAttribute("data-slide-to");
                if(key == 0){
                    let active = document.createAttribute("class");
                    active.value = 'active'
                    node.setAttributeNode(active)

                }
                att1.value = '#carouselExampleIndicators'
                att2.value = key
                node.setAttributeNode(att1)
                node.setAttributeNode(att2)

                indicator.appendChild(node);

                let node2 = document.createElement("div");
                node2.classList.add("carousel-item");
                if(key == 0){
                    node2.classList.add("active");
                }

                let node3 = document.createElement("img");
                node3.classList.add("d-block")
                node3.classList.add("w-100")
                let att3 = document.createAttribute("src");
                att3.value = `admin/${el.path}`
                node3.setAttributeNode(att3)

                node2.appendChild(node3)
                inner.appendChild(node2)

                console.log(inner)
            });
        }
        
        function getRooms(){
            $.ajax({
                url: "admin/queries/getRooms.php",
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
			select.value = room_id


            $.ajax({
                url: "admin/queries/checkRoomAvailDates.php",
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
                                            <span class="font-weight-bold accordion-title" > ${selectedRoom.price} x ${daysOfCheckin} Day(s)/Nights(s) </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                                        </div>
                                        <!-- <div>
                                            <span class="font-weight-bold accordion-title"> ₱500 x 1 Additional Bed </span> <span class="float-right"> ₱500 </span> 
                                        </div> -->
                                        <hr>
                                        <div>
                                            <input name="bill" type="hidden" class="form-control form-control-user" value="${ eval(selectedRoom.price * daysOfCheckin) }">
                                            <span class="font-weight-bold accordion-title"> Total before taxes:  </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                                        </div>
                                    </div>
                                    `;  
                                $('#priceBreakdownContainer').append(rows); 
                        } 
                        
             
                 },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    alert('Server Error')
                    // location.reload();

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
                alert('Sorry, Previous or next of selected date is unavalable. ')
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
                            <span class="font-weight-bold accordion-title"> ${selectedRoom.price} x ${daysOfCheckin} Day(s)/Nights(s) </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                        </div>
                        <div>
                            <span class="font-weight-bold accordion-title"> 500 x ${additionalBedInput.value} Additional Bed </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(additionalBedInput.value * 500) } </span> 
                        </div>
                        <hr>
                        <div>
                            <input name="bill" type="hidden" class="form-control form-control-user" value="${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalBedInput.value * 500)) }">
                            
                            <span class="font-weight-bold accordion-title" > Total before taxes:  </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalBedInput.value * 500))  } </span> 
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
                            <span class="font-weight-bold accordion-title"> ${selectedRoom.price} x ${daysOfCheckin} Day(s)/Nights(s) </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                        </div>
                        <div>
                            <span class="font-weight-bold accordion-title"> 500 x ${additionalBedInput.value} Additional Bed </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(additionalBedInput.value * 500) } </span> 
                        </div>
                        <div>
                            <span class="font-weight-bold accordion-title"> 350 x ${additionalPaxInout.value} Additional Pax </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(additionalPaxInout.value * 350) } </span> 
                        </div>
                        <hr>
                        <div>
                            <input name="bill" type="hidden" class="form-control form-control-user" value="${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalBedInput.value * 500) +  eval(additionalPaxInout.value * 350)) }">
                            
                            <span class="font-weight-bold accordion-title"> Total before taxes:  </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalBedInput.value * 500) + eval(additionalPaxInout.value * 350)) } </span> 
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
                            <span class="font-weight-bold accordion-title"> ${selectedRoom.price} x ${daysOfCheckin} Day(s)/Nights(s) </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                        </div>
                        <div>
                            <span class="font-weight-bold accordion-title"> 350 x ${additionalPaxInout.value} Additional Pax </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(additionalPaxInout.value * 350) } </span> 
                        </div>
                        <hr>
                        <div>
                            <input name="bill" type="hidden" class="form-control form-control-user" value="${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalPaxInout.value * 350)) }">
                            
                            <span class="font-weight-bold accordion-title"> Total before taxes:  </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(eval(selectedRoom.price * daysOfCheckin) + eval(additionalPaxInout.value * 350))  } </span> 
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
                            <span class="font-weight-bold accordion-title"> ${selectedRoom.price} x ${daysOfCheckin} Day(s)/Nights(s) </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                        </div>
                        <!-- <div>
                            <span > ₱500 x 1 Additional Bed </span> <span class="float-right"> ₱500 </span> 
                        </div> -->
                        <hr>
                        <div>
                            <input name="bill" type="hidden" class="form-control form-control-user" value="${ eval(selectedRoom.price * daysOfCheckin) }">
                            
                            <span class="font-weight-bold accordion-title"> Total before taxes:  </span> <span class="float-right font-weight-bold accordion-title"> ${ eval(selectedRoom.price * daysOfCheckin) } </span> 
                        </div>
                    </div>
                    `;  
            }

            $('#priceBreakdownContainer').append(rows);  
        }


</script>

  </body>

  <style>
	
.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#3a60ce;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	z-index: 99;
}

.my-float{
	margin-top:18px;
}
</style>
</html>
