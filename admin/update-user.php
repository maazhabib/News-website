<?php include "header.php";
if($_SESSION['user_role'] == 0){
    header("location: post.php");
   }

$sid = $_GET['id'];


$Fetch_data = "SELECT * FROM user WHERE user_id = $sid";
$result= mysqli_query($conn , $Fetch_data);


if(isset($_POST['submit'])){
 $f_name= $_POST['f_name']; 
 $last_name= $_POST['l_name'];
 $username= $_POST['username'];
 $role= $_POST['role'];

$Update_sql = "UPDATE user SET first_name = '{$f_name}' , last_name = '{$last_name}' , username = '{$username}' , role = '{$role}' WHERE user_id = $sid";
$update_res= mysqli_query($conn , $Update_sql);

if($update_res){
    header("location: users.php");
}
}




?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php while($row =  mysqli_fetch_assoc($result)){?>
                  <form  action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id'];?>" placeholder="" required>
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                          <?php 
                                if($row['role']==1){
                                    echo '<option value="0">Normal</option>
                                            <option value="1" selected>Admin</option>';
                                }else{
                                    echo '<option value="0" selected>normal User</option>
                                            <option value="1" >Admin</option>';
                                }
                                ?>
                              
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php }?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
