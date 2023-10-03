<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <?php 
                        if(isset($_GET['page'])){
                            $page =$_GET['page'];
                          }else{
                            $page = 1;
                          }
                          
                          $per_page = 5;
                          $start = ($page -1) * $per_page;


                          $Fetch_data= "SELECT post.post_id , post.title , post.description , post.post_date ,category.category_name, user.username, post.post_img FROM post 
                          LEFT JOIN category ON post.category = category.category_id
                          LEFT JOIN user ON post.author = user.user_id
                          ORDER BY post.post_id DESC LIMIT $start, $per_page ";

                           $result  = mysqli_query($conn , $Fetch_data);
                           if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                
                            
                        
                        ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id']?>"><img src="admin/images/<?php echo $row['post_img']?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id']?>'><?php echo $row['title']?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php'><?php echo $row['category_name']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php'><?php echo $row['username']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date']?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr( $row['description'], 0 , 10) . "..."?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <?php }
                           }else{
                            echo "<h2>No Record Found</h2>";
                           }?>
                         <ul class='pagination'>
                <?php  
                  if($page > 1){
                  ?>

                  <li class="page-item"><a class="page-link" href="index.php?page=<?php echo ($page-1)?>">Previous</a>
                  </li>

                  <?php 
                  }
                  $fetch = "SELECT * FROM `post`";
                  $res = mysqli_query($conn,$fetch);
                  $products = mysqli_num_rows($res);
                  $total_pages = ceil($products / $per_page);
                  
                  for ($i=1; $i <= $total_pages; $i++) { 
                    
                  ?>

                 
                  <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i?>"><?php echo $i?></a>
                  </li>
                  <?php  
                  }

                  if($page < $total_pages){

               
                  ?>

                  <li class="page-item"><a class="page-link" href="index.php?page=<?php echo ($page+1)?>">Next</a>
                  </li>

                  <?php }?>
                </ul>
              </nav>
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
