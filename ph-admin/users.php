<?php 
require( 'inc.php');
require( 'functions/users.php');  
require('includes/header.php');
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Users</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Users</a></li>
        </ul>
      </div>
      <div class="row">
       <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
             <div class="row mb-4">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>                        <th>Id</th>                        <th>Name</th>                        <th>Role </th>                        <th>Action</tr>
                      </tr>
                    </thead>
                    <tbody>
  <?php                   if(mysqli_num_rows($users_data) > 0)
 while($res = mysqli_fetch_object($users_data)){
?><tr>
<td><?php echo $res->id ?></td>  
                        <td> <?php echo $res->username ?></td>        
                 <td> <?php	                echo $res->role;                ?>
               </td> <?php }?> 
               </tr>                                                              
                 </tbody>
                  </table>
                </div>
              </div>   
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
<?php require_once('includes/footer.php');

?>                 
                    
