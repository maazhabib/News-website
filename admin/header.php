<?php
include("config.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN Panel</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- HEADER -->
<div id="header-admin">
    <div class="container">
        <div class="row">
            <!-- LOGO -->
            <div class="col-md-2">
                <a href="post.php"><img class="logo" src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
            <!-- LOGOUT -->
            <div class="col-md-offset-9 col-md-3">
                <a href="logout.php" class="admin-logout">Hello <?php echo $_SESSION['username']; ?> / Logout</a>
            </div>
            <!-- /LOGOUT -->
        </div>
    </div>
</div>
<!-- /HEADER -->

<!-- Menu Bar -->
<div id="admin-menubar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="admin-menu">
                    <li><a href="post.php">Post</a></li>
                    <?php if ($_SESSION['user_role'] == 1): ?>
                        <li><a href="category.php">Category</a></li>
                        <li><a href="users.php">Users</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->

<!-- Your main content goes here -->

</body>
</html>
