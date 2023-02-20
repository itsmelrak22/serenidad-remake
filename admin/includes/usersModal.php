    <!-- Add User Modal-->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="queries/userResource.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> User</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="name">Name </label>
                                <input id="name" name="name" type="text" class=" form-control" required value="<?=  isset($_SESSION['name']) ?  $_SESSION['name']  : ''?>"/>
                            </div>
                            <div class="col-12">
                                <label for="username">Username </label>
                                <input id="username" name="username" type="text" class=" form-control" required  value="<?=  isset($_SESSION['username']) ?  $_SESSION['username']  : ''?>" />
                            </div>
                            <div class="col-12">
                                <label for="restriction">Restriction</label>
                                <select name="restriction" id="restriction" class=" form-control" required>
                                    <option value="user" selected>User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="password">Password </label>
                                <input id="password" name="password" type="password" class=" form-control" required value="<?=  isset($_SESSION['password']) ?  $_SESSION['password']  : ''?>" />
                            </div>
                            <div class="col-12">
                                <label for="comfirm_password">Confirm Password </label>
                                <input id="comfirm_password" name="comfirm_password" type="password" class=" form-control" required value="<?=  isset($_SESSION['comfirm_password']) ?  $_SESSION['comfirm_password']  : ''?>" />
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