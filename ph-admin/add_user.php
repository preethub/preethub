<?php 
require( 'inc.php');
require('functions/users.php');
require('includes/header.php');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Add Users</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="user.php"> Users</a></li>
        </ul>
      </div>
        </div>
        <div class="row">
        <div class="clearix"></div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Add User</h3>
            <div class="tile-body">
    <?php echo $echo;?>       
            <form action="add_user.php" method="post"> 
                <div class="form-group col-md-3">                   
                  <label class="control-label">User Name<b> -> (Required)</b> </label>
                  <input class="form-control" name="username" type="text" placeholder="Enter your name" required>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Email<b>->  (Required)</b></label>
                  <input class="form-control" name="email" type="text" placeholder="Enter your email" required>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">First Name</label>
                  <input class="form-control" name="first_name" type="text" placeholder="Enter your First Name">
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Last Name</label>
                  <input class="form-control" name="last_name" type="text" placeholder="Enter your Last Name">
                </div>
        <div class="form-group col-md-3">
                  <label class="control-label">Password</label>
                  <input class="form-control" name="password" type="text" placeholder="Enter Your Password">
                </div>       
                <div class="form-group col-md-4 align-self-end">
                  <button class="btn btn-primary" type="submit" name="add_user"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                </div>
              </form>
            </div>
            </div>
            </div>
            </div>
    </main>


<?php require_once('includes/footer.php');

?>
