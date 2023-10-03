<?php include "header.php"; 
if($_SESSION['user_role'] == 0){
 header("location: post.php");
}


if(isset($_GET['page'])){
    $page =$_GET['page'];
  }else{
    $page = 1;
  }
  
  $per_page = 5;
  $start = ($page -1) * $per_page;
  
  $Fetch_data= "SELECT * FROM `user`LIMIT $start, $per_page ";
  $Fetch_conn  = mysqli_query($conn , $Fetch_data);
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th> 
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php 
                        while($row = mysqli_fetch_assoc($Fetch_conn)){
                        ?>
                          <tr>
                              <td class='id'><?php echo $row['user_id']?></td>
                              <td><?php echo $row['first_name']. " " . $row['last_name'] ?></td>
                              <td><?php echo $row['username']?></td>
                              <td><?php 
                                if($row['role']==1){
                                    echo 'Admin';
                                }else{
                                    echo "Normal";
                                }
                                ?>
                              </td>
                              
                              <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id']?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php }?>
                      </tbody>
                  </table>
                  <ul class='pagination admin-pagination'>
                <?php  
                  if($page > 1){
                  ?>

                  <li class="page-item"><a class="page-link" href="users.php?page=<?php echo ($page-1)?>">Previous</a>
                  </li>

                  <?php 
                  }
                  $fetch = "SELECT * FROM `user`";
                  $res = mysqli_query($conn,$fetch);
                  $products = mysqli_num_rows($res);
                  $total_pages = ceil($products / $per_page);
                  
                  for ($i=1; $i <= $total_pages; $i++) { 
                    
                  ?>

                 
                  <li class="page-item"><a class="page-link" href="users.php?page=<?php echo $i?>"><?php echo $i?></a>
                  </li>
                  <?php  
                  }

                  if($page < $total_pages){

               
                  ?>

                  <li class="page-item"><a class="page-link" href="users.php?page=<?php echo ($page+1)?>">Next</a>
                  </li>

                  <?php    }?>
                </ul>
              </nav>
              </div>
          </div>
      </div>
  </div>
  <?php include "footer.php"; ?>
