    <!-- confirm checkin Modal-->
    <div class="modal fade" id="confirmCheckinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Checkin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Confirm this transaction as "Check in" ?</div>
                <div class="modal-footer">
                    <form action="queries/reservationResource.php" method="post">
                        <input type="hidden" value="checkin-confirm" name="resource_type">
                        <input type="hidden" value="<?= $value['id'] ?>" name="transaction_id">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" >Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>