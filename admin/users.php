<?php
  require_once('includes/header.php');

  spl_autoload_register(function ($class) {
    include '../models/' . $class . '.php';
  });    

    

  $connection = new Admin();
  $users = $connection->all();
  
?>

    <div class="container-fluid">
      <div class="row">

      <?php include('includes/sidebar.php') ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Users</h1>
          </div>

        <table id="datatable" class="display">
			<thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
			</thead>
			<tbody>
                <?php
                    foreach ($users as $key => $value) {
                ?>
                <tr>
                    <td><?= $value['name']?></td>
                    <td><?= $value['username']?></td>
                    <td>
                        <?php
                            if($_SESSION['login-restriction'] == 'admin'){

                                if($value['restriction'] == 'admin' && ($value['username'] == 'Admin' || $value['username'] == 'Admin2')){
                                    echo '
                                            <button disabled type="submit" class="btn btn-disabled "  data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i data-feather="edit"></i>
                                            </button>

                                            <button disabled type="submit" class="btn btn-disabled"  data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i data-feather="trash"></i>
                                            </button>
                                    ';

                                }else{
                                    echo '
                                    <div class="form-inline">
                                            <form action="queries/users_resource.php" method="post">
                                                <input type="hidden" value="edit" name="resource_type">
                                                <input type="hidden" value="'. $value['id'].'" name="user_id">

                                                <button type="submit" class="btn btn-warning "  data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i data-feather="edit"></i>
                                                </button>
                                            </form>

                                            <form action="queries/users_resource.php" method="post" class="ml-1">
                                                    <input type="hidden" value="delete" name="resource_type">
                                                    <input type="hidden" value="'. $value['id'].'" name="user_id">
                                                    <button  type="submit" class="btn btn-danger"  data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i data-feather="trash"></i>
                                                    </button>
                                            </form>
                                    </div>
                                ';
                                }
                                
                            } 
                        ?>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
		</table>
        </main>
      </div>
    </div>

<?php
  require_once('includes/footer.php');
?>