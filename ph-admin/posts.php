<?php 
require('inc.php');
require('functions/posts.php');
require('includes/header.php');
?>
        <main class="app-content">
      <div class="app-title">
        <div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">All Posts</a></li>
        </ul>
       <?php echo show_message();      ?>  
      </div>
      <div class="row">
       <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
          
             <div class="row mb-4">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>                        <th>Id</th>                        <th>Name</th>                                               <th>Action</tr>
                      </tr>
                    </thead>
                    <tbody>
 <?php foreach ($posts as $post): ?>
 <tr>
 
<td> <?php echo $post->id; ?></td>
<td> <?php echo $post->name; ?> </td>
<td> <a href="?delete=<?php echo $post->id; ?>">Delete</a>
 </tr>
 <?php endforeach ?>                                                                       
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
