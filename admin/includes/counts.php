<div class="container-fluid  ">
        <div class=" row justify-content-center clickTo">
            <?php 
                if ($segments[3] == 'index.php') {
                    echo '<div class="col-xl-4 col-md-6 mx-3 card  border-dark bg-info text-white mb-3" style="max-width: 18rem;"   onclick="window.location = `index.php`">';
                } else {
                    echo '<div class="col-xl-4 col-md-6 mx-3 card border-dark bg-light mb-3" style="max-width: 18rem;" onclick="window.location =  `index.php`">';
                }
             ?>
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <p class="card-text"> <?= count($pendings)?> </p>
                </div>
            </div>

            <?php 
                if ($segments[3] == 'reserved.php') {
                    echo '<div class="col-xl-4 col-md-6 mx-3 card  border-dark bg-info text-white mb-3" style="max-width: 18rem;"   onclick="window.location = `reserved.php`">';
                } else {
                    echo '<div class="col-xl-4 col-md-6 mx-3 card border-dark bg-light mb-3" style="max-width: 18rem;" onclick="window.location = `reserved.php`">';
                }
            ?>
                <div class="card-body">
                    <h5 class="card-title">Reserved</h5>
                    <p class="card-text"><?=count($reserved)  ?></p>
                </div>
            </div>

            <?php 
                if ($segments[3] == 'checkedin.php') {
                    echo '<div class="col-xl-4 col-md-6 mx-3 card  border-dark bg-info text-white mb-3" style="max-width: 18rem;"   onclick="window.location = `checkedin.php`">';
                } else {
                    echo '<div class="col-xl-4 col-md-6 mx-3 card border-dark bg-light mb-3" style="max-width: 18rem;" onclick="window.location = `checkedin.php`">';
                }
            ?>
                <div class="card-body">
                    <h5 class="card-title">Checked In</h5>
                    <p class="card-text"><?=count($checkedin)  ?></p>
                </div>
            </div>

            <?php 
                if ($segments[3] == 'checkedout.php') {
                    echo '<div class="col-xl-4 col-md-6 mx-3 card  border-dark bg-info text-white mb-3" style="max-width: 18rem;"   onclick="window.location = `checkedout.php`">';
                } else {
                    echo '<div class="col-xl-4 col-md-6 mx-3 card border-dark bg-light mb-3" style="max-width: 18rem;" onclick="window.location = `checkedout.php`">';
                }
            ?>
                <div class="card-body">
                    <h5 class="card-title">Checked Out</h5>
                    <p class="card-text"><?=count($checkedout)  ?></p>
                </div>
            </div>
        </div>
</div>