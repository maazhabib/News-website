<?php include 'header.php'; ?>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    if (isset($_GET['search'])) {
                        $search_term = mysqli_real_escape_string($conn, $_GET['search']); 
                        $search_query = "SELECT * FROM post WHERE title LIKE '%$search_term%' OR description LIKE '%$search_term%'";
                        $result = mysqli_query($conn, $search_query);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<h2 class='page-heading'>Search Results for: " . htmlspecialchars($search_term) . "</h2>";

                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="post-content">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a class="post-img"
                                               href="single.php?id=<?php echo $row['post_id'] ?>"><img
                                                        src="admin/images/<?php echo $row['post_img'] ?>"
                                                        alt=""/></a>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="inner-content clearfix">
                                                <h3><a
                                                            href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a>
                                                </h3>
                                                <p class="description">
                                                    <?php echo substr($row['description'], 0, 10) . "..." ?>
                                                </p>
                                                <a class='read-more pull-right'
                                                   href='single.php?id=<?php echo $row['post_id'] ?>'>Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<h2>No Results Found</h2>";
                        }
                    } else {
                        echo "<h2>Enter a search term to begin</h2>";
                    }
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
