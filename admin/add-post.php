<?php
include "header.php";

if (isset($_POST['submit'])) {
    $post_title = $_POST['post_title'];
    $postdesc = $_POST['postdesc'];
    $category = $_POST['category'];
    $date = date("Y-m-d");
    $author = $_SESSION['user_id'];

    $image = $_FILES['fileToUpload'];
    $temp_name = $image['tmp_name'];
    $img_name = $image['name'];
    $img_size = $image['size']; 

    if ($img_size <= 1000000) {
        move_uploaded_file($temp_name, "images/$img_name");
    } else {
        echo "IMAGE NOT UPLOAD, IT IS MORE THAN 1 MB";
    }

    
    $check_query = "SELECT * FROM post WHERE title = '$post_title'";
    $check_result = mysqli_query($conn, $check_query);

    if (!$check_result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($check_result) > 0) {
        $error = "Post title already exists";
    } else {
        $insert = "INSERT INTO post (title, description, category, post_date, author, post_img) VALUES ('$post_title', '$postdesc', '$category', '$date', '$author', '$img_name')";
        $update = "UPDATE category SET post = post + 1 WHERE category_id = $category";

        if (mysqli_query($conn, $insert) && mysqli_query($conn, $update)) {
            header("Location: post.php");
            exit;
        } else {
            echo "<script>alert('Data Not Entered')</script>";
        }
    }
}
?>

  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                          <option disabled> Select Category</option>
                          
                          <?php 
                          $sql = "SELECT * FROM category";
                          $res = mysqli_query($conn , $sql) ;
                          
                          if(mysqli_num_rows($res) > 0){
                              while($row = mysqli_fetch_assoc($res)){
                                  
                                  echo "<option value='$row[category_id]'> $row[category_name] </option>";
                            }
                        }
                        ?>

                          
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; 

?>

