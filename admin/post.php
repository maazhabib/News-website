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
  
  if($_SESSION['user_role'] == 1){
    
   
  $Fetch_data= "SELECT post.post_id , post.title , post.description , post.post_date ,category.category_name,category.category_id , user.username FROM post 
  LEFT JOIN category ON post.category = category.category_id
  LEFT JOIN user ON post.author = user.user_id
  ORDER BY post.post_id DESC LIMIT $start, $per_page ";

  }elseif($_SESSION['user_role'] == 0){

    $Fetch_data= "SELECT post.post_id , post.title , post.description , post.post_date ,category.category_name, user.username FROM post 
  LEFT JOIN category ON post.category = category.category_id
  LEFT JOIN user ON post.author = user.user_id
  WHERE post.author = {$_SESSION['user_id']}
  ORDER BY post.post_id DESC LIMIT $start, $per_page ";
  }

  $Fetch_conn  = mysqli_query($conn , $Fetch_data);


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php 
                        while($row = mysqli_fetch_assoc($Fetch_conn)){
                        ?>
                          <tr>
                              <td class='id'><?php echo $row['post_id']?></td>
                              <td><?php echo $row['title']?></td>
                              <td><?php echo $row['category_name']?></td>
                              <td><?php echo $row['post_date']?></td>
                              <td><?php 
                                if($row['username'] === 1){
                                    echo 'Admin';
                                }else{
                                    echo "Normal";
                                }
                                ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id']?>&cid=<?php echo $row['category_id']?>'><i class='fa fa-trash-o'></i></a></td>
                              

                          </tr>
                         <?php }?>
                      </tbody>
                  </table>
                  <ul class='pagination admin-pagination'>
                <?php  
                  if($page > 1){
                  ?>

                  <li class="page-item"><a class="page-link" href="post.php?page=<?php echo ($page-1)?>">Previous</a>
                  </li>

                  <?php 
                  }
                  $fetch = "SELECT * FROM `post`";
                  $res = mysqli_query($conn,$fetch);
                  $products = mysqli_num_rows($res);
                  $total_pages = ceil($products / $per_page);
                  
                  for ($i=1; $i <= $total_pages; $i++) { 
                    
                  ?>

                 
                  <li class="page-item"><a class="page-link" href="post.php?page=<?php echo $i?>"><?php echo $i?></a>
                  </li>
                  <?php  
                  }

                  if($page < $total_pages){

               
                  ?>

                  <li class="page-item"><a class="page-link" href="post.php?page=<?php echo ($page+1)?>">Next</a>
                  </li>

                  <?php }?>
                </ul>
              </nav>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
