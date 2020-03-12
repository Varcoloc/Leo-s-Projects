<?php
// including database and header of the html
include "includes/db.php";
include "includes/header.php";
session_start();
?>

<?php include "includes/nav.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>
            <?php
            // User submit search query
            if (isset($_POST['submit'])) {
                $search_item = $_POST['search'];

                $query = "SELECT * FROM posts WHERE (post_tags LIKE '%$search_item%') OR (post_author LIKE '%$search_item%') OR (post_title LIKE '%$search_item%')";
                $search_query = mysqli_query($connection, $query);

                if (!$search_query) {
                    die("Query Failed" . mysqli_error($connection));
                }

                $count = mysqli_num_rows($search_query);

                if ($count == 0) {
                    echo "<h1>No Results Found</h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($search_query)) {
                        // Grab the main components that will be shown
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 300);
                    ?>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>">
                            <?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on
                        <?php echo date('Y-M-d', strtotime($post_date)); ?>
                    </p>
                    <hr>
                    <img class="img-responsive" src="./images/<?php echo $post_image; ?>" alt="" draggable="false">
                    <br>
                    <p>
                        <?php echo $post_content; ?>
                    </p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>
            <?php  }
                }
            }?>
        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <?php include "includes/footer.php"; ?>