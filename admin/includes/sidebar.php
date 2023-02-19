        <!-- Side Bar -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <?php 
                    if ($segments[3] == 'index.php') {
                        echo '<a class="nav-link active" href="index.php">';
                    } else {
                        echo '<a class="nav-link" href="index.php">';
                    }
                ?>
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Transactions</span>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <?php 
                    if ($segments[3] == 'index.php') {
                        echo '<a class="nav-link active" href="index.php">';
                    } else {
                        echo '<a class="nav-link" href="index.php">';
                    }
                ?>
                  <span data-feather="file-text"></span>
                  Pending 
                </a>
              </li>
              <li class="nav-item">
                 <?php 
                    if ($segments[3] == 'reserved.php') {
                        echo '<a class="nav-link active" href="reserved.php">';
                    } else {
                        echo '<a class="nav-link" href="reserved.php">';
                    }
                ?>
                  <span data-feather="file-text"></span>
                  Reserved
                </a>
              </li>
              <li class="nav-item">
                <?php 
                    if ($segments[3] == 'checkedin.php') {
                        echo '<a class="nav-link active" href="checkedin.php">';
                    } else {
                        echo '<a class="nav-link" href="checkedin.php">';
                    }
                ?>
                  <span data-feather="file-text"></span>
                  Checked in
                </a>
              </li>
              <li class="nav-item">
                <?php 
                    if ($segments[3] == 'checkedout.php') {
                        echo '<a class="nav-link active" href="checkedout.php">';
                    } else {
                        echo '<a class="nav-link" href="checkedout.php">';
                    }
                ?>
                  <span data-feather="file-text"></span>
                  Checked out
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Utilities</span>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
              <?php 
                    if ($segments[3] == 'users.php') {
                        echo '<a class="nav-link active" href="users.php">';
                    } else {
                        echo '<a class="nav-link" href="users.php">';
                    }
                ?>
                  <span data-feather="file-text"></span>
                  Users
                </a>
              </li>
              <li class="nav-item">
              <?php 
                    if ($segments[3] == 'rooms.php') {
                        echo '<a class="nav-link active" href="rooms.php">';
                    } else {
                        echo '<a class="nav-link" href="rooms.php">';
                    }
                ?>
                  <span data-feather="file-text"></span>
                  Rooms
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <!-- Side Bar -->