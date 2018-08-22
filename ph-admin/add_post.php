<?php 
require( 'inc.php');
require('functions/posts.php');
require('includes/header.php');
?>


      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Vertical Form</h3>
            <div class="tile-body">
     <?php echo $errors; ?>  
              <form action="addpost.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label">Post Name</label>
                  <input class="form-control" name="pname" type="text" placeholder="Enter full name" required>
                </div>               
                <div class="form-group">
                  <label class="control-label">Content</label>
                  <textarea class="form-control" name="pcontent" rows="4" placeholder="Enter your address"></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Post Image</label>
                  <input class="form-control" type="file" id="pimage" name="pimage">
                </div>
            </div>
<div class="tile-footer">
              <button class="btn btn-primary" type="submit" name="addpost"><i class="fa fa-fw fa-lg fa-check-circle"></i>Publish</button>
              </form>
            </div>
          </div>
        </div>
<?php require_once('includes/footer.php');

?>
