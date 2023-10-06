<?php include 'header.php'; ?>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="container">
                    <?php
                    include "config.php";

                    if (isset($_GET['aid'])) {
                        $author_id = $_GET['aid'];

                        // Fetching the categories for a specific author
                        $sql = "SELECT * FROM post JOIN user ON post.author = user.user_id WHERE post.author = $author_id";
                        $result = mysqli_query($conn, $sql) or die("Query Failed: " . mysqli_error($conn));

                        $row1 =mysqli_num_rows($result);
                        print_r($result);
                            ?>
                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="admin-heading">All Categories</h1>
                                </div>
                                <div class="col-md-2">
                                    <a class="add-new" href="add-category.php">Add Category</a>
                                </div>
                                <div class="col-md-12">
                                    <table class="content-table">
                                        <thead>
                                            <th>S.No.</th>
                                            <th>Category Name</th>
                                            <th>No. of Posts</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td class='id'><?php echo $row['category_id']; ?></td>
                                                    <td><?php echo $row['category_name']; ?></td>
                                                    <td><?php echo $row['post']; ?></td>
                                                    <td class='edit'><a
                                                            href='update-category.php?id=<?php echo $row['category_id']; ?>'><i
                                                                class='fa fa-edit'></i></a></td>
                                                    <td class='delete'><a
                                                            href='delete-category.php?id=<?php echo $row['category_id']; ?>'><i
                                                                class='fa fa-trash-o'></i></a></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <ul class='pagination admin-pagination'>
                                        <!-- Pagination code here -->
                                    </ul>
                                </div>
                            </div>
                            <?php
                        } else {
                            echo "No records found";
                        }
                     
                    ?>
                </div>
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
 