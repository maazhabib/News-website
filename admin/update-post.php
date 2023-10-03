<?php
include "header.php";
if (isset($_POST['submit'])) {
    $post_id = $_POST['post_id'];
    $post_title = $_POST['post_title'];
    $postdesc = $_POST['postdesc'];
    $category = $_POST['category'];

    if (isset($_FILES['new-image']['name']) && $_FILES['new-image']['name'] !== "") {
        $new_image = $_FILES['new-image'];
        $new_img_name = $new_image['name'];
        $new_temp_name = $new_image['tmp_name'];
        move_uploaded_file($new_temp_name, "images/$new_img_name");
    } else {
        $new_img_name = $_POST['old-image'];
    }

    $sql1 = "";

    $sql1 .= "UPDATE post SET title = '$post_title', description = '$postdesc', category = $category, post_img = '$new_img_name' WHERE post_id = $post_id;";

    if ($_POST['old_category'] != $_POST['category']) {
        $sql1 .= "UPDATE category SET post = post - 1 WHERE category_id = {$_POST['old_category']};";
        $sql1 .= "UPDATE category SET post = post + 1 WHERE category_id = {$_POST['category']};";
    }

    if (mysqli_multi_query($conn, $sql1)) {
        header("Location: post.php");
        exit;
    } else {
        echo "<script>alert('Update Failed')</script>";
    }
}
$id = $_GET['id'];

$sql = "SELECT post.post_id, post.title, post.description, category.category_name, post.post_img
        FROM post
        LEFT JOIN category ON post.category = category.category_id
        LEFT JOIN user ON post.author = user.user_id
        WHERE post.post_id = $id";

$result = mysqli_query($conn, $sql);

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <!-- Form for show edit -->
                        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Description</label>
                                <textarea name="postdesc" class="form-control" required rows="5"><?php echo $row['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <select class="form-control" name="category">
                                    <option disabled> Select Category</option>
                                    <?php
                                    $sql1 = "SELECT * FROM category";
                                    $res = mysqli_query($conn, $sql1);
                                    if (mysqli_num_rows($res) > 0) {
                                        while ($categoryRow = mysqli_fetch_assoc($res)) {
                                            $selected = ($categoryRow['category_id'] == $row['category']) ? 'selected' : '';
                                            echo "<option value='{$categoryRow['category_id']}' $selected>{$categoryRow['category_name']}</option>";
                                        }
                                    }
                                    ?>
                                </select> 
                                <input type="hidden" name="old_category" value="<?php echo isset($row['category']) ? $row['category'] : ''; ?>">

                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="file" name="new-image">
                                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
                                <img src="images/<?php echo $row['post_img']; ?>" height="150px">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </form>
                        <!-- Form End -->
                        <?php
                    }
                } else {
                    echo "Result Not Found";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
