    <!-- Add Room Modal-->
    <div class="modal fade" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="queries/roomResources.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Create Room Data</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="room_type">Room Type</label>
                                    <input id="room_type" name="room_type" type="text" class=" form-control" required value="<?=  isset($_SESSION['room_type']) ?  $_SESSION['room_type']  : ''?>"/>
                                </div>
                                <div class="col-12">
                                    <label for="price">Price </label>
                                    <input id="price" name="price" type="text" class=" form-control" required  value="<?=  isset($_SESSION['price']) ?  $_SESSION['price']  : ''?>" />
                                </div>
                                <div class="col-12">
                                    <label for="description">Description </label>
                                    <textarea id="description" name="description" type="text" class=" form-control" required  value="<?=  isset($_SESSION['description']) ?  $_SESSION['description']  : ''?>" ></textarea>
                                </div>
                                <div class="col-12">
                                <div class="mt-2">
                                    <label for="exampleFormControlFile1">Room Image Display: </label>
                                    <input onChange="displayImage(this)" type="file" class="form-control-file" id="image" name="image" required>
                                    <div class="mt-3">
                                        <img src="img/no-image.png" onClick="triggerClick()" id="profileDisplay">
                                    </div>
                                </div>
                                </div>
                                <input name="resource_type" value="store" class=" form-control" type="hidden" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit" >Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>